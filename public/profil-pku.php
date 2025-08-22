<?php
// File: public/about.php

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan semua variabel yang dibutuhkan oleh template
$pageTitle = 'Tentang Kami | Klinik PKU Muhammadiyah Wanareja';
$metaDescription = 'Informasi tentang Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja, komitmen pelayanan, sarana, dan sumber daya profesional kami.';
$metaKeywords = 'tentang kami, profil klinik, pku wanareja, pelayanan kesehatan';

// Variabel ini memberitahu navbar menu mana yang harus aktif.
// 'profil-pku' termasuk dalam grup $profilPages di navbar.php
$currentPage = 'profil-pku';

// Variabel ini memberitahu layout utama, file konten mana yang harus dimuat.
$contentView = 'main/pages/profil-pku-content.php';

// Langkah 3: Panggil kerangka utama untuk menampilkan halaman.
include __DIR__ . '/../templates/main/layouts/main-layout.php';