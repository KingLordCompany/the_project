<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Keranjang</h1>
        <hr class="my-4">
        <ul class="list-group">
            <li class="list-group-item active">
                <div class="d-flex justify-content-between">
                    <div class="daftar">Daftar Keranjang</div>
                    <div class="content">
                        <div class="btn btn-info">Status :</div>
                        <div class="btn btn-info">Bayar</div>
                        <div class="btn btn-info">Antar</div>
                    </div>
                </div>
            </li>
            <?php foreach ($keranjang as $keranjang) { ?>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary"><?= $keranjang['tgl_antar'] ?></button>
                        <div class="content">
                            <button class="btn btn-success" data-toggle="modal" data-target="#keranjang<?= $keranjang['nota_pemesanan'] ?>">Validasi Pembayaran</button>
                            <div class="btn btn-danger"><?= $keranjang['status_bayar'] ?></div>
                            <div class="btn btn-danger"><?= $keranjang['status_antar'] ?></div>
                        </div>
                    </div>
                </li>
                <!-- validation -->
                <div class="modal fade" id="keranjang<?= $keranjang['nota_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Validasi Transaksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open_multipart('katering/upload_validation') ?>
                            <input type="hidden" name="transaksi" value="<?= $keranjang['nota_pemesanan'] ?>">
                            <div class="modal-body  img-validation">
                                <label for="exampleInputEmail1">Upload Bukti Transfer</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="file" require accept="image/gif,image/jpg,image/png,image/jpeg" class="custom-file-input file-upload" id="inputGroupFile01 file-upload">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-upload">Upload</button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </ul>
    </div>
</div>