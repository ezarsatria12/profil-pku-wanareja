<?php
// File: public/admin/berita_action.php
// File ini adalah "otak" untuk semua aksi CRUD Berita.

session_start();
// Keamanan: Pastikan hanya user yang sudah login yang bisa mengakses.
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada session, mungkin diakses langsung. Hentikan.
    header("HTTP/1.1 403 Forbidden");
    exit("Akses dilarang.");
}

// Muat semua file inti aplikasi
require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

// Tentukan aksi berdasarkan parameter GET atau POST
$action = $_POST['action'] ?? $_GET['action'] ?? null;

// --- FUNGSI BANTUAN UNTUK UPLOAD GAMBAR ---
function handleImageUpload($fileInfo, $oldImage = null)
{
    $uploadDir = __DIR__ . '/../../public/uploads/berita/';

    // Buat direktori jika belum ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Cek apakah ada file baru yang diupload dan valid
    if (isset($fileInfo) && $fileInfo['error'] === UPLOAD_ERR_OK) {
        // Hapus gambar lama jika ada
        if ($oldImage && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
        }

        // Buat nama file yang unik
        $fileName = uniqid() . '-' . basename($fileInfo['name']);
        $targetFile = $uploadDir . $fileName;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($fileInfo['tmp_name'], $targetFile)) {
            return $fileName; // Kembalikan nama file baru jika berhasil
        }
    }
    return $oldImage; // Kembalikan nama file lama jika tidak ada upload baru
}


// Gunakan switch untuk routing aksi
switch ($action) {
    // --- AKSI: MEMBUAT BERITA BARU (PENGGANTI store()) ---
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi CSRF
            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            // Ambil data dari form
            $judul = $_POST['judul'];
            $konten = $_POST['konten'];
            $penulis = $_POST['penulis'] ?? 'Admin';
            $tanggal_publish = $_POST['tanggal_publish'] ?? date('Y-m-d');
            $status = $_POST['status'] ?? 'draft';
            $slug = create_slug($judul);

            // Proses upload gambar
            $gambar = handleImageUpload($_FILES['gambar']);

            // Simpan ke database
            $stmt = $pdo->prepare(
                "INSERT INTO berita (judul, slug, konten, gambar, penulis, tanggal_publish, status) VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([$judul, $slug, $konten, $gambar, $penulis, $tanggal_publish, $status]);

            // Set pesan sukses dan redirect
            $_SESSION['flash_message'] = 'Berita baru berhasil ditambahkan.';
            header('Location: berita.php');
            exit();
        }
        break;

    // --- AKSI: MEMPERBARUI BERITA (PENGGANTI update()) ---
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi CSRF
            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            // Ambil data dari form
            $id = $_POST['id'];
            $judul = $_POST['judul'];
            $konten = $_POST['konten'];
            $penulis = $_POST['penulis'] ?? 'Admin';
            $tanggal_publish = $_POST['tanggal_publish'] ?? date('Y-m-d');
            $status = $_POST['status'] ?? 'draft';
            $slug = create_slug($judul);
            $gambar_lama = $_POST['gambar_lama'] ?? null;

            // Proses upload gambar (jika ada yang baru)
            $gambar = handleImageUpload($_FILES['gambar'], $gambar_lama);

            // Update database
            $stmt = $pdo->prepare(
                "UPDATE berita SET judul = ?, slug = ?, konten = ?, gambar = ?, penulis = ?, tanggal_publish = ?, status = ? WHERE id = ?"
            );
            $stmt->execute([$judul, $slug, $konten, $gambar, $penulis, $tanggal_publish, $status, $id]);

            // Set pesan sukses dan redirect
            $_SESSION['flash_message'] = 'Berita berhasil diperbarui.';
            header('Location: berita.php');
            exit();
        }
        break;

    // --- AKSI: MENGHAPUS BERITA (PENGGANTI destroy()) ---
    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            // Ambil nama gambar untuk dihapus dari server
            $stmt = $pdo->prepare("SELECT gambar FROM berita WHERE id = ?");
            $stmt->execute([$id]);
            $gambar = $stmt->fetchColumn();

            // Hapus gambar dari folder uploads
            if ($gambar) {
                $filePath = __DIR__ . '/../../public/uploads/berita/' . $gambar;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus record dari database
            $stmt = $pdo->prepare("DELETE FROM berita WHERE id = ?");
            $stmt->execute([$id]);

            // Set pesan sukses dan redirect
            $_SESSION['flash_message'] = 'Berita berhasil dihapus.';
            header('Location: berita.php');
            exit();
        }
        break;

    // --- AKSI: MENGUBAH STATUS (PENGGANTI toggleStatus()) ---
    case 'toggle':
        $id = $_GET['id'];

        // Ambil status saat ini
        $stmt = $pdo->prepare("SELECT status FROM berita WHERE id = ?");
        $stmt->execute([$id]);
        $currentStatus = $stmt->fetchColumn();

        // Balik statusnya
        $newStatus = ($currentStatus === 'publish') ? 'draft' : 'publish';

        // Update status di database
        $stmt = $pdo->prepare("UPDATE berita SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);

        // Set pesan sukses dan redirect
        $_SESSION['flash_message'] = 'Status berita berhasil diubah.';
        header('Location: berita.php');
        exit();
        break;

    // --- AKSI DEFAULT JIKA TIDAK ADA YANG COCOK ---
    default:
        // Jika tidak ada aksi yang valid, kembalikan ke halaman daftar
        $_SESSION['flash_message'] = 'Aksi tidak valid.';
        header('Location: berita.php');
        exit();
}