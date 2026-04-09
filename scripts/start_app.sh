#!/bin/bash
# ─────────────────────────────────────────────────────────
# start_app.sh — Pulls latest image from ECR & runs it
#
# CodeDeploy runs this AFTER copying files to EC2.
# It:
#   1. Logs in to ECR
#   2. Pulls the latest Docker image
#   3. Runs it with RDS credentials as env variables
# ─────────────────────────────────────────────────────────

echo "Logging in to Amazon ECR..."
aws ecr get-login-password --region ap-south-1 | docker login --username AWS --password-stdin 381491835701.dkr.ecr.ap-south-1.amazonaws.com

echo "Pulling latest Docker image from ECR..."
docker pull 381491835701.dkr.ecr.ap-south-1.amazonaws.com/bitcot-registry:latest

echo "Starting Docker container..."
docker run -d -p 80:80 \
  -e DB_HOST=bitcot-db.cbaa6kqecpeh.ap-south-1.rds.amazonaws.com \
  -e DB_USER=admin \
  -e DB_PASS=Admin1234 \
  -e DB_NAME=php_app_db \
  381491835701.dkr.ecr.ap-south-1.amazonaws.com/bitcot-registry:latest

echo "Application started successfully."
