<?php

function contact_us_mail($email, $data = array(), $subject = "Contact Us Mail", $from = '', $from_name = '') {

   

    $ci = &get_instance();
    $ci->load->library('email');
	$ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => SENDGRID_USERNAME,
            'smtp_pass' => SENDGRID_PASSWORD,
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html'
          ));

    $template = $ci->load->view('email_templates/contact_us.php', $data, true);
	$ci->email->set_mailtype("html");
    $ci->email->from($from, $from_name);
    $ci->email->to($email);
//    $this->email->cc('another@another-example.com');
//    $this->email->bcc('them@their-example.com');
    $ci->email->subject($subject);
    $ci->email->message($template);
    return $ci->email->send();
}



function footer_contact_us_mail($email, $data = array(), $subject = "Contact Us Mail", $from = '', $from_name = '') {

   

    $ci = &get_instance();
    $ci->load->library('email');
	$ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => SENDGRID_USERNAME,
            'smtp_pass' => SENDGRID_PASSWORD,
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html'
          ));

    $template = $ci->load->view('email_templates/footer_contact_us.php', $data, true);
	$ci->email->set_mailtype("html");
    $ci->email->from($from, $from_name);
    $ci->email->to($email);
//    $this->email->cc('another@another-example.com');
//    $this->email->bcc('them@their-example.com');
    $ci->email->subject($subject);
    $ci->email->message($template);
    return $ci->email->send();
}




function inspector_register_mail($email, $data = array(), $subject = "Welcome To Floor Detective", $from = '', $from_name = '') {

   

    $ci = &get_instance();
    $ci->load->library('email');
	$ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => SENDGRID_USERNAME,
            'smtp_pass' => SENDGRID_PASSWORD,
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html'
          ));

    $template = $ci->load->view('email_templates/register_mail.php', $data, true);
	$ci->email->set_mailtype("html");
    $ci->email->from($from, $from_name);
    $ci->email->to($email);
    $ci->email->subject($subject);
    $ci->email->message($template);
    return $ci->email->send();
}





function hire_inspector_email($email, $data = array(), $subject = "Hire Inspector Request", $from = '', $from_name = '') {

   

    $ci = &get_instance();
    $ci->load->library('email');
	$ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => SENDGRID_USERNAME,
            'smtp_pass' => SENDGRID_PASSWORD,
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html'
          ));

    $template = $ci->load->view('email_templates/hire_inspector_email.php', $data, true);
	$ci->email->set_mailtype("html");
    $ci->email->from($from, $from_name);
    $ci->email->to($email);
    $ci->email->subject($subject);
    $ci->email->message($template);
    return $ci->email->send();
}



function hire_me_mail($email, $data = array(), $subject = "hire me Mail", $from = '', $from_name = '') {
    $ci = &get_instance();
    $ci->load->library('email');

//	$ci->email->initialize(array(

//            'protocol' => 'smtp',

//            'smtp_host' => 'smtp.sendgrid.net',

//            'smtp_user' => SENDGRID_USERNAME,

//            'smtp_pass' => SENDGRID_PASSWORD,

//            'smtp_port' => 587,

//            'crlf' => "\r\n",

//            'newline' => "\r\n",

//            'mailtype' => 'html'

 //         ));

    $template = $ci->load->view('email_templates/hire_me.php', $data, true);

	$ci->email->set_mailtype("html");

    $ci->email->from($from, $from_name);

    $ci->email->to($email);

//    $this->email->cc('another@another-example.com');

//    $this->email->bcc('them@their-example.com');

    $ci->email->subject($subject);

    $ci->email->message($template);

    return $ci->email->send();

}





function hire_me_email_html($email_data){

	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>



<body style="padding:0; margin:0; font-family:Verdana, Geneva, sans-serif">

<table width="600" border="0" align="center" cellpadding="0" cellspacing="10">

  <tr>

    <td align="left" valign="top" style="padding:0 0 10px;"><strong>'.$email_data['home_owner_name'].'</strong> </td>

  </tr>

  <tr>

    <td align="left" valign="top"><img src="images/border_img.jpg" width="395" height="1" alt="" /></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="padding:20px 0 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="45" align="left" valign="top"><img src="https://i.imgpile.com/nC1CLc.jpg" width="28" height="22" alt="" /></td>

        <td align="left" valign="middle"><strong>Email:</strong> <span style="color:#178b3b;">'.$email_data['home_owner_email'].'</span></td>

      </tr>

      <tr>

        <td align="left" valign="top">&nbsp;</td>

        <td align="left" valign="middle">&nbsp;</td>

      </tr>

      <tr>

        <td align="left" valign="top"><img src="https://i.imgpile.com/nC19Jg.jpg" width="20" height="34" alt="" /></td>

        <td align="left" valign="middle"><strong>Mobile:</strong> <span style="color:#178b3b;">'.$email_data['home_owner_phone'].'</span></td>

      </tr>

      <tr>

        <td align="left" valign="top">&nbsp;</td>

        <td align="left" valign="middle">&nbsp;</td>

      </tr>

      <tr>

        <td align="left" valign="top"><img src="https://i.imgpile.com/nC1h7R.jpg" width="26" height="27" alt="" /></td>

        <td align="left" valign="middle"><strong>Phone:</strong> <span style="color:#178b3b;">'.$email_data['home_owner_work_phone'].'</span></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td align="left" valign="top">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top">'.$email_data['home_owner_address'].'</td>

  </tr>

  <tr>

    <td align="left" valign="top">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"></td>

  </tr>

</table>

</body>

</html>

';

return $message;

}









function mail_sent_to_assign_inspector($email, $data = array(), $subject = "", $from = '', $from_name = '') {



    

    $ci = &get_instance();

    $ci->load->library('email');

	$ci->email->initialize(array(

            'protocol' => 'smtp',

            'smtp_host' => 'smtp.sendgrid.net',

            'smtp_user' => SENDGRID_USERNAME,

            'smtp_pass' => SENDGRID_PASSWORD,

            'smtp_port' => 587,

            'crlf' => "\r\n",

            'newline' => "\r\n",

            'mailtype' => 'html'

          ));

    $template = $ci->load->view('email_templates/mail_sent_to_assign_inspector.php', $data, true);

	$ci->email->set_mailtype("html");

    $ci->email->from($from, $from_name);

    $ci->email->to($email);

//    $this->email->cc('another@another-example.com');

//    $this->email->bcc('them@their-example.com');

    $ci->email->subject($subject);

    $ci->email->message($template);

    return $ci->email->send();

}

