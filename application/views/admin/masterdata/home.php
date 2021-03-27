<?php
  if(isset($req_count_status_cat['cost_centre'])){
    $cs_pro = $req_count_status_cat['cost_centre']['In-Progress'];
    $cs_app = $req_count_status_cat['cost_centre']['Approved'];
    $cs_rej = $req_count_status_cat['cost_centre']['Rejected'];
  }
  else{
    $cs_pro = 0;
    $cs_app = 0;
    $cs_rej = 0;
  }
  if(isset($req_count_status_cat['job_cost'])){
    $jc_pro = $req_count_status_cat['job_cost']['In-Progress'];
    $jc_app = $req_count_status_cat['job_cost']['Approved'];
    $jc_rej = $req_count_status_cat['job_cost']['Rejected'];
  }
  else{
    $jc_pro = 0;
    $jc_app = 0;
    $jc_rej = 0;
  }
  $jc_tot = $jc_rej+$jc_app+$jc_pro;
  $cs_tot = $cs_rej+$cs_app+$cs_pro;
?>
<div class="container-fluid medium" style="min-height: 79vh">

  <div class="row text-white text-center">

    <div class="col-md-3">
      <div class="my-3 p-3 bg-yellow rounded shadow-sm">
        <h6 class="pb-2 mb-0">In-Progress Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php echo $req_count_status['In-Progress']+0 ?></h1>
          </div>
        </div>
        <small>
          <a href="<?php echo base_url(); ?>emr/req_list" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>

    <div class="col-md-3">
      <div class="my-3 p-3 bg-success rounded shadow-sm">
        <h6 class="pb-2 mb-0">Approved Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php echo $req_count_status['Approved']+0 ?></h1>
          </div>
        </div>
        <small>
          <a href="<?php echo base_url(); ?>emr/req_list_apr_reject/Approved" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>

    <div class="col-md-3">
      <div class="my-3 p-3 bg-danger rounded shadow-sm">
        <h6 class="pb-2 mb-0">Rejected Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php echo $req_count_status['Rejected']+0 ?></h1>
          </div>
        </div>
        <small>
          <a href="<?php echo base_url(); ?>emr/req_list_apr_reject/Rejected" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>

    <div class="col-md-3">
      <div class="my-3 p-3 bg-aqua rounded shadow-sm">
        <h6 class="pb-2 mb-0">Total Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php echo $req_count_status['In-Progress']+$req_count_status['Approved']+$req_count_status['Rejected'] ?></h1>
          </div>
        </div>
        <small>
          <a href="#" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Material Request This Month</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover" cellpadding="10">
              <thead>
                <tr class="bg-primary">
                  <th width="85%">Job Cost</th>
                  <th width="15%">Qty</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>In-Progress</td>
                  <td><?php echo $jc_pro ?></td>
                </tr>
                <tr>
                  <td>Approved</td>
                  <td><?php echo $jc_app ?></td>
                </tr>
                <tr>
                  <td>Rejected</td>
                  <td><?php echo $jc_rej ?></td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td><?php echo $jc_tot ?></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-hover" cellpadding="10">
              <thead>
                <tr class="bg-aqua">
                  <th width="85%">Cost Centre</th>
                  <th width="15%">Qty</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>In-Progress</td>
                  <td><?php echo $cs_pro ?></td>
                </tr>
                <tr>
                  <td>Approved</td>
                  <td><?php echo $cs_app ?></td>
                </tr>
                <tr>
                  <td>Rejected</td>
                  <td><?php echo $cs_rej ?></td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td><?php echo $cs_tot ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Approved Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <span id="chart-home" style="color: #ccceee"><i class="fa fa-spinner fa-spin"></i> <i>loading...</i></span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<script src="<?php echo base_url();?>assets/fusionchart/data/home.js""></script>