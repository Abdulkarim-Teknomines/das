<style>
    .error{
        color:red;
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="card-block">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Patient Details *</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name  </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name"  id="last_name" autocomplete="off">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email Address </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Email Address" name="email_id"  id="email_id" autocomplete="off">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile Number *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number"  id="mobile_number" autocomplete="off">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Whatsapp No </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control whatsapp_number" placeholder="Enter Whatsapp Number" name="whatsapp_number"  id="whatsapp_number" autocomplete="off">
                            
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Blood Group </label>
                    <div class="col-sm-4">
                        <select class="form-control blood_group" name="blood_group" id="blood_group" >
                            <option value="">Select Blood Group</option>
                            <?php if(!empty($blood_group)){
                                foreach($blood_group as $b_group){ ?>
                                    <option value="<?php echo $b_group;?>"><?php echo $b_group;?></option>
                            <?php   }
                            }
                            ?>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Date of Birth </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Select Date" name="birth_date"  id="birth_date" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Age *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Enter Age" name="age"  id="age" autocomplete="off">
                        </div>
                        <label class="col-sm-2 col-form-label">Sex *</label>
                    <div class="col-sm-2">
                        <?php if(!empty($this->gender)){
                            foreach($this->gender as $gen){ ?>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="sex" value="<?php echo $gen;?>" checked="true"><label class="form-label"><?php echo $gen;?></label>
                                    </label>
                                </div>

                            <?php }
                            } ?>
                    </div>
                </div>
                    
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address *</label>
                        <div class="col-sm-10">
                            
                            <textarea class="form-control" placeholder="Enter Address" name="address"  id="address" autocomplete="off"></textarea>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Patient Problem *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Patient Problem" name="patient_problem"  id="patient_problem" autocomplete="off">
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Submit" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
    $('form').submit(function(e) {
        e.preventDefault();
        var form_data = $(this);
        $(".error").remove();
            $.ajax({
                url: "<?php echo base_url('PatientController/save_patient');?>",
                data: form_data.serialize(),
                dataType: 'json', 
                type: 'post',
                success: function(data) {
                    if(data.status=='success'){
                        Swal.fire({
                            title: data.message,
                            text: 'Patient ID : '+data.patient_id,
                            // icon:'success',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form_data[0].reset();
                            }
                        })
                    }else{
                        $.each(data.message,function(key,value){
                            var element = $("#"+key);
                            element.after(value); 
                        });
                    }
                    
                }             
            });
//     }
    });
    $("#birth_date").datepicker({ 
        format: 'dd-mm-yyyy',
        autoclose: true, 
        todayHighlight: true,

    });
    
});
</script>
