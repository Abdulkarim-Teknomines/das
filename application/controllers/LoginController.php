<?php
class LoginController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
  }

  public function user_login() {
    // if ($this->session->userdata('admin_session')) {
    //   redirect(base_url('dashboard'));
    // }
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
        if ($this->session->userdata('admin_session')) {
            redirect(base_url('dashboard'));
          }
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
        $this->session->unset_userdata('admin_session');
        redirect(base_url());
    }

    
}