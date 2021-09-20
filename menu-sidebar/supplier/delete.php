<?php

include './koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_supplier WHERE id_supplier=$id");
if (mysqli_affected_rows($conn) == 1) {
    echo "<script>
    window.location.href = 'index.php?menu=supplier&alert=success';
    </script>";
} else {
    echo "<script>
    window.location.href = 'index.php?menu=supplier&alert=error';
    </script>";
}
