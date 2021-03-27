<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>PORTAL | <?php echo $meta_title ?></title>


    <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.png"/>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/bootstrap.min.js"></script>

    <!-- Font Awasome -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Fusion -->
    <link href="<?php echo base_url();?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Jquery UI --><!-- 
    <link href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.js"></script> -->

    <style>

      .bg-white{
        background: white;
      }

      .bg-aqua{
        background: #00c0ef;
      }

      .bg-yellow{
        background: #f39c12;
      }

      .bg-green-smoe{
        background-color:#008060;
      }

      .btn-flat{
        border-radius: 0px;
      }

      .btn-green-smoe{
        background-color:#008060;
        border-color: #008060;
      }

      .btn-green-smoe:hover{
        background-color:#006D52;
        border-color: #006D52;
      }

      table.dataTable thead {font-family:arial;background-color:#008060;color:white;font-size: 17px;}
      table.dataTable tbody {font-family:arial;background-color:white;color:black;font-size: 14px;}

      
    </style>

    <?php

      if($read_cookies[0] == ''){
      
        redirect("../portal/");

      } 

    ?>
    <!-- Custom styles for this template -->
  </head>