<?php
include './koneksi.php';

$tgl_mulai = $_GET['mulai'];
$tgl_selesai = $_GET['selesai'];

$query = mysqli_query($conn, "SELECT * FROM tb_penjualan INNER JOIN tb_jenis_bbm ON fk_jenis_bbm = id_jenis WHERE (tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai')");


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
        <h2 style="text-align: center">Laporan Penjualan</h2>
        <p style="text-align: center">Pertashop Jambi</p>
        <b>Peridoe: <?= $tgl_mulai; ?> - <?= $tgl_selesai; ?></b>
    </div>
    <table>
        <tr>
            <th>tanggal</th>
            <th>penjualan</th>
            <th>Total Penjualan</th>
            <th>Sonding</th>
            <th>Speed Awal</th>
            <th>Speed Akhir</th>
        </tr>
        <?php
        while ($data = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $data['tanggal']; ?></td>
                <td><?= $data['penjualan']; ?></td>
                <td><?= $data['total_penjualan']; ?></td>
                <td><?= $data['sonding']; ?></td>
                <td><?= $data['speed_awal']; ?></td>
                <td><?= $data['speed_akhir']; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
    <script>
        window.print();
        setTimeout(function() {
            window.location.href = "index.php?laporan=penjualan"
        }, 500)
    </script>
</body>


</html>