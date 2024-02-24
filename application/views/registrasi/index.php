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

</head>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-3" src="<?= base_url() . 'assets/images/logogisaka.png' ?>" alt="" width="200">
            <h2>FORMULIR BERLANGGANAN</h2>
            <i class="font-weight-light">SUBSCRIPTION FORM</i>
        </div>
        <form role="form" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <div class="border border-primary p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Nomor Registrasi
                                <small class="font-weight-light font-italic">/ Registration Number</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Nomor registrasi" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fcara_pencairan">Formulir
                                <small class="font-weight-light font-italic">/ Form</small>
                            </label>
                            <select class="form-control <?php echo form_error('fcara_pencairan') ? 'is-invalid' : '' ?>" id="fcara_pencairan" name="fcara_pencairan">
                                <option hidden value="" selected>Pilih Jenis Formulir </option>

                                <option value="PELANGGAN BARU">PELANGGAN BARU</option>
                                <option value="PERPANJANGAN BERLANGGANAN">PERPANJANGAN BERLANGGANAN</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fcara_pencairan') ?>
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
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Nama lengkap">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fcara_pencairan">Jenis Kelamin
                                <small class="font-weight-light font-italic">/ Gender</small>
                            </label>
                            <select class="form-control <?php echo form_error('fcara_pencairan') ? 'is-invalid' : '' ?>" id="fcara_pencairan" name="fcara_pencairan">
                                <option hidden value="" selected>Pilih Jenis Kelamin </option>

                                <option value="PRIA">PRIA / MALE</option>
                                <option value="WANITA">WANITA / FEMALE</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fcara_pencairan') ?>
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Nomor KTP / SIM / Passpor
                                <small class="font-weight-light font-italic">/ ID / Driver's License / Passport</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Nomor identitas">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="fcara_pencairan">Jenis Kartu Identitas
                                <small class="font-weight-light font-italic">/ Type Of Identity Card</small>
                            </label>
                            <select class="form-control <?php echo form_error('fcara_pencairan') ? 'is-invalid' : '' ?>" id="fcara_pencairan" name="fcara_pencairan">
                                <option hidden value="" selected>Pilih Jenis Identias </option>
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="PASSPORT">PASSPORT</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fcara_pencairan') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label class="control-label" for="fnote">Alamat sesuai KTP / SIM / Passport
                                <small class="font-weight-light font-italic"> / Address as indicated on ID / Driver's License / Passport</small>
                            </label>
                            <textarea name="fnote" class="form-control <?= form_error('fnote') ? 'is-invalid' : '' ?> text-uppercase" id="fnote"><?= $this->input->post('fnote'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('fnote') ?>
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
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Kota
                                <small class="font-weight-light font-italic">/ City</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Kota">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Kode Pos
                                <small class="font-weight-light font-italic">/ Zip Code</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Kode Pos">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label" for="fnama_lengkap">Faksimili
                                <small class="font-weight-light font-italic">/ Facsimile</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Faksimili">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Telepon
                                <small class="font-weight-light font-italic">/ Phone</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Telepon">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Selular
                                <small class="font-weight-light font-italic">/ Cellular</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Selular">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Email
                                <small class="font-weight-light font-italic">/ email</small>
                            </label>
                            <input type="email" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Email">
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
                            <label class="control-label" for="fcara_pencairan">Jenis Layanan
                                <small class="font-weight-light font-italic">/ Service Type</small>
                            </label>
                            <select class="form-control <?php echo form_error('fcara_pencairan') ? 'is-invalid' : '' ?>" id="fcara_pencairan" name="fcara_pencairan">
                                <option hidden value="" selected>Pilih Jenis Layanan </option>
                                <option value="BROADBAND">BROADBAND</option>
                                <option value="DEDICATED">DEDICATED</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fcara_pencairan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fcara_pencairan">Kebutuhan Bandwidth
                                <small class="font-weight-light font-italic">/ Bandwidth Needs</small>
                            </label>
                            <select class="form-control <?php echo form_error('fcara_pencairan') ? 'is-invalid' : '' ?>" id="fcara_pencairan" name="fcara_pencairan">
                                <option hidden value="" selected>Pilih Bandwidth </option>
                                <option value="10 Mbps">10 Mbps</option>
                                <option value="20 Mbps">20 Mbps</option>
                                <option value="40 Mbps">40 Mbps</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fcara_pencairan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Lainnya
                                <small class="font-weight-light font-italic">/ Other</small>
                            </label>
                            <input type="email" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Lainnya">
                        </div>
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
                            <label class="control-label" for="fnote">Alamat Pemasangan
                                <small class="font-weight-light font-italic"> / Installation Address </small>
                            </label>
                            <textarea name="fnote" class="form-control <?= form_error('fnote') ? 'is-invalid' : '' ?> text-uppercase" id="fnote"><?= $this->input->post('fnote'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('fnote') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">RT
                                <small class="font-weight-light font-italic">/ RT</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="RT">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">RW
                                <small class="font-weight-light font-italic">/ RW</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="RW">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Desa / Kelurahan
                                <small class="font-weight-light font-italic">/ Village</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Desa">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Kecamatan
                                <small class="font-weight-light font-italic">/ Subdistrict</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Kecamatan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Kota
                                <small class="font-weight-light font-italic">/ City</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Kota">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Kode Pos
                                <small class="font-weight-light font-italic">/ Zip Code</small>
                            </label>
                            <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Kode Pos">
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
                            <label class="control-label" for="fcara_pencairan">Jangka Waktu Berlangganan
                                <small class="font-weight-light font-italic">/ Subscription Period</small>
                            </label>
                            <select class="form-control <?php echo form_error('fcara_pencairan') ? 'is-invalid' : '' ?>" id="fcara_pencairan" name="fcara_pencairan">
                                <option hidden value="" selected>Pilih Jangka Waktu </option>
                                <option value="1 Tahun">1 Tahun</option>
                                <option value="2 Tahun">2 Tahun</option>
                                <option value="3 Tahun">3 Tahun</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fcara_pencairan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Lainnya
                                <small class="font-weight-light font-italic">/ Other</small>
                            </label>
                            <input type="email" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>" placeholder="Lainnya">
                        </div>
                    </div>
                </div>
                <p class="text-bold">TARGET PEMASANGAN <small class="font-weight-light font-italic">/ NSTALLATION SCHEDULE</small></p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_lengkap">Tanggal Pemasangan
                                <small class="font-weight-light font-italic">/ Installation Date</small>
                            </label>
                            <input type="date" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>">
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

</html>