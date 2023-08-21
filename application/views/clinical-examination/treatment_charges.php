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
                        <label class="col-sm-2 col-form-label">Appointment Time *</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Select Time" name="appointment_time" id="appointment_time" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Speciality *</label>
                </div>
                <input type="hidden" name="patient_id" id="patient_id" class="patient_id" >
                
                
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
                    $("#patient_id").val('');
                    return false;
                }else{
                $(data).each(function(key,val){
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
// $(document).on('submit',function(e){
    
//     $(".error").remove();
//     e.preventDefault();
//     if($("#patient_id").val()==""){
//         $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
//         return false;
//     }
//     var patient_id = $("#patient_id").val();
//     var first_name = $("#first_name").val();
//     var last_name = $("#last_name").val();
//     var email_id = $("#email_id").val();
//     var mobile_number = $("#mobile_number").val();
//     var whatsapp_number = $("#whatsapp_number").val();
//     var blood_group = $("#blood_group").val();
//     var birth_date = $("#birth_date").val();
//     var sex = $(".sex").val();
//     var address = $("#address").val();
//     var patient_problem = $("#patient_problem").val();
//     $.ajax({
//         url: "<?php echo base_url('PatientController/update_patient');?>",
//         data: ({patient_id:patient_id,first_name:first_name,last_name:last_name,email_id:email_id,mobile_number:mobile_number,whatsapp_number:whatsapp_number,blood_group:blood_group,birth_date:birth_date,sex:sex,address:address,patient_problem:patient_problem}),
//         dataType: 'json', 
//         type: 'post',
//         success: function(data) {
//             if(data.status=='success'){
//                         Swal.fire({
//                             title: data.message,
                            
//                             allowOutsideClick: false
//                         }).then((result) => {
//                             if (result.isConfirmed) {
//                                 $("#patient_id").val('');
//                                 $("#first_name").val('');
//                                 $("#last_name").val('');
//                                 $("#email_id").val('');
//                                 $("#mobile_number").val('');
//                                 $("#whatsapp_number").val('');
//                                 $("#birth_date").val('');
//                                 $("#address").val('');
//                                 $("#patient_problem").val('');
//                                 $('#blood_group option[value=""]').attr("selected", "selected");
//                                 $("input:radio").prop('checked',false);
//                                 $("#patient_id").val('');
//                             }
//                         })
//                     }else{
//                         $.each(data.message,function(key,value){
//                             var element = $("#"+key);
//                             element.after(value); 
//                         });
//                     }
//         }             
//     });
// });
</script>