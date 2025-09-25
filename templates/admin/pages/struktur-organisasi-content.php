<?php
// Ambil dan hapus flash message dari session agar hanya tampil sekali
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo htmlspecialchars($pageTitle); ?></h1>

    <?php if (isset($flashMessage)): ?>
    <div class="alert alert-<?php echo $flashMessage['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($flashMessage['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upload Gambar Baru</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="struktur-organisasi.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="strukturImage" class="form-label">Pilih File Gambar</label>
                            <input class="form-control" type="file" id="strukturImage" name="struktur_image"
                                accept="image/png, image/jpeg, image/gif, image/webp" required>
                            <div class="form-text">Pilih gambar dengan format JPG, PNG, GIF, atau WebP. Disarankan
                                gambar memiliki orientasi landscape/melebar.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-2"></i>Unggah & Simpan
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <h6 class="text-center">Gambar Saat Ini:</h6>
                    <?php if (!empty($currentImage)): ?>
                    <img src="<?php echo BASE_URL . '/uploads/profil/' . htmlspecialchars($currentImage); ?>"
                        alt="Struktur Organisasi Saat Ini" class="img-fluid rounded border p-2">
                    <?php else: ?>
                    <p class="text-center text-muted">Belum ada gambar yang diunggah.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>