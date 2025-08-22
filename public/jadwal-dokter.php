<?php
// File: public/jadwal-dokter.php (Versi terhubung ke Database)

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php'; // Pastikan koneksi DB dimuat

// Langkah 2: Pengambilan Data dari Database
// --------------------------------------------------

// Ambil semua data jadwal dokter dari database
// Urutkan berdasarkan urutan hari yang benar (Senin, Selasa, dst.), lalu berdasarkan jam mulai
$stmt = $pdo->query("SELECT * FROM jadwal_dokter ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jam_mulai ASC");
$jadwalDokter = $stmt->fetchAll(PDO::FETCH_OBJ);


// Langkah 3: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Jadwal Dokter | Klinik PKU Muhammadiyah Wanareja';
$currentPage = 'jadwal_dokter'; // Untuk menandai menu navigasi 'Pelayanan' -> 'Jadwal Dokter'
$contentView = 'main/pages/jadwal-dokter-content.php';

// Langkah 4: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';