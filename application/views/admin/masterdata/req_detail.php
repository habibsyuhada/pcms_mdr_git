<div class="container-fluid medium" style="min-height: 79vh">

<form method="POST" action="<?php echo base_url();?>emr/req_edit_process">
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
              <?php 
                $req_list = $req_list[0] ;
                $request_by = $request_by[0] ;
               ?>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Requestor</label>
                <div class="col-sm-10">
                  <input type="hidden" name="request_no" value="<?php echo $req_list['request_no'] ?>" required>
                  <input type="text" class="form-control search_name_badge" name="name" placeholder="Name" value="<?php echo $request_by['full_name'] ?>" required readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Request Date</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="date" value="<?php echo date('d-M-Y H:i:s', strtotime($req_list['request_date'])); ?>" required readonly>
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

                 <!--  <select class="custom-select" name="project">
                    <?php //foreach($cost_list as $cost): ?>
                    <option value="<?php //echo $cost['id_cost'] ?>" <?php //echo ($req_list['project_id'] == $cost['id_cost'] ? 'selected' : ''); ?>><?php //echo $cost['cost_dept'] ?></option>
                    <?php //endforeach; ?>
                  </select> -->
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
                  <th colspan='2'>Expected Unit Cost</th>
                  <th>Required On-site Date</th>
                  <th>Reasons</th>
                  <th>Remarks</th>
                  <th>Attachment</th>
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
                  <td><?php echo date("d-M-Y",strtotime($item['m_ros'])) ?></td>
                  <td><?php echo $item['m_reason'] ?></td>
                  <td><?php echo $item['m_remark'] ?></td>
                  <td>
                    <?php if(isset($item['file'])): ?>
                    <?php foreach($item['file'] as $file): ?>
                      <a target="_blank" href="<?php echo base_url_ftp();?>upload/<?php echo $file ?>" class="btn btn-sm btn-flat btn-dark"><i class="fa fa-file-<?php $array = explode('.', $file); echo(end($array) == 'pdf' ? 'pdf' : 'image'); ?>-o"></i></a>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="text-center mt-3">
          <a href="<?php echo base_url();?>emr/req_list" class="btn btn-secondary btn-sm btn-flat" title="Submit"><i class="fa fa-close"></i> Close</a>
        </div>
      </div>
    </div>
  </div>
</form>
</div>