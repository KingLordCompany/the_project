<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Pesan sekarang di, DeeSqi Cathering</h1>
        <marquee class="lead">Melayani pemesanan ketering dengan praktis dan mudah</marquee>
        <?= $this->session->flashdata('alert'); ?>
    </div>
    <div class="alert alert-info" role="alert">
        Pilihan Produk
        <a href="<?= base_url('katering'); ?>" class="pakets semua-status"> Semua</a> |
        <a href="<?= base_url('katering/index/prasmanan'); ?>" class="pakets prasmanan-status"> Prasmanan</a> |
        <a href="<?= base_url('katering/index/paket'); ?>" class="pakets paket-status"> Paket</a>
    </div>
</div>
<?= $this->session->userdata('id_pelanggan'); ?>
<div class="prasmanan">
    <div class="container alert alert-primary" role="alert">
        <h3><?= $title; ?></h3>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <?php foreach ($produk as $data) { ?>
                <div class="col mt-3">
                    <div class="card" style="width: 15rem;">
                        <img class="card-img-top" src="<?= base_url('assets/img/' . $data['foto']) ?>" height="300" width="100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['nama_produk'] ?></h5>
                            <p class="card-text"><?= $data['deskripsi'] ?></p>
                            <a href="<?= base_url('katering/pesan/' . $data['id_produk']) ?>" class="btn btn-success"> <i class="fas fa-cart-plus"></i> Pesan</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>