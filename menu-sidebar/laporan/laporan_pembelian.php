<?php
include './koneksi.php';

$query = mysqli_query($conn, "SELECT tb_pembelian.id_pembelian, tb_pembelian.tanggal, nama, tb_kendaraan.nomor_polisi, harga, tb_jenis_bbm.nama_bbm, jumlah_pemesanan  FROM tb_pembelian
INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm = tb_jenis_bbm.id_jenis
INNER JOIN tb_supplier ON tb_pembelian.fk_supplier = tb_supplier.id_supplier
INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi
INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir");

if (isset($_POST['tampil_saja'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];

    $query = mysqli_query($conn, "SELECT tb_pembelian.id_pembelian, tb_pembelian.tanggal, nama, tb_kendaraan.nomor_polisi, harga, tb_jenis_bbm.nama_bbm, jumlah_pemesanan  FROM tb_pembelian
    INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm = tb_jenis_bbm.id_jenis
    INNER JOIN tb_supplier ON tb_pembelian.fk_supplier = tb_supplier.id_supplier
    INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi
    INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir WHERE (tb_pembelian.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai')");
}
if (isset($_POST['cetak'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    echo "<script>
        window.location.href = 'index.php?laporan=print_pembelian_periode&mulai=$tgl_mulai&selesai=$tgl_selesai'
    </script>";
}

?>
<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Laporan Pembelian</h3>
    <div class="card mb-4 ">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Laporan Pembelian
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>tanggal</th>
                        <th>supplier</th>
                        <th>Plat</th>
                        <th>Jumlah (kl)</th>
                        <th>Harga</th>
                        <th>jenis BBM</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td><?= $data['tanggal']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['nomor_polisi']; ?></td>
                            <td><?= $data['jumlah_pemesanan']; ?> kl</td>
                            <td> <?= 'Rp' . number_format($data['harga'], '0', ',', '.'); ?></td>
                            <td><?= $data['nama_bbm']; ?></td>
                            <td style="width: 80px;">
                                <a type="button" class="btn btn-outline-info btn-sm  d-block" href="index.php?laporan=print_pembelian&id=<?= $data['id_pembelian']; ?>" role="button"><i class="fas fa-print"></i> </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fas fa-print"></i> Cetak Per Periode
            </button>
            <button type="button" class=" btn btn-outline-primary btn-sm" id="refreshPembelian">
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