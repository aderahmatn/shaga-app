<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Customers</li>
                    <li class="breadcrumb-item active">New Customer</li>
                </ol>
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
                            <div class="form-group">
                                <label for="fid_customer">ID Pelanggan</label>
                                <input type="text"
                                    class="form-control <?= form_error('fid_customer') ? 'is-invalid' : '' ?>"
                                    id="fid_customer" name="fid_customer" placeholder="Nama lengkap"
                                    value="<?= $this->input->post('fid_customer'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fid_customer') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ffullname">Nama Lengkap</label>
                                <input type="text"
                                    class="form-control <?= form_error('ffullname') ? 'is-invalid' : '' ?>"
                                    id="ffullname" name="ffullname" placeholder="Nama lengkap"
                                    value="<?= $this->input->post('ffullname'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ffullname') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fphone_customer">Nomor Handphone</label>
                                <input type="text"
                                    class="form-control <?= form_error('fphone_customer') ? 'is-invalid' : '' ?>"
                                    id="fphone_customer" name="fphone_customer" placeholder="Nomor handphone"
                                    value="<?= $this->input->post('fphone_customer'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fphone_customer') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fno_id">No. Identitas</label>
                                <input type="text" class="form-control <?= form_error('fno_id') ? 'is-invalid' : '' ?>"
                                    id="fno_id" name="fno_id" placeholder="Nomor identitas (KTP/SIM)"
                                    value="<?= $this->input->post('fno_id'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fno_id') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fjenis_id">Jenis Indentitas</label>
                                <select class="form-control <?php echo form_error('fjenis_id') ? 'is-invalid' : '' ?>"
                                    id="fjenis_id" name="fjenis_id">
                                    <option hidden value="" selected>Pilih Identitas </option>
                                    <option value="ktp" <?= $this->input->post('fjenis_id') == "ktp" ? "selected" : "" ?>>KTP
                                    </option>
                                    <option value="sim" <?= $this->input->post('fjenis_id') == "sim" ? "selected" : "" ?>>
                                        SIM</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fjenis_id') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="falamat_id">Alamat Lengkap</label>
                                <textarea name="falamat_id"
                                    class="form-control <?= form_error('falamat_id') ? 'is-invalid' : '' ?> "
                                    id="falamat_id"
                                    placeholder="Alamat sesuai kartu identitas"><?= $this->input->post('falamat_id'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('falamat_id') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fno_npwp">No. NPWP</label>
                                <input type="text"
                                    class="form-control <?= form_error('fno_npwp') ? 'is-invalid' : '' ?>" id="fno_npwp"
                                    name="fno_npwp" placeholder="Nomor NPWP"
                                    value="<?= $this->input->post('fno_npwp'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fno_npwp') ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            <a href="<?= base_url('kegiatan') ?>" class="btn btn-secondary float-left">Batal</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>