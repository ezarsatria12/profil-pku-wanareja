<?php
// File: templates/main/pages/home-content.php
// File ini hanya berisi HTML untuk konten unik halaman beranda.
?>
<section id="hero" class="hero section position-relative">

    <div id="heroCarousel" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100"
        data-bs-ride="carousel">
        <div class="carousel-inner h-100">

            <div class="carousel-item active h-100">
                <img src="https://rsud-soekarno.babelprov.go.id/sites/default/files/images/gedung%20rs.jpg"
                    class="d-block w-100 h-100 object-fit-cover" alt="Slide 1">
            </div>
            <div class="carousel-item h-100">
                <img src="https://unair.ac.id/wp-content/uploads/2023/04/Foto-by-Kompas-Money.jpg"
                    class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
            </div>
            <div class="carousel-item h-100">
                <img src="https://www.tanjungpinangkota.go.id/images/berita/big/rs.jpeg"
                    class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
            </div>

        </div>
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

    <div class="container position-relative text-white py-5" style="z-index: 5;">
        <div class="welcome text-center mb-5" data-aos="fade-down" data-aos-delay="100">
            <h2 class="fw-bold">Selamat Datang di Klinik PKU Muhammadiyah Wanareja</h2>
            <p>Kami memberikan pelayanan kesehatan profesional, islami, dan terjangkau bagi masyarakat.</p>
        </div>

        <div class="row gy-4">
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="why-box bg-white text-dark p-4 rounded shadow" data-aos="zoom-out" data-aos-delay="200">
                    <h4>Mengapa Memilih Kami?</h4>
                    <p>
                        Klinik PKU Muhammadiyah Wanareja telah berdiri sejak 2011, dengan fasilitas rawat inap,
                        pelayanan medis umum, serta ditunjang tenaga medis yang kompeten dan berpengalaman.
                    </p>
                    <div class="text-center mt-3">
                        <a href="#about" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="row gy-4 w-100">
                    <div class="col-xl-4 d-flex">
                        <div class="icon-box bg-white text-dark p-4 rounded shadow w-100" data-aos="zoom-out"
                            data-aos-delay="300">
                            <i class="bi bi-heart-pulse fs-2 text-danger mb-2"></i>
                            <h5 class="fw-bold">Pelayanan Islami</h5>
                            <p>Menjunjung nilai-nilai Islami dalam seluruh proses pelayanan kesehatan.</p>
                        </div>
                    </div>

                    <div class="col-xl-4 d-flex">
                        <div class="icon-box bg-white text-dark p-4 rounded shadow w-100" data-aos="zoom-out"
                            data-aos-delay="400">
                            <i class="bi bi-hospital fs-2 text-success mb-2"></i>
                            <h5 class="fw-bold">Fasilitas Lengkap</h5>
                            <p>Memiliki rawat inap, ambulans, ruang tindakan, serta apotek mandiri.</p>
                        </div>
                    </div>

                    <div class="col-xl-4 d-flex">
                        <div class="icon-box bg-white text-dark p-4 rounded shadow w-100" data-aos="zoom-out"
                            data-aos-delay="500">
                            <i class="bi bi-people fs-2 text-primary mb-2"></i>
                            <h5 class="fw-bold">Tenaga Profesional</h5>
                            <p>Dikelola oleh dokter, perawat, dan tenaga medis berkompeten dan bersertifikat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<section id="about-us" class="about-us section py-5">
    <div class="container" data-aos="fade-up">

        <div class="section-title text-center mb-5">
            <p class="text-uppercase" style="letter-spacing: 2px; color: #888;">LEBIH DEKAT</p>
            <h2 class="fw-bold">Tentang Kami</h2>
        </div>

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-box text-center p-4 rounded shadow-sm w-100">
                    <i class="bi bi-diagram-3-fill fs-1 text-primary mb-3"></i>
                    <h3 class="fs-5 fw-bold">Layanan Kesehatan Terpadu</h3>
                    <p>Menyediakan berbagai layanan mulai dari UGD 24 jam, rawat jalan, rawat inap, hingga
                        farmasi dalam satu lokasi untuk memudahkan koordinasi dan mempercepat proses penyembuhan
                        pasien.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-box text-center p-4 rounded shadow-sm w-100">
                    <i class="bi bi-patch-check-fill fs-1 text-primary mb-3"></i>
                    <h3 class="fs-5 fw-bold">Pelayanan Paripurna</h3>
                    <p>Sebagai klinik terakreditasi "PARIPURNA", kami berkomitmen memberikan pelayanan
                        bermutu tinggi dan selalu berupaya memenuhi tuntutan masyarakat akan pelayanan kesehatan
                        berkualitas.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-box text-center p-4 rounded shadow-sm w-100">
                    <i class="bi bi-moon-stars-fill fs-1 text-primary mb-3"></i>
                    <h3 class="fs-5 fw-bold">Berbasis Islami</h3>
                    <p>Slogan kami "Ibadah dalam pelayanan dan kemanusiaan" tercermin dalam setiap pelayanan
                        yang berprinsip pada Pedoman Hidup Islami Warga Muhammadiyah.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-box text-center p-4 rounded shadow-sm w-100">
                    <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                    <h3 class="fs-5 fw-bold">Tenaga Medis Profesional</h3>
                    <p>Tim kami terdiri dari dokter, apoteker, perawat, analis, dan tenaga kesehatan lainnya
                        yang profesional dan selalu berupaya meningkatkan kualitas sumber daya manusia (SDM).</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-box text-center p-4 rounded shadow-sm w-100">
                    <i class="bi bi-building-fill-check fs-1 text-primary mb-3"></i>
                    <h3 class="fs-5 fw-bold">Fasilitas Lengkap & Standar</h3>
                    <p>Dilengkapi fasilitas rawat inap dengan AC, laboratorium, farmasi, dan ambulans
                        pribadi untuk memastikan penanganan pasien yang optimal dan sesuai standar medis.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-box text-center p-4 rounded shadow-sm w-100">
                    <i class="bi bi-lightbulb-fill fs-1 text-primary mb-3"></i>
                    <h3 class="fs-5 fw-bold">Inovasi dan Pengembangan</h3>
                    <p>Kami terus mengembangkan profesionalisme sumber daya karyawan sesuai kebutuhan
                        pelayanan untuk menjadi pusat pelayanan kesehatan yang kompetitif dan mampu bersaing.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="features" class="features section py-5">
    <div class="container">

        <div class="row gy-4 align-items-center">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-md-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/464230704fa4816e889adff77e00bb46.jpg"
                            class="img-fluid rounded shadow-sm" alt="Ruang tunggu klinik">
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/row-blue-empty-chairs-wheelchair-waiting-room-hospital-scaled.jpg"
                            class="img-fluid rounded shadow-sm" alt="Ruang rawat inap">
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/WhatsApp-Image-2025-01-04-at-15.56.22.jpeg"
                            class="img-fluid rounded shadow-sm" alt="Poli gigi">
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/74c96b17-0074-4a43-9720-3bded90376e8.jpg"
                            class="img-fluid rounded shadow-sm" alt="Instalasi farmasi">
                    </div>
                </div>

            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="ps-lg-5">
                    <p class="text-uppercase" style="letter-spacing: 2px; color: #888;">SLOGAN KAMI</p>
                    <h2 class="fw-bold display-6">Ibadah dalam Pelayanan dan Kemanusiaan.</h2>
                    <p class="text-muted mt-3">
                        Kami berupaya menjadi pusat pelayanan kesehatan yang profesional, bermutu tinggi,
                        dan Islami, serta selalu berkomitmen untuk memberikan pelayanan paripurna
                        yang terjangkau bagi seluruh lapisan masyarakat.
                    </p>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Pelayanan Profesional & Islami.</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>SDM yang Kompeten.</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Terjangkau Bagi Masyarakat.</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Unit Gawat Darurat 24 Jam.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section id="inpatient" class="inpatient section py-5 bg-light">
    <div class="container">

        <div class="row gy-4 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                <div class="pe-lg-5">
                    <p class="text-uppercase" style="letter-spacing: 2px; color: #888;">RAWAT INAP</p>
                    <h2 class="fw-bold display-6">Kamar Rawat Inap yang Bersih dan Nyaman.</h2>
                    <p class="text-muted mt-3">
                        Ruang rawat inap kami dirancang untuk menciptakan lingkungan yang tenang dan mendukung proses
                        pemulihan Anda. Kami menyediakan berbagai fasilitas untuk memastikan kenyamanan pasien dan
                        keluarga selama masa perawatan.
                    </p>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Kamar Pasien (AC + WC Dalam)</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Ruang Instalasi Gawat Darurat</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Ruang Laktasi Khusus Ibu & Bayi</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Dukungan Laboratorium & Farmasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">
                    <div class="col-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/Kamar-Rawat-Inap-3-scaled.webp"
                            class="img-fluid rounded shadow-sm mb-4" alt="Kamar perawatan 1">
                        <img src="<?php echo BASE_URL; ?>/assets/img/Desain-tanpa-judul-6-1024x576.png"
                            class="img-fluid rounded shadow-sm" alt="Kamar perawatan 2">
                    </div>
                    <div class="col-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/Screenshot_8-1024x575.png"
                            class="img-fluid rounded shadow-sm" alt="Kamar perawatan 3">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="services" class="services section py-5">
    <div class="container">

        <div class="row gy-4 align-items-center">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-12 col-md-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/images (1).jpg" class="img-fluid rounded shadow-sm"
                            alt="Layanan Laboratorium">
                    </div>
                    <div class="col-12 col-md-6">
                        <img src="<?php echo BASE_URL; ?>/assets/img/images (2).jpg" class="img-fluid rounded shadow-sm"
                            alt="Layanan Poli Gigi">
                    </div>
                    <div class="col-12">
                        <img src="<?php echo BASE_URL; ?>/assets/img/Perbedaan-Melahirkan-di-Klinik-Bidan-dan-Rumah-Sakit-Mana-yang-Lebih-Baik-655x372.jpg"
                            class="img-fluid rounded shadow-sm" alt="Peralatan Medis">
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="ps-lg-5">
                    <p class="text-uppercase" style="letter-spacing: 2px; color: #888;">PELAYANAN</p>
                    <h2 class="fw-bold display-6">Berbagai Layanan yang Disediakan untuk Anda</h2>
                    <p class="text-muted mt-3">
                        Sesuai dengan standar yang ditetapkan, kami menyediakan berbagai upaya pelayanan kesehatan yang
                        komprehensif untuk memenuhi kebutuhan setiap pasien, mulai dari penanganan darurat hingga
                        perawatan berkelanjutan.
                    </p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Unit Gawat Darurat 24 Jam</span>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Pelayanan Rawat Jalan</span>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Fasilitas Rawat Inap</span>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Laboratorium</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Instalasi Farmasi</span>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Layanan Khitan</span>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                <span>Ambulans Siaga</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="recent-posts" class="recent-posts section py-5 bg-light">
    <div class="container" data-aos="fade-up">

        <div class="section-title text-center mb-5">
            <p class="text-uppercase" style="letter-spacing: 2px; color: #888;">LINI MASA</p>
            <h2 class="fw-bold">Berita Terkini Klinik</h2>
        </div>

        <div class="row gy-4">

            <?php
            // Pastikan controller Anda mengirimkan variabel $beritas yang sudah di-limit, contoh: 3 berita terbaru.
            if (!empty($beritas)):
                $delayCounter = 100; // Inisialisasi delay animasi
                foreach ($beritas as $berita):
            ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $delayCounter; ?>">
                <div class="card h-100 border-0 shadow-sm">
                    <a href="berita-detail.php?id=<?php echo $berita->id; ?>" class="post-img d-block"
                        style="height: 240px; overflow: hidden;">
                        <img src="<?php echo BASE_URL . '/uploads/berita/' . htmlspecialchars($berita->gambar); ?>"
                            class="card-img-top w-100 h-100 object-fit-cover"
                            alt="<?php echo htmlspecialchars($berita->judul); ?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <a href="berita-detail.php?id=<?php echo $berita->id; ?>"
                                class="text-dark text-decoration-none">
                                <?php echo htmlspecialchars($berita->judul); ?>
                            </a>
                        </h5>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0 pb-3">
                        <div class="post-meta d-flex text-muted small">
                            <span>
                                <i class="bi bi-person me-1"></i>
                                <?php echo htmlspecialchars($berita->penulis ?? 'Admin'); ?>
                            </span>
                            <span class="mx-2">•</span>
                            <span>
                                <i class="bi bi-calendar-event me-1"></i>
                                <?php
                                        $date = new DateTime($berita->tanggal_publish);
                                        echo $date->format('d M Y');
                                        ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div><?php
                            $delayCounter += 100; // Tambah delay untuk animasi item berikutnya
                        endforeach;
                    else:
                        // Tampilan jika tidak ada berita yang tersedia
                            ?>
            <div class="col-12 text-center">
                <p class="text-muted fst-italic">Belum ada berita terbaru untuk ditampilkan.</p>
            </div>
            <?php
                    endif;
            ?>

        </div>
    </div>
</section>