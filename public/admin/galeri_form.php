<?php
// File: public/admin/galeri_form.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../app/database.php';

// --- LOGIKA UNTUK MENENTUKAN MODE TAMBAH ATAU EDIT ---
$isEdit = false;
$galeri = null;

if (isset($_GET['id'])) {
    $isEdit = true;
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM galeri WHERE id = ?");
    $stmt->execute([$id]);
    $galeri = $stmt->fetch(PDO::FETCH_OBJ);
    if (!$galeri) {
        die("Gambar galeri tidak ditemukan.");
    }
}

$pageTitle = $isEdit ? 'Edit Gambar Galeri' : 'Tambah Gambar Baru';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Admin PKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
</head>

<body class="bg-light min-vh-100 p-3 p-md-4">
    <div class="container bg-white rounded shadow-sm p-4 position-relative">
        <a href="galeri.php" class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-3">
            <i class="material-symbols-rounded align-middle" style="font-size: 1.2rem;">close</i> Tutup
        </a>

        <h4 class="mb-4"><?php echo htmlspecialchars($pageTitle); ?></h4>

        <form method="POST" action="galeri_action.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <input type="hidden" name="action" value="<?php echo $isEdit ? 'update' : 'create'; ?>">

            <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?php echo $galeri->id; ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Judul Gambar</label>
                <input type="text" name="judul" class="form-control" required
                    value="<?php echo htmlspecialchars($galeri->judul ?? ''); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">File Gambar</label>
                <input type="file" name="gambar" class="form-control" <?php echo !$isEdit ? 'required' : ''; ?>>
                <small class="form-text text-muted">Wajib diisi saat menambah baru. Kosongkan jika tidak ingin mengubah
                    gambar saat edit.</small>

                <?php if ($isEdit && !empty($galeri->gambar)): ?>
                <div class="mt-2">
                    <small>Gambar saat ini:</small><br>
                    <img src="<?php echo BASE_URL . '/uploads/galeri/' . htmlspecialchars($galeri->gambar); ?>"
                        width="150" class="img-thumbnail mt-1">
                    <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($galeri->gambar); ?>">
                </div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" class="form-control"
                    rows="4"><?php echo htmlspecialchars($galeri->deskripsi ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="material-symbols-rounded align-middle">save</i> Simpan
            </button>
        </form>
    </div>
</body>

</html>