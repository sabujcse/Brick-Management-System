<?php

class Expense_category  extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_expense_info(){
        return $this->db->get('tbl_ba_expense_category')->result_array();
    }
    
    public function add_expense_info($data){
        return $this->db->insert('tbl_ba_expense_category', $data);
    }
    public function expense_information_update($data){
         $this->db->where('id', $data['id']);
        $this->db->update('tbl_ba_expense_category', $data);
    }
    public function get_expense_info_by_id($id)
    {
        return $this->db->where('id', $id)->get('tbl_ba_expense_category')->result_array();
    }
    public function delete_expense_info_by_id($id){
        return $this->db->delete('tbl_ba_expense_category', array('id' => $id));
    }
}
