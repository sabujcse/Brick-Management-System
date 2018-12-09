<?php

/**
 * Created by IntelliJ IDEA.
 * User: S. Rahman
 * Date: 11/10/2018
 * Time: 6:27 PM
 */
class Rawbrick extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function get_all_rawbricks($limit, $offset, $value = '')
	{
		$this->db->select('r.*,s.name as sardar_name,s.sardar_id as sardar_code,u.name as unit_name,m.name as machine_name');
		$this->db->from('tbl_rawbricks as r');
		$this->db->join('tbl_sardars as s', 's.id = r.sardar_id', 'left');		
		$this->db->join('tbl_unit as u', 'u.id = r.unit_id', 'left');
		$this->db->join('tbl_machine as m', 'm.id = r.machine_id', 'left');
		$this->db->order_by("r.id", "desc");
		if (isset($limit) && $limit > 0)
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_rawbricks($data)
	{
		return $this->db->insert('tbl_rawbricks', $data);
	}

	public function delete_rawbricks_by_id($id)
	{
		return $this->db->delete('tbl_rawbricks', array('id' => $id));
	}
	
	
	public function rawbricks_info_update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_rawbricks', $data);
	}
		
	public function get_rawbricks_info_by_id($id)
	{
		return $this->db->where('id', $id)->get('tbl_rawbricks')->result_array();
	}

}
