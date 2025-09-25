<?php
// File: public/struktur-organisasi.php
// Controller untuk menampilkan halaman Struktur Organisasi di sisi publik.

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php'; // Pastikan koneksi DB dimuat

// Langkah 2: Ambil nama file gambar dari database
// --------------------------------------------------
$stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'struktur_organisasi_img'");
$strukturImage = $stmt->fetchColumn();


// Langkah 3: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Struktur Organisasi | Klinik PKU Muhammadiyah Wanareja';
// $currentPageForNav = 'profil'; // Ganti 'profil' jika Anda punya grup menu untuk ini
$contentView = 'main/pages/struktur-organisasi-content.php';


// Langkah 4: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';