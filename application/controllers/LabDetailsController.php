<?php
class LabDetailsController extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Custom_model');
  }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/lab-details-side-menu','content'=>'patient/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
  public function patient_selection(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/lab-details-side-menu','content'=>'lab_details/patient_selection');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function type_of_work(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/lab-details-side-menu','content'=>'lab_details/type_of_work');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function lab_address(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/lab-details-side-menu','content'=>'lab_details/lab_address');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function location(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/lab-details-side-menu','content'=>'lab_details/location');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
  public function lab_charges(){
    $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/lab-details-side-menu','content'=>'lab_details/lab_charges');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
  }
}
