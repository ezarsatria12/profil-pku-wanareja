<?php
session_start();
require_once __DIR__ . '/../../app/bootstrap.php';
require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

$token = $_GET['token'] ?? null;
if ($token === null) {
    die("Token tidak ditemukan.");
}

// Validasi token
$token_hash = hash('sha256', $token);
$stmt = $pdo->prepare("SELECT id FROM user WHERE reset_token = ? AND reset_token_expires_at > NOW()");
$stmt->execute([$token_hash]);
$user = $stmt->fetch();

$isValidToken = ($user !== false);

if ($isValidToken) {
    generate_csrf_token();
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-lg-5">

                        <?php if ($isValidToken): ?>
                        <h4 class="fw-bold mb-3 text-center">Masukkan Password Baru</h4>

                        <?php if (isset($_SESSION['flash_error'])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['flash_error'];
                                                                unset($_SESSION['flash_error']); ?></div>
                        <?php endif; ?>

                        <form action="reset-password-action.php" method="POST">
                            <input type="hidden" name="csrf_token"
                                value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirm" id="password_confirm"
                                    class="form-control form-control-lg" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Simpan Password</button>
                        </form>
                        <?php else: ?>
                        <h4 class="fw-bold mb-3 text-center">Link Tidak Valid</h4>
                        <div class="alert alert-danger">Link reset password ini tidak valid atau sudah kedaluwarsa.
                        </div>
                        <a href="forgot-password.php" class="btn btn-outline-primary w-100">Minta Link Baru</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>