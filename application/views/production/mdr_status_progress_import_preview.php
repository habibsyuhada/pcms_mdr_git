<div id="content">
  <div class="container-fluid">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="card-title"><?php echo $meta_title ?></h6>
        <hr>
        <?php //test_var($project_list, 1) ?>
        <form action="<?php echo base_url() ?>production/mdr_status_progress_import_process" method="POST">
          <div class="row">
            <div class="col-md-12 overflow-auto">
              <table class="table table-hover text-center">
                <thead class="bg-success text-white text-uppercase">
                  <th>NO.</th>
                  <th>DOCUMENT NUMBER</th>
                  <th>Revision Number</th>
                  <th>Revision Date</th>
                  <th>Code</th>
                  <th>Status</th>
                  <th>Class</th>
                  <th>Transmittal Number</th>
                  <th>Transmittal Date</th>
                  <th>Transmittal Status</th>
                  <th>Filename</th>
                  <th>Remarks</th>
                  <th>import STATUS</th>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $ref_no_excel = array();
                    foreach($data_excel as $key => $value): 
                      $status = "";
                      if(isset($file_exist[$value['J']])){
                        if(strpos($file_exist[$value['J']], 'Failed Upload file') !== false){
                          $status = $file_exist[$value['J']];
                        }
                        elseif(strpos($value['status'], 'Failed Upload file') !== false){
                          $status = $value['status'];
                        }
                        elseif(!isset($document_list[$value['A']])){
                          $status = "Reference Number Not Found!!";
                        }
                        elseif(isset($document_list[$value['A']][$value['B']][$value['G']])){
                          $status = "Duplicate Data in Database! ";
                        }
                        elseif(in_array($value['A'].'-'.$value['B'].'-'.$value['G'], $ref_no_excel)){
                          $status = "Failed Upload file : Data Duplicate in Excel!";
                        }
                      }
                      else{
                        $status = "No File Uploaded!";
                      }
                      $ref_no_excel[] = $value['A'].'-'.$value['B'].'-'.$value['G'];
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td>
                      <input type="text" name="ref_no[]" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                      <input type="hidden" name="id_document[]" class="form-control" value="<?php echo $id_document_list[$value['A']] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                    </td>
                    <td><input type="text" name="revision_no[]" class="form-control" value="<?php echo $value['B'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="revision_date[]" class="form-control" value="<?php echo $value['C'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="code[]" class="form-control" value="<?php echo $value['D'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="status_remark[]" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="class[]" class="form-control" value="<?php echo $value['F'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="transmittal_no[]" class="form-control" value="<?php echo $value['G'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="transmittal_date[]" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="transmittal_status[]" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td>
                      <input type="text" name="attachment_view[]" class="form-control" value="<?php echo $value['J'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                      <input type="hidden" name="attachment[]" class="form-control" value="<?php echo (strpos(@$file_exist[$value['J']], 'Failed Upload file') !== false ? '' : @$file_exist[$value['J']]) ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                    </td>
                    <td><input type="text" name="remarks[]" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><?php echo $status ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <hr>
              <a href="javascript:history.back()" class="btn btn-secondary"><i
                  class="fas fa-arrow-left"></i> Back</a>
              <button type="submit" class="btn btn-primary btnSubmit"><i class="fas fa-save"></i>
                Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $('table').DataTable( {
    paging: false,
    searching: false,
    dom: 'Bfrtip',
    buttons: [
      {
        extend:'excel',exportOptions: {format: {
          body: function ( data, row, column, node ) {
              if(column != 12){
                if($(data).is("input")){
                  data = $(data).val();
                }
              }
              
              return data;
          }
        }
      }},
      {
        extend:'copy',exportOptions: {format: {
          body: function ( data, row, column, node ) {
              if(column != 12){
                if($(data).is("input")){
                  data = $(data).val();
                }
              }
              
              return data;
          }
        }
      }}
    ],
    createdRow : function( row, data, dataIndex){
      if( data[12] !=  ''){
        $(row).css({"background-color":'#f8d7da', 'color' : '#721c24'});
        $(row).addClass('font-weight-bold');
      }
    }
  });
</script>