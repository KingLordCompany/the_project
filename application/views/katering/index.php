<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Pesan sekarang di, Kateringku</h1>
        <p class="lead">Melayani pemesanan ketering dengan praktis dan mudah</p>
        <hr class="my-4">

        <?= $this->session->flashdata('alert'); ?>
    </div>
    <div class="alert alert-primary" role="alert">
        <a href="#" class="pakets semua-status">Semua</a>/
        <a href="#" class="pakets prasmanan-status">Prasmanan</a>/
        <a href="#" class="pakets paket-status">Paket</a>
    </div>
</div>
<?= $this->session->userdata('id_pelanggan'); ?>
<div class="prasmanan">

    <div class="container alert alert-primary" role="alert">
        <h3>Pramanan</h3>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <?php foreach ($produk as $prasmanan) {
                if ($prasmanan['kategori'] == "prasmanan") { ?>
                    <div class="col mt-3">
                        <div class="card" style="width: 15rem;">
                            <img class="card-img-top" src="<?= base_url('assets/img/' . $prasmanan['foto']) ?>" height="300" width="100" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $prasmanan['nama_produk'] ?></h5>
                                <p class="card-text"><?= $prasmanan['deskripsi'] ?></p>
                                <a href="<?= base_url('katering/pesan/' . $prasmanan['id_produk']) ?>" class="btn btn-success"> <i class="fas fa-cart-plus"></i> Pesan</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

</div>
<div class="paket">

    <div class="container alert alert-primary mt-3" role="alert">
        <h3>Paket</h3>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <?php foreach ($produk as $paket) {
                if ($paket['kategori'] != "prasmanan") { ?>
                    <div class="col mt-3">
                        <div class="card" style="width: 15rem;">
                            <img class="card-img-top" src="<?= base_url('assets/img/' . $paket['foto']) ?>" height="300" width="100" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $paket['nama_produk'] ?></h5>
                                <p class="card-text"><?= $paket['deskripsi'] ?></p>
                                <a href="<?= base_url('katering/pesan/' . $paket['id_produk']) ?>" class="btn btn-success"> <i class="fas fa-cart-plus"></i> Pesan</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

</div>