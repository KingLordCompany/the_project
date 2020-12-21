<style>
    /* Style the header with a grey background and some padding */
    .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 20px 10px;
    }

    /* Style the header links */
    .header div {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
    }

    /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
    .header div.logo {
        font-size: 25px;
        font-weight: bold;
    }

    /* Change the background color on mouse-over */
    .header div:hover {
        background-color: #ddd;
        color: black;
    }

    /* Style the active/current link*/
    .header div.active {
        background-color: dodgerblue;
        color: white;
    }

    /* Float the link section to the right */
    .header-right {
        float: right;
    }

    /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
    @media screen and (max-width: 500px) {
        .header a {
            float: none;
            display: block;
            text-align: left;
        }

        .header-right {
            float: none;
        }
    }

    .title {
        background-color: rgb(24, 24, 24);
        color: white;
        font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
        text-align: center;
        font-size: xx-large;
    }

    .header {
        margin: 1%;
    }

    .content {
        padding: 1%;
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4caf50;
        color: white;
    }

    .total {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4caf50;
        color: white;
    }

    .data {
        display: inline-block;
    }
</style>
<!-- </head> -->

<body>
    <div class="header">
        <div class="logo">DeeSqi Cathering</div>
    </div>
    <div class="header">
        <pre class="data">
        Nota Pemesanan   : <?= $transaksi['nota_pemesanan'] ?> <br>
        Tanggal Pesan    : <?= $transaksi['tgl_order'] ?> <br>
        Tipe Bayar       : <?= $transaksi['tipe_bayar'] ?> <br>
        Nomor Pelanggan  : <?= $pelanggan['nm_pelanggan'] ?> <br>
        Tanggal Antar    : <?= $transaksi['tgl_antar'] ?><br>
        Status Bayar     : <?= $transaksi['status_bayar'] ?>
        </pre>
    </div>
    <div class="content">
        <table id="customers">
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
                $detail_transaksi = $this->Katering_Model->detail_where($transaksi['nota_pemesanan']);
                $no = 1;
                $total = 0;
                foreach ($detail_transaksi as $det_trans) {
                    $total += $det_trans['total_harga'];
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $det_trans['nama_produk'] ?></td>
                        <td><?= $det_trans['catatan'] ?></td>
                        <td><?= $det_trans['jumlah_pesan'] ?></td>
                        <td>Rp. <?= number_format($det_trans['harga']) ?></td>
                        <td>Rp. <?= number_format($det_trans['total_harga']) ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="bg-info text-white">Total</td>
                    <td colspan="1">Rp. <?= number_format($total) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>