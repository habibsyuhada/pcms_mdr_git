<?php //test_var(array($project_list, $module_list, $discipline_list), 1) ?>
<div id="content">
  <div class="container-fluid">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="card-title">Document Definition Upload Preview (<?php echo (@$cetegory == 2 ? 'MDR' : 'VENDOR') ?>)</h6>
        <hr>
        <?php //test_var($project_list, 1) ?>
        <form action="<?php echo base_url() ?>production/mdr_definition_import_process" method="POST">
        <input type="hidden" name="cetegory" value="<?php echo $cetegory ?>">
          <div class="row">
            <div class="col-md-12 overflow-auto">
              <table class="table table-hover text-center">
                <thead class="bg-success text-white">
                  <th>NO.</th>
                  <th>DOCUMENT NUMBER</th>
                  <th>DOCUMENT TITLE</th>
                  <th>COUNTRY</th>
                  <th>PROJECT</th>
                  <th>MODULE</th>
                  <th>DISCIPLINE</th>
                  <th>DOC TYPE</th>
                  <th>SYSTEM</th>
                  <th>SUB SYSTEM</th>
                  <th>COMPANY ORIGINATOR</th>
                  <th>VENDOR CODE</th>
                  <th>PO NUMBER</th>
                  <th>REMARKS</th>
                  <th>STATUS</th>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $ref_no_excel = array();
                    foreach($data_excel as $key => $value): 
                      $status = "";
                      if(isset($document_list[$value['A']])){
                        $status = "Data Duplicate in Database!";
                      }
                      elseif(in_array($value['A'], $ref_no_excel)){
                        $status = "Data Duplicate in Excel!";
                      }
                      elseif(!isset($project_list[$value['D']])){
                        $status = "Project Not Found! ";
                      }
                      elseif(!isset($module_list[$value['E']])){
                        $status = "Module Not Found!";
                      }
                      elseif(!isset($discipline_list[$value['F']])){
                        $status = "Discipline Not Found!";
                      }
                      $ref_no_excel[] = $value['A'];
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><input type="text" name="ref_no[]" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="description[]" class="form-control" value="<?php echo $value['B'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="country[]" class="form-control" value="<?php echo $value['C'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td>
                      <input type="text" name="project_id_view[]" class="form-control" value="<?php echo $value['D'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                      <input type="hidden" name="project_id[]" class="form-control" value="<?php echo @$project_list[$value['D']]['id'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                    </td>
                    <td>
                      <input type="text" name="module_view[]" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                      <input type="hidden" name="module[]" class="form-control" value="<?php echo @$module_list[$value['E']]['mod_id'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                    </td>
                    <td>
                      <input type="text" name="discipline_view[]" class="form-control" value="<?php echo $value['F'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                      <input type="hidden" name="discipline[]" class="form-control" value="<?php echo @$discipline_list[$value['F']]['id'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>>
                    </td>
                    <td><input type="text" name="document_type[]" class="form-control" value="<?php echo $value['G'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="system[]" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="subsystem[]" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="generator[]" class="form-control" value="<?php echo $value['J'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="vendor_code[]" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="po_number[]" class="form-control" value="<?php echo $value['L'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
                    <td><input type="text" name="remarks[]" class="form-control" value="<?php echo $value['M'] ?>" <?php echo ($status == '' ? 'readonly' : 'disabled') ?>></td>
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
              if(column != 14){
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
              if(column != 14){
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
      if( data[14] !=  ''){
        $(row).css({"background-color":'#f8d7da', 'color' : '#721c24'});
        $(row).addClass('font-weight-bold');
      }
    }
  });
</script>