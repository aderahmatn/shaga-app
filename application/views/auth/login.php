<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GAS | Login</title>



    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url() . 'assets/images/favicon1.png' ?>" type="image/jpeg">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/fontawesome-free/css/all.min.css' ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/dist/css/adminlte.min.css' ?>">
    <!-- <link rel="stylesheet" href="<?= base_url("assets/dist/css/custom.css") ?>"> -->

    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/sweetalert2/dark.css' ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/toastr/toastr.min.css' ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page bg-dark">
    <div class="login-box">
        <div class="row  justify-content-center">
        </div>

        <!-- /.login-logo -->
        <div class="card ">
            <div class="card-body login-card-body ">
                <div class="login-logo">
                    <p class="font-weight-light text-primary" style="font-size:1.8rem;">Gisaka Automation System</p>
                </div>
                <p class="login-box-msg">Login untuk memulai sesi anda</p>

                <form action="<?= base_url('auth/process') ?>" method="post" autocomplete="off">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <input type="hidden" name="flock" id="lock" style="display: none">
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="Username" name="fusername" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" autocomplete="on" name="fpassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-5 mb-4">
                            <canvas id="canvas" style="height:55px"></canvas>
                        </div>
                        <div class="col-md-7 ">
                            <div class="form-group mb-1">
                                <input type="text" class="form-control" placeholder="Ketik captcha disini" autocomplete="off" name="code" required>
                            </div>
                            <div class="">
                                <p id="not-valid" class="text-xs text-danger"> </p>
                            </div>
                        </div>
                    </div>
                    <div class=" row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" name="login" id="valid">Log
                                In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() . 'assets/plugins/jquery/jquery.min.js' ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() . 'assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() . 'assets/dist/js/adminlte.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/dist/js/jquery-captcha.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/dist/js/login.js' ?>"></script>
    <!-- Sweetalert -->
    <script src="<?= base_url() . 'assets/plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
    <!-- Toastr -->
    <script src="<?= base_url() . 'assets/plugins/toastr/toastr.min.js' ?>"></script>
    <!-- Alert Config -->
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
            });
            <?php if ($this->session->flashdata('success')) { ?>
                Toast.fire({
                    icon: 'success',
                    title: '<?= $this->session->flashdata('success'); ?>'
                });
            <?php } else if ($this->session->flashdata('error')) { ?>
                Toast.fire({
                    icon: 'error',
                    title: '<?= $this->session->flashdata('error'); ?>'
                });
            <?php } else if ($this->session->flashdata('warning')) { ?>
                Toast.fire({
                    icon: 'warning',
                    title: '<?= $this->session->flashdata('warning'); ?>'
                });
            <?php } else if ($this->session->flashdata('info')) { ?>
                Toast.fire({
                    icon: 'info',
                    title: '<?= $this->session->flashdata('info'); ?>'
                });
            <?php } ?>
        });
    </script>

</body>

</html>