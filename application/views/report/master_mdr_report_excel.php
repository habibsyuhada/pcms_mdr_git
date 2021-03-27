<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<table border="1" style="">
  <thead>
    <tr>
      <th style="background: #28a745; color: white;">COMPANY Document number</th>
      <th style="background: #28a745; color: white;">Document Title</th>
      <th style="background: #28a745; color: white;">Revision</th>
      <th style="background: #28a745; color: white;">Revision Date</th>
      <th style="background: #28a745; color: white;">Country</th>
      <th style="background: #28a745; color: white;">Site</th>
      <th style="background: #28a745; color: white;">Sector</th>
      <th style="background: #28a745; color: white;">Originator</th>
      <th style="background: #28a745; color: white;">Sequantial Number (Doc Type 2 digits+Seq Number)</th>
      <th style="background: #28a745; color: white;">Discipline Code</th>
      <th style="background: #28a745; color: white;">Discipline Name</th>
      <th style="background: #28a745; color: white;">Project Code</th>
      <th style="background: #28a745; color: white;">Document type</th>
      <th style="background: #28a745; color: white;">System</th>
      <th style="background: #28a745; color: white;">Sub-System</th>
      <th style="background: #28a745; color: white;">Approval Class</th>

      <th style="background: #28a745; color: white;">Planned IFR Date</th>
      <th style="background: #28a745; color: white;">Actual Date for IFR</th>
      
      <th style="background: #28a745; color: white;">Planned IFA Date</th>
      <th style="background: #28a745; color: white;">Actual Date for IFA</th>
      
      <th style="background: #28a745; color: white;">Planned AFC Date</th>
      <th style="background: #28a745; color: white;">Actual Date for AFC</th>
      
      <th style="background: #28a745; color: white;">Planned IFI Date</th>
      <th style="background: #28a745; color: white;">Actual Date for IFI</th>
      
      <th style="background: #28a745; color: white;">ASB Required(Y/N)</th>
      <th style="background: #28a745; color: white;">Document Generator</th>
      <th style="background: #28a745; color: white;">DNV? (Review - R/Info - I)</th>
      <th style="background: #28a745; color: white;">Remarks 1</th>
      <th style="background: #28a745; color: white;">Remarks 2</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      if($mdr_lists):
        foreach($mdr_lists as $key => $list):
          $doc_arr = explode("-", $list['ref_no']);
    ?>
    <tr>
      <td nowrap style="text-align: left"><?php echo $list['ref_no'] ?></td>
      <td nowrap style="text-align: left"><?php echo $list['description'] ?></td>
      <td nowrap style="text-align: center">="<?php echo $list['revision_no'] ?>"</td>
      <td nowrap style="text-align: center"><?php echo ($list['revision_date'] == '0000-00-00' ? '' : $list['revision_date']) ?></td>
      <td nowrap style="text-align: center">QA</td><!--Country -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][0] ?><?php echo @$doc_arr[2][1] ?><?php echo @$doc_arr[2][2] ?></td><!--Site -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][3] ?><?php echo @$doc_arr[2][4] ?></td><!--Sector -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[1] ?></td><!--Originator -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[4] ?><?php echo (isset($doc_arr[5]) ? "-".$doc_arr[5] : "") ?></td><!--Sequantial Number (Doc Type 2 digits+Seq Number) -->
      <td nowrap style="text-align: center">="<?php echo @$discipline_list[$list['discipline']]['discipline_code'] ?>"</td>
      <td nowrap style="text-align: center"><?php echo @$discipline_list[$list['discipline']]['discipline_name'] ?></td>
      <td nowrap style="text-align: center"><?php echo @$doc_arr[0] ?></td><!--Project Code -->
      <td nowrap style="text-align: center"><?php echo $list['document_type'] ?></td>
      <td nowrap style="text-align: center">="<?php echo $list['system'] ?>"</td>
      <td nowrap style="text-align: center">="<?php echo $list['subsystem'] ?>"</td><!--Sub-System -->
      <td nowrap style="text-align: center"><?php echo $list['class'] ?></td>

      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFR'][$key]['planned_date'] == '0000-00-00' ? '' :  @$mdr_status['IFR'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFR'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFR'][$key]['transmittal_date']) ?></td>

      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFA'][$key]['planned_date'] == '0000-00-00' ? '' :  @$mdr_status['IFA'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFA'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFA'][$key]['transmittal_date']) ?></td>

      <td nowrap style="text-align: center"><?php echo (@$mdr_status['AFC'][$key]['planned_date'] == '0000-00-00' ? '' :  @$mdr_status['AFC'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['AFC'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['AFC'][$key]['transmittal_date']) ?></td>

      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFI'][$key]['planned_date'] == '0000-00-00' ? '' :  @$mdr_status['IFI'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFI'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFI'][$key]['transmittal_date']) ?></td>
      
      <td nowrap style="text-align: center"><?php echo $list['asb'] ?></td><!--ASB Required(Y/N) -->
      <td nowrap style="text-align: center"><?php echo $list['generator'] ?></td><!--Document Generator -->
      <td nowrap style="text-align: center"><?php echo $list['dnv'] ?></td><!--DNV? (Review - R/Info - I) -->
      <td nowrap style="text-align: center"><?php echo $list['remarks'] ?></td><!--Remarks 1 -->
      <td nowrap style="text-align: center"><?php echo $list['remarks2'] ?></td><!--Remarks 2 -->
    </tr>
    <?php endforeach; endif;?>
    <?php 
      if($vendor_lists):
        foreach($vendor_lists as $key => $list):
          $doc_arr = explode("-", $list['ref_no']);
    ?>
    <tr>
      <td nowrap style="text-align: left"><?php echo $list['ref_no'] ?></td>
      <td nowrap style="text-align: left"><?php echo $list['description'] ?></td>
      <td nowrap style="text-align: center">="<?php echo $list['revision_no'] ?>"</td>
      <td nowrap style="text-align: center"><?php echo ($list['revision_date'] == '0000-00-00' ? '' : $list['revision_date']) ?></td>
      <td nowrap style="text-align: center"></td><!--Country -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][0] ?><?php echo @$doc_arr[2][1] ?><?php echo @$doc_arr[2][2] ?></td><!--Site -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][3] ?><?php echo @$doc_arr[2][4] ?></td><!--Sector -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[1] ?></td><!--Originator -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[4] ?><?php echo (isset($doc_arr[5]) ? "-".$doc_arr[5] : "") ?></td><!--Sequantial Number (Doc Type 2 digits+Seq Number) -->
      <td nowrap style="text-align: center">="<?php echo @$discipline_list[$list['discipline']]['discipline_code'] ?>"</td>
      <td nowrap style="text-align: center"><?php echo @$discipline_list[$list['discipline']]['discipline_name'] ?></td>
      <td nowrap style="text-align: center"><?php echo @$doc_arr[0] ?></td><!--Project Code -->
      <td nowrap style="text-align: center"><?php echo $list['document_type'] ?></td>
      <td nowrap style="text-align: center">="<?php echo $list['system'] ?>"</td>
      <td nowrap style="text-align: center">="<?php echo $list['subsystem'] ?>"</td><!--Sub-System -->
      <td nowrap style="text-align: center"><?php echo $list['class'] ?></td>

      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFR'][$key]['planned_date'] == '0000-00-00' ? '' :  @$vendor_status['IFR'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFR'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['IFR'][$key]['transmittal_date']) ?></td>

      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFA'][$key]['planned_date'] == '0000-00-00' ? '' :  @$vendor_status['IFA'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFA'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['IFA'][$key]['transmittal_date']) ?></td>

      <td nowrap style="text-align: center"><?php echo (@$vendor_status['AFC'][$key]['planned_date'] == '0000-00-00' ? '' :  @$vendor_status['AFC'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['AFC'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['AFC'][$key]['transmittal_date']) ?></td>

      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFI'][$key]['planned_date'] == '0000-00-00' ? '' :  @$vendor_status['IFI'][$key]['planned_date']) ?></td>
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFI'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['IFI'][$key]['transmittal_date']) ?></td>
      
      <td nowrap style="text-align: center"><?php echo $list['asb'] ?></td><!--ASB Required(Y/N) -->
      <td nowrap style="text-align: center"><?php echo "VENDOR - ".$list['vendor_code'] ?></td><!--Document Generator -->
      <td nowrap style="text-align: center"><?php echo $list['dnv'] ?></td><!--DNV? (Review - R/Info - I) -->
      <td nowrap style="text-align: center"><?php echo $list['remarks'] ?></td><!--Remarks 1 -->
      <td nowrap style="text-align: center"><?php echo $list['remarks2'] ?></td><!--Remarks 2 -->
    </tr>
    <?php endforeach; endif;?>
    <?php 
      if($activity_lists):
        foreach($activity_lists as $key => $list):
    ?>
    <tr>
      <td nowrap style="text-align: left"><?php echo $list['document_no'] ?></td>
      <td nowrap style="text-align: left"><?php echo $list['title'] ?></td>
      <?php for ($i=0; $i < 27; $i++): ?>
      <td nowrap style="text-align: center"></td>
      <?php endfor;?>
    </tr>
    <?php endforeach; endif;?>
  </tbody>
</table>