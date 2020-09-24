<div class="container mx-auto mt-3 animauted fadeIn delay-1s">
    <div class="jumbotron">
        <h1>Hai, <?= $judul ?></h1>
        <div class="card mt-3">
            <ul class="list-group">
                <li class="list-group-item active">Identitas Pengguna</li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="namauser">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namauser" name="nama" aria-describedby="emailHelp" value="King Lord" placeholder="Masukan Nama Lengkap">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="emailuser">Email</label>
                        <input type="email" class="form-control" id="emailuser" name="user" aria-describedby="emailHelp" value="KingLord@Strong.com" placeholder="Masukan Email">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="telpon">Telpon</label>
                        <input type="tel" class="form-control" id="telpon" name="telpon" aria-describedby="emailHelp" value="085452572656" placeholder="Masukan Telpon">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="alamatuser">Alamat</label>
                        <textarea class="form-control" id="alamatuser" name="alamat" rows="3" placeholder="Masukan Alamat">Istana Megah</textarea>
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
                    <?= form_open_multipart('admin#') ?>
                    <div class="form-group">
                        <label for="passworduser">Password Baru</label>
                        <input type="password" class="form-control" id="passworduser" name="password" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="passworduser">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="passworduser" name="password2" aria-describedby="emailHelp">
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>