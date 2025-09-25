<?php
session_start();

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/database.php';

// Hanya izinkan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: jadwal_pelayanan.php");
    exit;
}

// Verifikasi CSRF Token
if (!verify_csrf_token()) {
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Invalid CSRF token. Aksi dibatalkan.'];
    header("Location: jadwal_pelayanan.php");
    exit;
}

// Proses Hapus
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM jadwal_pelayanan WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal pelayanan berhasil dihapus.'];
    } else {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'ID tidak valid.'];
    }
}

header("Location: jadwal_pelayanan.php");
exit;