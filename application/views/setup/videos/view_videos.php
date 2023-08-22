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
                <table class="table table-hover" id="view_videos">
                    <thead>
                        <tr>
                            <th>Video Description</th>
                            <th>Video Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    
// $(document).ready(function(){
    
var table =  $('#view_videos').DataTable({
  processing:false,
  serverSide:false,
  pageLength:10,   
  bDestroy: true,
  info:false,
  bLengthChange: false,
  searching: false,
  ajax:{
    "url":'<?php echo base_url('SetupController/view_video_detail'); ?>',
    "type": "POST",
    "dataType": "json",
    data: function (d) {
        
    }
  },                    
});
$(document).on('click','.edit',function(){
    var video_id = $(this).attr('data-id');
    window.location.href="<?php echo base_url('edit_videos/')?>"+video_id;
});
// });
</script>