<?php
/*



 * To change this license header, choose License Headers in Project Properties.



 * To change this template file, choose Tools | Templates



 * and open the template in the editor.



 */







function pr($data) {



    $CI = &get_instance();



    if ($CI->config->item('custom_debug')) {



        echo '<pre>';



        print_r($data);



        echo '</pre>';



    }



}







/*



 * message, type (success, info, warning, danger)



 */







function display_message($flash_data, $type = 'info') {



    $CI = &get_instance();



    $err_msg = $CI->session->flashdata($flash_data);



    if ($err_msg) {



        echo "<div class='alert alert-{$type}'>$err_msg</div>";



    }



}







/*



 * message, type (success, info, warning, danger)



 */







function display_dismiss_message_old($flash_data, $type = 'info') {



    $CI = &get_instance();



    $alert_msg = $CI->session->flashdata($flash_data);



    if ($alert_msg) {



        echo "<div class='alert alert-{$type} alert-dismissable'>



            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$alert_msg</div>";



    }



}







function display_dismiss_message($flash_data) {



    $CI = &get_instance();



    $dismiss_flash_message = $CI->session->flashdata($flash_data);



    if (is_array($dismiss_flash_message)) {



        $type = @$dismiss_flash_message['type'];



        if (!in_array($type, array('success', 'info', 'warning', 'danger')))



            $type = 'info';







        $dismiss_message = @$dismiss_flash_message['message'];



    } else {



        $type = 'info';



        $dismiss_message = $dismiss_flash_message;



    }



    //pr($alert_msg); exit;











    if ($dismiss_message) {



        echo "<div class='alert alert-{$type} alert-dismissable'>



            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$dismiss_message</div>";



    }



}







function key_value_pair($data, $key = 'meta_key', $value = 'meta_value', $merge_first = array()) {



    $meta_array = array();



    if (!$data) {



        return $data;



    }



    if ($merge_first) {



        $meta_array = array_merge($meta_array, $merge_first);



    }



    foreach ($data as $meta) {



        $meta_array[$meta[$key]] = $meta[$value];



    }



    return $meta_array;



}







function field_input($key) {



    return isset($_REQUEST[$key]) ? $_REQUEST[$key] : '';



}







function db_like($field = '') {



    return '%' . $field . '%';



}







function show_year_list($min = 1990, $max = 2050) {



    $year_arr = array();



    for ($i = $min; $i <= $max; $i++) {



        $year_arr[$i] = $i;



    }



    return $year_arr;



}







function request($key = '', $required = false, $default = NULL) {







    if (is_array($key) && $key) {



        foreach ($key as $key_name) {



            $data[$key] = (isset($_REQUEST[$key_name])) ? $_REQUEST[$key_name] : false;



        }



        return $data;



    }







    if ($required && (!isset($_REQUEST[$key]) || empty($_REQUEST[$key]) )) {



        _die("{$key} field is required field.");



    }







//    if (!is_null($default)) {



    if (!is_null($default) && empty($_REQUEST[$key])) {



        $_REQUEST[$key] = $default;



    }



    return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : '';



}







function _die($data = array()) {







    $data_array = array();







    $response['result'] = false;







    if (!is_array($data)) {



        $data_array['msg'] = $data;



    } else {



        $data_array = $data;



    }







    $response = array_merge($response, $data_array);



    $response = json_encode($response);







//    header("Access-Control-Allow-Credentials: true");



//    header('Access-Control-Allow-Origin: *');



//    header('Access-Control-Expose-Headers: Access-Control-Allow-Origin');



//    header('Content-Type: application/json');



    die($response);



}















function escapeJsonString($value) { //added by barun



    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");



    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");



    $result = str_replace($escapers, $replacements, $value);



    return $result;



}











function get_all_category(){



           



    $CI = get_instance();







        



    $CI->load->model('Custom_model');







    



    $category_list = $CI->Custom_model->fetch_data("fd_floor_category",array('id','name'),array('is_tag_category'=>0));



    return $category_list;



}







function textboxDisplay($label,$val){



    $return_value = '<div class="form-group">



						  <label><strong>'.$label.'</strong></label><br/>



						  '.$val.' 



						</div>';



    return $return_value;



}



function dropsownDisplay($label,$val,$arr){



    



    $return_value = '<div class="form-group">



						  <label><strong>'.$label.'</strong></label><br/>



						  '.$arr[$val].' 



						</div>';



    return $return_value;



}







?>