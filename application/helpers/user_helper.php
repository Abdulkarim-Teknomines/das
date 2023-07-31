<?php
   
	function checkUserAccess(){
	    $CI = &get_instance(); 
	    $session = $CI->session->userdata('admin_session');
	    $CI->load->model('custom_model');	    
	        
	    $url_segment =   explode("/",$_SERVER['REQUEST_URI']);

        if (in_array("lead_dashboard", $url_segment)) {
            if($session->role_name != 'Super Admin'){
                redirect();
            }
        }
	            
	}




?>