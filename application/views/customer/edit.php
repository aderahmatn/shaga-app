<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pelanggan</h1>
                <p>
                    <?= $cust->id_customer ?>
                </p>
            </div>

        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="" autocomplete="off">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <div class="card-body">
                            <div class="form-group required">
                                <label class="control-label" for="fid_customer">ID Pelanggan</label>
                                <input type="text"
                                    class="form-control <?= form_error('fid_customer') ? 'is-invalid' : '' ?>"
                                    id="fid_customer" name="fid_customer" placeholder="ID Pelanggan"
                                    value="<?= $cust->id_customer ?>" readonly>
                                <div class="invalid-feedback">
                                    <?= form_error('fid_customer') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="ffullname">Nama Lengkap</label>
                                <input type="text"
                                    class="form-control <?= form_error('ffullname') ? 'is-invalid' : '' ?>"
                                    id="ffullname" name="ffullname" placeholder="Nama lengkap"
                                    value="<?= $cust->fullname ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ffullname') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fphone_customer">Nomor Handphone</label>
                                <input type="text"
                                    class="form-control <?= form_error('fphone_customer') ? 'is-invalid' : '' ?>"
                                    id="fphone_customer" name="fphone_customer" placeholder="Nomor handphone"
                                    value="<?= $cust->phone_customer ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fphone_customer') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fno_id">No. Identitas</label>
                                <input type="text" class="form-control <?= form_error('fno_id') ? 'is-invalid' : '' ?>"
                                    id="fno_id" name="fno_id" placeholder="Nomor identitas (KTP/SIM)"
                                    value="<?= $cust->no_id ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fno_id') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fjenis_id">Jenis Indentitas</label>
                                <select class="form-control <?php echo form_error('fjenis_id') ? 'is-invalid' : '' ?>"
                                    id="fjenis_id" name="fjenis_id">
                                    <option hidden value="" selected>Pilih Identitas </option>
                                    <?php $jenis = $this->input->post('fjenis_id') ? $this->input->post('fjenis_id') : $cust->jenis_id ?>
                                    <option value="ktp" <?= $jenis == "ktp" ? "selected" : "" ?>>
                                        KTP
                                    </option>
                                    <option value="sim" <?= $jenis == "sim" ? "selected" : "" ?>>
                                        SIM</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fjenis_id') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="falamat_id">Alamat Lengkap</label>
                                <textarea name="falamat_id"
                                    class="form-control <?= form_error('falamat_id') ? 'is-invalid' : '' ?> "
                                    id="falamat_id"
                                    placeholder="Alamat sesuai kartu identitas"><?= $cust->alamat_id ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('falamat_id') ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="fno_npwp">No. NPWP</label>
                                <input type="text"
                                    class="form-control <?= form_error('fno_npwp') ? 'is-invalid' : '' ?>" id="fno_npwp"
                                    name="fno_npwp" placeholder="Nomor NPWP" value="<?= $cust->no_npwp ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fno_npwp') ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            <a href="<?= base_url('customer/browse') ?>" class="btn btn-secondary float-left">Batal</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>