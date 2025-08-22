<?php
// File: public/admin/berita.php (Halaman utama manajemen berita)
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

// Logika Pagination
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Ambil total berita untuk pagination
$totalItems = $pdo->query("SELECT count(id) FROM berita")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// Ambil data berita untuk halaman saat ini
$stmt = $pdo->prepare("SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT ? OFFSET ?");
$stmt->execute([$itemsPerPage, $offset]);
$beritas = $stmt->fetchAll(PDO::FETCH_OBJ);

// Mengambil "flash message" dari session jika ada (misal: setelah berhasil hapus)
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']); // Hapus pesan setelah ditampilkan

// Siapkan variabel untuk template
$pageTitle = 'Manajemen Berita';
$currentPage = 'berita';
$contentView = 'admin/pages/berita-content.php';

// Panggil layout admin
include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';