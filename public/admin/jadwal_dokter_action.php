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

// Mulai transaksi database
$pdo->beginTransaction();

try {
    // --- AKSI: MEMBUAT ATAU MEMPERBARUI ---
    if ($action === 'create' || $action === 'update') {

        $id = (int)($_POST['id'] ?? 0);
        $nama_dokter = trim($_POST['nama_dokter'] ?? '');
        $spesialis = trim($_POST['spesialis'] ?? '');
        $foto_lama = $_POST['foto_lama'] ?? null;
        $namaFileFoto = $foto_lama;

        // Logika Upload Foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (in_array($file['type'], $allowedTypes)) {
                if ($foto_lama && file_exists($uploadDir . $foto_lama)) {
                    unlink($uploadDir . $foto_lama);
                }
                $namaFileFoto = uniqid('dokter-') . '-' . basename($file['name']);
                move_uploaded_file($file['tmp_name'], $uploadDir . $namaFileFoto);
            }
        }

        if ($action === 'update' && $id > 0) {
            // 1. Perbarui data di tabel `dokter`
            $stmt = $pdo->prepare("UPDATE dokter SET nama_dokter = ?, spesialis = ?, foto = ? WHERE id = ?");
            $stmt->execute([$nama_dokter, $spesialis, $namaFileFoto, $id]);
            $dokter_id = $id;

            // 2. Hapus HANYA JADWAL lama untuk sinkronisasi
            $stmt = $pdo->prepare("DELETE FROM jadwal_praktik WHERE dokter_id = ?");
            $stmt->execute([$dokter_id]);

            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Data dokter berhasil diperbarui.'];
        } else { // Mode Create
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

        // --- AKSI: MENGHAPUS DOKTER ---
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $stmt = $pdo->prepare("SELECT foto FROM dokter WHERE id = ?");
            $stmt->execute([$id]);
            $namaFileFoto = $stmt->fetchColumn();

            // Hapus record dari tabel `dokter`. 
            // Jadwal di `jadwal_praktik` akan terhapus otomatis karena ON DELETE CASCADE.
            $stmt = $pdo->prepare("DELETE FROM dokter WHERE id = ?");
            $stmt->execute([$id]);

            if ($namaFileFoto && file_exists($uploadDir . $namaFileFoto)) {
                unlink($uploadDir . $namaFileFoto);
            }

            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Dokter dan semua jadwalnya berhasil dihapus.'];
        }
    }

    $pdo->commit(); // Konfirmasi semua perubahan jika berhasil

} catch (Exception $e) {
    $pdo->rollBack(); // Batalkan semua perubahan jika terjadi error
    $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Terjadi kesalahan database: ' . $e->getMessage()];
}

// Setelah semua aksi selesai, arahkan kembali ke halaman daftar
header('Location: jadwal_dokter.php');
exit();