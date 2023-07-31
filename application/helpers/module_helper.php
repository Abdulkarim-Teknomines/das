<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('menu_array'))
{ 
    function menu_array()
    {
    	$CI = &get_instance();
    	$CI->load->library('session');
    	$data = array();
    	$admin_sessions = $CI->session->userdata('admin_session');

    	if($admin_sessions->role_id=="1"){  //Super Admin
    		$data = array('Leads','Sales','Acadamics','Examinations','Employee Management','Logistics','Reports','Jobs','Expenditures','Other','Students Porfolio','Notifications');
    	}else if($admin_sessions->role_id =='2'){  //Center Manager
    		$data = array('Leads','Sales','Acadamics','Examinations','Employee Management','Reports','Jobs','Expenditures','Other','Logistics','Notifications');
    	}else if($admin_sessions->role_id =='3'){ //Receptionist
    		$data = array('Leads','Sales','Acadamics','Examinations','Expenditures','Other','Employee Management');
    	}else if($admin_sessions->role_id =='4'){  //Accountant
    		$data = array('Sales','Acadamics','Expenditures','Other','Employee Management');
    	}else if($admin_sessions->role_id =='5'){  //Lab Incharge
    		$data = array('System','Lab Inventory','Employee Management');
    	}else if($admin_sessions->role_id =='6'){  //Counsellor
    		$data = array('Leads','Sales','Employee Management');
    	}else if($admin_sessions->role_id =='7'){  //Telecaller
    		$data = array('Leads','Sales','Employee Management');
    	}else if($admin_sessions->role_id =='8'){  //Marketing Manager
    		$data = array('Leads','Sales','Marketing Activities','College Data','Employee Management');
    	}else if($admin_sessions->role_id =='9'){  //Marketing Executive
    		$data = array('Leads','Sales','Marketing Activities','College Data','Employee Management');
    	}else if($admin_sessions->role_id =='10'){  //Center Academic Head
    		$data = array('Sales','Acadamics','Examinations','Employee Management','Jobs','Logistics','Other','Students Porfolio','Notifications');
    	}else if($admin_sessions->role_id =='11'){  //Faculty
    		$data = array('Sales','Acadamics','Examinations','Employee Management','Students Porfolio','Notifications');
    	}else if($admin_sessions->role_id =='12'){  //Placement Officer
    		$data = array('Jobs','Placements','Sales','Acadamics','Employee Management');
    	}else if($admin_sessions->role_id =='13'){  //Zonal Sales
    		$data = array('Sales','Employee Management','Other');
    	}else if($admin_sessions->role_id =='14'){  //Regional Sales
            $data = array('Sales','Employee Management','Other');
        }else if($admin_sessions->role_id =='15'){  //Zonal Acads
            $data = array('Sales','Acadamics','Examinations','Employee Management','Logistics','Jobs','Logistics','Other');
        }else if($admin_sessions->role_id =='16'){  //Regional Acads
            $data = array('Sales','Acadamics','Examinations','Employee Management','Logistics','Jobs','Logistics','Other');
        }else if($admin_sessions->role_id =='17'){  //Accounts
            $data = array('Accounts','Sales','Acadamics','Employee Management');
        }else if($admin_sessions->role_id =='18'){  //Exam Cell Team
            $data = array('Sales','Acadamics','Examinations','Other','Employee Management');
        }else if($admin_sessions->role_id =='19'){  //Tab
           $data = array('Leads');
        }
        return $data;
    }
     function side_menu()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $data = array();
        $admin_sessions = $CI->session->userdata('admin_session');
        if($admin_sessions->role_id=="1"){  //Super Admin
            $data = array('Leads Overview','Billing Overview','Collection Overview','Academics Overview','Enquiry Form','Add Leads','Manage Leads','Transfer Leads','Leads Reports','SMS/Email Template','Add/Edit Course','View Course','Registration','Enrollment','Regular Collection','Other Collection','Send Payment Link','View Payment Details','Student Info Update','Targets','Marketing Activities','College Details','Sales Reports','Add Batch','Add Batch Timings','Batch Schedule','Add Extra Sessions','Mark Attendance','Batch Completion','Leave/Break Apply','Check Student Acads','Academic Dropout','Faculty Feedback','Syllabus','Acadamics Reports','Exam Registration','View Registration','Add Student to Exam','Exam Credentials','Cancel/Re-schedule Exam','Internal Marks','Certificate Indent','Certificate Status','Re-Issue Certificate','Examination Reports','Add Employee','Edit Employee','View Employee','Employee Credits','Employee Appraisal','Add Credits Role','Add Resume','View Last Login','Reset Password','Sales Tab','Acadamics Tab','Examination Tab','Employee Tab','Logistics Tab','Issue Books','Upload Books','Issue Videos','Upload Videos','Workshops','Expenditure Tab','Add Expenditure','Send for Approval','Expenditure Reports','Warranty','Super Admin','Notice Board','Tasks','Exams Cell','Technicians DB','Visitors List','Inventory','Apply for Leave','View Leave','Password Notifications','Center Transfer Notifications','Cancel Receipt Notications','Cancel Enrollment Notifications','Name Request Notifications','Fd Activation Notifications','Academic Dropout Notifications','Expenditure Notifications','User Leave Notifications','Batch Notifications','Extra Session Notifications','Jobs Tab','Current Openings','View Apply Jobs','Production House','Portfolio Notifications','Portfolio Tab','Student Portfolio','Exam Question Sheet','List Exam Question Sheet','Reach Us Enquiry','Join Course Enquiry'); 
        }else if($admin_sessions->role_id =='2'){  //Center Manager
             $data = array('Leads Overview','Billing Overview','Collection Overview','Academics Overview','Enquiry Form','Add Leads','Manage Leads','Transfer Leads','Leads Reports','SMS/Email Template','View Course','Registration','Enrollment','Regular Collection','Other Collection','Send Payment Link','View Payment Details','Student Info Update','Targets','Marketing Activities','College Details','Sales Reports','Add Batch','Add Batch Timings','Batch Schedule','Add Extra Sessions','Mark Attendance','Leave/Break Apply','Check Student Acads','Academic Dropout','Faculty Feedback','Syllabus','Acadamics Reports','Exam Registration','View Registration','Add Student to Exam','Exam Credentials','Cancel/Re-schedule Exam','Certificate Indent','Certificate Status','Re-Issue Certificate','Examination Reports','Add Employee','Edit Employee','View Employee','Employee Credits','Employee Appraisal','Add Resume','View Last Login','Cancel Receipt','Cancel Enrollment','Center Transfer','Name Change Request','FD Activaltion','Sales Tab','Acadamics Tab','Examination Tab','Employee Tab','Logistics Tab','Issue Books','Upload Books','Issue Videos','Upload Videos','Workshops','Expenditure Tab','Add Expenditure','Send for Approval','Expenditure Reports','Warranty','Notice Board','Inventory','Technicians DB','Visitors List','Apply for Leave','View Leave','Batch Notifications','Extra Session Notifications','Jobs Tab','Current Openings','View Apply Jobs','Front Notifications','Support Notifications','Production House');
        }else if($admin_sessions->role_id =='3'){ //Receptionist
        
             $data = array('Leads Overview','Billing Overview','Collection Overview','Academics Overview','Add Leads','Leads Reports','View Course','Registration','Enrollment','Regular Collection','Other Collection','Send Payment Link','View Payment Details','Targets','College Details','Batch Schedule','Mark Attendance','Leave/Break Apply','Check Student Acads','Faculty Feedback','View Registration','Exam Credentials','Certificate Status','Sales Tab','Acadamics Tab','Examination Tab','Warranty','Inventory','Technicians DB','Visitors List','Expenditure Tab','Apply for Leave','Employee Tab');
        
        }else if($admin_sessions->role_id =='4'){  //Accountant
        
            $data = array('Leads Overview','Billing Overview','Collection Overview','Academics Overview','View Course','Registration','Enrollment','Regular Collection','Other Collection','Send Payment Link','View Payment Details','Targets','Check Student Acads','Faculty Feedback','Sales Tab','Acadamics Tab','Add Expenditure','Send for Approval','Expenditure Reports','Warranty','Inventory','Technicians DB','Visitors List','Expenditure Tab','Apply for Leave','Employee Tab');
        
        }else if($admin_sessions->role_id =='5'){  //Lab Incharge
            
            $data = array();

        }else if($admin_sessions->role_id =='6'){  //Counsellor
           
            $data = array('Leads Overview','Billing Overview','Collection Overview','Enquiry Form','Add Leads','Leads Reports','View Course','Registration','Enrollment','Send Payment Link','Targets','Marketing Activities','College Details','Sales Tab','Apply for Leave','Employee Tab');

        }else if($admin_sessions->role_id =='7'){  //Telecaller
           
           $data = array('Leads Overview','Billing Overview','Collection Overview','Add Leads','View Course','Send Payment Link','Targets','College Details','Sales Tab','Apply for Leave','Employee Tab');

        }else if($admin_sessions->role_id =='8'){  //Marketing Manager
            
            $data = array('Leads Overview','Billing Overview','Collection Overview','Enquiry Form','Add Leads','Leads Reports','View Course','Registration','Enrollment','Send Payment Link','Targets','Marketing Activities','College Details','Sales Tab','Employee Tab');

        }else if($admin_sessions->role_id =='9'){  //Marketing Executive
            
            $data = array('Leads Overview','Billing Overview','Collection Overview','Add Leads','View Course','Send Payment Link','Targets','Marketing Activities','College Details','Sales Tab','Apply for Leave','Employee Tab');

        }else if($admin_sessions->role_id =='10'){  //Center Academic Head
            
            $data = array('Academics Overview','View Course','Add Batch','Add Batch Timings','Batch Schedule','Add Extra Sessions','Mark Attendance','Batch Completion','Leave/Break Apply','Check Student Acads','Academic Dropout','Syllabus','Acadamics Reports','Exam Registration','View Registration','Add Student to Exam','Exam Credentials','Cancel/Re-schedule Exam','Certificate Indent','Certificate Status','Re-Issue Certificate','Add Resume','Sales Tab','Acadamics Tab','Examination Tab','Employee Tab','Logistics Tab','Issue Books','Upload Books','Issue Videos','Upload Videos','Workshops','Notice Board','Apply for Leave','Batch Notifications','Extra Session Notifications','Jobs Tab','Current Openings','View Apply Jobs','Portfolio Tab','Portfolio Notifications','Student Portfolio');

        }else if($admin_sessions->role_id =='11'){  //Faculty
            
            $data = array('Academics Overview','View Course','Batch Schedule','Mark Attendance','Batch Completion','Check Student Acads','Syllabus','Internal Marks','Sales Tab','Acadamics Tab','Examination Tab','Apply for Leave','Employee Tab','Batch Notifications','Extra Session Notifications','Portfolio Notifications','View Apply Jobs','Portfolio Tab','Student Portfolio');

        }else if($admin_sessions->role_id =='12'){  //Placement Officer

            $data = array('Academics Overview','View Course','Batch Schedule','Check Student Acads','Syllabus','Sales Tab','Acadamics Tab','Apply for Leave','Employee Tab','Jobs Tab','Current Openings','View Apply Jobs');

        }else if($admin_sessions->role_id =='13'){  //Zonal Sales
            
            $data = array('Leads Overview','Billing Overview','Collection Overview','View Course','Send Payment Link','View Payment Details','Targets','Marketing Activities','College Details','Sales Reports','View Last Login','Sales Tab','Employee Tab','Notice Board','Apply for Leave','Jobs Tab','View Apply Jobs');

        }else if($admin_sessions->role_id =='14'){  //Regional Sales
            
            $data = array('Leads Overview','Billing Overview','Collection Overview','View Course','Send Payment Link','View Payment Details','Targets','Marketing Activities','College Details','Sales Reports','View Last Login','Sales Tab','Employee Tab','Notice Board','Apply for Leave','Jobs Tab','View Apply Jobs');

        }else if($admin_sessions->role_id =='15'){  //Zonal Acads
            
            $data = array('Academics Overview','View Course','Batch Schedule','Check Student Acads','Academic Dropout','Syllabus','Acadamics Reports','View Registration','Examination Reports','View Last Login','Sales Tab','Acadamics Tab','Examination Tab','Employee Tab','Logistics Tab','Issue Books','Upload Books','Issue Videos','Upload Videos','Workshops','Notice Board','Apply for Leave','Jobs Tab','Current Openings','View Apply Jobs');

        }else if($admin_sessions->role_id =='16'){  //Regional Acads
            
            $data = array('Academics Overview','View Course','Batch Schedule','Check Student Acads','Academic Dropout','Syllabus','Acadamics Reports','View Registration','Examination Reports','View Last Login','Sales Tab','Acadamics Tab','Examination Tab','Employee Tab','Logistics Tab','Issue Books','Upload Books','Issue Videos','Upload Videos','Workshops','Notice Board','Apply for Leave','Jobs Tab','Current Openings','View Apply Jobs');

        }else if($admin_sessions->role_id =='17'){  //Accounts
            
            $data = array('Billing Overview','Collection Overview','Academics Overview','View Course','Send 
                Payment Link','View Payment Details','Targets','Sales Reports','Check Student Acads','Sales Tab','Acadamics Tab','Examination Tab','Apply for Leave','Employee Tab');

        }else if($admin_sessions->role_id =='18'){  //Exam Cell Team
            
            $data = array('Academics Overview','View Course','Check Student Acads','Exam Credentials','Examination Reports','Sales Tab','Acadamics Tab','Examination Tab','Exams Cell','Apply for Leave','Employee Tab');

        }else if($admin_sessions->role_id =='19'){  //Tab
           $data = array('Enquiry Form');
        }
        return $data;
    } 
}