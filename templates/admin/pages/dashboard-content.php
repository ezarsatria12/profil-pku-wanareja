<?php
// File: templates/admin/pages/dashboard-content.php
// Konten untuk halaman utama dashboard admin.
?>
<div class="row">
    <div class="col-12">
        <div class="card p-4">
            <h4>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?>!</h4>
            <p class="mb-0">Anda telah berhasil masuk ke Dashboard Admin PKU Muhammadiyah Wanareja.</p>
            <p>Gunakan menu di samping kiri untuk mengelola konten website seperti Berita, Jadwal, dan Galeri.</p>
        </div>
    </div>
</div>