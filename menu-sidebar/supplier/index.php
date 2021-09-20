<?php
include 'koneksi.php';

?>
<div class="container-fluid px-4">
    <h3 class="mt-4 ">Data Supplier</h3>
    <div class="card mb-4 ">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Supplier
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?supplier=add" role="button" id="coba"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Tanggal</th>
                        <th>Nomor Polisi</th>
                        <th>Supir</th>
                        <th>Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tb_supplier 
                    INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir
                    INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi";
                    $no = 1;
                    $query = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= $data['id_supplier'] ?></td>
                            <td><?= $data['tanggal']; ?></td>
                            <td><?= $data['nomor_polisi']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['telp']; ?></td>
                            <td width="100px">
                                <a style="width: 80px;" class="btn btn-danger btn-sm btn-del " href="index.php?supplier=delete&id=<?= $data['id_supplier']; ?>" role="button"><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>