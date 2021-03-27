<div id="content" class="container-fluid">
  <form method="POST" action="<?php echo base_url();?>activity/activity_import_process">
    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">

              <table class="table dataTable table-hover text-center">
                <thead class="bg-success text-white">
                  <tr>
                    <th>Reference Number</th>
                    <th>Rev No</th>
                    <th>Code</th>
                    <th>Rev Date</th>
                    <th>Status</th>
                    <th>Class</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Document Type</th>
                    <th>System</th>
                    <th>Uploaded By</th>
                    <th>Upload Date</th>
                    <th>Attachment</th>
                    <th>Planned Date</th>
                    <th>Transmittal No.</th>
                    <th>Transmittal Date</th>
                    <th>Forecast Date</th>
                    <th>Remarks</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $document_no = array();
                    $no=1; 
                    foreach($sheet as $row):
                      if($no > 1): 
                        if($row['A'] != ""){

                        $status = '';
                        $disabled = 0;
                       
                        if(!isset($project_list[$row['B']])){
                          $status = 'Project Not Found';
                          $disabled = 1;
                        }
                        if(!isset($module_list[$row['C']])){
                          $status = 'Module Not Found';
                          $disabled = 1;
                        }
                        if(!isset($discipline_list[$row['D']])){
                          $status = 'Discipline Not Found';
                          $disabled = 1;
                        }
                        if($row['A'] != ''){
                          if(in_array($row['A'].'|'.$drawing_type.'|'.$module_list[$row['C']], $document_duplicate) || in_array($row['A'].'|'.$drawing_type.'|'.$module_list[$row['C']], $document_no)){
                            $status = 'Duplicate Document Number';
                            $disabled = 2;
                          }
                        }
                        else{                          
                          $status = 'Document Number is Empty';
                          $disabled = 2;
                        }
                        $document_no[] = $row['A'].'|'.$drawing_type.'|'.$module_list[$row['C']];

                  ?>
                  <tr style="background: <?php echo ($disabled == 2 ? '#f8d7da' : ($disabled == 1 ? '#fff3cd' : '')); ?>">
                    <td class="align-middle">
                      <input type="text" name="document_no[]" class="form-control" value="<?php echo $row['A'] ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                    </td>
                    <td class="align-middle">
                      <input type="text" name="project_id_preview[]" class="form-control" value="<?php echo (isset($project_list[$row['B']]) ? $row['B'] : '-') ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                      <input type="hidden" name="project_id[]" class="form-control" value="<?php echo (isset($project_list[$row['B']]) ? $project_list[$row['B']] : '-') ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                    </td>
                    <td class="align-middle">
                      <input type="text" name="module_preview[]" class="form-control" value="<?php echo (isset($module_list[$row['C']]) ? $row['C'] : '-') ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                      <input type="hidden" name="module[]" class="form-control" value="<?php echo (isset($module_list[$row['C']]) ? $module_list[$row['C']] : '-') ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                    </td>
                    <td class="align-middle">
                      <input type="text" name="discipline_preview[]" class="form-control" value="<?php echo (isset($discipline_list[$row['D']]) ? $row['D'] : '-') ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                      <input type="hidden" name="discipline[]" class="form-control" value="<?php echo (isset($discipline_list[$row['D']]) ? $discipline_list[$row['D']] : '-') ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                    </td>
                    <td class="align-middle">
                      <input type="text" name="title[]" class="form-control" value="<?php echo @$row['E'] ?>" <?php echo ($disabled > 0 ? 'disabled' : ''); ?>>
                    </td>
                    <td class="align-middle"><?php echo $status ?></td>
                  </tr>
                  <?php } endif; ?>
                  <?php $no++; endforeach; ?>
                </tbody>
              </table>
              <input type="hidden" name="drawing_type" class="form-control" value="<?php echo $drawing_type ?>">

            </div>
          </div>
          <div class="text-right mt-3">
            <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit"><i class="fa fa-check"></i> Submit</button>
            <a href="<?php echo base_url();?>activity/activity_import" class="btn btn-secondary " title="Submit"><i class="fa fa-close"></i> Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    orientation: "bottom auto",
    autoclose: true,
    todayHighlight: true
  });
</script>