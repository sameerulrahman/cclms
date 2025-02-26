<?php
/**
* Name:  ci_starter
*
* Author: Kenean Alemayehu
*         keneanalemayehu50@gmail.com
*
* Repository: https://github.com/kenean-50/ci_starter
*
* Created:  03.14.2018
*
*/

class Admin_model extends CI_Model {
		
	public function add_user($table, $data)
	{
		
	  	$this->db->insert($table, $data);
	  	return  $this->db->insert_id();
	}

	function auth_user()
	{
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
    	$this->db->where(" userName='$email' OR email='$email' ");
		$result = $this->db->get('users')->result();
		if(!empty($result)){       
			if (password_verify($password, $result[0]->password)) {       
				return $result;                    
			}
			else {             
				return false;
			}
		} else {
			return false;
		}
		
  	}

	public function get_user($user_id = '') 
	{
 		if(isset($user_id) && $user_id !='') {
			$this->db->where('user_id', $user_id); 
		} else if($this->session->userdata('user_details')[0]->user_type == 'admin') {
			$this->db->where('user_type', 'admin'); 
		} else {
			$this->db->where('users.user_id !=', '1'); 
		}
		$result = $this->db->get('users')->result();
		return $result;
  	}
	
	public function update_row($table, $col, $colVal, $data)
	{
		
  		$this->db->where($col,$colVal);
		$this->db->update($table,$data);
		$result = $this->db->get($table)->result();
		return $result;
		
  	}
	
	function check_exists($table='', $colom='',$colomValue='')
	{
		
		$this->db->where($colom, $colomValue);
		$res = $this->db->get($table)->row();
		if(!empty($res)){ return false;} else{ return true;}
		
 	}
	
	public function upload($table, $data)
	{
		
	  	$this->db->insert($table, $data);
	  	return  $this->db->insert_id();
		  
	}
	
	public function get_files($upload_id = FALSE)
	{
		
        if ($upload_id === FALSE)
        {
                $query = $this->db->get('uploads');
                return $query->result_array();
        }

        $query = $this->db->get_where('uploads', array('upload_id' => $upload_id));
        return $query->row_array();
		
	}
	
	public function get_department_files($department)
	{
		
        $query = $this->db->get_where('uploads', array('department' => $department));
        return $query->result_array();
		
	}
	
	public function get_department_files_user($department, $file_type)
	{
		
        $query = $this->db->get_where('uploads', array('department' => $department, 'file_type' =>$file_type));
        return $query->result_array();
		
	}
	
	public function get_row($table = "", $col_name = FALSE, $col_value = FALSE , $order_col = FALSE, $order_val = FALSE) 
	{
		// Produces: SELECT $table WHERE $col_name = $col_value
		if($col_name && $col_value !== FALSE)
		{
			
		    $this->db->where($col_name, $col_value);
  			
		}

		// Produces: ORDER BY $order_col $order_val
		if($order_col && $order_val !== FALSE)
		{
			
			$this->db->order_by($order_col, $order_val);
  			
		}
	
		$query = $this->db->get($table);
		return $query->result_array();		

	}
	
	public function delete_file($upload_id = ""){
 		$this->db->where('upload_id' , $upload_id );
 		$this->db->delete('uploads');
	}
	
	function delete_row($table = "", $col_name = "", $col_value = "")
	{
		$this->db->where($col_name, $col_value);  
		$this->db->delete($table); 
	}
	
	public function record_count($table = "", $col_name = FALSE, $col_value = FALSE)
	{
		
		if ($col_name && $col_value === FALSE)
        {
            $this->db->get($table);
            return  $this->db->count_all_results();
        }
		
			$this->db->like($col_name, $col_value);
			$this->db->from($table);
			return  $this->db->count_all_results();
		
    }
	
	public function record_count_dep($table = "", $col_name1 = "", $col_value1 = "", $col_name2 = "", $col_value2 = "")
	{
		
			$this->db->where($col_name1, $col_value1);
			$this->db->where($col_name2, $col_value2);
			$this->db->from($table);
			return  $this->db->count_all_results();
		
    }
	
	public function fetch_files($limit = "", $start = "", $col_name = FALSE, $col_value = FALSE, $order = "")
	{
		if($col_name  && $col_value != FALSE)
		{
			$this->db->where($col_name, $col_value);
		}
		
        $this->db->limit($limit, $start);
		$this->db->order_by($order,'ASC');
        $query = $this->db->get("uploads");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
    }
	
	
	public function fetch_files_2($table, $limit = "", $order_col = "", $order_val = "", $col_name = FALSE, $col_value = FALSE)
	{
		if($col_name && $col_value !== FALSE){
			
			
			$this->db->where($col_name, $col_value);
			$this->db->limit($limit);
			$this->db->order_by($order_col, $order_val);
			$query = $this->db->get($table);
	     	return $query->result_array();	
			
		} 

        $this->db->limit($limit);
		$this->db->order_by($order_col, $order_val);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
    }
   
   
    public function search($keyword = "", $department = FALSE)
    {
		if($department !== FALSE){
			
		  $data = $this->db->having('department', $department);	
						
		}
		
 		$data =	$this->db->like('file_name', $keyword);
		$data =	$this->db->or_like('author', $keyword);
		$data =	$this->db->or_like('title', $keyword);
		$data =	$this->db->get('uploads');
		
		return $data->result();
    }
	
	function get_data_by($table = '', $col_name = FALSE, $col_value = FALSE)
	{	
		if($col_name  && $col_value != FALSE)
		{ 
			$this->db->where($col_name, $col_value);
		}
		
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		
		return $query->result();
	}

	function get_single_col($table = "", $col_name = "", $col_value = "", $col = "")
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col_name, $col_value);
		$query = $this->db->get();
		$result = $query->row();
		$result = $result->$col;
		return $result;

	}
	function get_all_leads(){
		$this->db->select('*');
		$this->db->from('leads');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	  
}