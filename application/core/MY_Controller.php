<?php





/*


 * To change this license header, choose License Headers in Project Properties.


 * To change this template file, choose Tools | Templates


 * and open the template in the editor.


 */





//error_reporting(0);





class MY_Controller extends CI_Controller {





    //public $site_meta = array();


    //public $site_meta = array();





    public function __construct() {


        parent::__construct();


        //$site_meta = $this->Model_general->get_site_meta();


        //$this->site_meta = key_value_pair($site_meta);


    }





    public function required_sa_privilege() {


        $su_admin_session = @$this->session->userdata['su_admin_session'];


        $has_sa_privilege = isset($su_admin_session) ? true : false;


        if (!$has_sa_privilege) {


            $this->session->set_flashdata('err_login', 'You are not authorized to access this page !!!');


            redirect('admin');


        }


    }





    public function required_ins_privilege() {


        $ins_session = @$this->session->userdata['inspector_session'];


        $has_ins_privilege = isset($ins_session) ? true : false;


        if (!$has_ins_privilege) {


            $this->session->set_flashdata('err_login', 'You are not authorized to access this page !!!');


            redirect('admin');


        }


    }





    public function required_frn_privilege() {


        $frn_session = @$this->session->userdata['franchise_session'];


        $has_ins_privilege = isset($frn_session) ? true : false;


        if (!$has_ins_privilege) {


            $this->session->set_flashdata('err_login', 'You are not authorized to access this page !!!');


            redirect('admin');


        }


    }





    public function required_rtl_privilege() {


        $rtl_session = @$this->session->userdata['retailer_session'];


        $has_rtl_privilege = isset($rtl_session) ? true : false;


        if (!$has_rtl_privilege) {


            $this->session->set_flashdata('err_login', 'You are not authorized to access this page !!!');


            redirect('admin');


        }


    }





    // 


    // 


    // </editor-fold>


}


