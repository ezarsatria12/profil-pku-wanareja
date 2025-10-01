<?php
// File: public/galeri.php (Versi terhubung ke Database)

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php'; // Pastikan koneksi DB dimuat

// Langkah 2: Logika Pagination & Pengambilan Data dari Database
// --------------------------------------------------
generate_csrf_token();
// Tentukan berapa item yang ingin ditampilkan per halaman
$itemsPerPage = 12;

// Ambil halaman saat ini dari URL, default-nya adalah halaman 1
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}

// Ambil total item dari database untuk menghitung total halaman
$totalItems = $pdo->query("SELECT count(id) FROM galeri")->fetchColumn();

// Hitung total halaman yang dibutuhkan
$totalPages = ceil($totalItems / $itemsPerPage);

// Hitung offset untuk query database
$offset = ($currentPage - 1) * $itemsPerPage;

// Ambil data untuk halaman saat ini saja dari database
$stmt = $pdo->prepare("SELECT * FROM galeri ORDER BY created_at DESC LIMIT ? OFFSET ?");
// Kita perlu mengikat parameter sebagai integer untuk LIMIT dan OFFSET
$stmt->bindValue(1, $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$galeris = $stmt->fetchAll(PDO::FETCH_OBJ);


// Langkah 3: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Galeri | Klinik PKU Muhammadiyah Wanareja';
$currentPageForNav = 'galeri'; // Digunakan untuk menandai menu navigasi aktif
$contentView = 'main/pages/galeri-content.php';


// Langkah 4: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';