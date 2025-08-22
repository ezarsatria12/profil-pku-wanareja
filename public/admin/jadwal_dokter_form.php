<?php
// File: public/admin/jadwal_dokter_form.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../app/database.php';
require_once __DIR__ . '/../../app/functions.php';

// --- LOGIKA UNTUK MENENTUKAN MODE TAMBAH ATAU EDIT ---
$isEdit = false;
$jadwal = null; // Inisialisasi sebagai null

// Cek apakah ada ID di URL (mode edit)
if (isset($_GET['id'])) {
    $isEdit = true;
    $id = $_GET['id'];

    // Ambil data jadwal dari database
    $stmt = $pdo->prepare("SELECT * FROM jadwal_dokter WHERE id = ?");
    $stmt->execute([$id]);
    $jadwal = $stmt->fetch(PDO::FETCH_OBJ);

    // Jika jadwal dengan ID tersebut tidak ditemukan, hentikan skrip
    if (!$jadwal) {
        die("Jadwal tidak ditemukan.");
    }
}

$pageTitle = $isEdit ? 'Edit Jadwal Dokter' : 'Tambah Jadwal Dokter';

// Buat CSRF token untuk keamanan form
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Admin PKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
</head>

<body class="bg-light min-vh-100 p-3 p-md-4">
    <div class="container bg-white rounded shadow-sm p-4 position-relative">
        <a href="jadwal_dokter.php" class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-3">
            <i class="material-symbols-rounded align-middle" style="font-size: 1.2rem;">close</i> Tutup
        </a>

        <h4 class="mb-4"><?php echo htmlspecialchars($pageTitle); ?></h4>

        <form method="POST" action="jadwal_dokter_action.php">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <input type="hidden" name="action" value="<?php echo $isEdit ? 'update' : 'create'; ?>">

            <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?php echo $jadwal->id; ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Nama Dokter</label>
                <input type="text" name="nama_dokter" class="form-control" required
                    value="<?php echo htmlspecialchars($jadwal->nama_dokter ?? ''); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Spesialis</label>
                <input type="text" name="spesialis" class="form-control"
                    value="<?php echo htmlspecialchars($jadwal->spesialis ?? ''); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select" required>
                    <?php
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    foreach ($days as $day):
                        $selected = (isset($jadwal->hari) && $jadwal->hari === $day) ? 'selected' : '';
                    ?>
                    <option value="<?php echo $day; ?>" <?php echo $selected; ?>><?php echo $day; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required
                        value="<?php echo htmlspecialchars($jadwal->jam_mulai ?? ''); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required
                        value="<?php echo htmlspecialchars($jadwal->jam_selesai ?? ''); ?>">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan"
                    class="form-control"><?php echo htmlspecialchars($jadwal->keterangan ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="material-symbols-rounded align-middle">save</i> Simpan
            </button>
        </form>
    </div>
</body>

</html>