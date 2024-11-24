<hr>
<table class="table table-striped table-bordered">
    <thead class="fw-bold">
        <tr>
            <td>No</td>
            <td>NISN</td>
            <td>Nama</td>
            <td>Kelas</td>
            <td>SPP (Tahun)</td>
            <td>Nominal</td>
            <td>Sudah Dibayar</td>
            <td>Kekurangan</td>
            <td>Status</td>
            <td>History</td>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../koneksi.php';
        $no = 1;

        // Ambil data siswa, kelas, dan SPP
        $sql = "SELECT siswa.*, kelas.nama_kelas, spp.tahun, spp.nominal 
                FROM siswa 
                JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
                JOIN spp ON siswa.id_spp = spp.id_spp 
                ORDER BY siswa.nama ASC";
        $query = mysqli_query($koneksi, $sql);

        foreach ($query as $data) {
            // Hitung total pembayaran siswa berdasarkan NISN
            $data_pembayaran = mysqli_query($koneksi, 
                "SELECT SUM(jumlah_bayar) as jumlah_bayar 
                 FROM pembayaran 
                 WHERE nisn = '{$data['nisn']}'"
            );
            $data_pembayaran = mysqli_fetch_array($data_pembayaran);
            $sudah_bayar = $data_pembayaran['jumlah_bayar'] ?? 0;

            // Hitung kekurangan
            $kekurangan = $data['nominal'] - $sudah_bayar;

            // Validasi agar pembayaran tidak melebihi nominal SPP
            if ($sudah_bayar > $data['nominal']) {
                $sudah_bayar = $data['nominal'];
                $kekurangan = 0;
            }

            // Format angka ke mata uang Indonesia
            function formatRupiah($angka) {
                return 'Rp ' . number_format($angka, 0, ',', '.');
            }
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['nisn']); ?></td>
                <td><?= htmlspecialchars($data['nama']); ?></td>
                <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                <td><?= htmlspecialchars($data['tahun']); ?></td>
                <td><?= formatRupiah($data['nominal']); ?></td>
                <td><?= formatRupiah($sudah_bayar); ?></td>
                <td><?= formatRupiah($kekurangan); ?></td>
                <td>
                    <?php if ($kekurangan <= 0): ?>
                        <span class="badge text-bg-success">Sudah Lunas</span>
                    <?php else: ?>
                        <a href="?url=tambah-pembayaran&nisn=<?= $data['nisn']; ?>&kekurangan=<?= $kekurangan; ?>" 
                           class="btn btn-danger">Pilih dan Bayar</a>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?url=history-pembayaran&nisn=<?= $data['nisn']; ?>" 
                       class="btn btn-warning">History</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
