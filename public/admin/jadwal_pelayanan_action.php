<?php
// File: public/admin/jadwal_pelayanan_action.php
// File ini memproses semua aksi CRUD untuk Jadwal Pelayanan.

session_start();
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit("Akses dilarang.");
}

require_once __DIR__ . '/../../app/database.php';

// Ambil aksi dari POST atau GET
$action = $_POST['action'] ?? null;

// Routing aksi berdasarkan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    switch ($action) {
        // Aksi untuk membuat jadwal baru
        case 'create':
            $stmt = $pdo->prepare(
                "INSERT INTO jadwal_pelayanan (hari, jenis_pelayanan, jam_mulai, jam_selesai, keterangan) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $_POST['hari'],
                $_POST['jenis_pelayanan'],
                $_POST['jam_mulai'],
                $_POST['jam_selesai'],
                $_POST['keterangan']
            ]);
            $_SESSION['flash_message'] = 'Jadwal pelayanan baru berhasil ditambahkan.';
            break;

        // Aksi untuk memperbarui jadwal
        case 'update':
            $stmt = $pdo->prepare(
                "UPDATE jadwal_pelayanan SET hari = ?, jenis_pelayanan = ?, jam_mulai = ?, jam_selesai = ?, keterangan = ? WHERE id = ?"
            );
            $stmt->execute([
                $_POST['hari'],
                $_POST['jenis_pelayanan'],
                $_POST['jam_mulai'],
                $_POST['jam_selesai'],
                $_POST['keterangan'],
                $_POST['id']
            ]);
            $_SESSION['flash_message'] = 'Jadwal pelayanan berhasil diperbarui.';
            break;

        // Aksi untuk menghapus jadwal
        case 'delete':
            $stmt = $pdo->prepare("DELETE FROM jadwal_pelayanan WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $_SESSION['flash_message'] = 'Jadwal pelayanan berhasil dihapus.';
            break;
    }
}

// Setelah aksi selesai, arahkan kembali ke halaman daftar
header('Location: jadwal_pelayanan.php');
exit();