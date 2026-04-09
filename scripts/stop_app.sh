#!/bin/bash
# ─────────────────────────────────────────────────────────
# stop_app.sh — Stops the running Docker container
#
# CodeDeploy runs this BEFORE deploying the new version.
# We need to stop the old container first so the new one
# can bind to port 80.
# ─────────────────────────────────────────────────────────

echo "Stopping running Docker containers..."

# Stop all running containers
# || true means "don't fail if no containers are running"
docker stop $(docker ps -q) || true

# Remove stopped containers to free up resources
docker rm $(docker ps -aq) || true

echo "Containers stopped successfully."
