<div class="container mt-4">
    <div class="jumbotron">
        <h1 class="display-4"><?= $pesan['nama_produk'] ?></h1>
        <img src="<?= base_url('assets/img/' . $pesan['foto']) ?>" class="img-fluid" alt="Responsive image">
        <hr class="my-4">
        <?= form_open('katering/add_pesan') ?>
        <input type="hidden" name="pesan" value="<?= $pesan['id_produk'] ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Pemesanan</label>
            <input type="number" class="form-control" name="jumlah" min="<?= $pesan['minimal_pesan'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Jumlah Pesanan">
            <small id="emailHelp" class="form-text text-danger">Minimum Pemesanan <?= $pesan['minimal_pesan'] ?></small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Catatan</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan" rows="3" placeholder="Catatan Pesanan"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Pesan</button>
        <?= form_close() ?>
    </div>
</div>