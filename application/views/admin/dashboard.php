
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
        <form method="post" name="form">
            <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Enter Start Date" name="start_date"  id="start_date" readonly>
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Enter End Date" name="end_date"  id="end_date" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="submit" name="search" class="btn btn-primary text-center m-b-20" value="Search" autocomplete="off">
                </div>
                </div>
            </div>
        </form>

            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center" style="backgroud-color:blue">TODAY APPOINTMNETS</h5>
                            <h2 class="text-right" ><i class="ti-calendar f-left"></i><span id="appointments"><?php echo $appointments;?></span></h2>
                            <p class="m-b-0"><span class="f-right">Appointments</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center">TOTAL BILLING AMOUNT</h5>
                            <h2 class="text-right"><i class="ti-tag f-left"></i><span id="total_billing_amount">43750</span></h2>
                            <p class="m-b-0"><span class="f-right">Bill Amount</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center">AMOUNT RECEIVED</h5>
                            <h2 class="text-right"><i class="ti-reload f-left"></i><span id="amount_received">35230</span></h2>
                            <p class="m-b-0"><span class="f-right">Received Amount</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center">PATIENTS</h5>
                            <h2 class="text-right"><i class="ti-wallet f-left"></i><span id="patient"><?php echo $patient;?></span></h2>
                            <p class="m-b-0"><span class="f-right">Patients</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center">ACTIVE DOCTORS</h5>
                            <h2 class="text-right"><i class="ti-wallet f-left"></i><span id="doctors"><?php echo $doctor;?></span></h2>
                            <p class="m-b-0"><span class="f-right">Doctors</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center">ACTIVE STAFF MEMBERS</h5>
                            <h2 class="text-right"><i class="ti-wallet f-left"></i><span id="staff_member"><?php echo $staff_member;?></span></h2>
                            <p class="m-b-0"><span class="f-right">Members</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h5 class="m-b-20 text-center">NOTIFICATIONS</h5>
                            <ul style="font-size:18px;">
                                <li>Notification - 01</li>
                                <li>Notification - 02</li>
                                <li>Notification - 03</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="styleSelector">
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('form').submit(function(e) {
        e.preventDefault();
        var form_data = $(this);
        $(".error").remove();
        $.ajax({
            url: "<?php echo base_url('AdminController/search_dashboard');?>",
            data: form_data.serialize(),
            dataType: 'json', 
            type: 'post',
            success: function(data) {
                $("#appointments").text(data.appointment);
                $("#staff_member").text(data.staff_member);
                $("#doctors").text(data.doctor);
                $("#patient").text(data.patient);
            }             
        });
    });
    $("#start_date").datepicker({ 
        format: 'yyyy-mm-dd',
        autoclose: true, 
        todayHighlight: true
    });
    $("#end_date").datepicker({ 
        format: 'yyyy-mm-dd',
        autoclose: true, 
        todayHighlight: true
    });
});

</script>                