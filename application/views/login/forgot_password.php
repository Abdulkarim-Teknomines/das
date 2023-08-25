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
                                <img src="<?php echo base_url()?>assets/images/logos.png" width="100%" alt="logo.png">
                            </div>
                            <?php if($this->session->flashdata('success')){?>

                            <div class="alert alert-success"  role="alert">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                            </div>
                            <?php $this->session->unset_userdata ( 'success' );?>
                                <?php } ?>
                                <?php if($this->session->flashdata('error')){?>

                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Fail!</strong> <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                    <?php $this->session->unset_userdata ('error');?>
                                        <?php } ?>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Reset Password</h3>
                                    </div>
                                </div>
                                <hr/>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" placeholder="Name *" name="name" value="<?php echo set_value('name');?>" autocomplete="off" >
                                    <span class="md-line"></span>
                                </div>
                                <?php echo form_error('name');?>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="email" placeholder="Email ID *" name="email" value="<?php echo set_value('email');?>" autocomplete="off" >
                                    <span class="md-line"></span>
                                </div>

                                <?php echo form_error('email');?>

                                <div class="input-group">
                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile Number *" name="mobile" value="<?php echo set_value('mobile');?>" autocomplete="off" >
                                    <span class="md-line"></span>
                                </div>

                                <?php echo form_error('mobile');?>

                                
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Submit">
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