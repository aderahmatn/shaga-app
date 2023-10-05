<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Users_m', 'Payroll_m', 'Kasbon_m']);
        $this->load->helper('rupiah');
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
    }


    public function payslip_pdf($id_user, $bln, $thn)
    {
        check_role_administrator();
        $data['selectedUser'] = $this->Users_m->get_by_id_user(decrypt_url($id_user));
        if ($data['selectedUser']) {
            $data['bulan'] = $bln;
            $data['tahun'] = $thn;
            $data['benefit'] = $this->Payroll_m->get_benefit_by_id_user(decrypt_url($id_user));
            $data['kasbon'] = $this->Kasbon_m->get_kasbon_gaji_by_bulan_by_user($bln, $thn, decrypt_url($id_user));
            $data['total_benefit'] = $this->Payroll_m->get_total_benefit_by_id_user(decrypt_url($id_user));
            $data['total_kasbon'] = $this->Kasbon_m->get_total_kasbon_gaji_by_bulan_by_user($bln, $thn, decrypt_url($id_user));
            $this->load->view('payroll/payslip_pdf', $data);
        } else {
            redirect('payroll/payslip', 'refresh');
        }
    }
}

/* End of file Pdf.php */
