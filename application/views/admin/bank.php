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
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Type Bayar</th>
                            <th scope="col">Nama Rekening</th>
                            <th scope="col">No Rekening</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk as $adm) { ?>
                            <tr>

                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $adm['tipe_bayar'] ?></td>
                                <td><?= $adm['nama_rekening'] ?></td>
                                <td><?= $adm['no_rekening'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal<?= $adm['tipe_bayar'] ?>">
                                        Edit
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal<?= $adm['tipe_bayar'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $judul ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('admin/update_bayar') ?>
                                                    <input type="hidden" name="id" value="<?= $adm['tipe_bayar'] ?>">
                                                    <div class="form-group">
                                                        <label for="namauser">Type Bayar</label>
                                                        <input type="text" class="form-control" id="namauser" name="bayar" aria-describedby="emailHelp" value="<?= $adm['tipe_bayar'] ?>" placeholder="Masukan Produk">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emailuser">Nama Bayar</label>
                                                        <input type="text" class="form-control" id="emailuser" name="nama" aria-describedby="emailHelp" value="<?= $adm['nama_rekening'] ?>" placeholder="Masukan Harga">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telpon">No Bayar</label>
                                                        <input type="number" class="form-control" id="telpon" name="no" aria-describedby="emailHelp" value="<?= $adm['no_rekening'] ?>" placeholder="Masukan Minimal Pesan">
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

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal<?= $adm['tipe_bayar'] ?>">
                                        Delete
                                    </button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deletemodal<?= $adm['tipe_bayar'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete <?= $judul ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('admin/delete_bayar') ?>
                                                    <input type="hidden" class="form-control" id="namauser" name="id" value="<?= $adm['tipe_bayar'] ?>">
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
                <?= form_open_multipart('admin/insert_bayar') ?>
                <div class="form-group">
                    <label for="namauser">Type Bayar</label>
                    <input type="text" class="form-control" id="namauser" name="bayar" aria-describedby="emailHelp" placeholder="Masukan Produk">
                </div>
                <div class="form-group">
                    <label for="emailuser">Nama Bayar</label>
                    <input type="text" class="form-control" id="emailuser" name="nama" aria-describedby="emailHelp" placeholder="Masukan Harga">
                </div>
                <div class="form-group">
                    <label for="telpon">No Bayar</label>
                    <input type="number" class="form-control" id="telpon" name="no" aria-describedby="emailHelp" placeholder="Masukan Minimal Pesan">
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