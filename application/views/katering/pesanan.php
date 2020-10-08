<div class="container mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Daftar Pesanan</h1>
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
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                foreach ($detail as $detail) {
                    $produk =  $this->Katering_Model->produk_where($detail['pesan']);
                    $qty = $detail['jumlah'];
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
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="bg-info text-white">Total</td>
                    <td colspan="1">Rp. <?= number_format($total) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <a href="" class="btn btn-primary">Pemesanan</a>
            <a href="" class="btn btn-success">Bayar Pesanan <i class="fas fa-money-bill-wave"></i></a>
        </div>
    </div>
</div>