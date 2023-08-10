<?php
class SetupController extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Custom_model');
        if (!$this->session->userdata('admin_session')) {
            redirect(base_url());
        }
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
    public function view_clinic(){
        
        
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/clinic/view_clinic');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function view_medicine(){
        
        
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/medicine/view_medicine');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function view_treatment_plan(){
        
        
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/treatment_plan/view_treatment_plan');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function view_user(){
        
        
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/user/view_user');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function view_video(){
        
        
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/videos/view_videos');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_user(){
        if (!$this->session->userdata('admin_session')) {
               redirect(base_url());
           }
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
                    'clinic_id'=>$clinic_name,
                    'user_id'=>$user_id,
                    'password'=>MD5($password),
                    'u_password'=>$password,
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
        
        $clinic = $this->Custom_model->get_clinic();
        $data['clinic']=$clinic;

        $roles = $this->Custom_model->get_roles();
        $data['roles'] = $roles;

        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/user/add_user');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function add_treatment_plan(){
        
     if($this->input->post('submit')){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('treatment_plan','Treatment Plan','required');
        $this->form_validation->set_rules('price','Price','required');
         
        if($this->form_validation->run()==TRUE){
            $treatment_plan = $this->input->post('treatment_plan');
            $price = $this->input->post('price'); 
            $data = array(
                'treatment_plan'=>$treatment_plan,
                'price'=>$price,
            );
        $result = $this->Custom_model->insert_data($data,'da_treatment_plan');
            if($result!=false){
                $this->session->set_flashdata('success','Treatment Plan Added Successfully');
            }
            redirect('add_treatment_plan');
        }
     }
     $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/treatment_plan/add_treatment_plan');
     $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_medicine(){
        
     if($this->input->post('submit')){
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         $this->form_validation->set_rules('medicine_type_id','Medicine Type','required');
         $this->form_validation->set_rules('medicine_name','Medicine Name','required');
         
         if($this->form_validation->run()==TRUE){
             $medicine_type_id = $this->input->post('medicine_type_id');
             $name = $this->input->post('medicine_name'); 
             $data = array(
                 'medicine_type_id'=>$medicine_type_id,
                 'medicine_name'=>$name,
             );
            $result = $this->Custom_model->insert_data($data,'da_medicine');
             if($result!=false){
                 $this->session->set_flashdata('success','Medicine Added Successfully');
             }
             redirect('add_medicine');
         }
     }
    
    $medicine_type = $this->Custom_model->get_medicine_type();
    $data['medicine_type'] = $medicine_type;
     $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/medicine/add_medicine');
     $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function add_video(){
        
     if($this->input->post('submit')){
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         $this->form_validation->set_rules('video_description','Video Description','required');
         $this->form_validation->set_rules('video_link','Video Link','required');
         
         if($this->form_validation->run()==TRUE){
             $video_description = $this->input->post('video_description');
             $video_link = $this->input->post('video_link'); 
             $data = array(
                 'video_description'=>$video_description,
                 'video_link'=>$video_link,
             );
            $result = $this->Custom_model->insert_data($data,'da_videos');
             if($result!=false){
                 $this->session->set_flashdata('success','Video Added Successfully');

             }
             redirect('add_video');
         }
     }
     $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/videos/add_video');
     $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function view_clinic_details(){
        $draw='';
        $data = array();
        $result = $this->Custom_model->get_clinic(FALSE);
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                $e->clinic_name,
                '<img src="'.base_url('upload/clinic_logo/').$e->logo.'" style="width:50px;height:50px;"></img>',
                $e->address,
                $e->email,
                $e->landline_number,
                $e->mobile_number,
                $e->appointment_number,
                $e->website,
                $e->payment,
                '<img src="'.base_url('upload/qr_code/').$e->qr_code.'" style="width:50px;height:50px;"></img>',
                '<a href="'.base_url('edit_clinic/').$e->id.'" class="edit btn btn-primary text-center">Edit</a>'
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
    
    public function view_medicine_detail(){
        $draw='';
        $data = array();
        // $this->db->select('*');
        // $this->db->join('da_medicine_type','da_medicine_type.id=da_medicine.medicine_type_id');
        // $this->db->from('da_medicine');
        // $result = $this->db->get()->result();
        $result = $this->Custom_model->get_medicine(FALSE);
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                $e->name,
                $e->medicine_name,
                '<a href="'.base_url('edit_medicine/').$e->id.'" class="edit btn btn-primary text-center">Edit</a>'
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
    public function view_video_detail(){
        $draw='';
        $data = array();
        
        $result = $this->Custom_model->get_video();
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                $e->video_description,
                $e->video_link,
                '<a href="'.base_url('edit_video/').$e->id.'" class="edit btn btn-primary text-center">Edit</a>'
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
    public function view_user_detail(){
        $draw='';
        $data = array();
        
        $result = $this->Custom_model->get_user(FALSE);
        
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                $e->clinic_name,
                $e->user_id,
                $e->full_name,
                $e->mobile_number,
                $e->address,
                $e->email_id,
                $e->name,
                '<a href="'.base_url('edit_user/').$e->id.'" class="edit btn btn-primary text-center">Edit</a>'
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
    public function view_treatment_plan_detail(){
        $draw='';
        $data = array();
        
        $result = $this->Custom_model->get_treatment_plan();
        
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                $e->treatment_plan,
                $e->price,
                '<a href="'.base_url('edit_treatment_plan/').$e->id.'" class="edit btn btn-primary text-center">Edit</a>'
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
    public function edit_clinic($id){
        $clinic_id= $id;
        
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
                $old_clinic_logo = $this->input->post('old_clinic_logo');
                $old_qr_code = $this->input->post('old_qr_code');
                if (!empty($_FILES['clinic_logo']) && $_FILES["clinic_logo"]['name'] != "") {
                    $uploaddir = 'upload/clinic_logo/';
                    
                    $new_file_name = str_replace(" ", "_", rand(1111,9999)."_".time() . $_FILES['clinic_logo']['name']);
                    $uploadfile = $uploaddir . $new_file_name;

                    if (move_uploaded_file($_FILES['clinic_logo']['tmp_name'], $uploadfile)) {
                      $clinic_logo = $new_file_name;
                      unlink('upload/clinic_logo/'.$old_clinic_logo);
                    } else {
                      $clinic_logo = $old_clinic_logo;
                    }
                }else{
                    $clinic_logo = $old_clinic_logo;
                }
                  if (!empty($_FILES['qr_code']) && $_FILES["qr_code"]['name'] != "") {
                    $uploaddir = 'upload/qr_code/';
                    $new_file_name = str_replace(" ", "_", rand(1111,9999)."_".time() . $_FILES['qr_code']['name']);
                    $uploadfile = $uploaddir . $new_file_name;
                    if (move_uploaded_file($_FILES['qr_code']['tmp_name'], $uploadfile)) {
                      $qr_code = $new_file_name;
                      unlink('upload/qr_code/'.$old_qr_code);
                    } else {
                      $qr_code = $old_qr_code;
                    }
                  }else{
                    $qr_code = $old_qr_code;
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
               $result = $this->Custom_model->edit_data_where($data,array('id'=>$clinic_id),'da_clinic');
                if($result!=false){
                    $this->session->set_flashdata('success','Clinic Updated Successfully');
                }
                redirect('edit_clinic/'.$clinic_id);
            }
        }
        $result = $this->Custom_model->get_clinic($clinic_id);
        $data['result'] = $result;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/clinic/edit_clinic');
     $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function edit_user($id){
        $clinic_user_id= $id;
        
        
        
        if($this->input->post('submit')){
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('clinic_name','Clinic Name','required');
            $this->form_validation->set_rules('user_id','User ID','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
            $this->form_validation->set_rules('full_name','Full Name','required');
            $this->form_validation->set_rules('mobile_number','Mobile Number','required|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('address','Address','required');
            $this->form_validation->set_rules('email_id','Email ID','required|valid_email');
            $this->form_validation->set_rules('role_id','Role','required');
            if($this->form_validation->run()==TRUE){
                $clinic_name = $this->input->post('clinic_name');
                $user_id = $this->input->post('user_id'); 
                $password = $this->input->post('password');
                $full_name = $this->input->post('full_name'); 
                $mobile_number = $this->input->post('mobile_number');
                $address = $this->input->post('address'); 
                $email_id = $this->input->post('email_id');
                $role_id = $this->input->post('role_id');
                $datas = array(
                    'clinic_id'=>$clinic_name,
                    'user_id'=>$user_id,
                    'password'=>MD5($password),
                    'u_password'=>$password,
                    'full_name'=>$full_name,
                    'mobile_number'=>$mobile_number,
                    'address'=>$address,
                    'email_id'=>$email_id,
                    'role_id'=>$role_id
                );
                $results = $this->Custom_model->edit_data_where($datas,array('id'=>$clinic_user_id),'da_clinic_user');
                if($results!=false){
                    $this->session->set_flashdata('success','User Updated Successfully');

                    redirect('edit_user/'.$clinic_user_id);
                }
            }
        }
        
        $clinic = $this->Custom_model->get_clinic();
        $data['clinic']=$clinic;

        $roles = $this->Custom_model->get_roles();
        $data['roles'] = $roles;

        $result = $this->Custom_model->get_user($clinic_user_id);
        
        $data['result'] = $result;
        
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/user/edit_user');
     $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function edit_treatment_plan($id){
        
     if($this->input->post('submit')){
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         $this->form_validation->set_rules('treatment_plan','Treatment Plan','required');
         $this->form_validation->set_rules('price','Price','required');
         
         if($this->form_validation->run()==TRUE){
             $treatment_plan = $this->input->post('treatment_plan');
             $price = $this->input->post('price'); 
             $datas = array(
                 'treatment_plan'=>$treatment_plan,
                 'price'=>$price,
             );
            
            $results = $this->Custom_model->edit_data_where($datas,array('id'=>$id),'da_treatment_plan');
             if($results!=false){
                 $this->session->set_flashdata('success','Treatment Plan Updated Successfully');
                 redirect('edit_treatment_plan/'.$id);
             }
             
         }
     }
     $result = $this->Custom_model->get_treatment_plan($id);
     $data['result'] = $result;
     $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/treatment_plan/edit_treatment_plan');
     $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function edit_medicine($id){
        
     if($this->input->post('submit')){
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         $this->form_validation->set_rules('medicine_type_id','Medicine Type','required');
         $this->form_validation->set_rules('medicine_name','Medicine Name','required');
         
         if($this->form_validation->run()==TRUE){
             $medicine_type_id = $this->input->post('medicine_type_id');
             $name = $this->input->post('medicine_name'); 
             $datas = array(
                 'medicine_type_id'=>$medicine_type_id,
                 'medicine_name'=>$name,
             );
            // $result = $this->Custom_model->insert_data($data,'da_medicine');
            $results = $this->Custom_model->edit_data_where($datas,array('id'=>$id),'da_medicine');
             if($results!=false){
                 $this->session->set_flashdata('success','Medicine Updated Successfully');
                 redirect('edit_medicine/'.$id);
             }
         }
     }
    
    $medicine_type = $this->Custom_model->get_medicine_type();

    $data['medicine_type'] = $medicine_type;
    $result = $this->Custom_model->get_medicine($id);
     $data['result']= $result;
     $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/medicine/edit_medicine');
     $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function edit_video($id){
        
     if($this->input->post('submit')){
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         $this->form_validation->set_rules('video_description','Video Description','required');
         $this->form_validation->set_rules('video_link','Video Link','required');
         
         if($this->form_validation->run()==TRUE){
             $video_description = $this->input->post('video_description');
             $video_link = $this->input->post('video_link'); 
             $datas = array(
                 'video_description'=>$video_description,
                 'video_link'=>$video_link,
             );
            
            $results = $this->Custom_model->edit_data_where($datas,array('id'=>$id),'da_videos');
             if($results!=false){
                 $this->session->set_flashdata('success','Video Updated Successfully');

             }
             redirect('edit_video/'.$id);
         }
     }
     $result = $this->Custom_model->get_video($id);
     $data['result'] =$result;
     
     $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/setup-side-menu','content'=>'setup/videos/edit_video');
     $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
}
