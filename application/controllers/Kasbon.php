<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasbon extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Kasbon_m');
        $this->load->model('Status_kasbon_m');
        $this->load->helper('rupiah');
        $this->load->helper('status_kasbon');

    }

    public function index()
    {
        $data['kasbon'] = $this->Kasbon_m->get_all_kasbon();
        $this->template->load('shared/index', 'kasbon/index', $data);

    }
    public function create()
    {

        $kasbon = $this->Kasbon_m;
        $validation = $this->form_validation;
        $validation->set_rules($kasbon->rules());
        if ($validation->run() == FALSE) {
            $data['no_urut'] = $kasbon->get_no_urut_kasbon();
            $this->template->load('shared/index', 'kasbon/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kasbon->add_kasbon($post);
            $this->Status_kasbon_m->add_status_created_kasbon($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kasbon berhasil diajukan!');
                redirect('kasbon', 'refresh');
            }
        }
    }
    function process_approve()
    {
        // HANYA ADMIN
        $post = $this->input->post(null, TRUE);
        $this->Status_kasbon_m->add_status_approve_kasbon($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kasbon berhasil disetujui!');
            redirect('kasbon', 'refresh');
        }
    }
    function process_reject()
    {
        // HANYA ADMIN
        $post = $this->input->post(null, TRUE);
        $this->Status_kasbon_m->add_status_reject_kasbon($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kasbon berhasil ditolak!');
            redirect('kasbon', 'refresh');
        }
    }
    function detail($id)
    {
        $data = $this->Kasbon_m->get_by_id_kasbon($id);
        ?>
        <ul class="list-group list-group-flush text-uppercase">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>No. Dokumen</strong>
                <p class="mb-0">
                    <?= $data->no_dokumen ?>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Tanggal Pengajuan</strong>
                <p class="mb-0">
                    <?= TanggalIndo($data->created_date) ?>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>NIK</strong>
                <p class="mb-0">
                    <?= $data->nik ?>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Nama Lengkap</strong>
                <p class="mb-0">
                    <?= $data->nama_user ?>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Nominal</strong>
                <p class="mb-0">
                    <?= rupiah($data->nominal) ?>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Keperluan</strong>
                <p class="mb-0">
                    <?= $data->keperluan ?>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Note</strong>
                <p class="mb-0">
                    <?= $data->note ?>
                </p>
            </li>
            <li class="pt-3 px-3 d-flex justify-content-end align-items-center">

                <button class="btn btn-primary" id="closemodal">TUTUP</button>
            </li>
        </ul>
        <script>
            $(document).ready(function () {
                $('#closemodal').click(function () {
                    $('#modal_Detail').modal('hide');
                });
            });

        </script>
        <?php

    }
    function show_status($id)
    {
        $data = $this->Status_kasbon_m->get_all_status_kasbon_by_id($id);
        ?>

        <div class="d-flex align-items-center mb-3">
            <strong>NO DOKUMEN : </strong>
            <p class="mb-0 ml-1">
                <?= $data[0]->no_dokumen ?>
            </p>
        </div>
        <table class="table table-sm mb-3 text-uppercase ">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">STATUS</th>
                    <th scope="col">TGL CLOSED</th>
                    <th scope="col">PIC</th>
                    <th scope="col">NOTE</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key): ?>

                    <tr
                        class="<?= $key->status_kasbon == 'created' ? 'table-primary' : '' ?><?= $key->status_kasbon == 'approved' ? 'table-success' : '' ?><?= $key->status_kasbon == 'rejected' ? 'table-danger' : '' ?>">
                        <th scope="row">
                            <?= $key->status_kasbon ?>
                        </th>
                        <td>
                            <?= TanggalIndo($key->created_date_status) ?>
                        </td>
                        <td>
                            <?= $key->nama_user ?>
                        </td>
                        <td>
                            <?= $key->note_status ?>
                        </td>

                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
        <button class="btn btn-primary float-right" id="closemodal">TUTUP</button>
        <script>
            $(document).ready(function () {
                $('#closemodal').click(function () {
                    $('#modal_status').modal('hide');
                });
            });

        </script>
        <?php
    }
    function approve($id)
    {
        // HANYA ADMIN
        $data = $this->Kasbon_m->get_by_id_kasbon($id);
        ?>
        <form role="form" method="POST" action="<?= base_url('kasbon/process_approve') ?>" autocomplete="off">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <input type="hidden" name="fid_user" value="<?= encrypt_url($this->session->userdata('id_user')) ?>"
                style="display: none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label" for="fno_dokumen">No. Dokumen</label>
                        <input type="text" class="form-control <?= form_error('fno_dokumen') ? 'is-invalid' : '' ?>"
                            id="fno_dokumen" name="fno_dokumen" value="<?= $data->no_dokumen ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label" for="ftgl_approve">Tanggal Disetujui</label>
                        <input type="text" class="form-control <?= form_error('ftgl_approve') ? 'is-invalid' : '' ?>"
                            id="ftgl_approve" name="ftgl_approve" value="<?= date('d/m/Y') ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label class="control-label" for="fname_user">Disetujui Oleh</label>
                <input type="text" class="form-control <?= form_error('fname_user') ? 'is-invalid' : '' ?>" id="fname_user"
                    name="fname_user" value="<?= strtoupper($this->session->userdata('nama_user')) ?>" readonly>
            </div>

            </div>
            <div class="form-group ">
                <label for="fnote">Catatan</label>
                <textarea name="fnote" class="form-control <?= form_error('fnote') ? 'is-invalid' : '' ?> text-uppercase"
                    id="fnote"><?= $this->input->post('fnote'); ?></textarea>
                <div class="invalid-feedback">
                    <?= form_error('fnote') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-success float-right mt-2">SETUJUI</button>
            <a href="<?= base_url('kasbon') ?>" class="btn btn-primary">TUTUP</a>
        </form>
        <?php

    }
    function reject($id)
    {
        // HANYA ADMIN
        $data = $this->Kasbon_m->get_by_id_kasbon($id);
        ?>
        <form role="form" method="POST" action="<?= base_url('kasbon/process_reject') ?>" autocomplete="off">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <input type="hidden" name="fid_user" value="<?= encrypt_url($this->session->userdata('id_user')) ?>"
                style="display: none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label" for="fno_dokumen">No. Dokumen</label>
                        <input type="text" class="form-control <?= form_error('fno_dokumen') ? 'is-invalid' : '' ?>"
                            id="fno_dokumen" name="fno_dokumen" value="<?= $data->no_dokumen ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label" for="ftgl_approve">Tanggal ditolak</label>
                        <input type="text" class="form-control <?= form_error('ftgl_approve') ? 'is-invalid' : '' ?>"
                            id="ftgl_approve" name="ftgl_approve" value="<?= date('d/m/Y') ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label class="control-label" for="fname_user">ditolak Oleh</label>
                <input type="text" class="form-control <?= form_error('fname_user') ? 'is-invalid' : '' ?>" id="fname_user"
                    name="fname_user" value="<?= strtoupper($this->session->userdata('nama_user')) ?>" readonly>
            </div>

            </div>
            <div class="form-group ">
                <label for="fnote">Catatan</label>
                <textarea name="fnote" class="form-control <?= form_error('fnote') ? 'is-invalid' : '' ?> text-uppercase"
                    id="fnote"><?= $this->input->post('fnote'); ?></textarea>
                <div class="invalid-feedback">
                    <?= form_error('fnote') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-danger float-right mt-2">TOLAK</button>
            <a href="<?= base_url('kasbon') ?>" class="btn btn-primary">TUTUP</a>
        </form>
        <?php

    }

}

/* End of file Kasbon.php */