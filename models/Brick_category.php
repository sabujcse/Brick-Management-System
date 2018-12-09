<?php

class Brick_category extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct(); 
    }

    public function get_brick_category($limit, $offset, $value = '')
    {
       // return $this->db->get('tbl_brick_category')->result_array();
        if (isset($limit) && $limit > 0)
                $this->db->limit($limit, $offset);
        $query = $this->db->get('tbl_brick_category');
        return $query->result_array();
    }
	
	public function add_brick_category($data)
    {
        return $this->db->insert('tbl_brick_category', $data);
    }

    public function get_brick_category_info_by_id($id)
    {
        return $this->db->where('id', $id)->get('tbl_brick_category')->result_array();
    }

    public function brick_category_update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_brick_category', $data);
    }
    public function delete_brick_category_by_id($id)
    {
        return $this->db->delete('tbl_brick_category', array('id' => $id));
    }
}
