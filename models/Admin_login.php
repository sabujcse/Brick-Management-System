<?php

class Admin_login extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
     public function get_unit_info_by_id($id)
    {
        return $this->db->where('id', $id)->get('tbl_unit')->result_array();
    }

	public function get_all_gender(){
		return $this->db->get('tbl_gender')->result_array();
	}
	
	public function get_all_tbl_sardar_type(){
		return $this->db->get('tbl_sardar_type')->result_array();
	}


	public function get_all_vendor_type(){
		return $this->db->get('tbl_vendor_type')->result_array();
	}
	
	public function get_all_product_type(){
		return $this->db->get('tbl_product_type')->result_array();
	}
	
	public function get_all_unit(){
		return $this->db->get('tbl_unit')->result_array();
	}
	
	public function get_all_tbl_machine_type(){
        return $this->db->get('tbl_machine')->result_array();
    }
	
	public function get_login_user_id(){
		$user_info = $this->session->userdata('user_info');
        //echo '<pre>'; print_r($user_info); die();
		return $user_info[0]->id;
	}
	
	

}
