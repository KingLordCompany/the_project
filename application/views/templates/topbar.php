<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">DeeSqi Cathering <span><i class="fas fa-fw fa-house-user"></i></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Data Master
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/user') ?>">User</a>
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item" href="<?= base_url('admin/kategori') ?>">Kategori</a> -->
                        <a class="dropdown-item" href="<?= base_url('admin/produk') ?>">Produk</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Transaksi</a>
                </li>
            </ul>

            <div>
                <a href="<?= base_url('admin/profile') ?>" class="d-flex d-justify-inline">
                    <h5 class="mx-3">Profile</h5>
                    <img src="<?= base_url('assets/img/default.png') ?>" alt="..." height="30" class="rounded-circle">
                </a>
            </div>
        </div>
    </nav>