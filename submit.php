<?php
// ─────────────────────────────────────────
//  Form Submission Handler
// ─────────────────────────────────────────
header('Content-Type: application/json');
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// ── Sanitize & Validate ──────────────────
$full_name = trim(htmlspecialchars($_POST['full_name'] ?? '', ENT_QUOTES, 'UTF-8'));
$email     = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone     = trim(htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8'));
$subject   = trim(htmlspecialchars($_POST['subject'] ?? '', ENT_QUOTES, 'UTF-8'));
$message   = trim(htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8'));

$errors = [];

if (strlen($full_name) < 2)                   $errors[] = 'Full name must be at least 2 characters.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
if (strlen($subject) < 3)                      $errors[] = 'Subject must be at least 3 characters.';
if (strlen($message) < 10)                     $errors[] = 'Message must be at least 10 characters.';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// ── Insert into DB ───────────────────────
$conn = getConnection();

// Check for duplicate email
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param('s', $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->close();
    $conn->close();
    echo json_encode(['success' => false, 'errors' => ['This email address has already been submitted.']]);
    exit;
}
$check->close();

$stmt = $conn->prepare(
    "INSERT INTO users (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param('sssss', $full_name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    $id = $stmt->insert_id;
    $stmt->close();
    $conn->close();
    echo json_encode([
        'success' => true,
        'message' => 'Your message has been received!',
        'id'      => $id
    ]);
} else {
    $err = $stmt->error;
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'errors' => ['Database error: ' . $err]]);
}
