<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            Edit Supplier
            <a class="btn btn-outline-primary btn-md float-end" href="index.php?menu=supplier" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="id" class="form-label"> <b>ID</b></label>
                    <input type="text" class="form-control" id="id" readonly value="SUP001">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label"> <b>Nama Pengemudi</b> </label>
                    <input type="text" class="form-control" id="nama" required>
                </div>
                <div class="mb-3">
                    <label for="nopol" class="form-label"><b>Nomor Polisi</b></label>
                    <input type="text" class="form-control" id="nopol" required>
                </div>
                <button type="button" class="btn btn-primary mt-4">Simpan</button>
                <button type="reset" class="btn btn-warning mt-4">reset</button>
            </form>
        </div>
    </div>
</div>