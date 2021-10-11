<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pertashop</title>
    <script src="js/chart.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <!-- top bar -->
        <?php include 'topbar.php'; ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <!-- side bar -->
                    <?php include 'sidebar.php'; ?>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <!-- content -->
                <?php
                if (isset($_GET['menu'])) {
                    $sidebar = $_GET['menu'];           //menu
                    switch ($sidebar) {
                        case 'dashboard':
                            include "menu-sidebar/dashboard.php";
                            break;
                        case 'supplier':
                            include "menu-sidebar/supplier/index.php";
                            break;
                        case 'update_stok':
                            include "menu-sidebar/update_stok/index.php";
                            break;
                        case 'penjualan':
                            include "menu-sidebar/penjualan/index.php";
                            break;
                        case 'tes':
                            include "menu-sidebar/dashboard_ajax.php";
                        default:
                            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                            break;
                    }
                } elseif (isset($_GET['supplier'])) {
                    $supplier = $_GET['supplier'];     //supplier
                    switch ($supplier) {
                        case 'add':
                            include "menu-sidebar/supplier/add_supplier.php";
                            break;
                        case 'edit':
                            include "menu-sidebar/supplier/edit_supplier.php";
                            break;
                        case 'delete':
                            include "menu-sidebar/supplier/delete.php";
                            break;
                    }
                } elseif (isset($_GET['update_stok'])) {
                    $beli_stok = $_GET['update_stok'];  //Beli Stok
                    switch ($beli_stok) {
                        case 'add':
                            // include "menu-sidebar/update_stok/index.php";
                            include "menu-sidebar/update_stok/add_stok.php";
                            break;
                        case 'delete':
                            include "menu-sidebar/update_stok/delete.php";
                            break;
                    }
                } elseif (isset($_GET['penjualan'])) {
                    $penjualan = $_GET['penjualan'];    //penjualan
                    switch ($penjualan) {
                        case 'add':
                            include "menu-sidebar/penjualan/add_penjualan.php";
                            break;
                        case 'ajax':
                            include "menu-sidebar/penjualan/ajax_subsidi.php";
                            break;
                        case 'delete':
                            include "menu-sidebar/penjualan/delete.php";
                            break;
                        case 'print_penjualan':
                            include "menu-sidebar/penjualan/print_penjualan.php";
                            break;
                    }
                } elseif (isset($_GET['laporan'])) {
                    $laporan = $_GET['laporan'];    //penjualan
                    switch ($laporan) {
                        case 'pembelian':
                            include "menu-sidebar/laporan/laporan_pembelian.php";
                            break;
                        case 'penjualan':
                            include "menu-sidebar/laporan/laporan_penjualan.php";
                            break;
                        case 'print_penjualan':
                            include "menu-sidebar/laporan/print_penjualan.php";
                            break;
                        case 'print_pembelian':
                            include "menu-sidebar/laporan/print_pembelian.php";
                            break;
                        case 'print_penjualan_periode':
                            include "menu-sidebar/laporan/print_penjualan_periode.php";
                            break;
                        case 'print_pembelian_periode':
                            include "menu-sidebar/laporan/print_pembelian_periode.php";
                            break;
                    }
                } elseif (isset($_GET['setting'])) {       //pengaturan
                    $pengaturan = $_GET['setting'];
                    switch ($pengaturan) {
                        case 'pengaturan_bbm':
                            include "menu-setting/pengaturan_bbm.php";
                            break;
                        case 'delete':
                            include "menu-setting/delete_bbm.php";
                            break;
                        case 'delete_supir':
                            include "menu-setting/delete_supir.php";
                            break;
                        case 'delete_kendaraan':
                            include "menu-setting/delete_nopol.php";
                            break;
                    }
                }
                ?>
            </main>
        </div>

    </div>

    <script src="assets/all.min.js" crossorigin="anonymous"></script>
    <script src="assets/bootsrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="assets/simple-datatables@latest.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="assets/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reset_speed').click(function(e) {
                Swal.fire({
                    title: "yakin ingin reset speed awal?",
                    icon: 'warning',
                    input: 'text',
                    inputLabel: 'pastikan jenis subsidi anda benar & ketik: "RESETSPEEDAWAL"',
                    inputAttributes: {
                        min: 8,
                        max: 100,
                        step: 1
                    },
                    inputValue: ""
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value == "RESETSPEEDAWAL") {
                            $('#speed_awal').val(0);
                        }
                    }
                })
            });


            $('.btn-del-bbm').click(function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus?',
                    icon: 'warning',
                    input: 'text',
                    inputLabel: 'ketik: "PERTASHOPJAMBI"',
                    inputAttributes: {
                        min: 8,
                        max: 100,
                        step: 1
                    },
                    inputValue: ""
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value == "PERTASHOPJAMBI") {
                            window.location.href = href;
                        }
                    }
                })
            })

            $('.btn-del').click(function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                let alert = $(this).attr('alert');

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "data " + alert + " akan di hapus",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus sekarang!',
                    cancelButtonText: 'tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = href;
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    }
                })

            })


            $('#supir').keyup(function() {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    $('#telp').val(this.responseText)
                }
                xhttp.open("GET", "menu-sidebar/supplier/ajax_supir.php?term=" + $('#supir').val());
                xhttp.send();
            });

            $('#speed_akhir').keyup(function() {
                const penjualan = $(this).val() - $('#speed_awal').val();
                if ($('#speed_akhir').val() === "") {
                    $('#penjualan').val('0');
                } else {
                    $('#penjualan').val(penjualan);
                }
            });

            $('#jenis_bbm_ajax').change(function() {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    $('#speed_awal').val(this.responseText);
                }
                xhttp.open('GET', 'menu-sidebar/penjualan/ajax_subsidi.php?id=' + $('#jenis_bbm_ajax').val());
                xhttp.send();
            });

            $('#ddYear').change(function() {
                $.ajax({
                    type: 'POST',
                    url: "./menu-sidebar/dashboard_ajax.php",
                    date: $('#ddYear').val(),
                    success: function() {

                    }
                })
            })
        });

        $('#refresh').click(function() {
            window.location.href = "index.php?laporan=penjualan";
        })

        $('#refreshPembelian').click(function() {
            window.location.href = "index.php?laporan=pembelian";
        })
    </script>
</body>

</html>