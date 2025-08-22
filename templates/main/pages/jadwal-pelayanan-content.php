<?php
// File: templates/main/pages/jadwal-pelayanan-content.php
?>
<section id="services" class="services section bg-light py-5">
    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2>Jadwal Pelayanan</h2>
        <p>Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="table-responsive">
            <table class="table table-bordered align-middle shadow-sm bg-white">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jenis Pelayanan</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menggantikan @forelse($jadwalPelayanan as $index => $item)
                    if (!empty($jadwalPelayanan)):
                        foreach ($jadwalPelayanan as $index => $item):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($item->hari); ?></td>
                        <td><?php echo htmlspecialchars($item->jenis_pelayanan); ?></td>
                        <td class="text-nowrap">
                            <?php
                                    // Menggantikan Carbon dengan DateTime bawaan PHP
                                    $jamMulai = new DateTime($item->jam_mulai);
                                    $jamSelesai = new DateTime($item->jam_selesai);
                                    echo $jamMulai->format('H:i') . ' - ' . $jamSelesai->format('H:i');
                                    ?>
                        </td>
                        <td><?php echo htmlspecialchars($item->keterangan ?? '-'); ?></td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                        // Menggantikan @empty
                        ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data jadwal pelayanan.</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>