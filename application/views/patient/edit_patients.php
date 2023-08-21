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
                    <div class="col-sm-2 btn btn-primary text-center m-b-20"><span>Appointment Details *</span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Search Patient *</label>
                    <div class="col-sm-9 col-xs-2">
                        <input type="text" class="form-control" placeholder="Enter Patient ID Or Phone Number" name="patient_id_or_number" id="patient_id_or_number" autocomplete="off">
                    </div>
                    <div class="col-sm-1 col-xs-2">
                        <input type="button" name="search" id="search" class="btn btn-primary text-center m-b-20 search" value="Search" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Doctor *</label>
                    <div class="col-sm-10">
                    <select class="form-control doctors" name="doctors" id="doctors" >
                        <option value="">Select Doctor Name</option>
                            <?php if(!empty($doctors)){
                                foreach($doctors as $dr){ ?>
                                    <option value="<?php echo $dr->id;?>"><?php echo $dr->full_name;?></option>
                            <?php   }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Appointment Date *</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Appointment Date" name="appointment_date" id="appointment_date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 col-form-label">Previous Appointment Time *</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Select Time" name="appointment_time" id="appointment_time" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Patient Details *</label>
                </div>
                <input type="hidden" name="patient_id" id="patient_id" class="patient_id" >
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" autocomplete="off" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name * </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name"  id="last_name" autocomplete="off" >
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email Address </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Email Address" name="email_id"  id="email_id" autocomplete="off" >
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile Number *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number"  id="mobile_number" autocomplete="off" >
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Whatsapp No </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control whatsapp_number" placeholder="Enter Whatsapp Number" name="whatsapp_number"  id="whatsapp_number" autocomplete="off" >
                            
                        </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Blood Group </label>
                    <div class="col-sm-4">
                        <select class="form-control blood_group" name="blood_group" id="blood_group" >
                            <option value="">Select Blood Group</option>
                            <?php if(!empty($blood_group)){
                                foreach($blood_group as $b_group){ 
                                    
                                    ?>
                                    <option value="<?php echo $b_group;?>"><?php echo $b_group;?></option>
                            <?php   }
                            }
                            ?>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Date of Birth </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Select Date" name="birth_date"  id="birth_date" autocomplete="off" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sex *</label>
                    <div class="col-sm-10">
                    <?php if(!empty($this->gender)){
                            foreach($this->gender as $gen){ ?>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input sex" name="sex" value="<?php echo $gen;?>" ><label class="form-label"><?php echo $gen;?></label>
                                    </label>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address *</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" placeholder="Enter Address" name="address"  id="address" autocomplete="off" ></textarea>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Patient Problem *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Patient Problem" name="patient_problem"  id="patient_problem" autocomplete="off" >
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2 text-right">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Update" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
    $("#appointment_date").datepicker({ 
        format: 'dd-mm-yyyy',
        autoclose: true, 
        todayHighlight: true,

    });
    $('#appointment_time').datetimepicker({
        format: 'HH:mm',
    });
    $("#search").click(function(){
        $(".error").remove();
        if($("#patient_id_or_number").val()==""){
            $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
            return false;
        }
    
        var patient_id_number = $("#patient_id_or_number").val();
        $.ajax({
            url: "<?php echo base_url('PatientController/search_patient_details');?>",
            data: ({patient_id_number,patient_id_number}),
            dataType: 'json', 
            type: 'post',
            success: function(data) {
                if(data.length<=0){
                    $("#patient_id_or_number").after('<div class="error">No Record Found</div>');
                    $("#first_name").val('');
                    $("#last_name").val('');
                    $("#email_id").val('');
                    $("#mobile_number").val('');
                    $("#whatsapp_number").val('');
                    $("#birth_date").val('');
                    $("#address").val('');
                    $("#patient_problem").val('');
                    $('#blood_group option[value=""]').attr("selected", "selected");
                    $("input:radio").prop('checked',false);
                    $("#patient_id").val('');
                    return false;
                }else{
                $(data).each(function(key,val){
                    $("#first_name").val(val.first_name);
                    $("#last_name").val(val.last_name);
                    $("#email_id").val(val.email_id);
                    $("#mobile_number").val(val.mobile_no);
                    $("#whatsapp_number").val(val.whatssapp_no);
                    $("#birth_date").val(val.birth_date);
                    $("#address").val(val.address);
                    $("#patient_problem").val(val.patient_problem);
                    $('#blood_group option[value="'+val.blood_group_id+'"]').attr("selected", "selected");
                    $("input:radio[value='"+val.gender+"']").prop('checked',true);
                    $("#patient_id").val(val.id);
                });
                }
            }             
        });
    });
    $("#birth_date").datepicker({ 
        format: 'dd-mm-yyyy',
        autoclose: true, 
        todayHighlight: true,

    });
});
$(document).on('submit',function(e){
    
    $(".error").remove();
    e.preventDefault();
    if($("#patient_id").val()==""){
        $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
        return false;
    }
    var patient_id = $("#patient_id").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email_id = $("#email_id").val();
    var mobile_number = $("#mobile_number").val();
    var whatsapp_number = $("#whatsapp_number").val();
    var blood_group = $("#blood_group").val();
    var birth_date = $("#birth_date").val();
    var sex = $(".sex").val();
    var address = $("#address").val();
    var patient_problem = $("#patient_problem").val();
    $.ajax({
        url: "<?php echo base_url('PatientController/update_patient');?>",
        data: ({patient_id:patient_id,first_name:first_name,last_name:last_name,email_id:email_id,mobile_number:mobile_number,whatsapp_number:whatsapp_number,blood_group:blood_group,birth_date:birth_date,sex:sex,address:address,patient_problem:patient_problem}),
        dataType: 'json', 
        type: 'post',
        success: function(data) {
            if(data.status=='success'){
                        Swal.fire({
                            title: data.message,
                            // icon:'success',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#patient_id").val('');
                                $("#first_name").val('');
                                $("#last_name").val('');
                                $("#email_id").val('');
                                $("#mobile_number").val('');
                                $("#whatsapp_number").val('');
                                $("#birth_date").val('');
                                $("#address").val('');
                                $("#patient_problem").val('');
                                $('#blood_group option[value=""]').attr("selected", "selected");
                                $("input:radio").prop('checked',false);
                                $("#patient_id").val('');
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
});
</script>
