<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<table border="1">
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
      <th style="background: #28a745; color: white;">Sequantial Number<br>(Doc Type 2 digits+Seq Number)</th>
      <th style="background: #28a745; color: white;">Discipline</th>
      <th style="background: #28a745; color: white;">Project Code</th>
      <th style="background: #28a745; color: white;">Document type</th>
      <th style="background: #28a745; color: white;">System</th>
      <th style="background: #28a745; color: white;">Sub-System</th>
      <th style="background: #28a745; color: white;">Equipment Class</th>
      <th style="background: #28a745; color: white;">Equipment SubClass</th>
      <th style="background: #28a745; color: white;">Criticality</th>
      <th style="background: #28a745; color: white;">Approval Class</th>
      <th style="background: #28a745; color: white;">Status</th>
      <th style="background: #28a745; color: white;">Originator Doc. Number</th>

      <th style="background: #28a745; color: white;">IFR Planned Date</th>
      <th style="background: #28a745; color: white;">IFR Actual Date</th>
      <th style="background: #28a745; color: white;">IFA Planned Date</th>
      <th style="background: #28a745; color: white;">IFA Actual Date</th>
      <th style="background: #28a745; color: white;">AFC Planned Date</th>
      <th style="background: #28a745; color: white;">AFC Actual Date</th>
      <th style="background: #28a745; color: white;">ASB Planned Date</th>
      <th style="background: #28a745; color: white;">ASB Actual Date</th>
      <th style="background: #28a745; color: white;">AFD Planned Date</th>
      <th style="background: #28a745; color: white;">AFD Actual Date</th>
      <th style="background: #28a745; color: white;">IFI Planned Date</th>
      <th style="background: #28a745; color: white;">IFI Actual Date</th>

      <th style="background: #28a745; color: white;">TAG (tag separated with"";"")</th>
      <th style="background: #28a745; color: white;">Cable TAG (tag separated with"";"")</th>
      <th style="background: #28a745; color: white;">Line TAG (tag separated with"";"")</th>
      <th style="background: #28a745; color: white;">SPP TAG (tag separated with"";"")</th>
      <th style="background: #28a745; color: white;">MDR Update  Information</th>
      <th style="background: #28a745; color: white;">Is Interface (true / false)</th>
      <th style="background: #28a745; color: white;">Field Operations  Delivrable (true/false)</th>
      <th style="background: #28a745; color: white;">ASB Required (Y/N)</th>
      <th style="background: #28a745; color: white;">Weight %</th>
      <th style="background: #28a745; color: white;">Progress %</th>
      <th style="background: #28a745; color: white;">Contractor  Transmittal Sheet Number</th>
      <th style="background: #28a745; color: white;">Issue Date Contractor Transmittal Sheet</th>
      <th style="background: #28a745; color: white;">MDR Revision or Change Request nb</th>

      <th style="background: #28a745; color: white;">FDB Volume</th>
      <th style="background: #28a745; color: white;">Work Pack</th>
      <th style="background: #28a745; color: white;">Work Unit</th>
      <th style="background: #28a745; color: white;">Document Generator</th>
      <th style="background: #28a745; color: white;">Brownfield Interface?</th>
      <th style="background: #28a745; color: white;">Folio Drawing?</th>
      
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
      <td nowrap style="text-align: center"><?php echo $list['revision_date'] ?></td>
      <td nowrap style="text-align: center">QA</td><!--Country -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][0] ?><?php echo @$doc_arr[2][1] ?><?php echo @$doc_arr[2][2] ?></td><!--Site -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][3] ?><?php echo @$doc_arr[2][4] ?></td><!--Sector -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[1] ?></td><!--Originator -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[4] ?><?php echo (isset($doc_arr[5]) ? "-".$doc_arr[5] : "") ?></td><!--Sequantial Number (Doc Type 2 digits+Seq Number) -->
      <td nowrap style="text-align: center">="<?php echo @$discipline_list[$list['discipline']]['discipline_code'] ?>"</td><!--Disc. -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[0] ?></td><!--Project Code -->
      <td nowrap style="text-align: center"><?php echo $list['document_type'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['system'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['subsystem'] ?></td><!--Sub-System -->
      <td nowrap style="text-align: center"><?php echo $list['equipment_class'] ?></td><!--EQUIPMENT CLASS -->
      <td nowrap style="text-align: center"><?php echo $list['equipment_subclass'] ?></td><!--EQUIPMENT SUBCLASS -->
      <td nowrap style="text-align: center"><?php echo $list['criticality'] ?></td><!--CRITICALITY -->
      <td nowrap style="text-align: center"><?php echo $list['class'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['status_remark'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['originator_doc_number'] ?></td>

      <td nowrap style="text-align: center"><?php echo ($list['ifr_planned_date'] == '0000-00-00' ? '' : $list['ifr_planned_date']) ?></td><!-- IFR Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFR'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFR'][$key]['transmittal_date']) ?></td><!-- IFR Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['ifa_planned_date'] == '0000-00-00' ? '' : $list['ifa_planned_date']) ?></td><!-- IFA Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFA'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFA'][$key]['transmittal_date']) ?></td><!-- IFA Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['afc_planned_date'] == '0000-00-00' ? '' : $list['afc_planned_date']) ?></td><!-- AFC Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['AFC'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['AFC'][$key]['transmittal_date']) ?></td><!-- AFC Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['asb_planned_date'] == '0000-00-00' ? '' : $list['asb_planned_date']) ?></td><!-- ASB Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['ASB'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['ASB'][$key]['transmittal_date']) ?></td><!-- ASB Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['afd_planned_date'] == '0000-00-00' ? '' : $list['afd_planned_date']) ?></td><!-- IFI Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['AFD'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['AFD'][$key]['transmittal_date']) ?></td><!-- AFD Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['ifi_planned_date'] == '0000-00-00' ? '' : $list['ifi_planned_date']) ?></td><!-- IFI Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFI'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFI'][$key]['transmittal_date']) ?></td><!-- IFI Actual Date -->
      
      <td nowrap style="text-align: center"><?php echo $list['tag'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['cable_tag'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['line_tag'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['spp_tag'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['mdr_update_information'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['interface_doc'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['field_operations_delivrable'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['asb'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['weight'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['progress'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['contractor_transmittal_sheet_number'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['issue_date_contractor_transmittal_sheet'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['mdr_revision_request_nb'] ?></td>

      <td nowrap style="text-align: center"><?php echo $list['fdb_volume'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['wp'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['wu'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['generator'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['brownfield_interface'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['folio_drawing'] ?></td>

    </tr>
    <?php endforeach; endif;?>
  </tbody>
</table>