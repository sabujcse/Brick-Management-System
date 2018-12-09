<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Machine_types extends MY_Controller {
      
     function __construct()
	{
		parent::__construct();
                
		$this->load->model(array('Admin_login', 'Machine_type'));
	}

	public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$data['heading_messgae'] = 'Machine Types';
		$data['title'] = 'Machine Types';
		$data['second_title'] = 'Machine List';
		$data['machine_types'] = $this->Machine_type->get_machine_types();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('machine_types/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function add()
	{
		if ($_POST) {
			$data = array();
			$data['name'] = $this->input->post('name', TRUE);
                        if(empty( $this->Machine_type->machine_type_name($data['name']))){
                           $this->Machine_type->add_machine_type($data);
			   $sdata['message'] = "You are Successfully Machine Type Added!";
			   $this->session->set_userdata($sdata);
			   redirect("machine_types/add");
                        } else{
                           
			   $sdata['exception'] = "Machine Type Already Exist!";
			   $this->session->set_userdata($sdata);
			   redirect("machine_types/add");
                        } 
			
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Machine Type';
		$data['title'] = 'Machine Types';
		$data['second_title'] = 'Types Add';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('machine_types/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['name'] = $this->input->post('name', TRUE);
                        if(empty($this->Machine_type->machine_type_check($data['name']))){
			$this->Machine_type->machine_type_update($data);
			$sdata['message'] = "You are Successfully Machine Type Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("machine_types/index");
                        }
                        else{
                            $sdata["exception"] = "Machine Type Already Exist!";
                            $this->session->set_userdata($sdata);
			    redirect("machine_types/index");
                        }
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Machine Type';
		$data['title'] = 'Machine Type';
		$data['second_title'] = 'Machine Type Update';
		$data['type_info'] = $this->Machine_type->get_machine_type_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('machine_types/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function delete($id)
	{
		$this->Machine_type->delete_machine_types_by_id($id);
		$sdata['message'] = "Machine Type Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('machine_types/index');
        }
}
