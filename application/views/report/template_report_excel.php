<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<table border="1" style="">
  <thead>
    <tr>
      <th style="background: #28a745; color: white;text-align: center;" colspan="3">Summary for <?php echo $from_date ?> - <?php echo $to_date ?></th>
    </tr>
    <tr>
      <th style="background: #28a745; color: white;text-align: left;">Employee Name</th>
      <th style="background: #28a745; color: white;text-align: center;">Joint</th>
      <th style="background: #28a745; color: white;text-align: center;">Piecemark</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      if($data_excel):
      foreach($data_excel as $key => $data): 
    ?>
      <tr>
        <td style="text-align: left;" nowrap><?php echo @$user_list[$key]; ?></td>
        <td style="text-align: center;" nowrap><?php echo @$data['num_joint']+0 ?></td>
        <td style="text-align: center;" nowrap><?php echo @$data['num_piece_mark']+0 ?></td>
      </tr>
    <?php endforeach; endif;?>
  </tbody>
</table>