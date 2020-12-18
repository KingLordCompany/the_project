<div class="mx-5 mt-3 animated fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Halaman <?= $judul ?></h1>
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
                                <td><?= $trans['status_bayar'] ?></td>
                                <td>Rp. <?= number_format($total['total']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal<?= $trans['nota_pemesanan'] ?>">
                                        <i class="fa-fw fas fa-list"></i>
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal<?= $trans['nota_pemesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail <?= $judul ?></h5>
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
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>