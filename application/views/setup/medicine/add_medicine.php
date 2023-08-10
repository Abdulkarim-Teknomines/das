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
                    <label class="col-sm-2 col-form-label">Type of Medicine *</label>
                    <div class="col-sm-10">
                        <select class="form-control"  name="medicine_type_id" value="<?php echo set_value('medicine_type_id');?>">
                            <option value="">Select Medicine Type</option>
                            <?php 
                            if(!empty($medicine_type)){
                                foreach($medicine_type as $m_type){ ?>
                                    <option value="<?php echo $m_type['id'];?>" <?php echo set_select('medicine_type_id',$m_type['id']);?>><?php echo $m_type['name']?></option>
                                <?php }
                            } ?>
                        </select>
                        <?php echo form_error('medicine_type_id');?>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Medicine *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Medicine Name" name="medicine_name" value="<?php echo set_value('medicine_name');?>">
                        <?php echo form_error('medicine_name');?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary text-center m-b-20" value="Add Medicine" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>