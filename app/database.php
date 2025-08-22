<?php
// File: app/database.php

// Ambil kredensial dari config.php
require_once __DIR__ . '/config.php';

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
    // Di aplikasi produksi, jangan tampilkan error detail ke user
    // Cukup log error-nya dan tampilkan pesan generik.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}