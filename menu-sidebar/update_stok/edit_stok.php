<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            Edit Stok BBM
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?menu=update_stok" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="nama" class="form-label"> <b>ID</b> </label>
                    <input type="text" class="form-control" id="nama" value="BL001" readonly>
                </div>
                <div class="mb-3">
                    <label for="nopol" class="form-label"><b>Jenis BBM</b></label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>-- Pilih --</option>
                        <option value="1">Pertalite</option>
                        <option value="2">Pertamax</option>
                        <option value="3">Premium</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nopol" class="form-label"><b>Jumlah Pemesanan</b></label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>-- Pilih --</option>
                        <option value="1">1 kl</option>
                        <option value="2">2 kl</option>
                        <option value="3">3 kl</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label"> <b>Tanggal</b> </label>
                    <input type="date" class="form-control" id="nama">
                </div>
                <div class="mb-3">
                    <label for="nopol" class="form-label"><b>Harga</b></label>
                    <input type="number" class="form-control" id="nopol">
                </div>

                <button type="button" class="btn btn-primary mt-4">Simpan</button>
                <button type="reset" class="btn btn-warning mt-4">reset</button>
            </form>
        </div>
    </div>
</div>