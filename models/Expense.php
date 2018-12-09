<?php

/**
 * Created by IntelliJ IDEA.
 * User: S. Rahman
 * Date: 11/10/2018
 * Time: 6:27 PM
 */
class Expense extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function get_all_expenses($limit, $offset, $value = '')
	{
		$this->db->select('e.*');
		$this->db->from('tbl_ba_expense as e');
		$this->db->order_by("e.id", "desc");
		if (isset($limit) && $limit > 0)
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function delete_expense_details_by_id($id)
	{
		return $this->db->delete('tbl_ba_expense_details', array('expense_id' => $id));
	}

	public function delete_expense_by_id($id)
	{
		return $this->db->delete('tbl_ba_expense', array('id' => $id));
	}

}
