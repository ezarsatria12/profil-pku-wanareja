<?php
// File: public/admin/jadwal_dokter_action.php
// File ini adalah "otak" untuk semua aksi CRUD Jadwal Dokter.

session_start();
// Keamanan: Pastikan hanya user yang sudah login yang bisa mengakses.
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit("Akses dilarang.");
}

// Muat semua file inti aplikasi
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
        // --- AKSI: MEMBUAT JADWAL BARU (PENGGANTI store()) ---
        case 'create':
            // Validasi sederhana (di dunia nyata, tambahkan lebih banyak)
            if (empty($_POST['nama_dokter']) || empty($_POST['hari']) || empty($_POST['jam_mulai']) || empty($_POST['jam_selesai'])) {
                die("Data tidak lengkap.");
            }

            $stmt = $pdo->prepare(
                "INSERT INTO jadwal_dokter (nama_dokter, spesialis, hari, jam_mulai, jam_selesai, keterangan) VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $_POST['nama_dokter'],
                $_POST['spesialis'],
                $_POST['hari'],
                $_POST['jam_mulai'],
                $_POST['jam_selesai'],
                $_POST['keterangan']
            ]);
            $_SESSION['flash_message'] = 'Jadwal dokter baru berhasil ditambahkan.';
            break;

        // --- AKSI: MEMPERBARUI JADWAL (PENGGANTI update()) ---
        case 'update':
            if (empty($_POST['id']) || empty($_POST['nama_dokter']) || empty($_POST['hari']) || empty($_POST['jam_mulai']) || empty($_POST['jam_selesai'])) {
                die("Data tidak lengkap.");
            }

            $stmt = $pdo->prepare(
                "UPDATE jadwal_dokter SET nama_dokter = ?, spesialis = ?, hari = ?, jam_mulai = ?, jam_selesai = ?, keterangan = ? WHERE id = ?"
            );
            $stmt->execute([
                $_POST['nama_dokter'],
                $_POST['spesialis'],
                $_POST['hari'],
                $_POST['jam_mulai'],
                $_POST['jam_selesai'],
                $_POST['keterangan'],
                $_POST['id']
            ]);
            $_SESSION['flash_message'] = 'Jadwal dokter berhasil diperbarui.';
            break;

        // --- AKSI: MENGHAPUS JADWAL (PENGGANTI destroy()) ---
        case 'delete':
            if (empty($_POST['id'])) {
                die("ID tidak ditemukan.");
            }
            $stmt = $pdo->prepare("DELETE FROM jadwal_dokter WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $_SESSION['flash_message'] = 'Jadwal dokter berhasil dihapus.';
            break;
    }
}

// Setelah semua aksi selesai, arahkan kembali ke halaman daftar
header('Location: jadwal_dokter.php');
exit();