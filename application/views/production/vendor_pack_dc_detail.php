<?php
  $document = $document_list[0];
?>
<style type="text/css">
  .nav-link{
    color: #000;
  }
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
    color: #007bff;
    background: #fff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }
</style>
<div id="content" class="container-fluid">
  <h3><b><?php echo $document['ref_no'] ?></b></h3>
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">

          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'd' ? 'active' : '') ?>" data-toggle="pill" href="#pills-detail">Detail</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'rw' ? 'active' : '') ?>" data-toggle="pill" href="#pills-review">Review</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'p' ? 'active' : '') ?>" data-toggle="pill" href="#pills-planner">Plan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'r' ? 'active' : '') ?>" data-toggle="pill" href="#pills-rev">Revision</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'mws' ? 'active' : '') ?>" data-toggle="pill" href="#pills-mws">MWS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'dnv' ? 'active' : '') ?>" data-toggle="pill" href="#pills-dnv">DNV</a>
          </li>

        </ul>
        <div class="overflow-auto media text-muted py-3 border-bottom border-top border-gray">
          <div class="container-fluid">
            <div class="tab-content">

              <!-- Drawing Detail -->
              <div class="tab-pane fade <?php echo ($t == 'd' ? 'show active' : '') ?>" id="pills-detail">
                <form method="POST" action="<?php echo base_url();?>production/vendor_pack_document_edit_process">

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Reference Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="ref_no" value="<?php echo $document['ref_no'] ?>" required disabled>
                          <input type="hidden" class="form-control" name="id" value="<?php echo $document['id'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Project :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="project_id">
                            <?php foreach($project_list as $project): ?>
                            <option value="<?php echo $project['id'] ?>" <?php echo ($project['id'] == $document['project_id'] ? 'selected' : '') ?>><?php echo $project['project_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Discipline :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="discipline">
                            <?php foreach($discipline_list as $discipline): ?>
                            <option value="<?php echo $discipline['id'] ?>" <?php echo ($discipline['id'] == $document['discipline'] ? 'selected' : '') ?>><?php echo $discipline['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Module :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="module">
                            <?php foreach($module_list as $module): ?>
                            <option value="<?php echo $module['mod_id'] ?>" <?php echo ($module['mod_id'] == $document['module'] ? 'selected' : '') ?>><?php echo $module['mod_desc'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Title :</label>
                        <div class="col-xl">
                          <textarea class="form-control" name="description"><?php echo $document['description'] ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Remarks :</label>
                        <div class="col-xl">
                          <textarea class="form-control" name="remarks"><?php echo $document['remarks'] ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Vendor Code :</label>
                        <div class="col-xl">
                          <select class="custom-select select2" name="vendor_code">
                            <option value="">---</option>
                            <?php foreach ($vendor_list as $key => $value): ?>
                              <option value="<?php echo $value['company_code'] ?>" <?php echo ($document['vendor_code'] == $value['company_code'] ? 'selected' : '') ?>><?php echo $value['company_code']." - ".$value['company_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">PO Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="po_number" value="<?php echo $document['po_number'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php if($this->permission_eng_act[36] == '1'): ?>
                  <div class="row">
                    <div class="col-md">
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl text-right">
                          <button type="submit" name='submit' value='submit' class="btn btn-primary" title="Update"><i class="fa fa-check"></i> Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                </form>
              </div>
              <!-- Drawing Detail END -->

              <!-- Drawing Detail -->
              <div class="tab-pane fade <?php echo ($t == 'rw' ? 'show active' : '') ?>" id="pills-review">
                <form method="POST" action="<?php echo base_url();?>production/vendor_review_update_user_process">
                <input type="hidden" class="form-control" name="id_document" value="<?php echo $document['id'] ?>">
                  <div class="table-responsive">
                    <table id="tbl_review" class="table table-hover">
                      <thead class="bg-success text-white">
                        <tr>
                          <th>Review</th>
                          <th>Overdue</th>
                          <th>Category</th>
                          <th width="1%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select class="form-control select2" name="approval" required>
                              <option value="">---</option>
                              <?php foreach ($user_reviewer_list as $key => $review): ?>
                              <option value="<?php echo $review['id_user'] ?>" <?php echo ($review['id_user'] == @$approval['id_user'] ? 'selected' : '') ?>><?php echo $review['badge_no']." - ".$review['full_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_approval" value="<?php echo @$approval['id'] ?>">
                          </td>
                          <td><input type="date" name="approval_overdue" class="form-control" value="<?php echo @$approval['overdue_date'] ?>" required></td>
                          <td>Approval</td>
                          <td></td>
                        </tr>
                        <?php 
                          $no = 1;
                          foreach ($reviewer_list as $key => $reviewer) : 
                            if(!isset($current_reviewer) && $reviewer['action'] == 0){
                              $current_reviewer = [
                                "id_user"   => $reviewer['id_user'],
                                "category"  => $reviewer['category']
                              ];
                            }
                        ?>
                        <tr>
                          <td>
                            <select class="form-control select2" name="reviewer[]" required>
                              <option value="">---</option>
                              <?php foreach ($user_reviewer_list as $key => $review): ?>
                              <option value="<?php echo $review['id_user'] ?>" <?php echo ($review['id_user'] == @$reviewer['id_user'] ? 'selected' : '') ?>><?php echo $review['badge_no']." - ".$review['full_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_review[]" value="<?php echo @$reviewer['id'] ?>">
                          </td>
                          <td><input type="date" name="overdue_date[]" class="form-control" value="<?php echo @$reviewer['overdue_date'] ?>" required></td>
                          <td><?php echo "Review ".$no++ ?></td>
                          <td class="text-right"><button type="button" class="btn btn-danger" onclick="delete_reviewer(<?php echo @$reviewer['id'] ?>)"><i class="fas fa-trash m-0"></i></button></td>
                        </tr>
                        <?php 
                          endforeach; 
                          if(!isset($current_reviewer) && @$approval['action'] == 0){
                            $current_reviewer = [
                              "id_user"   => @$approval['id_user'],
                              "category"  => @$approval['category']
                            ];
                          }
                        ?>
                      </tbody>
                    </table>
                    <div class="text-right"><button type="button" class="btn btn-success" onclick="addrow(this)"><i class="fas fa-plus m-0"></i></button></div>
                  </div>
                  <?php if($this->permission_eng_act[36] == '1'): ?>
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl">
                          <button type="submit" name='submit' value='submit' class="btn btn-primary" title="Update"><i class="fa fa-check"></i> Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                </form>
                <hr><br>
                <div class="row">
                  <div class="col-md text-center">
                    <h3>Reference Number :</h3>
                    <h1><?php echo $document['ref_no'] ?></h1>
                    <?php //test_var($current_reviewer, 1) ?>
                  </div>
                </div>
                <?php
                  if(!isset($current_reviewer)){
                    $current_reviewer = [
                      "id_user"   => '',
                      "category"  => ''
                    ];
                  }
                ?>
                <?php if($current_reviewer['id_user'] == $this->user_cookie[0] && in_array($document['status_review'], array(1, 3))): ?>
                <div class="row mt-3">
                  <div class="col-md text-center">
                    <button type="button" class="btn btn-danger btn-lg" onclick="reject_reviewer()"><i class="fas fa-times"></i> <b>Return</b></button>
                    <button type="button" class="btn btn-primary btn-lg" onclick="approve_reviewer()"><i class="fa fa-check"></i> <b>Approve</b></button>
                  </div>
                </div>
                <?php elseif(in_array($document['status_review'], array(0, 2))): ?>
                <div class="row mt-3">
                  <div class="col-md text-center">
                    <button type="button" class="btn btn-primary btn-lg" onclick="submit_review()"><i class="fa fa-check"></i> <b>Submit</b></button>
                  </div>
                </div>
                <?php elseif($document['status_review'] == 4): ?>
                <div class="row mt-3">
                  <div class="col-md text-center">
                    <button type="button" class="btn btn-warning btn-lg" onclick="open_revision_review()"><i class="fa fa-check"></i> <b>Open for Revision</b></button>
                  </div>
                </div>
                <?php elseif(isset($user_reviewer_list[$current_reviewer['id_user']])): ?>
                  <h6 class="text-center">Waiting for <?php echo $current_reviewer['category']." from ".$user_reviewer_list[$current_reviewer['id_user']]['full_name'] ?> </h6>
                <?php endif; ?>
                <form id="form_approval_review" method="POST" action="<?php echo base_url(); ?>production/vendor_review_approval_process">
                  <input type="hidden" name="id_document" value="<?php echo $document['id'] ?>">
                  <input type="hidden" name="action" value="0">
                  <input type="hidden" name="category" value="<?php echo $current_reviewer['category'] ?>">
                  <input type="hidden" name="remarks" value="">
                </form>
                <div class="table-responsive mt-4">
                  <table class="table table-hover text-center">
                    <thead class="bg-success text-white">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $num = count($reviewer_detail_list) ; 
                      if(count($reviewer_detail_list) > 0): 
                    ?>
                    <?php foreach (array_reverse($reviewer_detail_list) as $key => $value) : ?>
                      <tr>
                        <td><?php echo ($num - $key) ?></td>
                        <td><?php echo $user_reviewer_list[$value['id_user']]['full_name'] ?></td>
                        <td><?php echo $value['category'] ?></td>
                        <td><?php echo $value['created_date'] ?></td>
                        <td>
                        <?php
                          if($value['action'] == 0){
                            echo "<span class='font-size-9 badge badge-info'>Submitted</span>";
                          }
                          elseif($value['action'] == 1){
                            echo "<span class='font-size-9 badge badge-success'>Approved</span>";
                          }
                          elseif($value['action'] == 2){
                            echo "<span class='font-size-9 badge badge-danger'>Rejected</span>";
                          }
                          elseif($value['action'] == 4){
                            echo "<span class='font-size-9 badge badge-warning'>Open Revision</span>";
                          }
                        ?>
                        </td>
                        <td><?php echo $value['remarks'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td class="text-center" colspan="6">No Data Found</td>
                      </tr>
                    <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Drawing Detail END -->

              <!-- Drawing Planner -->
              <div class="tab-pane fade <?php echo ($t == 'p' ? 'show active' : '') ?>" id="pills-planner">
                <form method="POST" action="<?php echo base_url();?>production/vendor_pack_document_planner_edit_process">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $document['id'] ?>">

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">WP :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="wp" value="<?php echo $document['wp'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">WU :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="wu" value="<?php echo $document['wu'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Interface Doc :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="interface_doc">
                            <option value="">---</option>
                            <option value="Y" <?php echo ($document['interface_doc'] == "Y" ? "selected" : "") ?>>Yes</option>
                            <option value="N" <?php echo ($document['interface_doc'] == "N" ? "selected" : "") ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">ASB :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="asb">
                            <option value="">---</option>
                            <option value="Y" <?php echo ($document['asb'] == "Y" ? "selected" : "") ?>>Yes</option>
                            <option value="N" <?php echo ($document['asb'] == "N" ? "selected" : "") ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">CTR-Lead :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="ctr_lead" value="<?php echo $document['ctr_lead'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">ASB Planned Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="asb_planned_date" value="<?php echo $document['asb_planned_date'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">IFR Planned Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="ifr_planned_date" value="<?php echo $document['ifr_planned_date'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">IFA Planned Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="ifa_planned_date" value="<?php echo $document['ifa_planned_date'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">AFC Planned Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="afc_planned_date" value="<?php echo $document['afc_planned_date'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">IFI Planned Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="ifi_planned_date" value="<?php echo $document['ifi_planned_date'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php if($this->permission_eng_act[36] == '1'): ?>
                  <div class="row">
                    <div class="col-md">
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl text-right">
                          <button type="submit" name='submit' value='submit' class="btn btn-primary" title="Update"><i class="fa fa-check"></i> Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                </form>
              </div>
              <!-- Drawing Planner END -->

              <!-- Drawing Revision -->
              <div class="tab-pane fade <?php echo ($t == 'r' ? 'show active' : '') ?>" id="pills-rev">
                <?php if($this->permission_eng_act[36] == '1' && $document['status_review'] != 1): ?>
                <form method="POST" action="<?php echo base_url();?>production/vendor_pack_document_revision_new_process" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Revision Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="revision_no" required>
                          <input type="hidden" class="form-control" name="id_document" value="<?php echo $document['id'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Revision Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="revision_date" required value="<?php echo date('Y-m-d') ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Code :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="code">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Status :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="status_remark">
                            <option value="">----</option>
                            <option value="IFR">IFR</option>
                            <option value="IFA">IFA</option>
                            <option value="AFC">AFC</option>
                            <option value="IFI">IFI</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Class :</label>
                        <div class="col-xl">
                          <!-- <input type="text" class="form-control" name="class"> -->
                          <select class="custom-select" name="class">
                            <option value="N/A">N/A</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Transmittal Status :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="transmittal_status">
                            <option value="">---</option>
                            <option value="FROM VENDOR">FROM VENDOR</option>
                            <option value="TO NOC">TO NOC</option>
                            <option value="FROM NOC">FROM NOC</option>
                            <option value="TO VENDOR">TO VENDOR</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Transmittal No. :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="transmittal_no">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Transmittal Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="transmittal_date">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Remarks :</label>
                        <div class="col-xl">
                          <textarea class="form-control" name="remarks"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Attachment :</label>
                        <div class="col-xl">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" onChange="$('.custom-file-label').html($(this).val())" name="file">
                            <label class="custom-file-label">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl text-right">
                          <button type="submit" name='submit' value='submit' class="btn btn-primary" title="Submit"><i class="fa fa-check"></i> Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
                <?php elseif($this->permission_eng_act[36] == '1' && $document['status_review'] == 1): ?>
                  <h6 class="text-center">This document under review process.</h6>
                <?php endif; ?>
                <div class="row">
                  <div class="col-md-auto">
                    <div class="form-group row">
                      <label class="col-sm-auto col-form-label">Show :</label>
                      <div class="col-sm-auto">
                        <select class="custom-select" onchange="window.location = '<?php echo base_url() ?>production/vendor_pack_dc_detail/<?php echo strtr($this->encryption->encrypt($document['id']), '+=/', '.-~')?>?t=r&show='+this.value">
                          <option value="">All</option>
                          <option value="FROM VENDOR" <?php echo ($this->input->get('show') == 'FROM VENDOR' ? 'selected' : '') ?>>FROM VENDOR</option>
                          <option value="TO NOC" <?php echo ($this->input->get('show') == 'TO NOC' ? 'selected' : '') ?>>TO NOC</option>
                          <option value="FROM NOC" <?php echo ($this->input->get('show') == 'FROM NOC' ? 'selected' : '') ?>>FROM NOC</option>
                          <option value="TO VENDOR" <?php echo ($this->input->get('show') == 'TO VENDOR' ? 'selected' : '') ?>>TO VENDOR</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                  <table class="table dataTable table-hover tableRevision text-center">
                  <thead class="bg-success text-white">
                    <tr>
                      <th><input type="checkbox" class="checkAll"></th>
                      <th class="align-middle">Revision Number</th>
                      <th class="align-middle">Code</th>
                      <th class="align-middle">Status</th>
                      <th class="align-middle">Class</th>
                      <th class="align-middle">Uploaded By</th>
                      <th class="align-middle">Revision Date</th>
                      <th class="align-middle">Upload Date</th>
                      <th class="align-middle">Attachment</th>
                      <th class="align-middle">Transmittal No.</th>
                      <th class="align-middle">Transmittal Date</th>
                      <th class="align-middle">Transmittal Status</th>
                      <th class="align-middle">Remarks</th>
                      <?php if ($this->permission_delete_data == 1): ?>
                        <th></th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($document_revision_list as $key => $revision): ?>
                    <tr>
                     <td><input type="checkbox" name="rev_id[]" value="<?= $revision['id'] ?>" class="check"></td>
                      <td class="align-middle"><?php echo $revision['revision_no'] ?></td>
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="code" onfocus="set_default(this);" class="align-middle"><?php echo $revision['code'] ?></td>
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="status_remark" onfocus="set_default(this);" class="align-middle"><?php echo $revision['status_remark'] ?></td>
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="class" onfocus="set_default(this);" class="align-middle"><?php echo $revision['class'] ?></td>
                      <td class="align-middle"><?php echo @$user_rev_list[$revision['revision_by']] ?></td>
                      <!-- <td class="align-middle"><?php //echo date("l, d F Y", strtotime($revision['revision_date'])) ?></td> -->
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="revision_date" onfocus="set_default(this);" class="align-middle"><?php echo date('Y-m-d', strtotime($revision['revision_date'])) ?></td>
                      <td class="align-middle"><?php echo date("l, d F Y H:i:s", strtotime($revision['timestamp'])) ?></td>
                      <td class="align-middle"><a target="_blank" href="<?php echo base_url_ftp();?>upload/production_design/file/<?php echo $revision['attachment'] ?>" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a></td>
                      <td class="align-middle"><?php echo $revision['transmittal_no'] ?></td>
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="transmittal_date" onfocus="set_default(this);" class="align-middle"><?php echo $revision['transmittal_date'] ?></td>
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="transmittal_status" onfocus="set_default(this);" class="align-middle"><?php echo $revision['transmittal_status'] ?></td>
                      <td <?php echo ($this->permission_eng_act[36] == '1' ? "contenteditable" : '')?> onblur=" (this);" name="<?php echo $revision['id'] ?>" title="remarks" onfocus="set_default(this);" class="align-middle"><?php echo $revision['remarks'] ?></td>
                      <?php if ($this->permission_delete_data == 1): ?>
                        <td class="align-middle"><button type="button" class="btn btn-danger" onclick="delete_detail('<?php echo $revision['id'] ?>', '<?php echo $document['id'] ?>')"><i class="fa fa-trash"></i></button></td>
                      <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <hr>
                  </div>

                <form action="<?= site_url('production/multiple_delete_vendor_revision') ?>" method="post" id="formRevision">
                <input type="hidden" name="document_number" value="<?= $document['id'] ?>">

                  <div class="col-md-12">
                  <b>You thick <b class="text-danger text_delete">0</b> revision to delete</b>
                  </div>
                  <div class="col-md-12 mt-1">
                        <button class="btn btn-danger btnDelete" type="button"><i class="fas fa-trash"></i> Delete</button>
                  </div>
                </form>
                </div>
              </div>
              <div class="tab-pane fade <?php echo ($t == 'm' ? 'show active' : '') ?>" id="pills-mws">
              
                <div class="table-responsive">
                        <table  class="table table-hover tableMWS">
                            <thead class="bg-success text-white">
                              <th>Ref No</th>
                              <th>Mark Up</th>
                              <th>TS Out No</th>
                              <th>TS Out Date</th>
                              <th>Doc Revision</th>
                              <th>Review Status</th>
                              <th>TS In No</th>
                              <th>TS In Date</th>
                              <th>Remarks</th>
                              <th>Upload Date</th>
                            </thead>
                            <tbody>
                              <?php foreach($mws_list as $key => $value): ?> 
                                <tr>
                                  <td><?= $value['document_number'] ?></td>
                                  <td><?= $value['mark_up'] ?></td>
                                  <td><?= $value['ts_out_no'] ?></td>
                                  <td><?= $value['ts_out_date'] ?></td>
                                  <td><?= $value['doc_revision'] ?></td>
                                  <td><?= $value['review_status'] ?></td>
                                  <td><?= $value['ts_in_no'] ?></td>
                                  <td><?= $value['ts_in_date'] ?></td>
                                  <td><?= $value['remarks'] ?></td>
                                  <td><?= $value['upload_date'] ?></td>
                                </tr>
                               <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
          
              </div>
              <div class="tab-pane fade <?php echo ($t == 'ds' ? 'show active' : '') ?>" id="pills-dnv">
                <table class="table table-hoveds">
                <div class="table-responsive">
                        <table  class="table table-hover tableDNV">
                            <thead class="bg-success text-white">
                              <th>Ref No</th>
                              <th>Mark Up</th>
                              <th>TS Out No</th>
                              <th>TS Out Date</th>
                              <th>Doc Revision</th>
                              <th>Review Status</th>
                              <th>TS In No</th>
                              <th>TS In Date</th>
                              <th>Remarks</th>
                              <th>Upload Date</th>
                            </thead>
                            <tbody>
                              <?php foreach($dnv_list as $key => $value): ?> 
                                <tr>
                                  <td><?= $value['document_number'] ?></td>
                                  <td><?= $value['mark_up'] ?></td>
                                  <td><?= $value['ts_out_no'] ?></td>
                                  <td><?= $value['ts_out_date'] ?></td>
                                  <td><?= $value['doc_revision'] ?></td>
                                  <td><?= $value['review_status'] ?></td>
                                  <td><?= $value['ts_in_no'] ?></td>
                                  <td><?= $value['ts_in_date'] ?></td>
                                  <td><?= $value['remarks'] ?></td>
                                  <td><?= $value['upload_date'] ?></td>
                                </tr>
                               <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </table>
              </div>
              
              <!-- Drawing Revision END -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $('.tableMWS').DataTable();
  $('.tableDNV').DataTable();
  var default_value;
  function set_default(cell) {
    default_value = $(cell).text();
  }

  function change_remarks_detail(cell) {
    if($(cell).text() == default_value){
      return false;
    }
    Swal.fire({
      title: 'Are you sure to <b class="text-success">&nbsp;Change&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Change it!'
    }).then((result) => {
      if (result.value) {
        Swal.fire({
          title: 'Wait ...',
          onBeforeOpen () {
            Swal.showLoading ()
          },
          onAfterClose () {
            Swal.hideLoading()
          },
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false
        });
        var id = $(cell).attr('name');
        var column = $(cell).prop("title");
        var content = $(cell).text();
        $.ajax({
          url: "<?php echo base_url();?>production/change_data_rev_doc_prod",
          type: "post",
          data: {
            'id': id,
            'id_document': <?php echo $document['id'] ?>,
            'column': column,
            'content': content,
          },
          success: function(data) {
            sweetalert('success', 'Data Updated!');
          }
        });
      }
      else{
        $(cell).html(default_value);
      }
    });
  }

  function delete_detail(id, id_document) {
    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
      if (result.value) {
        Swal.fire({
          title: 'Wait ...',
          onBeforeOpen () {
            Swal.showLoading ()
          },
          onAfterClose () {
            Swal.hideLoading()
          },
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false
        });
        window.location = "<?php echo base_url() ?>production/delete_data_rev_doc_prod/"+id+"/"+id_document+"/3";
      }
    });
  }
$('.tableRevision').DataTable()
var checked = []
$('.tableRevision').on('click','.checkAll', function(){
  checked = []
  if(this.checked) {
    $('.check').each(function(){
      this.checked = true
      checked.push($(this).val())
    })
  } else {
    $('.check').each(function(){
      this.checked = false
      checked.splice($.inArray($(this).val(), checked), 1)
    })
  $('.text_delete').text(checked.length)
  }
  $('.text_delete').text(checked.length)
})
$('.tableRevision').on('click','.check', function(){
    var val = $(this).val()
  if(this.checked) {
    checked.push(val)
  } else {
    checked.splice($.inArray(val, checked), 1)
  }
  $('.text_delete').text(checked.length)
})

$('.btnDelete').click(function(){
  if(checked.length > 0) {
    Swal.fire({
        type: "warning",
        title : "<b class='text-danger'>DELETE</b>",
        text: "Delete checked revision ?",
        showCancelButton: true,
        cancelButtonColor: "#DC3545"
      }).then((res) => {
        if(res.value) {
          $.map(checked, function(v, i){
            $('#formRevision').append(
              `<input type="hidden" name="id_rev[]" value="${v}">`
            )
          })
          $('#formRevision').submit()
        }
      })
  }
})
function addrow(btn) {
  // var row_copy = $(btn).closest("tr").html();
  var row_copy = $("#tbl_review tr:last").html();
  $("#tbl_review tr:last").after("<tr>" + row_copy + "</tr>");
  var btn_delete = '<button type="button" class="btn btn-danger" onclick="deleterow(this)"><i class="fas fa-trash m-0"></i></button>';
  $("#tbl_review tr:last").find("td:last").html(btn_delete);
  var select = '<select class="form-control select2" name="reviewer[]" required>'+
                  '<option value="">---</option>'+
                  <?php foreach ($user_reviewer_list as $key => $review): ?>
                  '<option value="<?php echo $review['id_user'] ?>"><?php echo $review['badge_no']." - ".$review['full_name'] ?></option>'+
                  <?php endforeach; ?>
                '</select>'+
                '<input type="hidden" name="id_review[]" value="">';
  $("#tbl_review tr:last").find("td:first").html(select).find("select").select2({
    theme: 'bootstrap'
  });
  $("#tbl_review tr:last").find("td:first").next().next().html("Review");
}

function deleterow(btn) {
  $(btn).closest("tr").remove();
}

function delete_reviewer(id) {
  Swal.fire({
    title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Delete it!'
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        title: 'Wait ...',
        onBeforeOpen () {
          Swal.showLoading ()
        },
        onAfterClose () {
          Swal.hideLoading()
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
      });
      window.location = "<?php echo base_url() ?>production/vendor_review_delete_user_process/"+id+"/<?php echo $document['id'] ?>";
    }
  });
}

function delete_reviewer(id) {
  Swal.fire({
    title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Delete it!'
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        title: 'Wait ...',
        onBeforeOpen () {
          Swal.showLoading ()
        },
        onAfterClose () {
          Swal.hideLoading()
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
      });
      window.location = "<?php echo base_url() ?>production/vendor_review_delete_user_process/"+id+"/<?php echo $document['id'] ?>";
    }
  });
}

function delete_reviewer(id) {
  Swal.fire({
    title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Delete it!'
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        title: 'Wait ...',
        onBeforeOpen () {
          Swal.showLoading ()
        },
        onAfterClose () {
          Swal.hideLoading()
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
      });
      window.location = "<?php echo base_url() ?>production/vendor_review_delete_user_process/"+id+"/<?php echo $document['id'] ?>";
    }
  });
}

function submit_review() {
  Swal.fire({
    title: 'Are you sure to <b class="text-info">&nbsp;Submit&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Submit it!'
  }).then((result) => {
    if (result.value) {
      sweetalert("loading", "Please wait...");
      window.location = "<?php echo base_url() ?>production/vendor_review_submit_process/<?php echo $document['id'] ?>";
    }
  });
}

function approve_reviewer(id) {
  Swal.fire({
    title: 'Are you sure to <b class="text-info">&nbsp;Approve&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Approve it!'
  }).then((result) => {
    if (result.value) {
      sweetalert("loading", "Please wait...");
      $('#form_approval_review input[name=action]').val("1");
      $('#form_approval_review').submit();
    }
  });
}

async function reject_reviewer() {
  const { value: text } = await Swal.fire({
    title: 'Are you sure to <b class="text-danger">&nbsp;Return&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    input: 'textarea',
    inputPlaceholder: 'Type your remarks here...',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Return it!',
    inputValidator: (value) => {
      if (!value) {
        return 'You need to write something!'
      }
    }
  })
  if (text) {
    sweetalert("loading", "Please wait...");
    $('#form_approval_review input[name=action]').val("2");
    $('#form_approval_review input[name=remarks]').val(text);
    $('#form_approval_review').submit();
  }
}

async function open_revision_review() {
  const { value: text } = await Swal.fire({
    title: 'Are you sure to <b class="text-warning">&nbsp;Revise&nbsp;</b> this?',
    text: "You won't be able to revert this!",
    type: 'warning',
    input: 'textarea',
    inputPlaceholder: 'Type your remarks here...',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Revise it!',
    inputValidator: (value) => {
      if (!value) {
        return 'You need to write something!'
      }
    }
  })
  if (text) {
    sweetalert("loading", "Please wait...");
    $('#form_approval_review input[name=action]').val("4");
    $('#form_approval_review input[name=remarks]').val(text);
    $('#form_approval_review input[name=category]').val("Vendor");
    $('#form_approval_review').prop('action', '<?php echo base_url(); ?>production/vendor_review_revise_process');
    $('#form_approval_review').submit();
  }
}
</script>