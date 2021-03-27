<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<table border="1" style="">
  <thead>
    <tr>
      <th style="background: #28a745; color: white;text-align: center;" colspan="4"><?php echo $title ?></th>
    </tr>
    <tr>
      <th style="background: #28a745; color: white;text-align: left;">User</th>
      <th style="background: #28a745; color: white;text-align: center;">Category</th>
      <th style="background: #28a745; color: white;text-align: center;">AL-SHAHEEN GALLAF (In Hours)</th>
      <th style="background: #28a745; color: white;text-align: center;">FORMOSA 2 (In Hours)</th>
    </tr>
  </thead>
  <tbody>
    <?php if($this->input->post('format') == 'Summary Activity Modeler'): ?>
      <?php 
        if($data_user['Modeler']):
        foreach($data_user['Modeler'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_design_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Modeler</td>
          <td style="text-align: center;" nowrap><?php echo $data['gallaf'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['formosa'] ?></td>
        </tr>
      <?php endforeach; endif;?>
    <?php else: ?>
      <?php 
        if($data_user['Modeler']):
        foreach($data_user['Modeler'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_design_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Modeler</td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['gallaf']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['formosa']) ?></td>
        </tr>
      <?php endforeach; endif;?>
    <?php endif; ?>
  </tbody>
</table>