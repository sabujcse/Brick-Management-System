<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Brick_categorys extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Admin_login', 'Brick_category'));
	}

	public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
       
		$this->is_add_back_btn_show = 1;
		$data = array();
                $cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('brick_categorys/index/');
	        $config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Brick_category->get_brick_category(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['brick_categorys'] = $this->Brick_category->get_brick_category(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Brick Category';
		$data['title'] = 'Brick Category';
		$data['second_title'] = 'Category List';
		//$data['brick_categorys'] = $this->Brick_category->get_brick_category();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('brick_category/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$data = array();
			$data['name'] = $this->input->post('name', TRUE);
			$data['remarks'] = $this->input->post('remarks', TRUE);
			$this->Brick_category->add_brick_category($data);
			$sdata['message'] = "You are Successfully Category Added ! ";
			$this->session->set_userdata($sdata);
			redirect("brick_categorys/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Brick Category';
		$data['title'] = 'Brick Category';
		$data['second_title'] = 'Category Add';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('brick_category/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['name'] = $this->input->post('name', TRUE);
			$data['remarks'] = $this->input->post('remarks', TRUE);
			$this->Brick_category->brick_category_update($data);
			$sdata['message'] = "You are Successfully Category Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("brick_categorys/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Brick Category';
		$data['title'] = 'Brick Category';
		$data['second_title'] = 'Category Update';
		$data['category_info'] = $this->Brick_category->get_brick_category_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('brick_category/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function delete($id)
	{
		$this->Brick_category->delete_brick_category_by_id($id);
		$sdata['message'] = "Brick Category Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('brick_categorys/index');
	}


}
