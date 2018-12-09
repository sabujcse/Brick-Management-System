<?php

class Teacher extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_teacher_collection($limit, $offset, $value = ''){
         $this->db->select('a.*,c.subject_name as subject_name');
        $this->db->from('tbl_teacher as a');
        $this->db->join('tbl_subject as c', 'c.id = a.subject_id', 'left');
        $this->db->order_by("a.id", "desc");
        if (isset($limit) && $limit > 0)
                $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_teacher($data){
        return $this->db->insert('tbl_teacher', $data);
    }
    public function collection_update($data){
            $this->db->where('id', $data['id']);
            $this->db->update('tbl_teacher', $data);
    }
    public function get_collection_info_by_id($id){
          return $this->db->where('id', $id)->get('tbl_teacher')->result_array();
    
    }
    public function delete_collection_by_id($id){
        return $this->db->delete('tbl_teacher', array('id' => $id));
    }
    
}
