<?php
include './koneksi.php';

$tgl_mulai = $_GET['mulai'];
$tgl_selesai = $_GET['selesai'];

$query = mysqli_query($conn, "SELECT tb_pembelian.id_pembelian, tb_pembelian.tanggal, nama, tb_kendaraan.nomor_polisi, harga, tb_jenis_bbm.nama_bbm, jumlah_pemesanan  FROM tb_pembelian
INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm = tb_jenis_bbm.id_jenis
INNER JOIN tb_supplier ON tb_pembelian.fk_supplier = tb_supplier.id_supplier
INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi
INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir WHERE (tb_pembelian.tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai')");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .header {
        text-align: center;
    }

    table tr td,
    th {
        border: 1px solid black;
        padding: 10px;
        width: 300px;

    }

    table {
        border-collapse: collapse;
        margin: 50px auto;

    }
</style>

<body>
    <div class="header">
        <h2 style="text-align: center">Laporan Pembelian</h2>
        <p style="text-align: center">Pertashop Jambi</p>
        <b>Peridoe: <?= $tgl_mulai; ?> - <?= $tgl_selesai; ?></b>
    </div>
    <table>
        <tr>
            <th>tanggal</th>
            <th>supplier</th>
            <th>Plat</th>
            <th>Jumlah (kl)</th>
            <th>Harga</th>
            <th>jenis BBM</th>
        </tr>
        <?php
        while ($data = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $data['tanggal']; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['nomor_polisi']; ?></td>
                <td><?= $data['jumlah_pemesanan']; ?> kl</td>
                <td> <?= 'Rp' . number_format($data['harga'], '0', ',', '.'); ?></td>
                <td><?= $data['nama_bbm']; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
    <script>
        window.print();
        setTimeout(function() {
            window.location.href = "index.php?laporan=pembelian"
        }, 500)
    </script>
</body>


</html>