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
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Previous Clinical Examinator History</label>
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
                                                    <label id="<?php echo $mh->id;?>-top_left-<?php echo $cat;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $cat;?></label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php foreach($top_right as $cat){ ?>
                                                    <label id="<?php echo $mh->id;?>-top_right-<?php echo $cat;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $cat;?></label>
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
                                                    <label id="<?php echo $mh->id;?>-bottom_left-<?php echo $cat;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $cat;?></label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php foreach($bottom_right as $cat){ ?>
                                                    <label id="<?php echo $mh->id;?>-bottom_right-<?php echo $cat;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $cat;?></label>
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
                                                    <input type="checkbox" class="form-check-input class_categories" name="class_categories" id="<?php echo $mh->id.'-'.$dccc->category_name?>" data-id="<?php echo $mh->id;?>" value="<?php echo $dccc->id;?>" >
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
                                                                <label id="<?php echo $mh->id.'-'.$dccc->id.'-top_left-'.$tl;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $tl;?></label>
                                                            <?php }?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php foreach($top_right as $tl){?>
                                                                <label id="<?php echo $mh->id.'-'.$dccc->id.'-top_right-'.$tl;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $tl;?></label>
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
                                                                <label id="<?php echo $mh->id.'-'.$dccc->id.'-bottom_left-'.$tl;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $tl;?></label>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php foreach($bottom_right as $tl){?>
                                                                <label id="<?php echo $mh->id.'-'.$dccc->id.'-bottom_right-'.$tl;?>" class="class_categories" data-id="<?php echo $mh->id;?>"><?php echo $tl;?></label>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php } } ?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-1 text-right">
                        <input type="button" name="button" class="btn btn-primary text-center m-b-20 back" value="Back" autocomplete="off">
                    </div>
                    <div class="col-sm-1 text-right">
                        <input type="button" name="button" class="btn btn-primary text-center m-b-20 next" value="Next" autocomplete="off">
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
        // $(".").select2("val", "");
        $(".treatment_charges").prop('checked',false);
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
                    if(data.clinical_examinator!=null){
                        var res = data.clinical_examinator.clinical_examinator.split(',');
                        $.each(res,function(key,val){
                            $(".clinical_examinator_category").each(function(){
                                var text = $(this).val();
                                if(text==val){
                                    $(this).prop('checked', true);
                                }
                                $(".class_categories").each(function(){
                                    var id = $(this).attr('id');
                                    if(id==val){
                                        $(this).css("font-weight","bold");
                                    }
                                    if(text==val){
                                        $(this).prop('checked', true);
                                    }
                                });
                            });
                        });
                    }
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
    $(".error").remove();
    var clinical_examinator = [];
    e.preventDefault();
    
    if($("#patient_id").val()==""){
        $("#patient_id_or_number").after('<div class="error">Please Enter Patient ID or Phone Number</div>');
        return false;
    }
    
    var patient_id = $("#patient_id").val();
    $(".clinical_examinator_category:checked").each(function(){
        var text = $(this).val();
        clinical_examinator.push(text);
        $(".class_categories").each(function(){
            var css = $(this).css('font-weight');
            if(text==$(this).attr('data-id')){
                if(css=='700'){
                    clinical_examinator.push($(this).attr('id'));
                }
            }
        });
    });
    
    $.ajax({
        url: "<?php echo base_url('ClinicalExaminationController/store_clinical_examinator_details');?>",
        data: ({patient_id:patient_id,clinical_examinator:clinical_examinator}),
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
</script>
