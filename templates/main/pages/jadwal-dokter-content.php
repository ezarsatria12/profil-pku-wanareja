<?php
// File: templates/main/pages/jadwal-dokter-content.php
?>
<section id="jadwal-dokter" class="services section bg-light py-5">
    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2>Jadwal Dokter</h2>
        <p>Klinik Pratama Rawat Inap PKU Muhammadiyah Wanareja</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="table-responsive">
            <table class="table table-bordered align-middle shadow-sm bg-white">
                <thead class="table-success text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menggantikan @forelse($jadwalDokter as $index => $dokter)
                    if (!empty($jadwalDokter)):
                        foreach ($jadwalDokter as $index => $dokter):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($dokter->nama_dokter); ?></td>
                        <td><?php echo htmlspecialchars($dokter->spesialis ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($dokter->hari); ?></td>
                        <td class="text-nowrap">
                            <?php
                                    // Menggantikan Carbon dengan DateTime bawaan PHP untuk format jam
                                    $jamMulai = new DateTime($dokter->jam_mulai);
                                    $jamSelesai = new DateTime($dokter->jam_selesai);
                                    echo $jamMulai->format('H:i') . ' - ' . $jamSelesai->format('H:i');
                                    ?>
                        </td>
                        <td><?php echo htmlspecialchars($dokter->keterangan ?? '-'); ?></td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                        // Menggantikan @empty
                        ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data jadwal dokter.</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>