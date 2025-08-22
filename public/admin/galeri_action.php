<?php
// File: public/admin/galeri_action.php
// "Controller" untuk semua aksi CRUD Galeri.

session_start();
// Keamanan: Pastikan hanya user yang sudah login yang bisa mengakses.
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit("Akses dilarang.");
}

// Muat semua file inti aplikasi
require_once __DIR__ . '/../../app/database.php';

// Tentukan direktori upload
$uploadDir = __DIR__ . '/../../public/uploads/galeri/';
// Buat direktori jika belum ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Ambil aksi dari form
$action = $_POST['action'] ?? null;

// Routing aksi berdasarkan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    switch ($action) {
        // --- AKSI: MEMBUAT GAMBAR BARU (PENGGANTI store()) ---
        case 'create':
            // Validasi sederhana
            if (empty($_POST['judul']) || !isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['flash_message'] = 'Judul dan Gambar wajib diisi.';
                header('Location: galeri_form.php'); // Kembali ke form jika error
                exit();
            }

            // Proses upload gambar
            $fileName = uniqid() . '-' . basename($_FILES['gambar']['name']);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $fileName);

            // Simpan ke database
            $stmt = $pdo->prepare("INSERT INTO galeri (judul, deskripsi, gambar) VALUES (?, ?, ?)");
            $stmt->execute([$_POST['judul'], $_POST['deskripsi'], $fileName]);

            $_SESSION['flash_message'] = 'Gambar baru berhasil ditambahkan ke galeri.';
            break;

        // --- AKSI: MEMPERBARUI GAMBAR (PENGGANTI update()) ---
        case 'update':
            $id = $_POST['id'];
            $gambar = $_POST['gambar_lama'] ?? null;

            // Cek jika ada file gambar baru yang diupload
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                // Hapus gambar lama dari server jika ada
                if ($gambar && file_exists($uploadDir . $gambar)) {
                    unlink($uploadDir . $gambar);
                }
                // Upload gambar yang baru
                $gambar = uniqid() . '-' . basename($_FILES['gambar']['name']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambar);
            }

            // Update record di database
            $stmt = $pdo->prepare("UPDATE galeri SET judul = ?, deskripsi = ?, gambar = ? WHERE id = ?");
            $stmt->execute([$_POST['judul'], $_POST['deskripsi'], $gambar, $id]);

            $_SESSION['flash_message'] = 'Data galeri berhasil diperbarui.';
            break;

        // --- AKSI: MENGHAPUS GAMBAR (PENGGANTI destroy()) ---
        case 'delete':
            $id = $_POST['id'];

            // Ambil nama file gambar dari DB untuk dihapus dari server
            $stmt = $pdo->prepare("SELECT gambar FROM galeri WHERE id = ?");
            $stmt->execute([$id]);
            $gambar = $stmt->fetchColumn();

            // Hapus file gambar dari folder uploads jika ada
            if ($gambar && file_exists($uploadDir . $gambar)) {
                unlink($uploadDir . $gambar);
            }

            // Hapus record dari database
            $stmt = $pdo->prepare("DELETE FROM galeri WHERE id = ?");
            $stmt->execute([$id]);

            $_SESSION['flash_message'] = 'Gambar berhasil dihapus dari galeri.';
            break;
    }
}

// Setelah semua aksi selesai, arahkan kembali ke halaman daftar galeri
header('Location: galeri.php');
exit();