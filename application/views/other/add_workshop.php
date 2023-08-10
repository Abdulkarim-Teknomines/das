<style>
    .error{
        color:red;
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="card-block">
        <?php if($this->session->flashdata('success')){?>
            <div class="alert alert-success"> <?= $this->session->flashdata('success') ?> </div>
            <?php $this->session->unset_userdata('success');?>
        <?php } ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Workshop Name *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Workshop Name" name="workshop_name" value="<?php echo set_value('workshop_name');?>" autocomplete="off">
                        <?php echo form_error('workshop_name');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Speaker *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Speaker" name="speaker"  id="speaker"  value="<?php echo set_value('speaker');?>"  autocomplete="off">
                            <?php echo form_error('speaker');?>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Workshop Topic *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Topic" name="workshop_topic"  id="workshop_topic"  value="<?php echo set_value('workshop_topic');?>"  autocomplete="off">
                            <?php echo form_error('workshop_topic');?>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Date *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" placeholder="DD-MM-YYYY" name="date"  id="date"  value="<?php echo set_value('date');?>"  autocomplete="off">
                            <?php echo form_error('date');?>
                        </div>
                        <label class="col-sm-2 col-form-label">Time *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="HH:MM" name="time"  id="time"  value="<?php echo set_value('time');?>"  autocomplete="off">
                            <?php echo form_error('time');?>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Meeting Link *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Meeting Link" name="meeting_link"  id="meeting_link"  value="<?php echo set_value('meeting_link');?>"  autocomplete="off">
                            <?php echo form_error('meeting_link');?>
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"rel="stylesheet"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"> -->
    </script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
 
    <!-- Include Moment.js CDN -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"> -->
    </script>
 
    <!-- Include Bootstrap DateTimePicker CDN -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"rel="stylesheet"> -->
 
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> -->
    


    <script>
        $(function () {
            $(".date").datepicker({ 
                format: 'dd-mm-yyyy',
                autoclose: true, 
                todayHighlight: true,

            });
        });
        $('#time').datetimepicker({
            format: 'HH:mm'
        });

    </script>
    