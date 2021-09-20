<?php

// include './koneksi.php';

$conn = mysqli_connect('localhost', 'root', '', 'db_pertashop');
$id = $_GET['id'];

$sql = "SELECT tb_pembelian.id_pembelian, tb_pembelian.tanggal, nama, tb_kendaraan.nomor_polisi, harga, nama_bbm, jumlah_pemesanan FROM tb_pembelian 
INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm = tb_jenis_bbm.id_jenis
INNER JOIN tb_supplier ON tb_pembelian.fk_supplier = tb_supplier.id_supplier
INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi
INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir
WHERE id_pembelian='$id'";
$query = mysqli_query($conn, $sql);

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
    <h2 style="text-align: center">Laporan Pembelian</h2>
    <p style="text-align: center">Pertashop Jambi</p>
    <b>Tanggal : <?= $data['tanggal']; ?></b>
    <table>
        <tr>
            <td>supplier</td>
            <td><?= $data['nama']; ?></td>
        </tr>
        <tr>
            <td>Nomor Polisi</td>
            <td><?= $data['nomor_polisi']; ?></td>
        </tr>
        <tr>
            <td>jumlah pemesanan</td>
            <td><?= $data['jumlah_pemesanan']; ?> kl</td>
        </tr>
        <tr>
            <td>harga</td>
            <td><?= $data['harga']; ?> </td>
        </tr>
        <tr>
            <td>subsidi</td>
            <td><?= $data['nama_bbm']; ?></td>
        </tr>


    </table>
    <script>
        window.print();
        setTimeout(function() {
            window.location.href = "index.php?laporan=pembelian"
        }, 100)
    </script>
</body>

</html>