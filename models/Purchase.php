<?php

/**
 * Created by IntelliJ IDEA.
 * User: S. Rahman
 * Date: 11/10/2018
 * Time: 6:27 PM
 */
class Purchase extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function get_all_purchases($limit, $offset, $value = '')
	{
		$this->db->select('p.*,pt.name as product_name,u.name as unit_name,v.name as vendor_name,v.vendor_id as vendor_code');
		$this->db->from('tbl_purchases as p');
		$this->db->join('tbl_product_type as pt', 'pt.id = p.product_type_id', 'left');
		$this->db->join('tbl_vendors as v', 'v.id = p.vendor_id', 'left');
		$this->db->join('tbl_unit as u', 'u.id = p.quantity_unit_id', 'left');
		$this->db->order_by("p.id", "desc");
		if (isset($limit) && $limit > 0)
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_purchase($data)
	{
		return $this->db->insert('tbl_purchases', $data);
	}

	public function delete_purchase_by_id($id)
	{
		return $this->db->delete('tbl_purchases', array('id' => $id));
	}

}
