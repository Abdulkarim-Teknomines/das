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
                    if(!empty($diagnosis_category)){
                        foreach($diagnosis_category as $mh){ ?>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input diagnosis_category_category" name="clinical_examinator_category" id="clinical_examinator_category" value="<?php echo $mh->id;?>" >
                                    <label class="form-label"><?php echo $mh->category_name;?></label>
                                    </label>
                                </div>
                                <?php $sub_cats = $CI->Patient_model->get_diagnosis_sub_categories($mh->id); ?>
                                <div class="row">
                                    <?php 
                                    foreach($sub_cats as $scs){ ?>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input class_categories" name="class_categories" id="<?php echo $mh->category_name.'-'.$scs->category_name; ?>" value="<?php echo $scs->id;?>" >
                                                <label class="form-label"><?php echo $scs->category_name;?></label>
                                            </div>
                                            <?php $deep_caries_class_cat = $CI->Patient_model->get_diagnosis_sub_categories_class($scs->id); ?>
                                                <?php foreach($deep_caries_class_cat as $d_c_c_c){
                                                    $top_left = explode(',',$d_c_c_c->top_left);
                                                    $top_right = explode(',',$d_c_c_c->top_right);
                                                    $bottom_left = explode(',',$d_c_c_c->bottom_left);
                                                    $bottom_right = explode(',',$d_c_c_c->bottom_right);
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($top_left as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-'.$scs->category_name.'-top_left-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($top_right as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-'.$scs->category_name.'-top_right-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <hr style="width:100%;color:#000;margin:0" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($bottom_left as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-'.$scs->category_name.'-bottom_left-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($bottom_right as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-'.$scs->category_name.'-bottom_right-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                
                                                <?php } ?> 
                                                
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                                    <?php $sub_catsd = $CI->Patient_model->get_diagnosis_cagegory_class($mh->id); 
                                        if(!empty($sub_catsd)){
                                            foreach($sub_catsd as $sbc){ 
                                                $top_left = explode(',',$sbc->top_left);
                                                $top_right = explode(',',$sbc->top_right);
                                                $bottom_left = explode(',',$sbc->bottom_left);
                                                $bottom_right = explode(',',$sbc->bottom_right);
                                                ?>
                                               <div class="col-sm-1"> </div>
                                               <div class="col-sm-11">
                                               <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($top_left as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-top_left-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($top_right as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-top_right-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <hr style="width:100%;color:#000;margin:0" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($bottom_left as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-bottom_left-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php foreach($bottom_right as $tl){ ?>
                                                            <label id="<?php echo $mh->category_name.'-bottom_right-'.$tl;?>" class="deep_caries_class_cat"><?php echo $tl;?></label>
                                                            
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                               </div>
                                            <?php }
                                        }
                                    ?>
                            </div>
                    <?php } } ?>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2 text-right">
                        <input type="button" name="button" class="btn btn-primary text-center m-b-20 submit" value="Submit" autocomplete="off">
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
        icons: {
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
        }
    });
    
    $("#search").click(function(){
        $(".categories").prop('checked',false);
        $(".sub_categories").val('null').trigger("change");
        
        $(".treatment_charges").prop('checked',false);
        $(".error").remove();
        if($("#patient_id_or_number").val()==""){
            $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
            return false;
        }
        var patient_id_number = $("#patient_id_or_number").val();
        var patient_id = $("#patient_id").val();
        $.ajax({
            url: "<?php echo base_url('ClinicalExaminationController/search_patient_details');?>",
            data: ({patient_id_number:patient_id_number,patient_id:patient_id}),
            dataType: 'json', 
            type: 'post',
            success: function(data) {
                if(data.patient_details.length<=0){
                    $("#patient_id_or_number").after('<div class="error">No Record Found</div>');
                    return false;
                }else{
                    $(data.patient_details).each(function(key,val){
                        $("#patient_name").val(val.first_name+' '+val.last_name);
                        $("#appointment_date").val(val.appointment_date);
                        $("#appointment_time").val(val.appointment_time);
                        // $.ajax({
                        //     url: "<?php echo base_url('ClinicalExaminationController/patient_categories');?>",
                        //     data: ({patient_id:val.id}),
                        //     dataType: 'json', 
                        //     type: 'post',
                        //     success: function(data) {
                        //         $.each(data, function (i) {
                        //             var result = data[i].sub_category_id.split(',');
                        //                 $('#categories_'+data[i].category_id).prop('checked', true);  
                        //                 $.each(result, function (j) {
                        //                     $("#sub_categories_"+data[i].category_id).find("option[value="+result[j]+"]").prop("selected", "selected");
                        //                     $("#sub_categories_"+data[i].category_id).select2({theme:"classic"}).trigger('change');
                        //                 });
                        //         });
                        //     }
                        // });
                    });
                    if(data.categories.length>0){
                        $.each(data.categories, function (i) {
                            var result = data.categories[i].sub_category_id.split(',');
                            $('#categories_'+data.categories[i].category_id).prop('checked', true);
                            
                            $.each(result, function (j) {
                                $("#sub_categories_"+data.categories[i].category_id).find("option[value="+result[j]+"]").prop("selected", "selected");
                                $("#sub_categories_"+data.categories[i].category_id).select2({theme:"classic"}).trigger('change');
                            });
                        });
                    }
                    // if(data.treatment_charges!=null){
                    //     var res = data.treatment_charges.treatment_charges_id.split(',');
                    //     $.each(res,function(key,val){
                    //         $("#treatment_charges_"+val).prop('checked',true);
                    //     });
                    // }
                    
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
$("#submit").click(function(e){
    e.preventDefault();
    
})

</script>
