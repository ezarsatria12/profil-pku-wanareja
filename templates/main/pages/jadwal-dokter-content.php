<?php
// File: templates/main/pages/jadwal-dokter-content.php
// Tampilan untuk halaman Jadwal Dokter di sisi publik.
?>
<section id="doctors" class="doctors section bg-light">

    <div class="container section-title text-center" data-aos="fade-up">
        <h2>Jadwal Praktik Dokter</h2>
        <p>Temukan jadwal praktik dokter spesialis kami yang siap melayani Anda dengan profesional dan sepenuh hati.</p>
    </div>

    <div class="container">
        <div class="row gy-4">

            <?php if (!empty($jadwalDokter)): ?>
            <?php foreach ($jadwalDokter as $jadwal): ?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="team-member d-flex align-items-start p-3 bg-white rounded shadow-sm h-100">

                    <div class="pic me-3">
                        <?php if (!empty($jadwal->foto)): ?>
                        <img src="<?php echo BASE_URL . '/uploads/dokter/' . htmlspecialchars($jadwal->foto); ?>"
                            class="img-fluid rounded" alt="Foto <?php echo htmlspecialchars($jadwal->nama_dokter); ?>"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <?php else: ?>
                        <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-center"
                            style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill text-secondary" style="font-size: 50px;"></i>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="member-info">
                        <h4><?php echo htmlspecialchars($jadwal->nama_dokter); ?></h4>
                        <span><?php echo htmlspecialchars($jadwal->spesialis); ?></span>
                        <p class="mt-2 mb-1">
                            <strong><?php echo htmlspecialchars($jadwal->hari); ?></strong>, Pukul
                            <?php echo (new DateTime($jadwal->jam_mulai))->format('H:i'); ?> -
                            <?php echo (new DateTime($jadwal->jam_selesai))->format('H:i'); ?>
                        </p>
                        <?php if (!empty($jadwal->keterangan)): ?>
                        <small
                            class="text-muted fst-italic"><?php echo htmlspecialchars($jadwal->keterangan); ?></small>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">Saat ini belum ada jadwal dokter yang tersedia.</div>
            </div>
            <?php endif; ?>

        </div>

        <?php if ($totalPages > 1): ?>
        <div class="d-flex justify-content-center mt-5">
            <?php echo generate_pagination_links($currentPage, $totalPages, 'jadwal_dokter.php'); ?>
        </div>
        <?php endif; ?>

    </div>
</section>