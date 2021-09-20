<?php 

include './koneksi.php';

$id=$_GET['id'];

mysqli_query($conn, "DELETE FROM tb_penjualan WHERE id_penjualan='$id'");

if (mysqli_affected_rows($conn) == 1) {
    echo "<script>
    alert('data berhasil di hapus');
    window.location.href = 'index.php?menu=penjualan';
    </script>";
} else {
    echo "<script>
    alert('data gagal dihapus);
    window.location.href = 'index.php?menu=penjualan';
    </script>";
}


?>