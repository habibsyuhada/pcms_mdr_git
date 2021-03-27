<?php 
  // error_reporting(0);
  // if(empty($read_cookies[9])){
  //   redirect($read_cookies[9]);
  // }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo $meta_title ?></title>


    <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.png"/>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/bootstrap.min.js"></script>

    <!-- Font Awasome -->
    <link href="<?php echo base_url();?>assets/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/datatables/buttons.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/buttons.flash.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/buttons.html5.min.js"></script>

    <!-- SweetAlert2 -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- JQUERY UI -->
    <link href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.js"></script>

    <!-- CanvasJS -->
    <script src="<?php echo base_url();?>assets/canvasjs/canvasjs.min.js"></script>

    <!-- Highcharts -->
    <script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
   
    <!-- <script src="https://cdnjs.com/libraries/Chart.js"></script>   -->
    <!-- Jquery UI -->
    <link href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.js"></script>

    <!-- DatePicker -->
    <link href="<?php echo base_url();?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Selct2 -->
    <link href="<?php echo base_url();?>assets/select2/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/select2/select2-bs4.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/select2/select2.min.js"></script>
    <!-- Sidebar -->
    <link href="<?php echo base_url();?>assets/sidebar/style.css" rel="stylesheet">

    <!-- Bootstrap select -->
    <link href="<?php echo base_url();?>assets/bootstrap_select/bootstrap-select.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap_select/bootstrap-select.min.js"></script>

    <!-- Zebra -->
    <link href="<?php echo base_url();?>assets/dist_zebra_date_picker/css/default/zebra_datepicker.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/dist_zebra_date_picker/zebra_datepicker.min.js"></script>

    <!-- Floating Scroll -->
    <link href="<?php echo base_url();?>assets/floating-scroll/jquery.floatingscroll.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/floating-scroll/jquery.floatingscroll.min.js"></script>

    <!-- Dropzone -->
    <link href="<?php echo base_url();?>assets/dropzone/dropzone.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/dropzone/dropzone.js"></script>

    <!-- Push Notif -->
    <script type="text/javascript" src="<?= base_url() ?>assets/push-notif/push.js"></script>

    <!-- Socket -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>assets/socket/css/message.css"> -->
    <!-- <script src="<?php //echo base_url()?>assets/socket/js/message.js"></script> -->
    <!-- <script src="<?php //echo base_url()?>assets/socket/websocket/fancywebsocket.js"></script> -->
    <style>
      #content{
        overflow: auto;
      }
      .bg-white{
        background: white;
      }
      .bg-aqua{
        background: #00c0ef;
      }
      .bg-yellow{
        background: #f39c12;
      }
      .bg-orange {
        background-color: #FF851B !important;
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
      .dropdown-toggle.collapsed::after{
        border-left: .3em solid;
        border-top: .3em solid transparent;
        border-right: 0;
        border-bottom: .3em solid transparent;
      }
      .font-size-9{
        font-size: 0.9rem;
      }
      .checkbox-big{
        width: 1.2rem;
        height: 1.2rem;
      }

      .table-min-width-200 th:not(.dismiss-200){
        min-width: 200px;
        white-space: nowrap!important;
      }
      .select2 {
        width:100%!important;
      }
      .bg-alert-warning{
        background-color: #fff3cd!important;
        color: #856404!important;
      }
    </style>

<!-- <script>
  function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
  }
</script>
<script>
  $( function() {
    $( "#dpjq" ).datepicker({
        //isRTL: true,
        dateFormat: "yy-mm-dd 23:59:59",
        changeMonth: true,
        changeYear: true
      });
  } );
  </script>
  <script>
    var Server;
 
    Server = new FancyWebSocket('ws://127.0.0.1:9300');
 
    //tangkap apakah ada action dr client manapun
    Server.bind('message', function( payload ) {
        switch (payload) {
            case 'tobingmsg':
               dhtmlx.message({
                    'text': "From other at "+new Date().toLocaleString(),
                    'expire': -1
                });
               break;
            case 'tobingerror':
               dhtmlx.message({
                    'text': "From other at "+new Date().toLocaleString(),
                    'expire': -1,
                    'type' : 'error',
                });
                break;   
        }
    });
      
    Server.connect();
 
 
    //kirim pesan tobingmsg
    function send() {
        //munculkan pesan buat diri sendiri
        dhtmlx.message({
            'text': "From you at "+new Date().toLocaleString(),
            'expire': -1
        });
 
        //sampaikan ke server bahwa telah terjadi action
        Server.send( 'message', 'tobingmsg' );
    }
 
    //kirim pesan tobingerror
    function senderror() {
        //munculkan pesan buat diri sendiri
        dhtmlx.message({
            'text': "From you at "+new Date().toLocaleString(),
            'expire': -1,
            'type' : 'error'
        });
 
        //sampaikan ke server bahwa telah terjadi action
        Server.send( 'message', 'tobingerror' );
    }
</script> -->
  </head>