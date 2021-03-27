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
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php if($this->permission_eng_act[36] == '1'): ?>
            <form method="POST" action="<?php echo base_url();?>production/mdr_dc_new_process" enctype="multipart/form-data">

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Reference Number :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="ref_no" required>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Project</label>
                    <div class="col-xl">
                      <select class="custom-select" name="project_id" id='projectx' onchange="modulexprojectx()">
                        <?php foreach($project_list as $project): ?>
                        <option value="<?php echo $project['id'] ?>"><?php echo $project['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Discipline</label>
                    <div class="col-xl">
                      <select class="custom-select" name="discipline">
                        <?php foreach($discipline_list as $discipline): ?>
                        <option value="<?php echo $discipline['id'] ?>">(<?php echo $discipline['discipline_code'] ?>) <?php echo $discipline['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Module</label>
                    <div class="col-xl">
                      <select class="custom-select" name="module" id="modulex" required>
                       <?php foreach($module_chain as $module){ ?>
                              <option <?php echo $module_chain_selected == $module['mod_id'] ? 'selected="selected"' : '' ?> 
                                    class="<?php echo $module['project_id'] ?>" value="<?= $module['mod_id'] ?>"><?= $module['mod_desc'] ?></option>
                            <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Document Type :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="document_type">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Document Generator :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="generator">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Title :</label>
                    <div class="col-xl">
                      <textarea class="form-control" name="description" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Remarks :</label>
                    <div class="col-xl">
                      <textarea class="form-control" name="remarks"></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">System :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="system">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Sub-System :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="subsystem">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">WP :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="wp">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">WU :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="wu">
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
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
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
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
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
                      <input type="text" class="form-control" name="ctr_lead">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">ASB Planned Date :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="asb_planned_date">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">IFR Planned Date :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="ifr_planned_date">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">IFA Planned Date :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="ifa_planned_date">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">AFC Planned Date :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="afc_planned_date">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">IFI Planned Date :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="ifi_planned_date">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">AFD Planned Date :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="afd_planned_date">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Equipment Class :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="equipment_class">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Equipment SubClass :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="equipment_subclass">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Criticality :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="criticality">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Originator Doc. Number :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="originator_doc_number">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">TAG :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="tag">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Cable TAG :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="cable_tag">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Line TAG :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="line_tag">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">SPP TAG :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="spp_tag">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">MDR Update Information :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="mdr_update_information">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Field Operations Delivrable :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="field_operations_delivrable">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Weight :</label>
                    <div class="col-xl">
                      <input type="number" class="form-control" name="weight">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Progress :</label>
                    <div class="col-xl">
                      <input type="number" class="form-control" name="progress">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Contractor Transmittal Sheet Number :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="contractor_transmittal_sheet_number">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Issue Date Contractor Transmittal Sheet :</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="issue_date_contractor_transmittal_sheet">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">MDR Revision or Change Request nb :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="mdr_revision_request_nb">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">FDB Volume :</label>
                    <div class="col-xl">
                      <input type="number" class="form-control" name="fdb_volume">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Brownfield Interface :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="brownfield_interface">
                        <option value="">---</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
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
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
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
            <?php endif; ?>

          </div>
        </div>

      </div>
    </div>
    
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
    modulexprojectx();
  function modulexprojectx() {
    if($('#projectx').val() ==''){
      $('#modulex').prop('disabled', true);
    }
    else{
      $('#modulex').prop('disabled', false);
    }
  }
</script>

<!-- <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("#modulex").chained("#projectx"); // disini kita hubungkan kota dengan provinsi
</script>