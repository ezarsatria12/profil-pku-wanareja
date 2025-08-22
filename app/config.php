<?php
// File: app/config.php
// Pusat konfigurasi untuk seluruh aplikasi.

// =================================================================
// PENGATURAN DASAR APLIKASI
// =================================================================

// URL Dasar dari website. PENTING: Jangan ada garis miring (/) di akhir.
define('BASE_URL', 'http://localhost/webprofilpkuwanareja/public');

// Nama Situs
$siteName = 'Klinik PKU Wanareja';


// =================================================================
// KREDENSIAL DATABASE (untuk nanti jika sudah terhubung)
// =================================================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Biasanya kosong di Laragon/XAMPP
define('DB_NAME', 'webprofilpkuwanareja');


// =================================================================
// INFORMASI KONTAK & SOSIAL MEDIA (digunakan di navbar & footer)
// =================================================================

// Alamat
$contactAddress = [
    'street' => 'A108 Adam Street',
    'city' => 'New York, NY 535022'
];

// Info Kontak
$contactInfo = [
    'phone' => '+1 5589 55488 55',
    'email' => 'contact@example.com'
];

// Link Sosial Media
$socialLinks = [
    'twitter'   => 'https://twitter.com/example',
    'facebook'  => 'https://facebook.com/example',
    'instagram' => 'https://instagram.com/example',
    'linkedin'  => 'https://linkedin.com/in/example'
];