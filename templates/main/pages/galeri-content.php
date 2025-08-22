<?php
// File: templates/main/pages/galeri-content.php
?>
<section id="gallery" class="gallery section bg-light py-5">

    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2>Galeri</h2>
        <p>Dokumentasi kegiatan dan fasilitas Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja</p>
    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-0">

            <?php if (!empty($galeris)): ?>
            <?php foreach ($galeris as $galeri): ?>
            <div class="col-lg-3 col-md-4">
                <div class="gallery-item position-relative">
                    <a href="<?php echo BASE_URL . '/uploads/galeri/' . htmlspecialchars($galeri->gambar); ?>"
                        class="glightbox" data-gallery="galeri-images"
                        data-title="<?php echo htmlspecialchars($galeri->judul); ?>"
                        data-description="<?php echo htmlspecialchars($galeri->deskripsi); ?>">
                        <img src="<?php echo BASE_URL . '/uploads/galeri/' . htmlspecialchars($galeri->gambar); ?>"
                            alt="<?php echo htmlspecialchars($galeri->judul); ?>" class="img-fluid">
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data galeri tersedia.</p>
            </div>
            <?php endif; ?>

        </div>

        <div class="mt-4 d-flex justify-content-center">
            <?php
            // Memanggil fungsi pagination yang sudah kita buat
            echo generate_pagination_links($currentPage, $totalPages, 'galeri.php');
            ?>
        </div>
    </div>
</section>