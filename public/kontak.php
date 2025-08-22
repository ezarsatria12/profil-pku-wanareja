<?php
// File: public/kontak.php

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan variabel yang dibutuhkan oleh template
$pageTitle = 'Kontak | Klinik PKU Muhammadiyah Wanareja';
$currentPage = 'kontak'; // Untuk menandai menu 'Kontak' sebagai aktif
$contentView = 'main/pages/kontak-content.php';

// Langkah 3: Panggil kerangka utama
include __DIR__ . '/../templates/main/layouts/main-layout.php';