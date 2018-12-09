<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advance_payments extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_login', 'Advance_payment','Sardar'));
    }

    public function index() {
        
        //$this->is_add_back_btn_show = 1 (Add New btn create)
        //$this->is_add_back_btn_show = 2 (Back to list btn create)
        $this->is_add_back_btn_show = 1;
        $data = array();
        $cond = array();
        $this->load->library('pagination');
        $config['base_url'] = site_url('advance_payment/index/');
        $config['per_page'] = ROW_PER_PAGE;
        $config['total_rows'] = count($this->Advance_payment->get_advanced_payment(0, 0, $cond));
        $this->pagination->initialize($config);
        $data['counter'] = (int)$this->uri->segment(3);
        $data['advance_payments'] = $this->Advance_payment->get_advanced_payment(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
        $data['heading_messgae'] = 'Advanced Payment';
        $data['title'] = 'Advanced Payment';
        $data['second_title'] = 'Payment List';
        $data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
        $data['maincontent'] = $this->load->view('advance_payment/index', $data, true);
        $this->load->view('admin_logins/index', $data);
      
    }

    public function add() {
        if ($_POST) {
            $advance_category_info =  $this->db->query("SELECT * FROM tbl_ba_expense_category WHERE is_advance_category = '1'")->result_array();
        	if(empty($advance_category_info)){
				$sdata['exception'] = "Please add first advance type expense category.";
				$this->session->set_userdata($sdata);
				redirect("advance_payments/add");
			}
            
            $data = array();
            $data['sardar_id'] = $this->input->post('sardar_id', TRUE);
            $data['date'] = $this->input->post('date', TRUE);
            $data['amount'] = $this->input->post('amount', TRUE);
            $data['remarks'] = $this->input->post('remarks', TRUE);
            $total_auto_expense_info =  count($this->db->query("SELECT * FROM tbl_ba_expense WHERE is_auto_created_expense = '1'")->result_array());
            $expense_voucher_id = 'AP.AEV.00'.($total_auto_expense_info + 1);
            $data['expense_voucher_id'] = $expense_voucher_id;
            if($this->Advance_payment->add_advanced_payment($data)){
                $edata = array();
                $edata['purchase_id'] = $this->db->insert_id();
                $edata['expense_total_amount'] = $this->input->post('amount', TRUE);
                $edata['date'] = $this->input->post('date', TRUE);
                $edata['expense_voucher_id'] = $expense_voucher_id;
                $edata['add_time'] = date("Y-m-d H:i:s");
                $edata['is_auto_created_expense'] = 1; 
                
                if ($this->db->insert('tbl_ba_expense', $edata)) {
	                $data = array();
                    $data['expense_id'] =  $this->db->insert_id();
                    $data['expense_category_id'] = $advance_category_info[0]['id'];
                    $data['expense_description'] = $advance_category_info[0]['name'];
                    $data['deposit_method_id'] = 1;              
                    $data['date'] =  date("Y-m-d H:i:s");
                    $data['expense_voucher_id'] =  $expense_voucher_id;
                    $data['amount'] = $this->input->post('amount', TRUE);
                    $this->db->insert('tbl_ba_expense_details', $data);
	            }
            }
            
            
            $sdata['message'] = "Payement Successfully Added ! ";
            $this->session->set_userdata($sdata);
            redirect("advance_payments/add");
        }
        $this->is_add_back_btn_show = 2;
        $data = array();
        $data['action'] = 'add';
        $data['heading_messgae'] = 'Add New Advance Payment';
        $data['title'] = 'Advance Payment';
        $data['second_title'] = 'Advance Payment Add';
        $cond = array();
        $data['sardars'] = $this->Sardar->get_sardar(0, 0, $cond);
        $data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
        $data['maincontent'] = $this->load->view('advance_payment/add_edit_form', $data, true);
        $this->load->view('admin_logins/index', $data);
    }

    public function edit($id = null) {
        if ($_POST) {
            $data = array();
            $expense_voucher_id =  $this->input->post('expense_voucher_id', TRUE);
            $data['id'] = $this->input->post('id', TRUE);
            $data['sardar_id'] = $this->input->post('sardar_id', TRUE);
            $data['date'] = $this->input->post('date', TRUE);
            $data['amount'] = $this->input->post('amount', TRUE);
            $data['remarks'] = $this->input->post('remarks', TRUE);
            if($this->Advance_payment->advance_payment_update($data)){
                $edata = array();
                $edata['expense_total_amount'] = $this->input->post('amount', TRUE);
                $edata['date'] = $this->input->post('date', TRUE);
                $edata['expense_voucher_id'] = $expense_voucher_id;
                $edata['add_time'] = date("Y-m-d H:i:s");
                $edata['is_auto_created_expense'] = 1; 
                $this->db->where('expense_voucher_id', $edata['expense_voucher_id']);
                $this->db->update('tbl_ba_expense', $edata);
                
                $data = array();
                $data['expense_voucher_id'] =  $expense_voucher_id;
                $data['amount'] = $this->input->post('amount', TRUE);
                $this->db->where('expense_voucher_id', $data['expense_voucher_id']);
                $this->db->update('tbl_ba_expense_details', $data);
                
                $sdata['message'] = "You are Successfully Advance Payment Updated ! ";
                $this->session->set_userdata($sdata);
                redirect("advance_payments/index");
            }else{
                $sdata['exception'] = "Advance Payment Updated failed! ";
                $this->session->set_userdata($sdata);
                redirect("advance_payments/index");
            }
        }
        $data = array();
        $this->is_add_back_btn_show = 2;
        $data['action'] = 'edit';
        $data['heading_messgae'] = 'Update Advance Payment';
        $data['title'] = 'Advance Payment';
        $data['second_title'] = 'Advance Payment Update';
        $data['payment_info'] = $this->Advance_payment->get_advance_payment_info_by_id($id);
        $cond = array();
         $data['sardars'] = $this->Sardar->get_sardar(0, 0, $cond);
        $data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
        $data['maincontent'] = $this->load->view('advance_payment/add_edit_form', $data, true);
        $this->load->view('admin_logins/index', $data);
    }

    public function delete($id) {
        $this->Advance_payment->delete_advance_payment_by_id($id);
        $sdata['message'] = "Advance Payment Deleted Successfully.";
        $this->session->set_userdata($sdata);
        redirect('advance_payments/index');
    }

}
