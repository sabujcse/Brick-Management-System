<?php

	class Custom_methods_model extends CI_Model
		{
		 
		 function __construct()
		 	{
				 //parent::Model();
				 $this->load->database();
			 }
			 
		 // append associative array elements
        function associative_push($arr, $tmp) 
            {
              if (is_array($tmp)) 
                  {
                    foreach ($tmp as $key => $value) 
                        {
                          $arr[$key] = $value;
                        }
                    return $arr;
                  }
              return false;
            }
			
			function query_all_data_office($table)
			{
			$query_string="SELECT * FROM $table ORDER BY name ASC";
			//echo $query_string; die;
			$query=$this->db->query($query_string);
			return $query->result();
			 
			
			}
            
        function query_all_data_orderby($table)
    		{
				$this->db->order_by('id','DESC');
    			$query = $this->db->get($table);
				return $query->result();
    		}
			
		function query_all_data($table)
    		{
    			$query = $this->db->get($table);
				return $query->result();
    		}
			
			
			
            
        function query_single_data($table,$target_field,$source_data,$desired_data)
            {
                $this->db->select($desired_data);
                $this->db->where($target_field, $source_data);
                $this->db->limit(1);
                $this->db->from($table);
                $query = $this->db->get();
                $row   = $query->row();
                return $row->$desired_data;
            } 
            
        function query_single_duplicate_data($table,$target_field,$data)
            {
                $this->db->select($target_field);
                $this->db->from($table);
                $this->db->where($target_field, $data);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() > 0)
                    {
                        return TRUE;
                    }
					
				else
					{
					   return FALSE;
					}
            }   
            
        //Starts methods for grid
        function num_of_data($table,$wh)
    		{
    			if( !empty($wh) )
                    {						
                        $query = $this->db->query("SELECT * FROM ".$table." ".$wh);   
                    }
                else
                    {
                        $this->db->select('*');
            			$this->db->from($table);
            			$query = $this->db->get();
                    }
								
    			return $query->num_rows();
    		}
	
    	function sort_data($sidx,$sord,$start,$limit,$table,$wh)
    		{
    			if( !empty($wh) )
                    {
                        $query = $this->db->query("SELECT * FROM ".$table." ".$wh." ORDER BY ".$sidx." ".$sord." LIMIT ".$start.", ".$limit."");   
                    }
                else
                    {
                        $this->db->select('*');
            			$this->db->from($table);
            			$this->db->order_by($sidx, $sord);
                        $this->db->limit($limit, $start);
            			$query = $this->db->get();
                    }
                
                return $query->result();	
    		}  
       //Ends methods for grid 

		function sel_single_row($id,$table_name)
			{
			$query = $this->db->get_where($table_name, array('id' => $id));
			return $query->result();	
				
			}
       
       function update_query($table_name,$where_condition,$update_field,$updating_data)
			{
				$query="UPDATE $table_name SET $update_field='$updating_data' WHERE $where_condition";
				//echo $query; die;
				$query = $this->db->query($query);
				return true;
			}
			
		function select_row_by_condition($table_name,$where_condition)
		{
			$query_string="SELECT * FROM $table_name WHERE $where_condition";
			//echo $query_string; die;
			$query=$this->db->query($query_string);
			return $query->result();
		}
		
			function get_js()
			{
			$query = $this->db->get('image_list');
			return $query->result();
			
			}
			
		function select_row_by_condition_left_join($query,$where_condition)
		{
			$query_string="$query WHERE $where_condition";
			//echo $query_string;
			$query=$this->db->query($query_string);
			return $query->result();
		
		}
		
		function update_query_custom($query)
		{
		$query_string=$query;
		//echo $query_string; die;
		$query = $this->db->query($query_string);
		return true;
		
		}
       
       function upload_file($upload_path,$tmp_file,$file_name,$file_type,$file_size,$file_category)
        {
            $message      = '';
            $dest         = '';
        	$SizeFlag     = '';
        	$MaxFileSize  = 2000000; //Specify the maximum range of the file; here it is 2MB
            
            if ( ($tmp_file != 'none') && ($tmp_file != '' )) //Checkout if file is selected or not
		     { 
              if ( $file_size > $MaxFileSize ) //Compare the size of your provided file with the specified maximum range
    	       {
    	           $FileSizeInKB = ($filesize[$i])/1000; //Calculate your filesize in KB
		           $message      = 'failure|Supplied File should not be larger than 2MB. But the Size of '.$filename.' is '.$FileSizeInKB. 'KB.';
                }
	          else
	           {
		          $SizeFlag  = 'OK'; //Proceed with your file if it is less than or equal to 2MB
		          $file = '';
                  
                  if( $file_category == 'font' )
                    {
                        switch ( $file_type ) //Lets findout the type of your file and give its upload path with its original name
    				     { 
                          case ("application/octet-stream"): 
                          		$file = $file_name;
                                $dest = $upload_path.$file_name; 
                    	  		break;
    						 
    				   	  default:  
    				         $message  = 'failure|Only true-type font file is allowed to upload other than any '.$filetype.'type of file.';
                             $SizeFlag = '';
    						 break;
    						  
    					  }
                    }
                  else
                    {
                        switch ( $file_type ) //Lets findout the type of your file and give its upload path with its original name
    				     { 
                          case ("image/pjpeg"): 
                          		$file = uniqid().'.jpg';
                                $dest = $upload_path.$file; 
                    	  		break;
    							
    					  case ("image/jpeg"): 
                          		$file = uniqid().'.jpg';
                                $dest = $upload_path.$file;  
                    	  		break;		
    						 
    					  case ("image/gif"): 
                          		$file = uniqid().'.gif';
                                $dest = $upload_path.$file; 
                    	  		break;
    						 
    				      case ("image/x-png"): 
                          		$file = uniqid().'.png';
                                $dest = $upload_path.$file; 
                    	  		break;
    						 
    				      case ("image/png"): 
                          		$file = uniqid().'.png';
                                $dest = $upload_path.$file; 
                    	  		break;
    						 
    				   	  default:
    				         $message  = 'failure|Only gif/jpeg/png file is allowed to upload other than any '.$filetype.'type of file.';
                             $SizeFlag = '';
    						 break;
    					  }
                    }  
                  
		
            		if ( $dest != '' && $SizeFlag != '')
            		    { 
                         if ( move_uploaded_file( $tmp_file, $dest ) ) //Lets now upload the file from the server to its specified destination if it falls in either of 5 types and the size is less than or equal to 60 KB
            			     { 
            			         $message = 'success|'.$file;
        				     }
            			 else {
            			         $message = 'failure|File '.$file_name. ' Could not be Uploaded.'; 
                              }
            		     }  

                }
	       } 
        else
	       { 
                $message = 'failure|No File Provided !!'; 
           }
           
        return $message;
           
        }
        
    function get_max($field,$table)
		{
    		$this->db->select_max($field);
    		$query = $this->db->get($table);
    		
    		return $query->result();
		
		}

	function get_where($table,$field,$value)
		{
		$query = $this->db->get_where($table, array($field => $value));
		
		 return $query->result();
		}
	function query_data($query)
    	{
    		$query = $this->db->query($query);
			
            return $query->result();
    	}	
	   
	
	   
            
    }