<?php
// File: public/struktur-organisasi.php

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan semua variabel yang dibutuhkan oleh template
$pageTitle = 'Struktur Organisasi | Klinik PKU Muhammadiyah Wanareja';
$metaDescription = 'Bagan struktur organisasi resmi dari Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja.';
$metaKeywords = 'struktur organisasi, pku wanareja, manajemen klinik';

// Variabel ini memberitahu navbar menu mana yang harus aktif.
// 'struktur-organisasi' termasuk dalam grup $profilPages di navbar.php
$currentPage = 'struktur-organisasi';

// Variabel ini memberitahu layout utama, file konten mana yang harus dimuat.
$contentView = 'main/pages/struktur-organisasi-content.php';

// Langkah 3: Panggil kerangka utama untuk menampilkan halaman.
include __DIR__ . '/../templates/main/layouts/main-layout.php';