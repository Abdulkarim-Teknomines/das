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
                    <label class="col-sm-2 col-form-label">Video Description *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Video Description" name="video_description" value="<?php echo set_value('video_description');?>">
                        <?php echo form_error('video_description');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Video Link </label>
                        <div class="col-sm-10">
                            <input type="video_link" class="form-control" placeholder="Video Link" name="video_link"  id="video_link"  value="<?php echo set_value('video_link');?>">
                            <?php echo form_error('video_link');?>
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Add Video" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>