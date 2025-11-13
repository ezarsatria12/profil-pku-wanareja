<?php
session_start();
// Memuat semua file inti
require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/database.php';
// functions.php dan csrf.php sudah dimuat oleh bootstrap.php

generate_csrf_token();
$message = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token()) {
        die("Invalid CSRF token.");
    }

    $email = trim($_POST['email']);

    // 1. Cek apakah email ada di database
    // --- KITA TAMBAHKAN SELECT reset_token dan reset_token_expires_at ---
    $stmt = $pdo->prepare("SELECT id, reset_token, reset_token_expires_at FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // --- LOGIKA BARU UNTUK CEK TOKEN AKTIF ---
        $isTokenValid = ($user['reset_token'] && $user['reset_token_expires_at'] && new DateTime() < new DateTime($user['reset_token_expires_at']));

        if ($isTokenValid) {
            // JIKA TOKEN MASIH BERLAKU: Jangan buat token baru.
            // Cukup tampilkan pesan bahwa email sudah dikirim.
            // Ini mencegah pembuatan token berulang kali dalam 5 menit.
            $message = "Link reset password telah dikirimkan ke email Anda dan masih berlaku. Silakan cek inbox Anda (atau folder spam).";
        } else {
            // JIKA TOKEN TIDAK ADA / KEDALUWARSA: Buat token baru.
            try {
                $token = bin2hex(random_bytes(32));
                $expires_at = (new DateTime('+5 minutes'))->format('Y-m-d H:i:s');
                $token_hash = hash('sha256', $token);

                // Update token baru ke database
                $stmt = $pdo->prepare("UPDATE user SET reset_token = ?, reset_token_expires_at = ? WHERE id = ?");
                $stmt->execute([$token_hash, $expires_at, $user['id']]);

                // Kirim email
                send_password_reset_email($email, $token);

                $message = "Jika akun dengan email tersebut terdaftar, email instruksi reset password telah dikirimkan.";
            } catch (Exception $e) {
                $error = "Gagal mengirim email. Error: " . $e->getMessage();
            }
        }
    } else {
        // Tampilkan pesan sukses palsu untuk keamanan
        $message = "Jika akun dengan email tersebut terdaftar, email instruksi reset password telah dikirimkan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="fw-bold mb-3 text-center">Lupa Password</h4>
                        <p class="text-muted text-center mb-4">Masukkan email Anda. Kami akan mengirimkan link untuk
                            mereset password Anda.</p>

                        <?php if ($message): ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form action="forgot-password.php" method="POST">
                            <input type="hidden" name="csrf_token"
                                value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Kirim Link Reset</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="login.php">Kembali ke Halaman Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>