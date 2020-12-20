<div class="mx-5 mt-3 animated fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Halaman <?= $judul ?></h1>
        <div class="alert">
            <?= $this->session->flashdata('alert'); ?>
        </div>
        <div class="card mt-3">
            <div class="card-header">
            <?= form_open('admin/rekap') ?>
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Tanggal Awal</div>
                                </div>
                                <input type="date" class="form-control" id="date_awal" name="date_awal" value="<?= $tgl_awal; ?>" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Tanggal Akhir</div>
                                </div>
                                <input type="date" class="form-control" id="date_akhir" name="date_akhir" value="<?= $tgl_akhir; ?>" required>
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                        </div>
                    </div>
                <?php form_close(); ?>
            </div>
                <div class="card-body">
                <table class="table" id="tabel_rekap" style="width: 100%;">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Nota Pesanan</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah Pesan</th>
                            <th scope="col">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no_t = 1; $total_masuk = 0;
                        foreach ($transaksi as $trans) {
                            $total = $this->Admin_Model->total_harga($trans['nota_pemesanan']);
                        ?>
                            <tr>

                                <td scope="row"><?= $no_t++; ?></td>
                                <td><?= $trans['tgl_order'] ?></td>
                                <td><?= $trans['nota_pemesanan'] ?></td>
                                <td><?= $trans['nama_produk'] ?></td>
                                <td><?= number_format($trans['total_harga'] / $trans['jumlah_pesan']);  ?></td>
                                <td><?= $trans['jumlah_pesan']  ?></td>
                                <td><?= number_format($trans['total_harga']);  ?></td>
                            </tr>
                        <?php $total_masuk += $trans['total_harga']; } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Total Pemasukan : Rp. <?= number_format($total_masuk); ?>
            </div>
        </div>

    </div>
</div>