<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url() . 'assets/images/favicon1.png' ?>" type="image/jpeg">

    <title>GOA |
        <?= $this->uri->segment(1) ?>
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/fontawesome-free/css/all.min.css' ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url() . 'assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' ?>">
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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <p class="m-0 text-muted text-md mr-4">Gisaka Office Automation</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!-- <div class="image">
                        <img src="<?= base_url() . 'assets/images/user.jpg' ?>" class="img-circle elevation-2"
                            alt="User Image">
                    </div> -->
                    <div class="info">
                        <a href="#" class="d-block">

                            <?= strtoupper($this->session->userdata('nama_user')); ?>

                        </a>
                        <span class="badge badge-pill badge-light">
                            <?= $this->session->userdata('nama_group') ?>
                        </span>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>"
                                class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    DASHBOARD
                                </p>
                            </a>
                        </li>
                        <li
                            class="nav-item <?= $this->uri->segment(1) == 'kasbon' ? 'menu-is-opening menu-open' : '' ?> ">
                            <a href="#" class="nav-link <?= $this->uri->segment(1) == 'kasbon' ? 'active' : '' ?> ">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    PENGAJUAN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('kasbon') ?>"
                                        class="nav-link <?= $this->uri->segment(1) == 'kasbon' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>KASBON</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-header">TICKET MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Browse Ticket
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>
                                    Create Ticket
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CUSTOMERS</li>
                        <li class="nav-item">
                            <a href="<?= base_url('customer/browse') ?>" class="nav-link <?= $this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'browse' ? 'active' : '' ?>
                            ?>active">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>
                                    Browse Customers
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('customer/create') ?>"
                                class="nav-link <?= $this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'create' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    New Customers
                                </p>
                            </a>
                        <li class="nav-header">SERVICES MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>
                                    Browse Services
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>
                                    Create Services
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li> -->
                        <?php if ($this->session->userdata('group') == 1) { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('users') ?>"
                                    class="nav-link <?= $this->uri->segment(1) == 'users' || $this->uri->segment(1) == 'group_users' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user-lock"></i>
                                    <p>
                                        PENGGUNA
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <hr>
                        <li class="nav-item">
                            <a href="<?= base_url('pengaturan/ganti_pass') ?>"
                                class="nav-link <?= $this->uri->segment(1) == 'pengaturan' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    PENGATURAN
                                </p>
                            </a>
                        </li>
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
        <div class="content-wrapper">
            <?= $contents ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="text-sm">
                <strong>Copyright &copy; 2023 </strong> -
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block text-sm text-muted">
                    Made with <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="grey"
                        class="bi bi-heart-fill mx-0" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg>
                    for <a href="https://gisaka.net/" class="text-muted" target="_blank">Gisaka Media</a>
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

    <!-- jQuery -->
    <script src="<?= base_url() . 'assets/plugins/jquery/jquery.min.js' ?>"></script>
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
    <script
        src="<?= base_url() . 'assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ?>"></script>
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

    $(function () {
        bsCustomFileInput.init();
    });

    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });
        <?php if ($this->session->flashdata('success')) { ?>         Toast.fire({ icon: 'success', title: '<?= $this->session->flashdata('success'); ?>' });
        <?php } else if ($this->session->flashdata('error')) { ?>         Toast.fire({ icon: 'error', title: '<?= $this->session->flashdata('error'); ?>' });
                                                                                                                    <?php } else if ($this->session->flashdata('warning')) { ?>         Toast.fire({ icon: 'warning', title: '<?= $this->session->flashdata('warning'); ?>' });
                                                                                                                                                                                                                                                                                                      <?php } else if ($this->session->flashdata('info')) { ?>         Toast.fire({ icon: 'info', title: '<?= $this->session->flashdata('info'); ?>' });
                    <?php } ?>
    });
</script>