<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    function __construct()
    {

        parent::__construct();         
    }

    public function index()
    {
		$data = array();
        $data['heading_messgae'] = 'Dashboard'; 
		$data['title'] = 'Dashboard';
        $data['second_title'] = 'Home';			
        $data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
        $data['maincontent'] = $this->load->view('dashboard/index', $data, true);
        $this->load->view('admin_logins/index', $data);
    }
}
