<div class="container">
    <div class="row">
        <div class="col-md-6 mt-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add employee</h3>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                <form name='form'>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmployeecode">Employee code</label>
                            <input type="text" id="emp_code" name="emp_code" class="form-control" readonly>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFirstName">First Name</label>
                            <input type="text" class="form-control" id="first_name" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName">Last Name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                        </div>
                        <!-- <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date" id="emp_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            
                        </div> -->
                        <!-- <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date" id="emp_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#reservationdate" placeholder="Select date">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="datePickerInput">Date:</label>
                            <input type="text" id="emp_date" class="form-control" placeholder="yyyy-mm-dd">
                        </div>


                        <div class="form-group">
                            <label for="stack_image">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="x" class="custom-file-input" id="file-input">
                                    <label class="custom-file-label" for="file-input">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button class="btn btn-primary btnstyle" id="add_emp" type="button">ADD</button>
                            <!--- <div class="dot1"></div> --->
                            <button type="reset" value="Reset" class="btn btn-primary btnstyle"
                                id="ser_cancle_click">Reset</button>
                            <button type="button" class="btn btn-primary btnstyle" id="emp_back">BACK</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
<?php require_once("application/libraries/custom.js");?>
</script>