<?php
include './koneksi.php';

$searchTerm = $_GET['term'];
$query = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE nomor_polisi LIKE '%" . $searchTerm . "%' ORDER BY nomor_polisi ASC");
while ($row = mysqli_fetch_assoc($query)) {
    // if (!$searchTerm) {
    //     echo " ";
    // } else {
    // }
    echo $row['nomor_polisi'];
}
