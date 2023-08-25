<style>
    .error{
        color:red;
    }
    table.dataTable thead tr {
        background-color: #000;
        color:#fff;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="card-block">
        <?php if($this->session->flashdata('success')){?>
            <div class="alert alert-success"> <?= $this->session->flashdata('success') ?> </div>
            <?php $this->session->unset_userdata('success');?>
        <?php } ?>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label text-right">Month </label>
            <div class="col-sm-2">
                <select class="form-control month" name="month" id="month">
                    <option value="">Select Month</option>
                    <?php if(!empty($month)){
                        foreach($month as $key=>$val){ 
                            
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $val;?></option>
                    <?php   }
                    }
                    ?>
                </select>
            </div>
            <label class="col-sm-2 col-form-label text-right">Year </label>
            <div class="col-sm-2">
                <select class="form-control year" name="year" id="year">
                    <option value="">Select Year</option>
                    <?php if(!empty($year)){
                        foreach($year as $yr){ 
                            
                            ?>
                            <option value="<?php echo $yr;?>"><?php echo $yr;?></option>
                    <?php   }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-9 text-right"><input type="button" name="submit" class="btn btn-dark text-center m-b-20 fet_details" value="Fetch Details"></div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover" id="view_appointments">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Date</th>
                            <th>TIme</th>
                            <th>Doctor</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Treatment</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right"><input type="button" name="submit" class="btn btn-dark text-center m-b-20 view_details" value="View Details"></div>
            </div>
        </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<script type="text/javascript" src=" https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    
$(document).ready(function(){
    var appointment_id = '';

    $(document).on("change",'.appointment_id',function(){
        appointment_id = $(this).val();
    });

    $(".view_details").click(function(){
        if(appointment_id==""){
            return false;
        }else{
            window.location.href="<?php echo base_url('view_appointment_details/') ?>"+appointment_id;
        }
    });
});
$(".fet_details").click(function(){
    $(".error").remove();
    if($("#month").val()==""){
        $("#month").after('<div class="error">Select Month</div>');
        return false;
    }else if($("#year").val()==""){
        $("#year").after('<div class="error">Select Year</div>');
        return false;
    }
    var month = $("#month").val();
    var year = $("#year").val();
    var table =  $('#view_appointments').DataTable({
        processing:false,
        serverSide:false,
        pageLength:10,   
        bDestroy: true,
        info:false,
        bLengthChange: false,
        searching: false,
        ajax:{
            "url":'<?php echo base_url('AppointmentController/view_appointment_details'); ?>',
            "type": "POST",
            "dataType": "json",
            data: function (d) {
                d.month = month;
                d.year = year;
            }
        },                    
    });    
});
var table =  $('#view_appointments').DataTable({
  processing:false,
  serverSide:false,
  pageLength:10,   
  bDestroy: true,
  info:false,
  bLengthChange: false,
  searching: false,
  ajax:{
    "url":'<?php echo base_url('AppointmentController/view_appointment_details'); ?>',
    "type": "POST",
    "dataType": "json",
    data: function (d) {

    }
  },                    
});
</script>