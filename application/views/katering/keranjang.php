<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Daftar Checkout</h1>
        <hr class="my-4">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="bg-primary text-white">
                <tr rowspa>
                    <th class="th-sm">Tanggal Pesan</th>
                    <th class="th-sm">Bank</th>
                    <th class="th-sm">Status Bayar</th>
                    <th class="th-sm">Status Antar</th>
                    <th class="th-sm">Struk</th>
                    <th class="th-sm">Validasi Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($keranjang as $keranjang) { ?>
                    <tr>
                        <td><?= $keranjang['tgl_order'] ?></td>
                        <td><?= $keranjang['tipe_bayar'] ?></td>
                        <td><?= $keranjang['status_bayar'] ?></td>
                        <td><?= $keranjang['status_antar'] ?></td>
                        <td>
                            <?php if ($keranjang['gambar'] == 'belum') { ?>
                                <p>belum</p>
                            <?php } else { ?>
                                <img src="<?= base_url('assets/img/validation_img/' . $keranjang['gambar']) ?>" alt="<?= $keranjang['gambar'] ?>" width="50" height="50" data-toggle="modal" data-target="#struk<?= $keranjang['nota_pemesanan'] ?>">
                                <div class="modal fade" id="struk<?= $keranjang['nota_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Struk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="mx-auto w-100" src="<?= base_url('assets/img/validation_img/' . $keranjang['gambar']) ?>" alt="<?= $keranjang['gambar'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#keranjang<?= $keranjang['nota_pemesanan'] ?>">Validasi Pembayaran</button>
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
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>Tanggal Pesan</td>
                    <td>Status Bayar</td>
                    <td>Status Antar</td>
                    <td>Aksi</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>