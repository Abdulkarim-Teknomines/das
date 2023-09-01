<style>
    .error{
        color:red;
    }
    table.dataTable thead tr {
        background-color: #000;
        color:#fff;
    }
</style>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
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
                        $mon = date('m');
                        foreach($month as $key=>$val){ ?>
                            <option value="<?php echo $key;?>" ><?php echo $val;?></option>
                    <?php   } } ?>
                </select>
            </div>
            <label class="col-sm-2 col-form-label text-right">Year </label>
            <div class="col-sm-2">
                <select class="form-control year" name="year" id="year">
                    <option value="">Select Year</option>
                    <?php if(!empty($year)){
                        foreach($year as $yr){ ?>
                            <option value="<?php echo $yr;?>"><?php echo $yr;?></option>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9 text-right">
                <input type="button" name="submit" class="btn btn-dark text-center m-b-20 fet_details" value="Fetch Details">
            </div>
        </div>
        <div class="row text-center calender-div"  style="border:1px solid">
            <div class="col-sm-12 text-center">
                <div id="calendar" style="width:80%;margin:0 auto;" ></div>
            </div>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".calender-div").attr('display:none');
    });
    $(document).on('click','.fet_details',function(){
        var mn = $("#month").val();
        var yr = $("#year").val();
        $(".calender-div").attr('display:block');
        var events = [];
        $.ajax({
                        url: '<?php echo base_url()?>/AppointmentController/load',
                        type: 'POST',
                        data:{month:mn,year:yr},
                        success:function(data)
                        {
                            // $.each(JSON.parse(data), function (i) {
                                // console.log(data);
                                // data_val.push(data);
                                
                                $.each(JSON.parse(data), function(key,val) {
                                    
                                    
                                    
                                // $.each(val, function(key, value) {
                                   
                                    events.push({title: val.title , start: val.start,color:'red'});
                                // });
                                // $('.fc-day[data-date="'+data[i].date+'"').css('background', '#ff00cc');
                            });
                            
                        }
                    });
                    console.log(events);
        $('#calendar').fullCalendar({
            editable:true,
                header:{
                    left:'',
                    center:'title',
                    right:''
                },
                eventLimit: true,
                // events:function(start, end, timezone, callback) {
                //     var mn = $("#month").val();
                //     var yr = $("#year").val();
                    
                //     console.log(data_val);
                // },

                events:events,
                // events: [
                //     {
                //         title: 'All Day Event',
                //         start: '2023-08-01',
                //         color: 'red',
                //         textColor: 'white',
                //     },
                //     {
                //         title: 'Long Event',
                //         start: '2023-08-02',
                //         color: 'red',
                //         textColor: 'white',
                //     },
                    
                //     {
                //         title: 'Birthday Party',
                //         start: '2023-08-01'
                //     },
                //     {
                //         title: 'Click for Google',
                //         url: 'http://google.com/',
                //         start: '2023-08-01'
                //     }
                // ],
                selectable:true,
                selectHelper:true,
                select:function(start, end, allDay)
                {
                    
                    var selected_date = moment(start).format('YYYY-MM-DD');
                    window.location.href="<?php echo base_url(); ?>AppointmentController/fetch_data?date="+selected_date;
                        // $.ajax({
                            // url:"<?php echo base_url(); ?>AppointmentController/fetch_data",
                            // type:"POST",
                            // data:{selected_date:selected_date},
                            // success:function(data)
                            // {
                            //     console.log(data);
                            // }
                        // })
                },
        });
        $('#calendar').fullCalendar( 'addEventSource', events );
        $('#calendar').fullCalendar('gotoDate', yr+'-'+mn);
    });
    
</script>