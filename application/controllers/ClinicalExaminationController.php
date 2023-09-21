<?php
class ClinicalExaminationController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
    $this->load->model('Patient_model');
    $this->load->helper('common_data_helper');
    if (!$this->session->userdata('admin_session')) {
      redirect(base_url());
    }    
    $this->blood_group = blood_group();
    $this->gender = gender();  
    $this->month = month();
    $this->year = year();
    if (!$this->session->userdata('admin_session')) {
      redirect(base_url());
    }    
    $this->admin_session = $this->session->userdata('admin_session');
  }
  public function index() {
      $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/empty_tab');
      $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function medical_history(){
    
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $medical_history = $this->Patient_model->get_medical_history();
    $data['medical_history'] = $medical_history;
    
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/medical_history');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function dental_history(){
    
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $dental_history = $this->Patient_model->get_dental_history();
    $data['dental_history'] = $dental_history;

    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/dental_history');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function clinical_examinator(){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $clinical_examinator = $this->Patient_model->get_clinical_examinator();
    $data['clinical_examinator'] = $clinical_examinator;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/clinical_examinator');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function investigation(){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $investigation_category = $this->Patient_model->get_investigation_category();
    $data['investigation_category'] = $investigation_category;
    // $treatment_charges = $this->Patient_model->get_treatment_charges();
    // $data['treatment_charges'] = $treatment_charges;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/investigation');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function diagnosis(){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    
    $diagnosis_category = $this->Patient_model->get_diagnosis_category();
    $data['diagnosis_category'] = $diagnosis_category;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/diagnosis');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function treatment_plan(){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $treatment_plan = $this->Patient_model->get_treatment_plan();
    $data['treatment_plan'] = $treatment_plan;
  
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/treatment_plan');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function treatment_charges(){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $treatment_charges = $this->Patient_model->get_treatment_charges();
    $data['treatment_charges'] = $treatment_charges;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/treatment_charges');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function search_patient_details(){
    $patient_id_number = $this->input->post('patient_id_number');
    $this->db->select('da_appointments.id as appointment_id,da_patients.id as patient_master_id,da_patients.*,da_appointments.appointment_date,da_appointments.appointment_time');
    $this->db->from('da_appointments');
    $this->db->where('da_patients.patient_id',$patient_id_number);
    $this->db->or_where('da_patients.mobile_no',$patient_id_number);
    if($this->admin_session->role_id!="1"){
        $this->db->where('da_appointments.clinic_id',$this->admin_session->clinic_id);
        $this->db->where('da_appointments.clinic_user_id',$this->admin_session->id);
    }
    $this->db->join('da_patients','da_patients.id=da_appointments.patient_id','left');
    $result = $this->db->get()->row_array();
    if(!empty($result)){
        echo json_encode($result);
    }else{
        echo json_encode(array());
    }
  }
  public function patient_categories(){
    $patient_id = $this->input->post('patient_id');
    $this->db->select('*');
    $this->db->from('da_patient_categories');
    $this->db->where('patient_id',$patient_id);
    $result = $this->db->get()->result_array();

    if(!empty($result)){
        echo json_encode($result);
    }else{
        echo json_encode(array());
    }
  }
    
}
