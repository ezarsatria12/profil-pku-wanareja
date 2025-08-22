<?php
// File: public/jadwal-pelayanan.php (Versi terhubung ke Database)

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php'; // Pastikan koneksi DB dimuat

// Langkah 2: Pengambilan Data dari Database
// --------------------------------------------------

// Ambil semua data jadwal pelayanan dari database
// Urutkan berdasarkan urutan hari yang benar, lalu berdasarkan jam mulai
$stmt = $pdo->query("SELECT * FROM jadwal_pelayanan ORDER BY FIELD(hari, 'Senin - Sabtu', 'Senin - Jumat', 'Setiap Hari', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jam_mulai ASC");
$jadwalPelayanan = $stmt->fetchAll(PDO::FETCH_OBJ);


// Langkah 3: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Jadwal Pelayanan | Klinik PKU Muhammadiyah Wanareja';
$currentPage = 'jadwal_pelayanan'; // Untuk menandai menu navigasi 'Pelayanan' aktif
$contentView = 'main/pages/jadwal-pelayanan-content.php';

// Langkah 4: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';