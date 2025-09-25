<?php
// File: templates/main/pages/struktur-organisasi-content.php
?>
<section id="struktur-organisasi" class="services section">

    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2>Struktur Organisasi</h2>
        <p>Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja</p>
    </div>
    <div class="container">

        <div class="row gy-4 justify-content-center text-center">
            <?php if (!empty($strukturImage)): ?>
            <img src="<?php echo BASE_URL . '/uploads/profil/' . htmlspecialchars($strukturImage); ?>"
                alt="Bagan Struktur Organisasi Klinik PKU Muhammadiyah Wanareja" data-aos="fade-in" class="img-fluid"
                style="max-width: 900px; height: auto; border: 1px solid #eee; padding: 10px;">
            <?php else: ?>
            <p data-aos="fade-in" class="text-muted">Gambar struktur organisasi belum tersedia.</p>
            <?php endif; ?>
        </div>

    </div>

</section>