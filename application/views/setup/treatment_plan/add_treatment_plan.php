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
                    <label class="col-sm-2 col-form-label">Treatment Plan *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter Treatment Plan" name="treatment_plan" value="<?php echo set_value('treatment_plan');?>">
                        <?php echo form_error('treatment_plan');?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Price" name="price"  id="price"  value="<?php echo set_value('price');?>">
                            <?php echo form_error('price');?>
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Add Price" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>