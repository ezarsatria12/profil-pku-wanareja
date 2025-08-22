<?php
// File: templates/admin/pages/jadwal-dokter-content.php
// Tampilan untuk daftar jadwal dokter di panel admin.
?>
<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <h4 class="mb-2">Daftar Jadwal Dokter</h4>
    <a href="jadwal_dokter_form.php" class="btn btn-success">
        <i class="material-symbols-rounded align-middle">add</i> Tambah Jadwal
    </a>
</div>

<?php if (isset($flashMessage)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $flashMessage; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php
// Menggantikan @if($jadwal->count())
if (!empty($jadwalDokter)):
?>
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-start">Nama Dokter</th>
                <th scope="col" class="text-start">Spesialis</th>
                <th scope="col">Hari</th>
                <th scope="col">Jam</th>
                <th scope="col" class="text-start">Keterangan</th>
                <th scope="col" style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Menggantikan @foreach($jadwal as $index => $item)
                foreach ($jadwalDokter as $index => $item):
                ?>
            <tr>
                <td class="text-center">
                    <?php
                            // Logika penomoran agar berlanjut di setiap halaman pagination
                            echo $index + 1 + (($currentPage - 1) * $itemsPerPage);
                            ?>
                </td>
                <td><?php echo htmlspecialchars($item->nama_dokter); ?></td>
                <td><?php echo htmlspecialchars($item->spesialis ?? '-'); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($item->hari); ?></td>
                <td class="text-center text-nowrap">
                    <?php echo (new DateTime($item->jam_mulai))->format('H:i') . ' - ' . (new DateTime($item->jam_selesai))->format('H:i'); ?>
                </td>
                <td><?php echo htmlspecialchars($item->keterangan ?? '-'); ?></td>
                <td class="text-center">
                    <a href="jadwal_dokter_form.php?id=<?php echo $item->id; ?>" class="btn btn-sm btn-info text-white">
                        Edit
                    </a>
                    <form method="POST" action="jadwal_dokter_action.php" class="d-inline"
                        onsubmit="return confirm('Anda yakin ingin menghapus jadwal ini?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    <?php
        // Memanggil fungsi pagination kita
        echo generate_pagination_links($currentPage, $totalPages, 'jadwal_dokter.php');
        ?>
</div>

<?php
else:
    // Menggantikan @else dari @if($jadwal->count())
?>
<div class="alert alert-info">Belum ada data jadwal dokter.</div>
<?php
endif;
?>