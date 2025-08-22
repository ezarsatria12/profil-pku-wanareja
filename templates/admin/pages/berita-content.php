<?php
// File: templates/admin/pages/berita-content.php
// Tampilan untuk daftar berita di panel admin dengan layout kartu.
?>
<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <h4 class="mb-2">Daftar Berita</h4>
    <a href="berita_form.php" class="btn btn-success">
        <i class="material-symbols-rounded align-middle">add</i> Tambah Berita Baru
    </a>
</div>

<!-- Menampilkan flash message jika ada -->
<?php if (isset($flashMessage)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $flashMessage; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>


<?php
// Menggantikan @forelse
if (!empty($beritas)):
    foreach ($beritas as $berita):
?>
<div class="card mb-3">
    <div class="row g-0 flex-column flex-md-row">
        <div class="col-12 col-md-3">
            <!-- Menampilkan gambar dengan fallback ke gambar default -->
            <img src="<?php echo BASE_URL . '/uploads/berita/' . htmlspecialchars($berita->gambar ?? 'default-berita.jpg'); ?>"
                class="img-fluid rounded-start w-100 h-100 object-fit-cover" style="min-height: 180px;"
                alt="gambar berita">
        </div>
        <div class="col-12 col-md-9">
            <div class="card-body d-flex flex-column h-100 justify-content-between">
                <div>
                    <h5 class="card-title"><?php echo htmlspecialchars($berita->judul); ?></h5>
                    <p class="card-text">
                        <?php
                                // Menggantikan Str::limit dan strip_tags
                                echo limit_text($berita->konten, 25); // Membatasi 25 kata
                                ?>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            Oleh: <?php echo htmlspecialchars($berita->penulis ?? 'Admin'); ?> |
                            Tanggal: <?php echo (new DateTime($berita->tanggal_publish))->format('d M Y'); ?>
                        </small>
                    </p>
                </div>
                <div class="d-flex gap-2 flex-wrap mt-3">
                    <!-- Tombol Toggle Status (diubah menjadi link) -->
                    <a href="berita_action.php?action=toggle&id=<?php echo $berita->id; ?>"
                        class="btn btn-sm <?php echo ($berita->status === 'publish') ? 'btn-warning' : 'btn-primary'; ?>">
                        <?php echo ($berita->status === 'publish') ? 'Unpublish' : 'Publish'; ?>
                    </a>

                    <!-- Tombol Edit -->
                    <a href="berita_form.php?id=<?php echo $berita->id; ?>"
                        class="btn btn-sm btn-info text-white">Edit</a>

                    <!-- Tombol Hapus (menggunakan form) -->
                    <form method="POST" action="berita_action.php"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $berita->id; ?>">
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
<div class="alert alert-info">Belum ada berita.</div>
<?php
endif;
?>

<!-- PAGINATION -->
<div class="d-flex justify-content-center mt-4">
    <?php
    // Memanggil fungsi pagination yang sudah kita buat
    echo generate_pagination_links($currentPage, $totalPages, 'berita.php');
    ?>
</div>