<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: S. Rahman
 * Date: 11/10/2018
 * Time: 6:26 PM
 */
class Purchases extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Admin_login', 'Purchase','Vendor'));
	}
	
    public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('purchases/index/');
		$config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Purchase->get_all_purchases(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['purchases'] = $this->Purchase->get_all_purchases(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Purchases Information';
		$data['title'] = 'Purchases';
		$data['second_title'] = 'Purchases List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('purchases/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$product_type_id = $this->input->post('product_type_id', TRUE);
			$product_info =  $this->db->query("SELECT * FROM tbl_product_type WHERE id = '$product_type_id'")->result_array();
			if(empty($product_info)){
				$sdata['exception'] = "Please add expense category for this product.";
				$this->session->set_userdata($sdata);
				redirect("purchases/add");
			}
			$data = array();
			$data['product_type_id'] = $this->input->post('product_type_id', TRUE);
			$data['vendor_id'] = $this->input->post('vendor_id', TRUE);
			$data['quantity'] = $this->input->post('quantity', TRUE);
			$data['quantity_unit_id'] = $this->input->post('quantity_unit_id', TRUE);
			$data['price_per_unit'] = $this->input->post('price_per_unit', TRUE);
			$data['total_price'] = $this->input->post('total_price', TRUE);
			$data['paid_amount'] = $this->input->post('paid_amount', TRUE);
			$data['due_amount'] = $this->input->post('due_amount', TRUE);
			$data['buy_date'] = $this->input->post('buy_date', TRUE);
			$data['description'] = $this->input->post('description', TRUE);
			$data['added_by'] = $this->Admin_login->get_login_user_id();
			$data['added_on'] = date("Y-m-d H:i:s");
			$this->Purchase->add_purchase($data);
			if($data['paid_amount'] > 0){
				$total_auto_expense_info =  count($this->db->query("SELECT * FROM tbl_ba_expense WHERE is_auto_created_expense = '1'")->result_array());
				$expense_voucher_id = 'AEV.00'.($total_auto_expense_info + 1);
				$edata = array();
				$edata['purchase_id'] = $this->db->insert_id();
				$edata['expense_total_amount'] = $this->input->post('paid_amount', TRUE);
				$edata['date'] = $this->input->post('buy_date', TRUE);
				$edata['expense_voucher_id'] = $expense_voucher_id;
				$edata['add_time'] = date("Y-m-d H:i:s");
				$edata['is_auto_created_expense'] = 1;
			    if ($this->db->insert('tbl_ba_expense', $edata)) {
				    $data = array();
                    $data['expense_id'] =  $this->db->insert_id();
                    $data['expense_category_id'] = $product_info[0]['auto_expense_id'];
                    $data['expense_description'] = "Buy " . $product_info[0]['name'];
                    $data['deposit_method_id'] = 1;              
                    $data['date'] =  date("Y-m-d H:i:s");
                    $data['expense_voucher_id'] =  $expense_voucher_id;
                    $data['amount'] = $this->input->post('paid_amount', TRUE);
                    $this->db->insert('tbl_ba_expense_details', $data);
			    }
			}
			$sdata['message'] = "Purchase Info. Successfully Added";
			$this->session->set_userdata($sdata);
			redirect("purchases/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Purchase';
		$data['title'] = 'Purchases';
		$data['second_title'] = 'Purchase Add';
		$cond = array();
		$data['vendors'] = $this->Vendor->get_vendors(0, 0, $cond);
		$data['products'] = $this->Admin_login->get_all_product_type();
		$data['units'] = $this->Admin_login->get_all_unit();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('purchases/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	
	public function delete($id)
	{
		$this->Sardar->delete_purchase_by_id($id);
		$sdata['message'] = "Purchase Info. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('purchases/index');
	}

}

