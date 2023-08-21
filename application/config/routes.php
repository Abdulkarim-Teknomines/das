<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/ 
$route['default_controller'] = 'LoginController/user_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard']= 'AdminController/dashboard';
$route['patient'] = 'PatientController/index';
$route['appointment'] = 'AppointmentController/index';
$route['clinical_examinations'] = 'ClinicalExaminationController/index';
$route['education_videos'] = 'EducationVideosController/index';
$route['lab_details'] = 'LabDetailsController/index';
$route['other'] = 'OtherController/index';
$route['setup'] = 'SetupController/index';
$route['treatment'] = 'TreatmentController/index';
$route['register'] ='LoginController/signup';
$route['logout']= 'LoginController/logout';
$route['forgot_password'] = 'LoginController/forgot_password';
$route['add_clinic'] = 'SetupController/add_clinic';
$route['view_clinic'] = 'SetupController/view_clinic';
$route['edit_clinic/(:any)'] = 'SetupController/edit_clinic/$1';
$route['add_user'] ='SetupController/add_user';
$route['edit_user/(:any)'] ='SetupController/edit_user/$1';
$route['view_user'] ='SetupController/view_user';
$route['add_treatment_plan'] = 'SetupController/add_treatment_plan';
$route['edit_treatment_plan/(:any)'] = 'SetupController/edit_treatment_plan/$1';
$route['view_treatment_plan'] = 'SetupController/view_treatment_plan';
$route['add_medicine'] = 'SetupController/add_medicine';
// $route['view_medicine'] = 'SetupController/view_medicine';
$route['edit_medicine/(:any)'] = 'SetupController/edit_medicine/$1';
$route['view_medicine'] = 'SetupController/view_medicine';
$route['add_video'] = 'SetupController/add_video';
$route['edit_video/(:any)'] = 'SetupController/edit_video/$1';
$route['view_video'] = 'SetupController/view_video';

$route['add_workshop'] = 'OtherController/add_workshop';
$route['edit_workshop'] = 'OtherController/edit_workshop';
$route['workshop_videos'] = 'OtherController/workshop_videos';

$route['edit_workshop_detail/(:any)'] = 'OtherController/edit_workshop_detail/$1';
$route['add_patient']= 'PatientController/add_patient';
$route['search_patient']= 'PatientController/search_patient';
$route['add_more_details'] = 'PatientController/add_more_details';
$route['edit_patient'] = 'PatientController/edit_patient';

$route['medical_history'] = 'ClinicalExaminationController/medical_history';
$route['dental_history'] = 'ClinicalExaminationController/dental_history';
$route['clinical_examinator'] = 'ClinicalExaminationController/clinical_examinator';
$route['investigation'] = 'ClinicalExaminationController/investigation';
$route['diagnosis'] = 'ClinicalExaminationController/diagnosis';
$route['treatment_plan'] = 'ClinicalExaminationController/treatment_plan';
$route['treatment_charges'] = 'ClinicalExaminationController/treatment_charges';

$route['schedule_appointment'] = 'AppointmentController/schedule_appointment';
$route['edit_appointment'] = 'AppointmentController/edit_appointment';
$route['future_appointment'] = 'AppointmentController/future_appointment';
$route['appointment_history'] = 'AppointmentController/appointment_history';