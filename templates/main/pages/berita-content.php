<?php
// File: templates/main/pages/berita-content.php
?>
<section id="berita" class="section bg-light py-5">

    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2>Berita Terbaru</h2>
        <p>Informasi seputar kegiatan dan pelayanan Klinik PKU Muhammadiyah Wanareja</p>
    </div>

    <div class="container">
        <div class="row gy-4">

            <?php
            // Ini adalah pengganti dari loop @forelse di Blade
            if (!empty($beritas)):
                $delayCounter = 0; // Pengganti $loop->index untuk delay animasi
                foreach ($beritas as $berita):
            ?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo $delayCounter; ?>">
                <div class="team-member d-flex align-items-start shadow-sm p-3 bg-white rounded h-100">
                    <div class="pic me-3" style="width: 120px; height: 100px; overflow: hidden;">
                        <img src="<?php echo BASE_URL . '/uploads/berita/' . htmlspecialchars($berita->gambar); ?>"
                            class="img-fluid rounded w-100 h-100 object-fit-cover" alt="gambar berita">
                    </div>
                    <div class="member-info">
                        <h5 class="mb-1"><?php echo htmlspecialchars($berita->judul); ?></h5>
                        <p class="text-muted small mb-1">
                            Oleh <?php echo htmlspecialchars($berita->penulis ?? 'Admin'); ?> |
                            <?php
                                    // Pengganti Carbon untuk format tanggal
                                    $date = new DateTime($berita->tanggal_publish);
                                    echo $date->format('d M Y');
                                    ?>
                        </p>
                        <p class="mb-1">
                            <?php
                                    // Pengganti Str::limit dan strip_tags
                                    $cleanContent = strip_tags($berita->konten);
                                    echo limit_text($cleanContent, 15); // Membatasi 15 kata
                                    ?>
                        </p>
                        <a href="berita-detail.php?id=<?php echo $berita->id; ?>"
                            class="text-decoration-none text-primary small">
                            Baca selengkapnya...
                        </a>
                    </div>
                </div>
            </div>
            <?php
                    $delayCounter += 100; // Naikkan delay untuk item berikutnya
                endforeach;
            else:
                // Ini adalah bagian @empty dari Blade
                ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada berita terbaru.</p>
            </div>
            <?php
            endif;
            ?>

        </div>
    </div>

</section>