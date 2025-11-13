<?php
// File: app/bootstrap.php
// File ini bertugas untuk memuat semua file inti dari aplikasi kita.
date_default_timezone_set('Asia/Jakarta');
// 1. Muat file konfigurasi (berisi info database, info kontak, BASE_URL, dll)
// Pastikan kamu sudah punya file config.php di dalam folder app/
require_once __DIR__ . '/config.php';

// 2. Muat file fungsi-fungsi bantuan (seperti fungsi limit_text)
// Pastikan kamu sudah punya file functions.php di dalam folder app/
require_once __DIR__ . '/functions.php';

require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/../vendor/autoload.php';
// 3. (Opsional) Nantinya, kamu bisa menambahkan file lain di sini
//    jika dibutuhkan, misalnya untuk koneksi ke database.
// require_once __DIR__ . '/database.php';