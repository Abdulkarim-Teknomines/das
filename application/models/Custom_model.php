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
   public function get_clinic($id=FALSE){
    if($id!=FALSE){
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('da_clinic');
        return $this->db->get()->row();
    }else{
        $this->db->select('*');
        $this->db->from('da_clinic');
        return $this->db->get()->result();
    }
   }
   public function get_user($id=FALSE){
    
    if($id!=FALSE){
        $this->db->select('*,da_clinic_user.id as id,da_clinic_user.mobile_number,da_clinic_user.address,da_clinic_user.email_id,da_clinic_user.full_name,da_clinic_user.user_id,da_clinic_user.email_id,da_clinic.clinic_name,da_clinic_user.address,da_clinic_user.email_id,da_role.name');
        $this->db->join('da_clinic','da_clinic.id=da_clinic_user.clinic_id','left');
        $this->db->join('da_role','da_role.id=da_clinic_user.role_id','left');
        $this->db->where('da_clinic_user.id',$id);
        $this->db->from('da_clinic_user');
        $result = $this->db->get()->row();
        
        return $result;
    }else{
        $this->db->select('da_clinic_user.id as id,da_clinic_user.mobile_number,da_clinic_user.address,da_clinic_user.email_id,da_clinic_user.full_name,da_clinic_user.user_id,da_clinic_user.email_id,da_clinic.clinic_name,da_clinic_user.address,da_clinic_user.email_id,,da_role.name');
        $this->db->join('da_clinic','da_clinic.id=da_clinic_user.clinic_id','left');
        $this->db->join('da_role','da_role.id=da_clinic_user.role_id','left');
        $this->db->from('da_clinic_user');
        return $this->db->get()->result();
        
    }
   }
   
   public function get_treatment_plan($id=FALSE){
    if($id!=FALSE){
        $this->db->select('*');
        $this->db->where('id',$id);
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->from('da_treatment_plan');
        $result = $this->db->get()->row();
    }else{
        $this->db->select('*');
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->from('da_treatment_plan');
        $result = $this->db->get()->result();
    }
    
    return $result;
   }
   public function get_medicine_type(){
    $this->db->select('*');
    $this->db->from('da_medicine_type');
    $medicine_type = $this->db->get()->result_array();
    return $medicine_type;
   }
   public function get_medicine($id=FALSE){
    if($id!=false){
        $this->db->select('*,da_medicine.id,da_medicine_type.name,da_medicine.medicine_name');
        $this->db->join('da_medicine_type','da_medicine_type.id=da_medicine.medicine_type_id');
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->where('da_medicine.id',$id);
        $this->db->from('da_medicine');
        $result = $this->db->get()->row();
        
    }else{
        $this->db->select('*,da_medicine.id,da_medicine_type.name,da_medicine.medicine_name');
        $this->db->join('da_medicine_type','da_medicine_type.id=da_medicine.medicine_type_id');
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->from('da_medicine');
        $result = $this->db->get()->result();
        
    }
    return $result;
   }
   public function get_video($id=FALSE){
    if($id!=FALSE){
        $this->db->select('*');
        $this->db->where('id',$id);
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->from('da_videos');
        $result = $this->db->get()->row();
    }else{
        $this->db->select('*');
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->from('da_videos');
        $result = $this->db->get()->result();
    }
    return $result;
   }
   public function get_roles(){
    $this->db->select('*');
    $this->db->from('role');
    $roles = $this->db->get()->result();
    return $roles;
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
    if ($this->db->affected_rows() > 0) {
        // return true;
        return $rs;
    } else {
        return false;
    }
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

}


?>