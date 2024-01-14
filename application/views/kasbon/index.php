<section class="content-header align-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mt-2">LIST PENGAJUAN KEUANGAN</h1>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('kasbon/create') ?>">BUAT PENGAJUAN</a>
                    <?php if ($this->session->userdata('nama_group') == 'administrator') { ?>
                        <a class="btn btn-md btn-primary mt-2" href="<?= base_url('kasbon/kategori_keuangan') ?>">KATEGORI
                            KEUANGAN</a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group ">
                    <select class="form-control form-control-sm bg-default" id="fbulan" name="fbulan">
                        <option value="01" <?= $bulan == '01' ? 'selected' : '' ?>>JANUARI</option>
                        <option value="02" <?= $bulan == '02' ? 'selected' : '' ?>>FEBRUARI</option>
                        <option value="03" <?= $bulan == '03' ? 'selected' : '' ?>>MARET</option>
                        <option value="04" <?= $bulan == '04' ? 'selected' : '' ?>>APRIL</option>
                        <option value="05" <?= $bulan == '05' ? 'selected' : '' ?>>MEI</option>
                        <option value="06" <?= $bulan == '06' ? 'selected' : '' ?>>JUNI</option>
                        <option value="07" <?= $bulan == '07' ? 'selected' : '' ?>>JULI</option>
                        <option value="08" <?= $bulan == '08' ? 'selected' : '' ?>>AGUSTUS</option>
                        <option value="09" <?= $bulan == '09' ? 'selected' : '' ?>>SEPTEMBER</option>
                        <option value="10" <?= $bulan == '10' ? 'selected' : '' ?>>OKTOBER</option>
                        <option value="11" <?= $bulan == '11' ? 'selected' : '' ?>>NOVEMBER</option>
                        <option value="12" <?= $bulan == '12' ? 'selected' : '' ?>>DESEMBER</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pengajuan
                        </span>
                        <span class="info-box-number">
                            <?= rupiah($total) ?>
                        </span>
                    </div>

                </div>

            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-receipt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pengajuan Selesai</span>
                        <span class="info-box-number">
                            <?= rupiah($closed) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pengajuan Disetujui</span>
                        <span class="info-box-number">
                            <?= rupiah($approved) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-times"></i></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pengajuan Ditolak</span>
                        <span class="info-box-number">
                            <?= rupiah($rejected) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- FILTER DATA -->
        <?php if ($this->session->userdata('group') == 1) { ?>
            <div class="card <?= $this->uri->segment(2) == 'filter' ? '' : 'collapsed-card' ?>">
                <div class="card-header">
                    <h3 class="card-title mt-1">EXPORT DATA</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-<?= $this->uri->segment(2) == 'filter' ? 'minus' : 'plus' ?>"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: <?= $this->uri->segment(2) == 'filter' ? 'block;' : 'none;' ?>">
                    <form role="form" method="POST" action="<?= base_url('kasbon/export') ?>" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="fkaryawan">Karyawan</label>
                                    <select class="form-control form-control-sm bg-default" id="fkaryawan" name="fkaryawan">
                                        <option value="all">SEMUA KARYAWAN</option>
                                        <?php foreach ($karyawan as $key) : ?>
                                            <option value="<?= $key->id_user ?>" <?= $this->uri->segment(3) == $key->id_user ? 'selected' : '' ?>><?= $key->nik . ' - ' . strtoupper($key->nama_user) ?></option>
                                        <?php endforeach ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <?php
                                $is_tgl_awal = $this->uri->segment(2) == 'filter' ? $this->uri->segment(4) : 'null';
                                $day = new DateTime('first day of this month');
                                $first_day = $day->format('Y-m-d');
                                ?>
                                <div class="form-group">
                                    <label for="ftgl_awal">Tanggal Awal</label>
                                    <input type="date" class="form-control form-control-sm bg-default" id="ftgl_awal" name="ftgl_awal" value="<?= strlen($is_tgl_awal) < 10 ? $first_day : $this->uri->segment(4) ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <?php $is_tgl_akhir = $this->uri->segment(2) == 'filter' ? $this->uri->segment(5) : 'null';
                                $day = new DateTime('last day of this month');
                                $last_day = $day->format('Y-m-d'); ?>
                                <div class="form-group">
                                    <label for="ftgl_akhir">Tanggal Akhir</label>
                                    <input type="date" class="form-control form-control-sm bg-default" id="ftgl_akhir" name="ftgl_akhir" value="<?= strlen($is_tgl_akhir) < 10 ? $last_day : $this->uri->segment(5) ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="checks" name="fkategori[]" id="fkategoriAll" alt="Checkbox" value="all" checked>
                                        <label class="mb-0 font-weight-normal" for="fkategoriAll"><?= strtoupper('semua kategori') ?></label>
                                    </div>
                                    <?php foreach ($kategori as $key) : ?>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="checks" name="fkategori[]" id="fkategori<?= strtoupper($key->kategori_keuangan) ?>" alt="Checkbox" value="<?= $key->id_kategori_keuangan ?>">
                                            <label class="mb-0 font-weight-normal" for="fkategori<?= strtoupper($key->kategori_keuangan) ?>"><?= strtoupper($key->kategori_keuangan) ?></label>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status Terakhir</label>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="checks" name="fstatus[]" id="fstatusAll" alt="Checkbox" value="all" checked>
                                        <label class="mb-0 font-weight-normal bg-secondary rounded-pill px-1 text-xs" for="fstatusAll"><?= strtoupper('Semua') ?></label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="checks" name="fstatus[]" id="fstatusCreated" alt="Checkbox" value="created">
                                        <label class="mb-0 font-weight-normal bg-warning rounded-pill px-1 text-xs" for="fstatusCreated"><?= strtoupper('Created') ?></label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="checks" name="fstatus[]" id="fstatusApproved" alt="Checkbox" value="approved">
                                        <label class="mb-0 font-weight-normal bg-success rounded-pill px-1 text-xs" for="fstatusApproved"><?= strtoupper('Approved') ?></label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="checks" name="fstatus[]" id="fstatusRejected" alt="Checkbox" value="rejected">
                                        <label class="mb-0 font-weight-normal bg-danger rounded-pill px-1 text-xs" for="fstatusRejected"><?= strtoupper('Rejected') ?></label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="checks" name="fstatus[]" id="fstatusClosed" alt="Checkbox" value="closed">
                                        <label class="mb-0 font-weight-normal bg-primary rounded-pill px-1 text-xs" for="fstatusClosed"><?= strtoupper('Closed') ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">

                            <button type="submit" class="btn btn-sm bg-primary float-right" id="btnFilter">EXPORT PDF</button>
                        </div>
                    </form>
                </div>
            </div>

    </div>
    <!-- FILTER DATA -->
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <!-- card-body -->
            <div class="card-body table-responsive-sm">
                <div class="row mb-3">
                    <div class="col-md-3" id="status"></div>
                    <div class="col-md-3" id="karyawan"></div>
                    <div class="col-md-3" id="kategori"></div>
                </div>
                <table id="tableKeuangan" class="display nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>STATUS</th>
                            <th>NAMA</th>
                            <th>KATEGORI</th>
                            <th>NOMINAL</th>
                            <th>TGL PENGAJUAN</th>
                            <th>NO DOC</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($kasbon as $key) : ?>
                            <tr class="text-uppercase">
                                <td>
                                    <?= $key->id_kasbon ?>
                                </td>
                                <td class="<?= $key->status_terakhir == 'approved' ? 'bg-success' : '' ?>
                                            <?= $key->status_terakhir == 'created' ? 'bg-warning' : '' ?>
                                            <?= $key->status_terakhir == 'rejected' ? 'bg-danger' : '' ?>
                                            <?= $key->status_terakhir == 'closed' ? 'bg-primary' : '' ?>">
                                    <?= $key->status_terakhir ?>
                                </td>
                                <td>
                                    <?= $key->nama_user ?>
                                </td>
                                <td>
                                    <?= $key->kategori_keuangan ?>
                                </td>
                                <td>
                                    <?= rupiah($key->nominal) ?>
                                </td>
                                <td>
                                    <?= TanggalIndo($key->created_date) ?>
                                </td>
                                <td>
                                    <a data-toggle="modal" onclick="getDetail(<?= $key->id_kasbon ?>)" href="#modal_Detail">
                                        <?= $key->no_dokumen ?>
                                    </a>
                                </td>






                                <td>
                                    <?php if ($this->session->userdata('group') == 1) { ?>
                                        <a data-toggle="modal" onclick="approveAct(<?= $key->id_kasbon ?>)" href="#modal_Detail" class="btn <?= cek_status_kasbon($key->no_dokumen) ? "btn-success" : "btn-secondary disabled" ?> btn-xs ">
                                            SETUJUI
                                        </a>
                                        <a data-toggle="modal" onclick="rejectAct(<?= $key->id_kasbon ?>)" href="#modal_Detail" class="btn <?= cek_status_kasbon($key->no_dokumen) ? "btn-danger" : "btn-secondary disabled" ?> btn-xs ">
                                            TOLAK
                                        </a>
                                        <a data-toggle="modal" onclick="pencairanAct(<?= $key->id_kasbon ?>)" href="#modal_Detail" class="btn <?= cek_status_terakhir_kasbon($key->no_dokumen) == "approved" ? "btn-primary" : "btn-secondary disabled" ?> btn-xs ">
                                            PENCAIRAN
                                        </a>
                                    <?php } ?>
                                    <a data-toggle="modal" onclick="showStatus(<?= $key->id_kasbon ?>)" href="#modal_status" class="btn btn-primary btn-xs">
                                        LIHAT STATUS
                                    </a>
                                    <a href="https://wa.me/6285295644177/?text=PEMBERITAHUAN%20GAS%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0APengajuan%20%3A%20KEUANGAN%0ANo.%20Dokumen%20%3A%20<?= $key->no_dokumen ?>%0ANama%20PIC%20%3A%20<?= strtoupper($key->nama_user) ?>%0ANIK%20%3A%20<?= strtoupper($key->nik) ?>%0A%0AKlik%20link%20dibawah%20ini%20untuk%20melihat%20detail%20%3A%0A<?= base_url('kasbon') ?>" class="btn btn-xs btn-success" target="_blank"><i class="fab fa-whatsapp"></i> KIRIM WA</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
<!-- Modal -->
<div class="modal fade" id="modal_Detail">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body" id="bodymodal_Detail">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_status">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="bodymodal_status">
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

    function getDetail(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kasbon/detail/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function approveAct(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kasbon/approve/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function rejectAct(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kasbon/reject/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function pencairanAct(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kasbon/pencairan/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function showStatus(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kasbon/show_status/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_status').empty();
                $('#bodymodal_status').append(response);
            }
        });
    }

    $("#fbulan").on('change', function() {
        $bln = $("#fbulan").val();
        window.location = "<?= base_url('kasbon/index/') ?>" + $bln;
    })
</script>