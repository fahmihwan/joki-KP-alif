<?php
include './koneksi.php';

$cekSubisdi = mysqli_query($conn, "SELECT id_jenis, nama_bbm, harga_jual FROM tb_jenis_bbm");
$arr = [];
while ($fetch = mysqli_fetch_assoc($cekSubisdi)) {
    $arr[] = $fetch;
}

if (isset($_POST['submit'])) {
    $tgl = htmlspecialchars($_POST['tanggal']);
    $jenis_bbm = htmlspecialchars($_POST['jenis_bbm']);
    $sonding = htmlspecialchars($_POST['sonding']);
    $speed_awal = htmlspecialchars($_POST['speed_awal']);
    $speed_akhir = htmlspecialchars($_POST['speed_akhir']);
    $penjualan = htmlspecialchars($_POST['penjualan']);

    if ($jenis_bbm !== 'X') {
        $query_subsidi = mysqli_query($conn, "SELECT stok, harga_jual FROM tb_jenis_bbm WHERE id_jenis = '$jenis_bbm'");
        $data_subsidi = mysqli_fetch_assoc($query_subsidi);

        if ($data_subsidi['stok'] > $penjualan) {
            if ($speed_akhir > $speed_awal) {
                $qty = $penjualan * $data_subsidi['harga_jual'];
                $updateStok = $data_subsidi['stok'] - $penjualan;

                $sqlInsert = "INSERT INTO tb_penjualan 
            (id_penjualan, tanggal, penjualan, total_penjualan, sonding, speed_awal, speed_akhir, fk_jenis_bbm)
            VALUES ('','$tgl','$penjualan','$qty','$sonding','$speed_awal','$speed_akhir','$jenis_bbm')";

                $sqlUpdate = "UPDATE tb_jenis_bbm SET stok='$updateStok' WHERE id_jenis='$jenis_bbm'";

                try {
                    $db = new PDO(dsn: 'mysql:host=localhost;dbname=db_pertashop', username: 'root', password: '');
                    $db->beginTransaction();

                    $db->exec(statement: $sqlInsert);
                    $db->exec(statement: $sqlUpdate);

                    $db->commit();
                } catch (\Throwable $e) {
                    $db->rollback();
                    throw $e;
                }
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>
                alert('data berhasil di tambahkan');
                window.location.href = 'index.php?menu=penjualan';
            </script>";
                } else {
                    echo "<script>
                alert('data gagal di tambahkan');
                window.location.href = 'index.php?menu=penjualan';
                </script>";
                }
            } else {
                echo "<script>
                alert('speed akhir tidak boleh lebih kecil dari speed awal');
            </script>";
            }
        } else {
            echo "<script>
        alert('stok anda tidak cukup');
    </script>";
        }
    } else {
        echo "<script>
        alert('jenis bbm belum di pilih');
    </script>";
    }
}



?>
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            Tambah Penjualan
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?menu=penjualan" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="tanggal" class="form-label"> <b>Tanggal</b> </label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="form-group mb-3">
                    <?php if (count($arr) === 1) : ?>

                        <input type="hidden" value="<?= $arr[0]['id_jenis']; ?>" name="jenis_bbm" id="jenis_bbm_ajax">
                    <?php endif; ?>
                    <?php if (count($arr) > 1) : ?>
                        <label for=" jenis_bbm_ajax" class="form-label"><b>Jenis BBM</b></label>
                        <select class="form-select" aria-label="Default select example" id="jenis_bbm_ajax" name="jenis_bbm">
                            <option value="X">-- pilih --</option>
                            <?php foreach ($arr as $jenis) : ?>
                                <option value="<?= $jenis['id_jenis']; ?>"><?= $jenis['nama_bbm']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="sonding" class="form-label"><b>Sonding</b></label>
                    <input type="text" class="form-control" id="sonding" name="sonding" required>
                </div>
                <?php
                $que_speed = mysqli_query($conn, "SELECT speed_akhir FROM tb_penjualan ORDER BY speed_akhir DESC LIMIT 1");
                $data = mysqli_fetch_assoc($que_speed);
                if (count($arr) == 1) :
                ?>
                    <label for="speed_awal" class="form-label"><b>Speed Awal</b></label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="speed_awal" id="speed_awal" aria-describedby="speed_awal" readonly value="<?= ($data == null) ? 0 : $data['speed_akhir']; ?>">
                        <button class="btn btn-danger" type="button" id="reset_speed">Reset Speed</button>
                    </div>
                <?php endif; ?>
                <?php if (count($arr) > 1) : ?>

                    <label for="speed_awal" class="form-label"><b>Speed Awal</b></label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="speed_awal" id="speed_awal" aria-describedby="speed_awal" readonly>
                        <button class="btn btn-danger" type="button" id="reset_speed">Reset Speed</button>
                    </div>
                    <!-- 
                        original
                        <div class="mb-3">
                        <label for="speed_awal" class="form-label"><b>Speed Awal</b></label>
                        <input type="number" class="form-control" id="speed_awal" name="speed_awal" readonly>
                    </div> -->
                <?php endif; ?>
                <div class="mb-3">
                    <label for="speed_akhir" class="form-label"><b>Speed Akhir</b></label>
                    <input type="number" class="form-control" id="speed_akhir" name="speed_akhir" required>
                </div>
                <div class="mb-3">
                    <label for="penjualan" class="form-label"><b>Penjualan (lt)</b></label>
                    <input type="text" class="form-control" id="penjualan" value="" name="penjualan" readonly required>
                </div>
                <button type="submit" class="btn btn-primary mt-4" name="submit">Simpan</button>
                <button type="reset" class="btn btn-warning mt-4">reset</button>
            </form>
        </div>
    </div>
</div>