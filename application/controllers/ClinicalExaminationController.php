<?php
class ClinicalExaminationController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
    $this->load->model('Patient_model');
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
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/medical_history');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function dental_history(){
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/dental_history');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function clinical_examinator(){
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/clinical_examinator');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function investigation(){
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/investigation');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function diagnosis(){
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/diagnosis');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function treatment_plan(){
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/treatment_plan');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function treatment_charges(){
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/clinical-examination-side-menu','content'=>'clinical-examination/treatment_charges');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
}
