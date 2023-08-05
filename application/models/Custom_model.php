<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
    function insert_data($data, $table_name) {
        $this->db->insert($table_name, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
   
    public function fetch_data($table_name, $field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = '', $end = '',$where_string='') {
        
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                     $wh_list = explode(",", $where_list);
                    if(strpos($key,'NOT IN') !== false){
                        $key = str_replace("NOT IN","",$key);
                        $this->db->where_not_in($key, $wh_list);
                    }else{
                        $this->db->where_in($key, $wh_list);
                    }                    
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
					$this->db->like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if ($page_number !== "" && $item_per_page != "") {
            //$this->db->order_by($order,$by); 
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
        $query = $this->db->get($table_name);
        
        // exit;
        $arr = array();
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return $arr;
        }
    }

    

    public function row_count($table_name, $field, $where, $joining = '', $having = '', $search = '', $group_by = '', $where_string='') {
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                // if (strpos($where_list, ",") == true) {
                //     $wh_list = explode(",", $where_list);
                //     $this->db->where_in($key, $wh_list);
                // } else {
                //     $this->db->where($key, $where_list);
                // }
                if (strpos($where_list, ",") == true) {
                     $wh_list = explode(",", $where_list);
                    if(strpos($key,'NOT IN') !== false){
                        $key = str_replace("NOT IN","",$key);
                        $this->db->where_not_in($key, $wh_list);
                    }else{
                        $this->db->where_in($key, $wh_list);
                    }                    
                }else {
                    $this->db->where($key, $where_list);
                }
            }
        }
         if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($joining) || !empty($joining) && is_array($joining)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->like($key, $search_list);
                }
            }
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table_name);
         //echo $this->db->last_query();//exit;
        return $query->num_rows();
    }
    
    public function delete_row($table_name, $field = array(), $wherein = array()) {
        if ($table_name != "" && !empty($field) && !empty($wherein)) {
            $number_of_field = count($wherein);
            for ($i = 0; $i < count($field); $i++) {
                $this->db->where_in($field[$i], $wherein[$i]);
            }
            $this->db->delete($table_name);
            $effected_row = $this->db->affected_rows();
            if ($number_of_field == $effected_row) {
                return 1; //all row inserted
            } else {
                return 2; //some rows are not inserted
            }
        } else {
            return false;
        }
    }
    function edit_data_where($data, $where, $table_name) {
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        $rs = $this->db->update($table_name, $data);
        return $rs;
    }
    function edit_data($data, $where, $table_name) {
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        $rs = $this->db->update($table_name, $data);
        //echo $this->db->last_query();
        //exit;
        /* if($this->db->affected_rows()>0){ */
        // return $this->db->insert_id();
        /* }else{
          return false;
          } */
        return $rs;
    
    }
    function delete_row_by_conditions($table_name, $where) {
        if ($table_name != "" && !empty($where)) {
            //$this->db->where_in($field,$wherein);
            foreach ($where as $key => $list) {
                $this->db->where($key, $list);
            }
            $this->db->delete($table_name);
            $effected_row = $this->db->affected_rows();
            return $effected_row;
        } else {
            return false;
        }
    }

    
    
    
   
     
	
	 public function fetch_data_array($table_name, $field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = '', $end = '',$where_string='') {
        $this->db->select($field);
         if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                     $wh_list = explode(",", $where_list);
                    if(strpos($key,'NOT IN') !== false){
                        $key = str_replace("NOT IN","",$key);
                        $this->db->where_not_in($key, $wh_list);
                    }else{
                        $this->db->where_in($key, $wh_list);
                    }                    
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->or_like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if ($page_number !== "" && $item_per_page != "") {
            //$this->db->order_by($order,$by); 
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
       $query = $this->db->get($table_name);
        
        $arr = array();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $arr;
        }
    }
   

     

}


?>