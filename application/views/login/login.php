    <!-- Pre-loader end -->
<style>
    .auth-body .text-center img{
        display:block;
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
                                <img src="<?php echo base_url()?>assets/images/logos.png" alt="logo.png" style="width:100%;height:auto">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Login Form</h3>
                                    </div>
                                </div>
                                <hr/>
                                <?php //echo validation_errors(); ?></span>
                                
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    <span class="md-line"></span>
                                </div>
                                
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <span class="md-line"></span>
                                </div>
                                
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-12 col-xs-12 forgot-phone text-right">
                                        <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div>
                                </div>
                                <div class="row m-t-25">
                                    <div class="col-md-12  text-right">
                                        <input type="submit" name="login" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Sign in">
                                    </div>
                                </div>
                                <div class="row m-t-25">
                                    <div class="forgot-phone col-sm-5 col-xs-12 ">
                                        <p class="text-right f-w-600 text-inverse">Not Yet Member?</p><!-- <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button> -->
                                    </div>
                                    <div class="col-sm-6 col-xs-6 forgot-phone text-right">
                                        <a href="<?php echo base_url()?>register" class="col-sm-12 col-xs-12 forgot-phone text-right"><b>Signup Now</b></a>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

   <script>
    $("#login_form").submit(function(e){
        alert('hi');
        e.preventDefault();
    });
   </script>