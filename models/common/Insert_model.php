<?php

	class Insert_model extends CI_Model
		{
		 
		 function __construct()
		 	{
			// parent::Model();
			 $this->load->database();
			 }
			 
		 function add_data($sql_table,$data_set)
		 	{
			 $this->db->insert($sql_table, $data_set);
			 if( mysql_affected_rows() > 0 ){ return TRUE; }
			 else							{ return FALSE; }
			 }

		function add($mytable, $data)
			{
			//echo '<pre>';
			//print_r($data);
			$this->db->insert($mytable, $data); 
			return true;
			}
			
		
		 }