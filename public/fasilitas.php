<?php
// File: public/fasilitas.php

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan semua variabel yang dibutuhkan oleh template
$pageTitle = 'Fasilitas | Klinik PKU Muhammadiyah Wanareja';
$metaDescription = 'Daftar fasilitas lengkap yang tersedia di Klinik PKU Muhammadiyah Wanareja, termasuk ruang rawat inap, ruang tindakan, dan sarana pendukung lainnya.';
$metaKeywords = 'fasilitas, sarana, rawat inap, ruang tindakan, klinik wanareja';

// Variabel ini memberitahu navbar menu mana yang harus aktif.
// 'fasilitas' termasuk dalam grup $pelayananPages di navbar.php
$currentPage = 'fasilitas';

// Variabel ini memberitahu layout utama, file konten mana yang harus dimuat.
$contentView = 'main/pages/fasilitas-content.php';

// Langkah 3: Panggil kerangka utama untuk menampilkan halaman.
include __DIR__ . '/../templates/main/layouts/main-layout.php';