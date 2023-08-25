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
                    <label class="col-sm-2 col-form-label">Clinic Name *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control clinic_name" placeholder="Enter Clinic Name" name="clinic_name" value="<?php echo set_value('clinic_name',$result->clinic_name); ?>" autocomplete="off">
                        <?php echo form_error('clinic_name');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Logo</label>
                    <div class="col-sm-10">
                        <input type="file" name="clinic_logo" id="clinic_logo" class="form-control clinic_logo" value="<?php echo set_value('clinic_logo',$result->logo); ?>">
                        <input type="hidden" name="old_clinic_logo" value="<?php echo $result->logo;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php echo set_value('address',$result->address);?>" autocomplete="off">
                        <?php echo form_error('address');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control email" placeholder="Enter Email" name="email" id="email"  value="<?php echo set_value('email',$result->email);?>" autocomplete="off">
                        </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Landline Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control landline_number" placeholder="Enter Landline Number" name="landline_number"  id="landline_number" value="<?php echo set_value('landline_number',$result->landline_number);?>" autocomplete="off">
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
                    <label class="col-sm-2 col-form-label">Appointment Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control appointment_number" placeholder="Enter Appointment Number" name="appointment_number" id="appointment_number" value="<?php echo set_value('appointment_number',$result->appointment_number);?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Website</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control website" placeholder="Enter Website" name="website" id="website" value="<?php echo set_value('website',$result->website);?>" autocomplete="off">
                    </div>
                </div>    
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Payment</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control payment" placeholder="Enter Payment"  name="payment"  id="payment" value="<?php echo set_value('payment',$result->payment);?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">QR Code</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="qr_code"  id="qr_code"  class="qr_code" value="<?php echo set_value('qr_code');?>" autocomplete="off">
                        <input type="hidden" name="old_qr_code" value="<?php echo $result->qr_code;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Edit Clinic">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>