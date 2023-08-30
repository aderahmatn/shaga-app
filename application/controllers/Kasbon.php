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
        $this->load->model('Pencairan_kasbon_m');
        $this->load->model('Kategori_keuangan_m');
        $this->load->helper('rupiah');
        $this->load->helper('status_kasbon');
        $this->load->model('Users_m');
        $this->load->model('Kategori_keuangan_m');
        $this->load->helper('telegram');



    }

    public function index($bln = null)
    {

        if ($bln == null) {
            $data['bulan'] = date('m');
            $data['karyawan'] = $this->Users_m->get_all_users();
            $data['kategori'] = $this->Kategori_keuangan_m->get_all_kategori_keuangan();
            $data['total'] = $this->Kasbon_m->get_total_pengajuan_keuangan($data['bulan']);
            $data['approved'] = $this->Kasbon_m->get_total_by_status($data['bulan'], 'approved');
            $data['rejected'] = $this->Kasbon_m->get_total_by_status($data['bulan'], 'rejected');
            $data['closed'] = $this->Kasbon_m->get_total_by_status($data['bulan'], 'closed');
            $data['kasbon'] = $this->Kasbon_m->get_all_kasbon($data['bulan']);
            $this->template->load('shared/index', 'kasbon/index', $data);
        } else {
            $data['bulan'] = $bln;
            $data['karyawan'] = $this->Users_m->get_all_users();
            $data['kategori'] = $this->Kategori_keuangan_m->get_all_kategori_keuangan();
            $data['rejected'] = $this->Kasbon_m->get_total_by_status($data['bulan'], 'rejected');
            $data['approved'] = $this->Kasbon_m->get_total_by_status($data['bulan'], 'approved');
            $data['closed'] = $this->Kasbon_m->get_total_by_status($data['bulan'], 'closed');
            $data['total'] = $this->Kasbon_m->get_total_pengajuan_keuangan($data['bulan']);
            $data['kasbon'] = $this->Kasbon_m->get_all_kasbon($data['bulan']);
            $this->template->load('shared/index', 'kasbon/index', $data);
        }
    }
    function get_default_nominal($id)
    {
        $nominal = $this->Kategori_keuangan_m->get_default_nominal($id);
        echo $nominal;
    }
    public function filter($karyawan = null, $tgl_awal = null, $tgl_akhir = null, $kategori = null)
    {

        check_role_administrator();
        $data['bulan'] = date('m');
        $data['karyawan'] = $this->Users_m->get_all_users();
        $data['kategori'] = $this->Kategori_keuangan_m->get_all_kategori_keuangan();
        $data['total'] = $this->Kasbon_m->get_total_pengajuan_keuangan_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori);
        $data['approved'] = $this->Kasbon_m->get_total_by_status_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori, 'approved');
        $data['rejected'] = $this->Kasbon_m->get_total_by_status_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori, 'rejected');
        $data['closed'] = $this->Kasbon_m->get_total_by_status_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori, 'closed');
        $data['kasbon'] = $this->Kasbon_m->get_all_kasbon_by_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori);
        $this->template->load('shared/index', 'kasbon/index', $data);

    }
    public function create()
    {
        $kasbon = $this->Kasbon_m;
        $kategori = $this->Kategori_keuangan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kasbon->rules());
        if ($validation->run() == FALSE) {
            $data['no_urut'] = $kasbon->get_no_urut_kasbon();
            $data['kategori_keuangan'] = $kategori->get_all_kategori_keuangan();
            $this->template->load('shared/index', 'kasbon/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kasbon->add_kasbon($post);
            $this->Status_kasbon_m->add_status_created_kasbon($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data pencairan berhasil disimpan!');
                redirect('kasbon', 'refresh');
            }
        }
    }
    public function kategori_keuangan()
    {
        check_role_administrator();
        $kasbon = $this->Kategori_keuangan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kasbon->rules_kategori_keuangan());
        if ($validation->run() == FALSE) {
            $data['kategori'] = $kasbon->get_all_kategori_keuangan();
            $this->template->load('shared/index', 'kasbon/kategori_keuangan', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kasbon->add_kategori_keuangan($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kategori berhasil disimpan!');
                redirect('kasbon/kategori_keuangan', 'refresh');
            }
        }
    }
    function process_pencairan()
    {
        // HANYA ADMIN
        check_role_administrator();
        $post = $this->input->post(null, TRUE);
        $filename = date('d/m/Y') . '-' . decrypt_url($post['fid_kasbon']);
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/kasbon';
        $config['allowed_types'] = 'png|jpg|pdf|jpeg';
        $config['file_name'] = $filename;
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('fbukti_pencairan')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $pencairan = $this->Pencairan_kasbon_m;
            $validation = $this->form_validation;
            $validation->set_rules($pencairan->rules());
            if ($validation->run() == FALSE) {
                $this->session->set_flashdata('error', form_error('ftgl_pencairan'));
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $pencairan->add_pencairan_kasbon($file);
                if ($this->db->affected_rows() > 0) {
                    $this->Status_kasbon_m->add_status_closed_kasbon($post);
                    telegram_notif_status_kasbon($post, 'cair', 'Pengajuan Keuangan Telah Selesai');
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data kasbon berhasil diselesaikan!');
                        redirect($_SERVER['HTTP_REFERER']);

                    }
                }
            }

        }


    }
    function process_approve()
    {
        // HANYA ADMIN
        check_role_administrator();
        $post = $this->input->post(null, TRUE);
        $this->Status_kasbon_m->add_status_approve_kasbon($post);
        if ($this->db->affected_rows() > 0) {
            telegram_notif_status_kasbon($post, 'approved', 'Pengajuan Keuangan Telah disetujui');
            $this->session->set_flashdata('success', 'Data pengajuan berhasil disetujui!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    function process_reject()
    {
        // HANYA ADMIN
        check_role_administrator();
        $post = $this->input->post(null, TRUE);
        $this->Status_kasbon_m->add_status_reject_kasbon($post);
        if ($this->db->affected_rows() > 0) {
            telegram_notif_status_kasbon($post, 'rejected', 'Pengajuan Keuangan Telah ditolak');
            $this->session->set_flashdata('success', 'Data kasbon berhasil ditolak!');
            redirect($_SERVER['HTTP_REFERER']);
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
                <strong>Kategori</strong>
                <p class="mb-0">
                    <?= $data->kategori_keuangan ?>
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
    public function delete_kategori_keuangan($id)
    {
        check_role_administrator();
        $this->Kategori_keuangan_m->delete_kategori_keuangan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kategori keuangan berhasil dihapus!');
            redirect('kasbon/kategori_keuangan', 'refresh');
        }
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
                        class="<?= $key->status_kasbon == 'created' ? 'table-warning' : '' ?><?= $key->status_kasbon == 'approved' ? 'table-success' : '' ?><?= $key->status_kasbon == 'rejected' ? 'table-danger' : '' ?><?= $key->status_kasbon == 'closed' ? 'table-info' : '' ?>">
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
        <?php if (cek_status_terakhir_kasbon($key->no_dokumen) == 'closed') { ?>
            <a href="<?= base_url('/uploads/kasbon/') . $key->bukti_pencairan ?>" class="mt-2" target="_blank">[Bukti Pencairan]</a>
        <?php } ?>
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
        check_role_administrator();
        $data = $this->Kasbon_m->get_by_id_kasbon($id);
        ?>
        <form role="form" method="POST" action="<?= base_url('kasbon/process_approve') ?>" autocomplete="off">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <input type="hidden" name="fid_user" value="<?= encrypt_url($this->session->userdata('id_user')) ?>"
                style="display: none">
            <input type="hidden" name="fid_kasbon" value="<?= encrypt_url($data->id_kasbon) ?>" style="display: none">
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
        check_role_administrator();
        $data = $this->Kasbon_m->get_by_id_kasbon($id);
        ?>
        <form role="form" method="POST" action="<?= base_url('kasbon/process_reject') ?>" autocomplete="off">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <input type="hidden" name="fid_user" value="<?= encrypt_url($this->session->userdata('id_user')) ?>"
                style="display: none">
            <input type="hidden" name="fid_kasbon" value="<?= encrypt_url($data->id_kasbon) ?>" style="display: none">
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
    function pencairan($id)
    {
        // HANYA ADMIN
        check_role_administrator();
        $data = $this->Kasbon_m->get_by_id_kasbon($id);
        ?>
        <form role="form" method="POST" action="<?= base_url('kasbon/process_pencairan') ?>" autocomplete="off"
            enctype="multipart/form-data">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <input type="hidden" name="fid_user" value="<?= encrypt_url($this->session->userdata('id_user')) ?>"
                style="display: none">
            <input type="hidden" name="fid_kasbon" value="<?= encrypt_url($data->id_kasbon) ?>" style="display: none">
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
                        <label class="control-label" for="ftgl_pencairan">Tanggal pencairan</label>
                        <input type="date" class="form-control <?= form_error('ftgl_pencairan') ? 'is-invalid' : '' ?>"
                            id="ftgl_pencairan" name="ftgl_pencairan" placeholder="Tanggal pencairan">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label" for="fnominal">Nominal</label>
                        <input type="text" class="form-control <?= form_error('fnominal') ? 'is-invalid' : '' ?>" id="fnominal"
                            name="fnominal" value="<?= rupiah($data->nominal) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="control-label" for="ftgl_approve">Jenis pencairan</label>
                        <input type="text" class="form-control <?= form_error('ftgl_approve') ? 'is-invalid' : '' ?>"
                            id="ftgl_approve" name="ftgl_approve" value="<?= strtoupper($data->cara_bayar) ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label class="control-label" for="fname_user">Pencairan oleh</label>
                <input type="text" class="form-control <?= form_error('fname_user') ? 'is-invalid' : '' ?>" id="fname_user"
                    name="fname_user" value="<?= strtoupper($this->session->userdata('nama_user')) ?>" readonly>
            </div>
            <div class="form-group required">
                <label class="control-label" for="fbukti_pencairan">Bukti pencairan</label>
                <input type="file" class="pb-4 form-control <?= form_error('fbukti_pencairan') ? 'is-invalid' : '' ?>"
                    id="fbukti_pencairan" name="fbukti_pencairan">
                <small id="fbukti_pencairan" class="form-text text-muted">Format file harus .pdf .png .jpg .jpeg, ukuran
                    maksimal 2Mb </small>
            </div>
            <div class="form-group ">
                <label for="fnote">Catatan</label>
                <textarea name="fnote" class="form-control <?= form_error('fnote') ? 'is-invalid' : '' ?> text-uppercase"
                    id="fnote"><?= $this->input->post('fnote'); ?></textarea>
                <div class="invalid-feedback">
                    <?= form_error('fnote') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-success float-right mt-2">SIMPAN</button>
            <a href="<?= base_url('kasbon') ?>" class="btn btn-primary">TUTUP</a>
        </form>
        <?php

    }

}

/* End of file Kasbon.php */