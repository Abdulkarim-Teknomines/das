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
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
        </div>
    </div>
</div>
