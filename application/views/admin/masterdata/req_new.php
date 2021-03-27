<link rel="stylesheet" href="<?php echo base_url('assets/dist_zebra_date_picker/css/default/zebra_datepicker.min.css') ?>" type="text/css">
<!-- <style>
  input.form-control, select.form-control {
     width:500px !important;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}

</style> -->

<?php 
  $a = 0;
  $b = 0;
  foreach($cost_list as $cost_count){

    
    
    if($read_cookies[4] == $cost_count['group_department']){

      //echo $cost_count['cost_category']."-".$cost_count['group_department'];

      $links = $cost_count['cost_category'];
     
      if($links == 'cost_centre'){
        $a++;
        //echo $cost_count['cost_category'];
      } 
      else {
        $b++;
        //echo $cost_count['cost_category'];
      } 
 }

} 

//echo $a."-".$b;
?>

<div class="container-fluid medium" style="min-height: 79vh">
<form method="POST" action="<?php echo base_url();?>emr/req_new_process">
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Requestor</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $cookie[1] ?>" readonly required>
                  <?php
                    $id_cost_cat = $this->session->userdata('cost_cat_emr_data');
                  ?>
                  
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Category MR</label>
                <div class="col-sm-10">
                  <select class="custom-select form-control" name="cost_cat" id="cost_cat">
                      <?php if($cat_mr == ''){ ?>

                        <option value=''>~ Choices ~</option>
                        <?php if($a > 0){ ?>
                          <option value='cost_centre'>Cost Centre</option>
                        <?php } else if($b > 0){ ?>
                          <option value='job_cost'>Job Cost</option>
                        <?php } ?>
                      <?php } else { ?>
                        
                        <option value='<?php echo $cat_mr ?>'>
                          <?php if($cat_mr == "job_cost"){ echo "Job Cost"; } else { echo "Cost Centre"; }  ?>
                        </option>
                        
                        <?php if($cat_mr == "job_cost"){ ?>
                          <?php if($a > 0){ ?>
                          <option value='cost_centre'>Cost Centre</option>
                           <?php } ?>
                        <?php } else { ?>
                          <?php if($b > 0){ ?>
                            <option value='job_cost'>Job Cost</option>
                          <?php } ?>
                        <?php } ?>
                        <option value=''>~ Cancel ~</option>

                      <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Request Date</label>
                <div class="col-sm-10" style="padding-right: 30px!important">
                  
                  <input type="text" class="form-control" data-zdp_readonly_element="false" name="date" value="<?php echo ( $this->session->userdata('date_emr_data') !== NULL ? urldecode($this->session->userdata('date_emr_data')) : date('Y-m-d H:i:s')); ?>"  id='date_picker'>

                  </script>
                </div>
              </div>

              <?php if($cat_mr != ''){ ?>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cost Centre / Job Cost</label>
                <div class="col-sm-10">
                  <select class="custom-select form-control" name="id_cost">
                    <?php 
                     
                      if($this->session->userdata('id_cost_emr_data') !== NULL){

                        $id_cost = $this->session->userdata('id_cost_emr_data');

                      } else {

                        $id_cost = '';

                      }

                      foreach($cost_list as $cost){

                    ?>

                    <?php if($read_cookies[4] == $cost['group_department']){ ?>

                        <?php if($cost['cost_category'] == $cat_mr){ ?>
                          
                          <option data-cat="<?php echo $cost['cost_category'] ?>" value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>

                        <?php }  ?>

                     <?php } ?>

                 

                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php if($cat_mr != ''){ ?>

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
                  <th>
                    <a class="btn btn-primary  text-white" title="Add" data-toggle="modal" href="#add_material">
                      <i class="fa fa-plus"></i>
                    </a>
                    <a class="btn btn-info  text-white" title="Add" data-toggle="modal" href="#upl_material">
                      <i class="fa fa-upload"></i>
                    </a>
                    <button class="btn btn-danger  text-white" title="Reset" type="button" onClick="resetmaterial('req_new','<?php echo $cat_mr; ?>')">
                      <i class="fa fa-close"></i>
                    </buttton>
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
                    <?php foreach($item['file'] as $file): ?>
                      <a target="_blank" href="<?php echo base_url();?>base_url_ftp/<?php echo $file ?>" class="btn  btn-dark"><i class="fa fa-file-<?php $array = explode('.', $file); echo(end($array) == 'pdf' ? 'pdf' : 'image'); ?>-o"></i></a>
                    <?php endforeach; ?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger  text-white" title="Delete" onclick="delmaterial(this, '<?php echo $key ?>','<?php echo $cat_mr ?>');"><i class="fa fa-trash"></i></button>

                    <button type="button" class="btn btn-info  text-white" title="File Attachment" onClick="uplatc('<?php echo $key ?>')"><i class="fa fa-file"></i></button>
                  </td>
                </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="text-center mt-3">
          <button type="submit" name='draft' id='draftBtn' value='draft' class="btn btn-primary " title="Submit" <?php echo (!isset($item) ? 'disabled' : '') ?>><i class="fa fa-plus"></i> Draft</button>
          <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit" <?php echo (!isset($item) ? 'disabled' : '') ?>><i class="fa fa-check"></i> Submit</button>
          <a href="<?php echo base_url();?>emr/req_list" class="btn btn-secondary " title="Submit"><i class="fa fa-close"></i> Cancel</a>
        </div>
      </div>
    </div>
  </div>
</form>
</div>

<?php } ?>


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
      <form action="<?php echo base_url();?>emr/upl_material_temp/req_new/<?php echo $cat_mr ?>" method="POST" enctype="multipart/form-data">
         
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

<script>
$('#cost_cat').change(function() {
  // set the window's location property to the value of the option the user has selected
  window.location = "<?php echo base_url();?>emr/req_new/"+$(this).val();
});
</script>

<script src="<?php echo base_url('assets/dist_zebra_date_picker/zebra_datepicker.min.js') ?>"></script>
<script type="text/javascript">
    $('#date_picker').Zebra_DatePicker({
      format: 'Y-m-d H:i:s',
      onSelect: function(dateText) {
        
       set_session_emr_data('date', this);

        }
    });

     $('#time_picker').Zebra_DatePicker({
        format: 'H:i:s'
    });
</script>

<?php if(isset($item)){ ?>

<script>

setTimeout(function() { submitform(); }, 1200000)
function submitform()
{
  //alert('draft Submit!');
  document.getElementById('draftBtn').click();
}

</script>

<?php } ?>