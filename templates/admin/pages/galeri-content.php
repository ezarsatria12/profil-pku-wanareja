<?php
// File: templates/admin/pages/galeri-content.php
// Tampilan untuk daftar gambar galeri di panel admin.
?>
<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <h4 class="mb-2">Daftar Galeri</h4>
    <a href="galeri_form.php" class="btn btn-success">
        <i class="material-symbols-rounded align-middle">add</i> Tambah Galeri
    </a>
</div>

<?php if (isset($flashMessage)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $flashMessage; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>


<?php
// Menggantikan @forelse
if (!empty($galeris)):
    foreach ($galeris as $galeri):
?>
<div class="card mb-3">
    <div class="row g-0 flex-column flex-md-row">
        <div class="col-12 col-md-3">
            <img src="<?php echo BASE_URL . '/uploads/galeri/' . htmlspecialchars($galeri->gambar ?? 'default-image.png'); ?>"
                class="img-fluid rounded-start w-100 h-100 object-fit-cover" style="max-height: 200px;"
                alt="gambar galeri">
        </div>
        <div class="col-12 col-md-9">
            <div class="card-body d-flex flex-column h-100 justify-content-between">
                <div>
                    <h5 class="card-title"><?php echo htmlspecialchars($galeri->judul); ?></h5>
                    <p class="card-text">
                        <?php
                                // Menggantikan Str::limit dan strip_tags
                                echo limit_text($galeri->deskripsi, 20); // Membatasi 20 kata
                                ?>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">Ditambahkan:
                            <?php echo (new DateTime($galeri->created_at))->format('d M Y'); ?></small>
                    </p>
                </div>
                <div class="d-flex gap-2 flex-wrap mt-2">
                    <a href="galeri_form.php?id=<?php echo $galeri->id; ?>"
                        class="btn btn-sm btn-info text-white">Edit</a>
                    <form method="POST" action="galeri_action.php"
                        onsubmit="return confirm('Anda yakin ingin menghapus gambar ini?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $galeri->id; ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    endforeach;
else:
    // Menggantikan @empty
    ?>
<div class="alert alert-info">Belum ada data galeri.</div>
<?php
endif;
?>

<div class="d-flex justify-content-center mt-4">
    <?php
    // Memanggil fungsi pagination yang sudah kita buat
    echo generate_pagination_links($currentPage, $totalPages, 'galeri.php');
    ?>
</div>