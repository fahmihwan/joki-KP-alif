<?php

include './././koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM tb_penjualan INNER JOIN tb_jenis_bbm ON fk_jenis_bbm = id_jenis");
if (isset($_POST['tampil_saja'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $query = mysqli_query($conn, "SELECT * FROM tb_penjualan INNER JOIN tb_jenis_bbm ON fk_jenis_bbm = id_jenis WHERE (tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai')");
}
if (isset($_POST['cetak'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    echo "<script>
        window.location.href = 'index.php?laporan=print_penjualan_periode&mulai=$tgl_mulai&selesai=$tgl_selesai'
    </script>";
}

?>
<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Laporan Penjualan</h3>
    <div class="card mb-4 ">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Laporan Penjualan
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>jenis_bbm</th>
                        <th>Sonding</th>
                        <th>Speed Awal</th>
                        <th>Speed Akhir</th>
                        <th>Penjualan (lt)</th>
                        <th>Total Penjualan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td><?= $data['tanggal']; ?></td>
                            <td><?= $data['nama_bbm']; ?></td>
                            <td><?= $data['sonding']; ?></td>
                            <td><?= $data['speed_awal']; ?></td>
                            <td><?= $data['speed_akhir']; ?></td>
                            <td><?= $data['penjualan'] . " liter"; ?> </td>
                            <td><?= 'Rp ' . number_format($data['total_penjualan'], 0, ',', '.') ?></td>
                            <td style="width: 80px;">
                                <a type="button" class="btn btn-outline-info btn-sm d-block" href="index.php?laporan=print_penjualan&id=<?= $data['id_penjualan']; ?>" role="button"><i class="fas fa-print"></i> </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fas fa-print"></i> Cetak Per Periode
            </button>
            <button type="button" class=" btn btn-outline-primary btn-sm" id="refresh">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Cetak PDF data penjualan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="tglMulai" class="form-label">Dari tanggal</label>
                                    <input type="date" class="form-control" id="tglMulai" name="tgl_mulai" required>
                                </div>

                                <div class="mb-5">
                                    <label for="tglSelesai" class="form-label">Sampai tanggal</label>
                                    <input type="date" class="form-control" id="tglSelesai" name="tgl_selesai" required>
                                </div>

                                <button type="submit" name="cetak" class="btn btn-outline-info btn-sm">Cetak</button>
                                <button type="submit" name="tampil_saja" class="btn btn-outline-warning btn-sm">Tampilkan Saja</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>