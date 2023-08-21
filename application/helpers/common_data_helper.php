<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('blood_group'))
{ 
    function blood_group()
    {
    	$data = array('A +ve','A -ve','B +ve','B -ve','O +ve','O -ve','AB +ve','AB -ve');
        return $data;
    }
}
if ( ! function_exists('gender'))
{ 
    function gender()
    {
        $data = array('Male','Female','Other');
        return $data;
    } 
}