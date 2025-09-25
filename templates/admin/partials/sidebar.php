<?php
// File: templates/admin/partials/sidebar.php

// Variabel $currentPage akan di-set di setiap file entry-point admin
// (misal: di public/admin/index.php, kita set $currentPage = 'dashboard';)
// Inisialisasi default untuk menghindari error jika tidak di-set.
$currentPage = $currentPage ?? '';
?>
<div class="sidebar border-end">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">PKU Wanareja</div>
    </div>

    <ul class="sidebar-nav">
        <li class="nav-title">Nav Title</li>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  <?php echo ($currentPage === 'dashboard') ? 'active bg-gradient-primary' : ''; ?>"
                    href="index.php">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-rounded">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs  font-weight-bolder opacity-8">Manajemen Konten
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($currentPage === 'berita') ? 'active bg-gradient-primary' : ''; ?>"
                    href="berita.php">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-rounded">article</i>
                    </div>
                    <span class="nav-link-text ms-1">Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($currentPage === 'galeri') ? 'active bg-gradient-primary' : ''; ?>"
                    href="galeri.php">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-rounded">collections</i>
                    </div>
                    <span class="nav-link-text ms-1">Galeri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($currentPage === 'struktur-organisasi') ? 'active bg-gradient-primary' : ''; ?>"
                    href="struktur-organisasi.php">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-rounded">collections</i>
                    </div>
                    <span class="nav-link-text ms-1">struktur Organisasi</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs  font-weight-bolder opacity-8">Manajemen Jadwal
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($currentPage === 'jadwal_pelayanan') ? 'active bg-gradient-primary' : ''; ?>"
                    href="jadwal_pelayanan.php">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-rounded">calendar_month</i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Pelayanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?php echo ($currentPage === 'jadwal_dokter') ? 'active bg-gradient-primary' : ''; ?>"
                    href="jadwal_dokter.php">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-rounded">emergency</i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Dokter</span>
                </a>
            </li>
        </ul>
        <li class="nav-item mt-auto">
            <a class="nav-link bg-gradient-danger" href="logout.php">
                <div class="text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-symbols-rounded">logout</i>
                </div>
                <span class="nav-link-text ms-1">Logout</span>
            </a>
        </li>
</div>