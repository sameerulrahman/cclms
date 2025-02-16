<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Mookoob
*
* Author: Kenean Alemayehu
*         keneanalemayheu50@gmail.com
*
* Repository: http://gitlab.com/kenean/mookoob/
*
* Created:  1.10.2018
*
* Description:  basic database operation functions like create, read, update delete  
*
*/

class Crud_model extends CI_Model {
    

    /**
     * Add new data to the database
     * 
     * @param table the name of the table
     * @param data data to be added
     * 
     */
    public function add($table = "", $data = null)
    {

        $this->db->insert($table, $data);
        return  $this->db->insert_id();
    }

    /**
     * Update entry form the data base
     * 
     * @param table the name of the table 
     * @param col_name the name of unique column
     * @param col_value the value of the unique column
     * @param data the data to be updated   
     * 
     */

    public function update($table = "", $col_name = "", $col_value = "", $data = "")
	{
		
  		$this->db->where($col_name, $col_value);
		$this->db->update($table, $data);
		$result = $this->db->get($table)->result();
		return $result;
		
    }


    /**
     * Delete record from the database
     * 
     * @param table the name of the table 
     * @param col_name the unique column 
     * @param col_value the value for the unique column
     * 
     */

    public function delete($table = "", $col_name_1 = "", $col_value_1 = "", $col_name_2 = false, $col_value_2 = false)
    {
        if($col_name_2 && $col_value_2 != false)
            $this->db->where($col_name_2, $col_value_2); 
        
        $this->db->where($col_name_1, $col_value_1);  
		$this->db->delete($table); 
    }
    
    /**
     * Get data from the database
     * 
     * @param table the name of the table 
     * @param col_name the unique column 
     * @param col_value the value for the unique column
     * 
     */

    public function get($table = "", $col_name1 = FALSE, $col_value1 = FALSE, $col_name2 = FALSE, $col_value2 = FALSE, $col_name3 = FALSE, $col_value3 = FALSE, $col_name4 = FALSE, $col_value4 = FALSE)
	{
        if($col_name1 && $col_value1 != FALSE):
            $this->db->where($col_name1, $col_value1);
        endif;

        if($col_name2 && $col_value2 != FALSE):
            $this->db->where($col_name2, $col_value2);
        endif;

        if($col_name3 && $col_value3 != FALSE):
            $this->db->where($col_name3, $col_value3);
        endif;

        if($col_name4 && $col_value4 != FALSE):
            $this->db->where($col_name4, $col_value4);
        endif;

        $query = $this->db->get($table);
		return $query->result_array();		
    }
}