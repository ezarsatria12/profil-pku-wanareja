<?php
// File: public/jadwal-dokter.php
// Controller untuk halaman Jadwal Dokter di sisi publik.

// Langkah 1: Muat semua file aplikasi inti
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/database.php';
require_once __DIR__ . '/../app/functions.php'; // Panggil file functions

$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$totalItems = $pdo->query("SELECT count(id) FROM dokter")->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// --- Mengambil data dokter beserta SEMUA jadwalnya dalam satu query ---
$sql = "
    SELECT 
        d.id,
        d.nama_dokter,
        d.spesialis,
        d.foto,
        GROUP_CONCAT(
            CONCAT(jp.hari, '|', TIME_FORMAT(jp.jam_mulai, '%H:%i'), '|', TIME_FORMAT(jp.jam_selesai, '%H:%i')) 
            ORDER BY FIELD(jp.hari, 'Senin - Jumat', 'Senin - Sabtu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jp.jam_mulai
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

// Langkah 4: Siapkan variabel yang dibutuhkan oleh template
// --------------------------------------------------
$pageTitle = 'Jadwal Dokter | Klinik PKU Muhammadiyah Wanareja';
// $currentPageForNav = 'pelayanan'; // Ganti 'pelayanan' jika Anda punya grup menu untuk ini
$contentView = 'main/pages/jadwal-dokter-content.php';


// Langkah 5: Panggil kerangka utama
// --------------------------------------------------
include __DIR__ . '/../templates/main/layouts/main-layout.php';