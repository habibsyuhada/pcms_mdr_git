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
 
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">

          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'd' ? 'active' : '') ?>" data-toggle="pill" href="#pills-detail">Detail</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'p' ? 'active' : '') ?>" data-toggle="pill" href="#pills-planner">Plan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'rev' ? 'active' : '') ?>" data-toggle="pill" href="#pills-rev">Revision</a>
          </li>
          <?php if($this->permission_eng_act[36] == '1'): ?>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'mws' ? 'active' : '') ?>" data-toggle="pill" href="#pills-mws">MWS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'dnv' ? 'active' : '') ?>" data-toggle="pill" href="#pills-dnv">DNV</a>
          </li>
          <?php endif; ?>

        </ul>
        <div class="overflow-auto media text-muted py-3 border-bottom border-top border-gray">
          <div class="container-fluid">
            <div class="tab-content">

              <!-- Drawing Detail -->
              <div class="tab-pane fade <?php echo ($t == 'd' ? 'show active' : '') ?>" id="pills-detail">
                <form method="POST" action="<?php echo base_url();?>production/mdr_document_edit_process">

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
                            <option value="<?php echo $discipline['id'] ?>" <?php echo ($discipline['id'] == $document['discipline'] ? 'selected' : '') ?>>(<?php echo $discipline['discipline_code'] ?>) <?php echo $discipline['discipline_name'] ?></option>
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
                        <label class="col-xl-3 col-form-label">Document Type :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="document_type" value="<?php echo $document['document_type'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Document Generator :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="generator" value="<?php echo $document['generator'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">System :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="system" value="<?php echo $document['system'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Sub-system :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="subsystem" value="<?php echo $document['subsystem'] ?>">
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

              <!-- Drawing Planner -->
              <div class="tab-pane fade <?php echo ($t == 'p' ? 'show active' : '') ?>" id="pills-planner">
                <form method="POST" action="<?php echo base_url();?>production/mdr_document_planner_edit_process">
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

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">AFD Planned Date :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="afd_planned_date" value="<?php echo $document['afd_planned_date'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Equipment Class :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="equipment_class" value="<?php echo $document['equipment_class'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Equipment SubClass :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="equipment_subclass" value="<?php echo $document['equipment_subclass'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Criticality :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="criticality" value="<?php echo $document['criticality'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Originator Doc. Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="originator_doc_number" value="<?php echo $document['originator_doc_number'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">TAG :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="tag" value="<?php echo $document['tag'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Cable TAG :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="cable_tag" value="<?php echo $document['cable_tag'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Line TAG :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="line_tag" value="<?php echo $document['line_tag'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">SPP TAG :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="spp_tag" value="<?php echo $document['spp_tag'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">MDR Update Information :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="mdr_update_information" value="<?php echo $document['mdr_update_information'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Field Operations Delivrable :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="field_operations_delivrable" value="<?php echo $document['field_operations_delivrable'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Weight :</label>
                        <div class="col-xl">
                          <input type="number" class="form-control" name="weight" value="<?php echo $document['weight'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Progress :</label>
                        <div class="col-xl">
                          <input type="number" class="form-control" name="progress" value="<?php echo $document['progress'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Contractor Transmittal Sheet Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="contractor_transmittal_sheet_number" value="<?php echo $document['contractor_transmittal_sheet_number'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Issue Date Contractor Transmittal Sheet :</label>
                        <div class="col-xl">
                          <input type="date" class="form-control" name="issue_date_contractor_transmittal_sheet" value="<?php echo $document['issue_date_contractor_transmittal_sheet'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">MDR Revision or Change Request nb :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="mdr_revision_request_nb" value="<?php echo $document['mdr_revision_request_nb'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">FDB Volume :</label>
                        <div class="col-xl">
                          <input type="number" class="form-control" name="fdb_volume" value="<?php echo $document['fdb_volume'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Brownfield Interface :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="brownfield_interface">
                            <option value="">---</option>
                            <option value="Y" <?php echo ($document['brownfield_interface'] == "Y" ? "selected" : "") ?>>Yes</option>
                            <option value="N" <?php echo ($document['brownfield_interface'] == "N" ? "selected" : "") ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Folio Drawing :</label>
                        <div class="col-xl">
                          <select class="custom-select" name="folio_drawing">
                            <option value="">---</option>
                            <option value="Y" <?php echo ($document['folio_drawing'] == "Y" ? "selected" : "") ?>>Yes</option>
                            <option value="N" <?php echo ($document['folio_drawing'] == "N" ? "selected" : "") ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
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
              
              <!-- Drawing Detail -->
              <div class="tab-pane fade <?php echo ($t == 'rev' ? 'show active' : '') ?>" id="pills-rev">
                <form method="POST" action="<?php echo base_url();?>production/mdr_document_revision_new_process" enctype="multipart/form-data">

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
                            <option value="SPD">SPD</option>
                            <option value="CLD">CLD</option>
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
                <table  class="table dataTable tableRevision table-hover text-center">
                  <thead class="bg-success text-white">
                    <tr>
                      <th><input type="checkbox" name="" id="" class="checkAll"></th>
                      <th>Revision Number</th>
                      <th>Code</th>
                      <th>Status</th>
                      <th>Class</th>
                      <th>Uploaded By</th>
                      <th>Revision Date</th>
                      <th>Upload Date</th>
                      <th>Attachment</th>
                      <th>Transmittal Date</th>
                      <th>Transmittal No.</th>
                      <th>Remarks</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($document_revision_list as $key => $revision): ?>
                    <tr>
                    <td><input type="checkbox" name="id[]" value="<?= $revision['id'] ?>" class="check"></td>
                      <td class="align-middle"><?php echo $revision['revision_no'] ?></td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="code" onfocus="set_default(this);"class="align-middle"><?php echo $revision['code'] ?></td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="status_remark" onfocus="set_default(this);"class="align-middle"><?php echo $revision['status_remark'] ?></td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="class" onfocus="set_default(this);"class="align-middle"><?php echo $revision['class'] ?></td>
                      <td class="align-middle"><?php echo @$user_rev_list[$revision['revision_by']] ?></td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="revision_date" onfocus="set_default(this);" class="align-middle"><?php echo date('Y-m-d', strtotime($revision['revision_date'])) ?></td>
                      <td class="align-middle"><?php echo date("l, d F Y H:i:s", strtotime($revision['timestamp'])) ?></td>
                      <td class="align-middle">
                      <?php if($revision['attachment'] != ""): ?>
                        <a target="_blank" href="<?php echo base_url_ftp();?>upload/production_design/file/<?php echo $revision['attachment'] ?>" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a>
                      <?php else: ?>
                        <span class="text-danger font-weight-bold">No Data Available</span>
                      <?php endif; ?>
                      </td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="transmittal_date" onfocus="set_default(this);" class="align-middle"><?php echo $revision['transmittal_date'] ?></td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="transmittal_no" onfocus="set_default(this);" class="align-middle"><?php echo $revision['transmittal_no'] ?></td>
                      <td contenteditable onblur="change_remarks_detail(this);" name="<?php echo $revision['id'] ?>" title="remarks" onfocus="set_default(this);" class="align-middle"><?php echo $revision['remarks'] ?></td>
                      <td class="align-middle"><button type="button" class="btn btn-danger" onclick="delete_detail('<?php echo $revision['id'] ?>', '<?php echo $document['id'] ?>')"><i class="fa fa-trash"></i></button></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <hr>
                <form action="<?= site_url('production/multiple_delete_mdr_revision') ?>" id="formDeleteRevision" method="post">
                <input type="hidden" name="document_number" value="<?php echo $document['id'] ?>">
                <div class="row">
                <div class="col-md-12">
                    <b>You thick <b class="text-danger text_delete">0</b> revision to delete</b>
                </div>
                  <div class="col-md-12 mt-1">
                      <button class="btn btn-danger btnDelete"><i class="fas fa-trash"></i> Delete</button>
                  </div>
                </div>
                </form>
              </div>
              <!-- Drawing Detail END -->
              
              <!-- Drawing CLD -->
              <div class="tab-pane fade <?php echo ($t == 'mws' ? 'show active' : '') ?>" id="pills-mws">
                    <div class="table-responsive">
                        <table  class="table table-hover tableMWS">
                            <thead class="bg-success text-white ">
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
              <div class="tab-pane fade <?php echo ($t == 'dnv' ? 'show active' : '') ?>" id="pills-dnv">
              <div class="table-responsive">
                        <table class="table table-hover tableDNV">
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
              </div>
              <!-- Drawing CLD END -->

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
    // alert($(cell).text());
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
        window.location = "<?php echo base_url() ?>production/delete_data_rev_doc_prod/"+id+"/"+id_document+"/2";
      }
    });
  }
  $('.tableRevision').DataTable()

  var checked = []
  $('.tableRevision').on('click','.checkAll', function() {
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
    }
    $('.text_delete').text(checked.length)
  })
  $('.tableRevision').on('click','.check', function() {
    var val = $(this).val()
    if(this.checked) {
      checked.push(val)
    } else {
      checked.splice($.inArray(val, checked), 1)
    }
    $('.text_delete').text(checked.length)
  })

  $('.btnDelete').click(function(e){
    e.preventDefault()
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
            $('#formDeleteRevision').append(
              `<input type="hidden" name="id_rev[]" value="${v}">`
            )
          })
          $('#formDeleteRevision').submit()
        }
      })
    }
  })


</script>