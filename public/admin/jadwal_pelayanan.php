<?php
session_start();

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/database.php';

generate_csrf_token(); // Buat token CSRF untuk form

// Ambil notifikasi dari session jika ada
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// --- LOGIKA PAGINASI ---
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $itemsPerPage;

$totalItems = $pdo->query("SELECT count(id) FROM jadwal_pelayanan")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// Ambil data dari database.
// Saran: Untuk sorting hari yang benar, tambahkan kolom 'urutan_hari' (angka 1-7) di database Anda.
// Contoh: ORDER BY urutan_hari ASC
$stmt = $pdo->prepare("SELECT * FROM jadwal_pelayanan ORDER BY id ASC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
// Gunakan nama variabel camelCase agar cocok dengan view
$jadwalPelayanan = $stmt->fetchAll(PDO::FETCH_OBJ);
// --- END LOGIKA PAGINASI ---

$pageTitle = 'Kelola Jadwal Pelayanan';
$contentView = 'admin/pages/jadwal-pelayanan-content.php';

include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';