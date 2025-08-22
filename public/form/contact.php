<?php
// File: public/forms/contact.php

/**
 * PENTING: Ini adalah contoh pemroses form yang SANGAT SEDERHANA.
 * Di aplikasi nyata, kamu perlu menambahkan validasi yang lebih kuat,
 * proteksi CSRF, dan mungkin menggunakan library PHPMailer untuk mengirim email
 * karena fungsi mail() bawaan PHP seringkali tidak andal di shared hosting.
 */

// Cek apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil dan bersihkan data dari form
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validasi sederhana
    if ($name && $email && $subject && $message) {

        // ** Di sinilah logika pengiriman email ditempatkan **
        $to = "admin@webprofilpkuwanareja.site"; // Ganti dengan email tujuanmu
        $headers = "From: " . $email;

        // Fungsi mail() PHP. Untuk development di localhost, ini mungkin tidak berfungsi
        // kecuali kamu mengkonfigurasi server email seperti MailHog atau sejenisnya.
        // mail($to, $subject, $message, $headers);

        // Karena mail() sulit di localhost, untuk sekarang kita anggap berhasil
        // dan hanya mengirimkan respons 'OK'.
        // Library "php-email-form" dari template akan menangani respons ini.
        echo "OK";
    } else {
        // Jika ada data yang tidak valid
        header("HTTP/1.1 400 Bad Request");
        echo "Terdapat error pada data yang Anda kirimkan.";
    }
} else {
    // Jika file diakses langsung tanpa metode POST
    header("HTTP/1.1 403 Forbidden");
    echo "Akses dilarang.";
}