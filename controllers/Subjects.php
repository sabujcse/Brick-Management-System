<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Subjects extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_login','Subject'));
    }
   public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
                $cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('subjects/index/');
	        $config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Subject->get_subject_infos(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['subjects'] = $this->Subject->get_subject_infos(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Subject Information';
		$data['title'] = 'Subject Information';
		$data['second_title'] = 'Subject List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('subjects/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        
       public function add()
	{
		 if ($_POST) {
			$data = array();
                        $data['subject_code'] = $this->input->post('subject_code',TRUE);
                        $data['subject_name'] = $this->input->post('subject_name',TRUE);
			$this->Subject->add_subject_info($data);
			$sdata['message'] = "You are Successfully Subject Information  Added ! ";
			$this->session->set_userdata($sdata);
			redirect("subjects/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Subject Information';
		$data['title'] = 'Subject Information';
		$data['second_title'] = 'Subject Information Add';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('subjects/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
	

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			 $data['subject_code'] = $this->input->post('subject_code',TRUE);
                        $data['subject_name'] = $this->input->post('subject_name',TRUE);
			$this->Subject->subject_information_update($data);
			$sdata['message'] = "You are Successfully Subject Information Updated !";
			$this->session->set_userdata($sdata);
			redirect("subjects/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Subject Information';
		$data['title'] = 'Subject Information';
		$data['second_title'] = 'Information Update';
		$data['subject_info'] = $this->Subject->get_subject_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('subjects/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function delete($id)
	{
               $this->Subject->delete_subject_info_by_id($id);
		$sdata['message'] = "Subject Information  Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('subjects/index');
		 
    
    
   }
}
