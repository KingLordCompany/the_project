<div class="mx-5 mt-3 animated fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Halaman <?= $judul ?></h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah User
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
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telpon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($admin as $adm) { ?>
                            <tr>

                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $adm['username'] ?></td>
                                <td><?= $adm['email'] ?></td>
                                <td><?= $adm['no_hp'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal<?= $adm['id_admin'] ?>">
                                        Delete
                                    </button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deletemodal<?= $adm['id_admin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete <?= $judul ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('admin/delete_admin') ?>
                                                    <input type="hidden" class="form-control" id="namauser" name="admin" value="<?= $adm['id_admin'] ?>">
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
                <?= form_open('admin/insert_user') ?>
                <div class="form-group">
                    <label for="namauser">Username</label>
                    <input type="text" class="form-control" id="namauser" name="nama" aria-describedby="emailHelp" placeholder="Masukan Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="emailuser">Email</label>
                    <input type="email" class="form-control" id="emailuser" name="email" aria-describedby="emailHelp" placeholder="Masukan Email">
                </div>
                <div class="form-group">
                    <label for="telpon">Telpon</label>
                    <input type="tel" class="form-control" id="telpon" name="telpon" aria-describedby="emailHelp" placeholder="Masukan Telpon">
                </div>
                <div class="form-group">
                    <label for="passworduser">Password</label>
                    <input type="password" class="form-control" id="passworduser" name="password" aria-describedby="emailHelp">
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