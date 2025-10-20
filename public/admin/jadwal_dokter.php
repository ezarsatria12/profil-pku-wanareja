<?php
session_start();

require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/database.php';

generate_csrf_token(); // Buat token CSRF untuk form

// --- LOGIKA PAGINASI ---
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$totalItems = $pdo->query("SELECT count(id) FROM dokter")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// --- Mengambil data dokter BESERTA SEMUA JADWALNYA menggunakan GROUP_CONCAT ---
$sql = "
    SELECT 
        d.id, d.nama_dokter, d.spesialis, d.foto,
        GROUP_CONCAT(
            CONCAT(jp.hari, '|', TIME_FORMAT(jp.jam_mulai, '%H:%i'), '|', TIME_FORMAT(jp.jam_selesai, '%H:%i'))
            ORDER BY FIELD(jp.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jp.jam_mulai
            SEPARATOR ';'
        ) as jadwal_list
    FROM dokter d
    LEFT JOIN jadwal_praktik jp ON d.id = jp.dokter_id
    GROUP BY d.id
    ORDER BY d.nama_dokter ASC
    LIMIT :limit OFFSET :offset
";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarDokter = $stmt->fetchAll(PDO::FETCH_OBJ);
// --------------------------------------------------------------------------

if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

$pageTitle = 'Manajemen Dokter';
$activePage = 'jadwal_dokter';
$contentView = 'admin/pages/jadwal-dokter-content.php';
include __DIR__ . '/../../templates/admin/layouts/admin-layout.php';