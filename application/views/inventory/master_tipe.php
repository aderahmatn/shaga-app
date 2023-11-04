<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="mt-2">MASTER TIPE BARANG</h1>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('inventory/master_merek') ?>">MASTER MEREK</a>
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('inventory') ?>">KEMBALI</a>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body table-responsive-sm">
                        <table id="TabelUser" class="table table-condensed table-sm ">
                            <thead>
                                <tr>
                                    <th>KODE TIPE</th>
                                    <th>NAMA MEREK</th>
                                    <th>SPEKSIFIKASI</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($master_tipe as $key) : ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-secondary text-uppercase">
                                                <?= $key->kode_tipe ?>
                                            </span>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= $key->nama_merek ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= $key->spesifikasi ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'inventory/delete_master_tipe/' . encrypt_url($key->id_master_merek) ?>')">DELETE</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- left column -->
            <div class="col-md-5">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body">
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="form-group required">
                                <label class="control-label" for="fkode_merek">Kode Tipe</label>
                                <input type="text" class="form-control <?= form_error('fkode_tipe') ? 'is-invalid' : '' ?>" id="fkode_tipe" name="fkode_tipe" placeholder="Kode barang" value="<?= 'TP' . sprintf("%04d", $no_urut) ?>" readonly>
                                <div class="invalid-feedback">
                                    <?= form_error('fkode_tipe') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fmerek">Merek</label>
                                <select class="form-control <?php echo form_error('fmerek') ? 'is-invalid' : '' ?>" id="fmerek" name="fmerek">
                                    <option hidden value="" selected>Pilih Merek </option>
                                    <?php foreach ($master_merek as $key) : ?>
                                        <option value="<?= $key->id_master_merek ?>" <?= $this->input->post('fkode_tipe') == $key->id_master_merek ? 'selected' : '' ?>><?= strtoupper($key->nama_merek) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fmerek') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fspesifikasi">Spesifikasi</label>
                                <textarea name="fspesifikasi" class="form-control <?= form_error('fspesifikasi') ? 'is-invalid' : '' ?> text-uppercase" id="fspesifikasi"><?= $this->input->post('fspesifikasi'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('fspesifikasi') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>

                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>


        </div>
    </div>
</section>

<!--Delete Confirmation-->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center">
                        <i class="fa  fa-exclamation-triangle" style="font-size: 70px; color:red;"></i>
                    </div>
                    <div class="col-9 pt-2">
                        <h5>Apakah anda yakin?</h5>
                        <span>Data yang dihapus tidak akan bisa dikembalikan.</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal"> Batal</button>
                <a id="btn-delete" class="btn btn-danger" href="#"> Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirm -->
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>