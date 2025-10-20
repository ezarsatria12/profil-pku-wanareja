<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <h4 class="mb-2">Daftar Dokter</h4>
    <a href="jadwal_dokter_form.php" class="btn btn-success">
        <i class="material-symbols-rounded align-middle">add</i> Tambah Dokter
    </a>
</div>

<?php if (isset($flashMessage)): ?>
<div class="alert alert-<?php echo $flashMessage['type']; ?> alert-dismissible fade show" role="alert">
    <?php echo htmlspecialchars($flashMessage['message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-start">Nama Dokter</th>
                    <th scope="col">Foto</th>
                    <th scope="col" class="text-start">Spesialis</th>
                    <th scope="col" style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarDokter)): ?>
                <tr>
                    <td colspan="5" class="text-center p-3">Belum ada data dokter.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($daftarDokter as $index => $dokter): ?>
                <tr>
                    <td class="text-center"><?php echo $index + 1 + (($currentPage - 1) * $itemsPerPage); ?></td>
                    <td><?php echo htmlspecialchars($dokter->nama_dokter); ?></td>
                    <td class="text-center">
                        <?php if (!empty($dokter->foto)): ?>
                        <img src="<?php echo BASE_URL . '/uploads/dokter/' . htmlspecialchars($dokter->foto); ?>"
                            alt="Foto" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                        <?php else: ?><span class="text-muted small">N/A</span><?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($dokter->spesialis ?? '-'); ?></td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse"
                            href="#jadwal-<?php echo $dokter->id; ?>" role="button" aria-expanded="false"
                            aria-controls="jadwal-<?php echo $dokter->id; ?>">
                            Jadwal
                        </a>
                        <a href="jadwal_dokter_form.php?id=<?php echo $dokter->id; ?>"
                            class="btn btn-sm btn-info text-white">Edit</a>
                        <form method="POST" action="dokter_action.php" class="d-inline"
                            onsubmit="return confirm('Anda yakin ingin menghapus dokter ini? Semua jadwalnya juga akan terhapus.')">
                            <input type="hidden" name="action" value="delete"><input type="hidden" name="id"
                                value="<?php echo $dokter->id; ?>">
                            <input type="hidden" name="csrf_token"
                                value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <tr>
                    <td colspan="5" class="p-0" style="border: none;">
                        <div class="collapse" id="jadwal-<?php echo $dokter->id; ?>">
                            <div class="p-3 bg-light">
                                <h6 class="mb-2">Jadwal Praktik untuk
                                    <?php echo htmlspecialchars($dokter->nama_dokter); ?>:</h6>
                                <?php if (!empty($dokter->jadwal_list)): ?>
                                <table class="table table-sm table-striped mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                    $jadwal_items = explode(';', $dokter->jadwal_list);
                                                    foreach ($jadwal_items as $item):
                                                        list($hari, $mulai, $selesai) = explode('|', $item);
                                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($hari); ?></td>
                                            <td><?php echo htmlspecialchars($mulai); ?></td>
                                            <td><?php echo htmlspecialchars($selesai); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                <p class="mb-0 text-muted">Belum ada jadwal praktik yang ditambahkan untuk dokter ini.
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($totalPages > 1): ?>
<div class="d-flex justify-content-center mt-4">
    <?php echo generate_pagination_links($currentPage, $totalPages, 'jadwal_dokter.php'); ?>
</div>
<?php endif; ?>