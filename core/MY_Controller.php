<?php

class MY_Controller extends CI_Controller
{
	public $is_add_back_btn_show;
    function __construct()
    {
        parent::__construct(); 
        $this->is_add_back_btn_show = 0;		
		$this->load->library(array('session'));
		date_default_timezone_set("Asia/Dhaka");
		$this->load->helper(array('form', 'url'));
		$this->load->database(); 	
        $this->checkpermission();    	
    }
	
	public function checkpermission()
    {
        $user_info = $this->session->userdata('user_info');
        //echo '<pre>'; print_r($user_info); die();
        if (empty($user_info[0])) {
            $sdata['exception'] = "You are not logged in!";
            $this->session->set_userdata($sdata);
            redirect("login/index");
        }
    }
}

