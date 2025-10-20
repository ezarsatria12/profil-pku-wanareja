<?php
// File: templates/main/pages/jadwal-dokter-content.php
// Tampilan untuk halaman Jadwal Dokter di sisi publik.
?>
<section id="doctors" class="doctors section bg-light">

    <div class="container section-title text-center" data-aos="fade-up">
        <h2>Jadwal Praktik Dokter</h2>
        <p>Temukan jadwal praktik dokter kami yang siap melayani Anda dengan profesional dan sepenuh hati.</p>
    </div>

    <div class="container">
        <div class="row gy-4">

            <?php if (!empty($daftarDokter)): ?>
            <?php foreach ($daftarDokter as $dokter): ?>
            <div class="col-lg-6" data-aos="fade-up">
                <div class="team-member d-flex align-items-start p-3 bg-white rounded shadow-sm h-100">

                    <div class="me-3 flex-shrink-0">
                        <?php if (!empty($dokter->foto)): ?>
                        <img src="<?php echo BASE_URL . '/uploads/dokter/' . htmlspecialchars($dokter->foto); ?>"
                            class="img-fluid" alt="Foto <?php echo htmlspecialchars($dokter->nama_dokter); ?>"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <?php else: ?>
                        <div class="bg-secondary-subtle d-flex align-items-center justify-content-center"
                            style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill text-secondary" style="font-size: 50px;"></i>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="member-info">
                        <h4><?php echo htmlspecialchars($dokter->nama_dokter); ?></h4>
                        <span class="text-muted"><?php echo htmlspecialchars($dokter->spesialis); ?></span>

                        <div class="mt-2">
                            <?php if (!empty($dokter->jadwal_list)):
                                        $jadwal_items = explode(';', $dokter->jadwal_list);
                                    ?>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($jadwal_items as $item):
                                                list($hari, $mulai, $selesai) = explode('|', $item);
                                            ?>
                                <li>
                                    <small>
                                        <i class="bi bi-calendar-week me-1"></i>
                                        <strong><?php echo htmlspecialchars($hari); ?>:</strong>
                                        <?php echo htmlspecialchars($mulai); ?> -
                                        <?php echo htmlspecialchars($selesai); ?>
                                    </small>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php else: ?>
                            <p class="fst-italic small text-muted mb-0">Jadwal belum tersedia.</p>
                            <?php endif; ?>
                        </div>
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