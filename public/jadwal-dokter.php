<?php
// File: public/jadwal-dokter.php
// Controller untuk halaman Jadwal Dokter di sisi publik.

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php';
require_once __DIR__ . '/../app/functions.php'; // Panggil file functions

// Langkah 2: Logika Paginasi
// --------------------------------------------------
$itemsPerPage = 6; // Tampilkan 6 dokter per halaman
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $itemsPerPage;

// Ambil total data untuk menghitung total halaman
$totalItems = $pdo->query("SELECT count(id) FROM jadwal_dokter")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// Langkah 3: Ambil data jadwal dari database
// --------------------------------------------------
// Pastikan menggunakan SELECT * untuk mengambil semua kolom, termasuk 'foto'
$stmt = $pdo->prepare("
    SELECT * FROM jadwal_dokter 
    ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jam_mulai ASC 
    LIMIT ? OFFSET ?
");
$stmt->bindValue(1, $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$jadwalDokter = $stmt->fetchAll(PDO::FETCH_OBJ);


// Langkah 4: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Jadwal Dokter | Klinik PKU Muhammadiyah Wanareja';
// $currentPageForNav = 'pelayanan'; // Ganti 'pelayanan' jika Anda punya grup menu untuk ini
$contentView = 'main/pages/jadwal-dokter-content.php';


// Langkah 5: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';