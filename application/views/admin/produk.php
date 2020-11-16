<div class="mx-5 mt-3 animated fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Halaman <?= $judul ?></h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah <?= $judul ?>
        </button>
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
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Minumal Pesan</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk as $adm) { ?>
                            <tr>

                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $adm['nama_produk'] ?></td>
                                <td>Rp. <?= number_format($adm['harga']) ?></td>
                                <td><?= $adm['minimal_pesan'] ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/' . $adm['foto']) ?>" alt="<?= $adm['foto'] ?>" height="100" width="100">
                                </td>
                                <td><?= $adm['deskripsi'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal<?= $adm['id_produk'] ?>">
                                        Edit
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal<?= $adm['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $judul ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('admin/update_produk') ?>
                                                    <input type="hidden" name="produk" value="<?= $adm['id_produk'] ?>">
                                                    <div class="form-group">
                                                        <label for="namauser">Nama Produk</label>
                                                        <input type="text" class="form-control" id="namauser" name="nama_produk" value="<?= $adm['nama_produk'] ?>" aria-describedby="emailHelp" placeholder="Masukan Produk">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emailuser">Harga</label>
                                                        <input type="number" class="form-control" id="emailuser" name="harga" value="<?= $adm['harga'] ?>" aria-describedby="emailHelp" placeholder="Masukan Harga">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telpon">Minimal Pesan</label>
                                                        <input type="number" class="form-control" id="telpon" name="minimal_pesan" value="<?= $adm['minimal_pesan'] ?>" aria-describedby="emailHelp" placeholder="Masukan Minimal Pesan">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload Gambar</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="file" id="inputGroupFile01" require>
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"><?= $adm['deskripsi'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                                <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal<?= $adm['id_produk'] ?>">
                                        Delete
                                    </button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deletemodal<?= $adm['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete <?= $judul ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('admin/delete_produk') ?>
                                                    <input type="hidden" class="form-control" id="namauser" name="produk" value="<?= $adm['id_produk'] ?>">
                                                    <h6>Apakah anda yakin ingin menghapus data?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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

<!-- Modal User -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('admin/insert_produk') ?>
                <div class="form-group">
                    <label for="namauser">Nama Produk</label>
                    <input type="text" class="form-control" id="namauser" name="nama_produk" aria-describedby="emailHelp" placeholder="Masukan Produk">
                </div>
                <div class="form-group">
                    <label for="emailuser">Harga</label>
                    <input type="number" class="form-control" id="emailuser" name="harga" aria-describedby="emailHelp" placeholder="Masukan Harga">
                </div>
                <div class="form-group">
                    <label for="telpon">Minimal Pesan</label>
                    <input type="number" class="form-control" id="telpon" name="minimal_pesan" aria-describedby="emailHelp" placeholder="Masukan Minimal Pesan">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload Gambar</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="inputGroupFile01" require>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>