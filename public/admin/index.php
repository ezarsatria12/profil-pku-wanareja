<?php
// File: public/admin/index.php (Dashboard Admin)
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// PENTING: Periksa apakah user sudah login. Jika belum, tendang ke halaman login.

// Muat file bootstrap aplikasi
require_once __DIR__ . '/../../app/bootstrap.php';

// Siapkan variabel untuk template
$pageTitle = 'Dashboard';
$currentPage = 'dashboard'; // Untuk menandai menu sidebar aktif
$contentView = 'admin/pages/dashboard-content.php';

// Panggil layout admin
include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';