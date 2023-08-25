<style>
    .error{
        color:red;
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="card-block">
        <?php if($this->session->flashdata('success')){?>
            <div class="alert alert-success"> <?= $this->session->flashdata('success') ?> </div>
            <?php $this->session->unset_userdata('success');?>
        <?php } ?>
        <?php if($this->session->flashdata('error')){?>
            <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?> </div>
            <?php $this->session->unset_userdata('error');?>
        <?php } ?>
            <?php $admin_session = $this->session->userdata('admin_session'); 
                
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <input type="hidden" name="id" value="<?php echo $admin_session->id;?>">
                    <label class="col-sm-2 col-form-label">Old Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control old_password" placeholder="Enter Old Password" name="old_password" value="<?php echo set_value('old_password');?>" autocomplete="off">
                        <?php echo form_error('old_password');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Enter New Password" name="new_password" value="<?php echo set_value('new_password');?>" autocomplete="off">
                        <?php echo form_error('new_password');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirm_password" value="<?php echo set_value('confirm_password');?>" autocomplete="off">
                        <?php echo form_error('confirm_password');?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Update Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>