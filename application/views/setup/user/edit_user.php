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
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Clinic *</label>
                    <div class="col-sm-10">
                        <select class="form-control"  name="clinic_name" value="<?php echo set_value('clinic_name');?>">
                            <option value="">Select Clinic</option>
                            <?php 
                            if(!empty($clinic)){
                                foreach($clinic as $cli){ ?>
                                    <option value="<?php echo $cli->id;?>" <?php if($result->clinic_id==$cli->id){echo 'selected';} ?><?php echo set_select('clinic_name',$cli->id);?>><?php echo $cli->clinic_name;?></option>
                            <?php }
                            } ?>
                        </select>
                        <?php echo form_error('clinic_name');?>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">User ID *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="User ID" name="user_id" value="<?php echo set_value('user_id',$result->user_id);?>">
                        <?php echo form_error('user_id');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Password" name="password" value="<?php echo set_value('password',$result->u_password);?>">
                            <?php echo form_error('password');?>
                        </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Password *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control confirm_password" placeholder="Enter Confirm Password" name="confirm_password"  id="confirm_password" value="<?php echo set_value('confirm_password',$result->u_password);?>" autocomplete="off">
                            <?php echo form_error('confirm_password');?>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Full Name * </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control full_name" placeholder="Enter Full Name" name="full_name" id="full_name" value="<?php echo set_value('full_name',$result->full_name);?>" autocomplete="off">
                        <?php echo form_error('full_name');?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile Number *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control mobile_number" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number',$result->mobile_number);?>" autocomplete="off">
                        <?php echo form_error('mobile_number');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control address" placeholder="Enter Address" name="address" id="address" value="<?php echo set_value('address',$result->address);?>" autocomplete="off">
                    </div>
                </div>    
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control email_id" placeholder="Enter Email ID"  name="email_id"  id="email_id"  value="<?php echo set_value('email_id',$result->email_id);?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role_id">
                            <option value="">Select Role</option>
                            <?php 
                                if(!empty($roles)){
                                    foreach($roles as $role){ ?>
                                        <option value="<?php echo $role->id;?>" <?php if($result->role_id==$role->id){echo 'selected';} ?> <?php echo set_select('role_id',$role->id);?>><?php echo $role->name;?></option>
                                <?php }
                                }   ?>
                        </select>
                        <?php echo form_error('role_id');?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Edit User">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>