<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Pesan sekarang di, Kateringku</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>

        <?= $this->session->flashdata('alert'); ?>
    </div>
</div>

<div class="container d-flex justify-content-center">
    <div class="row">
        <?php foreach ($produk as $produk) { ?>
            <div class="col mt-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= base_url('assets/img/' . $produk['foto']) ?>" height="300" width="100" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produk['nama_produk'] ?></h5>
                        <p class="card-text"><?= $produk['deskripsi'] ?></p>
                        <a href="<?= base_url('katering/pesan/' . $produk['id_produk']) ?>" class="btn btn-success"> <i class="fas fa-cart-plus"></i> Pesan</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>