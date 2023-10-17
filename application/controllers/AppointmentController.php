<?php
class AppointmentController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
    $this->load->model('Patient_model');
    $this->load->helper('common_data_helper');
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
    $data['month'] = $this->month;
    $data['year'] = $this->year;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/edit_appointment');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function future_appointment(){
    $data['month'] = $this->month;
    $data['year'] = $this->year;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/future_appointment');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function appointment_history(){
    $data['month'] = $this->month;
    $data['year'] = $this->year;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/appointment_history');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
  public function view_appointment_details(){
    $month = $this->input->post('month');
    $year = $this->input->post('year');
    $draw='';
    $data = array();
    $result = $this->Patient_model->appointment_details($month,$year);
    if(!empty($result)){
        foreach($result as $e){
          $data[]=array(
          '<input type="radio" id="appointment_id" name="appointment_id" class="appointment_id" value='.$e->id.'>',
          $e->appointment_date,
          $e->appointment_time,
          $e->doctor_name,
          $e->patient_id,
          $e->first_name,
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
  public function view_appointment_details_by_date(){
    $date = $this->input->post('date');
    $draw='';
    $data = array();
    $result = $this->Patient_model->appointment_details_by_date($date);
    if(!empty($result)){
        foreach($result as $e){
          $data[]=array(
          '<input type="radio" id="appointment_id" class="appointment_id" name="appointment_id" value='.$e->id.'>',
          $e->appointment_date,
          $e->appointment_time,
          $e->doctor_name,
          $e->patient_id,
          $e->first_name,
          'treatment'
          );
        }
    }
    $results=array(
      "draw" => $draw,
      "recordsTotal" => count($result),
      "recordsFiltered" => count($result),
      "data" => $data
    );
    echo json_encode($results);
  } 
  public function view_appointments_details($id){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $appointment_details = $this->Patient_model->get_appointment_details($id);
    $patient_categories = $this->Patient_model->get_patient_categories($appointment_details->patient_master_id);
    $data['patient_categories'] = $patient_categories;
    $data['appointment_details'] = $appointment_details;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/view_appointment_details');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);    
  }
  public function edit_appointments($appointment_id){
    $data['blood_group'] = $this->blood_group;
    $categories = $this->Patient_model->get_categories();
    $data['categories'] = $categories;
    $doctors = $this->Patient_model->get_doctors();
    $data['doctors'] = $doctors;
    $appointment_details = $this->Patient_model->get_appointment_details($appointment_id);
    $patient_categories = $this->Patient_model->get_patient_categories($appointment_details->patient_master_id);
    $data['patient_categories'] = $patient_categories;
    $data['appointment_details'] = $appointment_details;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/edit_appointment_details');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);    
  }

  public function update_appointment(){
    $appointment_id = $this->input->post('appointment_id');
    $appointment_date = $this->input->post('appointment_date');
    $appointment_time = $this->input->post('appointment_time');
    $doctor_id = $this->input->post('doctor_id');
    $patient_id = $this->input->post('patient_id');
    
    $data = array(
      'appointment_date'=>$appointment_date,
      'appointment_time'=>$appointment_time,
      'doctor_id'=>$doctor_id
    );    
    $result = $this->Patient_model->edit_data_where($data,array('id'=>$appointment_id),'da_appointments');
    if($result!=false){
      $data=array('status'=>'success','message'=>'Appointment Updated','patient_id'=>$patient_id,'appointment_date'=>$this->input->post('appointment_date'),'appointment_time'=>$appointment_time);
    }
    echo json_encode($data);
  }

  public function load(){
    $month = $this->input->get('month');
    $year = $this->input->get('year');
    $data = $this->Patient_model->get_count_appointment($month,$year);
    $da =array();

    foreach($data as $k){
      $da[] = array(
        'title'=>$k->title,
        'start'=>$k->start,
        'backgroundColor' => '#000',
        'textColor'       => '#fff'
      ); 
    }
    echo json_encode($da);
  }
  public function fetch_data(){
    $selected_date = $this->input->get('date');
    $data['month'] = $this->month;
    $data['year'] = $this->year;
    $data['selected_date'] = $selected_date;
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/appointment-side-menu', 'content' => 'appointment/list_future_appointment');
    $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
  }
}
