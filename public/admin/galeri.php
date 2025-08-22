<?php
// File: public/admin/galeri.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

// Logika Pagination
$itemsPerPage = 12; // Tampilkan lebih banyak gambar per halaman
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

$totalItems = $pdo->query("SELECT count(id) FROM galeri")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

$stmt = $pdo->prepare("SELECT * FROM galeri ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->execute([$itemsPerPage, $offset]);
$galeris = $stmt->fetchAll(PDO::FETCH_OBJ);

$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

$pageTitle = 'Manajemen Galeri';
$currentPage = 'galeri';
$contentView = 'admin/pages/galeri-content.php';

include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';