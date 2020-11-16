<div class="container mx-auto mt-3 animauted fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Hai, <?= $judul ?></h1>
        <div class="alert">
            <?= $this->session->flashdata('alert'); ?>
        </div>
        <div class="card mt-3">
            <ul class="list-group">
                <li class="list-group-item active">Identitas Pengguna</li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="namauser">Username</label>
                        <input type="text" class="form-control" readonly disabled id="namauser" name="nama" aria-describedby="emailHelp" value="<?= $admin['username'] ?>" placeholder="Masukan Nama Lengkap">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="emailuser">Email</label>
                        <input type="email" class="form-control" readonly disabled id="emailuser" name="user" aria-describedby="emailHelp" value="<?= $admin['email'] ?>" placeholder="Masukan Email">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="telpon">Telpon</label>
                        <input type="tel" class="form-control" id="telpon" readonly disabled name="telpon" aria-describedby="emailHelp" value="<?= $admin['no_hp'] ?>" placeholder="Masukan Telpon">
                    </div>
                </li>
                <li class="list-group-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Ubah Password
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal User -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password <?= $judul ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('admin/change_pass') ?>
                    <input type="hidden" name="id" value="<?= $admin['id_admin'] ?>">
                    <div class="form-group">
                        <label for="passworduser">Password Baru</label>
                        <input type="password" class="form-control" id="passworduser" name="pass1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="passworduser">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="passworduser" name="pass2" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>