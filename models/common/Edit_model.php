<?php

	class Edit_model extends CI_Model
		{
		 
		 function __construct()
			{
				//parent::Model();
				$this->load->database();
			 }
			 
		 function update_data($field_name, $field_data, $table_name, $updated_data)
		 	{
			
			 $this->db->where($field_name, $field_data);
			 $this->db->update($table_name, $updated_data);	 
			 
			 if( mysql_affected_rows() > 0 ){ return TRUE; }
			 else							{ return FALSE; }
			 }
			 
		 function delete_data($field_name, $field_data, $table_name)
			{
				$this->db->delete($table_name, array($field_name => $field_data));
				if( mysql_affected_rows() > 0 ){ return TRUE; }
			 	else						   { return FALSE; }	
			}	
		 function truncate($table_name)
			{
				$this->db->truncate($table_name); 
				if( mysql_affected_rows() > 0 ){ return TRUE; }
			 	else						   { return FALSE; }	
			}
			 
		 }