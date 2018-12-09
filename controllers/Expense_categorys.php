<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Expense_categorys extends MY_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->model(array('Admin_login', 'Expense_category'));
        
    }
    public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$data['heading_messgae'] = 'Expense Information';
		$data['title'] = 'Expense Information';
		$data['second_title'] = 'Expense List';
		$data['expense_categorys'] = $this->Expense_category->get_expense_info();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('expense_categorys/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        
       public function add()
	{
		 if ($_POST) {
			$data = array();
                        $data['name'] = $this->input->post('name',TRUE);
                        $data['remarks'] = $this->input->post('remarks',TRUE);
			$this->Expense_category->add_expense_info($data);
			$sdata['message'] = "You are Successfully Expense Information  Added ! ";
			$this->session->set_userdata($sdata);
			redirect("expense_categorys/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Expense Information';
		$data['title'] = 'Expense Information';
		$data['second_title'] = 'Expense Information Add';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('expense_categorys/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
	

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			 $data['name'] = $this->input->post('name',TRUE);
                         $data['remarks'] = $this->input->post('remarks',TRUE);
			$this->Expense_category->expense_information_update($data);
			$sdata['message'] = "You are Successfully Expense Information Updated !";
			$this->session->set_userdata($sdata);
			redirect("expense_categorys/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Expense Information';
		$data['title'] = 'Expense Information';
		$data['second_title'] = 'Information Update';
		$data['expense_info'] = $this->Expense_category->get_expense_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('expense_categorys/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function delete($id)
	{
               $this->Expense_category->delete_expense_info_by_id($id);
		$sdata['message'] = "Expense Information  Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('expense_categorys/index');
		
        }
    
}
