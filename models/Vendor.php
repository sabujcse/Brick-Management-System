<?php

class Vendor extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_vendors($limit, $offset, $value = '')
	{
		$this->db->select('v.*,t.name as vendor_type');
		$this->db->from('tbl_vendors as v');
		$this->db->join('tbl_vendor_type as t', 't.id = v.vendor_type_id', 'left');
		$this->db->order_by("v.id", "desc");
		if (isset($limit) && $limit > 0)
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_vendor($data)
	{

		return $this->db->insert('tbl_vendors', $data);
	}

	public function get_vendor_info_by_id($id)
	{
		return $this->db->where('id', $id)->get('tbl_vendors')->result_array();
	}

	public function vendor_update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_vendors', $data);
	}

	public function delete_vendor_by_id($id)
	{
		return $this->db->delete('tbl_vendors', array('id' => $id));
	}

}
