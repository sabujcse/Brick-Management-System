<?php

class Machine_type extends CI_Model{
      
    public function __construct() {
        parent::__construct();
    }
    public function get_machine_types(){
        return $this->db->get('tbl_machine')->result_array();
    }
    public function machine_type_name($name){
         return $this->db->where('name', $name)->get('tbl_machine')->result_array(); 
    }
    public function add_machine_type($data){
        return $this->db->insert('tbl_machine', $data);
       
    }
    public function machine_type_check($name){
        return $this->db->where('name', $name)->get('tbl_machine')->result_array(); 
    }
    public function machine_type_update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_machine', $data);
    }
    public function get_machine_type_info_by_id($id){
        return $this->db->where('id', $id)->get('tbl_machine')->result_array();
    }
    public function delete_machine_types_by_id($id){
        return $this->db->delete('tbl_machine', array('id' => $id));
    }
    
}
