<?php
class OtherController extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Other_model');
        if (!$this->session->userdata('admin_session')) {
            redirect(base_url());
        }
        $this->admin_session = $this->session->userdata('admin_session');
    }
    public function index() {

        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/other-side-menu','content'=>'setup/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_workshop(){
        if($this->input->post('submit')){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('workshop_name','Workshop Name','required');
            $this->form_validation->set_rules('speaker','Sperker','required');
            $this->form_validation->set_rules('workshop_topic','Workshop Topic','required');
            $this->form_validation->set_rules('date','Date','required');
            $this->form_validation->set_rules('time','Time','required');
            $this->form_validation->set_rules('meeting_link','Meeting Link','required');
            if($this->form_validation->run()==TRUE){
                $workshop_name = $this->input->post('workshop_name');
                $speaker = $this->input->post('speaker'); 
                $workshop_topic = $this->input->post('workshop_topic');
                $date = $this->input->post('date');
                $time = $this->input->post('time'); 
                $meeting_link = $this->input->post('meeting_link'); 
                
                $data = array(
                    'workshop_name'=>$workshop_name,
                    'speaker'=>$speaker,
                    'workshop_topic'=>$workshop_topic,
                    'date'=>$date,
                    'time'=>$time,
                    'meeting_link'=>$meeting_link,
                    'clinic_user_id'=>$this->admin_session->id,
                    'clinic_id'=>$this->admin_session->clinic_id
                    
                );
               $result = $this->Other_model->insert_data($data,'da_workshop');
                if($result!=false){
                    $this->session->set_flashdata('success','Workshop Added Successfully');
                }
                redirect('add_workshop');
            }
        }
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/other-side-menu','content'=>'other/add_workshop');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function edit_workshop(){
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/other-side-menu','content'=>'other/edit_workshop');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function workshop_videos(){
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/other-side-menu','content'=>'other/workshop_list');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);        
    }
    public function list_workshop_detail(){
        $draw='';
        $data = array();
        $result = $this->Other_model->get_workshop_list();
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                    $e->date,
                    $e->time,
                    $e->workshop_name,
                    $e->speaker,
                    $e->workshop_topic,
                    '<a href="'.base_url('edit_workshop_detail/').$e->id.'" class="edit btn btn-primary text-center">Edit</a>'
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
    public function edit_workshop_detail($id){
        if($this->input->post('submit')){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('workshop_name','Workshop Name','required');
            $this->form_validation->set_rules('speaker','Sperker','required');
            $this->form_validation->set_rules('workshop_topic','Workshop Topic','required');
            $this->form_validation->set_rules('date','Date','required');
            $this->form_validation->set_rules('time','Time','required');
            $this->form_validation->set_rules('meeting_link','Meeting Link','required');
            if($this->form_validation->run()==TRUE){
                $workshop_name = $this->input->post('workshop_name');
                $speaker = $this->input->post('speaker'); 
                $workshop_topic = $this->input->post('workshop_topic');
                $date = $this->input->post('date');
                $time = $this->input->post('time'); 
                $meeting_link = $this->input->post('meeting_link'); 
                
                $datas = array(
                    'workshop_name'=>$workshop_name,
                    'speaker'=>$speaker,
                    'workshop_topic'=>$workshop_topic,
                    'date'=>$date,
                    'time'=>$time,
                    'meeting_link'=>$meeting_link
                    
                );
            //    $results = $this->Other_model->insert_data($datas,'da_workshop');
            $results = $this->Other_model->edit_data_where($datas,array('id'=>$id),'da_workshop');
                if($results!=false){
                    $this->session->set_flashdata('success','Workshop Updated Successfully');
                    redirect('edit_workshop_detail/'.$id);
                }
            }
        }
        $result = $this->Other_model->get_workshop_list($id);
        $data['result'] = $result;
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/other-side-menu','content'=>'other/edit_workshop_detail');
        $this->template->load('template/gradient-able-template/admin-template',$template_part,$data);
    }
    public function list_workshop_videos(){
        $draw='';
        $data = array();
        $result = $this->Other_model->get_workshop_list();
        if(!empty($result)){
            foreach($result as $e){
                $data[]=array(
                    $e->date,
                    $e->time,
                    $e->workshop_name,
                    $e->speaker,
                    $e->workshop_topic,
                    '<a href="#" id="play_video" class="play_video">Play</a>'
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
}
