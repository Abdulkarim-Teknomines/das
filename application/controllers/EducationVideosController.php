<?php
class EducationVideosController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Patient_model');
    $this->load->model('Custom_model');
    if (!$this->session->userdata('admin_session')) {
        redirect(base_url());
    }
    $this->admin_session = $this->session->userdata('admin_session');
  }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/education-videos-side-menu','content'=>'setup/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function add_videos(){
      $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/education-videos-side-menu','content'=>'education_videos/add_videos');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function save_videos(){
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('video_title','Video Title','required');
        $this->form_validation->set_rules('video_description','Video Description','required');
        $this->form_validation->set_rules('video_link','Video Link','required|callback_valid_url');

        if($this->form_validation->run()){
          $video_title = $this->input->post('video_title');
          $video_description = $this->input->post('video_description');
          $video_link = $this->input->post('video_link');
          $data_array = array(
            'video_title'=>$video_title,
            'video_description'=>$video_description,
            'video_link'=>$video_link,
            'clinic_user_id'=>$this->admin_session->id,
            'clinic_id'=>$this->admin_session->clinic_id
          );
          $result = $this->Custom_model->insert_data($data_array,'da_education_videos');
          if($result!=false){
              $data=array('status'=>'success','message'=>'Video Added Succesfully');
          }
        }else{
          foreach($_POST as $key=>$value){
              $data['message'][$key]=form_error($key);
          }
        }
        echo json_encode($data);
    }
    public function list_videos(){
      $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/education-videos-side-menu','content'=>'education_videos/list_videos');
      $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
    public function list_videos_details(){
      $draw='';
      $data = array();
      $result = $this->Custom_model->list_video_details();
      
      if(!empty($result)){
          foreach($result as $e){
            $data[]=array(
              $e->video_title,
              $e->video_description,
              '<img width="210" height="105" id="video_image" src="'.base_url().'upload/video_image/'.$e->thumbnail_image.'"></img>',
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
  public function valid_url($str)
  {
    return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
  }
}
