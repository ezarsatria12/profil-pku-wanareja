<?php
session_start();
require_once __DIR__ . '/../../app/database.php';
// --- PERBAIKAN DI SINI ---
// Anda perlu memuat file functions.php agar fungsi verify_csrf_token() dikenali
require_once __DIR__ . '/../../app/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !verify_csrf_token()) { // Ini adalah baris 6
    die("Invalid request or CSRF token.");
}

$token = $_POST['token'] ?? null;
$password = $_POST['password'] ?? null;
$password_confirm = $_POST['password_confirm'] ?? null;

// 1. Validasi input
if (empty($token) || empty($password) || $password !== $password_confirm) {
    $_SESSION['flash_error'] = "Password tidak cocok atau data tidak lengkap.";
    header('Location: reset-password.php?token=' . urlencode($token));
    exit;
}

// 2. Validasi ulang token
$token_hash = hash('sha256', $token);
$stmt = $pdo->prepare("SELECT id FROM user WHERE reset_token = ? AND reset_token_expires_at > NOW()");
$stmt->execute([$token_hash]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION['flash_error'] = "Token tidak valid atau sudah kedaluwarsa.";
    header('Location: reset-password.php?token=' . urlencode($token));
    exit;
}

// 3. Update password
$new_password_hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE user SET password = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?");
$stmt->execute([$new_password_hash, $user['id']]);

// 4. Redirect ke login dengan pesan sukses
$_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Password Anda berhasil direset. Silakan login.'];
header('Location: login.php');
exit;