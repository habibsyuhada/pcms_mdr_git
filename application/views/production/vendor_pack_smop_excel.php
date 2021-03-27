<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

 ?>
 <table border="1" style="">
 
      <thead>
 
           <tr>

                <th style="background: #28a745; color: #ffffff;" rowspan="2">DOCUMENT NUMBER</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">REV</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">STATUS</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">REV. STAGE</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">CLASS</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">REV DATE</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">DOCUMENT TITLE</th>
                <th style="background: #28a745; color: #ffffff;" colspan="2">FROM VENDOR</th>
                <th style="background: #28a745; color: #ffffff;" colspan="2">TO NOC</th>
                <th style="background: #28a745; color: #ffffff;" colspan="3">FROM NOC</th>
                <th style="background: #28a745; color: #ffffff;" colspan="3">TO VENDOR</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">PO NUMBER</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">VENDOR CODE</th>
                <th style="background: #28a745; color: #ffffff;" rowspan="2">REMARKS</th>
 
           </tr>
           <tr>

                
                <th style="background: #28a745; color: #ffffff;">TR NUMBER</th>
                <th style="background: #28a745; color: #ffffff;">DATE</th>
                <th style="background: #28a745; color: #ffffff;">TR NUMBER</th>
                <th style="background: #28a745; color: #ffffff;">DATE</th>
                <th style="background: #28a745; color: #ffffff;">TR NUMBER</th>
                <th style="background: #28a745; color: #ffffff;">DATE</th>
                <th style="background: #28a745; color: #ffffff;">CODE</th>
                <th style="background: #28a745; color: #ffffff;">TR NUMBER</th>
                <th style="background: #28a745; color: #ffffff;">DATE</th>
                <th style="background: #28a745; color: #ffffff;">CODE</th>
 
           </tr>
 
      </thead>
 
      <tbody>
 
            <?php 
              if($lists):
              foreach($lists as $key => $list): 
            ?>
            <tr>
              <td nowrap style="text-align: center;"><?php echo $list['ref_no'] ?></td>
              <td nowrap style="text-align: center;">="<?php echo $list['revision_no'] ?>"</td>
              <td nowrap style="text-align: center;"><?php echo $list['status_remark'] ?></td>
              <td nowrap style="text-align: center;">="<?php echo $list['revision_no'] ?>-<?php echo $list['status_remark'] ?>"</td>
              <td nowrap style="text-align: center;"><?php echo $list['class'] ?></td>
              <td nowrap style="text-align: center;"><?php echo $list['revision_date'] ?></td>
              <td nowrap style="text-align: center;"><?php echo $list['description'] ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$from_vendor[$key]['revision_no'] ? @$from_vendor[$key]['transmittal_no'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$from_vendor[$key]['revision_no'] ? @$from_vendor[$key]['transmittal_date'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$to_noc[$key]['revision_no'] ? @$to_noc[$key]['transmittal_no'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$to_noc[$key]['revision_no'] ? @$to_noc[$key]['transmittal_date'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$from_noc[$key]['revision_no'] ? @$from_noc[$key]['transmittal_no'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$from_noc[$key]['revision_no'] ? @$from_noc[$key]['transmittal_date'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$from_noc[$key]['revision_no'] ? @$from_noc[$key]['code'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$to_vendor[$key]['revision_no'] ? @$to_vendor[$key]['transmittal_no'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$to_vendor[$key]['revision_no'] ? @$to_vendor[$key]['transmittal_date'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo ($list['revision_no'] == @$to_vendor[$key]['revision_no'] ? @$to_vendor[$key]['code'] : '') ?></td>
              <td nowrap style="text-align: center;"><?php echo $list['vendor_code'] ?></td>
              <td nowrap style="text-align: center;"><?php echo $list['po_number'] ?></td>
              <td nowrap style="text-align: center;"><?php echo $list['remarks'] ?></td>
            </tr>
            <?php endforeach; endif;?>

 
      </tbody>
 
 </table>