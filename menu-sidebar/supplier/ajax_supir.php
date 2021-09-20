<?php
include '../../koneksi.php';

$searchTerm = $_GET['term'];
$query = mysqli_query($conn, "SELECT * FROM tb_supir WHERE nama LIKE '%" . $searchTerm . "%' ORDER BY nama ASC");
while ($row = mysqli_fetch_assoc($query)) {
    if (!$searchTerm) {
        echo " ";
    } else {
        echo $row['telp'];
    }
}
