<?php
class LoginController extends MY_Controller {
  public function __construct() {
      parent::__construct();
      $this->load->model('Custom_model');
  }

  public function user_login() {
    if ($this->session->userdata('admin_session')) {
        $login = $this->session->userdata('admin_session');
        if(isset($login->is_verified) && $login->is_verified == 1){
           redirect(base_url('admin/dashboard'));
        }
       }
    
    if ($this->input->post('login')) {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        if ($user_name == "") {
            $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Please enter user name', 'type' => 'danger'));
            redirect();
        } else if ($password == "") {
            $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Please enter password', 'type' => 'danger'));
            redirect();
        }else{
            
            $results = $this->db->query('select fx_user_details.*,fx_user.id as id,fx_user.*,fx_emp_role.role_name,fx_center.lead_status as lead_status,fx_center.sales_status as sales_status,fx_center.acadamics_status as acadamics_status,fx_center.examinations_status as examinations_status,fx_center.logistics_status as logistics_status,fx_center.expenditure_status as expenditure_status,fx_center.enrollment_date_status as enrollment_date_status,fx_center.registration_date_status as registration_date_status,fx_center.regular_collection_date_status,fx_center.other_collection_date_status from fx_user 
                left join fx_emp_role on fx_emp_role.id=fx_user.role_id
                left join fx_user_details on fx_user_details.user_id=fx_user.id
                left join fx_center on fx_center.id=fx_user_details.center_id
                where BINARY user_name="'.$user_name.'" AND password="'.MD5($password).'"');
            $result = $results->result();
            
            if (empty($result)) {
                $this->session->set_flashdata('dismiss_flash_message', array('message' => 'Wrong username or password', 'type' => 'danger'));
                redirect();
            }else{
                $id = $result[0]->id;
                
                    $format = "%Y-%m-%d %h:%i %a";
                    $ins_data['last_login'] = mdate('%Y-%m-%d %H:%i:%s', now());
                    $ins_result = $this->Custom_model->edit_data_where($ins_data, array('id' => $id), "user");
                    $log_at['user_id'] = $result[0]->id;
                    $log_at['created_at'] = mdate('%Y-%m-%d %H:%i:%s', now());
                    $this->db->insert("fx_user_login_attempt",$log_at);
                      $this->session->set_userdata('admin_session', $result[0]);
                      redirect(base_url('admin/dashboard'));
                      
            }
          }
        }
      $this->load->view('template/admin-template/login_header');
      $this->load->view('login/login');
      $this->load->view('template/admin-template/login_footer');
    }

    public function resend_otp() {
      $user_data = $this->session->userdata('admin_session');
      $id = $user_data->id;  
      $otp = substr(number_format(time() * rand(),0,'',''),0,6);
      $ins_data['otp'] = $otp;
      //$format = "%Y-%m-%d %h:%i %a";
      $ins_data['last_login'] = mdate('%Y-%m-%d %H:%i:%s', now());
      $ins_result = $this->Custom_model->edit_data_where($ins_data, array('id' => $id), "user");
      $otp_val = $this->Custom_model->fetch_data('user', array('*'), array('id' => $id)); 
      $otp = $otp_val[0]->otp;
      $sms_api_list = $this->custom_model->fetch_data("sms_api",array('*'),array('is_delete'=>0), $joining = '', $search = '', $order = '', $by = '');
      if(!empty($sms_api_list)){
        //request parameters array
          $api_username = trim($sms_api_list[0]->username);
          $api_password = trim($sms_api_list[0]->password);
          $apiUrl = trim($sms_api_list[0]->api_url);
          if(substr($apiUrl, -1)=='?'){
            $apiUrl = $apiUrl;
          }else{
            $apiUrl = $apiUrl.'?';
          }
        $requestParams = array(
            'username' => $api_username,
            'password' => $api_password,
            'from' => 'FXANIM',
            'to' => $otp_val[0]->phone_no,
            'text' => 'Hi '.$otp_val[0]->fname.'! '.$otp.' code is your Fx Portal verification code. FX ANIMATION',
            'coding' => 0,
            //'flash'=>1
            'template_id' => '1007298760095965226',
            'pe_id' => '1201159204813014014'
        );

        //merge API url and parameters
        // $apiUrl = "http://49.50.67.32/smsapi/httpapi.jsp?";
        foreach($requestParams as $key => $val){
            $apiUrl .= $key.'='.urlencode($val).'&';
        }

        $apiUrl = rtrim($apiUrl, "&");
        //API call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
      }   
        redirect(base_url('admin/otp')); //5
    }


    public function logout() {
        $user_data = $this->session->userdata('admin_session');
        $id = $user_data->id ;
        $ins_data['is_verified'] = 0;
        $ins_result = $this->Custom_model->edit_data_where($ins_data, array('id' => $id), "user");
        $this->session->sess_destroy();
        $this->session->unset_userdata($user_data);
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
            if($login->is_verified == 1){
               redirect(base_url('admin/dashboard'));
            }
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


     public function thankyou_page() {
   
      $this->load->view('template/admin-template/login_header');
      $this->load->view('login/thank_you');
      $this->load->view('template/admin-template/login_footer');
     }
}
