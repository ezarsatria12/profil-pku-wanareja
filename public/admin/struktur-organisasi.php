<?php
// Mulai session untuk menangani pesan notifikasi
session_start();

// Muat file inti
require_once __DIR__ . '/../../app/bootstrap.php';
// Panggil file database agar variabel global $pdo tersedia
require_once __DIR__ . '/../../app/database.php';

$uploadDir = __DIR__ . '/../uploads/profil/';
$pageTitle = 'Kelola Struktur Organisasi';
$contentView = 'admin/pages/struktur-organisasi-content.php';

// --- LOGIKA UPLOAD GAMBAR (METHOD POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['struktur_image']) && $_FILES['struktur_image']['error'] === UPLOAD_ERR_OK) {

        $file = $_FILES['struktur_image'];
        $fileName = uniqid() . '-' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;

        // Validasi tipe file (opsional tapi disarankan)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (in_array($file['type'], $allowedTypes)) {

            // Pindahkan file yang di-upload
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Update nama file di database
                $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'struktur_organisasi_img'");
                $stmt->execute([$fileName]);

                $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Gambar berhasil diperbarui.'];
            } else {
                $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Gagal memindahkan file.'];
            }
        } else {
            $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Format file tidak valid. Harap unggah gambar (JPG, PNG, GIF, WebP).'];
        }
    } else {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Terjadi kesalahan saat mengunggah file.'];
    }

    // Redirect kembali ke halaman yang sama untuk mencegah re-submit
    header("Location: struktur-organisasi.php");
    exit;
}

// --- AMBIL DATA GAMBAR SAAT INI (METHOD GET) ---
$stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'struktur_organisasi_img'");
$currentImage = $stmt->fetchColumn();


// Panggil kerangka utama admin
include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';