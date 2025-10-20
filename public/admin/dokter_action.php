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

$id = (int)($_POST['id'] ?? 0);
$nama_dokter = trim($_POST['nama_dokter'] ?? '');
$spesialis = trim($_POST['spesialis'] ?? '');
$foto_lama = $_POST['foto_lama'] ?? null;
$namaFileFoto = $foto_lama; // Inisialisasi dengan nama foto lama

// --- Logika Upload Foto (Sudah Diperbaiki) ---
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../uploads/dokter/';
    $file = $_FILES['foto'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    if (in_array($file['type'], $allowedTypes)) {
        // Hapus foto lama HANYA JIKA ada file baru yang valid diupload
        if ($foto_lama && file_exists($uploadDir . $foto_lama)) {
            unlink($uploadDir . $foto_lama);
        }

        $namaFileFoto = uniqid('dokter-') . '-' . basename($file['name']);
        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $namaFileFoto)) {
            // Jika gagal upload, jangan lanjutkan, beri pesan error
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Gagal mengunggah foto.'];
            header('Location: jadwal_dokter.php');
            exit;
        }
    }
    // Jika format file tidak valid, kita tetap lanjut TAPI menggunakan foto lama ($namaFileFoto tidak diubah)
    // Anda bisa menambahkan pesan error di sini jika mau
}

// --- Logika Database (Sudah Diperbaiki) ---
$pdo->beginTransaction(); // Mulai transaksi untuk menjaga integritas data

try {
    if ($id > 0) { // Mode Update
        $sql = "UPDATE dokter SET nama_dokter = ?, spesialis = ?, foto = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$nama_dokter, $spesialis, $namaFileFoto, $id]);

        $dokter_id = $id;
        $stmt = $pdo->prepare("SELECT foto FROM dokter WHERE id = ?");
        $stmt->execute([$id]);
        $namaFileFoto = $stmt->fetchColumn();

        // 2. Hapus record dari tabel `dokter`
        // (Jadwal di tabel `jadwal_praktik` akan terhapus otomatis karena ON DELETE CASCADE)
        $stmt = $pdo->prepare("DELETE FROM dokter WHERE id = ?");
        $stmt->execute([$id]);

        // 3. Hapus file foto fisik dari server jika ada
        if ($namaFileFoto && file_exists($uploadDir . $namaFileFoto)) {
            unlink($uploadDir . $namaFileFoto);
        }

        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Dokter dan semua jadwalnya berhasil dihapus.'];
    } else { // Mode Create
        // 1. Masukkan data ke tabel `dokter`
        $stmt = $pdo->prepare("INSERT INTO dokter (nama_dokter, spesialis, foto) VALUES (?, ?, ?)");
        $stmt->execute([$nama_dokter, $spesialis, $namaFileFoto]);
        $dokter_id = $pdo->lastInsertId();
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Dokter baru berhasil ditambahkan.'];
    }

    // 3. Masukkan kembali semua jadwal yang ada di form
    if (!empty($_POST['jadwal_hari'])) {
        $stmt = $pdo->prepare("INSERT INTO jadwal_praktik (dokter_id, hari, jam_mulai, jam_selesai) VALUES (?, ?, ?, ?)");
        foreach ($_POST['jadwal_hari'] as $key => $hari) {
            if (!empty($hari)) {
                $jam_mulai = $_POST['jadwal_jam_mulai'][$key];
                $jam_selesai = $_POST['jadwal_jam_selesai'][$key];
                $stmt->execute([$dokter_id, $hari, $jam_mulai, $jam_selesai]);
            }
        }
    } 
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            // 1. Ambil nama file foto sebelum menghapus dari database
            $stmt = $pdo->prepare("SELECT foto FROM dokter WHERE id = ?");
            $stmt->execute([$id]);
            $namaFileFoto = $stmt->fetchColumn();

            // 2. Hapus record dari tabel `dokter`
            // (Jadwal di tabel `jadwal_praktik` akan terhapus otomatis karena ON DELETE CASCADE)
            $stmt = $pdo->prepare("DELETE FROM dokter WHERE id = ?");
            $stmt->execute([$id]);

            // 3. Hapus file foto fisik dari server jika ada
            if ($namaFileFoto && file_exists($uploadDir . $namaFileFoto)) {
                unlink($uploadDir . $namaFileFoto);
            }

            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Dokter dan semua jadwalnya berhasil dihapus.'];
        }
    }

    $pdo->commit(); // Konfirmasi semua perubahan jika berhasil

} catch (Exception $e) {
    $pdo->rollBack(); // Batalkan semua perubahan jika terjadi error
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
}

// Setelah semua aksi selesai, arahkan kembali ke halaman daftar
header('Location: jadwal_dokter.php');
exit();