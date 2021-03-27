<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=".$filename.".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
// print_r($user_list);

 $cost_list = $cost_list[0];
 $req_list = $req_list[0];
 $warna = '#c2d69b';
 // $warna = '#b6dde8';
 
 ?>
 <table>
  <tbody>
    <tr>
      <td colspan="6"><h1>MATERIAL REQUISITION</h1></td>
      <td colspan="4" style="background: <?php echo $warna ?>; vertical-align:middle; border:1px solid;"><h2><?php echo $req_list['request_no']; ?></h2></td>
    </tr>
  </tbody>
</table>
<br>

<table border="1">
  <tbody>
    <tr>
      <td colspan="2" style="background: <?php echo $warna ?>">Cost Centres / Jobs :</td>
      <td colspan="8"><?php echo $cost_list['cost_dept']; ?></td>
    </tr>
    <tr>
      <td colspan="2" style="background: <?php echo $warna ?>">Requested By :</td>
      <td colspan="8"><?php echo $user_list[$req_list['request_by']]['full_name']; ?> @ <?php echo $req_list['request_date'] ?></td>
    </tr>
    <tr>
      <td colspan="2" style="background: <?php echo $warna ?>">Approved By (HOD / PM)  :</td>
      <td colspan="8">
        <?php 
          if(isset($user_list[$req_list['approved_by']])){
            echo $user_list[$req_list['approved_by']]['full_name'].' @ '.$req_list['approved_date'];
          }
        ?>
      </td>
    </tr>
    <?php if(isset($user_list[$req_list['reviewed_by']]) && $req_list['reviewed_date'] != '0000-00-00 00:00:00'): ?>
    <tr>
      <td colspan="2" style="background: <?php echo $warna ?>">Approved By (CONTRACT) :</td>
      <td colspan="8">
        <?php 
          if(isset($user_list[$req_list['reviewed_by']]) && $req_list['reviewed_date'] != '0000-00-00 00:00:00'){
            echo $user_list[$req_list['reviewed_by']]['full_name'].' @ '.$req_list['reviewed_date'];
          }
        ?>
      </td>
    </tr>
    <?php endif;?>
    <tr>
      <td colspan="2" style="background: <?php echo $warna ?>">Authorized By (PD) :</td>
      <td colspan="8">
        <?php 
          if(isset($user_list[$req_list['authorized_by']])){
            echo $user_list[$req_list['authorized_by']]['full_name'].' @ '.$req_list['authorized_date'];
          }
        ?>
      </td>
    </tr>
  </tbody>
</table>
<br>


 
 <table border="1" width="100%">
 
      <thead>
 
           <tr style="background: <?php echo $warna ?>">
 
                <th>No.</th>
                <th align="left">Item Description</th>
                <th>Grade / Size</th>
                <th>QTY</th>
                <th>UOM</th>
                <th>Cur</th>
                <th>Expected Unit Cost</th>
                <th>Required On-site Date</th>
                <th>Reason(s) / Purpose(s)</th>
                <th>Remarks</th>
        
 
           </tr>
 
      </thead>
 
      <tbody>
 
           <?php
              $no = 1;
              $item_list = $this->session->userdata('material');
              if($item_list):
              $max_height = 0;
              $item_list = array_reverse($item_list, true);
              foreach($item_list as $key => $item):
                foreach ($item['file'] as $file) {
                  list($width, $height, $type, $attr) = getimagesize(base_url()."upload/".$file);
                  if($max_height < $height){
                    $max_height = $height/2;
                  }
                }
            ?>
            <tr>
              <td align="center" style="vertical-align:middle"><?php echo $no++; ?></td>
              <td align="left" style="vertical-align:middle"><?php echo $item['m_description'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_size'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_qty'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_uom'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_currency_symbol'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_expected_cost'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_ros'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_reason'] ?></td>
              <td align="center" style="vertical-align:middle"><?php echo $item['m_remark'] ?></td>
            </tr>
            <?php endforeach; endif; $this->session->unset_userdata('material'); ?>
 
      </tbody>
 
 </table>