<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Sardar_types  extends MY_Controller{
    
   function __construct()
	{
		parent::__construct();
                
		$this->load->model(array('Admin_login', 'Sardar_type'));
	}

	public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$data['heading_messgae'] = 'Sardar Types';
		$data['title'] = 'Sardar Types';
		$data['second_title'] = 'Sardar List';
		$data['sardar_types'] = $this->Sardar_type->get_sardar_types();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('sardar_types/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function add()
	{
		if ($_POST) {
			$data = array();
			$data['name'] = $this->input->post('name', TRUE);
                        if(empty( $this->Sardar_type->sardar_type_name($data['name']))){
                           $this->Sardar_type->add_sardar_type($data);
			   $sdata['message'] = "You are Successfully Sardar Type Added!";
			   $this->session->set_userdata($sdata);
			   redirect("sardar_types/add");
                        } else{
                           
			   $sdata['exception'] = "Sardar Type Already Exist!";
			   $this->session->set_userdata($sdata);
			   redirect("sardar_types/add");
                        } 
			
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Sardar Type';
		$data['title'] = 'Sardar Types';
		$data['second_title'] = 'Types Add';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('sardar_types/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['name'] = $this->input->post('name', TRUE);
                        if(empty($this->Sardar_type->sardar_type_check($data['name']))){
                  
			$this->Sardar_type->sardar_type_update($data);
			$sdata['message'] = "You are Successfully Sardar Type Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("sardar_types/index");
                        }
                        else{
                            $sdata["exception"] = "Sardar Type Already Exist!";
                            $this->session->set_userdata($sdata);
			    redirect("sardar_types/index");
                        }
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Sardar Type';
		$data['title'] = 'Sardar Type';
		$data['second_title'] = 'Sardar Type Update';
		$data['type_info'] = $this->Sardar_type->get_sardar_type_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('sardar_types/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function delete($id)
	{
		$this->Sardar_type->delete_sardar_types_by_id($id);
		$sdata['message'] = "Sardar Type Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('sardar_types/index');
        }
    
}
