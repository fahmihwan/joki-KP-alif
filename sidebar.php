<div class="nav">
    <div class="sb-sidenav-menu-heading">Pertashop Jambi</div>
    <a class="nav-link" href="index.php?menu=dashboard">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>
    <!-- <div class="sb-sidenav-menu-heading">Tambah Stok</div> -->
    <div class="sb-sidenav-menu-heading">Catat</div>
    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
        <!-- <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div> -->
        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
        Tambah Stok
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="index.php?menu=supplier">Supplier</a>
            <a class="nav-link" href="index.php?menu=update_stok">Beli Stok</a>
        </nav>
    </div>
    <a class="nav-link" href="index.php?menu=penjualan">
        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
        Catat Penjualan
    </a>
    <div class="sb-sidenav-menu-heading">Laporan</div>
    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pembelian" aria-expanded="false" aria-controls="pembelian">
        <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
        Laporan
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="pembelian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="index.php?laporan=pembelian">Laporan Pembelian</a>
            <a class="nav-link" href="index.php?laporan=penjualan">Laporan Penjualan</a>
        </nav>
    </div>

</div>