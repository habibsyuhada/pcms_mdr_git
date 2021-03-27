<?php
  $req = $req_list[0];
  $user = $user_list;

  //print_r($req);
  //return false;

  if(isset($user[$req['request_by']])){
    $request_by = $user[$req['request_by']]['full_name'];
    $request_badge = $user[$req['request_by']]['badge_no'];
    $request_date = $req['request_date'];
  }
  if(isset($user[$req['approved_by']])){
    $approved_by = $user[$req['approved_by']]['full_name'];
    $approved_badge = $user[$req['approved_by']]['badge_no'];
    $approved_date = $req['approved_date'];
  }
  if(isset($user[$req['authorized_by']])){
    $authorized_by = $user[$req['authorized_by']]['full_name'];
    $authorized_badge = $user[$req['authorized_by']]['badge_no'];
    $authorized_date = $req['authorized_date'];
  }
  if(isset($user[$req['reviewed_by']])){
    $reviewed_by = $user[$req['reviewed_by']]['full_name'];
    $reviewed_badge = $user[$req['reviewed_by']]['badge_no'];
    $reviewed_date = $req['reviewed_date'];
  } else { $reviewed_date = '0000-00-00 00:00:00'; }
  if(isset($user[$req['received_by']])){
    $received_by = $user[$req['received_by']]['full_name'];
    $received_badge = $user[$req['received_by']]['badge_no'];
    $received_date = $req['received_date'];
  }

  
  // print_r($user);
?>
<!DOCTYPE html>
<html><head>
  <title>MR No : <?php echo $req['request_no'] ; ?></title>
  <style type="text/css">
   
    @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 5cm;
      margin-left: 1.5cm;
      margin-right: 1.5cm;
      margin-bottom: 2cm;
     
      font-family: "helvetica";
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
    
    }


    .titleHead {
      border:1px #000 solid;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      background-color: #a6ffa6;
      font-weight: bold;
     
    }

    .titleHeadMain {
      text-align: center;
       border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      font-weight: bold;
    }

    table.table td {
      font-size: 90%;
      border:1px #000 solid;
      font-weight: bold;
    }

    table.table tr {
      font-size: 90%;
      border:1px #000 solid;
      font-weight: bold;
    }

    table.table-body td {
      font-size: 70%;
      border:1px #000 solid;
    }
    table.table-body th {
      font-size: 90%;
      border:1px #000 solid;
    }

    table.table-body tr {
      font-size: 90%;
      border:1px #000 solid;
    }

   
  </style>
</head><body>
  <header>
     <table width='100%'>
        <tr>
          <td><span class="titleHeadMain">MATERIAL REQUISITION</span></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="titleHead">&nbsp;&nbsp;<?php echo $req['request_no'] ?>&nbsp;&nbsp;</span></td>
        </tr>
      </table>
    
       <table class="table" width='100%' style="border:1px #000 solid !important;border-collapse: collapse !important;">
        <tr>
          <td bgcolor="#a6ffa6">Cost Centres / Jobs</td>
          <td bgcolor="#a6ffa6">:</td>
          <td>&nbsp;
            <?php
              foreach ($cost_list as $key => $value) {
                 if($req['project_id'] == $value['id_cost']){
                    echo $value['cost_dept'];
                 }
              }
            ?> 
          </td>
        </tr>
        <tr>
          <td bgcolor="#a6ffa6">Requested By</td>
          <td bgcolor="#a6ffa6">:</td>
          <td>&nbsp;&nbsp;<?php echo (isset($user[$req['request_by']]) ? $user[$req['request_by']]['full_name']." @ " : '') ?><?php echo (isset($request_date) ? date("d-M-Y H:i:s",strtotime($request_date)) : '') ?></td>
        </tr>
        <tr>
          <td bgcolor="#a6ffa6">Approved By (HOD / PM)</td>
          <td bgcolor="#a6ffa6">:</td>
          <td>&nbsp;&nbsp;<?php echo (isset($user[$req['approved_by']]) ? $user[$req['approved_by']]['full_name']." @ " : '') ?><?php echo (isset($approved_date) ? date("d-M-Y H:i:s",strtotime($approved_date)) : '') ?></td>
        </tr>
        <?php if($reviewed_date != '0000-00-00 00:00:00'){ ?>
        <tr>
          <td bgcolor="#a6ffa6">Approved By (CONTRACT)</td>
          <td bgcolor="#a6ffa6">:</td>
          <td>&nbsp;&nbsp;<?php echo (isset($user[$req['reviewed_by']]) ? $reviewed_by." @ " : '') ?><?php echo (isset($authorized_date) ? date("d-M-Y H:i:s",strtotime($reviewed_date)) : '') ?>, <span style='color: red;'>E1402/1111 (Sub/Obj Acct)</span></td>
        </tr>
      <?php } ?>
        <tr>
          <td bgcolor="#a6ffa6">Authorized By (PD)</td>
          <td bgcolor="#a6ffa6">:</td>
          <td>&nbsp;&nbsp;<?php echo (isset($user[$req['authorized_by']]) ? $user[$req['authorized_by']]['full_name']." @ " : '') ?><?php echo (isset($authorized_date) ? date("d-M-Y H:i:s",strtotime($authorized_date)) : '') ?></td>
        </tr>
      </table>
  </header>

  <table class="table-body" width='100%' style="border:1px #000 solid !important;border-collapse: collapse !important;text-align: center;">
   <thead><tr>
        <th bgcolor="#a6ffa6"><b>No</b></th>
        <th bgcolor="#a6ffa6"><b>Item Description</b></th>
        <th bgcolor="#a6ffa6"><b>Grade/Size</b></th>
        <th bgcolor="#a6ffa6"><b>QTY</b></th>
        <th bgcolor="#a6ffa6"><b>UOM</b></th>
        <th bgcolor="#a6ffa6"><b>Cur</b></th>
        <th bgcolor="#a6ffa6"><b>Expected<br>Unit Cost</b></th>
        <th bgcolor="#a6ffa6"><b>Required<br>On-site Date</b></th>
        <th bgcolor="#a6ffa6"><b>Reason(s) /<br>Puspose(s)</b></th>
        <th bgcolor="#a6ffa6"><b>Remarks</b></th>
    </tr></thead>
    <?php $sum = 0; $no=1; foreach ($req_mat_list as $req_mat) : $sum+= $req_mat['expected_cost'];?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $req_mat['description']; ?></td>
        <td><?php echo $req_mat['size']; ?></td>
        <td><?php echo $req_mat['qty']; ?></td>
        <td><?php echo $req_mat['uom']; ?></td>
        <td><?php echo $req_mat['currency_symbol']; ?></td>
        <td><?php echo number_format($req_mat['expected_cost']); ?></td>
        <td><?php echo date("D, d-M-Y",strtotime($req_mat['ros'])); ?></td>
        <td><?php echo $req_mat['reason']; ?></td>
        <td><?php echo $req_mat['remarks']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  
  
</body></html>