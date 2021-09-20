<?php
include './koneksi.php';


if (isset($_POST['submit'])) {
    $supir = htmlspecialchars($_POST['supir']);
    $telp = htmlspecialchars($_POST['telp']);
    $nopol = htmlspecialchars($_POST['nopol']);
    $tgl = htmlspecialchars($_POST['tgl']);

    $select_supir = mysqli_query($conn, "SELECT id_supir, telp FROM tb_supir WHERE nama ='$supir'");
    $select_nopol = mysqli_query($conn, "SELECT nomor_polisi FROM tb_kendaraan WHERE nomor_polisi ='$nopol'");

    $num_supir =  mysqli_num_rows($select_supir);
    $num_nopol = mysqli_num_rows($select_nopol);
    if (!$num_supir) {
        mysqli_query($conn, "INSERT INTO tb_supir (id_supir,nama,telp) VALUES ('','$supir','$telp')");
    }
    if (!$num_nopol) {
        mysqli_query($conn, "INSERT INTO tb_kendaraan (nomor_polisi) VALUES ('$nopol')");
    };
    $cekTelp = mysqli_fetch_assoc($select_supir);
    $cekTelpId = $cekTelp['id_supir'];

    if ($cekTelp['telp'] !==  $telp) {
        mysqli_query($conn, "UPDATE tb_supir SET telp='$telp' WHERE id_supir = '$cekTelpId' ");
    }
    $id = mysqli_query($conn, "SELECT id_supir FROM tb_supir WHERE nama='$supir'");
    $id = mysqli_fetch_assoc($id)['id_supir'];

    mysqli_query($conn, "INSERT INTO tb_supplier (id_supplier,tanggal,supir,nomor_polisi) VALUES('','$tgl','$id','$nopol')");

    if (mysqli_affected_rows($conn) == 1) {
        echo "<script>
        window.location.href = 'index.php?menu=supplier';
        </script>";
    } else {
        echo "<script>
        alert('data gagal di input');
        </script>";
    }
}

$supir_select = mysqli_query($conn, "SELECT nama FROM tb_supir");
$nopol_select = mysqli_query($conn, "SELECT nomor_polisi FROM tb_kendaraan");

?>
<div class="container-fluid px-4">
    <h3 class="mt-4 ">Tambah Data Supplier</h3>
    <div class="card mt-4 mb-4 col-md-8">
        <div class="card-header">
            Tambah Supplier
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?menu=supplier" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group mb-2">
                    <label for="supir" class="form-label">Supir</label>
                    <input class="form-control" list="data_supir" id="supir" placeholder="supir" autocomplete="off" name="supir" required>
                    <datalist id="data_supir">
                        <?php while ($data = mysqli_fetch_assoc($supir_select)) : ?>
                            <option value="<?= $data['nama']; ?>">
                            <?php endwhile; ?>
                    </datalist>
                </div>

                <div class="form-group mb-2">
                    <label for="telp">no telp</label>
                    <input type="text" class="form-control" id="telp" placeholder="" autocomplete="off" name="telp" required>
                </div>

                <div class="form-group mb-2">
                    <label for="nopol" class="form-label">Nomor Polisi</label>
                    <input class="form-control" list="data_kendaraan" id="nopol" placeholder="nomor polisi" autocomplete="off" name="nopol" required>
                    <datalist id="data_kendaraan">
                        <?php while ($data = mysqli_fetch_assoc($nopol_select)) : ?>
                            <option value="<?= $data['nomor_polisi']; ?>">
                            <?php endwhile; ?>
                    </datalist>
                </div>

                <div class="form-group mb-2">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="" autocomplete="off" name="tgl" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary mt-4">Simpan</button>
                <button type="reset" class="btn btn-warning mt-4">reset</button>
            </form>
        </div>
    </div>
</div>