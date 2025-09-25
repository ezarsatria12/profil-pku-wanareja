<?php
// File: public/berita-detail.php
// Controller untuk menampilkan halaman detail sebuah berita.

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php';

// Langkah 2: Ambil ID berita dari URL dan validasi
// --------------------------------------------------
$beritaId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika tidak ada ID, redirect ke halaman daftar berita
if ($beritaId === 0) {
    header("Location: berita.php");
    exit;
}

// Langkah 3: Ambil data berita spesifik dari database
// --------------------------------------------------
$stmt = $pdo->prepare("SELECT * FROM berita WHERE id = ? AND status = 'publish' LIMIT 1");
$stmt->execute([$beritaId]);
$berita = $stmt->fetch(PDO::FETCH_OBJ);

// Jika berita dengan ID tersebut tidak ditemukan, redirect ke halaman daftar berita
if (!$berita) {
    header("Location: berita.php");
    exit;
}

// Langkah 4: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = htmlspecialchars($berita->judul) . ' | Klinik PKU Muhammadiyah Wanareja';
$currentPageForNav = 'berita'; // Untuk menandai menu navigasi aktif
$contentView = 'main/pages/berita-detail-content.php';


// Langkah 5: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';