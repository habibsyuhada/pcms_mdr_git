<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Report-".date('YmdHis').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

 ?>
 <table border="1" style="">
 
      <thead>
 
           <tr>

                <th style="background: #28a745">Reference Number</th>
                <th style="background: #28a745">Rev No11</th>
                <th style="background: #28a745">Code</th>
                <th style="background: #28a745">Rev Date</th>
                <th style="background: #28a745">Status</th>
                <th style="background: #28a745">Class</th>
                <th style="background: #28a745">Title</th>
                <th style="background: #28a745">Project</th>
                <th style="background: #28a745">Discipline</th>
                <th style="background: #28a745">Module</th>
                <th style="background: #28a745">Transmittal No.</th>
                <th style="background: #28a745">Transmittal Date</th>
                <th style="background: #28a745">Transmittal Status</th>
                <th style="background: #28a745">Vendor Code</th>
                <th style="background: #28a745">PO Number</th>
                <th style="background: #28a745">Remarks</th>
 
           </tr>
 
      </thead>
 
      <tbody>
 
            <?php 
              if($lists):
              foreach($lists as $list): 
            ?>
            <tr>
              <td nowrap class="align-middle"><?php echo $list['ref_no'] ?></td>
              <td nowrap class="align-middle">="<?php echo $list['revision_no'] ?>"</td>
              <td nowrap class="align-middle"><?php echo $list['code'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['revision_date'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['status_remark'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['class'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['description'] ?></td>
              <td nowrap class="align-middle"><?php echo $project_list[$list['project_id']] ?></td>
              <td nowrap class="align-middle"><?php echo $discipline_list[$list['discipline']] ?></td>
              <td nowrap class="align-middle"><?php echo $module_list[$list['module']] ?></td>
              <td nowrap class="align-middle"><?php echo $list['transmittal_no'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['transmittal_date'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['transmittal_status'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['vendor_code'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['po_number'] ?></td>
              <td nowrap class="align-middle"><?php echo $list['remarks'] ?></td>
            </tr>
            <?php endforeach; endif;?>

 
      </tbody>
 
 </table>