<?php

include '../../koneksi.php';
$searchTerm = $_GET['id'];

$que_speed = mysqli_query($conn, "SELECT speed_akhir FROM tb_penjualan WHERE fk_jenis_bbm='$searchTerm' ORDER BY speed_akhir DESC LIMIT 1");

$data = mysqli_fetch_assoc($que_speed);
if (!$data) {
    echo "0";
} else {
    echo $data['speed_akhir'];
}
