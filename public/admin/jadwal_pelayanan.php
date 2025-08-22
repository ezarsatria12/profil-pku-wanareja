<?php
// File: public/admin/jadwal_pelayanan.php
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

// Ambil total jadwal
$totalItems = $pdo->query("SELECT count(id) FROM jadwal_pelayanan")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// Ambil data untuk halaman saat ini
$stmt = $pdo->prepare("SELECT * FROM jadwal_pelayanan ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jam_mulai ASC LIMIT ? OFFSET ?");
$stmt->execute([$itemsPerPage, $offset]);
$jadwalPelayanan = $stmt->fetchAll(PDO::FETCH_OBJ);

$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

$pageTitle = 'Manajemen Jadwal Pelayanan';
$currentPage = 'jadwal_pelayanan';
$contentView = 'admin/pages/jadwal-pelayanan-content.php';

include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';