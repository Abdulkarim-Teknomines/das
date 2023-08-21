<?php
class TreatmentController extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Custom_model');
    }
    public function index() {
        $template_part = array('top_menu' => 'template/gradient-able-template/top-menu','side_menu'=>'template/gradient-able-template/side-menu/treatment-side-menu','content'=>'setup/empty_tab');
        $this->template->load('template/gradient-able-template/admin-template',$template_part);
    }
}
