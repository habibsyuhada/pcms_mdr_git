<style>
  input.form-control, select.form-control {
     width:500px !important;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
</style>
<div class="container-fluid medium" style="min-height: 79vh">

<form method="GET" action="<?php echo base_url();?>emr/report_process">
  <div class="row">

    <div class="col-lg-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">From</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="date_from" placeholder="Name" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">To</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="date_to" placeholder="Name" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                <select name="status" class="form-control">
                  <option value="In-Progress">In-Progress</option>
                  <option value="Approved">Approved</option>
                  <option value="Rejected">Rejected</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Cost Centre / Job Cost</label>
              <div class="col-sm-9">
                <select class="custom-select form-control" name="id_cost" onChange="set_session_emr_data('id_cost', this)">
                 
                     <option value="All">All Data</option>
                 
                  <?php 
                    if($this->session->userdata('id_cost_emr_data') !== NULL){
                      $id_cost = $this->session->userdata('id_cost_emr_data');
                    }
                    else{
                      $id_cost = '';
                    }
                    foreach($cost_list as $cost):
                  ?>

                  <?php if($read_cookies[7] != 1 AND $read_cookies[4] != 11  AND $read_cookies[4] != 21 AND $read_cookies[4] != 5){ ?>

                    <?php if($read_cookies[7] == '3'){ ?>

                      <?php if($read_cookies[0] == $cost['cost_hod']){ ?>

                            <option value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>           

                      <?php } ?>

                    <?php } else if($read_cookies[7] == '4'){ ?>
                     
                       <?php if($read_cookies[0] == $cost['cost_spv']){ ?>

                            <option value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>           

                      <?php } ?>

                    <?php } else { ?>  

                      <?php if($read_cookies[4] == $cost['group_department']){ ?>

                            <option value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>           

                      <?php } ?>

                    <?php } ?>  


                  <?php } else { ?>

                  
                     <option value="<?php echo $cost['id_cost'] ?>" <?php echo ($id_cost == $cost['id_cost'] ? 'selected' : ''); ?>><?php echo $cost['cost_code'] ?> - <?php echo $cost['cost_dept'] ?></option>

                  <?php } ?>


                  <?php endforeach; ?>


                  
                </select>
              </div>
            </div>
            
            <div class="text-right mt-3">
              <button type="submit" class="btn btn-success btn-sm btn-flat" title="Submit"><i class="fa fa-check"></i> Submit</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="row">

  <div class="col-lg-12">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
      <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
        <div class="container-fluid">

          <table class="table dataTable table-hover table-bordered text-center">
            <thead>
             <tr>
                  <th>MR Number</th>
                  <th>Name</th>
                  <th>Request Date</th>
                  <th>Request On Site Date</th>
                  <th>MR Status</th>
                  <th>Approval Status</th>
                  <th>Comments</th>
                  <th>Options</th>
                 
                </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>