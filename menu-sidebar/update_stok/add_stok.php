<?php
include './koneksi.php';

$cekSubisdi = mysqli_query($conn, "SELECT id_jenis, stok, nama_bbm FROM tb_jenis_bbm");
$arr = [];
while ($fetch = mysqli_fetch_assoc($cekSubisdi)) {
    $arr[] = $fetch;
}

$queryFk = mysqli_query($conn, "SELECT id_supplier FROM tb_supplier ORDER BY id_supplier DESC LIMIT 1");
$fk_supplier = mysqli_fetch_assoc($queryFk)['id_supplier'];

if (isset($_POST['submit'])) {
    $tgl = htmlspecialchars($_POST['tanggal']);
    $jenis_bbm = htmlspecialchars($_POST['jenis_bbm']);
    $jumlah_pemesanan = htmlspecialchars($_POST['jumlah_pemesanan']);
    $harga = htmlspecialchars($_POST['harga']);

    $stok = mysqli_query($conn, "SELECT stok FROM tb_jenis_bbm WHERE id_jenis='$jenis_bbm'");
    $stok = mysqli_fetch_assoc($stok)['stok'];

    $sqlInsert = "INSERT INTO tb_pembelian 
    (id_pembelian, tanggal, jumlah_pemesanan, harga, fk_supplier, fk_jenis_bbm)
     VALUES ('','$tgl','$jumlah_pemesanan','$harga','$fk_supplier','$jenis_bbm');";

    $qty = $jumlah_pemesanan * 1000;
    $qty += $stok;

    $sqlUpdate = "UPDATE tb_jenis_bbm SET stok='$qty' WHERE id_jenis='$jenis_bbm'";

    try {
        $db = new PDO(dsn: 'mysql:host=localhost;dbname=db_pertashop', username: 'root', password: '');
        $db->beginTransaction();
        $db->exec(statement: $sqlInsert);
        $db->exec(statement: $sqlUpdate);
        $db->commit();
    } catch (\Throwable $e) {
        $db->rollBack();
        throw $e;
    }

    if (mysqli_affected_rows($conn) == "1") {
        echo "<script>
    alert('data berhasil di tambahkan');
    window.location.href = 'index.php?menu=update_stok';
    </script>";
    }
}

?>
<div class="container-fluid px-4 col-md-8 float-start ">
    <div class="card mt-4">
        <div class="card-header">
            Tambah Stok BBM
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?menu=update_stok" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body  ">
            <form method="POST">
                <div class="form-group mb-3">
                    <label for="tanggal" class="form-label"><b>Tanggal</b></label>
                    <input type="date" class="form-control" id="tanggal" autocomplete="off" name="tanggal" required>
                </div>
                <div class=" form-group mb-3">
                    <?php if (count($arr) == 1) : ?>
                        <input type="hidden" value="<?= $arr[0]['id_jenis']; ?>" name="jenis_bbm" required>
                    <?php endif; ?>
                    <?php if (count($arr) > 1) : ?>
                        <label for=" jenis_bbm" class="form-label"><b>Jenis BBM</b></label>
                        <select class="form-select" aria-label="Default select example" id="jenis_bbm" name="jenis_bbm" required>
                            <option selected></option>
                            <?php foreach ($arr as $jenis) : ?>
                                <option value="<?= $jenis['id_jenis']; ?>"><?= $jenis['nama_bbm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-3">
                    <label for="jumlah_pemesanan" class="form-label"><b>Jumlah Pemesanan</b></label>
                    <select class="form-select" aria-label="Default select example" id="jumlah_pemesanan" name="jumlah_pemesanan" required>
                        <option selected></option>
                        <option value="1">1 kl</option>
                        <option value="2">2 kl</option>
                        <option value="3">3 kl</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="harga" class="form-label"><b>Harga</b></label>
                    <input type="number" class="form-control" id="harga" autocomplete="off" name="harga" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary mt-4">Simpan</button>
                <button type="reset" class="btn btn-warning mt-4">reset</button>
            </form>
        </div>
    </div>
</div>