<section class="content-header align-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>List Kasbon</h1>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary " href="<?= base_url('kasbon/create') ?>">Buat Pengajuan</a>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body table-responsive-sm">
                        <table id="tableUSer" class="display nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 15px">NO</th>
                                    <th>NO DOC</th>
                                    <th>NAMA</th>
                                    <th>TGL PENGAJUAN</th>
                                    <th>NOMINAL</th>
                                    <th>KEPERLUAN</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kasbon as $key): ?>
                                    <tr class="text-uppercase">
                                        <td>
                                            <?= $no++ ?>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" onclick="getDetail(<?= $key->id_kasbon ?>)"
                                                href="#modal_Detail">
                                                <?= $key->no_dokumen ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= $key->nama_user ?>
                                        </td>
                                        <td>
                                            <?= TanggalIndo($key->created_date) ?>
                                        </td>

                                        <td>
                                            <?= rupiah($key->nominal) ?>
                                        </td>
                                        <td>
                                            <?= $key->keperluan ?>
                                        </td>
                                        <td>
                                            <?php if ($this->session->userdata('group') == 1) { ?>
                                                <a data-toggle="modal" onclick="approveAct(<?= $key->id_kasbon ?>)"
                                                    href="#modal_Detail"
                                                    class="btn <?= cek_status_kasbon($key->no_dokumen) ? "btn-success" : "btn-secondary disabled" ?> btn-xs ">
                                                    SETUJUI
                                                </a>
                                                <a data-toggle="modal" onclick="rejectAct(<?= $key->id_kasbon ?>)"
                                                    href="#modal_Detail"
                                                    class="btn <?= cek_status_kasbon($key->no_dokumen) ? "btn-danger" : "btn-secondary disabled" ?> btn-xs ">
                                                    TOLAK
                                                </a>
                                                <a data-toggle="modal" onclick="pencairanAct(<?= $key->id_kasbon ?>)"
                                                    href="#modal_Detail"
                                                    class="btn <?= cek_status_terakhir_kasbon($key->no_dokumen) == "approved" ? "btn-primary" : "btn-secondary disabled" ?> btn-xs ">
                                                    PENCAIRAN
                                                </a>
                                            <?php } ?>
                                            <a data-toggle="modal" onclick="showStatus(<?= $key->id_kasbon ?>)"
                                                href="#modal_status" class="btn btn-primary btn-xs">
                                                LIHAT STATUS
                                            </a>
                                            <a href="https://wa.me/6285295644177/?text=PEMBERITAHUAN%20GOA%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0APengajuan%20%3A%20KASBON%0ANo.%20Dokumen%20%3A%20<?= $key->no_dokumen ?>%0ANama%20PIC%20%3A%20<?= strtoupper($key->nama_user) ?>%0ANIK%20%3A%20<?= strtoupper($key->nik) ?>%0A%0AKlik%20link%20dibawah%20ini%20untuk%20melihat%20detail%20%3A%0A<?= base_url('kasbon') ?>"
                                                class="btn btn-xs btn-success" target="_blank"><i
                                                    class="fab fa-whatsapp"></i> KIRIM WA</a>
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
            success: function (response) {
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
            success: function (response) {
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
            success: function (response) {
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
            success: function (response) {
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
            success: function (response) {
                $('#bodymodal_status').empty();
                $('#bodymodal_status').append(response);
            }
        });
    }


</script>