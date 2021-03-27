<!DOCTYPE html>
<html><head>
  <title><?php echo $meta_title ?>.pdf</title>
  <style type="text/css">
   
    @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 3.5cm;
      margin-left: 1.5cm;
      margin-right: 1.5cm;
      margin-bottom: 1cm;
      font-family: "helvetica";
      font-size: 11px;
    }

    header {
      position: fixed;
      top: 0cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;
      padding-top: 15px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 100%;
    }

    table.table td {
      font-size: 90%;
      border:1px #000 solid;
      font-weight: bold;
      max-width: 150px;
      word-wrap: break-word;
    }

    table>thead>tr>td,table>tbody>tr>td{
      vertical-align: top;
    }

    .br_break{
      line-height: 15px;
    }

    .br_break_no_bold{
      line-height: 18px;
    }

    .br{
      border-right: 1px #000 solid;
    }
    .bl{
      border-left: 1px #000 solid;
    }
    .bt{
      border-top: 1px #000 solid;
    }
    .bb{
      border-bottom:  1px #000 solid;
    }
    .bb-double{
      border-bottom:  4px #000 double;
    }
    .bx{
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }
    .by{
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
    }
    .ball{
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }
    .table-bordered th,
    .table-bordered td {
      border: 1px solid #000;
    }
    .tab{
      display: inline-block; 
      width: 130px;
    }
    .tab2{
      display: inline-block; 
      width: 130px;
    }
    .text-nowrap{
      white-space: nowrap;
    }
    .valign-middle{
      vertical-align: middle;
    }
    .text-right{
      text-align: right;
    }
    .text-center{
      text-align: center;
    }
    .text-white{
      color: white;
    }
    .page_break { 
      page-break-before: always; 
    }

    .bg-success {
      background-color: #28a745!important;
    }
    tbody > tr:nth-child(even) {
      background-color: #f2f2f2;
      }
  </style>
