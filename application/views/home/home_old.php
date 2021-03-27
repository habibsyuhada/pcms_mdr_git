<?php
  // preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B);
  // echo $B[0];
  // echo stripos($B[0], 'MSIE');
print_r($req_count_status_cat) ;

if($read_cookies[4] != 11){

  //print_r($req_count_status_cat) ;

  if(isset($req_count_status_cat['cost_centre'])){
    $cs_pro = $req_count_status_cat['cost_centre']['In-Progress'];
    $cs_app = $req_count_status_cat['cost_centre']['Approved'];
    $cs_rej = $req_count_status_cat['cost_centre']['Rejected'];
    $cs_pen = $req_count_status_cat['cost_centre']['Pending'];
    $cs_com = $req_count_status_cat['cost_centre']['Completed'];
  }
  else{
    $cs_pro = 0;
    $cs_app = 0;
    $cs_rej = 0;
    $cs_pen = 0;
    $cs_com = 0;
  }

  if(isset($req_count_status_cat['job_cost'])){
    $jc_pro = $req_count_status_cat['job_cost']['In-Progress'];
    $jc_app = $req_count_status_cat['job_cost']['Approved'];
    $jc_rej = $req_count_status_cat['job_cost']['Rejected'];
    $jc_pen = $req_count_status_cat['job_cost']['Pending'];
    $jc_com = $req_count_status_cat['job_cost']['Completed'];
  }
  else{
    $jc_pro = 0;
    $jc_app = 0;
    $jc_rej = 0;
    $jc_pen = 0;
    $jc_com = 0;
  }
  $jc_tot = $jc_rej+$jc_app+$jc_pro+$jc_com;
  $cs_tot = $cs_rej+$cs_app+$cs_pro+$cs_com;

} else {

  //print_r($req_count_status_cat_pending);

  if(isset($req_count_status_cat_pending['cost_centre'])){
      $cs_pen = $req_count_status_cat_pending['cost_centre']['Pending'];
  } else {
      $cs_pen = 0;
  }

  if(isset($req_count_status_cat_pending['job_cost'])){
      $jc_pen = $req_count_status_cat_pending['job_cost']['Pending'];
  } else {
      $jc_pen = 0;
  } 

  if(isset($req_count_status_cat['cost_centre'])){
    $cs_pro = $req_count_status_cat['cost_centre']['In-Progress'];
    $cs_app = $req_count_status_cat['cost_centre']['Approved'];
    $cs_rej = $req_count_status_cat['cost_centre']['Rejected'];
    $cs_com = $req_count_status_cat['cost_centre']['Completed'];
  }  else {
    $cs_pro = 0;
    $cs_app = 0;
    $cs_rej = 0;
    $cs_com = 0;
  }

  if(isset($req_count_status_cat['job_cost'])){
      $jc_pro = $req_count_status_cat['job_cost']['In-Progress'];
      $jc_app = $req_count_status_cat['job_cost']['Approved'];
      $jc_rej = $req_count_status_cat['job_cost']['Rejected'];
      $jc_com = $req_count_status_cat['job_cost']['Completed'];
  }  else {
    $jc_pro = 0;
    $jc_app = 0;
    $jc_rej = 0;
    $jc_com = 0;
  }

  $jc_tot = $jc_rej+$jc_app+$jc_pro+$jc_com;
  $cs_tot = $cs_rej+$cs_app+$cs_pro+$cs_com;

}

?>

