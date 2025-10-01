<?php
// File: templates/main/pages/kontak-content.php
?>
<section id="contact" class="contact section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Hubungi kami untuk informasi lebih lanjut atau pertanyaan seputar layanan kami.</p>
    </div>

    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 350px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.332349581513!2d108.7369348153488!3d-7.42859527508827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e658a67c13913e5%3A0x2475a8a25a5892ac!2sKlinik%20Pratama%20Rawat%20Inap%20PKU%20Muhammadiyah%20Wanareja!5e0!3m2!1sen!2sid!4v1663820251313!5m2!1sen!2sid"
            frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-4">
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h3>Alamat</h3>
                        <p>Jl. Gatot Subroto Km. 2, Desa Adimulya, Kec. Wanareja, Kabupaten Cilacap, Jawa Tengah</p>
                    </div>
                </div>
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>Telepon</h3>
                        <p>085171031617</p>
                    </div>
                </div>
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>Email</h3>
                        <p>pkuwanareja@gmail.com</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form action="<?php echo BASE_URL; ?>/forms/contact.php" method="post" class="php-email-form"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subjek" required>
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Pesan"
                                required></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                            <button type="submit">Kirim Pesan</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>