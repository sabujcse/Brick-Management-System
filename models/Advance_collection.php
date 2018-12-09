<?php

class Advance_collection extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_advance_collection($limit, $offset, $value = ''){
        $this->db->select('a.*,c.name as customer_name');
        $this->db->from('tbl_advance_collection as a');
        $this->db->join('tbl_customer as c', 'c.id = a.customer_id', 'left');
        $this->db->order_by("a.id", "desc");
        if (isset($limit) && $limit > 0)
                $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function add_collection($data){
        return $this->db->insert('tbl_advance_collection', $data);
    }
    public function collection_update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_advance_collection', $data);
    }
    
    public function get_collection_info_by_id($id){
        
        return $this->db->where('id', $id)->get('tbl_advance_collection')->result_array();
    }
    public function delete_collection_by_id($id){
        //return $this->db->delete('tbl_advance_collection', array('id' => $id));
        return $this->db->delete('tbl_advance_collection', array('id' => $id));
    }
}
