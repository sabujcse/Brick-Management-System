<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sardars extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Admin_login', 'Sardar'));
	}

	public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('sardars/index/');
		$config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Sardar->get_sardar(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['sardars'] = $this->Sardar->get_sardar(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Sardars Information';
		$data['title'] = 'Sardars';
		$data['second_title'] = 'Sardars List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('sardars/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$data = array();
			$data['name'] = $this->input->post('name', TRUE);
			$data['sardar_id'] = $this->input->post('sardar_id', TRUE);
			$data['sardar_type'] = $this->input->post('sardar_type', TRUE);
			$data['gender'] = $this->input->post('gender', TRUE);
			$data['address'] = $this->input->post('address', TRUE);
			$data['mobile'] = $this->input->post('mobile', TRUE);
			$this->Sardar->add_sardar($data);
			$sdata['message'] = "Sardars Info. Successfully Added";
			$this->session->set_userdata($sdata);
			redirect("sardars/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Sardar';
		$data['title'] = 'Sardars';
		$data['second_title'] = 'Sardars Add';
		$data['genders'] = $this->Admin_login->get_all_gender();
		$data['sardar_types'] = $this->Admin_login->get_all_tbl_sardar_type();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('sardars/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['name'] = $this->input->post('name', TRUE);
			$data['sardar_id'] = $this->input->post('sardar_id', TRUE);
			$data['sardar_type'] = $this->input->post('sardar_type', TRUE);
			$data['gender'] = $this->input->post('gender', TRUE);
			$data['address'] = $this->input->post('address', TRUE);
			$data['mobile'] = $this->input->post('mobile', TRUE);
			$this->Sardar->sardar_update($data);
			$sdata['message'] = "You are Successfully Sardars Info. Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("sardars/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Sardar Info.';
		$data['title'] = 'Sardars';
		$data['second_title'] = 'Update';
		$data['genders'] = $this->Admin_login->get_all_gender();
		$data['sardar_types'] = $this->Admin_login->get_all_tbl_sardar_type();
		$data['sardar_info'] = $this->Sardar->get_sardar_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('sardars/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function delete($id)
	{
		$this->Sardar->delete_sardar_by_id($id);
		$sdata['message'] = "Sardar Info. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('sardars/index');
	}

}
