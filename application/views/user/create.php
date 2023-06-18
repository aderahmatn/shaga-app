<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body">
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="text-sm text-muted text-center">
                                <p>Informasi kontak</p>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="fname_user">Nama Lengkap</label>
                                <input type="text"
                                    class="form-control <?= form_error('fname_user') ? 'is-invalid' : '' ?>"
                                    id="fname_user" name="fname_user" placeholder="Nama lengkap"
                                    value="<?= $this->input->post('fname_user'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fname_user') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="femail_user">Email</label>
                                <input type="email"
                                    class="form-control <?= form_error('femail_user') ? 'is-invalid' : '' ?>"
                                    id="femail_user" name="femail_user" placeholder="Alamat email"
                                    value="<?= $this->input->post('femail_user'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('femail_user') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fphone_user">No. Handphone</label>
                                <input type="text"
                                    class="form-control <?= form_error('fphone_user') ? 'is-invalid' : '' ?>"
                                    id="fphone_user" name="fphone_user" placeholder="Contoh : 087776123870"
                                    value="<?= $this->input->post('fphone_user'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fphone_user') ?>
                                </div>
                            </div>
                            <div class="text-sm text-muted text-center ">
                                <p class="m-0">Informasi Login</p>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="fusername">Username</label>
                                <input type="text"
                                    class="form-control <?= form_error('fusername') ? 'is-invalid' : '' ?>"
                                    id="fusername" name="fusername" placeholder="Username"
                                    value="<?= $this->input->post('fusername'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fusername') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fpassword">Password</label>
                                <input type="password"
                                    class="form-control <?= form_error('fpassword') ? 'is-invalid' : '' ?>"
                                    id="fpassword" name="fpassword" placeholder="Password"
                                    value="<?= $this->input->post('fpassword'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fpassword') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fconfpassword">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control <?= form_error('fconfpassword') ? 'is-invalid' : '' ?>"
                                    id="fconfpassword" name="fconfpassword" placeholder="Password"
                                    value="<?= $this->input->post('fconfpassword'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fconfpassword') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fid_group_user">Group User</label>
                                <select
                                    class="form-control <?php echo form_error('fid_group_user') ? 'is-invalid' : '' ?>"
                                    id="fid_group_user" name="fid_group_user">
                                    <option hidden value="" selected>Pilih Group </option>
                                    <?php foreach ($group_user as $key): ?>
                                        <option value="<?= $key->id_group_user ?>"
                                            <?= $this->input->post('fid_group_user') == $key->id_group_user ? 'selected' : '' ?>>
                                            <?= $key->group_user ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fid_group_user') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-2">Tambah</button>
                            <a href="<?= base_url('users') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>