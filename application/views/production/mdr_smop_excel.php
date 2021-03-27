<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

 ?>
 <table border="1" style="">
 
      <thead>
 
           <tr>

                <th style="background: #28a745">COMPANY Document number</th>
                <th style="background: #28a745">Document Title</th>
                <th style="background: #28a745">Revision</th>
                <th style="background: #28a745">Revision Date</th>
                <th style="background: #28a745">Discipline</th>
                <th style="background: #28a745">Document type</th>
                <th style="background: #28a745">System</th>
                <th style="background: #28a745">Status</th>
                <th style="background: #28a745">Code</th>
                <th style="background: #28a745">Planned IFR Date</th>
                <th style="background: #28a745">Actual Date for IFR</th>
                <th style="background: #28a745">Transmittal No</th>
                <th style="background: #28a745">Forecast Date for IFR</th>
                
                <th style="background: #28a745">Planned IFA Date</th>
                <th style="background: #28a745">Actual Date for IFA</th>
                <th style="background: #28a745">Transmittal No</th>
                <th style="background: #28a745">Forecast Date for IFA</th>
                
                <th style="background: #28a745">Planned AFC Date</th>
                <th style="background: #28a745">Actual Date for AFC</th>
                <th style="background: #28a745">Transmittal No</th>
                <th style="background: #28a745">Forecast Date for AFC</th>
                
                <th style="background: #28a745">Planned IFI Date</th>
                <th style="background: #28a745">Actual Date for IFI</th>
                <th style="background: #28a745">Transmittal No</th>
                <th style="background: #28a745">Forecast Date for IFI</th>

                <th style="background: #28a745">Weight %</th>
                <th style="background: #28a745">Progress %</th>
                <th style="background: #28a745">Contractor Transmittal Sheet Number</th>
                <th style="background: #28a745">Issue Date Contractor Transmittal Sheet</th>
                <th style="background: #28a745">MDRRevision or Change Request nb</th>
 
           </tr>
 
      </thead>
 
      <tbody>
 
            <?php 
              if($lists):
              foreach($lists as $key => $list):
               $lastest = "";
               if(isset($afc[$key]['revision_no']) && $list['revision_no'] == @$afc[$key]['revision_no']){
                    $lastest = "afc";
               }
               elseif(isset($ifa[$key]['revision_no']) && $list['revision_no'] == @$ifa[$key]['revision_no']){
                    $lastest = "ifa";
               }
               elseif(isset($ifr[$key]['revision_no']) && $list['revision_no'] == @$ifr[$key]['revision_no']){
                    $lastest = "ifr";
               }
               elseif(isset($ifi[$key]['revision_no']) && $list['revision_no'] == @$ifi[$key]['revision_no']){
                    $lastest = "ifi";
               }
            ?>

            <tr>
              <td nowrap style="text-align: left"><?php echo $list['ref_no'] ?></td>
              <td nowrap style="text-align: left"><?php echo $list['description'] ?></td>
              <td nowrap style="text-align: center">="<?php echo $list['revision_no'] ?>"</td>
              <td nowrap style="text-align: center"><?php echo ($list['revision_date'] == '0000-00-00' ? '' : $list['revision_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo $discipline_list[$list['discipline']] ?></td>
              <td nowrap style="text-align: center"><?php echo $list['document_type'] ?></td>
              <td nowrap style="text-align: center"><?php echo $list['system'] ?></td>
              <td nowrap style="text-align: center"><?php echo $list['status_remark'] ?></td>
              <td nowrap style="text-align: center"><?php echo $list['code'] ?></td>

              <td nowrap style="text-align: center"><?php echo (@$ifr[$key]['planned_date'] == '0000-00-00' ? '' :  @$ifr[$key]['planned_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo (@$ifr[$key]['transmittal_date'] == '0000-00-00' ? '' :  @$ifr[$key]['transmittal_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo @$ifr[$key]['transmittal_no'] ?></td>
              <td nowrap style="text-align: center"><?php echo (@$ifr[$key]['forecast_date'] == '0000-00-00' ? '' :  @$ifr[$key]['forecast_date']) ?></td>

              <td nowrap style="text-align: center"><?php echo (@$ifa[$key]['planned_date'] == '0000-00-00' ? '' :  @$ifa[$key]['planned_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo (@$ifa[$key]['transmittal_date'] == '0000-00-00' ? '' :  @$ifa[$key]['transmittal_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo @$ifa[$key]['transmittal_no'] ?></td>
              <td nowrap style="text-align: center"><?php echo (@$ifa[$key]['forecast_date'] == '0000-00-00' ? '' :  @$ifa[$key]['forecast_date']) ?></td>

              <td nowrap style="text-align: center"><?php echo (@$afc[$key]['planned_date'] == '0000-00-00' ? '' :  @$afc[$key]['planned_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo (@$afc[$key]['transmittal_date'] == '0000-00-00' ? '' :  @$afc[$key]['transmittal_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo @$afc[$key]['transmittal_no'] ?></td>
              <td nowrap style="text-align: center"><?php echo (@$afc[$key]['forecast_date'] == '0000-00-00' ? '' :  @$afc[$key]['forecast_date']) ?></td>

              <td nowrap style="text-align: center"><?php echo (@$ifi[$key]['planned_date'] == '0000-00-00' ? '' :  @$ifi[$key]['planned_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo (@$ifi[$key]['transmittal_date'] == '0000-00-00' ? '' :  @$ifi[$key]['transmittal_date']) ?></td>
              <td nowrap style="text-align: center"><?php echo @$ifi[$key]['transmittal_no'] ?></td>
              <td nowrap style="text-align: center"><?php echo (@$ifi[$key]['forecast_date'] == '0000-00-00' ? '' :  @$ifi[$key]['forecast_date']) ?></td>

              <td nowrap style="text-align: center"><?php echo ($lastest != '' ? ${$lastest}[$key]['weight'] : '') ?></td>
              <td nowrap style="text-align: center"><?php echo ($lastest != '' ? ${$lastest}[$key]['progress'] : '') ?></td>
              <td nowrap style="text-align: center"><?php echo ($lastest != '' ? ${$lastest}[$key]['transmittal_sheet_no'] : '') ?></td>
              <td nowrap style="text-align: center"><?php echo ($lastest != '' ? (${$lastest}[$key]['issue_date_transmittal_sheet'] == '0000-00-00' ? '' : ${$lastest}[$key]['issue_date_transmittal_sheet']) : '') ?></td>
              <td nowrap style="text-align: center"><?php echo ($lastest != '' ? ${$lastest}[$key]['mdr_revision_request_nb'] : '') ?></td>
            </tr>
            <?php endforeach; endif;?>

 
      </tbody>
 
 </table>