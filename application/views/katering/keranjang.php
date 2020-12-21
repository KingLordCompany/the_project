<div class="container mt-3">
    <h1 class="display-4">Daftar Pesanan</h1>
    <hr class="my-4">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="bg-primary text-white">
            <tr>
                <th class="th-sm">Tanggal Pesan</th>
                <th class="th-sm">Bank</th>
                <th class="th-sm">Status Bayar</th>
                <th class="th-sm">Status Antar</th>
                <th class="th-sm">Struk</th>
                <th class="th-sm">Detail</th>
                <th class="th-sm">Validasi Pembayaran</th>
                <th class="th-sm">Cetak Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($keranjang as $keranjang) {
                $bank = $this->db->where('tipe_bayar', $keranjang['tipe_bayar'])->get('tb_bayar')->row_array();
                $tanggal = date_create($keranjang['tgl_order']);
                $date = date_format($tanggal, 'd-m-Y');
            ?>
                <tr>
                    <td><?= $date ?></td>
                    <td><?= $bank['tipe_bayar'] . ' ( ' . $bank['no_rekening'] . ' ) ' . ' A/N ' . $bank['nama_rekening']  ?></td>
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
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Detail Pemesanan
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- DETAIL -->
                                        <table class="table">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Produk</th>
                                                    <th scope="col">Catatan</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Harga Satuan</th>
                                                    <th scope="col">Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $detail_transaksi = $this->Katering_Model->detail_where($keranjang['nota_pemesanan']);
                                                $no = 1;
                                                foreach ($detail_transaksi as $det_trans) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $det_trans['nama_produk'] ?></td>
                                                        <td><?= $det_trans['catatan'] ?></td>
                                                        <td><?= $det_trans['jumlah_pesan'] ?></td>
                                                        <td>Rp. <?= number_format($det_trans['harga']) ?></td>
                                                        <td>Rp. <?= number_format($det_trans['total_harga']) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <!-- END DETAIL -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if ($keranjang['status_bayar'] == 'belum') { ?>

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
                        <?php } else {
                            echo ' Selesai';
                        } ?>
                    </td>
                    <td>
                        <a href="<?= base_url("katering/tampil/" . $keranjang['nota_pemesanan']) ?>" class="btn btn-danger" data-dismiss="modal">Cetak Struk</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot class="bg-primary text-white">
            <tr>
                <th class="th-sm">Tanggal Pesan</th>
                <th class="th-sm">Bank</th>
                <th class="th-sm">Status Bayar</th>
                <th class="th-sm">Status Antar</th>
                <th class="th-sm">Struk</th>
                <th class="th-sm">Detail</th>
                <th class="th-sm">Validasi Pembayaran</th>
                <th class="th-sm">Cetak Pesanan</th>
            </tr>
        </tfoot>
    </table>
</div>