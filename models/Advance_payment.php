<?php

class Advance_payment  extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    
    function get_advanced_payment($limit, $offset, $value = '')
	{
		$this->db->select('a.*,s.name as sardar_name,s.sardar_id as sardar_code');
		$this->db->from('tbl_advance_payment as a');
		$this->db->join('tbl_sardars as s', 's.id = a.sardar_id', 'left');		
		$this->db->order_by("a.id", "desc");
		if (isset($limit) && $limit > 0)
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
    public function add_advanced_payment($data)
    {
        return $this->db->insert('tbl_advance_payment', $data);
    }

    public function get_advance_payment_info_by_id($id)
    {
        return $this->db->where('id', $id)->get('tbl_advance_payment')->result_array();
    }

    public function advance_payment_update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_advance_payment', $data);
        return true;
    }
    public function delete_advance_payment_by_id($id)
    {
        return $this->db->delete('tbl_advance_payment', array('id' => $id));
    }
}
