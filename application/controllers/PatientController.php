<?php
class PatientController extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->model('Custom_model');
        if (!$this->session->userdata('admin_session')) {
            redirect(base_url());
        }
    }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_patient(){
        $blood_group = $this->Custom_model->get_blood_group();
        $data['blood_group'] = $blood_group;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/add_patient');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function save_patient(){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('first_name','First Name','required');
        $this->form_validation->set_rules('last_name','Last Name','required');
        // $this->form_validation->set_rules('email_id','Email ID','required|valid_email');
        $this->form_validation->set_rules('mobile_number','Mobile Number','required|max_length[10]|min_length[10]');
        // $this->form_validation->set_rules('whatsapp_number','Whatsapp Number','required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('blood_group','Blood Group','required');
        // $this->form_validation->set_rules('birth_date','Birth Date','required');
        $this->form_validation->set_rules('sex','Sex','required');
        $this->form_validation->set_rules('address','Address','required');
        // $this->form_validation->set_rules('patient_problem','Patient Problem','required');
        if($this->form_validation->run()){
           $first_name = $this->input->post('first_name');
           $last_name = $this->input->post('last_name');
           $email_id = $this->input->post('email_id');
           $mobile_number = $this->input->post('mobile_number');
           $whatsapp_number = $this->input->post('whatsapp_number');
           $blood_group = $this->input->post('blood_group');
           $birth_date = $this->input->post('birth_date');
           $sex = $this->input->post('sex');
           $address = $this->input->post('address');
           $patient_problem = $this->input->post('patient_problem');
           $data_array = array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email_id'=>$email_id,
            'mobile_no'=>$mobile_number,
            'whatssapp_no'=>$whatsapp_number,
            'blood_group_id'=>$blood_group,
            'birth_date'=>$birth_date,
            'gender'=>$sex,
            'address'=>$address,
            'patient_problem'=>$patient_problem
            );
        $result = $this->Patient_model->insert_data($data_array,'da_patients');
            if($result!=false){
                $last_id = $result;
                $inc_id = 'DA0000000';
                $inrno=str_pad((int)$last_id, 7, 0, STR_PAD_LEFT);
                $data=array('status'=>'success','message'=>'Patient Added Succesfully','patient_id'=>$inrno);
            }
        }else{
            foreach($_POST as $key=>$value){
                $data['message'][$key]=form_error($key);
            }
        }
        echo json_encode($data);
    }
    public function search_patient(){
        
        $blood_group = $this->Custom_model->get_blood_group();
        $data['blood_group'] = $blood_group;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/search_patient');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
}
