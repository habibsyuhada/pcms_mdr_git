<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<table border="1">
  <thead>
    <tr>
      <th style="background: #28a745; color: white;">DOCUMENT NUMBER</th>
      <th style="background: #28a745; color: white;">DOCUMENT TITLE</th>
      <th style="background: #28a745; color: white;">Approval CLASS</th>
      <th style="background: #28a745; color: white;">COUNTRY</th>
      <th style="background: #28a745; color: white;">PROJECT CODE</th>
      <th style="background: #28a745; color: white;">ORIGINATOR</th>
      <th style="background: #28a745; color: white;">SITE</th>
      <th style="background: #28a745; color: white;">SECTOR</th>
      <th style="background: #28a745; color: white;">DISC.</th>
      <th style="background: #28a745; color: white;">DOC TYPE</th>
      <th style="background: #28a745; color: white;">SEQUENTIAL. NO.</th>
      <th style="background: #28a745; color: white;">W.P.</th>
      <th style="background: #28a745; color: white;">W.U.</th>
      <th style="background: #28a745; color: white;">SYST</th>
      <th style="background: #28a745; color: white;">SUBSYST</th>
      <th style="background: #28a745; color: white;">Package</th>
      <th style="background: #28a745; color: white;">PO No.</th>
      <th style="background: #28a745; color: white;">Company Originator</th>
      <th style="background: #28a745; color: white;">CTR-Lead</th>
      <th style="background: #28a745; color: white;">Interface Doc(Y/N)</th>
      <th style="background: #28a745; color: white;">AS-BUILT (Y/N)</th>

      <th style="background: #28a745; color: white;">Revision</th>
      <th style="background: #28a745; color: white;">Status</th>
      <th style="background: #28a745; color: white;">CPY Code</th>
      <th style="background: #28a745; color: white;">CPY Leader</th>
      <th style="background: #28a745; color: white;">CPY Approver</th>
      <th style="background: #28a745; color: white;">CTR Transmittal No.</th>
      <th style="background: #28a745; color: white;">CTR Transmittal Date</th>
      <th style="background: #28a745; color: white;">VENDOR Transmittal No.</th>
      <th style="background: #28a745; color: white;">VENDOR TS Date</th>

      <th style="background: #28a745; color: white;">IFR Planned Date</th>
      <th style="background: #28a745; color: white;">IFR Actual Date</th>
      <th style="background: #28a745; color: white;">IFA Planned Date</th>
      <th style="background: #28a745; color: white;">IFA Actual Date</th>
      <th style="background: #28a745; color: white;">AFC Planned Date</th>
      <th style="background: #28a745; color: white;">AFC Actual Date</th>
      <th style="background: #28a745; color: white;">ASB Planned Date</th>
      <th style="background: #28a745; color: white;">ASB Actual Date</th>
      <th style="background: #28a745; color: white;">IFI Planned Date</th>
      <th style="background: #28a745; color: white;">IFI Actual Date</th>

      <th style="background: #28a745; color: white;">MWS Mark-up</th>
      <th style="background: #28a745; color: white;">MWS TS-Out No.</th>
      <th style="background: #28a745; color: white;">MWS TS-Out Date</th>
      <th style="background: #28a745; color: white;">MWS Doc Revision</th>
      <th style="background: #28a745; color: white;">MWS Review Status / Code</th>
      <th style="background: #28a745; color: white;">MWS TS-In No.</th>
      <th style="background: #28a745; color: white;">MWS TS-In Date</th>

      <th style="background: #28a745; color: white;">CA-DNV Mark-Up</th>
      <th style="background: #28a745; color: white;">CA TS-Out No.</th>
      <th style="background: #28a745; color: white;">CA TS-Out Date</th>
      <th style="background: #28a745; color: white;">CA Doc Revision</th>
      <th style="background: #28a745; color: white;">CA Review Status / Code</th>
      <th style="background: #28a745; color: white;">CA TS-In No.</th>
      <th style="background: #28a745; color: white;">CA TS-In Date</th>
      
    </tr>
  </thead>
  <tbody>
    <?php 
      if($mdr_lists):
        foreach($mdr_lists as $key => $list):
          $doc_arr = explode("-", $list['ref_no']);
          $ctr_transmittal_date = @$mdr_status['IFR'][$key]['transmittal_date'];
          $ctr_transmittal_no = @$mdr_status['IFR'][$key]['transmittal_no'];
          if($ctr_transmittal_date < @$mdr_status['ASB'][$key]['transmittal_date']){
            $ctr_transmittal_date = @$mdr_status['ASB'][$key]['transmittal_date'];
            $ctr_transmittal_no = @$mdr_status['ASB'][$key]['transmittal_no'];
          }
          if($ctr_transmittal_date < @$mdr_status['IFA'][$key]['transmittal_date']){
            $ctr_transmittal_date = @$mdr_status['IFA'][$key]['transmittal_date'];
            $ctr_transmittal_no = @$mdr_status['IFA'][$key]['transmittal_no'];
          }
          if($ctr_transmittal_date < @$mdr_status['AFC'][$key]['transmittal_date']){
            $ctr_transmittal_date = @$mdr_status['AFC'][$key]['transmittal_date'];
            $ctr_transmittal_no = @$mdr_status['AFC'][$key]['transmittal_no'];
          }
          if($ctr_transmittal_date < @$mdr_status['IFI'][$key]['transmittal_date']){
            $ctr_transmittal_date = @$mdr_status['IFI'][$key]['transmittal_date'];
            $ctr_transmittal_no = @$mdr_status['IFI'][$key]['transmittal_no'];
          }

          $data_mws = !empty($mws_list[$list['id']]) ? $mws_list[$list['id']] : [];
          $data_dnv = !empty($dnv_list[$list['id']]) ? $dnv_list[$list['id']] : [];
    ?>
    <tr>
      <td nowrap style="text-align: left"><?php echo $list['ref_no'] ?></td>
      <td nowrap style="text-align: left"><?php echo $list['description'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['class'] ?></td>
      <td nowrap style="text-align: center">QA</td><!--Country -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[0] ?></td><!--Project Code -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[1] ?></td><!--Originator -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][0] ?><?php echo @$doc_arr[2][1] ?><?php echo @$doc_arr[2][2] ?></td><!--Site -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][3] ?><?php echo @$doc_arr[2][4] ?></td><!--Sector -->
      <td nowrap style="text-align: center">="<?php echo $discipline_list[$list['discipline']]['discipline_code'] ?>"</td><!--Disc. -->
      <td nowrap style="text-align: center"><?php echo $list['document_type'] ?></td>
      <td nowrap style="text-align: center"><?php echo @$doc_arr[4] ?><?php echo (isset($doc_arr[5]) ? "-".$doc_arr[5] : "") ?></td><!--Sequantial Number (Doc Type 2 digits+Seq Number) -->
      <td nowrap style="text-align: center"><?php echo $list['wp'] ?></td><!-- W.P. -->
      <td nowrap style="text-align: center"><?php echo $list['wu'] ?></td><!-- W.U. -->
      <td nowrap style="text-align: center">="<?php echo $list['system'] ?>"</td>
      <td nowrap style="text-align: center">="<?php echo $list['subsystem'] ?>"</td><!--Sub-System -->
      <td nowrap style="text-align: center"></td><!-- Package -->
      <td nowrap style="text-align: center"></td><!-- PO No. -->
      <td nowrap style="text-align: center"><?php echo $list['generator'] ?></td><!--Company Generator -->
      <td nowrap style="text-align: center"><?php echo $list['ctr_lead'] ?></td><!-- CTR-Lead -->
      <td nowrap style="text-align: center"><?php echo $list['interface_doc'] ?></td><!-- Interface Doc(Y/N) -->
      <td nowrap style="text-align: center"><?php echo $list['asb'] ?></td><!--ASB Required(Y/N) -->

      <td nowrap style="text-align: center">="<?php echo $list['revision_no'] ?>"</td>
      <td nowrap style="text-align: center">="<?php echo $list['status_remark'] ?>"</td>
      <td nowrap style="text-align: center"></td><!-- CPY Code -->
      <td nowrap style="text-align: center"></td><!-- CPY Leader -->
      <td nowrap style="text-align: center"></td><!-- CPY Approver -->
      <td nowrap style="text-align: center"><?php echo $ctr_transmittal_no ?></td><!-- CTR Transmittal No. -->
      <td nowrap style="text-align: center"><?php echo ($ctr_transmittal_date == '0000-00-00' ? '' : $ctr_transmittal_date) ?></td><!-- CTR Transmittal Date -->
      <td nowrap style="text-align: center"></td><!-- VENDOR Transmittal No. -->
      <td nowrap style="text-align: center"></td><!-- VENDOR TS Date -->

      <td nowrap style="text-align: center"><?php echo ($list['ifr_planned_date'] == '0000-00-00' ? '' : $list['ifr_planned_date']) ?></td><!-- IFR Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFR'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFR'][$key]['transmittal_date']) ?></td><!-- IFR Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['ifa_planned_date'] == '0000-00-00' ? '' : $list['ifa_planned_date']) ?></td><!-- IFA Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFA'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFA'][$key]['transmittal_date']) ?></td><!-- IFA Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['afc_planned_date'] == '0000-00-00' ? '' : $list['afc_planned_date']) ?></td><!-- AFC Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['AFC'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['AFC'][$key]['transmittal_date']) ?></td><!-- AFC Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['asb_planned_date'] == '0000-00-00' ? '' : $list['asb_planned_date']) ?></td><!-- ASB Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['ASB'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['ASB'][$key]['transmittal_date']) ?></td><!-- ASB Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['ifi_planned_date'] == '0000-00-00' ? '' : $list['ifi_planned_date']) ?></td><!-- IFI Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$mdr_status['IFI'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFI'][$key]['transmittal_date']) ?></td><!-- IFI Actual Date -->

      <td nowrap style="text-align: center"><?= isset($data_mws['mark_up']) ? $data_mws['mark_up'] : null ?></td><!-- MWS Mark-up -->
      <td nowrap style="text-align: center"><?= isset($data_mws['ts_out_no']) ? $data_mws['ts_out_no'] : null ?></td><!-- MWS TS-Out No. -->
      <td nowrap style="text-align: center"><?= $data_mws['ts_out_date'] != '0000-00-00' ? $data_mws['ts_out_date'] : null ?></td><!-- MWS TS-Out Date -->
      <td nowrap style="text-align: center"><?= isset($data_mws['doc_revision']) ? $data_mws['doc_revision'] : null ?></td><!-- MWS Doc Revision -->
      <td nowrap style="text-align: center"><?= isset($data_mws['review_status']) ? $data_mws['review_status'] : null ?></td><!-- MWS Review Status / Code -->
      <td nowrap style="text-align: center"><?= isset($data_mws['ts_in_no']) ? $data_mws['ts_in_no'] : null ?></td><!-- MWS TS-In No. -->
      <td nowrap style="text-align: center"><?= $data_mws['ts_in_date'] != '0000-00-00' ? $data_mws['ts_in_date'] : null ?></td><!-- MWS TS-In Date -->

      <td nowrap style="text-align: center"><?= isset($data_dnv['mark_up']) ? $data_dnv['mark_up'] : null ?></td><!-- CA-DNV Mark-Up -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['ts_out_no']) ? $data_dnv['ts_out_no'] : null ?></td><!-- CA TS-Out No. -->
      <td nowrap style="text-align: center"><?= $data_dnv['ts_out_date'] != '0000-00-00' ? $data_dnv['ts_out_date'] : null ?></td><!-- CA TS-Out Date -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['doc_revision']) ? $data_dnv['doc_revision'] : null ?></td><!-- CA Doc Revision -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['review_status']) ? $data_dnv['review_status'] : null ?></td><!-- CA Review Status / Code -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['ts_in_no']) ? $data_dnv['ts_in_no'] : null ?></td><!-- CA TS-In No. -->
      <td nowrap style="text-align: center"><?= $data_dnv['ts_in_date'] != '0000-00-00' ? $data_dnv['ts_in_date'] : null ?></td><!-- CA TS-In Date -->
    </tr>
    <?php endforeach; endif;?>
    <?php 
      if($vendor_lists):
        foreach($vendor_lists as $key => $list):
          $doc_arr = explode("-", $list['ref_no']);
          $ctr_transmittal_date = @$vendor_transmittal['TO NOC'][$key]['transmittal_date'];
          $ctr_transmittal_no = @$vendor_transmittal['TO NOC'][$key]['transmittal_no'];
          $data_mws = !empty($mws_list[$list['id']]) ? $mws_list[$list['id']] : [];
          $data_dnv = !empty($dnv_list[$list['id']]) ? $dnv_list[$list['id']] : [];
    ?>
    <tr>
      <td nowrap style="text-align: left"><?php echo $list['ref_no'] ?></td>
      <td nowrap style="text-align: left"><?php echo $list['description'] ?></td>
      <td nowrap style="text-align: center"><?php echo $list['class'] ?></td>
      <td nowrap style="text-align: center">QA</td><!--Country -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[0] ?></td><!--Project Code -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[1] ?></td><!--Originator -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][0] ?><?php echo @$doc_arr[2][1] ?><?php echo @$doc_arr[2][2] ?></td><!--Site -->
      <td nowrap style="text-align: center"><?php echo @$doc_arr[2][3] ?><?php echo @$doc_arr[2][4] ?></td><!--Sector -->
      <td nowrap style="text-align: center">="<?php echo $discipline_list[$list['discipline']]['discipline_code'] ?>"</td><!--Disc. -->
      <td nowrap style="text-align: center"><?php echo $list['document_type'] ?></td>
      <td nowrap style="text-align: center"><?php echo @$doc_arr[4] ?><?php echo (isset($doc_arr[5]) ? "-".$doc_arr[5] : "") ?></td><!--Sequantial Number (Doc Type 2 digits+Seq Number) -->
      <td nowrap style="text-align: center"><?php echo $list['wp'] ?></td><!-- W.P. -->
      <td nowrap style="text-align: center"><?php echo $list['wu'] ?></td><!-- W.U. -->
      <td nowrap style="text-align: center">="<?php echo $list['system'] ?>"</td>
      <td nowrap style="text-align: center">="<?php echo $list['subsystem'] ?>"</td><!--Sub-System -->
      <td nowrap style="text-align: center"><?php echo $vendor_list[$list['vendor_code']] ?></td><!-- Package -->
      <td nowrap style="text-align: center"><?php echo $list['po_number'] ?></td><!-- PO No. -->
      <td nowrap style="text-align: center"><?php echo ($list['vendor_code'] != ""? 'Vendor - '.$list['vendor_code'] : '') ?></td><!--Company Generator -->
      <td nowrap style="text-align: center"><?php echo $list['ctr_lead'] ?></td><!-- CTR-Lead -->
      <td nowrap style="text-align: center"><?php echo $list['interface_doc'] ?></td><!-- Interface Doc(Y/N) -->
      <td nowrap style="text-align: center"><?php echo $list['asb'] ?></td><!--ASB Required(Y/N) -->

      <td nowrap style="text-align: center">="<?php echo $list['revision_no'] ?>"</td>
      <td nowrap style="text-align: center">="<?php echo $list['status_remark'] ?>"</td>
      <td nowrap style="text-align: center"></td><!-- CPY Code -->
      <td nowrap style="text-align: center"></td><!-- CPY Leader -->
      <td nowrap style="text-align: center"></td><!-- CPY Approver -->
      <td nowrap style="text-align: center"><?php echo $ctr_transmittal_no ?></td><!-- CTR Transmittal No. -->
      <td nowrap style="text-align: center"><?php echo ($ctr_transmittal_date == '0000-00-00' ? '' : $ctr_transmittal_date) ?></td><!-- CTR Transmittal Date -->
      <td nowrap style="text-align: center"><?php echo @$vendor_transmittal['FROM VENDOR'][$key]['transmittal_no']; ?></td><!-- VENDOR Transmittal No. -->
      <td nowrap style="text-align: center"><?php echo (@$vendor_transmittal['FROM VENDOR'][$key]['transmittal_date'] == '0000-00-00' ? '' : @$vendor_transmittal['FROM VENDOR'][$key]['transmittal_date']); ?></td><!-- VENDOR TS Date -->

      <td nowrap style="text-align: center"><?php echo ($list['ifr_planned_date'] == '0000-00-00' ? '' : $list['ifr_planned_date']) ?></td><!-- IFR Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFR'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['IFR'][$key]['transmittal_date']) ?></td><!-- IFR Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['ifa_planned_date'] == '0000-00-00' ? '' : $list['ifa_planned_date']) ?></td><!-- IFA Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFA'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['IFA'][$key]['transmittal_date']) ?></td><!-- IFA Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['afc_planned_date'] == '0000-00-00' ? '' : $list['afc_planned_date']) ?></td><!-- AFC Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['AFC'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['AFC'][$key]['transmittal_date']) ?></td><!-- AFC Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['asb_planned_date'] == '0000-00-00' ? '' : $list['asb_planned_date']) ?></td><!-- ASB Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['ASB'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['ASB'][$key]['transmittal_date']) ?></td><!-- ASB Actual Date -->
      <td nowrap style="text-align: center"><?php echo ($list['ifi_planned_date'] == '0000-00-00' ? '' : $list['ifi_planned_date']) ?></td><!-- IFI Planned Date -->
      <td nowrap style="text-align: center"><?php echo (@$vendor_status['IFI'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$vendor_status['IFI'][$key]['transmittal_date']) ?></td><!-- IFI Actual Date -->

      <td nowrap style="text-align: center"><?= isset($data_mws['mark_up']) ? $data_mws['mark_up'] : null ?></td><!-- MWS Mark-up -->
      <td nowrap style="text-align: center"><?= isset($data_mws['ts_out_no']) ? $data_mws['ts_out_no'] : null ?></td><!-- MWS TS-Out No. -->
      <td nowrap style="text-align: center"><?= $data_mws['ts_out_date'] != '0000-00-00' ? $data_mws['ts_out_date'] : null ?></td><!-- MWS TS-Out Date -->
      <td nowrap style="text-align: center"><?= isset($data_mws['doc_revision']) ? $data_mws['doc_revision'] : null ?></td><!-- MWS Doc Revision -->
      <td nowrap style="text-align: center"><?= isset($data_mws['review_status']) ? $data_mws['review_status'] : null ?></td><!-- MWS Review Status / Code -->
      <td nowrap style="text-align: center"><?= isset($data_mws['ts_in_no']) ? $data_mws['ts_in_no'] : null ?></td><!-- MWS TS-In No. -->
      <td nowrap style="text-align: center"><?= $data_mws['ts_in_date'] != '0000-00-00' ? $data_mws['ts_in_date'] : null ?></td><!-- MWS TS-In Date -->

      <td nowrap style="text-align: center"><?= isset($data_dnv['mark_up']) ? $data_dnv['mark_up'] : null ?></td><!-- CA-DNV Mark-Up -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['ts_out_no']) ? $data_dnv['ts_out_no'] : null ?></td><!-- CA TS-Out No. -->
      <td nowrap style="text-align: center"><?= $data_dnv['ts_out_date'] != '0000-00-00' ? $data_dnv['ts_out_date'] : null ?></td><!-- CA TS-Out Date -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['doc_revision']) ? $data_dnv['doc_revision'] : null ?></td><!-- CA Doc Revision -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['review_status']) ? $data_dnv['review_status'] : null ?></td><!-- CA Review Status / Code -->
      <td nowrap style="text-align: center"><?= isset($data_dnv['ts_in_no']) ? $data_dnv['ts_in_no'] : null ?></td><!-- CA TS-In No. -->
      <td nowrap style="text-align: center"><?= $data_dnv['ts_in_date'] != '0000-00-00' ? $data_dnv['ts_in_date'] : null ?></td><!-- CA TS-In Date -->
    </tr>
    <?php endforeach; endif;?>
  </tbody>
</table>