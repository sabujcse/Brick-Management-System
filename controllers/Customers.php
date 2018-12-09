<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Customers extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_login', 'Customer'));
    }
    public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
                $cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('customers/index/');
	        $config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Customer->get_customer_infos(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['customers'] = $this->Customer->get_customer_infos(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Customer Information';
		$data['title'] = 'Customer Information';
		$data['second_title'] = 'Customer List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('customers/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        
       public function add()
	{
		 if ($_POST) {
			$data = array();
                        $data['name'] = $this->input->post('name',TRUE);
                        $data['fathers_name'] = $this->input->post('fathers_name',TRUE);
                        $data['mothers_name'] = $this->input->post('mothers_name',TRUE);
                        $data['nid_number'] = $this->input->post('nid_number',TRUE);
                        $data['mobile_number'] = $this->input->post('mobile_number',TRUE);
                        $data['address'] = $this->input->post('address',TRUE);
                        $data['delivery_address'] = $this->input->post('delivery_address',TRUE);
			$this->Customer->add_customer_info($data);
			$sdata['message'] = "You are Successfully Customer Information  Added ! ";
			$this->session->set_userdata($sdata);
			redirect("customers/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Customer Information';
		$data['title'] = 'Customer Information';
		$data['second_title'] = 'Customer Information Add';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('customers/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
	

	public function edit($id = null)
	{
		if ($_POST) {
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			 $data['name'] = $this->input->post('name',TRUE);
                        $data['fathers_name'] = $this->input->post('fathers_name',TRUE);
                        $data['mothers_name'] = $this->input->post('mothers_name',TRUE);
                        $data['nid_number'] = $this->input->post('nid_number',TRUE);
                        $data['mobile_number'] = $this->input->post('mobile_number',TRUE);
                        $data['address'] = $this->input->post('address',TRUE);
                        $data['delivery_address'] = $this->input->post('delivery_address',TRUE);
			$this->Customer->customer_information_update($data);
			$sdata['message'] = "You are Successfully Customer Information Updated !";
			$this->session->set_userdata($sdata);
			redirect("customers/index");
		}
		$data = array();
		$this->is_add_back_btn_show = 2;
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Cusomer Information';
		$data['title'] = 'Customer Information';
		$data['second_title'] = 'Information Update';
		$data['customer_info'] = $this->Customer->get_customer_info_by_id($id);
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('customers/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
        public function delete($id)
	{
               $this->Customer->delete_customer_info_by_id($id);
		$sdata['message'] = "Customer Information  Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('customers/index');
		
        }
}
