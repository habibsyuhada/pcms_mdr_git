<style>
 input.form-control, select.form-control {
     width:500px !important;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
</style>
<div class="container-fluid medium" style="min-height: 79vh">

  <form method="GET" action="<?php echo base_url();?>emr/report_process">
    <div class="row">

      <div class="col-lg-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">
              
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">From</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="date_from" placeholder="Date From" value='<?php echo $date_from; ?>' required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">To</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="date_to" placeholder="Date To" value='<?php echo $date_to; ?>' required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" class="form-control">
                    <option value="<?php echo $status_view ?>"><?php echo $status_view ?></option>
                    <option value="In-Progress">In-Progress</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Completed">Completed</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Cost Centre / Job Cost</label>
                <div class="col-sm-9">
                  <select class="custom-select form-control" name="id_cost" onChange="set_session_emr_data('id_cost', this)">
                     <option value="All">All Data</option>
                  <?php 
                    if($this->session->userdata('id_cost_emr_data') !== NULL){
                      $id_cost = $this->session->userdata('id_cost_emr_data');
                    }
                    else{
                      $id_cost = '';
                    }
                    foreach($cost_list as $cost):
                  ?>

                  <?php if($read_cookies[7] != 1 AND $read_cookies[4] != 11  AND $read_cookies[4] != 21){ ?>

                      <?php if($read_cookies[4] == $cost['group_department']){ ?>

                            <option value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>           

                      <?php } ?>

                  <?php } else { ?>

                  
                     <option value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>

                  <?php } ?>


                    <?php endforeach; ?>
                   
                  </select>
                </div>
              </div>
              
              <div class="text-right mt-3">
                <button type="submit" class="btn btn-success btn-flat" title="Submit"><i class="fa fa-check"></i> Submit</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <table class="table dataTable table-hover table-bordered text-center">
              <thead>
                <tr>
                  <th>MR Number</th>
                  <th>Name</th>
                  <th>Request Date</th>
                  <th>Request On Site Date</th>
                  <th>MR Status</th>
                  <?php if($status_view != 'Approved'){ ?>
                  <th>Approval Status</th>
                   <?php } ?>
                 <?php if($status_view == 'Rejected'){ ?>
                  <th>Void Comment</th>
                  <?php } ?>

                  <th>Options</th>

                  
                  <?php if($read_permission[5] == '1'){ ?>
                     <?php if($status_view != 'Approved'){ ?>
                      <?php if($status_view != 'Rejected'){ ?>
                      <th>Approval</th>
                    <?php } else { ?>
                       <th>Resubmit</th>
                    <?php } ?>
                  <?php } ?>
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
                      else{
                        $color = "success";
                        $text = "Approved";
                      }
                    ?>
                    <div class="alert alert-<?php echo $color ?> font-weight-bold mb-0" role="alert">
                      <?php echo $text ?>
                    </div>
                  </td>
                  <?php if($status_view != 'Approved'){ ?>
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
                    <?php if($text != "Approved"): ?>

                    <?PHP if($read_cookies[7] != 2 ){ ?>
                        <a href="<?php echo base_url(); ?>emr/req_edit/<?php echo $value['request_no']; ?>" class="btn btn-warning" title="Edit EMR Data List">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger" href='#' title="Delete" onClick="delete_req_list('<?php echo $value['request_no']; ?>')"><i class="fa fa-trash"></i></a>
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
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <small class="d-block text-right mt-3">
        </small>
      </div>
    </div>
  </div>
</div>