<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <i class="fas fa-home"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Katering Ku</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Dashboard
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>


        <!-- Heading -->
        <div class="sidebar-heading">
            Data Master
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link " href="<?= base_url('admin/user') ?>"> <i class="fas fa-fw fa-user"></i>
                <span>Admin</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link " href="<?= base_url('admin/pelanggan') ?>"> <i class="fas fa-fw fa-users"></i>
                <span>Pelanggan</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin/produk') ?>"><i class="fas fa-fw fa-list"></i>
                <span>Poduk</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin/bayar') ?>"><i class="fas fa-fw fa-wallet"></i>
                <span>Bayar</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Transaksi
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item active">
            <a class="nav-link v" href="<?= base_url('admin/transaksi') ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link v" href="<?= base_url('admin/status_bayar') ?>">
                <i class="fas fa-fw fa-money-bill-wave"></i>
                <span>Status Bayar</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link v" href="<?= base_url('admin/status_antar') ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Status Antar</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <?php $admin = $this->db->where('id_admin', $this->session->userdata('id_admin'))->get('tb_admin')->row_array() ?>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $admin['username'] ?></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('katering/logout') ?>"" data-toggle=" modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">