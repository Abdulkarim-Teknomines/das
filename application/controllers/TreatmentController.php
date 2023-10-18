<?php
class TreatmentController extends MY_Controller {
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
           
        $this->admin_session = $this->session->userdata('admin_session');
      }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/treatment-side-menu','content'=>'setup/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function treatment_charges(){
        $data['blood_group'] = $this->blood_group;
        $categories = $this->Patient_model->get_categories();
        $data['categories'] = $categories;
        $doctors = $this->Patient_model->get_doctors();
        $data['doctors'] = $doctors;
        $treatment_charges = $this->Patient_model->get_treatment_charges();
        $data['treatment_charges'] = $treatment_charges;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/treatment-side-menu','content'=>'treatment/treatment_charges');
          $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
      }
    public function store_treatment_charges_details(){
        $trt_char_id = '';
        $this->db->where('patient_id', $this->input->post('patient_id'));
        $this->db->delete('da_patient_treatment_charges');

        if(!empty($this->input->post('treatment_charges_id'))){
            $trt_char_id = implode(',',$this->input->post('treatment_charges_id'));
        }
        
        $data = array(
            'patient_id'=>$this->input->post('patient_id'),
            'treatment_charges_id'=>$trt_char_id,
            'clinic_user_id'=>$this->admin_session->id,
            'clinic_id'=>$this->admin_session->clinic_id
        );
        $ins_data = $this->Patient_model->insert_data($data,'da_patient_treatment_charges');
        if($ins_data!=false){
            $data=array('status'=>'success','message'=>'Treatment Charges Added Successfully');
            echo json_encode($data);
        }
    }
}