<div class="container-fluid medium" style="min-height: 79vh">

  <div class="row text-white text-center">

    <?php if($read_permission[5] == '1'): ?>
    <div class="col-md">
      <div class="my-3 p-3 bg-aqua rounded shadow-sm">
        <h6 class="pb-2 mb-0">Pending Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php if($read_cookies[4] != 11){ echo $req_count_status['Pending']+0; } else { echo $req_count_status_pending['Pending']+0; }  ?></h1>
          </div>
        </div>
        <small>
          <a href="<?php echo base_url(); ?>emr/req_list_apr_reject/Pending" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>
    <?php endif; ?>

    <div class="col-md">
      <div class="my-3 p-3 bg-yellow rounded shadow-sm">
        <h6 class="pb-2 mb-0">In-Progress Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php echo $req_count_status['In-Progress']+0 ?></h1>
          </div>
        </div>
        <small>
          <a href="<?php echo base_url(); ?>emr/req_list_apr_reject/In-Progress" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>

    <div class="col-md">
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

    <div class="col-md">
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
    
    <div class="col-md">
      <div class="my-3 p-3 bg-primary rounded shadow-sm">
        <h6 class="pb-2 mb-0">Completed Material Request</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <h1 class="text-white"><?php echo $req_count_status['Completed']+0 ?></h1>
          </div>
        </div>
        <small>
          <a href="<?php echo base_url(); ?>emr/req_list_apr_reject/Completed" class="btn btn-block btn-sm text-white">More Information</a>
        </small>
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Material Requisition  Status <small>Current Month</small></h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover" cellpadding="10">
              <thead>
                <tr class="alert-primary">
                  <th>Job Cost</th>
                  <th width="15%">In-Progress</th>
                  <th width="15%">Approved</th>
                  <th width="15%">Rejected</th>
                  <th width="15%">Completed</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>In-Progress</td>
                  <td><?php echo $jc_pro ?></td>
                  <td><?php echo $jc_app ?></td>
                  <td><?php echo $jc_rej ?></td>
                  <td><?php echo $jc_com ?></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-hover" cellpadding="10">
              <thead>
                <tr class="alert-primary">
                  <th>Cost Centre</th>
                  <th width="15%">In-Progress</th>
                  <th width="15%">Approved</th>
                  <th width="15%">Rejected</th>
                  <th width="15%">Completed</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>In-Progress</td>
                  <td><?php echo $cs_pro ?></td>
                  <td><?php echo $cs_app ?></td>
                  <td><?php echo $cs_rej ?></td>
                  <td><?php echo $cs_com ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

     <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Material Requisition Status</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small" style="height: 450px">
          <div class="container-fluid">
            <div id="chart-home"></div>
         </div>
        </div>
      </div>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Material Requisition - Pending Approval Status</h6>        
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
          
          <div class="col-md">

              <div class="my-3 p-3 bg-primary rounded shadow-sm">
                <h3 class="pb-2 mb-0 text-light"><center>HOD</center></h3>        
                <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
                  <div class="container-fluid">
                    <h1 class="text-white">
                        <center>
                            <div id='count_pending_hod'></div>
                        </center>
                    </h1>
                  </div>
                </div>
                    <small>
                      <a href="<?php echo base_url();?>emr/req_list_apr_reject/In-Progress" class="btn btn-block btn-sm text-white">More Information</a>
                    </small>
              </div>

          </div>

          <div class="col-md">

              <div class="my-3 p-3 bg-primary rounded shadow-sm">
                <h3 class="pb-2 mb-0 text-light"><center>PM</center></h3>        
                <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
                  <div class="container-fluid">
                    <h1 class="text-white">
                        <center>
                             <div id='count_pending_pm'></div>
                        </center>
                    </h1>
                  </div>
                </div>
                    <small>
                      <a href="<?php echo base_url();?>emr/req_list_apr_reject/In-Progress" class="btn btn-block btn-sm text-white">More Information</a>
                    </small>
              </div>

          </div>

          <div class="col-md">

              <div class="my-3 p-3 bg-primary rounded shadow-sm">
                <h3 class="pb-2 mb-0 text-light"><center>CONTRACT</center></h3>        
                <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
                  <div class="container-fluid">
                    <h1 class="text-white">
                        <center>
                             <div id='count_pending_contract'></div>
                        </center>
                    </h1>
                  </div>
                </div>
                    <small>
                      <a href="<?php echo base_url();?>emr/req_list_apr_reject/In-Progress" class="btn btn-block btn-sm text-white">More Information</a>
                    </small>
              </div>

          </div>

          <div class="col-md">

              <div class="my-3 p-3 bg-primary rounded shadow-sm">
                <h3 class="pb-2 mb-0 text-light"><center>PD</center></h3>        
                <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray small">
                  <div class="container-fluid">
                    <h1 class="text-white">
                        <center>
                             <div id='count_pending_pd'></div>
                        </center>
                    </h1>
                  </div>
                </div>
                    <small>
                      <a href="<?php echo base_url();?>emr/req_list_apr_reject/In-Progress" class="btn btn-block btn-sm text-white">More Information</a>
                    </small>
              </div>

          </div>



          

        </div>
      </div>
    </div>


  </div>
</div>

<?php

  foreach ($chart['cost_centre'] as $key => $value) {
    $dataPoints1[] = array("y" => $value['y'], "label" => $value['label']);
  }

  foreach ($chart['job_cost'] as $key => $value) {
    $dataPoints2[] = array("y" => $value['y'], "label" => $value['label']);
  }
    
?>
<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chart-home", {

            animationEnabled: true,
            title: {
                text: ""
            },
            axisY: {
                title: "Summary MR",
                valueFormatString: "#0.#,."
            },
            data: [
            {
                type: "stackedColumn",
                legendText: "Cost Centre",
                // yValueFormatString: "#0.#,.",
                showInLegend: "true",
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }, {
                type: "stackedColumn",
                legendText: "Job Cost",
                showInLegend: "true",
                indexLabel: "#total MR",
                // yValueFormatString: "#0.#,.",
                // indexLabelFormatString: "#0.#,.",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>