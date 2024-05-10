<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url() . 'assets/images/favicon.png' ?>" type="image/jpeg">

    <title>PORTAL KLINIK |
        <?= $this->uri->segment(1) ?>
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/fontawesome-free/css/all.min.css' ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/jqvmap/jqvmap.min.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/dist/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/dist/css/custom.css' ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css' ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/daterangepicker/daterangepicker.css' ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/summernote/summernote-bs4.min.css' ?>">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/sweetalert2/dark.css' ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/toastr/toastr.min.css' ?>">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    <!-- jQuery -->
    <script src="<?= base_url() . 'assets/plugins/jquery/jquery.min.js' ?>"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-black navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <p class="font-weight-light mb-0 text-muted">PORTAL KLINIK</p>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <p class="font-weight-light text-xs mb-0 text-muted">Server Time :</p>
                    <p class="font-weight-light text-xs mb-0 text-muted" id="time"></p>

                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-info ">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel  py-2 mb-3 d-flex mx-n2  rounded-bottom">
                    <span class="navbar-brand text-white ml-3">
                        <p class="m-0 font-weight-normal  text-xs mr-4">Anda log in sebagai :</p>
                        <p class="m-0 font-weight-bold text-md mr-4"><?= ucwords(decrypt_url($this->session->userdata('nama_user')))  ?></p>
                        <p class="m-0 font-weight-normal   text-xs mr-4"><?= decrypt_url($this->session->userdata('email'))  ?></p>
                    </span>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    DASHBOARD
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= $this->uri->segment(1) == 'kunjungan' || $this->uri->segment(1) == 'skd' || $this->uri->segment(1) == 'kk' || $this->uri->segment(1) == 'mcu' ? 'menu-open ' : '' ?>">
                            <a href="" class="nav-link <?= $this->uri->segment(1) == 'kunjungan' || $this->uri->segment(1) == 'skd' || $this->uri->segment(1) == 'kk' || $this->uri->segment(1) == 'mcu' ? 'active ' : '' ?>">
                                <i class=" nav-icon fas fa-notes-medical"></i>
                                <p>
                                    INPUT AKTIVITAS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('kunjungan') ?>" class="nav-link <?= $this->uri->segment(1) == 'kunjungan' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>KUNJUNGAN</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('skd') ?>" class="nav-link <?= $this->uri->segment(1) == 'skd' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SKD</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('kk') ?>" class="nav-link <?= $this->uri->segment(1) == 'kk' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>KECELAKAAN KERJA</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('mcu') ?>" class="nav-link <?= $this->uri->segment(1) == 'mcu' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>MCU</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('karyawan') ?>" class="nav-link <?= $this->uri->segment(1) == 'karyawan' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    DATA KARYAWAN
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('obat') ?>" class="nav-link <?= $this->uri->segment(1) == 'obat' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-pills"></i>
                                <p>
                                    INVENTORY OBAT
                                </p>
                            </a>
                        </li>
                        <?php
                        if (decrypt_url($this->session->userdata('level')) == 'ADMINISTRATOR') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('user') ?>" class="nav-link <?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user-lock"></i>
                                    <p>
                                        DATA USER
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <hr>
                        <li class="nav-item">
                            <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    LOGOUT
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-3">
            <?= $contents ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="text-sm font-weight-light">
                <strong>Copyright &copy; 2024 </strong> -
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block text-sm text-muted">
                    Made with <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="red" class="bi bi-heart-fill mx-0" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg>
                    for <a href="#" class="text-muted " target="_blank">Portal Klinik</a>
                </div>
            </div>

        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url() . 'assets/plugins/jquery-ui/jquery-ui.min.js' ?>"></script>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() . 'assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js' ?>"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() . 'assets/plugins/chart.js/Chart.min.js' ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url() . 'assets/plugins/sparklines/sparkline.js' ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url() . 'assets/plugins/jqvmap/jquery.vmap.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/plugins/jqvmap/maps/jquery.vmap.usa.js' ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url() . 'assets/plugins/jquery-knob/jquery.knob.min.js' ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url() . 'assets/plugins/moment/moment.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/plugins/daterangepicker/daterangepicker.js' ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url() . 'assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ?>"></script>
    <!-- Summernotassets/e -->
    <script src="<?= base_url() . 'assets/plugins/summernote/summernote-bs4.min.js' ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url() . 'assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() . 'assets/dist/js/adminlte.js' ?>"></script>
    <!-- Sweetalert -->
    <script src="<?= base_url() . 'assets/plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
    <!-- Toastr -->
    <script src="<?= base_url() . 'assets/plugins/toastr/toastr.min.js' ?>"></script>
    <script src="<?= base_url() . '/assets/dist/js/datatablesConfig.js' ?>"></script>
    <script src="<?= base_url() . '/assets/dist/js/goa.js' ?>"></script>
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>





</body>

</html>
<script>
    var timestamp = '<?= time(); ?>';

    function updateTime() {
        $('#time').html(Date(timestamp));
        timestamp++;
    }
    $(function() {
        setInterval(updateTime, 1000);
    });
    $(function() {
        bsCustomFileInput.init();
    });

    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });
        <?php if ($this->session->flashdata('success')) { ?> Toast.fire({
                icon: 'success',
                title: '<?= $this->session->flashdata('success'); ?>'
            });
        <?php } else if ($this->session->flashdata('error')) { ?> Toast.fire({
                icon: 'error',
                title: '<?= $this->session->flashdata('error'); ?>'
            });
        <?php } else if ($this->session->flashdata('warning')) { ?> Toast.fire({
                icon: 'warning',
                title: '<?= $this->session->flashdata('warning'); ?>'
            });
        <?php } else if ($this->session->flashdata('info')) { ?> Toast.fire({
                icon: 'info',
                title: '<?= $this->session->flashdata('info'); ?>'
            });
        <?php } ?>
    });
</script>