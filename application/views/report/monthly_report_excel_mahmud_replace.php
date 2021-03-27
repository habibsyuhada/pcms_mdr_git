<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<table border="1" style="">
  <thead>
    <tr>
      <th style="background: #28a745; color: white;text-align: center;" colspan="8"><?php echo $title ?></th>
    </tr>
    <tr>
      <th style="background: #28a745; color: white;text-align: left;">User</th>
      <th style="background: #28a745; color: white;text-align: center;">Category</th>
      <th style="background: #28a745; color: white;text-align: center;">GA (In Hours)</th>
      <th style="background: #28a745; color: white;text-align: center;">Assembly (In Hours)</th>
      <th style="background: #28a745; color: white;text-align: center;">Single Part (In Hours)</th>
      <th style="background: #28a745; color: white;text-align: center;">Nesting (In Hours)</th>
      <th style="background: #28a745; color: white;text-align: center;">WeldMap (In Hours)</th>
      <th style="background: #28a745; color: white;text-align: center;">Procedure &<br>Method Statement (In Hours)</th>
    </tr>
  </thead>
  <tbody>
    <?php if($this->input->post('format') == 'Summary Activity'): ?>
      <?php 
        if($data_user['Drafter']):
        foreach($data_user['Drafter'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Drafter</td>
          <td style="text-align: center;" nowrap><?php echo $data['GA'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['AS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['SP'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NDT'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['PC&MS'] ?></td>
        </tr>
      <?php endforeach; endif;?>

      <?php 
        if($data_user['Checker']):
        foreach($data_user['Checker'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Checker</td>
          <td style="text-align: center;" nowrap><?php echo $data['GA'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['AS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['SP'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NDT'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['PC&MS'] ?></td>
        </tr>
      <?php endforeach; endif;?>

      <?php 
        if($data_user['Engineer']):
        foreach($data_user['Engineer'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Engineer</td>
          <td style="text-align: center;" nowrap><?php echo $data['GA'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['AS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['SP'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NDT'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['PC&MS'] ?></td>
        </tr>
      <?php endforeach; endif;?>
      <?php 
        if($data_user['QC']):
        foreach($data_user['QC'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>QC</td>
          <td style="text-align: center;" nowrap><?php echo $data['GA'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['AS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['SP'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NDT'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['PC&MS'] ?></td>
        </tr>
      <?php endforeach; endif;?>
      <?php 
        if($data_user['Document Control']):
        foreach($data_user['Document Control'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Document Control</td>
          <td style="text-align: center;" nowrap><?php echo $data['GA'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['AS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['SP'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NS'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['NDT'] ?></td>
          <td style="text-align: center;" nowrap><?php echo $data['PC&MS'] ?></td>
        </tr>
      <?php endforeach; endif;?>
    <?php else: ?>
      <?php 
        if($data_user['Drafter']):
        foreach($data_user['Drafter'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Drafter</td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['GA']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['AS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['SP']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NDT']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['PC&MS']) ?></td>
        </tr>
      <?php endforeach; endif;?>

      <?php 
        if($data_user['Checker']):
        foreach($data_user['Checker'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Checker</td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['GA']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['AS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['SP']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NDT']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['PC&MS']) ?></td>
        </tr>
      <?php endforeach; endif;?>

      <?php 
        if($data_user['Engineer']):
        foreach($data_user['Engineer'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Engineer</td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['GA']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['AS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['SP']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NDT']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['PC&MS']) ?></td>
        </tr>
      <?php endforeach; endif;?>

      <?php 
        if($data_user['QC']):
        foreach($data_user['QC'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>QC</td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['GA']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['AS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['SP']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NDT']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['PC&MS']) ?></td>
        </tr>
      <?php endforeach; endif;?>

      <?php 
        if($data_user['Document Control']):
        foreach($data_user['Document Control'] as $data): 
      ?>
        <tr>
          <td style="text-align: left;" nowrap><?php echo $user_list[$data['id_user']]; ?></td>
          <td style="text-align: center;" nowrap>Document Control</td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['GA']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['AS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['SP']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NS']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['NDT']) ?></td>
          <td style="text-align: center;" nowrap><?php echo $func->convert_to_hours_decimal($data['PC&MS']) ?></td>
        </tr>
      <?php endforeach; endif;?>
    <?php endif; ?>
  </tbody>
</table>