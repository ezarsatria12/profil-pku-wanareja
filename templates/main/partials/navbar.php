<?php
// File: templates/main/partials/navbar.php
?>
<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a
                        href="mailto:<?php echo htmlspecialchars($contactInfo['email'] ?? ''); ?>"><?php echo htmlspecialchars($contactInfo['email'] ?? 'contact@example.com'); ?></a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <span><?php echo htmlspecialchars($contactInfo['phone'] ?? '+1 5589 55488 55'); ?></span>
                </i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename"><?php echo htmlspecialchars($siteName ?? 'Medilab'); ?></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="<?php echo ($currentPage === 'home') ? 'active' : ''; ?>">Home</a>
                    </li>

                    <li class="dropdown"><a href="#"><span>Profil</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="profil-pku.php">Profil PKU Wanareja</a></li>
                            <li><a href="visi-misi.php">Visi dan Misi</a></li>
                            <li><a href="struktur-organisasi.php">Struktur Organisasi</a></li>
                            <li><a href="sejarah.php">Sejarah</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>Pelayanan</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="jadwal-pelayanan.php">Jadwal Pelayanan</a></li>
                            <li><a href="jadwal-dokter.php">Jadwal Dokter</a></li>
                            <li><a href="fasilitas.php">Fasilitas</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>Publik</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="berita.php">Berita</a></li>
                            <li><a href="galeri.php">Galeri</a></li>
                        </ul>
                    </li>

                    <li><a href="kontak.php"
                            class="<?php echo ($currentPage === 'kontak') ? 'active' : ''; ?>">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </div>
</header>