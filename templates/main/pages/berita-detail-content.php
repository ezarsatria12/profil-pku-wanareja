<?php
// File: templates/main/pages/berita-detail-content.php
// Berisi konten spesifik untuk halaman detail berita.
?>

<section id="berita-detail" class="berita-detail section">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center">
            <div class="col-lg-9">

                <article class="article">

                    <h1 class="title"><?php echo htmlspecialchars($berita->judul); ?></h1>

                    <div class="meta-top">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                <?php echo htmlspecialchars($berita->penulis ?? 'Admin'); ?></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                <time
                                    datetime="<?php echo (new DateTime($berita->tanggal_publish))->format('Y-m-d'); ?>">
                                    <?php echo (new DateTime($berita->tanggal_publish))->format('d M Y'); ?>
                                </time>
                            </li>
                        </ul>
                    </div>

                    <div class="post-img my-4">
                        <img src="<?php echo BASE_URL . '/uploads/berita/' . htmlspecialchars($berita->gambar); ?>"
                            alt="<?php echo htmlspecialchars($berita->judul); ?>" class="img-fluid rounded w-100">
                    </div>

                    <div class="content">
                        <?php
                        // Tampilkan konten berita secara penuh
                        // Tidak menggunakan htmlspecialchars agar tag HTML seperti <p>, <b>, dll. bisa dirender
                        echo $berita->konten;
                        ?>
                    </div>

                </article>
            </div>
        </div>

    </div>
</section>