<?php
// File: public/index.php
// Ini adalah "controller" untuk halaman utama (route root /).

// Langkah 1: Muat semua file aplikasi inti (konfigurasi, fungsi, dll.)
require_once __DIR__ . '/../app/bootstrap.php';

// Langkah 2: Siapkan semua variabel yang dibutuhkan oleh template.
// Ini menggantikan @section('title', 'Beranda') di Blade.
$pageTitle = 'Beranda - Klinik PKU Muhammadiyah Wanareja';
$metaDescription = 'Kami memberikan pelayanan kesehatan profesional, islami, dan terjangkau bagi masyarakat Wanareja dan sekitarnya.';
$metaKeywords = 'klinik, pku, muhammadiyah, wanareja, kesehatan, rawat inap';

// Variabel ini memberitahu navbar link mana yang harus diberi class 'active'.
$currentPage = 'home';

// Variabel ini memberitahu layout utama, file konten mana yang harus dimuat.
$contentView = 'main/pages/home-content.php';

// Langkah 3: Panggil kerangka utama untuk menampilkan halaman.
// Ini menggantikan @extends('main.layout.main-layout') di Blade.
include __DIR__ . '/../templates/main/layouts/main-layout.php';