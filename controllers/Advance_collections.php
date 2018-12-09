<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Advance_collections extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_login','Advance_collection','Customer'));
    }
    public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('advance_collections/index/');
	        $config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Advance_collection->get_advance_collection(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['advance_collections'] = $this->Advance_collection->get_advance_collection(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
                $data['heading_messgae'] = 'Advance Callection Information';
		$data['title'] = 'Advance Callection';
		$data['second_title'] = 'Advance Callection List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('advance_collections/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {
			$data = array();
			$data['customer_id'] = $this->input->post('customer_id', TRUE);
			$data['date'] = $this->input->post('date', TRUE);
			$data['amount'] = $this->input->post('amount', TRUE);
			$data['quantity'] = $this->input->post('quantity', TRUE);
			$data['price_per_brick'] = $this->input->post('price_per_brick', TRUE);
			$data['tentavie_delivery_date'] = $this->input->post('tentavie_delivery_date', TRUE);
			$this->Advance_collection->add_collection($data);
			$sdata['message'] = "Advance Callection Info. Successfully Added";
			$this->session->set_userdata($sdata);
			redirect("advance_collections/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add  Advance Callection';
		$data['title'] = 'Advance Callection';
		$data['second_title'] = 'Callection Add';
                //$data[c]
		//$data['genders'] = $this->Admin_login->get_all_gender();
		$data['customers'] = $this->Customer->get_customer_info();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('advance_collections/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
                        $data['id'] = $this->input->post('id',TRUE);
			$data['customer_id'] = $this->input->post('customer_id', TRUE);
			$data['date'] = $this->input->post('date', TRUE);
			$data['amount'] = $this->input->post('amount', TRUE);
			$data['quantity'] = $this->input->post('quantity', TRUE);
			$data['price_per_brick'] = $this->input->post('price_per_brick', TRUE);
			$data['tentavie_delivery_date'] = $this->input->post('tentavie_delivery_date', TRUE);
			$this->Advance_collection->collection_update($data);
			$sdata['message'] = "You are Successfully Advance Callection Info. Updated ! ";
			$this->session->set_userdata($sdata);
			redirect("Advance_collections/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Advance Collection Info.';
		$data['title'] = 'Advance Collection';
		$data['second_title'] = 'Update';
		//$data['customers_name'] = $this->Admin_login->get_all_tbl_customer_name();
                $data['customers'] = $this->Customer->get_customer_info();
		$data['advance_collection_info'] = $this->Advance_collection->get_collection_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('advance_collections/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function delete($id)
	{
		$this->Advance_collection->delete_collection_by_id($id);
		$sdata['message'] = "Advance Collection. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('Advance_collections/index');
	}
    
}
