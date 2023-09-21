<style>
    .error{
        color:red;
    }
</style>
<?php 
$CI =& get_instance();
$CI->load->model('Patient_model');
?>
<div class="card">
    <div class="card-header">
        <div class="card-block">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-2 btn btn-primary text-center m-b-20"><span>Patient Details</span></div>
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
                <!-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Doctor *</label>
                    <div class="col-sm-10">
                    <select class="form-control doctors" name="doctors" id="doctors" >
                        <option value="">Patient Name</option>
                            <?php if(!empty($doctors)){
                                foreach($doctors as $dr){ ?>
                                    <option value="<?php echo $dr->id;?>"><?php echo $dr->full_name;?></option>
                            <?php   }
                            }
                            ?>
                        </select>
                    </div>
                </div> -->
                <input type="hidden" id="patient_id" class="patient_id">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Patient Name *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Patient Name" name="patient_name" id="patient_name" autocomplete="off">
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
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Speciality</label>
                </div>
                <?php foreach($categories as $cat){ ?>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input categories" name="categories[]" id="categories_<?php echo $cat->id;?>" value="<?php echo $cat->id;?>" disabled>
                                <label class="form-label"><?php echo $cat->category_name;?></label>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control sub_categories" name="sub_categories[]" id="sub_categories_<?php echo $cat->id;?>" multiple="multiple" disabled>
                                <option value="">Select Sub Speciality</option>
                                <?php $sub_cat = $CI->Patient_model->get_sub_categories($cat->id);
                                if(!empty($sub_cat)){
                                    foreach($sub_cat as $subcat){ ?>
                                        <option value="<?php echo $subcat->id;?>" ><?php echo $subcat->name;?></option>
                                    <?php   }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Previous Medical History</label>
                </div>
                <div class="form-group row">
                    <?php 
                    if(!empty($clinical_examinator)){
                        foreach($clinical_examinator as $mh){ ?>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input clinical_examinator_category" name="clinical_examinator_category" id="clinical_examinator_category" value="<?php echo $mh->id;?>" >
                                    <label class="form-label"><?php echo $mh->category_name;?></label>
                                    </label>
                                </div>
                                    <?php $sub_cats = $CI->Patient_model->get_class_categories($mh->id);
                                    if(!empty($sub_cats)){ 
                                        foreach($sub_cats as $cat){ ?>
                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-2">
                                                <?php 
                                                $top_left = explode(',',$cat->top_left);
                                                $top_right = explode(',',$cat->top_right);
                                                $bottom_left = explode(',',$cat->bottom_left);
                                                $bottom_right = explode(',',$cat->bottom_right);
                                                foreach($top_left as $cat){ ?>
                                                    <label id="<?php echo $mh->category_name;?>-top_left-<?php echo $cat;?>" class="class_categories"><?php echo $cat;?></label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php foreach($top_right as $cat){ ?>
                                                        <label id="<?php echo $mh->category_name;?>-top_right-<?php echo $cat;?>" class="class_categories"><?php echo $cat;?></label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-4">
                                                <hr style="width:100%;color:#000;margin:0" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-2">
                                                <?php foreach($bottom_left as $cat){ ?>
                                                    <label id="<?php echo $mh->category_name;?>-bottom_left-<?php echo $cat;?>" class="class_categories"><?php echo $cat;?></label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php foreach($bottom_right as $cat){ ?>
                                                    <label id="<?php echo $mh->category_name;?>-bottom_right-<?php echo $cat;?>" class="class_categories"><?php echo $cat;?></label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php   } } ?>
                                    <?php $deep_caries_class = $CI->Patient_model->get_deep_caries_class($mh->id); ?>
                                        <div class="row">
                                            <?php foreach($deep_caries_class as $dccc){ ?>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input class_categories" name="class_categories" id="<?php echo $mh->category_name.'-'.$dccc->category_name?>" value="<?php echo $dccc->id;?>" >
                                                    <label class="form-label"><?php echo $dccc->category_name;?></label>
                                                </div>
                                            
                                                <?php $deep_caries_class_cat = $CI->Patient_model->get_deep_caries_class_category($dccc->id); ?>

                                                <?php 
                                                foreach($deep_caries_class_cat as $d_c_c_c){ 
                                                    $top_left = explode(',',$d_c_c_c->top_left);
                                                    $top_right = explode(',',$d_c_c_c->top_right);
                                                    $bottom_left = explode(',',$d_c_c_c->bottom_left);
                                                    $bottom_right = explode(',',$d_c_c_c->bottom_right);
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-4">
                                                            <?php foreach($top_left as $tl){ ?>
                                                                <label id="<?php echo $mh->category_name.'-'.$dccc->category_name.'-top_left-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                            <?php }?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php foreach($top_right as $tl){?>
                                                                <label id="<?php echo $mh->category_name.'-'.$dccc->category_name.'-top_right-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-4">
                                                            <hr style="width:100%;color:#000;margin:0" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-1"></div>
                                                        <div class="col-sm-4">
                                                            <?php foreach($bottom_left as $tl){?>
                                                                <label id="<?php echo $mh->category_name.'-'.$dccc->category_name.'-bottom_left-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                            <?php }?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php foreach($bottom_right as $tl){?>
                                                                <label id="<?php echo $mh->category_name.'-'.$dccc->category_name.'-bottom_right-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php } } ?>
                </div>
                
                <!-- <div class="form-group row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2 text-right">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Update" autocomplete="off">
                    </div>
                </div> -->
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script>
  $(document).ready(function(){
    $(".class_categories").click(function(){
        var css = $(this).css('font-weight');
        if(css==400){
            $(this).css("font-weight","bold");
        }else{
            $(this).removeAttr("style");
        }
    });
    $(".sub_categories").select2({
        placeholder: "Select Sub Speciality",
        theme: "classic",
    });
   
    $("#appointment_date").datepicker({ 
        format: 'yyyy-mm-dd',
        autoclose: true, 
        todayHighlight: true
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
            url: "<?php echo base_url('ClinicalExaminationController/search_patient_details');?>",
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
                        $("#patient_id").val(val.patient_master_id);
                        $("#patient_name").val(val.first_name+' '+val.last_name);
                        $("#appointment_date").val(val.appointment_date);
                        $("#appointment_time").val(val.appointment_time);
                        $.ajax({
                            url: "<?php echo base_url('ClinicalExaminationController/patient_categories');?>",
                            data: ({patient_id:val.id}),
                            dataType: 'json', 
                            type: 'post',
                            success: function(data) {
                                $.each(data, function (i) {
                                    var result = data[i].sub_category_id.split(',');
                                    $('#categories_'+data[i].category_id).prop('checked', true);  
                                    $.each(result, function (j) {
                                        $("#sub_categories_"+data[i].category_id).find("option[value="+result[j]+"]").prop("selected", "selected");
                                        $("#sub_categories_"+data[i].category_id).select2({theme:"classic"}).trigger('change');
                                    });
                                });
                            }
                        });
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
$(".label").click(function(){
    console.log($(this).text());
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
