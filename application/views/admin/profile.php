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
            <?php $admin_session = $this->session->userdata('admin_session'); 
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <input type="hidden" name="id" value="<?php echo $admin_session->id;?>">
                    <label class="col-sm-2 col-form-label">User ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control user_id" placeholder="Enter User ID" name="user_id" value="<?php echo set_value('user_id',$result->user_id); ?>" autocomplete="off">
                        <?php echo form_error('user_id');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Full Name" name="full_name" value="<?php echo set_value('full_name',$result->full_name);?>" autocomplete="off">
                        <?php echo form_error('full_name');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" value="<?php echo set_value('mobile_number',$result->mobile_number);?>" autocomplete="off">
                        <?php echo form_error('mobile_number');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control address" placeholder="Enter Address" name="address" id="address"  value="<?php echo set_value('address',$result->address);?>" autocomplete="off">
                            <?php echo form_error('address');?>
                        </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control email_id" placeholder="Enter Email ID" name="email_id"  id="email_id" value="<?php echo set_value('email_id',$result->email_id);?>" autocomplete="off">
                            <?php echo form_error('email_id');?>
                        </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Update Profile">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>