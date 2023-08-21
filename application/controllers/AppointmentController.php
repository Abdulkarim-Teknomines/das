<?php
class AppointmentController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
    $this->load->model('Patient_model');
    $this->load->helper('common_data_helper');
    $this->blood_group = blood_group();
    $this->gender = gender();  
    if (!$this->session->userdata('admin_session')) {
      redirect(base_url());
    }    
    $this->admin_session = $this->session->userdata('admin_session');
  }

  public function index() {
    
      $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/empty_tab');
      $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function schedule_appointment(){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
        
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/schedule_appointment');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function edit_appointment(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/edit_appointment');
    $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function future_appointment(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/future_appointment');
    $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function appointment_history(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/appointment_history');
    $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function view_appointment_details(){
    $draw='';
    $data = array();
    $result = $this->Patient_model->appointment_details();
    if(!empty($result)){
        foreach($result as $e){
            $data[]=array(
            'select',
            $e->appointment_date,
            $e->appointment_time,
            'doctor',
            'patient_id',
            'patient_name',
            'treatment'
          );
        }
    }
    $results=array(
      "draw"=>$draw,
      "recordsTotal"=>count($result),
      "recordsFiltered"=>count($result),
      "data"=>$data
    );
    echo json_encode($results);
  }
  
}
