<div class="wrapper ScrollStyle" id="career_view">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6" style="margin-left:0px; margin-right:10px;">
                    <h1 class="m-0">Employees</h1>
                </div>
            </div>
        </div>

        <div class="col-sm-12" style="margin-left:0px">
            <ol class="breadcrumb float-sm-left">
                <button type="button" class="btn btn-block btn-primary container" id="employees_form"
                    style=" width: 100%">Add</button>
            </ol>
            <ol class="breadcrumb float-sm-right">
                <label class="input-group-text">Date Range:
                    <input type="text" id="date_range" class="form-control ml-3 mr-3" placeholder="Select Date Range">
                    <button class="btn btn-primary mr-3" onclick="filterByDate()">Filter</button></label>

            </ol>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid" style="margin-top: 30px">
            <table class="table table-bordered table-striped" style="text-align: center; background-color: white">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Employee Code</th>
                        <th>Full Name</th>
                        <th>Joining Date</th>
                        <th>Profile Image</th>
                    </tr>
                </thead>
                <tbody id="emp_tbody">

                </tbody>
            </table>

            <div id="pagination"></div>

        </div>
    </section>
</div>