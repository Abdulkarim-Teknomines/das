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
if ( ! function_exists('month'))
{ 
    function month()
    {
        $data = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
        return $data;
    } 
}
if ( ! function_exists('year'))
{ 
    function year()
    {
        for($i=2023; $i<=2040; $i++){
            $data[] = $i;

        }
        
        return $data;
    } 
}