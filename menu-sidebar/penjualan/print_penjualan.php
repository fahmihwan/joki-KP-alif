<?php

include '././koneksi.php';

$conn = mysqli_connect('localhost', 'root', '', 'db_pertashop');
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_penjualan WHERE id_penjualan='$id'");
$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERTAMINA</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    table tr td {
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
    <h2 style="text-align: center">Laporan Penjualan</h2>
    <p style="text-align: center">Pertashop Jambi</p>
    <b>Tanggal : <?= $data['tanggal']; ?></b>
    <table>
        <tr>
            <td>Sonding</td>
            <td><?= $data['sonding']; ?></td>
        </tr>
        <tr>
            <td>speed awal</td>
            <td><?= $data['speed_awal'] ?></td>
        </tr>
        <tr>
            <td>speed akhir</td>
            <td><?= $data['speed_akhir']; ?></td>
        </tr>
        <tr>
            <td>penjualan</td>
            <td><?= $data['penjualan']; ?> liter</td>
        </tr>
        <tr>
            <td>total penjualan</td>
            <td><?= "Rp " . number_format($data['total_penjualan'], 0, ',', '.'); ?></td>
        </tr>

    </table>
    <script>
        window.print();
        setTimeout(function() {
            window.location.href = "index.php?menu=penjualan"
        }, 100)
    </script>
</body>

</html>