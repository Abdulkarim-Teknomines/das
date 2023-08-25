<style>
    span{
        color:#000;
    }
    .error{
    color:red;
}
p{
text-align:left;
}
.signup-card.auth-body {
    width: 450px;
    margin-bottom: 70px;
}

</style>
<section class="login">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" method="post">
                            <div class="text-center">
                            <img src="<?php echo base_url()?>assets/images/logos.png" alt="logo.png"
                                style="width:100%;height:auto">
                            </div>
                            
                            <?php if($this->session->flashdata('success')){?>

                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                            </div>
                            <?php $this->session->unset_userdata ( 'success' );?>
                                <?php } ?>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Sign up</h3>
                                    </div>
                                </div>
                                <hr/>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="firstname" placeholder="First Name *" name="firstname" value="<?php echo set_value('firstname');?>" autocomplete="off">
                                    <span class="md-line"></span>
                                </div>
                                <?php echo form_error('firstname');?>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="lastname" placeholder="Last Name *" name="lastname" value="<?php echo set_value('lastname');?>" autocomplete="off">
                                    <span class="md-line"></span>
                                </div>

                                <?php echo form_error('lastname');?>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="email" placeholder="Email ID *" name="email" value="<?php echo set_value('email');?>" autocomplete="off">
                                    <span class="md-line"></span>
                                </div>

                                <?php echo form_error('email');?>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile Number *" name="mobile_number" value="<?php echo set_value('mobile_number');?>" autocomplete="off">
                                    <span class="md-line"></span>
                                </div>
                                <?php echo form_error('mobile_number');?>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <input type="submit" name="signup" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Sign up" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <!-- <div class="input-group"> -->
                                            <span>Already Registerd</span>
                                            <a href="<?php echo base_url('/')?>">Sign in?</a>
                                        <!-- </div> -->
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