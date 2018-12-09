<?php


class Subject extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_subject_infos($limit, $offset, $value = ''){
        if (isset($limit) && $limit > 0)
                $this->db->limit($limit, $offset);
        $query = $this->db->get('tbl_subject');
       return $query->result_array();
   }
     public function get_subject_info(){
       return $this->db->get('tbl_subject')->result_array();
    
    }
   public function add_subject_info($data){
       return $this->db->insert('tbl_subject', $data);
   }
   public function subject_information_update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_subject', $data);
   }
   public function get_subject_info_by_id($id){
        return $this->db->where('id', $id)->get('tbl_subject')->result_array();
   }
   public function delete_subject_info_by_id($id){
       return $this->db->delete('tbl_subject', array('id' => $id));
   }
   
}
