<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>Employees Data</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
  <script src="dist/js/adminlte.min.js"></script>
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/popupstyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<style>

/* Modal Content */
.modal-content {
  /* background-color: red; */
    margin: auto;
    padding-right:20px;
    padding-left:20px;
    padding-top:10px;
    padding-bottom:20px;
    /* padding: 20px; */
    border: 1px solid #888;
    width: 100%;
}
.modal-header{
/* background-color:#0c0; */
padding-top: 0px;
padding-bottom:0px;
 border-bottom: 0px solid #fff;
}
.modal-body{
  position: relative;
  padding: 5px;
}
.modal-footer{
  padding: 0px;
    text-align: right;
    border-top: 0px solid #fff;
}
/* The Close Button */
.close {
  color: #000;
  /* margin-left:600px; */
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
} 
#data tr {  
  display: none;  
} 
.ScrollStyle
{
    overflow-y: auto;
    overflow-x: hidden;
    max-height : calc(100vh - 30px - 30px)
}
a:hover
{
  cursor: pointer;
}
.fa-trash-alt, .fa-edit, .fa-eye
{
  cursor: pointer;
  margin:5px;
  font-size:20px;
}
.fa-eye:hover, .fa-trash-alt:hover, .fa-edit:hover
{
	color: blue;
}

</style>  
</head>
<body class="hold-transition sidebar-mini">

<script src="plugins/jquery/jquery.min.js"></script>


