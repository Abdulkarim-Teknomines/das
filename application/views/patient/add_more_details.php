<?php 
$CI =& get_instance();
$CI->load->model('Patient_model');
?>
<style>
    .error{
        color:red;
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="card-block">
            <form method="post" enctype="multipart/form-data" id="form">
                <div class="form-group row">
                    <div class="col-sm-2 btn btn-primary text-center m-b-20"><span>Appointment Details *</span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Search Patient *</label>
                    <div class="col-sm-9 col-xs-2">
                        <input type="text" class="form-control" placeholder="Enter Patient ID Or Phone Number" name="patient_id_or_number" id="patient_id_or_number" autocomplete="off">
                    </div>
                    <!-- <div class="col-sm-1 col-xs-2">
                        <input type="button" name="search" id="search" class="btn btn-primary text-center m-b-20 search" value="Search" autocomplete="off">
                    </div> -->
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Patient ID *</label>
                        <div class="col-sm-9 col-xs-2">
                            <!-- <input type="text" class="form-control" placeholder="Patient ID" name="patient_ids" id="patient_ids" autocomplete="off"> -->
                            <select class="form-control" name="patient_id" id="patient_id">
                                <option value="">Please Select Patient ID</option>
                            </select>
                        </div>
                        <div class="col-sm-1 col-xs-2">
                        <input type="button" name="search" id="search" class="btn btn-primary text-center m-b-20 search" value="Search" autocomplete="off">
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Doctor *</label>
                    <div class="col-sm-10">
                    <select class="form-control doctor_id" name="doctor_id" id="doctor_id" >
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
                        <label class="col-sm-2 col-form-label">Appointment Time *</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Select Time" name="appointment_time" id="appointment_time" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Patient Details *</label>
                </div>
                <!-- <input type="hidden" name="patient_id" id="patient_id" class="patient_id" > -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name * </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name"  id="last_name" autocomplete="off" readonly>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email Address </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Email Address" name="email_id"  id="email_id" autocomplete="off" readonly>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile Number *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number"  id="mobile_number" autocomplete="off" readonly>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Whatsapp No </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control whatsapp_number" placeholder="Enter Whatsapp Number" name="whatsapp_number"  id="whatsapp_number" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Blood Group </label>
                    <div class="col-sm-4">
                        <select class="form-control blood_group" name="blood_group" id="blood_group" disabled>
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
                        <input type="text" class="form-control" placeholder="Select Date" name="birth_date"  id="birth_date" autocomplete="off" disabled>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Age *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Enter Age" name="age"  id="age" autocomplete="off" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">Sex *</label>
                    <div class="col-sm-2">
                        <?php if(!empty($this->gender)){
                            foreach($this->gender as $gen){ ?>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input sex" name="sex" value="<?php echo $gen;?>" disabled><label class="form-label"><?php echo $gen;?></label>
                                    </label>
                                </div>

                            <?php }
                            } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address *</label>
                        <div class="col-sm-10">
                            
                            <textarea class="form-control" placeholder="Enter Address" name="address"  id="address" autocomplete="off" readonly></textarea>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Patient Problem *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Patient Problem" name="patient_problem"  id="patient_problem" autocomplete="off" readonly>
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 btn btn-primary text-center m-b-20"><span>Speciality *</span></div>
                </div>
                <?php foreach($categories as $cat){ ?>
                    <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input categories[]" name="categories[]" id="categories[]" value="<?php echo $cat->id;?>">
                                    <label class="form-label"><?php echo $cat->category_name;?></label>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control sub_categories" name="sub_categories[]" id="sub_categories_<?php echo $cat->id;?>" multiple="multiple">
                                    <option value="">Select Sub Speciality</option>
                                    
                                    <?php $sub_cat = $CI->Patient_model->get_sub_categories($cat->id);
                                    if(!empty($sub_cat)){
                                        foreach($sub_cat as $subcat){ ?>
                                            <option value="<?php echo $subcat->id;?>"><?php echo $subcat->name;?></option>
                                        <?php   }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        $(".sub_categories").select2({
            placeholder: "Select Sub Speciality",
            theme: "classic",
            
        });

        // $("#search").click(function(){
        //     $(".error").remove();
        //     if($("#patient_id_or_number").val()==""){
        //         $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
        //         return false;
        //     }
    
        //     var patient_id_number = $("#patient_id_or_number").val();
        //     $.ajax({
        //         url: "<?php echo base_url('PatientController/search_patient_details');?>",
        //         data: ({patient_id_number,patient_id_number}),
        //         dataType: 'json', 
        //         type: 'post',
        //         success: function(data) {
        //             if(data.length<=0){
        //                 $("#patient_id_or_number").after('<div class="error">No Record Found</div>');
        //                 $("#first_name").val('');
        //                 $("#last_name").val('');
        //                 $("#email_id").val('');
        //                 $("#mobile_number").val('');
        //                 $("#whatsapp_number").val('');
        //                 $("#birth_date").val('');
        //                 $("#address").val('');
        //                 $("#patient_problem").val('');
        //                 $('#blood_group option[value=""]').attr("selected", "selected");
        //                 $("input:radio").prop('checked',false);
        //                 $("#patient_id").val('');
        //                 return false;
        //             }else{
        //                 $(data).each(function(key,val){
        //                     $("#first_name").val(val.first_name);
        //                     $("#last_name").val(val.last_name);
        //                     $("#email_id").val(val.email_id);
        //                     $("#mobile_number").val(val.mobile_no);
        //                     $("#whatsapp_number").val(val.whatssapp_no);
        //                     $("#birth_date").val(val.birth_date);
        //                     $("#address").val(val.address);
        //                     $("#patient_problem").val(val.patient_problem);
        //                     $('#blood_group option[value="'+val.blood_group_id+'"]').attr("selected", "selected");
        //                     $("input:radio[value='"+val.gender+"']").prop('checked',true);
        //                     $("#patient_id").val(val.id);
        //                 });
        //             }
        //         }             
        //     });
        // });
        $("#patient_id_or_number").focusout(function(){
        var patient_id_number = $(this).val();
        $.ajax({
        type:'POST',
        url:'<?php echo base_url('PatientController/select_patient_id_change'); ?>',
        data:{patient_id_number:patient_id_number},
        dataType: 'json',
        success:function(data){
                $('#patient_id').html('');
                $('#patient_id').append( $('<option></option>').val("").html("Please Select Patient ID") )
                $.each(data, function(val, text) {
                    $('#patient_id').append( $('<option></option>').val(text.id).html(text.patient_id) )
                });
            }
        });
    });
        $("#search").click(function(){
        $(".error").remove();
        if($("#patient_id_or_number").val()==""){
            $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
            return false;
        }
    
        var patient_id_number = $("#patient_id_or_number").val();
        var patient_id = $("#patient_id").val();
        $.ajax({
            url: "<?php echo base_url('PatientController/search_patient_details');?>",
            data: ({patient_id_number:patient_id_number,patient_id:patient_id}),
            dataType: 'json', 
            type: 'post',
            success: function(data) {
                if(data.patient_details.length<=0){
                    $("#patient_id_or_number").after('<div class="error">No Record Found</div>');
                    $("#first_name").val('');
                    $("#last_name").val('');
                    $("#email_id").val('');
                    $("#mobile_number").val('');
                    $("#whatsapp_number").val('');
                    $("#birth_date").val('');
                    $("#address").val('');
                    $("#patient_problem").val('');
                    $("#appointment_date").val('');
                    $("#appointment_time").val('');
                    $('#blood_group option[value=""]').attr("selected", "selected");
                    $("#doctor_id").val('');
                    $("#age").val('');
                    $("input:radio").prop('checked',false);
                    return false;
                }else{
                $(data.patient_details).each(function(key,val){
                    $("#first_name").val(val.first_name);
                    $("#last_name").val(val.last_name);
                    $("#age").val(val.age);
                    $("#email_id").val(val.email_id);
                    $("#mobile_number").val(val.mobile_no);
                    $("#whatsapp_number").val(val.whatssapp_no);
                    $("#birth_date").val(val.birth_date);
                    $("#address").val(val.address);
                    $("#patient_problem").val(val.patient_problem);
                    $('#blood_group option[value="'+val.blood_group_id+'"]').attr("selected", "selected");
                    $("input:radio[value='"+val.gender+"']").prop('checked',true);
                    $("#appointment_date").val(val.appointment_date);
                    $("#appointment_time").val(val.appointment_time);
                    $("#doctor_id").val(val.doctor_id);
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
    $("#appointment_date").datepicker({ 
        format: 'dd-mm-yyyy',
        autoclose: true, 
        todayHighlight: true,

    });
    $('#appointment_time').datetimepicker({
        format: 'HH:mm',
        icons: {
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
        }
    });
    $(document).on('submit',function(e){
        $(".error").remove();
        e.preventDefault();
        var val = [];
        var t = [];
        var selected = [];
        if($("#patient_id").val()==""){
            $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
            return false;
        }
        $(':checkbox:checked').each(function(s){
          val[s] = $(this).val();
        });
        $.each(val, function( index, value ) {
            selected[value]=[];
            $('#sub_categories_'+value+' :selected').each(function(i, sel){ 
                selected[value].push($(sel).val());
            });
        });

        var patient_id = $("#patient_id").val();
        var doctor_id = $("#doctor_id").val();
        var appointment_date = $("#appointment_date").val();
        var appointment_time = $("#appointment_time").val();
        if($("#doctor_id").val()==""){
            $("#doctor_id").after('<div class="error">Please Select Doctor</div>');
            return false;
        }else if($("#appointment_date").val()==""){
            $("#appointment_date").after('<div class="error">Please Select Date</div>');
            return false;
        }else if($("#appointment_time").val()==""){
            $("#appointment_time").after('<div class="error">Please Select Time</div>');
            return false;
        }
        $.ajax({
            url: "<?php echo base_url('PatientController/store_patient_more_details');?>",
            data: ({selected:selected,patient_id:patient_id,appointment_date:appointment_date,appointment_time:appointment_time,doctor_id:doctor_id}),
            dataType: 'json', 
            type: 'post',
            success: function(data) {
                if(data.status=='success'){
                Swal.fire({
                    title: data.message,
                    // icon:'success',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                })
            }
            }             
        });
           
    });
});


</script>