</head><body>

  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center">
    <tbody><tr>
    <td style="height: 800px;" class="valign-middle">
      <h1>PT. SMOE</h1>
      <h1><br><br><br></h1>
      <h2>WEEKLY REPORT FOR <?php echo strtoupper($project_list[$project]) ?> PROJECT</h2>
      <h2>PCMS - ENGINEERING ACTIVITY</h2>
      <h3><i><?php echo $date_from." - ".$date_to ?></i></h3>
    </td>
    </tr></tbody>
  </table>
  <div class="page_break"></div>

  <header>
  	<table cellpadding="18" cellspacing="0px" width="100%" style="margin-top: 20px">
      <thead><tr>
        <td class="bb-double" width='1%'><img src="data:image/png;base64,<?php echo $logo ?>" style="width: 150px;"></td>
        <td class="bb-double valign-middle text-right"><b>WEEKLY REPORT<br><?php echo strtoupper($project_list[$project]) ?> PROJECT</b><br><i style="font-size: 10px;"><?php echo $date_from." - ".$date_to ?></i></td>
      </tr></thead>
  	</table>
  </header>
  <h3 style="margin-top: 0px"><i>A. Summary Document</i></h3>
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th colspan="4">Modeler</th>
    </tr><tr>
      <th>Open</th>
      <th>In-Progress</th>
      <th>Completed</th>
      <th>Revised</th>
    </tr></thead>
    <tbody><tr>
    <td><?php echo $modeler[$project]['modeler_open'] ?></td>
    <td><?php echo $modeler[$project]['modeler_outstanding'] ?></td>
    <td><?php echo $modeler[$project]['modeler_complete'] ?></td>
    <td><?php echo $modeler[$project]['modeler_revise'] ?></td>
    </tr></tbody>
  </table>
  <br>
  <br>

  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th colspan="3">Drafter</th>
    </tr><tr>
      <th>Open</th>
      <th>In-Progress</th>
      <th>Completed</th>
    </tr></thead>
    <tbody><tr>
    <td><?php echo $total_type[$project]['drafter_open'] ?></td>
    <td><?php echo $total_type[$project]['drafter_inprogress'] ?></td>
    <td><?php echo $total_type[$project]['drafter_complete'] ?></td>
    </tr></tbody>
  </table>
  <br>
  <br>
  
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th colspan="3">Checker</th>
    </tr><tr>
      <th>Open</th>
      <th>In-Progress</th>
      <th>Completed</th>
    </tr></thead>
    <tbody><tr>
    <td><?php echo $total_type[$project]['checker_open'] ?></td>
    <td><?php echo $total_type[$project]['checker_inprogress'] ?></td>
    <td><?php echo $total_type[$project]['checker_complete'] ?></td>
    </tr></tbody>
  </table>
  <br>
  <br>

  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th colspan="3">Engineer</th>
    </tr><tr>
      <th>Open</th>
      <th>In-Progress</th>
      <th>Completed</th>
    </tr></thead>
    <tbody><tr>
    <td><?php echo $total_type[$project]['engineer_open'] ?></td>
    <td><?php echo $total_type[$project]['engineer_inprogress'] ?></td>
    <td><?php echo $total_type[$project]['engineer_complete'] ?></td>
    </tr></tbody>
  </table>
  <br>
  <br>
  
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th>Revised Document</th>
      <th>Transmitted Document</th>
    </tr></thead>
    <tbody><tr>
      <td><?php echo $total_type[$project]['revised'] ?></td>
      <td><?php echo $total_type[$project]['transmitted'] ?></td>
    </tr></tbody>
  </table>

  <div class="page_break"></div>

  <h3><i>B. Summary Modeler Activity</i></h3>
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th>Modeler</th>
      <th>Total Design</th>
      <th>Total Manhours</th>
    </tr></thead>
    <tbody><?php foreach ($modeler_user[$project] as $key => $value):?><tr>
      <td><?php echo $user_list[$key] ?></td>
      <td><?php echo $value['num'] ?></td>
      <td><?php echo $value['sec'] ?></td>
    </tr><?php endforeach; ?>
    <?php if (!isset($modeler_user[$project])):?><tr>
      <td colspan="3">No Data</td>
    </tr><?php endif; ?></tbody>
  </table>

  <div class="page_break"></div>
  
  <h3><i>C. Summary Drafter Activity</i></h3>
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th>Drafter</th>
      <th>Total Document</th>
      <th>Total Manhours</th>
    </tr></thead>
    <tbody><?php foreach ($data_role_num[$project]['Drafter'] as $key => $value):?><tr>
      <td><?php echo $user_list[$value['id_user']] ?></td>
      <td><?php echo $value['num'] ?></td>
      <td><?php echo $value['sec'] ?></td>
    </tr><?php endforeach; ?></tbody>
  </table>

  <div class="page_break"></div>
  
  <h3><i>D. Summary Checker Activity</i></h3>
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th>Checker</th>
      <th>Total Document</th>
      <th>Total Manhours</th>
    </tr></thead>
    <tbody><?php foreach ($data_role_num[$project]['Checker'] as $key => $value):?><tr>
      <td><?php echo $user_list[$value['id_user']] ?></td>
      <td><?php echo $value['num'] ?></td>
      <td><?php echo $value['sec'] ?></td>
    </tr><?php endforeach; ?></tbody>
  </table>

  <div class="page_break"></div>
  
  <h3><i>E. Summary Engineer Activity</i></h3>
  <table cellpadding="5" cellspacing="0px" width="100%" class="text-center table-bordered">
    <thead class="bg-success text-white"><tr>
      <th>Engineer</th>
      <th>Total Document</th>
      <th>Total Manhours</th>
    </tr></thead>
    <tbody><?php foreach ($data_role_num[$project]['Engineer'] as $key => $value):?><?php if(!in_array($value['id_user'], array(1000286, 1000108))): ?><tr>
      <td><?php echo $user_list[$value['id_user']] ?></td>
      <td><?php echo $value['num'] ?></td>
      <td><?php echo $value['sec'] ?></td>
    </tr><?php endif; ?><?php endforeach; ?></tbody>
  </table>

  <footer>
  	
  </footer>
</body></html>