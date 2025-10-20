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

$action = $_POST['action'] ?? '';

if ($action === 'create' || $action === 'update') {
    // 1. Ambil semua data dari form
    $id = (int)($_POST['id'] ?? 0);
    $jenis_pelayanan = trim($_POST['jenis_pelayanan'] ?? '');
    $hari = $_POST['hari'] ?? '';
    $jam_mulai = $_POST['jam_mulai'] ?? '';
    $jam_selesai = $_POST['jam_selesai'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');

    // 2. Tentukan aksi berdasarkan nilai $action
    if ($action === 'create') {
        // Jika aksi 'create', jalankan perintah INSERT
        $sql = "INSERT INTO jadwal_pelayanan (jenis_pelayanan, hari, jam_mulai, jam_selesai, keterangan) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$jenis_pelayanan, $hari, $jam_mulai, $jam_selesai, $keterangan]);
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal pelayanan baru berhasil ditambahkan.'];
    } elseif ($action === 'update' && $id > 0) {
        // Jika aksi 'update' dan ada ID, jalankan perintah UPDATE
        $sql = "UPDATE jadwal_pelayanan SET jenis_pelayanan = ?, hari = ?, jam_mulai = ?, jam_selesai = ?, keterangan = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$jenis_pelayanan, $hari, $jam_mulai, $jam_selesai, $keterangan, $id]);
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal pelayanan berhasil diperbarui.'];
    }

    // --- LOGIKA UNTUK MENGHAPUS DATA (Tetap ada) ---
} elseif ($action === 'delete') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM jadwal_pelayanan WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal pelayanan berhasil dihapus.'];
    } else {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'ID tidak valid.'];
    }
}

// Redirect kembali ke halaman daftar setelah aksi selesai
header("Location: jadwal_pelayanan.php");
exit;