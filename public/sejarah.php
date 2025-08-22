<?php
// File: public/sejarah.php

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan semua variabel yang dibutuhkan oleh template
$pageTitle = 'Sejarah | Klinik PKU Muhammadiyah Wanareja';
$metaDescription = 'Sejarah berdirinya Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja, mulai dari Balkesmas pada tahun 1966 hingga menjadi klinik modern saat ini.';
$metaKeywords = 'sejarah, pku wanareja, balkesmas, muhammadiyah, sejarah klinik';

// Variabel ini memberitahu navbar menu mana yang harus aktif.
// 'sejarah' termasuk dalam grup $profilPages di navbar.php
$currentPage = 'sejarah';

// Variabel ini memberitahu layout utama, file konten mana yang harus dimuat.
$contentView = 'main/pages/sejarah-content.php';

// Langkah 3: Panggil kerangka utama untuk menampilkan halaman.
include __DIR__ . '/../templates/main/layouts/main-layout.php';