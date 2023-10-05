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
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover" id="list_videos">
                        <thead>
                            <tr>
                                <th>Video Title</th>
                                <th>Video Description</th>
                                <th>Video Link</th>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<script type="text/javascript" src=" https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>

var table =  $('#list_videos').DataTable({
  processing:false,
  serverSide:false,
  pageLength:10,   
  bDestroy: true,
  info:false, 
  bLengthChange: false,
  searching: true,
  ajax:{
    "url":'<?php echo base_url('EducationVideosController/list_videos_details'); ?>',
    "type": "POST",
    "dataType": "json",
    data: function (d) {

    }
  },                    
});
</script>