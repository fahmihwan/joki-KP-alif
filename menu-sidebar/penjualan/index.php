<?php
include './koneksi.php';

?>
<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Data Penjualan</h3>
    <div class="card mb-4 ">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Penjualan
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?penjualan=add" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>subsidi</th>
                        <th>Sonding</th>
                        <th>Speed Awal</th>
                        <th>Speed Akhir</th>
                        <th>Penjualan (lt)</th>
                        <th>Total Penjualan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT nama_bbm, id_penjualan, tanggal, sonding, speed_awal, speed_akhir, penjualan, total_penjualan  
                    FROM tb_penjualan
                    INNER JOIN tb_jenis_bbm ON tb_penjualan.fk_jenis_bbm = tb_jenis_bbm.id_jenis";
                    $query = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= $data['tanggal']; ?></td>
                            <td><?= $data['nama_bbm']; ?></td>
                            <td><?= $data['sonding']; ?></td>
                            <td><?= $data['speed_awal']; ?></td>
                            <td><?= $data['speed_akhir']; ?></td>
                            <td><?= $data['penjualan'] . " lt"; ?></td>
                            <td><?= 'Rp ' . number_format($data['total_penjualan'], 0, ',', '.'); ?></td>
                            <td>
                                <form>
                                    <a style="color:white;" type="button" class="btn btn-info btn-sm" href="index.php?penjualan=print_penjualan&id=<?= $data['id_penjualan']; ?>" role="button"><i class="fas fa-print"></i> </a>
                                    <a alert='penjualan' class="btn btn-danger btn-sm btn-del" href="index.php?penjualan=delete&id=<?= $data['id_penjualan']; ?>" role="button"><i class="fas fa-trash-alt"></i> </a>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>