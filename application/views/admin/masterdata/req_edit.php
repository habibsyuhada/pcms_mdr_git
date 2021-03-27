<div class="container-fluid medium" style="min-height: 79vh">

<form method="POST" action="<?php echo base_url();?>emr/req_edit_process">
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
             
              <?php 
                $req_list = $req_list[0];
                $request_by = $request_by[0];
              ?>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Requestor</label>
                <div class="col-sm-10">
                  <input type="hidden" name="request_no" value="<?php echo $req_list['request_no'] ?>" required>

                  <input type="hidden" name="status_current" value="<?php echo $req_list['status'] ?>" required>
                  <input type="hidden" name="id_cost" value="<?php echo $req_list['project_id'] ?>" required>
                  
                  <input type="hidden" class="form-control search_name_badge" name="name" placeholder="Name" value="<?php echo $req_list['request_by'] ?>" required readonly>
                   <input type="text" class="form-control" placeholder="Name" value="<?php echo $request_by['full_name'] ?>" required readonly>
                </div>
              </div>
               <div class="form-group row">
                <label class="col-sm-2 col-form-label">Category MR</label>
                <div class="col-sm-10">
                  <input type="hidden" class="form-control" name="cost_cat" value="<?php echo $req_list['category_emr'] ?>" readonly >
                  <?php if( $req_list['category_emr'] == 'cost_centre'){ ?>
                   <input type="text" class="form-control" value="Cost Centre" readonly >
                 <?php } else { ?>
                  <input type="text" class="form-control" value="Job Cost" readonly >
                 <?php }  ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Request Date</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="date" value="<?php echo date('Y-m-d H:i:s', strtotime($req_list['request_date'])); ?>" required readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cost Centre / Job Cost</label>
                <div class="col-sm-10">
                  <?php 
                    foreach($cost_list as $cost){
                      if($req_list['project_id'] == $cost['id_cost']){
                        $cost_fix = $cost;
                      }
                    }
                  ?>

                  <input type="text" class="form-control" name="project_show" value="<?php echo $cost_fix['cost_code'] ?> - <?php echo $cost_fix['cost_dept'] ?>" required readonly>
                  <input type="hidden" class="form-control" name="project" value="<?php echo $cost_fix['id_cost'] ?>" required readonly>
                 

                </div>
              </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Materials</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center" id="t_material">
              <thead>
                <tr>
                  <th>Item Description</th>
                  <th>Size</th>
                  <th>UOM</th>
                  <th>QTY</th>
                  <th>Currency</th>
                  <th>Expected Unit Cost</th>
                  <th>Required On-site Date</th>
                  <th>Reasons</th>
                  <th>Remarks</th>
                  <th>Attachments</th>
                  <th nowrap>
                    <a class="btn btn-primary  text-white" title="Add" data-toggle="modal" href="#add_material">
                      <i class="fa fa-plus"></i>
                    </a><!-- 
                    <a class="btn btn-info  text-white" title="Add" data-toggle="modal" href="#upl_material">
                      <i class="fa fa-upload"></i>
                    </a>
                    <button class="btn btn-danger  text-white" title="Reset" type="button" onClick="resetmaterial('req_edit/<?php echo $req_list['request_no'] ?>')">
                      <i class="fa fa-close"></i>
                    </buttton> -->
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $item_list = $this->session->userdata('material');
                  if($item_list):
                  $item_list = array_reverse($item_list, true);
                  foreach($item_list as $key => $item):
                ?>
                <tr>
                  <td><?php echo $item['m_description'] ?></td>
                  <td><?php echo $item['m_size'] ?></td>
                  <td><?php echo $item['m_uom'] ?></td>
                  <td><?php echo $item['m_qty'] ?></td>
                  <td><?php echo $item['m_currency_symbol'] ?></td>
                  <td><?php echo number_format($item['m_expected_cost']) ?></td>
                  <td><?php echo date("D, d-M-Y",strtotime($item['m_ros'])) ?></td>
                  <td><?php echo $item['m_reason'] ?></td>
                  <td><?php echo $item['m_remark'] ?></td>
                  <td>
                    <?php if(isset($item['file'])): ?>
                    <?php foreach($item['file'] as $file): ?>
                      <a target="_blank" href="<?php echo base_url();?>upload/<?php echo $file ?>" class="btn  btn-dark"><i class="fa fa-file-<?php $array = explode('.', $file); echo(end($array) == 'pdf' ? 'pdf' : 'image'); ?>-o"></i></a>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-warning text-white" title="Edit" onclick="editmaterialmodal(this, '<?php echo $key ?>');"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger text-white" title="Delete" onclick="delmaterial(this, '<?php echo $key ?>');"><i class="fa fa-trash"></i></button>
                    <button type="button" class="btn btn-info  text-white" title="File Attachment" onClick="uplatc('<?php echo $key ?>')"><i class="fa fa-file"></i></button>
                  </td>
                </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="text-center mt-3">
          <?php if($req_list['status'] != 2){ ?>
          <button type="submit" class="btn btn-success " title="Submit" <?php echo (!isset($item) ? 'disabled' : '') ?>><i class="fa fa-save"></i> Save</button>
          <a href="<?php echo base_url();?>emr/req_list" class="btn btn-secondary " title="Submit"><i class="fa fa-close"></i> Cancel</a>
          <?php } else { ?>
            <button type="submit" class="btn btn-success " title="Submit" <?php echo (!isset($item) ? 'disabled' : '') ?>><i class="fa fa-save"></i> Submit</button>
            <a href="<?php echo base_url();?>emr/req_list_apr_reject/Draft" class="btn btn-secondary " title="Submit"><i class="fa fa-close"></i> Cancel</a>
          <?php } ?>
          
        </div>
      </div>
    </div>
  </div>
