<?php
// File: public/berita.php (Versi terhubung ke Database)

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php'; // Pastikan koneksi DB dimuat

// Langkah 2: Logika Pagination & Pengambilan Data dari Database
// --------------------------------------------------

// Tentukan berapa item yang ingin ditampilkan per halaman
$itemsPerPage = 6;

// Ambil halaman saat ini dari URL, default-nya adalah halaman 1
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}

// Ambil total item dari database (hanya yang statusnya 'publish')
$totalItems = $pdo->query("SELECT count(id) FROM berita WHERE status = 'publish'")->fetchColumn();

// Hitung total halaman yang dibutuhkan
$totalPages = ceil($totalItems / $itemsPerPage);

// Hitung offset untuk query database
$offset = ($currentPage - 1) * $itemsPerPage;

// Ambil data berita untuk halaman saat ini saja dari database
// Hanya ambil berita yang statusnya 'publish' dan urutkan berdasarkan tanggal terbaru
$stmt = $pdo->prepare("SELECT * FROM berita WHERE status = 'publish' ORDER BY tanggal_publish DESC LIMIT ? OFFSET ?");
// Kita perlu mengikat parameter sebagai integer untuk LIMIT dan OFFSET
$stmt->bindValue(1, $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$beritas = $stmt->fetchAll(PDO::FETCH_OBJ);


// Langkah 3: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Berita Terbaru | Klinik PKU Muhammadiyah Wanareja';
$currentPageForNav = 'berita'; // Digunakan untuk menandai menu navigasi aktif
$contentView = 'main/pages/berita-content.php';


// Langkah 4: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';