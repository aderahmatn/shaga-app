<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('Users_m');

	}

	public function index()
	{
		$data['isdefault'] = $this->Users_m->password_is_default($this->session->userdata('id_user'));
		$this->template->load('shared/index', 'dashboard', $data);
	}
}