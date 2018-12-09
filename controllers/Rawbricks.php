<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: S. Rahman
 * Date: 11/10/2018
 * Time: 6:26 PM
 */
class Rawbricks extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Admin_login', 'Rawbrick','Sardar'));
	}
	
    public function index()
	{
		//$this->is_add_back_btn_show = 1 (Add New btn create)
		//$this->is_add_back_btn_show = 2 (Back to list btn create)
		$this->is_add_back_btn_show = 1;
		$data = array();
		$cond = array();
		$this->load->library('pagination');
		$config['base_url'] = site_url('rawbricks/index/');
		$config['per_page'] = ROW_PER_PAGE;
		$config['total_rows'] = count($this->Rawbrick->get_all_rawbricks(0, 0, $cond));
		$this->pagination->initialize($config);
		$data['counter'] = (int)$this->uri->segment(3);
		$data['rawbricks'] = $this->Rawbrick->get_all_rawbricks(ROW_PER_PAGE, (int)$this->uri->segment(3), $cond);
		$data['heading_messgae'] = 'Raw Bricks Information';
		$data['title'] = 'Raw Bricks';
		$data['second_title'] = 'Raw Bricks List';
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('rawbricks/index', $data, true);
		$this->load->view('admin_logins/index', $data);
	}

	public function add()
	{
		if ($_POST) {	
            $unit_id = $this->input->post('unit_id', TRUE);
			$quantity = $this->input->post('quantity', TRUE);
			$unit_info = $this->Admin_login->get_unit_info_by_id($unit_id);
			$data = array();
			$data['sardar_id'] = $this->input->post('sardar_id', TRUE);
			$data['machine_id'] = $this->input->post('machine_id', TRUE);
			$data['date'] = $this->input->post('date', TRUE);
			$data['deducted_quantity'] = $this->input->post('deducted_quantity', TRUE);
			$data['quantity'] = $quantity;
			$data['unit_id'] = $unit_id;
			$data['number_of_brick'] = ($unit_info[0]['number_of_pice_amount'] * $quantity);
			$data['price_per_unit'] = $this->input->post('price_per_unit', TRUE);
			$data['paidable_amount'] = $this->input->post('paidable_amount', TRUE);
			$data['remarks'] = $this->input->post('remarks', TRUE);
			$data['added_by'] = $this->Admin_login->get_login_user_id();
			$data['added_on'] = date("Y-m-d H:i:s");
			$this->Rawbrick->add_rawbricks($data);			
			$sdata['message'] = "Raw Bricks Info. Successfully Added";
			$this->session->set_userdata($sdata);
			redirect("rawbricks/add");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'add';
		$data['heading_messgae'] = 'Add New Raw Bricks';
		$data['title'] = 'Raw Bricks';
		$data['second_title'] = 'Raw Bricks Add';
		$cond = array();
		$data['sardars'] = $this->Sardar->get_sardar(0, 0, $cond);
        $data['units'] = $this->Admin_login->get_all_unit();	
        $data['machine_list'] = $this->Admin_login->get_all_tbl_machine_type();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('rawbricks/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);
	}
	
	public function edit($id = null)
	{
		if ($_POST) {
			$unit_id = $this->input->post('unit_id', TRUE);
			$quantity = $this->input->post('quantity', TRUE);
			$unit_info = $this->Admin_login->get_unit_info_by_id($unit_id);
			$data = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['sardar_id'] = $this->input->post('sardar_id', TRUE);
			$data['machine_id'] = $this->input->post('machine_id', TRUE);
			$data['date'] = $this->input->post('date', TRUE);
			$data['deducted_quantity'] = $this->input->post('deducted_quantity', TRUE);
			$data['quantity'] = $quantity;
			$data['unit_id'] = $unit_id;
			$data['number_of_brick'] = ($unit_info[0]['number_of_pice_amount'] * $quantity);
			$data['price_per_unit'] = $this->input->post('price_per_unit', TRUE);
			$data['paidable_amount'] = $this->input->post('paidable_amount', TRUE);
			$data['remarks'] = $this->input->post('remarks', TRUE);
			$data['added_by'] = $this->Admin_login->get_login_user_id();
			$data['added_on'] = date("Y-m-d H:i:s");
			$this->Rawbrick->rawbricks_info_update($data);		
			$sdata['message'] = "Raw Bricks Info. Successfully Updated";
			$this->session->set_userdata($sdata);
			redirect("rawbricks/index");
		}
		$this->is_add_back_btn_show = 2;
		$data = array();
		$data['action'] = 'edit';
		$data['heading_messgae'] = 'Update Raw Bricks';
		$data['title'] = 'Raw Bricks';
		$data['second_title'] = 'Raw Bricks Update';
		$cond = array();
		$data['sardars'] = $this->Sardar->get_sardar(0, 0, $cond);
        $data['units'] = $this->Admin_login->get_all_unit();
        $data['rawbricks_info'] = $this->Rawbrick->get_rawbricks_info_by_id($id);	
        $data['machine_list'] = $this->Admin_login->get_all_tbl_machine_type();
		$data['main_menu'] = $this->load->view('admin_logins/main_menu', '', true);
		$data['maincontent'] = $this->load->view('rawbricks/add_edit_form', $data, true);
		$this->load->view('admin_logins/index', $data);		
	}

	
	public function delete($id)
	{
		$this->Rawbrick->delete_rawbricks_by_id($id);
		$sdata['message'] = "Raw Bricks Info. Deleted Successfully.";
		$this->session->set_userdata($sdata);
		redirect('rawbricks/index');
	}

}

