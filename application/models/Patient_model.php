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
    public function appointment_details_by_date($date=''){
        $this->db->select('da_appointments.id as id,da_appointments.appointment_date as appointment_date,da_appointments.appointment_time,da_clinic_user.full_name as doctor_name,da_patients.first_name,da_patients.patient_id,da_patients.last_name,da_patients.email_id,da_patients.mobile_no,da_patients.whatssapp_no,da_patients.blood_group_id,da_patients.birth_date,da_patients.gender,da_patients.address,da_patients.patient_problem');
        if($this->admin_session->role_id!="1"){
            $this->db->where('da_appointments.clinic_id',$this->admin_session->clinic_id);
            $this->db->where('da_appointments.clinic_user_id',$this->admin_session->id);
        }
        if($date!=""){
            $this->db->where("da_appointments.appointment_date", $date);
        }
        $this->db->join('da_clinic_user','da_clinic_user.id=da_appointments.doctor_id','left');
        $this->db->join('da_patients','da_patients.id=da_appointments.patient_id','left');
        $this->db->from('da_appointments');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_count_appointment($month='',$year=''){
        $this->db->select("count(da_appointments.id) as title,da_appointments.appointment_date as start");
        if($month!="" && $year!=""){
            $this->db->where("DATE_FORMAT(da_appointments.appointment_date,'%m')", $month);
            $this->db->where("DATE_FORMAT(da_appointments.appointment_date,'%Y')", $year );
        }else{
            $month = date('m');
            $year = date('Y');
            $this->db->where("DATE_FORMAT(da_appointments.appointment_date,'%m')", $month);
            $this->db->where("DATE_FORMAT(da_appointments.appointment_date,'%Y')", $year );
        }
        $this->db->group_by('da_appointments.appointment_date');
        $this->db->from('da_appointments');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_appointment_details($id){
        $this->db->select('da_appointments.id as id,da_appointments.appointment_date,da_appointments.appointment_time,da_patients.age,da_clinic_user.id as doctor_id,da_clinic_user.full_name as doctor_name,da_patients.first_name,da_patients.patient_id,da_patients.last_name,da_patients.email_id,da_patients.mobile_no,da_patients.whatssapp_no,da_patients.blood_group_id,da_patients.birth_date,da_patients.gender,da_patients.address,da_patients.patient_problem,da_patients.id as patient_master_id');
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
    public function get_medical_history(){
        $this->db->select('da_medical_history_category.*');
        $this->db->from('da_medical_history_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_dental_history(){
        $this->db->select('da_dental_history_category.*');
        $this->db->from('da_dental_history_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_treatment_charges(){
        $this->db->select('da_treatment_charges_category.*');
        $this->db->from('da_treatment_charges_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_clinical_examinator(){
        $this->db->select('da_clinical_examinator_category.*');
        $this->db->from('da_clinical_examinator_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_class_categories($id){
        $this->db->select('da_class_category.*');
        $this->db->where('da_class_category.clinical_examinator_category_id',$id);
        $this->db->from('da_class_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_deep_caries_class($id){
        $this->db->select('da_deep_caries_category.*');
        $this->db->where('da_deep_caries_category.clinical_examinator_category_id',$id);
        $this->db->from('da_deep_caries_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_deep_caries_class_category($id){
        $this->db->select('da_deep_caries_class_category.*');
        $this->db->where('da_deep_caries_class_category.deep_caries_category_id',$id);
        $this->db->from('da_deep_caries_class_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_treatment_plan(){
        $this->db->select('da_treatment_plan_category.*');
        $this->db->from('da_treatment_plan_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_treatment_plan_sub_categories($id){
        $this->db->select('treatment_plan_sub_categories.*');
        $this->db->where('treatment_plan_sub_categories.treatment_plan_category_id',$id);
        $this->db->from('treatment_plan_sub_categories');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_investigation_category(){
        $this->db->select('da_investigation_category.*');
        $this->db->from('da_investigation_category');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_investigation_iopa_sub_category($id){
        $this->db->select('da_investigation_iopa_sub_categories.*');
        $this->db->where('da_investigation_iopa_sub_categories.category_id',$id);
        $this->db->from('da_investigation_iopa_sub_categories');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_investigation_cbct_sub_categories($id){
        $this->db->select('da_investigation_cbct_sub_categories.*');
        $this->db->where('da_investigation_cbct_sub_categories.investigation_cbct_category_id',$id);
        $this->db->from('da_investigation_cbct_sub_categories');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_investigation_blood_examination_blood_sub_categories($id){
        $this->db->select('da_investigation_blood_examination_sub_categories.*');
        $this->db->where('da_investigation_blood_examination_sub_categories.investigation_blood_examination_blood_sub_category_id',$id);
        $this->db->from('da_investigation_blood_examination_sub_categories');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_diagnosis_category(){
        $this->db->select('da_diagnosis_categories.*');
        $this->db->from('da_diagnosis_categories');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_diagnosis_sub_categories($id){
        $this->db->select('da_diagnosis_sub_categories.*');
        $this->db->where('da_diagnosis_sub_categories.diagnosis_category_id',$id);
        $this->db->from('da_diagnosis_sub_categories');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_diagnosis_sub_categories_class($id){
        $this->db->select('da_diagnosis_sub_categories_class.*');
        $this->db->where('da_diagnosis_sub_categories_class.diagnosis_sub_category_id',$id);
        $this->db->from('da_diagnosis_sub_categories_class');
        $result = $this->db->get()->result();
        return $result;
    }
    public function get_diagnosis_cagegory_class($id){
        $this->db->select('da_diagnosis_cagegory_class.*');
        $this->db->where('da_diagnosis_cagegory_class.diagnosis_category_id',$id);
        $this->db->from('da_diagnosis_cagegory_class');
        $result = $this->db->get()->result();
        return $result;
    }
}


?>