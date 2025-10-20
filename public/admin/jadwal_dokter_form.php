<?php
                        session_start();
                        if (!isset($_SESSION['user_id'])) {
                            header("HTTP/1.1 403 Forbidden");
                            exit("Akses dilarang.");
                        }

                        require_once __DIR__ . '/../../app/database.php';
                        require_once __DIR__ . '/../../app/functions.php';

                        // Keamanan: Hanya izinkan metode POST dan verifikasi CSRF
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                                die('Invalid CSRF token');
                            }
                        }// Memanggil fungsi CSRF dari functions.php

$dokter = null;
$jadwalPraktik = [];
$isEdit = false;

// Cek apakah ini mode EDIT (ada ID dokter di URL)
if (isset($_GET['id'])) {
    $isEdit = true;
    $id = (int)$_GET['id'];

    // Ambil data dari tabel `dokter`
    $stmt = $pdo->prepare("SELECT * FROM dokter WHERE id = ?");
    $stmt->execute([$id]);
    $dokter = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$dokter) {
        $_SESSION['flash_message'] = ['type' => 'danger', 'message' => 'Dokter tidak ditemukan.'];
        header('Location: jadwal_dokter.php');
        exit;
    }

    // Ambil semua jadwal praktik yang terhubung dengan dokter ini
    $stmt = $pdo->prepare("SELECT * FROM jadwal_praktik WHERE dokter_id = ? ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), jam_mulai ASC");
    $stmt->execute([$id]);
    $jadwalPraktik = $stmt->fetchAll(PDO::FETCH_OBJ);
}

$pageTitle = $isEdit ? 'Edit Dokter & Jadwal' : 'Tambah Dokter Baru';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Admin PKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light min-vh-100 p-3 p-md-4">
    <div class="container bg-white rounded shadow-sm p-4">
        <h4 class="mb-4"><?php echo htmlspecialchars($pageTitle); ?></h4>

        <form method="POST" action="dokter_action.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <input type="hidden" name="id" value="<?php echo $dokter->id ?? 0; ?>">
            <input type="hidden" name="foto_lama" value="<?php echo htmlspecialchars($dokter->foto ?? ''); ?>">

            <div class="card mb-4">
                <div class="card-header">Informasi Dokter</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3"><label class="form-label">Nama Dokter</label><input type="text"
                                    name="nama_dokter" class="form-control" required
                                    value="<?php echo htmlspecialchars($dokter->nama_dokter ?? ''); ?>"></div>
                            <div class="mb-3"><label class="form-label">Spesialis</label><input type="text"
                                    name="spesialis" class="form-control"
                                    value="<?php echo htmlspecialchars($dokter->spesialis ?? ''); ?>"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Foto</label><input class="form-control" type="file" name="foto"
                                accept="image/png, image/jpeg, image/webp">
                            <?php if ($isEdit && !empty($dokter->foto)): ?><img
                                src="<?php echo BASE_URL . '/uploads/dokter/' . htmlspecialchars($dokter->foto); ?>"
                                alt="Foto" class="img-thumbnail mt-2" width="100"><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Kelola Jadwal Praktik
                    <button type="button" id="tambah-jadwal-btn" class="btn btn-sm btn-primary"><i
                            class="bi bi-plus-circle"></i> Tambah Jadwal</button>
                </div>
                <div class="card-body">
                    <div id="jadwal-container">
                        <?php if (!empty($jadwalPraktik)): ?>
                        <?php foreach ($jadwalPraktik as $jadwal): ?>
                        <div class="row align-items-center mb-2 jadwal-row">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <select name="jadwal_hari[]" class="form-select">
                                    <?php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; ?>
                                    <?php foreach ($days as $day): ?>
                                    <option value="<?php echo $day; ?>"
                                        <?php echo ($day === $jadwal->hari) ? 'selected' : ''; ?>><?php echo $day; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0"><input type="time" name="jadwal_jam_mulai[]"
                                    class="form-control" value="<?php echo $jadwal->jam_mulai; ?>"></div>
                            <div class="col-md-3 mb-2 mb-md-0"><input type="time" name="jadwal_jam_selesai[]"
                                    class="form-control" value="<?php echo $jadwal->jam_selesai; ?>"></div>
                            <div class="col-md-2"><button type="button"
                                    class="btn btn-danger w-100 hapus-jadwal-btn">Hapus</button></div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="jadwal_dokter.php" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <div id="jadwal-template" style="display: none;">
        <div class="row align-items-center mb-2 jadwal-row">
            <div class="col-md-4 mb-2 mb-md-0"><select name="jadwal_hari[]" class="form-select">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select></div>
            <div class="col-md-3 mb-2 mb-md-0"><input type="time" name="jadwal_jam_mulai[]" class="form-control"
                    value="08:00"></div>
            <div class="col-md-3 mb-2 mb-md-0"><input type="time" name="jadwal_jam_selesai[]" class="form-control"
                    value="12:00"></div>
            <div class="col-md-2"><button type="button" class="btn btn-danger w-100 hapus-jadwal-btn">Hapus</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tambahBtn = document.getElementById('tambah-jadwal-btn');
        const container = document.getElementById('jadwal-container');
        const templateNode = document.getElementById('jadwal-template').firstElementChild;

        tambahBtn.addEventListener('click', function() {
            const newRow = templateNode.cloneNode(true);
            container.appendChild(newRow);
        });

        // Event delegation untuk semua tombol hapus (baik yang lama maupun yang baru)
        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-jadwal-btn')) {
                // Hapus baris jadwal dari tampilan
                e.target.closest('.jadwal-row').remove();
            }
        });
    });
    </script>
</body>

</html>