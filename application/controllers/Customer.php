<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function browse()
    {
        $this->template->load('shared/index', 'customer/index');

    }
    public function create()
    {
        $this->template->load('shared/index', 'customer/create');

    }

}

/* End of file Customer.php */