<div class="container-fluid medium" style="min-height: 79vh">
  <div class="row">
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">

        <?php if($read_permission[0] == '1'){ ?>

          <a href="<?php echo base_url();?>emr/req_new" class="btn btn-primary" title="Delete"><i class="fa fa-plus"></i> New Request</a>

        <?php } ?>
        
        <form method="POST" action="<?php echo base_url(); ?>emr/req_approval">
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <table class="table dataTable_mr_list table-hover table-bordered cell-border text-center">
              <thead>
                <tr>
                  <th>Req Submit Number</th>
                  <th>Requestor</th>
                  <th>Request Date</th>
                  <th>ROS Date</th>
                  <th>Status</th>

                  <?php if($status_view == 'Completed'){ ?>
                  <th>ETA Date</th>
                  <th>Refrence PO Number</th>
                  <?php } ?>

                  <?php if($status_view != 'Approved' && $status_view != 'Completed'){ ?>
                  <th>Action By</th>
                  <?php } ?>

                  <?php if($status_view == 'Rejected'){ ?>
                  <th>Void Comment</th>
                  <?php } ?>
                  
                  <th>Options</th>

                  <?php if($read_permission[5] == '1'){ ?>
                      <?php if($status_view != 'Approved' && $status_view != 'Completed'){ ?>
                        <?php if($status_view != 'In-Progress'){ ?>
                          <?php if($status_view != 'Rejected'){ ?>

                      <th>Approval</th>

                        <?php } else if($read_cookies[4] != 11 AND $read_cookies[4] != 21){ ?>

                       <th>Resubmit</th>

                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                  <?php } ?>
                <?php if($status_view == 'Approved' AND $read_cookies[4] == 11){ ?>
                  <th>Completed</th>
                <?php } ?>

                </tr>
              </thead>
              <tbody>
                <?php foreach($req_list as $value): ?>
                <tr>
                  <td class="align-middle"><?php echo $value['request_no']; ?></td>
                  <td class="align-middle"><?php echo $user_list[$value['request_by']]['full_name']; ?></td>
                  <td class="align-middle"><?php echo date('d F Y, D', strtotime($value['request_date'])); ?></td>
                  <td class="align-middle">
                    <?php 
                      foreach($cost_list as $cost){
                        if($cost['id_cost'] == $value['project_id']){
                          $category = $cost['cost_category'];
                          //echo $cost['cost_code'];
                        }
                      }
                    ?>
                     <?php echo date('D, d F Y', strtotime($value['ros'])); ?>
                  </td>
                  <td class="align-middle">
                    <?php 
                      if($value['rejected_by'] != ''){
                        $color = "danger";
                        $text = "Rejected";
                      }
                      else if($value['approved_by'] == '' || $value['authorized_by'] == ''){
                        $color = "warning";
                        $text = "In-Progress";
                      }
                      else if($value['approved_by'] != '' && $value['eta_date'] == '0000-00-00'){
                        $color = "success";
                        $text = "Approved";
                      }
                      else{
                        $color = "info";
                        $text = "Completed";
                      }
                    ?>
                    <div class="alert alert-<?php if($status_view != 'Draft'){ echo $color; } else { echo 'warning'; } ?> font-weight-bold mb-0" role="alert">
                      <?php if($status_view != 'Draft'){  echo $text; } else { echo 'Draft'; } ?>
                    </div>
                  </td>

                  <?php if($status_view == "Completed"): ?>
                    <td><?php echo date('D, d F Y', strtotime($value['eta_date'])); ?></td>
                    <td><?php echo $value['ref_po_no'] ?></td>
                  <?php endif; ?>

                   <?php if($status_view != 'Approved' && $status_view != 'Completed'){ ?>
                  <td class="align-middle">
                    <?php 

                      if($value['rejected_by'] != ''){
                        $text_act = "Rejected By ".$user_list_rejected[$value['rejected_by']]['full_name'];
                        //$text_act = "";
                      }
                      else if($category == 'cost_centre'){
                        if($value['approved_by'] == ''){
                          $text_act = "Pending for HOD";
                          $act      = 'approved';
                        }
                        else if($value['authorized_by'] == ''){
                          $text_act = "Pending for PD";
                          $act = 'authorized';
                        }
                        else{
                          $text_act = "";
                        }
                      }
                      else{
                        if($value['approved_by'] == ''){
                          $text_act = "Pending for PM";
                          $act = 'approved';
                        }
                        else if($value['reviewed_by'] == ''){
                          $text_act = "Pending for Contract Review";
                          $act = 'reviewed';
                        }
                        else if($value['authorized_by'] == ''){
                          $text_act = "Pending for PD";
                          $act = 'authorized';
                        }
                        else{
                          $text_act = "";
                        }
                      }
                      echo $text_act;
                    ?>
                  </td>
                <?php } ?>

                   <?php if($status_view == 'Rejected'){ ?>
                     <?php if($value['rejected_by'] != ''){ ?> <td class="align-middle"> <?php echo ($value['rejected_by'] != '' ? $value['rejected_reason'] : ''); ?>  </td> <?php } ?>
                   <?php } ?>  
                  
                  <td class="align-middle" nowrap>

                     <a href="<?php echo base_url(); ?>emr/req_detail/<?php echo $value['request_no']; ?>" class="btn btn-primary" title="Review Material Request List"><i class="fa fa-file-text-o"></i></a>

                     <?php if($read_permission[2] == '1'){ ?>
                    <!-- //ini klo udah approved aja -->
                   
                    <a class="btn btn-success" title="Excel" href="<?php echo base_url(); ?>emr/download_req_detail_excel/<?php echo $value['request_no']; ?>"><i class="fa fa-file-excel-o"></i></a>

                    <a target="_blank" class="btn btn-danger" title="PDF" href="<?php echo base_url(); ?>emr/cetak_pdf/<?php echo $value['request_no']; ?>"><i class="fa fa-file-pdf-o"></i></a>

                    <?php } ?>
                    
                     <?php if($read_permission[2] == '1'){ ?>

                    <!-- // tombol edit mucul klo blom diapprov atau direject -->
                    <?php if($text != "Approved" && $text != "Completed"): ?>

                    

                        <?PHP if($read_cookies[7] != 2 ){ ?>

                          <?php if( $status_view != 'Approved'){ ?>

                            <?php if($read_permission[2] = '1'){ ?>

                              <?PHP if($read_cookies[0] == $value['request_by'] ){ ?>
                          

                        <a href="<?php echo base_url(); ?>emr/req_edit/<?php echo $value['request_no']; ?>" class="btn btn-warning" title="Edit EMR Data List">
                          <i class="fa fa-edit"></i>
                        </a>

                              <?php } ?>

                         <?php } ?>

                          <?php if($read_permission[3] = '1'){ ?>

                            <?PHP if($read_cookies[0] == $value['request_by'] ){ ?>

                           <a class="btn btn-danger" href='#' title="Delete" onClick="delete_req_list('<?php echo $value['request_no']; ?>')"><i class="fa fa-trash"></i></a>

                          <?php } ?>

                         <?php } ?>

                        <?php } ?>
                    
                      <?php } ?>

                  

                    <?php endif; ?>

                      <?php } ?>                              

                  </td>
                  <?php if($read_permission[5] == '1'){ ?>
                    <?php if($status_view != 'Approved' && $status_view != 'Completed'){ ?>
                      <?php if($status_view != 'In-Progress'){ ?>
                         <?php if( $status_view != 'Rejected' or $read_cookies[4] != 11 AND $read_cookies[4] != 21){ ?>
                  <td class="align-middle" nowrap>
                    
                    <?php if($read_permission[5] == '1'){ ?>
                    <!-- //ini klo blom approve atu direject -->
                    <?php if($status_view != 'Rejected' AND $status_view != 'Approved'){ ?>
                      <?php if($text_act != ""): ?>

                      <button type="button" class="btn btn-success" title="Approved" onClick="approve_req_list('<?php echo $value['request_no']; ?>', '<?php echo $act; ?>'<?php if($category == "cost_centre"){ echo ",'".$category."'"; } ?>)"><i class="fa fa-check"></i></button>
                    
                      <button type="button" class="btn btn-danger" title="Reject" onClick="reject_req_list('<?php echo $value['request_no']; ?>')"><i class="fa fa-close"></i></button>

                    <?php endif; ?>
                      <?php } ?>
                    <?php } ?>

                    

                    <!-- //klo udah di reject aja aja -->
                    <?php if($status_view == 'Rejected'): ?>

                    <a class="btn btn-dark" title="Re-Submit" href="<?php echo base_url(); ?>emr/req_resubmit_process/<?php echo $value['request_no']; ?>"><i class="fa fa-refresh"></i></a>

                    <?php endif; ?>

                    
                  </td>
                      <?php } ?>
                      <?php } ?>
                    <?php } ?>
                   <?php } ?>
                   <?php if($status_view == 'Approved' AND $read_cookies[4] == 11){ ?>
                    <td>
                      <a class="btn btn-info text-white btn-completed-proc" data-id="<?php echo $value['request_no']; ?>" title="Add" data-toggle="modal" href="#complete_material">
                        <i class="fa fa-plus"></i> Completed
                      </a>
                    </td>
                   <?php } ?>
                </tr>
                <?php endforeach; ?>



                <?php IF($read_cookies[4] == 5){ foreach($req_list_Contract as $value): ?>
                  
                     <tr>
                  <td class="align-middle"><?php echo $value['request_no']; ?></td>
                  <td class="align-middle"><?php echo $user_list_Contract[$value['request_by']]['full_name']; ?></td>
                  <td class="align-middle"><?php echo date('d F Y, D', strtotime($value['request_date'])); ?></td>
                  <td class="align-middle">
                    <?php 
                      foreach($cost_list as $cost){
                        if($cost['id_cost'] == $value['project_id']){
                          $category = $cost['cost_category'];
                          //echo $cost['cost_code'];
                        }
                      }
                    ?>
                     <?php echo date('D, d F Y', strtotime($value['ros'])); ?>
                  </td>
                  <td class="align-middle">
                    <?php 
                      if($value['rejected_by'] != ''){
                        $color = "danger";
                        $text = "Rejected";
                      }
                      else if($value['approved_by'] == '' || $value['authorized_by'] == ''){
                        $color = "warning";
                        $text = "In-Progress";
                      }
                      else if($value['approved_by'] != '' && $value['completed_by'] == ''){
                        $color = "success";
                        $text = "Approved";
                      }
                      else{
                        $color = "info";
                        $text = "Completed";
                      }
                    ?>
                    <div class="alert alert-<?php echo $color ?> font-weight-bold mb-0" role="alert">
                      <?php echo $text ?>
                    </div>
                  </td>

                  <?php if($text == "Completed"): ?>
                    <td><?php echo $value['eta_date'] ?></td>
                    <td><?php echo $value['ref_po_no'] ?></td>
                  <?php endif; ?>

                  <td class="align-middle">
                    <?php 

                      if($value['rejected_by'] != ''){
                        $text_act = "Rejected By ".$user_list_rejected[$value['rejected_by']]['full_name'];
                        //$text_act = "";
                      }
                      else if($category == 'cost_centre'){
                        if($value['approved_by'] == ''){
                          $text_act = "Pending for HOD";
                          $act      = 'approved';
                        }
                        else if($value['authorized_by'] == ''){
                          $text_act = "Pending for PD";
                          $act = 'authorized';
                        }
                        else{
                          $text_act = "";
                        }
                      }
                      else{
                        if($value['approved_by'] == ''){
                          $text_act = "Pending for PM";
                          $act = 'approved';
                        }
                        else if($value['reviewed_by'] == ''){
                          $text_act = "Pending for Contract Review";
                          $act = 'reviewed';
                        }
                        else if($value['authorized_by'] == ''){
                          $text_act = "Pending for PD";
                          $act = 'authorized';
                        }
                        else{
                          $text_act = "";
                        }
                      }
                      echo $text_act;
                    ?>
                  </td>

                   <?php if($status_view == 'Rejected'){ ?>
                     <?php if($value['rejected_by'] != ''){ ?> <td class="align-middle"> <?php echo ($value['rejected_by'] != '' ? $value['rejected_reason'] : ''); ?>  </td> <?php } ?>
                   <?php } ?>  
                  
                  <td class="align-middle" nowrap>

                     <a href="<?php echo base_url(); ?>emr/req_detail/<?php echo $value['request_no']; ?>" class="btn btn-primary" title="Review Material Request List"><i class="fa fa-file-text-o"></i></a>

                     <?php if($read_permission[2] == '1'){ ?>
                    <!-- //ini klo udah approved aja -->
                   
                    <a class="btn btn-success" title="Excel" href="<?php echo base_url(); ?>emr/download_req_detail_excel/<?php echo $value['request_no']; ?>"><i class="fa fa-file-excel-o"></i></a>

                    <a target="_blank" class="btn btn-danger" title="PDF" href="<?php echo base_url(); ?>emr/cetak_pdf/<?php echo $value['request_no']; ?>"><i class="fa fa-file-pdf-o"></i></a>

                    <?php } ?>
                    
                     <?php if($read_permission[2] == '1'){ ?>

                    <!-- // tombol edit mucul klo blom diapprov atau direject -->
                    <?php if($text != "Approved" && $text != "Completed"): ?>

                    <?PHP if($read_cookies[7] != 2 ){ ?>

                        <?php if($read_permission[2] == 1){ ?>

                          <a href="<?php echo base_url(); ?>emr/req_edit/<?php echo $value['request_no']; ?>" class="btn btn-warning" title="Edit EMR Data List">
                              <i class="fa fa-edit"></i>
                          </a>

                        <?php } ?>

                        <?php if($read_permission[3] == 1){ ?>

                        <a class="btn btn-danger" href='#' title="Delete" onClick="delete_req_list('<?php echo $value['request_no']; ?>')"><i class="fa fa-trash"></i></a>

                        <?php } ?>

                    <?php } ?>


                    <?php endif; ?>

                      <?php } ?>                              

                  </td>
                  <?php if($read_permission[5] == '1'){ ?>
                    <?php if($status_view != 'Approved'){ ?>
                  <td class="align-middle" nowrap>
                    
                    <?php if($read_permission[5] == '1'){ ?>
                    <!-- //ini klo blom approve atu direject -->
                    <?php if($status_view != 'Rejected' AND $status_view != 'Approved'){ ?>
                      <?php if($text_act != ""): ?>

                      <button type="button" class="btn btn-success" title="Approved" onClick="approve_req_list('<?php echo $value['request_no']; ?>', '<?php echo $act; ?>'<?php if($category == "cost_centre"){ echo ",'".$category."'"; } ?>)"><i class="fa fa-check"></i></button>
                    
                      <button type="button" class="btn btn-danger" title="Reject" onClick="reject_req_list('<?php echo $value['request_no']; ?>')"><i class="fa fa-close"></i></button>

                    <?php endif; ?>
                      <?php } ?>
                    <?php } ?>

                    <?php } ?>

                    <!-- //klo udah di reject aja aja -->
                    <?php if($status_view == 'Rejected'): ?>

                    <a class="btn btn-dark" title="Re-Submit" href="<?php echo base_url(); ?>emr/req_resubmit_process/<?php echo $value['request_no']; ?>"><i class="fa fa-refresh"></i></a>

                    <?php endif; ?>

                    
                  </td>
                   <?php } ?>
                </tr>

                <?php endforeach; } ?>

              </tbody>
            </table>
          </div>
        </div>
        <div class="container-fluid mt-1">
          <!-- <div id="gender" class="btn-group btn-flat" data-toggle="buttons">
            <label class="btn btn-success btn-flat" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
               <input type="radio" name="acknowledge" value="Approve"> &nbsp; Approve &nbsp;
            </label>
            <label class="btn btn-danger btn-flat" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
              <input type="radio" name="acknowledge" value="Reject" required=""> Reject
            </label>
          </div>
          <div>
            <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-check"></i> Submit</button>
          </div> -->
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="complete_material" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Completed Material Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url(); ?>emr/req_list_apr_reject/Approved" autocomplete='off'>
      <div class="modal-body">
        
        <input type="hidden" name="request_no" class='form-control'>
        <input type="hidden" name="completed_by" class='form-control' value='<?php echo $read_cookies[0] ?>'>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Input ETA Date</label>
          <div class="col-sm-10">
            <div class="custom-file">
              <input type="date" name="eta_date" class='form-control' required>           
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Ref. PO Nos</label>
          <div class="col-sm-10">
            <div class="custom-file">
              <input type="text" class="form-control" name="ref_po_no" required>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Completed</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>

  $('.btn-completed-proc').click(function(){
    var id=$(this).data('id');
    $('input[name=request_no]').val(id);
    $('#upl_atc').modal('toggle');
})


</script>