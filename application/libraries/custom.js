 // Define Global base path...
var base_url = 'http://localhost/omni_sol/'

$(document).ready(function() 
{
    getEmployeeDetails(1);
    getNextEmpCode();

}); 

$(function () {
    $('#date_range').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        opens: 'left'
    });
});


$("#employees_form").on("click",function(event){
    window.location = 'employeesForm';
});

$("#emp_back").on("click", function(event) {
    window.location =  'addemployee';
});

function getNextEmpCode(){
    $.ajax({
        url: base_url + 'Employees/getNextEmpCode', // Endpoint to get the next employee code
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                $('#emp_code').val(response.emp_code); // Set the employee code in the input field
            } else {
                console.log("Error fetching employee code");
            }
        },
        error: function () {
            console.log("AJAX error fetching employee code");
        }
    });
}


function filterByDate(page = 1) {
    const dateRange = $('#date_range').val();
    let [start_date, end_date] = dateRange.split(' - ');

    $.ajax({
        url: base_url + 'Employees/getEmployeeDetails',
        dataType: 'json',
        method: 'GET',
        data: { page: page, limit: 5, start_date: start_date, end_date: end_date },
        success: function (response) {
            if (response.success) {
                renderData(response.employee);
                renderPagination(response.total_pages, page);
            } else {
                $("#emp_tbody").html("<tr><td colspan='5'>No employees found</td></tr>");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error: ", status, error);
        }
    });
}

function renderData(data) {
    let html = '';
    data.forEach(emp => {
        html += `<tr>
                    <td>${emp.emp_id}</td>
                    <td>${emp.emp_code}</td>
                    <td>${emp.first_name} ${emp.last_name}</td>
                    <td>${emp.date}</td>
                    <td><img src="${base_url}Upload/${emp.profile_image}" class="stack_img" alt="Profile Image" onerror="this.src='${base_url}Upload/default.png';"></td>
                 </tr>`;
    });
    $("#emp_tbody").html(html);
}

/*
Module Name: Get employee details..
Dev name: Harshita
Date: 09/Feb/2025
Purpose:  This function is used to Get employee details..
*/

function getEmployeeDetails(page = 1) {  
    $.ajax({
        url: base_url + 'Employees/getEmployeeDetails',
        dataType: 'json',
        method: 'GET',
        data: { page: page, limit: 5 },  // Pass pagination parameters
        success: function (response) {
            if (response.success) {
                $("#emp_tbody").html(""); // Clear previous data

                let html = '';
                response.employee.forEach(emp => {
                    html += `<tr>
                                <td>${emp.emp_id}</td>
                                <td>${emp.emp_code}</td>
                                <td>${emp.first_name} ${emp.last_name}</td>
                                <td>${emp.date === '0000-00-00'? 'NULL' :emp.date }</td>
                                <td><img src="${base_url}Upload/${emp.profile_image}" class="stack_img" alt="Profile Image" onerror="this.src='${base_url}Upload/default.png';"></td>
                              </tr>`;
                });

                $("#emp_tbody").append(html);
                renderPagination(response.total_pages, page);
            } else {
                $("#emp_tbody").html("<tr><td colspan='5'>No employees found</td></tr>");
            }
        },
        error: function (xhr, status, error) {
            // console.error("AJAX Error: ", status, error);
            // console.error("Response Text:", xhr.responseText); // Print response for debugging
        }
    });
}

/*
Module Name: Render Pagination..
Dev name: Harshita
Date: 09/Feb/2025
Purpose:  This function is used to render pagination..
*/

function renderPagination(totalPages, currentPage) {
    let paginationHtml = '<ul class="pagination">';

    for (let i = 1; i <= totalPages; i++) {
        paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                                <a href="javascript:void(0);" class="page-link" onclick="getEmployeeDetails(${i})">${i}</a>
                           </li>`;
    }
    paginationHtml += '</ul>';
    $("#pagination").html(paginationHtml);
}

/*
Module Name: Add Employess..
Dev name: Harshita
Date: 07/Feb/2025
Purpose:  This function is used to add employess..
*/

$('#add_emp').on("click", function(event){
    let emp_code = $("#emp_code").val();
    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let date = $("#emp_date").val();  // ✅ Default to empty if not provided
    let profile_image = $("#file-input").prop('files')[0];
    if (!first_name) {
        alert("First Name is required.");
        return;
    } 
    if (!last_name) {
        alert("Last Name is required.");
        return;
    }

    var data = new FormData();
    data.append('emp_code', emp_code);
    data.append('first_name', first_name);
    data.append('last_name', last_name);
    data.append('date', date);
    
    if (profile_image) {
        data.append('profile_image', profile_image);
    } 

    $.ajax({
        url: base_url + 'Employees/addEmployees',
        type: "POST",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            
        }
    });
    window.location =  'addemployee';
});
