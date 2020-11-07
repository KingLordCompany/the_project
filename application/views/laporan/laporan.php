<style>
	* {
		margin: 0;
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
</style>

<body>
	<div class="title">
		<p>Laporan Transaksi</p>
	</div>
	<div class="header">
		<p>Tanggal Cetak : <?= date('m-d-Y') ?></p>
	</div>
	<div class="content">
		<table id="customers">
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal Pesan</th>
				<th>Total Pemesanan</th>
			</tr>
			<?php
			$no = 1;
			$total_hasil = 0;
			foreach ($laporan as $key) {
				$total = $this->Admin_Model->total_harga($key['nota_pemesanan']);
				$total_hasil += $total['total'];
				$pelanggan = $this->db->where('id_pelanggan', $key['id_pelanggan'])->get('tb_pelanggan')->row_array();
			?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $pelanggan['nm_pelanggan']; ?></td>
					<td><?= $key['tgl_order']; ?></td>
					<td>Rp. <?= number_format($total['total']) ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="3" class="total">Total</td>
				<td>Rp. <?= number_format($total_hasil) ?></td>
			</tr>
		</table>
	</div>
</body>