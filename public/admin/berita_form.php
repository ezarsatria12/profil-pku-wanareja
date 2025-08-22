<?php
// File: public/admin/berita_form.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

// --- LOGIKA UNTUK MENENTUKAN MODE TAMBAH ATAU EDIT ---
$isEdit = false;
$berita = null; // Inisialisasi sebagai null

// Cek apakah ada ID di URL (mode edit)
if (isset($_GET['id'])) {
    $isEdit = true;
    $id = $_GET['id'];

    // Ambil data berita dari database
    $stmt = $pdo->prepare("SELECT * FROM berita WHERE id = ?");
    $stmt->execute([$id]);
    $berita = $stmt->fetch(PDO::FETCH_OBJ);

    // Jika berita dengan ID tersebut tidak ditemukan, hentikan skrip
    if (!$berita) {
        die("Berita tidak ditemukan.");
    }
}

$pageTitle = $isEdit ? 'Edit Berita' : 'Tambah Berita';

// Buat CSRF token untuk keamanan form
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Admin PKU</title>

    <!-- CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
</head>

<body class="bg-light min-vh-100 p-3 p-md-4">
    <div class="container bg-white rounded shadow-sm p-4 position-relative">
        <a href="berita.php" class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-3">
            <i class="material-symbols-rounded align-middle" style="font-size: 1.2rem;">close</i>
        </a>

        <h4 class="mb-4"><?php echo htmlspecialchars($pageTitle); ?></h4>

        <!-- Form akan mengirim data ke file 'berita_action.php' -->
        <form method="POST" action="berita_action.php" enctype="multipart/form-data">
            <!-- Pengganti @csrf -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <!-- Pengganti @method('PUT'), kita gunakan hidden input 'action' -->
            <input type="hidden" name="action" value="<?php echo $isEdit ? 'update' : 'create'; ?>">

            <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?php echo $berita->id; ?>">
            <?php endif; ?>

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required
                    value="<?php echo htmlspecialchars($berita->judul ?? ''); ?>">
            </div>

            <!-- Gambar -->
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control">
                <?php if ($isEdit && !empty($berita->gambar)): ?>
                <div class="mt-2">
                    <small class="d-block">Gambar saat ini:</small>
                    <img src="<?php echo BASE_URL . '/uploads/berita/' . $berita->gambar; ?>" width="150"
                        class="img-thumbnail mt-1">
                    <input type="hidden" name="gambar_lama" value="<?php echo $berita->gambar; ?>">
                </div>
                <?php endif; ?>
            </div>

            <!-- Penulis -->
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" name="penulis" class="form-control"
                    value="<?php echo htmlspecialchars($berita->penulis ?? ''); ?>">
            </div>

            <!-- Tanggal Publish -->
            <div class="mb-3">
                <label class="form-label">Tanggal Publish</label>
                <input type="date" name="tanggal_publish" class="form-control"
                    value="<?php echo isset($berita->tanggal_publish) ? (new DateTime($berita->tanggal_publish))->format('Y-m-d') : date('Y-m-d'); ?>">
            </div>

            <!-- Konten -->
            <div class="mb-4">
                <label class="form-label">Konten</label>
                <textarea name="konten" class="form-control" rows="10"
                    required><?php echo htmlspecialchars($berita->konten ?? ''); ?></textarea>
            </div>

            <!-- Tombol Simpan -->
            <div class="d-flex gap-2">
                <button type="submit" name="status" value="draft" class="btn btn-secondary">
                    <i class="material-symbols-rounded align-middle">save</i> Simpan sebagai Draft
                </button>
                <button type="submit" name="status" value="publish" class="btn btn-primary">
                    <i class="material-symbols-rounded align-middle">publish</i> Simpan & Publish
                </button>
            </div>
        </form>
    </div>
</body>

</html>