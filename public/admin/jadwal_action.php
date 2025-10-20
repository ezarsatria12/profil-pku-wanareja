<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit("Akses dilarang.");
}

require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

// Keamanan: Hanya izinkan metode POST dan verifikasi CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }
}
$action = $_POST['action'] ?? '';
$jadwal_id = (int)($_POST['jadwal_id'] ?? 0);
$dokter_id = (int)($_POST['dokter_id'] ?? 0); // Diperlukan untuk redirect kembali

if ($action === 'delete' && $jadwal_id > 0) {
    $stmt = $pdo->prepare("DELETE FROM jadwal_praktik WHERE id = ?");
    $stmt->execute([$jadwal_id]);
    $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Satu jadwal berhasil dihapus.'];
}

// Redirect kembali ke halaman form edit dokter yang bersangkutan
header('Location: dokter_form.php?id=' . $dokter_id);
exit;