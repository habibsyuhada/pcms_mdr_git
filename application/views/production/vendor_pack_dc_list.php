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
        <h6 class="pb-2 mb-0">Filter</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            
            <form id="form_filter">
              <?php if($this->input->get('export') === ''): ?>
              <input type="hidden" name="export">
              <?php elseif($this->input->get('transmittal') === ''): ?>
              <input type="hidden" name="transmittal">
              <?php endif; ?>
              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Project :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="project_id" id='projectx' onchange="modulexprojectx()">
                        <option value="">---</option>
                        <?php foreach($project_list as $key => $value): ?>
                          <?php if($this->permission_eng_act[39] == '0' && $this->user_cookie[10] == $value['id']): ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php elseif($this->permission_eng_act[39] == '1'): ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->input->get('project_id') == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Module :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="module" id="modulex">
                        <option value="">---</option>
                        <?php foreach($module_chain as $module){ ?>
                              <option <?php echo $this->input->get('module') == $module['mod_id'] ? 'selected="selected"' : '' ?> 
                                    class="<?php echo $module['project_id'] ?>" value="<?= $module['mod_id'] ?>"><?= $module['mod_desc'] ?></option>
                            <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Discipline :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="discipline">
                        <option value="">---</option>
                        <?php foreach($discipline_list as $key => $value): ?>
                          <?php if(count($this->permission_discipline_view_data) > 0): ?>
                            <?php if(in_array($value['id'], $this->permission_discipline_view_data)): ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->input->get('discipline') == $value['id'] ? 'selected' : '') ?>>(<?php echo $value['discipline_code'] ?>) <?php echo $value['discipline_name'] ?></option>
                            <?php endif; ?>
                          <?php else: ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo ($this->input->get('discipline') == $value['id'] ? 'selected' : '') ?>>(<?php echo $value['discipline_code'] ?>) <?php echo $value['discipline_name'] ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Code :</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="code" value="<?php echo $this->input->get('code') ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Class :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="class">
                        <option value="">---</option>
                        <option value="N/A" <?php echo ($this->input->get('class') == 'N/A' ? 'selected' : '') ?>>N/A</option>
                        <option value="1" <?php echo ($this->input->get('class') == '1' ? 'selected' : '') ?>>1</option>
                        <option value="2" <?php echo ($this->input->get('class') == '2' ? 'selected' : '') ?>>2</option>
                        <option value="3" <?php echo ($this->input->get('class') == '3' ? 'selected' : '') ?>>3</option>
                        <option value="4" <?php echo ($this->input->get('class') == '4' ? 'selected' : '') ?>>4</option>
                        <option value="5" <?php echo ($this->input->get('class') == '5' ? 'selected' : '') ?>>5</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Vendor :</label>
                    <div class="col-xl">
                      <select class="custom-select select2" name="vendor">
                        <option value="">---</option>
                        <?php foreach ($vendor_list as $key => $value): ?>
                          <option value="<?php echo $value['company_code'] ?>" <?php echo ($this->input->get('vendor') == $value['company_code'] ? 'selected' : ($this->user_cookie[11] == $value['id_company'] ? "selected" : "")) ?>><?php echo $value['company_code']." - ".$value['company_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Status Review :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="status_review">
                        <option value="">---</option>
                        <option value="0" <?php echo ($this->input->get('status_review') == '0' ? 'selected' : '') ?>>Open</option>
                        <option value="1" <?php echo ($this->input->get('status_review') == '1' ? 'selected' : '') ?>>Submitted</option>
                        <option value="2" <?php echo ($this->input->get('status_review') == '2' ? 'selected' : '') ?>>Rejected</option>
                        <option value="3" <?php echo ($this->input->get('status_review') == '3' ? 'selected' : '') ?>>Reviewed</option>
                        <option value="4" <?php echo ($this->input->get('status_review') == '4' ? 'selected' : '') ?>>Complete</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Status :</label>
                    <div class="col-xl">
                      <input type="hidden" name="status" value="9">
                      <select class="custom-select" name="">
                        <option value="9" <?php echo ($this->input->get('status') == '9' ? 'selected' : '') ?>>Completed</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                </div>
              </div> -->

              <div class="row">
                <div class="col-md">
                </div>
                <div class="col-md">
                  <div class="form-group row m-0">
                    <div class="col-xl text-right">
                      <!-- <button type="submit" name='submit' value='download' class="btn btn-info" title="Download"><i class="fa fa-download"></i> Download</button> -->
                      <!-- <a target="_blank" href="<?= base_url() ?>report/master_mdr_report_excel/001" class="btn btn-success text-white" ><i class="fas fa-file-alt"></i> NEW SMOP Vendor Package Report</a> -->
                      <!-- <a target="_blank" href="<?= base_url() ?>production/vendor_pack_design_list_smop_excel" class="btn btn-success text-white" ><i class="fas fa-file-alt"></i> SMOP Vendor Package Report</a> -->
                      <a target="_blank" href="<?= base_url() ?>production/vendor_pack_design_list_excel" class="btn btn-info text-white" ><i class="fa fa-download"></i> Download</a>
                      <button type="submit" name='submit' value='filter' class="btn btn-primary" title="Update"><i class="fa fa-search"></i> Filter</button>
                    </div>
                  </div>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>    
  </div>

  <div class="row">    
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <table class="table dataTable table-hover text-center">
              <thead class="bg-success text-white">
                <tr>
                  <th><input type='checkbox' class='checkbox-big check' onclick='all_checkbox(this)'></th>
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
                  <th>Uploaded By</th>
                  <th>Upload Date</th>
                  <th>Attachment</th>
                  <th>Transmittal No.</th>
                  <th>Transmittal Date</th>
                  <th>Transmittal Status</th>
                  <th>Vendor Code</th>
                  <th>PO Number</th>
                  <th>Status Review</th>
                  <th>Overdue Date</th>
                  <th>Waiting For</th>
                  <th>Remarks</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <form method="POST" id="form_download" action="<?php echo base_url_ftp() ?>public_smoe/mdr_download_multi_process" target="_blank">
                  <div class="font-weight-bold">
                    You tick <span class="text-danger num_ticker">0</span> documents to Download.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <input type="hidden" name="id_document">
                      <button type="button" onclick="download_zip()" class="btn btn-success"><i class='fas fa-cloud-download-alt'></i> Download</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-3">
                <form method="POST" id="form_transmit" action="<?= site_url('production/vmdr_transmit_preview') ?>">
                  <div class="font-weight-bold">
                    You tick <span class="text-danger num_delete">0</span> documents to Transmit.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <input type="hidden" name="id_document">
                      <button type="button" class="btn btn-info" onclick="transmit_doc()"><i class="fas fa-paper-plane"></i> Transmit</button>
                    </div>
                  </div>
                </form>
              </div>
              <?php if($this->permission_delete_data == 1): ?>
              <div class="col-md-3">
                <form method="POST" id="form_delete" action="<?= site_url('production/multiple_delete_vendor') ?>">
                  <div class="font-weight-bold">
                    You tick <span class="text-danger num_delete">0</span> documents to Delete.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <input type="hidden" name="id_document">
                      <button type="button" class="btn btn-danger btnDelete"><i class='fas fa-trash'></i> Delete</button>
                    </div>
                  </div>
                </form>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  var data_checkbox = [];
  $('.dataTable').DataTable({
    "lengthChange": true,
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      "url": "<?php echo base_url();?>production/vendor_pack_design_list_json",
      "type": "POST",
      "data":{
          // "page" : 'list',
      <?php 
        if($this->input->get('submit')){
          echo '"submit": 1,';
          if($this->input->get('project_id')){
            echo '"project_id": '. $this->input->get('project_id').',';
          }
          if($this->input->get('module')){
            echo '"module": '. $this->input->get('module').',';
          }
          if($this->input->get('discipline')){
            echo '"discipline": '. $this->input->get('discipline').',';
          }
          if($this->input->get('code')){
            echo '"code": '. $this->input->get('code').',';
          }
          if($this->input->get('class')){
            echo '"class": '. $this->input->get('class').',';
          }
          if($this->input->get('vendor')){
            echo '"vendor": "'. $this->input->get('vendor').'",';
          }
          if($this->input->get('status_review') != ''){
            echo '"status_review": "'. $this->input->get('status_review').'",';
          }
        }
        else{
          if($this->permission_eng_act[39] == '0'){
            echo '"project_id": '. $this->user_cookie[10].',';
          }
        }
        
      ?>
      }
    },
    "columnDefs": [
      {
        "targets": 0,
        "orderable": false,
        "render": function ( data, type, row, meta ) {
          // console.log(row[0]);
          if(row[0] == 0){
            return "";
          }
          else{
            if(jQuery.inArray(row[0], data_checkbox) != -1) {
              return "<input type='checkbox' class='checkbox-big check' value='"+ row[0] +"' onclick='save_checkbox(this)' checked>";
            } else {
              return "<input type='checkbox' class='checkbox-big check' value='"+ row[0] +"' onclick='save_checkbox(this)'>";
            }
          }
        }
      }
    ]
  });

  function save_checkbox(input) {
    if($(input).prop("checked") == true){
      if($.inArray($(input).val(), data_checkbox) === -1){
        data_checkbox.push($(input).val());
      }
    }
    else{
      if($.inArray($(input).val(), data_checkbox) !== -1){
        data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
      }
    }
    $(".num_ticker").html(data_checkbox.length)
    $('.num_delete').text(data_checkbox.length)
  }

  function all_checkbox(input) {
    if($(input).prop("checked") == true){
      $('table tbody input[type=checkbox]').each(function(){
        $(this).prop('checked', true);
        save_checkbox(this);
      })
    }
    else{
      $('table tbody input[type=checkbox]').each(function(){
        $(this).prop('checked', false);
        save_checkbox(this);
      })
    }
  }

  function download_zip() {
    $("#form_download input[name=id_document]").val(data_checkbox.join("; "));
    $('#form_download').submit();
  }

  function transmit_doc() {
    $("#form_transmit input[name=id_document]").val(data_checkbox.join("; "));
    $('#form_transmit').submit();
  }

  function delete_data(id) {
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
        window.location = "<?php echo base_url() ?>production/delete_data_dc/3/"+id;
      }
    })
  }

  modulexprojectx();
  function modulexprojectx() {
    if($('#projectx').val() ==''){
      $('#modulex').prop('disabled', true);
    }
    else{
      $('#modulex').prop('disabled', false);
    }
  }

  $('.btnDelete').click(function(){
    if(data_checkbox.length > 0) {
      Swal.fire({
        type: "warning",
        title : "<b class='text-danger'>DELETE</b>",
        text: "Delete selected Vendor ?",
        showCancelButton: true
      }).then((res) => {
        if(res.value) {
          $.map(data_checkbox, function(v, i){
            $("#form_delete").append(
              `<input type="hidden" name="ref_no[]"  value="${v}">`
            )
            $("#form_delete").submit()
          })
        }
      })
    } 
  })
</script>

<!-- <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("#modulex").chained("#projectx"); // disini kita hubungkan kota dengan provinsi
</script>