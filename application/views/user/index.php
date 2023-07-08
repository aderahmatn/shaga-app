<section class="content-header align-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>List Pengguna</h1>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary " href="<?= base_url('users/create') ?>">Tambah</a>
                    <a class="btn btn-md btn-primary " href="<?= base_url('group_users') ?>">Group User</a>
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
                                    <th style="width: 15px">No</th>
                                    <th>NIK</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>GROUP</th>
                                    <th>AKTIF</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($users as $key): ?>
                                    <tr class="text-uppercase">
                                        <td>
                                            <?= $no++ ?>
                                        </td>
                                        <td>
                                            <?= $key->nik ?>
                                        </td>
                                        <td>
                                            <?= $key->nama_user ?>
                                        </td>
                                        <td>
                                            <?= $key->email_user ?>
                                        </td>
                                        <td>
                                            <?= $key->phone_user ?>
                                        </td>
                                        <td>
                                            <?= $key->group_user ?>
                                        </td>
                                        <td>

                                            <span
                                                class="badge badge-pill <?= $key->status_user == 1 ? "badge-success" : "badge-danger" ?>"><?= $key->status_user == 1 ? "yes" : "no" ?></span>
                                        </td>
                                        <td>
                                            <a href="#"
                                                onclick="deleteConfirm('<?= base_url() . 'users/delete/' . encrypt_url($key->id_user) ?>')">delete</a>
                                            <!-- |
                                            <a href="">detail</a> -->
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

<!-- Delete Confirm -->
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

</script>