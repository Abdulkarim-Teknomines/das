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
                    <label class="col-sm-2 col-form-label btn btn-primary text-center m-b-20">Video Details *</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Video Title *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Video Title" name="video_title" id="video_title" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Video Description * </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" placeholder="Video Description" name="video_description"  id="video_description" autocomplete="off"></textarea>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Video Link * </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Video Link" name="video_link"  id="video_link" autocomplete="off">
                        </div>
                </div>
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
<script>
  $(document).ready(function(){
    $('form').submit(function(e) {
        e.preventDefault();
        var form_data = $(this);
        $(".error").remove();
            $.ajax({
                url: "<?php echo base_url('EducationVideosController/save_videos');?>",
                data: form_data.serialize(),
                dataType: 'json', 
                type: 'post',
                success: function(data) {
                    if(data.status=='success'){
                        Swal.fire({
                            title: data.message,
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form_data[0].reset();
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
//     }
    });
    $("#birth_date").datepicker({ 
        format: 'dd-mm-yyyy',
        autoclose: true, 
        todayHighlight: true,

    });
    
});
</script>
