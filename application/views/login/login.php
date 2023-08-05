    <!-- Pre-loader end -->
    <style>
.auth-body .text-center img {
    display: block;
}
.login{
    text-align: left;
}
.error{
    color:red;
}
   </style>

    <!-- <section class="login p-fixed d-flex text-center bg-primary common-img-bg"> -->
    <section class="login">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" method="post" id="login_form">
                            <div class="text-center">
                                <img src="<?php echo base_url()?>assets/images/logos.png" alt="logo.png"
                                style="width:100%;height:auto">
                            </div>
                            <?php if($this->session->flashdata('error')){?>
                            <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?> </div>
                            <?php $this->session->unset_userdata('error');?>
                                <?php } ?>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Login Form</h3>
                                    </div>
                                </div>
                                <hr />
                                
                                <div class="input-group">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                        autocomplete="off" value="<?php echo set_value('email')?>">
                                    <span class="md-line"></span>
                                </div>
                                <div class="error"><?php echo form_error('email');?></div>
                                
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" value="<?php echo set_value('password')?>">
                                    <span class="md-line"></span>
                                </div>
                                <div class="error"><?php echo form_error('password');?></div>
                                
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-12 col-xs-12 forgot-phone text-right">
                                        <a href="<?php echo base_url()?>forgot_password" class="text-right f-w-600 text-inverse">
                                            Forgot Your Password?</a>
                                    </div>
                                </div>
                                <div class="row m-t-25">
                                    <div class="col-md-12  text-right">
                                        <input type="submit" name="login"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20"
                                            value="Sign in">
                                    </div>
                                </div>
                                <div class="row m-t-25">
                                    <div class="forgot-phone col-sm-5 col-xs-12 ">
                                        <p class="text-right f-w-600 text-inverse">Not Yet Member?</p>
                                        <!-- <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button> -->
                                    </div>
                                    <div class="col-sm-6 col-xs-6 forgot-phone text-right">
                                        <a href="<?php echo base_url()?>register"
                                            class="col-sm-12 col-xs-12 forgot-phone text-right"><b>Signup Now</b></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
        
        <script>

    // $('#login_form').on('submit', function(e) {
    //     e.preventDefault();
    //     $(".email_error").val('');
    //     $(".password_error").val('');
    //     var email = $("#email").val();
    //     var password = $("#password").val();
    //     $.ajax({
    //       url: '<?php echo base_url('LoginController/insert')?>',
    //       type:'POST',
    //       data:({email:email,password:password}),
    //       dataType:'json',
    //       success:function(data){
    //           if(data.email!="" || data.password!=""){
    //               if(data.email!=""){
    //                   $(".email_error").html('Please Enter Email');
                    
    //               }else if(data.password!=""){
    //                   $(".password_error").after('Please Enter Password');
    //                   return false;
    //               }

    //           }
    //           if(data.is_success=="0"){
    //               window.location.href="<?php echo base_url()?>dashboard";
    //           }else if(data.is_success="1"){
    //               $(".login_error").html(data.message);
    //               return false;
    //           }
    //       }
    //     });

    // });
        </script>