</form>
</div>

<!-- Modal -->
<div class="modal fade" id="add_material" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Item Description</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="m_description" placeholder="Description">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Size</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="m_size" placeholder="Size">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">UOM</label>
          <div class="col-sm-10">
            <select class="custom-select" name="m_uom">
              <option value="PCS">PCS</option>
              <option value="KG">KG</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">QTY</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="m_qty" value="0">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Currency</label>
          <div class="col-sm-10">
            <select class="custom-select" name="m_currency_symbol">
              <option value="SGD">SGD</option>
              <option value="USD">USD</option>
              <option value="IDR">IDR</option>
              <option value="EUR">EUR</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Expected Unit Cost</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="m_expected_cost" placeholder="Expected Cost" value="0">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Required On-site Date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="m_ros" placeholder="ROS"></input>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Reasons</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="m_reason" placeholder="Reason"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Remarks</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="m_remark" placeholder="Remark"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onClick="addmaterial();">Add New</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_material" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Item Description</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="e_m_description" placeholder="Description">
            <input type="hidden" class="form-control" name="e_m_key" placeholder="Description">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Size</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="e_m_size" placeholder="Size">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">UOM</label>
          <div class="col-sm-10">
            <select class="custom-select" name="e_m_uom">
              <option value="PCS">PCS</option>
              <option value="KG">KG</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">QTY</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="e_m_qty" value="0">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Currency</label>
          <div class="col-sm-10">
            <select class="custom-select" name="e_m_currency_symbol">
              <option value="SGD">SGD</option>
              <option value="USD">USD</option>
              <option value="IDR">IDR</option>
              <option value="EUR">EUR</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Expected Unit Cost</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="e_m_expected_cost" placeholder="Expected Cost" value="0">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Required On-site Date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="e_m_ros" placeholder="ROS"></input>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Reasons</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="e_m_reason" placeholder="Reason"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Remarks</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="e_m_remark" placeholder="Remark"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onClick="editmaterial();">Edit Material</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upl_material" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url(); ?>emr/import_add_material_temp" enctype="multipart/form-data">
        <input type='hidden' name='cat_mr' value='<?php echo $cat_mr; ?>'>
      <div class="modal-body">
        <div class="alert alert-danger font-weight-bold mb-0" role="alert">
          <i class="fa fa-warning "></i> You're change will not be saved!
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Template Excel</label>
          <div class="col-sm-10 col-form-label">
            <a href="<?php echo base_url(); ?>/file/template_material_request.xlsx">template_material_request.xlsx</a>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Upload</label>
          <div class="col-sm-10">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="file" onChange="$('.custom-file-label').html($(this).val())">
              <label class="custom-file-label">Choose file</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" onClick="addmaterial();">Add New</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upl_atc" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Attachment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url();?>emr/upl_material_temp/req_edit/<?php echo $req_list['request_no'] ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="alert alert-danger font-weight-bold mb-3" role="alert">
            <i class="fa fa-warning "></i> Just for PDF, JPG, PNG AND GIF | Max size file is 2MB
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Upload</label>
            <div class="col-sm-10">
              <div class="custom-file">
                <input name="file" type="file" class="custom-file-input" onChange="$('.custom-file-label').html($(this).val())">
                <input name="file_index" type="hidden">
                <label class="custom-file-label">Choose file</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal loading -->
