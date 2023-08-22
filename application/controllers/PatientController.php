<?php
class PatientController extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->model('Custom_model');
        $this->load->helper('common_data_helper');
        $this->blood_group = blood_group();
        $this->gender = gender();  
        if (!$this->session->userdata('admin_session')) {
            redirect(base_url());
        }
        $this->admin_session = $this->session->userdata('admin_session');
        
    }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_patient(){
        $blood_group = $this->blood_group;
        $data['blood_group'] = $blood_group;
        $data['gender']= $this->gender;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/add_patient');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function save_patient(){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('first_name','First Name','required');
        $this->form_validation->set_rules('last_name','Last Name','required');
        // $this->form_validation->set_rules('email_id','Email ID','required|valid_email');
        $this->form_validation->set_rules('mobile_number','Mobile Number','required|max_length[10]|min_length[10]|is_unique[da_patients.mobile_no]');
        // $this->form_validation->set_rules('whatsapp_number','Whatsapp Number','required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('blood_group','Blood Group','required');
        // $this->form_validation->set_rules('birth_date','Birth Date','required');
        $this->form_validation->set_rules('sex','Sex','required');
        $this->form_validation->set_rules('address','Address','required');
        // $this->form_validation->set_rules('patient_problem','Patient Problem','required');
        if($this->form_validation->run()){
            $patient_id = $this->input->post('patient_id');
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
            'patient_problem'=>$patient_problem,
            'clinic_user_id'=>$this->admin_session->id,
            'clinic_id'=>$this->admin_session->clinic_id
            );
        $result = $this->Patient_model->insert_data($data_array,'da_patients');
            if($result!=false){
                $last_id = $result;
                $inc_id = 'DA0000000';
                $inrno='DA'.str_pad((int)$last_id, 7, 0, STR_PAD_LEFT);
                $ir['patient_id'] = $inrno;
                $result = $this->Patient_model->edit_data_where($ir,array('id'=>$last_id),'da_patients');
                $data=array('status'=>'success','message'=>'Patient Added Succesfully','patient_id'=>$inrno);
            }
        }else{
            foreach($_POST as $key=>$value){
                $data['message'][$key]=form_error($key);
            }
        }
        echo json_encode($data);
    }
    public function update_patient(){
        
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
            
            $patient_id = $this->input->post('patient_id');
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
                'patient_problem'=>$patient_problem,
            
            );
            $this->Patient_model->edit_data_where($data_array,array('id'=>$patient_id),'da_patients');
            $data=array('status'=>'success','message'=>'Patient Updated Succesfully');
        }else{
            foreach($_POST as $key=>$value){
                $data['message'][$key]=form_error($key);
            }
        }
        echo json_encode($data);
    }
    public function search_patient(){
        
        $data['blood_group'] = $this->blood_group;
        $categories = $this->Patient_model->get_categories();
        $data['categories'] = $categories;
        $doctors = $this->Patient_model->get_doctors();
        $data['doctors'] = $doctors;
        $data_array = array();
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/search_patient');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function add_more_details(){
        $data['blood_group'] = $this->blood_group;
        $categories = $this->Patient_model->get_categories();
        $data['categories'] = $categories;
        $doctors = $this->Patient_model->get_doctors();
        $data['doctors'] = $doctors;
        $data_array = array();
       
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/add_more_details');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function search_patient_details(){
        $patient_id_number = $this->input->post('patient_id_number');
        $this->db->select('*');
        $this->db->from('da_patients');
        $this->db->where('patient_id',$patient_id_number);
        if($this->admin_session->role_id!="1"){
            $this->db->where('clinic_id',$this->admin_session->clinic_id);
            $this->db->where('clinic_user_id',$this->admin_session->id);
        }
        $this->db->or_where('mobile_no',$patient_id_number);
        $result = $this->db->get()->row_array();
        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo json_encode(array());
        }

        
    }
    public function store_patient_more_details(){
        $patient_id = $this->input->post('patient_id');
        $appointment_date = $this->input->post('appointment_date');
        $appointment_time = $this->input->post('appointment_time');
        $doctor_id = $this->input->post('doctor_id');
        $categories_id ='';
        $sub_categories_id='';
        if(!empty($this->input->post('selected'))){
            $this->db->where('patient_id', $patient_id);
            $this->db->delete('da_patient_categories');
            foreach($this->input->post('selected') as $key=>$val){
                if(!empty($val)){
                    $categories_id = $key;
                    $sub_categories_id =implode(',',$val);
                    $data_cat = array(
                        'patient_id'=>$patient_id,
                        'category_id'=>$categories_id,
                        'sub_category_id' => $sub_categories_id
                    );
                    $this->Patient_model->insert_data($data_cat,'da_patient_categories');
                }
            }
        }
        $this->db->where('patient_id', $patient_id);
            $this->db->delete('da_patient_details');
        $data_res = array(
            'patient_id'=>$patient_id,
            'appointment_date'=>$appointment_date,
            'appointment_time' => $appointment_time,
            'doctor_id' =>$doctor_id
        );
        $ins_data = $this->Patient_model->insert_data($data_res,'da_patient_details');
    }
    public function appointment_book(){
       $patient_id = $this->input->post('patient_id');
       $appointment_date = $this->input->post('appointment_date');
       $appointment_time = $this->input->post('appointment_time');
       $doctor_id = $this->input->post('doctor_id');
       $data = array(
            'patient_id'=>$patient_id,
            'appointment_date'=>$appointment_date,
            'appointment_time' => $appointment_time,
            'doctor_id' =>$doctor_id,
            'clinic_user_id'=>$this->admin_session->id,
            'clinic_id'=>$this->admin_session->clinic_id
       );
       $ins_data = $this->Patient_model->insert_data($data,'da_appointments');
    }
    public function edit_patient(){
        $data['blood_group'] = $this->blood_group;
        $categories = $this->Patient_model->get_categories();
        $data['categories'] = $categories;
        $doctors = $this->Patient_model->get_doctors();
        $data['doctors'] = $doctors;
        $data_array = array();
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/patient-side-menu','content'=>'patient/edit_patients');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
}
