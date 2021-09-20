<?php
include './koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tb_pembelian WHERE id_pembelian=$id");

if (mysqli_affected_rows($conn) == 1) {
    echo "<script>
    alert('data berhasil di hapus');
    window.location.href = 'index.php?menu=update_stok';
    </script>";
} else {
    echo "<script>
    alert('data gagal di input');
    window.location.href = 'index.php?menu=update_stok';
    </script>";
}
