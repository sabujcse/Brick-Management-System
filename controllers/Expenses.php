<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: S. Rahman
 * Date: 11/10/2018
 * Time: 6:26 PM
 */
class Expenses extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Admin_login', 'Expense'));
	}

	public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('expenses/index/');
		$config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Expense->get_all_expenses(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['expenses'] = $this->Expense->get_all_expenses(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Expense Information';
		$data['title'] = 'Expenses';
		$data['second_title'] = 'Expenses List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('expenses/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$mdata = array();
			$mdata['date'] = $this->input->post("date");
			$mdata['expense_voucher_id'] = $this->input->post("expense_voucher_id");
			$mdata['expense_total_amount'] = $this->input->post("expense_total_amount");
			$mdata['add_time'] = date("Y-m-d H:i:s");
			if ($this->db->insert('tbl_ba_expense', $mdata)) {
				$insert_id = $this->db->insert_id();
				$loop_time = $this->input->post("num_of_row");
				$i = 0;
				while ($i < $loop_time) {
					$data = array();
					$data['expense_id'] = $insert_id;
					$data['expense_category_id'] = $this->input->post("expense_category_id_" . $i);
					$data['expense_description'] = $this->input->post("expense_description_" . $i);
					$data['deposit_method_id'] = $this->input->post("deposit_method_id_" . $i);
					$data['date'] = date("Y-m-d H:i:s");
					$data['expense_voucher_id'] = $this->input->post("expense_voucher_id");
					$data['amount'] = $this->input->post("amount_" . $i);
					$this->db->insert('tbl_ba_expense_details', $data);
					$i++;
				}
				$sdata['message'] = "Expense Added Successfully.";
				$this->session->set_userdata($sdata);
				redirect("expenses/add");
			}
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Expense';
		$data['title'] = 'Expenses';
		$data['second_title'] = 'Expense Add';
		$data['expense_category'] = $this->db->query("SELECT * FROM tbl_ba_expense_category")->result_array();
		$data['deposit_method'] = $this->db->query("SELECT * FROM tbl_ba_deposit_method")->result_array();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('expenses/expense_add', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	function get_deposit_method_for_list()
	{
		$income_category = $this->db->query("SELECT * FROM tbl_ba_deposit_method")->result_array();
		echo json_encode($income_category);
	}

	function get_expense_category_for_list()
	{
		$expense_category = $this->db->query("SELECT * FROM tbl_ba_expense_category")->result_array();
		echo json_encode($expense_category);
	}


	public function delete($id)
	{
		$this->Expense->delete_expense_details_by_id($id);
		$this->Expense->delete_expense_by_id($id);
		$sdata['message'] = "Expense Info. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('expenses/index');
	}

}

