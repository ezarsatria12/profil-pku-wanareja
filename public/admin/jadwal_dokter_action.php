<?php
// File: public/admin/jadwal_dokter_action.php
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
$uploadDir = __DIR__ . '/../uploads/dokter/';

// Pastikan folder upload ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// --- AKSI: MEMBUAT ATAU MEMPERBARUI ---
if ($action === 'create' || $action === 'update') {
    $id = (int)($_POST['id'] ?? 0);
    $nama_dokter = trim($_POST['nama_dokter'] ?? '');
    $spesialis = trim($_POST['spesialis'] ?? '');
    $hari = $_POST['hari'] ?? 'Senin';
    $jam_mulai = $_POST['jam_mulai'] ?? '00:00';
    $jam_selesai = $_POST['jam_selesai'] ?? '00:00';
    $keterangan = trim($_POST['keterangan'] ?? '');
    $foto_lama = $_POST['foto_lama'] ?? null;
    $namaFileFoto = $foto_lama;

    // --- Logika Upload Foto ---
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['foto'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (in_array($file['type'], $allowedTypes)) {
            // Hapus foto lama jika ada dan file baru diupload
            if ($foto_lama && file_exists($uploadDir . $foto_lama)) {
                unlink($uploadDir . $foto_lama);
            }

            $namaFileFoto = uniqid('dokter-') . '-' . basename($file['name']);
            if (!move_uploaded_file($file['tmp_name'], $uploadDir . $namaFileFoto)) {
                $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Gagal mengunggah foto.'];
                header('Location: jadwal_dokter.php');
                exit;
            }
        } else {
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Format file foto tidak valid (hanya JPG, PNG, WebP).'];
            header('Location: jadwal_dokter_form.php' . ($id ? '?id=' . $id : ''));
            exit;
        }
    }

    // --- Logika Database ---
    if ($action === 'create') {
        $sql = "INSERT INTO jadwal_dokter (nama_dokter, foto, spesialis, hari, jam_mulai, jam_selesai, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_dokter, $namaFileFoto, $spesialis, $hari, $jam_mulai, $jam_selesai, $keterangan]);
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal dokter berhasil ditambahkan.'];
    } elseif ($action === 'update' && $id > 0) {
        $sql = "UPDATE jadwal_dokter SET nama_dokter = ?, foto = ?, spesialis = ?, hari = ?, jam_mulai = ?, jam_selesai = ?, keterangan = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_dokter, $namaFileFoto, $spesialis, $hari, $jam_mulai, $jam_selesai, $keterangan, $id]);
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal dokter berhasil diperbarui.'];
    }

    // --- AKSI: MENGHAPUS JADWAL ---
} elseif ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        // Ambil nama file foto sebelum menghapus record dari database
        $stmt = $pdo->prepare("SELECT foto FROM jadwal_dokter WHERE id = ?");
        $stmt->execute([$id]);
        $namaFileFoto = $stmt->fetchColumn();

        // Hapus record dari database
        $stmt = $pdo->prepare("DELETE FROM jadwal_dokter WHERE id = ?");
        $stmt->execute([$id]);

        // Jika ada nama filenya, hapus file fisik dari server
        if ($namaFileFoto && file_exists($uploadDir . $namaFileFoto)) {
            unlink($uploadDir . $namaFileFoto);
        }

        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Jadwal dokter berhasil dihapus.'];
    }
}

// Setelah semua aksi selesai, arahkan kembali ke halaman daftar
header('Location: jadwal_dokter.php');
exit();