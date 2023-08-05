<?php
class LoginController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
  }

  public function user_login() {
    if ($this->session->userdata('admin_session')) {
      redirect(base_url('dashboard'));
    }
    if($this->input->post('login')){
        
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run()==TRUE){
            $email = $this->input->post('email');
                $email = $this->input->post('email'); 
                $password = $this->input->post('password'); 
                $this->db->select('*');
                $this->db->from('da_user');
                $this->db->where('email_id',$email);
                $this->db->where('password',MD5($password));
                $this->db->where('is_verified','1');
                $data = $this->db->get();
                $result = $data->row();
                if($data->num_rows()<=0){
                    $this->session->set_flashdata('error','Username or Password is Incorrect');
                }else{
                    $this->session->set_userdata('admin_session',$result);
                    redirect('dashboard');
                }
        }
    }
    
    $this->load->view('template/admin-template/login_header');
    $this->load->view('login/login');
    $this->load->view('template/admin-template/login_footer');
    }
    public function signup(){
        if($this->input->post('signup')){
            
            $this->form_validation->set_error_delimiters('<div class="error" style="text-align:left">', '</div>');
            $this->form_validation->set_rules('firstname','First Name','required');
            $this->form_validation->set_rules('lastname','Last Name','required');
            $this->form_validation->set_rules('mobile_number','Mobile Number','required|is_unique[da_user.mobile_number]|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[da_user.email_id]');
            
            if($this->form_validation->run()==TRUE){
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname'); 
                $mobile = $this->input->post('mobile_number'); 
                $email = $this->input->post('email');
                $data = array(
                    'first_name'=>$firstname,
                    'last_name'=>$lastname,
                    'email_id'=>$email,
                    'mobile_number'=>$mobile,
                    'is_verified'=>'1'
                );
               $result = $this->Custom_model->insert_data($data,'da_user');
                if($result!=false){
                    $this->session->set_flashdata('success','Your Account Will be Activate Soon');
                }
                redirect('register');
            }
        }
        $this->load->view('template/admin-template/login_header');
        $this->load->view('login/signup');
        $this->load->view('template/admin-template/login_footer');
    }
    public function forgot_password(){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name','First Name','required');
        $this->form_validation->set_rules('mobile','Mobile Number','required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        if($this->input->post('submit')){
            if($this->form_validation->run()==TRUE){
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $mobile =$this->input->post('mobile');
                $this->db->select('*');
                $this->db->from('da_user');
                $this->db->where('first_name',$name);
                $this->db->where('email_id',$email);
                $this->db->where('mobile_number',$mobile);
                $data =$this->db->get();
                
                if($data->num_rows()<=0){
                    $this->session->set_flashdata('error','Entered Detail is Wrong');
                }else{
                    $this->session->set_flashdata('success','Your Password Reset Link Sent You Soon');
                    
                }
                redirect('forgot_password');
            }
        }
        $this->load->view('template/admin-template/login_header');
        $this->load->view('login/forgot_password');
        $this->load->view('template/admin-template/login_footer');
    }
    public function logout() {
        $user_data = $this->session->userdata('admin_session');
        $this->session->sess_destroy();
        // $this->session->unset_userdata($user_data);
        $this->session->unset_userdata('admin_session');
        redirect(base_url());
    }

    public function check_otp() {

        // if ($this->session->userdata('admin_session')) {
        //      $user_data = $this->session->userdata('admin_session');
        // if(isset($user_data->is_verified) && $user_data->is_verified == 1){
        //    redirect(base_url('admin/dashboard'));
        // }
        // }else{
        //   redirect(base_url());
        // }
        if ($this->input->post('submit')) {
          
            // $otp1 = $this->input->post('otp1');
            // $otp2 = $this->input->post('otp2');
            // $otp3 = $this->input->post('otp3');
            // $otp4 = $this->input->post('otp4');
            // $otp5 = $this->input->post('otp5');
            // $otp6 = $this->input->post('otp6');
          $otp = $this->input->post('otp1');
        // if($otp1!=""){
        //   $otp = "$otp1" . "$otp2" . "$otp3" . "$otp4" . "$otp5" . "$otp6";
  
        //     }
          // echo $otp;
          // exit;
            if ($otp == "") {
                $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Please enter otp', 'type' => 'danger'));
                redirect('admin/otp'); // 1
            } else {
                $result = $this->Custom_model->fetch_data('user', array('user.*','emp_role.role_name'), array('otp' => $otp), $joining = array('emp_role'=>'emp_role.id=user.role_id'));
                if (empty($result)) {
                    $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Wrong OTP', 'type' => 'danger'));
                    redirect('admin/otp'); // 2
                }else{
                    // $user_data = $this->session->userdata('admin_session');
                    // $id = $user_data->id;  
                    // $last_time = $this->Custom_model->fetch_data('user', array('*'), array('id' => $id)); 
                    // $last_login_time =$last_time[0]->last_login;
                    // $current_time = mdate('%Y-%m-%d %H:%i:%s', now());
                    $current_time = date("Y-m-d h:i:s");
                    $minutes = (strtotime($this->session->userdata('current_time')) - strtotime($current_time)) / 60;
                    //echo $minutes;die;
                    if($minutes>5){
                        $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Session Expire', 'type' => 'danger'));
                        redirect('admin/otp'); //3
                    }
                    $id = $result[0]->id;
                    $ins_data['otp'] = 0;
                    $ins_data['is_verified'] = 1;
                    $format = "%Y-%m-%d %h:%i %a";
                    $ins_data['last_login'] = mdate('%Y-%m-%d %H:%i:%s', now());
                    $ins_result = $this->Custom_model->edit_data_where($ins_data, array('id' => $id), "user");
                     
                     //26-05-2022
                     //=================
                     $log_at['user_id'] = $id;
                     $log_at['created_at'] = mdate('%Y-%m-%d %H:%i:%s', now());
                     $this->db->insert("fx_user_login_attempt",$log_at);
                     //=================
                    $login = $this->Custom_model->fetch_data('user', array('user_details.*','user.id as id','user.*','emp_role.role_name'), array('user.id' => $id), $joining = array('emp_role'=>'emp_role.id=user.role_id','user_details'=>'user_details.user_id=user.id'));
 
                     // $result = $this->Custom_model->fetch_data('user', 
                     //                array('user_details.*','user.id as id','user.*','emp_role.role_name'), 
                     //                array('user_name' => $user_name, 'password' => md5($password)),
                     //                $joining = array('emp_role'=>'emp_role.id=user.role_id','user_details'=>'user_details.user_id=user.id')
                     //            );
                    $this->session->set_userdata('admin_session', $login[0]);
                  
                  //if( $result[0]->role_name == 'Super Admin'){
                    redirect(base_url('admin/dashboard'));
                  //}  
                }
               }
            }
        $this->load->view('template/admin-template/login_header');
        $this->load->view('login/otp');
        $this->load->view('template/admin-template/login_footer');
    }


     public function forgot_pass() {
        if ($this->session->userdata('admin_session')) {
            $login = $this->session->userdata('admin_session');
            //echo $login->is_verified;
            
               redirect(base_url('admin/dashboard'));
           }
           

           if ($this->input->post('submit')) {
            $user_name = $this->input->post('user_name');
            $phone_no = $this->input->post('phone_no');
            $full_name = $this->input->post('full_name');
            $user_id = $this->input->post('user_id');
            $branch = $this->input->post('branch');
            

            if ($user_id == "") {
                $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Please enter User ID', 'type' => 'danger'));
            }else if ($branch == "") {
                $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Please Select Branch', 'type' => 'danger'));
            } else if ($phone_no == "") {
                $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Please enter phone number', 'type' => 'danger'));
            } else {
                $result = $this->Custom_model->check_forgot_pass($phone_no,$user_name,$full_name,$user_id,$branch);
                
                if (empty($result)) {
                    $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Email and phone number not match', 'type' => 'danger'));
                }else{
                    $results = $this->Custom_model->fetch_data('password_notification', 
                        array('password_notification.*'),array('status'=>'0','user_id'=>$result[0]->id));
                    if(!empty($results)){
                        $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Already Request Sent Your Query Will be Fix As Soon As Possible', 'type' => 'success'));
                    }else{
                        $u_data['user_id'] = $result[0]->id;
                        $u_data['user_name'] = $result[0]->user_name;
                        $u_data['email'] = $result[0]->email;
                        $u_data['emp_id'] = $result[0]->emp_id;
                        $u_data['u_password'] = $result[0]->u_password;
                        $u_data['phone_no'] = $result[0]->phone_no;
                        $u_data['center_id'] = $result[0]->center_id;
                        $u_data['profile_img'] = $result[0]->profile_img;
                        $u_data['status'] = '0';
                        $ins_user = $this->Custom_model->insert_data($u_data, "password_notification");
                        redirect(base_url('admin/thankyou'));
                    }
                }
           }
        }
        $center_list = $this->Custom_model->fetch_data("center",array('*'),array(), $joining = '', $search = '', $order = 'center_name', $by = 'ASC');
           $data['center_list'] = $center_list;
        $this->load->view('template/admin-template/login_header');
        $this->load->view('login/forgot_pass',$data);
        $this->load->view('template/admin-template/login_footer');
    }

    // public function insert(){
    //     $this->input->post('email');
    //     $this->input->post('password');
        
    //     $this->form_validation->set_rules('email', 'Email', 'required');
    //     $this->form_validation->set_rules('password', 'Password', 'required');
    //     if($this->form_validation->run()==false){
    //         echo json_encode(array('email'=>form_error('email'),'password'=>form_error('password')));
    //     }else{
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password'); 
    //         $this->db->select('*');
    //         $this->db->from('da_user');
    //         $this->db->where('email_id',$email);
    //         $this->db->where('password',MD5($password));
    //         $this->db->where('is_verified','1');
    //         $data = $this->db->get()->result_array();
            
    //         if(!empty($data)){
    //             $this->session->set_userdata('admin_session',$data);
    //             echo json_encode(array('is_success'=>'0','email'=>'','password'=>''));
    //         }else{
                
    //             echo json_encode(array('is_success'=>'1','email'=>'','password'=>'','message'=>'email or password is incorrect'));
    //         }
    //     }
    // }
    // public function thankyou_page() {
    //   $this->load->view('template/admin-template/login_header');
    //   $this->load->view('login/thank_you');
    //   $this->load->view('template/admin-template/login_footer');
    // }
}