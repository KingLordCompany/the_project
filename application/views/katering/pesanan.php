<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Daftar Pesanan</h1>
        <?= $this->session->flashdata('alert'); ?>
        <hr class="my-4">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Total</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $now = date('Y-m-d');
                $now = strtotime($now);
                $now = strtotime('+1 day', $now);
                $tanggal = date('Y-m-d', $now);
                $no = 1;
                $total = 0;
                foreach ($detail as $detail) {
                    $produk =  $this->Katering_Model->produk_where($detail['id_produk']);
                    $qty = $detail['jumlah_pesan'];
                    $satuan = $produk['harga'];
                    $total += $qty * $satuan;
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $produk['nama_produk'] ?></td>
                        <td><?= $detail['catatan'] ?></td>
                        <td><?= $qty ?></td>
                        <td>Rp. <?= number_format($satuan) ?></td>
                        <td>Rp. <?= number_format($satuan * $qty) ?></td>
                        <td>
                            <!-- Hapus -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $detail['id_keranjang'] ?>">
                                Hapus
                            </button>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="hapus<?= $detail['id_keranjang'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('katering/hapus_pesanan') ?>
                                        <input type="hidden" name="pesan" value="<?= $detail['id_keranjang'] ?>">
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus menu <?= $produk['nama_produk'] ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>

                            <!-- end modal hapus -->

                            <!-- Edit -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Edit<?= $detail['id_keranjang'] ?>">
                                Edit
                            </button>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="Edit<?= $detail['id_keranjang'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('katering/edit_pesanan') ?>
                                        <input type="hidden" name="pesan" value="<?= $detail['id_keranjang'] ?>">
                                        <div class="modal-body">
                                            <label for="exampleInputEmail1">Menu <h5><?= $produk['nama_produk'] ?></h5></label>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jumlah Pesanan</label>
                                                <input type="number" class="form-control" name="jumlah" min="<?= $produk['minimal_pesan'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail['jumlah_pesan'] ?>" placeholder="Masukan Jumlah Pesanan">
                                                <small id="emailHelp" class="form-text text-danger">Minimal pemesanan <?= $produk['minimal_pesan'] ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Catatan</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan" rows="3"><?= $detail['catatan'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                        <?= form_close() ?>
                                    </div>+
                                </div>
                            </div>

                            <!-- end modal Edit -->
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="bg-info text-white">Total</td>
                    <td colspan="1">Rp. <?= number_format($total) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <a href="<?= base_url('katering') ?>" class="btn btn-primary">Pemesanan</a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Bayar Pesanan <i class="fas fa-money-bill-wave"></i>
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('katering/transaksi') ?>
            <div class="modal-body">
                <h5>Lakukan pembayaran via bank terdekat</h5>
                Pelanggan : <br>
                <h6><?= $user['nm_pelanggan'] ?></h6>
                Total : <h4>Rp. <?= number_format($total) ?></h4>
                <hr>
                <label for="exampleFormControlInput1">Tanggal dan Waktu pengiriman</label>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pembayaran</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <?php foreach ($bayar as $bayar) { ?>
                            <option value="<?= $bayar['tipe_bayar'] ?>"><?= $bayar['tipe_bayar'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="date" name="tanggal" class="form-control" min="<?= $tanggal ?>">
                    </div>

                    <div class="col">
                        <input type="time" name="waktu" class="form-control">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Bayar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>