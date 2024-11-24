<h5>Laporan Pembayaran SPP</h5>
<a href="cetak-laporan.php" class="btn btn-primary"> Cetak Laporan </a>
<hr>
<table class="table table-striped table-bordered">
    <tr class="fw-bold">
        <td>No</td>
        <td>NISN</td>
        <td>Nama</td>
        <td>Kelas</td>
        <td>Tahun SPP</td>
        <td>Nominal SPP</td>
        <td>Sudah Dibayar</td>
        <td>Kekurangan</td>
        <td>Tanggal Bayar</td>
        <td>Petugas</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;

    // Query untuk mengambil semua data pembayaran
    $sql = "
        SELECT 
            siswa.nisn, 
            siswa.nama, 
            kelas.nama_kelas, 
            spp.tahun, 
            spp.nominal, 
            pembayaran.jumlah_bayar, 
            pembayaran.tgl_bayar, 
            petugas.nama_petugas 
        FROM pembayaran 
        INNER JOIN siswa ON pembayaran.nisn = siswa.nisn 
        INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
        INNER JOIN spp ON pembayaran.id_spp = spp.id_spp 
        INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
        ORDER BY pembayaran.tgl_bayar DESC
    ";

    $query = mysqli_query($koneksi, $sql);

    foreach ($query as $data) {
        // Total pembayaran yang sudah dilakukan oleh siswa
        $total_bayar = mysqli_query($koneksi, "
            SELECT SUM(jumlah_bayar) AS total_bayar 
            FROM pembayaran 
            WHERE nisn = '{$data['nisn']}' AND id_spp = (
                SELECT id_spp FROM spp WHERE tahun = '{$data['tahun']}'
            )
        ");
        $total_bayar = mysqli_fetch_assoc($total_bayar)['total_bayar'];

        // Hitung kekurangan
        $kekurangan = $data['nominal'] - $total_bayar;
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['nisn']); ?></td>
            <td><?= htmlspecialchars($data['nama']); ?></td>
            <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
            <td><?= htmlspecialchars($data['tahun']); ?></td>
            <td><?= number_format($data['nominal'], 2, ',', '.'); ?></td>
            <td><?= number_format($total_bayar, 2, ',', '.'); ?></td>
            <td>
                <?php
                if ($kekurangan <= 0) {
                    echo "Rp 0"; // Jika sudah lunas, tampilkan Rp 0
                } else {
                    echo number_format($kekurangan, 2, ',', '.');
                }
                ?>
            </td>
            <td><?= htmlspecialchars($data['tgl_bayar']); ?></td>
            <td><?= htmlspecialchars($data['nama_petugas']); ?></td>
        </tr>
    <?php } ?>
</table>
