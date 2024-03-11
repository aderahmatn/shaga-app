<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Gisaka Media | Formulir Berlangganan</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/dist/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/dist/css/custom.css' ?>">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/sweetalert2/dark.css' ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/toastr/toastr.min.css' ?>">
    <!-- jQuery -->
    <script src="<?= base_url() . 'assets/plugins/jquery/jquery.min.js' ?>"></script>

</head>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-3" src="<?= base_url() . 'assets/images/logogisaka.png' ?>" alt="" width="200">
            <h2>FORMULIR BERLANGGANAN</h2>
            <i class="font-weight-light">SUBSCRIPTION FORM</i>
        </div>
        <form role="form" method="POST" action="" autocomplete="off" enctype="multipart/form-data" onsubmit="ShowLoading()">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <div class="border border-primary p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fjenis_formulir">Formulir
                                <small class="font-weight-light font-italic">/ Form</small>
                            </label>
                            <select class="form-control <?php echo form_error('fjenis_formulir') ? 'is-invalid' : '' ?>" id="fjenis_formulir" name="fjenis_formulir">
                                <option hidden value="" selected>Pilih Jenis Formulir </option>

                                <option value="PELANGGAN BARU" <?= $this->input->post('fjenis_formulir') == "PELANGGAN BARU" ? 'selected' : '' ?>>PELANGGAN BARU</option>
                                <option value="PERPANJANGAN BERLANGGANAN" <?= $this->input->post('fjenis_formulir') == "PERPANJANGAN BERLANGGANAN" ? 'selected' : '' ?>>PERPANJANGAN BERLANGGANAN</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fjenis_formulir') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-3 pt-3">
                <h5 class="mb-3 text-bold">INFORMASI PELANGGAN <small class="font-weight-light font-italic">/ CUSTOMER INFORMATION</small>
                </h5>
            </div>
            <div class="border border-primary p-3">
                <p class="text-bold">DATA PENANGGUNG JAWAB / PEMBAYAR TAGIHAN <small class="font-weight-light font-italic">/ RESPONSIBLE PARTY DATA</small></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Nama Lengkap
                                <small class="font-weight-light font-italic">/ Full Name</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap') ?>" placeholder="Nama lengkap">
                            <div class="invalid-feedback">
                                <?= form_error('fnama_lengkap') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fjenkel">Jenis Kelamin
                                <small class="font-weight-light font-italic">/ Gender</small>
                            </label>
                            <select class="form-control <?php echo form_error('fjenkel') ? 'is-invalid' : '' ?>" id="fjenkel" name="fjenkel">
                                <option hidden value="" selected>Pilih Jenis Kelamin </option>

                                <option value="PRIA" <?= $this->input->post('fjenkel') == "PRIA" ? 'selected' : '' ?>>PRIA / MALE</option>
                                <option value="WANITA" <?= $this->input->post('fjenkel') == "WANITA" ? 'selected' : '' ?>>WANITA / FEMALE</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fjenkel') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="ftgl_lahir">Tanggal Lahir
                                <small class="font-weight-light font-italic">/ Date Of Brith</small>
                            </label>
                            <input type="date" class="form-control <?= form_error('ftgl_lahir') ? 'is-invalid' : '' ?>" id="ftgl_lahir" name="ftgl_lahir" value="<?= $this->input->post('ftgl_lahir'); ?>">
                        </div>
                        <div class="invalid-feedback">
                            <?= form_error('ftgl_lahir') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="fnomor_identitas">Nomor KTP / SIM / Passpor
                                <small class="font-weight-light font-italic">/ ID / Driver's License / Passport</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnomor_identitas') ? 'is-invalid' : '' ?>" id="fnomor_identitas" name="fnomor_identitas" value="<?= $this->input->post('fnomor_identitas'); ?>" placeholder="Nomor identitas">
                            <div class="invalid-feedback">
                                <?= form_error('fnomor_identitas') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="fjenis_identitas">Jenis Kartu Identitas
                                <small class="font-weight-light font-italic">/ Type Of Identity Card</small>
                            </label>
                            <select class="form-control <?php echo form_error('fjenis_identitas') ? 'is-invalid' : '' ?>" id="fjenis_identitas" name="fjenis_identitas">
                                <option hidden value="" selected>Pilih Jenis Identias </option>
                                <option value="KTP" <?= $this->input->post('fjenis_identitas') == "KTP" ? 'selected' : '' ?>>KTP</option>
                                <option value="SIM" <?= $this->input->post('fjenis_identitas') == "SIM" ? 'selected' : '' ?>>SIM</option>
                                <option value="PASSPORT" <?= $this->input->post('fjenis_identitas') == "PASSPORT" ? 'selected' : '' ?>>PASSPORT</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fjenis_identitas') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label class="control-label" for="falamat_identitas">Alamat sesuai KTP / SIM / Passport
                                <small class="font-weight-light font-italic"> / Address as indicated on ID / Driver's License / Passport</small>
                            </label>
                            <textarea name="falamat_identitas" class="form-control <?= form_error('falamat_identitas') ? 'is-invalid' : '' ?> text-uppercase" id="falamat_identitas"><?= $this->input->post('falamat_identitas'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('falamat_identitas') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group required">
                            <label for="flampiran" class="control-label">Foto KTP / SIM / Passport
                                <small class="font-weight-light font-italic"> / Picture Of KTP / SIM / Passport</small>
                            </label>
                            <input type="file" class="pb-4 form-control <?= form_error('flampiran') ? 'is-invalid' : '' ?>" id="flampiran" name="flampiran">
                            <small id="flampiran" class="form-text text-muted">Format file harus .png .jpg .jpeg, ukuran
                                maksimal 2 Mb </small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group ">
                            <label class="control-label" for="fnpwp">Nomor NPWP
                                <small class="font-weight-light font-italic">/ NPWP Number</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnpwp') ? 'is-invalid' : '' ?>" id="fnpwp" name="fnpwp" value="<?= $this->input->post('fnpwp'); ?>" placeholder="Nomor NPWP">
                            <div class="invalid-feedback">
                                <?= form_error('fnpwp') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label class="control-label" for="fkota">Kota
                                <small class="font-weight-light font-italic">/ City</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fkota') ? 'is-invalid' : '' ?>" id="fkota" name="fkota" value="<?= $this->input->post('fkota'); ?>" placeholder="Kota">
                            <div class="invalid-feedback">
                                <?= form_error('fkota') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label class="control-label" for="fkode_pos">Kode Pos
                                <small class="font-weight-light font-italic">/ Zip Code</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fkode_pos') ? 'is-invalid' : '' ?>" id="fkode_pos" name="fkode_pos" value="<?= $this->input->post('fkode_pos'); ?>" placeholder="Kode Pos">
                            <div class="invalid-feedback">
                                <?= form_error('fkode_pos') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group ">
                            <label class="control-label" for="ffaksimili">Faksimili
                                <small class="font-weight-light font-italic">/ Facsimile</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('ffaksimili') ? 'is-invalid' : '' ?>" id="ffaksimili" name="ffaksimili" value="<?= $this->input->post('ffaksimili'); ?>" placeholder="Faksimili">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnowa">Nomor Whatsapp
                                <small class="font-weight-light font-italic">/ Whatsapp Number</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnowa') ? 'is-invalid' : '' ?>" id="fnowa" name="fnowa" value="<?= $this->input->post('fnowa'); ?>" placeholder="Contoh : 6281235664172">
                            <div class="invalid-feedback">
                                <?= form_error('fnowa') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fseluler">Selular
                                <small class="font-weight-light font-italic">/ Cellular</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fseluler') ? 'is-invalid' : '' ?>" id="fseluler" name="fseluler" value="<?= $this->input->post('fseluler'); ?>" placeholder="Selular">
                            <div class="invalid-feedback">
                                <?= form_error('fseluler') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="femail">Email
                                <small class="font-weight-light font-italic">/ email</small>
                            </label>
                            <input type="email" class="form-control <?= form_error('femail') ? 'is-invalid' : '' ?>" id="femail" name="femail" value="<?= $this->input->post('femail'); ?>" placeholder="Email">
                            <div class="invalid-feedback">
                                <?= form_error('femail') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-3 pt-3">
                <h5 class="mb-3 text-bold">KEBUTUHAN BANDWIDTH <small class="font-weight-light font-italic">/ BANDWIDTH NEEDS</small>
                </h5>
            </div>
            <div class="border border-primary p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fjenis_layanan">Jenis Layanan
                                <small class="font-weight-light font-italic">/ Service Type</small>
                            </label>
                            <select class="form-control <?php echo form_error('fjenis_layanan') ? 'is-invalid' : '' ?>" id="fjenis_layanan" name="fjenis_layanan">
                                <option hidden value="" selected>Pilih Jenis Layanan </option>
                                <option value="BROADBAND" <?= $this->input->post('fjenis_layanan') == "BROADBAND" ? 'selected' : '' ?>>BROADBAND</option>
                                <option value="DEDICATED" <?= $this->input->post('fjenis_layanan') == "DEDICATED" ? 'selected' : '' ?>>DEDICATED</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fjenis_layanan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fbandwidth">Kebutuhan Bandwidth
                                <small class="font-weight-light font-italic">/ Bandwidth Needs</small>
                            </label>
                            <select class="form-control <?php echo form_error('fbandwidth') ? 'is-invalid' : '' ?>" id="fbandwidth" name="fbandwidth">
                                <option hidden value="" selected>Pilih Bandwidth </option>
                                <option value="10 Mbps" <?= $this->input->post('fbandwidth') == "10 Mbps" ? 'selected' : '' ?>>10 Mbps</option>
                                <option value="20 Mbps" <?= $this->input->post('fbandwidth') == "20 Mbps" ? 'selected' : '' ?>>20 Mbps</option>
                                <option value="40 Mbps" <?= $this->input->post('fbandwidth') == "40 Mbps" ? 'selected' : '' ?>>40 Mbps</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fbandwidth') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="row_blainnya">

                    </div>
                </div>
            </div>
            <div class="row px-3 pt-3">
                <h5 class="mb-3 text-bold">LOKASI PEMASANGAN <small class="font-weight-light font-italic">/ INSTALLATION LOCATION</small>
                </h5>
            </div>
            <div class="border border-primary p-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="falamat_pemasangan">Alamat Pemasangan
                                <small class="font-weight-light font-italic"> / Installation Address </small>
                            </label>
                            <textarea name="falamat_pemasangan" class="form-control <?= form_error('falamat_pemasangan') ? 'is-invalid' : '' ?> text-uppercase" id="falamat_pemasangan"><?= $this->input->post('falamat_pemasangan'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('falamat_pemasangan') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="frt">RT
                                <small class="font-weight-light font-italic">/ RT</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('frt') ? 'is-invalid' : '' ?>" id="frt" name="frt" value="<?= $this->input->post('frt'); ?>" placeholder="RT">
                            <div class="invalid-feedback">
                                <?= form_error('frt') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="frw">RW
                                <small class="font-weight-light font-italic">/ RW</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('frw') ? 'is-invalid' : '' ?>" id="frw" name="frw" value="<?= $this->input->post('frw'); ?>" placeholder="RW">
                            <div class="invalid-feedback">
                                <?= form_error('frw') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fdesa">Desa / Kelurahan
                                <small class="font-weight-light font-italic">/ Village</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fdesa') ? 'is-invalid' : '' ?>" id="fdesa" name="fdesa" value="<?= $this->input->post('fdesa'); ?>" placeholder="Desa">
                            <div class="invalid-feedback">
                                <?= form_error('fdesa') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fkecamatan">Kecamatan
                                <small class="font-weight-light font-italic">/ Subdistrict</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fkecamatan') ? 'is-invalid' : '' ?>" id="fkecamatan" name="fkecamatan" value="<?= $this->input->post('fkecamatan'); ?>" placeholder="Kecamatan">
                            <div class="invalid-feedback">
                                <?= form_error('fkecamatan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fkota_pemasangan">Kota
                                <small class="font-weight-light font-italic">/ City</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fkota_pemasangan') ? 'is-invalid' : '' ?>" id="fkota_pemasangan" name="fkota_pemasangan" value="<?= $this->input->post('fkota_pemasangan'); ?>" placeholder="Kota">
                            <div class="invalid-feedback">
                                <?= form_error('fkota_pemasangan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fkode_pos_pemasangan">Kode Pos
                                <small class="font-weight-light font-italic">/ Zip Code</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fkode_pos_pemasangan') ? 'is-invalid' : '' ?>" id="fkode_pos_pemasangan" name="fkode_pos_pemasangan" value="<?= $this->input->post('fkode_pos_pemasangan'); ?>" placeholder="Kode Pos">
                            <div class="invalid-feedback">
                                <?= form_error('fkode_pos_pemasangan') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-3 pt-3">
                <h5 class="mb-3 text-bold">JANGKA WAKTU BERLANGGANAN
                    <small class="font-weight-light font-italic">/ SUBSCRIPTION PERIOD</small>
                </h5>
            </div>
            <div class="border border-primary p-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="fjangka_waktu_berlangganan">Jangka Waktu Berlangganan
                                <small class="font-weight-light font-italic">/ Subscription Period</small>
                            </label>
                            <select class="form-control <?php echo form_error('fjangka_waktu_berlangganan') ? 'is-invalid' : '' ?>" id="fjangka_waktu_berlangganan" name="fjangka_waktu_berlangganan">
                                <option hidden value="" selected>Pilih Jangka Waktu </option>
                                <option value="1 Tahun" <?= $this->input->post('fjangka_waktu_berlangganan') == "1 Tahun" ? 'selected' : '' ?>>1 Tahun</option>
                                <option value="2 Tahun" <?= $this->input->post('fjangka_waktu_berlangganan') == "2 Tahun" ? 'selected' : '' ?>>2 Tahun</option>
                                <option value="3 Tahun" <?= $this->input->post('fjangka_waktu_berlangganan') == "3 Tahun" ? 'selected' : '' ?>>3 Tahun</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fjangka_waktu_berlangganan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="row_jlainnya">

                    </div>
                </div>
                <p class="text-bold">TARGET PEMASANGAN <small class="font-weight-light font-italic">/ NSTALLATION SCHEDULE</small></p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="ftgl_pemasangan">Tanggal Pemasangan
                                <small class="font-weight-light font-italic">/ Installation Date</small>
                            </label>
                            <input type="date" class="form-control <?= form_error('ftgl_pemasangan') ? 'is-invalid' : '' ?>" id="ftgl_pemasangan" name="ftgl_pemasangan" value="<?= $this->input->post('ftgl_pemasangan'); ?>">
                            <div class="invalid-feedback">
                                <?= form_error('ftgl_pemasangan') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-bold mb-0">Ketentuan <small class="font-weight-light font-italic">/ Term</small> :</p>
                <p class="">Jika pelanggan berhenti berlangganan sebelum masa kontrak habis maka akan dikenakan biaya denda/finalty sebesar nilai biaya bulanan dikalikan dengan sisa masa kontrak.</p>
            </div>
            <div class="py-5 text-center mb-5">
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT DATA</button>
            </div>
        </form>
    </div>
</body>
<!-- Sweetalert -->
<script src="<?= base_url() . 'assets/plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
<!-- Toastr -->
<script src="<?= base_url() . 'assets/plugins/toastr/toastr.min.js' ?>"></script>

</html>
<script>
    $('button[type=submit]').click(function() {
        $(this).attr('disabled', 'disabled');
        $('input').attr('readonly', 'readonly');
        $('select').attr('readonly', 'readonly');
        $('textarea').attr('readonly', 'readonly');
        $(this).parents('form').submit();
    });

    function ShowLoading(e) {

        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = '<?= base_url('assets/images/loading2.gif') ?>';
        div.innerHTML = "Sedang Mengirim Data...<br />";
        div.style.cssText = 'position:fixed; top:7%; left:50%; margin-left: -250px; z-index: 5000; width: 500px;  text-align: center; background: #BBE2EC; padding-top:20px;';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
    }
    $("#fbandwidth").change(function() {
        var selected_option = $('#fbandwidth').val();
        if (selected_option === 'Lainnya') {
            $("#row_blainnya").append(`<div class="form-group required" id="bandwidth_l" >
                            <label class="control-label" for="fbandwidth_lainnya">Lainnya
                                <small class="font-weight-light font-italic">/ Other</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fbandwidth_lainnya') ? 'is-invalid' : '' ?>" id="fbandwidth_lainnya" name="fbandwidth_lainnya" value="<?= $this->input->post('fbandwidth_lainnya'); ?>" placeholder="Contoh : 50 Mbps" required>
                        </div>`);

        }
        if (selected_option != 'Lainnya') {
            $("#bandwidth_l").remove()
        }
    })


    $("#fjangka_waktu_berlangganan").change(function() {
        var selected_option = $('#fjangka_waktu_berlangganan').val();
        if (selected_option === 'Lainnya') {
            $("#row_jlainnya").append(`<div class="form-group required" id="jlainnya">
                            <label class="control-label" for="fjangka_waktu_berlangganan_lainnya">Lainnya
                                <small class="font-weight-light font-italic">/ Other</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fjangka_waktu_berlangganan_lainnya') ? 'is-invalid' : '' ?>" id="fjangka_waktu_berlangganan_lainnya" name="fjangka_waktu_berlangganan_lainnya" value="<?= $this->input->post('fjangka_waktu_berlangganan_lainnya'); ?>" placeholder="Contoh : 10 Tahun" required>
                        </div>`);

        }
        if (selected_option != 'Lainnya') {
            $("#jlainnya").remove()
        }
    })

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