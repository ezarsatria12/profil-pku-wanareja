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