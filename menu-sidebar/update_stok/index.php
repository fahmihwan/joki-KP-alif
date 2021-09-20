<?php
include 'koneksi.php';

// cek jenis bbm
$subsidi = mysqli_query($conn, "SELECT count(id_jenis) FROM tb_jenis_bbm");
$subsidi = mysqli_fetch_assoc($subsidi)["count(id_jenis)"];

?>

<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Data Pembelian BBM</h3>
    <div class="card mb-4 ">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data pembelian BBM
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?update_stok=add" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>pengemudi</th>
                        <th>tanggal</th>
                        <th>Jumlah (kl)</th>
                        <th>Harga</th>
                        <?php if ($subsidi > 1) : ?>
                            <th>jenis BBM</th>
                        <?php endif; ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id_pembelian, tb_pembelian.tanggal, jumlah_pemesanan, harga, nama_bbm, nama FROM tb_pembelian 
                            INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm=tb_jenis_bbm.id_jenis
                            INNER JOIN tb_supplier ON tb_pembelian.fk_supplier=tb_supplier.id_supplier
                            INNER JOIN tb_supir ON tb_supplier.supir=tb_supir.id_supir";
                    ?>
                    <?php $result =  mysqli_query($conn, $sql);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['tanggal']; ?></td>
                            <td><?= $data['jumlah_pemesanan'] ?> kl</td>
                            <td> <?= 'Rp ' . number_format($data['harga'], 0, ',', '.'); ?></td>
                            <?php if ($subsidi > 1) : ?>
                                <td><?= $data['nama_bbm']; ?></td>
                            <?php endif; ?>
                            <td width="100px">
                                <a alert='pembelian bbm' class="btn btn-danger btn-sm btn-del" href="index.php?update_stok=delete&id=<?= $data['id_pembelian']; ?>" role="button"><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>