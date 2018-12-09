<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Teachers extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_login','Teacher','Subject'));
    }
    public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('teachers/index/');
	        $config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Teacher->get_teacher_collection(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['teachers'] = $this->Teacher->get_teacher_collection(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
                $data['heading_messgae'] = 'Teacher Information';
		$data['title'] = 'Teacher Information';
		$data['second_title'] = 'Teacher List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('teachers/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$data = array();
			$data['subject_id'] = $this->input->post('subject_id', TRUE);
			$data['teacher_name'] = $this->input->post('teacher_name', TRUE);
			$data['section'] = $this->input->post('section', TRUE);
			$this->Teacher->add_teacher($data);
			$sdata['message'] = "Teacher Info. Successfully Added";
			$this->session->set_userdata($sdata);
			redirect("teachers/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add  Teacher';
		$data['title'] = 'Teacher Information';
		$data['second_title'] = 'Information Add';
                //$data[c]
		//$data['genders'] = $this->Admin_login->get_all_gender();
		$data['subjects'] = $this->Subject->get_subject_info();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('teachers/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
                        $data['id'] = $this->input->post('id',TRUE);
			$data['subject_id'] = $this->input->post('subject_id', TRUE);
			$data['teacher_name'] = $this->input->post('teacher_name', TRUE);
			$data['section'] = $this->input->post('section', TRUE);
			$this->Teacher->collection_update($data);
			$sdata['message'] = "You are Successfully Teacher Info. Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("Teachers/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Teacher Info.';
		$data['title'] = 'Teacher Information';
		$data['second_title'] = 'Update';
		//$data['customers_name'] = $this->Admin_login->get_all_tbl_customer_name();
                $data['subjects'] = $this->Subject->get_subject_info();
                
		$data['teacher_info'] = $this->Teacher->get_collection_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('teachers/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function delete($id)
	{
		$this->Teacher->delete_collection_by_id($id);
		$sdata['message'] = "Teacher Information. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('Teachers/index');
	}
}
