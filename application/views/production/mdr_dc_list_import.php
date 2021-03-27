<style type="text/css">
.nav-link {
  color: #000;
}

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
  color: #007bff;
  background: #fff;
  border-bottom: 2px solid #007bff;
  border-radius: 0px;
}
</style>
<div id="content" class="container-fluid">
  <div class="row">

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Import Definition (MDR)</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php if($this->permission_eng_act[37] == '1'): ?>
            <form method="POST" action="<?php echo base_url();?>production/mdr_definition_import_preview/2"
              enctype="multipart/form-data">

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">

                    <div class="col-xl">
                      <div class="col-xl text-right">
                        <a href="<?php echo base_url(); ?>file/production_design/Template_Import_Definition.xlsx"
                          class='btn btn-success'><i class="fas fa-cloud-download-alt"></i>
                          Download Template Definition
                          <?php if(date('Y-m-d') < '2020-09-15'): ?><span
                            class="badge badge-danger">New</span><?php endif; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Template Import Definition :</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_template_mws"
                          name="file"
                          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                          required />
                        <label class="custom-file-label input1">Choose Template Definition</label>
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
                      <button type="submit" name='submit' value='submit' class="btn btn-primary"
                        title="Submit"><i class="fa fa-check"></i> Submit</button>
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

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Import Document Status & Progress  (MDR)</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php if($this->permission_eng_act[37] == '1'): ?>
            <form method="POST" action="<?php echo base_url();?>production/mdr_status_progress_import_preview"
              enctype="multipart/form-data">

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">

                    <div class="col-xl">
                      <div class="col-xl text-right">
                        <a href="<?php echo base_url(); ?>file/production_design/Template_Import_Status_Progress.xlsx?v=0.1"
                          class='btn btn-success' download="Template_Import_Status_Progress_25-09-2020.xlsx"><i class="fas fa-cloud-download-alt"></i>
                          Download Template Document Status & Progress 
                          <?php if(date('Y-m-d') < '2020-09-15'): ?><span
                            class="badge badge-danger">New</span><?php endif; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Template Import Document Status & Progress :</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_template_dnv"
                          name="file_excel"
                          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                          required />
                        <label class="custom-file-label input2">Choose Template Import
                        Document Status & Progress</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">File Attachment :</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_attachment"
                          name="file_attachments[]" multiple="multiple"
                           />
                        <label class="custom-file-label input4">Choose File Attachment</label>
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
                      <button type="submit" name='submit' value='submit' class="btn btn-primary"
                        title="Submit"><i class="fa fa-check"></i> Submit</button>
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

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Import MWS (MDR)</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php if($this->permission_eng_act[37] == '1'): ?>
            <form method="POST" action="<?php echo base_url();?>production/mws_upload_preview"
              enctype="multipart/form-data">

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">

                    <div class="col-xl">
                      <div class="col-xl text-right">
                        <a href="<?php echo base_url(); ?>file/production_design/Template_Import_MWS.xlsx"
                          class='btn btn-success'><i class="fas fa-cloud-download-alt"></i>
                          Download Template MWS <b>(26-09-2020)</b>
                          <?php if(date('Y-m-d') < '2020-09-15'): ?><span
                            class="badge badge-danger">New</span><?php endif; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Template Import MWS :</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_template_mws"
                          name="mws_template"
                          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                          required />
                        <label class="custom-file-label input1">Choose Template Import
                          MWS</label>
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
                      <button type="submit" name='submit' value='submit' class="btn btn-primary"
                        title="Submit"><i class="fa fa-check"></i> Submit</button>
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
    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Import CA-DNV  (MDR)</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php if($this->permission_eng_act[37] == '1'): ?>
            <form method="POST" action="<?php echo base_url();?>production/dnv_upload_preview"
              enctype="multipart/form-data">

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">

                    <div class="col-xl">
                      <div class="col-xl text-right">
                        <a href="<?php echo base_url(); ?>file/production_design/Template_Import_DNV.xlsx"
                          class='btn btn-success'><i class="fas fa-cloud-download-alt"></i>
                          Download Template DNV <b>(26-09-2020)</b>
                          <?php if(date('Y-m-d') < '2020-09-15'): ?><span
                            class="badge badge-danger">New</span><?php endif; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Template Import DNV :</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_template_dnv"
                          name="dnv_template"
                          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                          required />
                        <label class="custom-file-label input2">Choose Template Import
                          DNV</label>
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
                      <button type="submit" name='submit' value='submit' class="btn btn-primary"
                        title="Submit"><i class="fa fa-check"></i> Submit</button>
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
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Import Planner  (MDR)</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php if($this->permission_eng_act[37] == '1'): ?>
            <form method="POST" action="<?php echo base_url();?>production/planner_upload_preview"
              enctype="multipart/form-data">

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">

                    <div class="col-xl">
                      <div class="col-xl text-right">
                        <a href="<?php echo base_url(); ?>file/production_design/Template_Import_Planner_2020-10-17.xlsx"
                          class='btn btn-success'><i class="fas fa-cloud-download-alt"></i>
                          Download Template Planner (2020-10-17)
                          <?php if(date('Y-m-d') < '2020-10-21'): ?><span
                            class="badge badge-danger">New</span><?php endif; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Template Import Planner :</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_template_planner"
                          name="planner_template"
                          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                          required />
                        <label class="custom-file-label inputplanner">Choose Template Import
                          Planner</label>
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
                      <button type="submit" name='submit' value='submit' class="btn btn-primary"
                        title="Submit"><i class="fa fa-check"></i> Submit</button>
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