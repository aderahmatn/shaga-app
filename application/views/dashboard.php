<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gisaka Automation System</h1> Dashboard

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php if ($isdefault) { ?>
            <div class="alert alert-dismissible alert-default-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-exclamation-triangle"></i>Demi keamanan akun anda, silahkan mengganti password pada
                menu <a href="<?= base_url('pengaturan/ganti_pass') ?>" class="text-info">pengaturan/ganti_password</a>
            </div>
        <?php } ?>

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="callout callout-info">
                    <h5>Informasi</h5>
                    <p>Saat ini sistem <i> Gisaka Office Automation sedang dalam masa percobaan</i>,<br> Silahkan
                        sampaikan
                        kendala
                        / bug atau masukan ke <a
                            href="https://wa.me/6287776451664/?text=Hallo%20Administrator%20GOA%2C%20%0A"
                            target="_blank" class="text-info">wa.me/administrator</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>