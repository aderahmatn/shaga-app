<section class="content-header align-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mt-2">SURAT PERINTAH KERJA</h1>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('jenis_pekerjaan') ?>">MASTER JENIS PEKERJAAN</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body table-responsive-sm">
                        <table id="tableUSer" class="display nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO SPK</th>
                                    <th>TGL SPK</th>
                                    <th>PELAKSANA</th>
                                    <th>SITE</th>
                                    <th>ALAMAT</th>
                                    <th>JENIS SITE</th>
                                    <th>JENIS PEKERJAAN</th>
                                    <th>PIC</th>
                                    <th>TELEPON PIC</th>
                                    <th>PROJECT</th>
                                    <th>CATATAN</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($spk as $key) : ?>
                                    <tr>

                                        <td>
                                            <span class="badge badge-secondary text-uppercase">
                                                <?= $key->no_spk ?>
                                            </span>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= TanggalIndo($key->tgl_spk) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->nama_user) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->nama_site) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->alamat_site) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->jenis_site) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->jenis_pekerjaan) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->pic_site) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->telepon_pic_site) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->nama_project) ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= strtoupper($key->note_spk) ?>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('pdf/spk_pdf/') . encrypt_url($key->id_spk) ?>" target="_blank" class="btn btn-xs btn-success">PRINT SPK</a>
                                            <a href="<?= base_url('spk/edit/') . encrypt_url($key->id_spk) ?>" class="btn btn-xs btn-primary">EDIT DATA</a>
                                            <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'spk/delete_spk/' . encrypt_url($key->id_spk) ?>')">DELETE</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- left column -->
            <div class="col-md-4">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body">
                        <h5 class="text-primary">BUAT SPK BARU</h5>
                        <hr>
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <input type="hidden" name="fid_project" id="fid_project" style="display: none">
                            <div class="form-group required">
                                <label class="control-label" for="fid_user">Diberikan Kepada</label>
                                <select class="form-control <?php echo form_error('fid_user') ? 'is-invalid' : '' ?>" id="fid_user" name="fid_user">
                                    <option hidden value="" selected>Pilih karyawan </option>
                                    <?php foreach ($user as $key) : ?>
                                        <option value="<?= encrypt_url($key->id_user) ?>" <?= $this->input->post('fid_user') == encrypt_url($key->id_user) ? 'selected' : '' ?>><?= $key->nik . ' - ' . strtoupper($key->nama_user) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fid_user') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_spk">Tanggal SPK</label>
                                <input type="date" class="form-control <?= form_error('ftgl_spk') ? 'is-invalid' : '' ?>" id="ftgl_spk" name="ftgl_spk" placeholder="Nama site" value="<?= date('Y-m-d') ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_spk') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fnama_project">Project</label>
                                <div class="input-group ">
                                    <input type="text" class=" form-control <?php echo form_error('fnama_project') ? 'is-invalid' : '' ?>" id="fnama_project" name="fnama_project" onfocus="onFocus()" placeholder="Pilih project" value="<?= $this->input->post('fnama_project'); ?>">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_tipe_barang"><i class="fas fa-search"></i></button>
                                    </span>
                                    <div class="invalid-feedback">
                                        <?= form_error('fnama_project') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fjenis_pekerjaan">Jenis Pekerjaan</label>
                                <select class="form-control <?php echo form_error('fjenis_pekerjaan') ? 'is-invalid' : '' ?>" id="fjenis_pekerjaan" name="fjenis_pekerjaan">
                                    <option hidden value="" selected>Pilih jenis pekerjaan </option>
                                    <?php foreach ($jenis_pekerjaan as $key) : ?>
                                        <option value="<?= $key->id_jenis_pekerjaan ?>" <?= $this->input->post('fjenis_pekerjaan') == $key->id_jenis_pekerjaan ? 'selected' : '' ?>><?= strtoupper($key->jenis_pekerjaan) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fjenis_pekerjaan') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fnama_site">Nama Site</label>
                                <input type="text" class="form-control <?= form_error('fnama_site') ? 'is-invalid' : '' ?>" id="fnama_site" name="fnama_site" placeholder="Nama site" value="<?= $this->input->post('fnama_site'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fnama_site') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fjenis_site">Jenis Site</label>
                                <select class="form-control <?php echo form_error('fjenis_site') ? 'is-invalid' : '' ?>" id="fjenis_site" name="fjenis_site">
                                    <option hidden value="" selected>Pilih site </option>
                                    <option value="pelanggan" <?= $this->input->post('fjenis_site') == 'pelanggan' ? 'selected' : '' ?>>PELANGGAN </option>
                                    <option value="pop" <?= $this->input->post('fjenis_site') == 'pop' ? 'selected' : '' ?>>POP </option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fjenis_site') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="falamat_site" class="control-label">Alamat Site</label>
                                <textarea name="falamat_site" class="form-control <?= form_error('falamat_site') ? 'is-invalid' : '' ?> " placeholder="Alamat site" id="falamat_site"><?= $this->input->post('falamat_site'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('falamat_site') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fpic_site">Nama Penanggung Jawab</label>
                                <input type="text" class="form-control <?= form_error('fpic_site') ? 'is-invalid' : '' ?>" id="fpic_site" name="fpic_site" placeholder="Nama penanggung jawab" value="<?= $this->input->post('fpic_site'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fpic_site') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="ftelepon_pic_site">Telepon Penanggung Jawab</label>
                                <input type="text" class="form-control <?= form_error('ftelepon_pic_site') ? 'is-invalid' : '' ?>" id="ftelepon_pic_site" name="ftelepon_pic_site" placeholder="Nomor telepon penanggung jawab" value="<?= $this->input->post('ftelepon_pic_site'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ftelepon_pic_site') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fnote">Catatan</label>
                                <textarea name="fnote" class="form-control <?= form_error('fnote') ? 'is-invalid' : '' ?> " placeholder="Catatan SPK" id="fnote"><?= $this->input->post('fnote'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('fnote') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Simpan </button>

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

<!-- modal tipe barang -->
<div class="modal fade" id="modal_tipe_barang">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-bold">PILIH PROJECT</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_tipe_barang">
                <div class="card-body table-responsive-sm">
                    <table id="tableOnModal" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NO SPK/PO</th>
                                <th>PROJECT</th>
                                <th>OWNER</th>
                                <th>PROJECT MANAGER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($project as $key) : ?>
                                <tr class="text-uppercase">
                                    <td style="width: 5px;"><button class="btn btn-primary btn-sm" id="select" data-id="<?= $key->project_id ?>" data-nama="<?= $key->nama_project ?>">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>
                                    <td>
                                        <?= $key->nomor_spk ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_project) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->project_owner) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_user) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Mutasi-->
<div class="modal fade" id="modal_mutasi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="bodymodal_mutasi">

        </div>
    </div>
</div>
<!-- Delete Confirm -->
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function onFocus() {
        $('#modal_tipe_barang').modal('show')
    }
    $(document).on('click', '#select', function() {
        var id = $(this).data('id');
        var namaProject = $(this).data('nama');
        $('#fid_project').val(id)
        $('#fnama_project').val(namaProject.toUpperCase())
        $('#modal_tipe_barang').modal('hide')
    })
    var tanpa_rupiah = document.getElementById('fharga_barang');
    tanpa_rupiah.addEventListener('keyup', function(e) {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function showMutasi(noregis) {
        $.ajax({
            type: "get",
            url: "<?= site_url('inventory/show_mutasi/'); ?>" + noregis,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_mutasi').empty();
                $('#bodymodal_mutasi').append(response);
            }
        });
    }
</script>