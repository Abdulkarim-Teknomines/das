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
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Clinic *</label>
                    <div class="col-sm-10">
                        <select class="form-control"  name="clinic_name" value="<?php echo set_value('clinic_name');?>">
                            <option value="">Select Clinic</option>
                            <?php foreach($clinic as $cli){ ?>
                                <option value="<?php echo $cli['id'];?>" <?php echo set_select('clinic_name',$cli['id']);?>><?php echo $cli['clinic_name']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('clinic_name');?>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">User ID *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="User ID" name="user_id" value="<?php echo set_value('user_id');?>">
                        <?php echo form_error('user_id');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password *</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Enter Password" name="password"  name="email"  id="email"  value="<?php echo set_value('password');?>">
                            <?php echo form_error('password');?>
                        </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Password *</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirm_password"  id="confirm_password" class="confirm_password"  value="<?php echo set_value('confirm_password');?>" autocomplete="off">
                            <?php echo form_error('confirm_password');?>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Full Name * </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Full Name" name="full_name" id="full_name" class="full_name" value="<?php echo set_value('full_name');?>" autocomplete="off">
                        <?php echo form_error('full_name');?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile Number *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number" class="mobile_number"  value="<?php echo set_value('mobile_number');?>" autocomplete="off">
                        <?php echo form_error('mobile_number');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Address" name="address" id="address" class="address" value="<?php echo set_value('address');?>" autocomplete="off">
                    </div>
                </div>    
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Email ID"  name="email_id"  id="email_id"  class="email_id" value="<?php echo set_value('email_id');?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Role *</label>
                    <div class="col-sm-10">
                        <select class="form-control"  name="role_id" >
                            <option value="">Select Role</option>
                            <?php foreach($roles as $role){ ?>
                                <option value="<?php echo $role['id'];?>" <?php echo set_select('role_id',$role['id']);?>><?php echo $role['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Add User" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>