<div class="modal fade" id="loading" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Loading</h5>
      </div>
      <form action="<?php echo base_url();?>emr/upl_material_temp" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="text-center">LOADING, PLEASE WAIT!</h1>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function editmaterialmodal(row, key){
    row = jQuery(row).closest('tr');
    var values, columns = row.find('td');

    var mon_name = columns[6].innerHTML.slice(8, 11);
    var month = new Date(Date.parse(mon_name +" 1, 2012")).getMonth()+1;
    month = ('0'+month).slice(-2);
    var tgl = columns[6].innerHTML.slice(12)+'-'+month+'-'+columns[6].innerHTML.slice(5,7);
    
    $('input[name=e_m_key]').val(key);
    $('input[name=e_m_description]').val(columns[0].innerHTML);
    $('input[name=e_m_size]').val(columns[1].innerHTML);
    $('input[name=e_m_qty]').val(columns[3].innerHTML);
    $('input[name=e_m_expected_cost]').val(columns[5].innerHTML.replace(",",""));
    $('input[name=e_m_ros]').val(tgl);
    $('textarea[name=e_m_remark]').val(columns[8].innerHTML);
    $('textarea[name=e_m_reason]').val(columns[7].innerHTML);
    $('#edit_material').modal('show');
  }

  function editmaterial(){
    $('input[name=e_m_description]').val() == '' ? $('input[name=e_m_description]').addClass("is-invalid") : $('input[name=e_m_description]').removeClass("is-invalid");
    $('textarea[name=e_m_reason]').val() == '' ? $('textarea[name=e_m_reason]').addClass("is-invalid") : $('textarea[name=e_m_reason]').removeClass("is-invalid");
    $('input[name=e_m_qty]').val() == '0' ? $('input[name=e_m_qty]').addClass("is-invalid") : $('input[name=e_m_qty]').removeClass("is-invalid");
    $('input[name=e_m_expected_cost]').val() == '0' ? $('input[name=e_m_expected_cost]').addClass("is-invalid") : $('input[name=e_m_expected_cost]').removeClass("is-invalid");
    // $('input[name=m_ros]').val() == '' ? $('input[name=m_ros]').addClass("is-invalid") : $('input[name=m_ros]').removeClass("is-invalid");

    if ($('.is-invalid').length) {
      return;
    }

    $.ajax({
      url: "<?php echo base_url();?>emr/edit_material_temp",
      type: "post",
      data: {
        m_key: $('input[name=e_m_key]').val(),
        m_description: $('input[name=e_m_description]').val(),
        m_size: $('input[name=e_m_size]').val(),
        m_uom: $('select[name=e_m_uom]').val(),
        m_qty: $('input[name=e_m_qty]').val(),
        m_currency_symbol: $('select[name=e_m_currency_symbol]').val(),
        m_expected_cost: $('input[name=e_m_expected_cost]').val(),
        m_ros: $('input[name=e_m_ros]').val(),
        m_reason: $('textarea[name=e_m_reason]').val(),
        m_remark: $('textarea[name=e_m_remark]').val()
      },
      success: function(data) {
        location.reload();
      }
    });
  }
</script>