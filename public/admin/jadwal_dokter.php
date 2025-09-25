<?php
session_start();
// Hapus baris ini jika user tidak harus login untuk melihat halaman ini
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php'; // Pastikan file ini ada CSRF & Pagination

// Logika Pagination
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $itemsPerPage;

// Ambil total jadwal untuk pagination
$totalItems = $pdo->query("SELECT count(id) FROM jadwal_dokter")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// Ambil data jadwal dokter untuk halaman saat ini
$stmt = $pdo->prepare("SELECT * FROM jadwal_dokter ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jam_mulai ASC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$jadwalDokter = $stmt->fetchAll(PDO::FETCH_OBJ);

// Mengambil "flash message" dari session
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// Siapkan variabel untuk template
$pageTitle = 'Manajemen Jadwal Dokter';
$activePage = 'jadwal_dokter'; // <-- UBAH NAMA VARIABEL INI
$contentView = 'admin/pages/jadwal-dokter-content.php';

// Panggil layout admin
include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';