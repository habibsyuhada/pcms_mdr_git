<?php
  $req = $req_list[0];
  $user = $user_list;
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
  }
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
      margin-top: 2cm;
      margin-left: 2cm;
      margin-right: 2cm;
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
      padding-left: 2cm;
      line-height: 1.5cm;
    }


    .text-bold{
      font-weight: bold;
    }
    .table{
      font-size: 9px;
    }
    .br{
      border-right: 1px #000 solid;
    }
    .bt{
      border-top: 1px #000 solid;
    }
    .bx{
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }
    .bb{
      border-bottom:  1px #000 solid;
    }
  </style>
</head><body>
  <header>
    <img src="./img/logo.png" height="50%" />
  </header>
  
  <table width="100%">
    <tr>
      <th><h3>Material / Service Requisition Form</h3></th>
    </tr>
  </table>
  <table class="table" border="0" width="100%" cellspacing="0" cellpadding="5">
		<tr>
      <td class="text-bold bt bx">Project</td>
      <td colspan="2" class="text-bold bx bt">Request by </td>
      <td colspan="2" class="text-bold bx bt">Approved by</td>
      <td colspan="2" class="text-bold bx bt">Authorized by</td>
      <td class="text-bold br bt">Request No</td>
    </tr>
    <tr>
      <td class="bx">
        <?php
          foreach ($cost_list as $key => $value) {
            if($req['project_id'] == $value['id_cost']){
              echo $value['cost_dept'];
            }
          }
        ?> 
      </td>
      <td width="20">Name</td>
      <td class="br">: <?php echo (isset($user[$req['request_by']]) ? $user[$req['request_by']]['full_name'] : '') ?></td>
      <td width="20">Name</td>
      <td class="br">: <?php echo (isset($user[$req['approved_by']]) ? $user[$req['approved_by']]['full_name'] : '') ?></td>
      <td width="20">Name</td>
      <td class="br">: <?php echo (isset($user[$req['authorized_by']]) ? $user[$req['authorized_by']]['full_name'] : '') ?></td>
      <td class="br"><?php echo $req['request_no'] ?></td>
    </tr>
    <tr>
      <td class="bx"><!-- Project No. --></td>
      <td></td>
      <td class="br">&nbsp; <?php echo (isset($request_badge) ? $request_badge : '') ?></td>
      <td></td>
      <td class="br">&nbsp; <?php echo (isset($approved_badge) ? $approved_badge : '') ?></td>
      <td></td>
      <td class="br">&nbsp; <?php echo (isset($authorized_badge) ? $authorized_badge : '') ?></td>
      <td class="br"></td>
    </tr>
    <tr>
      <td class="bx bb"><?php //echo $req['project_id'] ?></td>
      <td class="bb">Date</td>
      <td class="br bb">: <?php echo (isset($request_date) ? $request_date : '') ?></td>
      <td class="bb">Date</td>
      <td class="br bb">: <?php echo (isset($approved_date) ? $approved_date : '') ?></td>
      <td class="bb">Date</td>
      <td class="br bb">: <?php echo (isset($authorized_date) ? $authorized_date : '') ?></td>
      <td class="br bb"></td>
    </tr>
    <tr>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td class="text-bold">Received By</td>
      <td colspan="7">: <?php echo (isset($received_by) ? $received_by : '') ?></td>
    </tr>
    <tr>
      <td class="text-bold">Badge</td>
      <td colspan="7">: <?php echo (isset($received_badge) ? $received_badge : '') ?></td>
    </tr>
    <tr>
      <td class="text-bold">Date</td>
      <td colspan="7">: <?php echo (isset($received_date) ? $received_date : '') ?></td>
    </tr>
  </table>
  <br>
  <table class="table" border="1" width="100%" cellspacing="0" cellpadding="2">
    <thead><tr class="text-bold">
      <td align="center">S/N</td>
      <td align="center">Description</td>
      <td align="center">UOM</td>
      <td align="center">Qty</td>
      <td align="center" colspan="2">Expected Unit Cost</td>
      <td align="center">Required On-site Date</td>
      <td align="center">Reason / Purpose</td>
      <td align="center">Remark</td>
    </tr></thead>
    <?php $sum = 0; $no=1; foreach ($req_mat_list as $req_mat) : $sum+= $req_mat['expected_cost'];?>
    <tr>
      <td align="center"><?php echo $no++; ?></td>
      <td align="center"><?php echo $req_mat['description']; ?></td>
      <td align="center"><?php echo $req_mat['uom']; ?></td>
      <td align="center"><?php echo $req_mat['qty']; ?></td>
      <td align="center"><?php echo $req_mat['currency_symbol']; ?></td>
      <td align="center"><?php echo number_format($req_mat['expected_cost']); ?></td>
      <td align="center"><?php echo date("D, d-M-Y",strtotime($req_mat['ros'])); ?></td>
      <td align="center"><?php echo $req_mat['reason']; ?></td>
      <td align="center"><?php echo $req_mat['remarks']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td align="center" colspan="4"><b>TOTAL</b></td>
      <td align="center"><b><?php echo $req_mat['currency_symbol']; ?></b></td>
      <td colspan="4"><b>&nbsp;&nbsp;<?php echo number_format($sum); ?></b></td>
    </tr>
  </table>
</body></html>