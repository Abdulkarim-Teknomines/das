<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Patient_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->admin_session = $this->session->userdata('admin_session');
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
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('id',$this->admin_session->id);
        }
        $this->db->from('da_clinic_user');
        $result = $this->db->get()->result();
        return $result;
    }
    public function appointment_details($month='',$year=''){
        $this->db->select('da_appointments.id as id,da_appointments.appointment_date as appointment_date,da_appointments.appointment_time,da_clinic_user.full_name as doctor_name,da_patients.first_name,da_patients.patient_id,da_patients.last_name,da_patients.email_id,da_patients.mobile_no,da_patients.whatssapp_no,da_patients.blood_group_id,da_patients.birth_date,da_patients.gender,da_patients.address,da_patients.patient_problem');
        if($this->admin_session->role_id!="1"){
            $this->db->where('da_appointments.clinic_id',$this->admin_session->clinic_id);
            $this->db->where('da_appointments.clinic_user_id',$this->admin_session->id);
        }
        if($month!="" && $year!=""){
            $this->db->where("DATE_FORMAT(da_appointments.appointment_date,'%m')", $month);
            $this->db->where("DATE_FORMAT(da_appointments.appointment_date,'%Y')", $year );
        }
        $this->db->join('da_clinic_user','da_clinic_user.id=da_appointments.doctor_id','left');
        $this->db->join('da_patients','da_patients.id=da_appointments.patient_id','left');
        $this->db->from('da_appointments');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_appointment_details($id){
        $this->db->select('da_appointments.id as id,da_appointments.appointment_date,da_appointments.appointment_time,da_clinic_user.id as doctor_id,da_clinic_user.full_name as doctor_name,da_patients.first_name,da_patients.patient_id,da_patients.last_name,da_patients.email_id,da_patients.mobile_no,da_patients.whatssapp_no,da_patients.blood_group_id,da_patients.birth_date,da_patients.gender,da_patients.address,da_patients.patient_problem,da_patients.id as patient_master_id');
        if($this->admin_session->role_id!="1"){
            $this->db->where('da_appointments.clinic_id',$this->admin_session->clinic_id);
            $this->db->where('da_appointments.clinic_user_id',$this->admin_session->id);
        }
        $this->db->where('da_appointments.id',$id);
        $this->db->join('da_clinic_user','da_clinic_user.id=da_appointments.doctor_id','left');
        $this->db->join('da_patients','da_patients.id=da_appointments.patient_id','left');
        $this->db->from('da_appointments');
        $result = $this->db->get()->row();
        return $result;
    }
    public function get_patient_categories($patient_id){
        $this->db->select('da_patient_categories.*');
        $this->db->where('da_patient_categories.patient_id',$patient_id);
        $this->db->from('da_patient_categories');
        $result = $this->db->get()->result();
        return $result;
    }
}


?>