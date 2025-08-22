<?php
// File: public/visi-misi.php

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan semua variabel yang dibutuhkan oleh template
$pageTitle = 'Visi dan Misi | Klinik PKU Muhammadiyah Wanareja';
$metaDescription = 'Visi dan Misi dari Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja dalam memberikan pelayanan kesehatan yang islami, profesional, dan terjangkau.';
$metaKeywords = 'visi, misi, pku wanareja, pelayanan kesehatan, profesional, islami';

// Variabel ini memberitahu navbar menu mana yang harus aktif.
// 'visi-misi' termasuk dalam grup $profilPages di navbar.php
$currentPage = 'visi-misi';

// Variabel ini memberitahu layout utama, file konten mana yang harus dimuat.
$contentView = 'main/pages/visi-misi-content.php';

// Langkah 3: Panggil kerangka utama untuk menampilkan halaman.
include __DIR__ . '/../templates/main/layouts/main-layout.php';