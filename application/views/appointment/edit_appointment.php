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
                <div class="col-sm-12 text-right"><input type="button" name="submit" class="btn btn-dark text-center m-b-20 edit" value="Edit"></div>
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
    $(".edit").click(function(){
        window.location.href="<?php echo base_url('edit_appointments/') ?>"+appointment_id;
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