<?php


class Customer extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
     public function get_customer_infos($limit, $offset, $value = ''){
        if (isset($limit) && $limit > 0)
                $this->db->limit($limit, $offset);
        $query = $this->db->get('tbl_customer');
       return $query->result_array();
   }

    public function get_customer_info(){
       return $this->db->get('tbl_customer')->result_array();
    }
    public function add_customer_info($data){
        return $this->db->insert('tbl_customer', $data);
    }
    public function customer_information_update($data){
         $this->db->where('id', $data['id']);
        $this->db->update('tbl_customer', $data);
    }
    public function get_customer_info_by_id($id)
    {
        return $this->db->where('id', $id)->get('tbl_customer')->result_array();
    }
    public function delete_customer_info_by_id($id){
        return $this->db->delete('tbl_customer', array('id' => $id));
    }
}
