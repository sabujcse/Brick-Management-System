<?php

class Sardar extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_sardar($limit, $offset, $value = '')
	{
		$this->db->select('s.*,g.name as gender_name,st.name as sardar_type_name');
		$this->db->from('tbl_sardars as s');
		$this->db->join('tbl_gender as g', 'g.id = s.gender', 'left');
		$this->db->join('tbl_sardar_type as st', 'st.id = s.sardar_type');
		$this->db->order_by("s.id", "desc");
		if (isset($limit) && $limit > 0)
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_sardar($data)
	{

		return $this->db->insert('tbl_sardars', $data);
	}

	public function get_sardar_info_by_id($id)
	{
		return $this->db->where('id', $id)->get('tbl_sardars')->result_array();
	}

	public function sardar_update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_sardars', $data);
	}

	public function delete_sardar_by_id($id)
	{
		return $this->db->delete('tbl_sardars', array('id' => $id));
	}

}
