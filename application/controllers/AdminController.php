<?php
class AdminController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
    if (!$this->session->userdata('admin_session')) {
      redirect(base_url());
    }    
  }

    public function dashboard() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/dashboard-side-menu', 'content' => 'admin/dashboard');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function profile(){
      if($this->input->post('submit')){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email_id','Email','required|valid_email');
        $this->form_validation->set_rules('user_id','User ID','required');
        $this->form_validation->set_rules('full_name','Full Name','required');
        $this->form_validation->set_rules('mobile_number','Mobile Number','required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('address','Address','required');
        if($this->form_validation->run()==TRUE){
            $id = $this->input->post('id');
            $email = $this->input->post('email_id');
            $user_id = $this->input->post('user_id'); 
            $full_name = $this->input->post('full_name'); 
            $mobile_number = $this->input->post('mobile_number'); 
            $address = $this->input->post('address'); 
            $datas = array(
              'email_id'=>$email,
              'user_id'=>$user_id,
              'full_name'=>$full_name,
              'mobile_number'=>$mobile_number,
              'address'=>$address
            );
            
            $result = $this->Custom_model->edit_data_where($datas,array('id'=>$id),'da_clinic_user');
            // echo $this->db->last_query();die;
            if($result!=false){
                $this->session->set_flashdata('success','User Updated Successfully');
            }
            redirect('profile');
        }
      }
      $this->db->select('*');
      $this->db->from('da_clinic_user');
      $results = $this->db->get()->row();
      $data['result']= $results;
      
      $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/dashboard-side-menu', 'content' => 'admin/profile');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);  
    }
    public function settings(){
      if($this->input->post('submit')){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('old_password','Old  Password','required');
        $this->form_validation->set_rules('new_password','New Password','required');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[new_password]');
        
        if($this->form_validation->run()==TRUE){
            $id = $this->input->post('id');
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');
            $datas = array(
              'password'=>MD5($new_password),
              'u_password'=>$new_password,
            );
            
            $result = $this->Custom_model->edit_data_where($datas,array('id'=>$id,'password'=>MD5($old_password)),'da_clinic_user');
            // echo $this->db->last_query();die;
            // echo $this->db->last_query();die;
            if($result!=false){
                $this->session->set_flashdata('success','Password Changed Successfully');
            }else{
              
              $this->session->set_flashdata('error','Password Incorrect');
            }
            redirect('settings');
        }
      }
      $this->db->select('*');
      $this->db->from('da_clinic_user');
      $results = $this->db->get()->row();
      $data['result']= $results;
      $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/dashboard-side-menu', 'content' => 'admin/settings');
      $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);        
    }
}
