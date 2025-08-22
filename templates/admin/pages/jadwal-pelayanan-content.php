<?php
// File: templates/admin/pages/jadwal-pelayanan-content.php
?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <h4 class="mb-0">Daftar Jadwal Pelayanan</h4>
        <a href="jadwal_pelayanan_form.php" class="btn btn-success">
            <i class="material-symbols-rounded align-middle">add</i> Tambah Jadwal Pelayanan
        </a>
    </div>

    <?php if (isset($flashMessage)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $flashMessage; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-start">Jenis Pelayanan</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col" class="text-start">Keterangan</th>
                        <th scope="col" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jadwalPelayanan)): ?>
                    <tr>
                        <td colspan="6" class="text-center p-3">Belum ada jadwal pelayanan.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($jadwalPelayanan as $index => $item): ?>
                    <tr>
                        <td class="text-center"><?php echo $index + 1 + (($currentPage - 1) * $itemsPerPage); ?></td>
                        <td><?php echo htmlspecialchars($item->jenis_pelayanan); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($item->hari); ?></td>
                        <td class="text-center text-nowrap">
                            <?php echo (new DateTime($item->jam_mulai))->format('H:i') . ' - ' . (new DateTime($item->jam_selesai))->format('H:i'); ?>
                        </td>
                        <td><?php echo htmlspecialchars($item->keterangan ?? '-'); ?></td>
                        <td class="text-center">
                            <a href="jadwal_pelayanan_form.php?id=<?php echo $item->id; ?>"
                                class="btn btn-sm btn-info text-white">Edit</a>
                            <form method="POST" action="jadwal_pelayanan_action.php" class="d-inline"
                                onsubmit="return confirm('Anda yakin ingin menghapus jadwal ini?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($jadwalPelayanan)): ?>
        <div class="card-footer d-flex justify-content-center">
            <?php echo generate_pagination_links($currentPage, $totalPages, 'jadwal_pelayanan.php'); ?>
        </div>
        <?php endif; ?>
    </div>
</div>