<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vendors extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Admin_login', 'Vendor'));
	}

	public function index()
	{
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('vendors/index/');
		$config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Vendor->get_vendors(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['vendors'] = $this->Vendor->get_vendors(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Vendors Information';
		$data['title'] = 'Vendors';
		$data['second_title'] = 'Vendor List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('vendors/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$data = array();
			$data['name'] = $this->input->post('name', TRUE);
			$data['vendor_id'] = $this->input->post('vendor_id', TRUE);
			$data['vendor_type_id'] = $this->input->post('vendor_type_id', TRUE);
			$data['address'] = $this->input->post('address', TRUE);
			$data['mobile'] = $this->input->post('mobile', TRUE);
			$this->Vendor->add_vendor($data);
			$sdata['message'] = "Vendor Info. Successfully Added";
			$this->session->set_userdata($sdata);
			redirect("vendors/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Vendor';
		$data['title'] = 'Vendor';
		$data['second_title'] = 'Vendor Add';
		$data['vendor_types'] = $this->Admin_login->get_all_vendor_type();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('vendors/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['name'] = $this->input->post('name', TRUE);
			$data['vendor_id'] = $this->input->post('vendor_id', TRUE);
			$data['vendor_type_id'] = $this->input->post('vendor_type_id', TRUE);
			$data['address'] = $this->input->post('address', TRUE);
			$data['mobile'] = $this->input->post('mobile', TRUE);
			$this->Vendor->vendor_update($data);
			$sdata['message'] = "You are Successfully Vendor Info. Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("vendors/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Vendor Info.';
		$data['title'] = 'Vendors';
		$data['second_title'] = 'Update';
		$data['vendor_types'] = $this->Admin_login->get_all_vendor_type();
		$data['vendor_info'] = $this->Vendor->get_vendor_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('vendors/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function delete($id)
	{
		$this->Vendor->delete_vendor_by_id($id);
		$sdata['message'] = "Vendor Info. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('vendors/index');
	}

}
