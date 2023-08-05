<?php
class SetupController extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Custom_model');
    }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_clinic(){
        if($this->input->post('submit')){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('clinic_name','Clinic Name','required');
            $this->form_validation->set_rules('address','Address','required');
            $this->form_validation->set_rules('mobile_number','Mobile Number','required|max_length[10]|min_length[10]');
            if($this->form_validation->run()==TRUE){
                $clinic_name = $this->input->post('clinic_name');
                
                $address = $this->input->post('address'); 
                $email = $this->input->post('email');
                $landline_number = $this->input->post('landline_number');
                $mobile_number = $this->input->post('mobile_number'); 
                $appointment_number = $this->input->post('appointment_number'); 
                $website = $this->input->post('website');
                $payment = $this->input->post('payment');
                $qr_code = $this->input->post('qr_code'); 
                
                if (!empty($_FILES['clinic_logo']) && $_FILES["clinic_logo"]['name'] != "") {
                    $uploaddir = 'upload/clinic_logo/';
                    
                    $new_file_name = str_replace(" ", "_", rand(1111,9999)."_".time() . $_FILES['clinic_logo']['name']);
                    $uploadfile = $uploaddir . $new_file_name;

                    if (move_uploaded_file($_FILES['clinic_logo']['tmp_name'], $uploadfile)) {
                      $clinic_logo = $new_file_name;
                    } else {
                      $clinic_logo = '';
                    }
                }else{
                    $clinic_logo = '';
                }
                  if (!empty($_FILES['qr_code']) && $_FILES["qr_code"]['name'] != "") {
                    $uploaddir = 'upload/qr_code/';
                    $new_file_name = str_replace(" ", "_", rand(1111,9999)."_".time() . $_FILES['qr_code']['name']);
                    $uploadfile = $uploaddir . $new_file_name;
                    if (move_uploaded_file($_FILES['qr_code']['tmp_name'], $uploadfile)) {
                      $qr_code = $new_file_name;
                    } else {
                      $qr_code = '';
                    }
                  }else{
                    $qr_code = '';
                  }
                $data = array(
                    'clinic_name'=>$clinic_name,
                    'logo'=>$clinic_logo,
                    'address'=>$address,
                    'email'=>$email,
                    'landline_number'=>$landline_number,
                    'mobile_number'=>$mobile_number,
                    'appointment_number'=>$appointment_number,
                    'website'=>$website,
                    'payment'=>$payment,
                    'qr_code'=>$qr_code,
                );
               $result = $this->Custom_model->insert_data($data,'da_clinic');
                if($result!=false){
                    $this->session->set_flashdata('success','Clinic Added Successfully');
                }
                redirect('add_clinic');
            }
        }
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/clinic/add_clinic');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_user(){
        if($this->input->post('submit')){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('clinic_name','Clinic Name','required');
            $this->form_validation->set_rules('user_id','User ID','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
            $this->form_validation->set_rules('full_name','Full Name','required');
            $this->form_validation->set_rules('mobile_number','Mobile Number','required|is_unique[da_clinic_user.mobile_number]|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('address','Address','required');
            $this->form_validation->set_rules('email_id','Email ID','required|valid_email|is_unique[da_clinic_user.email_id]');
            
            if($this->form_validation->run()==TRUE){
                $clinic_name = $this->input->post('clinic_name');
                $user_id = $this->input->post('user_id'); 
                $password = $this->input->post('password');
                $full_name = $this->input->post('full_name'); 
                $mobile_number = $this->input->post('mobile_number');
                $address = $this->input->post('address'); 
                $email_id = $this->input->post('email_id');
                $role_id = $this->input->post('role_id');
                $data = array(
                    'clinic_name'=>$clinic_name,
                    'user_id'=>$user_id,
                    'password'=>MD5($password),
                    'full_name'=>$full_name,
                    'mobile_number'=>$mobile_number,
                    'address'=>$address,
                    'email_id'=>$email_id,
                    'role_id'=>$role_id
                );
               $result = $this->Custom_model->insert_data($data,'da_clinic_user');
                if($result!=false){
                    $this->session->set_flashdata('success','User Added Successfully');
                    
                }
                redirect('add_user');
            }
        }
        $this->db->select('*');
        $this->db->from('clinic');
        $clinic = $this->db->get()->result_array();
        $data['clinic']=$clinic;

        $this->db->select('*');
        $this->db->from('role');
        $roles = $this->db->get()->result_array();
        $data['roles'] = $roles;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/user/add_user');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
}
