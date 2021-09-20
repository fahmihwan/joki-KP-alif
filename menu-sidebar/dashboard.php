<?php
include "./koneksi.php";

$query_subsidi = mysqli_query($conn, "SELECT nama_bbm,stok FROM tb_jenis_bbm");
function average($bulan, $tahun)
{
    global $conn;
    if ($tahun == null) {
        $tahun = date('Y');
    }
    $sql = "SELECT Avg(penjualan) as avgP FROM tb_penjualan WHERE month(tanggal) = '$bulan' AND year(tanggal) = '$tahun'";
    $sqlData = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($sqlData);
    $avg = ($data['avgP'] != Null) ? $data['avgP'] : 0;
    return $avg;
}
?>
<div class="container-fluid px-4">
    <h3 class="mt-4 mb-3">Dashboard</h3>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Catat Penjualan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?menu=penjualan">catat transaksi penjualan</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Laporan Pembelian</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?laporan=pembelian">Detail laporan pembelian</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Laporan Penjualan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?laporan=penjualan">Detail Semua Laporan</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Tambah Stok</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="index.php?menu=update_stok">Beli Stok</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php while ($sub = mysqli_fetch_assoc($query_subsidi)) : ?>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Stok <?= $sub['nama_bbm']; ?>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 20px;">
                            <?php
                            $liter = $sub['stok'] / 3000;
                            $liter *=  100;
                            ?>
                            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated " role="progressbar" style="width: <?= $liter ?>%;"> <?= $sub['stok']; ?> liter</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="row">
        <div class="card mb-4">

            <div class="card-header">
                <span class="float-start">
                    <i class="fas fa-chart-area me-1"></i>
                    Informasi Penjualan Pertahun
                </span>
                <?php
                $year = mysqli_query($conn, "SELECT YEAR(tanggal) as years FROM tb_penjualan ORDER BY years ASC");
                $years = mysqli_fetch_assoc($year);
                ?>
                <form action="" method="POST">
                    <div class="input-group input-group-sm float-end" style=" width: 200px;">
                        <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="year">
                            <option value=""> <?= (isset($_POST['submit'])) ? $_POST['year'] : date('Y'); ?> </option>
                            <?php for ($i = $years['years']; $i <= date('Y'); $i++) : ?>
                                <option value="<?= $i; ?>"> <?= $i; ?> </option>
                            <?php endfor; ?>
                        </select>
                        <button class="btn btn-primary" name="submit" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>

            </div>
            <div class=" card-body"><canvas id="myChart" height="80px"></canvas>
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
    </div>
</div>
<script>
    <?php
    if (isset($_POST['submit'])) :
        $year =  $_POST['year'];
    ?>
        let arrayData = [<?= average(1, $year); ?>,
            <?= average(2, $year); ?>,
            <?= average(3, $year); ?>,
            <?= average(4, $year); ?>,
            <?= average(5, $year); ?>,
            <?= average(6, $year); ?>,
            <?= average(7, $year); ?>,
            <?= average(8, $year); ?>,
            <?= average(9, $year); ?>,
            <?= average(10, $year); ?>,
            <?= average(11, $year); ?>,
            <?= average(12, $year); ?>,
        ];
    <?php endif;
    if (!isset($_POST['submit'])) :
    ?>
        let arrayData = [<?= average(1, null); ?>,
            <?= average(2, null); ?>,
            <?= average(3, null); ?>,
            <?= average(4, null); ?>,
            <?= average(5, null); ?>,
            <?= average(6, null); ?>,
            <?= average(7, null); ?>,
            <?= average(8, null); ?>,
            <?= average(9, null); ?>,
            <?= average(10, null); ?>,
            <?= average(11, null); ?>,
            <?= average(12, null); ?>,
        ];
    <?php endif; ?>

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"],
            datasets: [{
                label: 'Rata-rata Penjualan',
                data: arrayData,
                backgroundColor: [
                    'rgba(25, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(2,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>