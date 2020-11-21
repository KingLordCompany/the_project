<div class="mx-5 mt-3 animated fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Halaman <?= $judul ?></h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Cetak Laporan
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('admin/laporan') ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dari</label>
                            <input type="date" name="dari" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sampai</label>
                            <input type="date" name="sampai" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <div class="alert">
            <?= $this->session->flashdata('alert'); ?>
        </div>
        <div class="card mt-3">
            <div class="card-header h5">
                Tabel <?= $judul ?>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" aria-describedby="emailHelp" placeholder="silahkan ketik">
                </div>
                <table class="table" id="the_table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Tanggal Kirim</th>
                            <th scope="col">Status Bayar</th>
                            <th scope="col">Status Antar</th>
                            <th scope="col">Nota</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no_t = 1;
                        foreach ($transaksi as $trans) {
                            $total = $this->Admin_Model->total_harga($trans['nota_pemesanan']);
                        ?>
                            <tr>

                                <th scope="row"><?= $no_t++; ?></th>
                                <td><?= $trans['nm_pelanggan'] ?></td>
                                <td><?= $trans['tgl_order'] ?></td>
                                <td><?= $trans['tgl_antar'] ?></td>
                                <td><?= $trans['status_antar'] ?></td>
                                <td><?= $trans['status_bayar'] ?></td>
                                <td>
                                    <?php if ($trans['gambar'] == 'belum') { ?>
                                        <p>belum</p>
                                    <?php } else { ?>
                                        <img src="<?= base_url('assets/img/validation_img/' . $trans['gambar']) ?>" alt="<?= $trans['gambar'] ?>" width="50" height="50" data-toggle="modal" data-target="#struk<?= $trans['nota_pemesanan'] ?>">
                                        <div class="modal fade" id="struk<?= $trans['nota_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Struk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="mx-auto w-100" src="<?= base_url('assets/img/validation_img/' . $trans['gambar']) ?>" alt="<?= $trans['gambar'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>Rp. <?= number_format($total['total']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editmodal<?= $trans['nota_pemesanan'] ?>">
                                        <i class="fa-fw fas fa-list"></i>
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal<?= $trans['nota_pemesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $judul ?></h5>
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
                                                            $detail_transaksi = $this->Admin_Model->detail_where($trans['nota_pemesanan']);
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
                                                    <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletemodal<?= $trans['nota_pemesanan'] ?>">
                                        <i class="fa-fw fas fa-edit"></i>
                                    </button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deletemodal<?= $trans['nota_pemesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Status <?= $judul ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('admin/edit_status_transaksi') ?>
                                                    <input type="hidden" name="transaksi" value="<?= $trans['nota_pemesanan'] ?>">
                                                    <input type="hidden" class="form-control" id="namauser" name="produk" value="<?= $trans['nota_pemesanan'] ?>">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Status Bayar</label>
                                                            <select class="form-control" name="bayar" id="exampleFormControlSelect1">
                                                                <?php foreach ($bayar as $key => $value) { ?>
                                                                    <option value="<?= $value ?>" <?php if ($value == $trans['status_bayar']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $key ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <label for="exampleFormControlSelect1">Status Antar</label>
                                                        <select class="form-control" name="antar" id="exampleFormControlSelect1">
                                                            <?php foreach ($antar as $key => $value) { ?>
                                                                <option value="<?= $value ?>" <?php if ($value == $trans['status_antar']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $key ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Ubah</button>
                                                </div>
                                                <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Delete -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>