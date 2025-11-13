<?php
// File: public/admin/login.php

// Selalu mulai session di awal
session_start();

// Jika user sudah login, langsung redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Muat file koneksi database
require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';
require_once __DIR__ . '/../../app/bootstrap.php';
$error = null;
$old_email = '';
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
// --- LOGIKA PEMROSESAN LOGIN (PENGGANTI FUNGSI login() DI CONTROLLER) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi CSRF Token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $old_email = $email; // Simpan email untuk ditampilkan kembali jika error

    if (empty($email) || empty($password)) {
        $error = 'Email dan password wajib diisi.';
    } else {
        // Cari user berdasarkan email
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        // Verifikasi user dan password (PENGGANTI Auth::attempt())
        if ($user && password_verify($password, $user->password)) {
            // Login berhasil
            session_regenerate_id(true); // Regenerasi session ID untuk keamanan
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;

            // Redirect ke dashboard admin
            header('Location: index.php');
            exit();
        } else {
            // Login gagal
            $error = 'Email atau password yang Anda masukkan salah.';
        }
    }
}

// Buat CSRF token baru untuk form (PENGGANTI @csrf)
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

?>
<!-- --- BAGIAN TAMPILAN HTML (PENGGANTI login.blade.php) --- -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100" style="background-color: #f0f2f5;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <form action="login.php" method="POST">
                                <input type="hidden" name="csrf_token"
                                    value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <span class="h1 fw-bold mb-0">PKU Admin</span>
                                </div>

                                <h5 class="fw-normal mb-3 pb-3">Masuk ke akun Anda</h5>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        value="<?php echo htmlspecialchars($old_email ?? ''); ?>" required>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        required>
                                </div>

                                <?php if (!empty($error)): ?>
                                <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
                                <?php endif; ?>

                                <div class="pt-1 mb-4">
                                    <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Login</button>
                                </div>

                                <a class="small text-muted" href="forgot-password.php">Lupa password?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>