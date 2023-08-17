<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Patient_model extends CI_Model {
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
    public function get_categories($id=FALSE){
        if($id!=FALSE){
            $this->db->select('*');
            $this->db->where('id',$id);
            $this->db->from('da_categories');
            $result = $this->db->get()->row();
        }else{
            $this->db->select('*');
            $this->db->from('da_categories');
            $result = $this->db->get()->result();
        }
        
        return $result;
    }
    public function get_sub_categories($id=FALSE){
        
            $this->db->select('*');
            $this->db->where('category_id',$id);
            $this->db->from('da_sub_categories');
            $result = $this->db->get()->result();
        
        return $result;
    }
    public function get_doctors(){
        $this->db->select('*');
        $this->db->where('role_id',3);
        $this->db->from('da_clinic_user');
        $result = $this->db->get()->result();
        return $result;
    }
}


?>