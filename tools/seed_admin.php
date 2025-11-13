<?php
// File: tools/seed_admin.php
// Skrip untuk membuat user admin secara otomatis.
// Sebaiknya dijalankan melalui Command Line (Terminal).

echo "===================================\n";
echo "  Admin User Seeder              \n";
echo "===================================\n";

// Muat file koneksi database. Path ini relatif dari root proyek.
// Kita perlu menangani error jika file tidak ditemukan.
$databaseFile = __DIR__ . '/../app/database.php';
if (!file_exists($databaseFile)) {
    die("ERROR: File database.php tidak ditemukan. Pastikan path sudah benar.\n");
}
require_once $databaseFile;

// --- Data untuk User Admin ---
$adminData = [
    'name' => 'Admin PKU',
    'email' => 'ezarsatpra737@gmail.com',
    'password' => '12345678' // Password ini akan kita hash sebelum disimpan
];

try {
    // 1. Cek apakah user dengan email tersebut sudah ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `user` WHERE email = ?");
    $stmt->execute([$adminData['email']]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        echo "INFO: User dengan email '" . $adminData['email'] . "' sudah ada. Proses seeding dibatalkan.\n";
        exit(); // Hentikan skrip
    }

    // 2. Jika belum ada, buat hash password
    $hashedPassword = password_hash($adminData['password'], PASSWORD_DEFAULT);
    echo "Password plain: '" . $adminData['password'] . "'\n";
    echo "Password di-hash menjadi: '" . $hashedPassword . "'\n";

    // 3. Masukkan user baru ke database
    $stmt = $pdo->prepare(
        "INSERT INTO `user` (name, email, password, created_at) VALUES (?, ?, ?, NOW())"
    );
    $stmt->execute([
        $adminData['name'],
        $adminData['email'],
        $hashedPassword
    ]);

    echo "===================================\n";
    echo "SUCCESS: User admin '" . $adminData['name'] . "' berhasil dibuat!\n";
    echo "===================================\n";
} catch (PDOException $e) {
    // Tangani jika ada error koneksi atau query database
    die("ERROR: Gagal menjalankan seeder. Pesan: " . $e->getMessage() . "\n");
}