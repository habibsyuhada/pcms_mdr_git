<div id="content" class="container-fluid">
  <?php if($this->permission_eng_act[1] == "1"){ ?>
  <h4>Monitoring Status Activity </h4>
  <hr/>
    <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
      <div class="container-fluid">
         <div id="container_charts" style="height: 370px; width: 100%;"></div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3">
         <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Drafter Status Activity</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
               <div class="container-fluid">
                  <table class="table table-hover">
                    <thead>
                      <tr class="bg bg-aqua" style="color: white">
                        <th>Desc</th>
                        <th>Activity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Open</td>
                        <td><span class='drafter_open'></span></td>
                      </tr>
                      <tr>
                        <td>In Progress</td>
                        <td><span class='drafter_inprogress'></span></td>
                      </tr>
                      <tr>
                        <td>Completed</td>
                        <td><span class='drafter_completed'></span></td>
                      </tr>
                    </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Checker Status Activity</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
               <div class="container-fluid">
                  <table class="table table-hover">
                    <thead>
                      <tr class="bg bg-dark" style="color: white">
                        <th>Desc</th>
                        <th>Activity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Open</td>
                        <td><span class='checker_open'></span></td>
                      </tr>
                      <tr>
                        <td>In Progress</td>
                       <td><span class='checker_inprogress'></span></td>
                      </tr>
                      
                      <tr>
                        <td>Completed</td>
                       <td><span class='checker_completed'></span></td>
                      </tr>
                    </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Engineering Status Activity</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
               <div class="container-fluid">
                  <table class="table table-hover">
                    <thead>
                      <tr class="bg bg-yellow" style="color: white">
                        <th>Desc</th>
                        <th>Activity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Open</td>
                        <td><span class='engineer_open'></span></td>
                      </tr>
                      <tr>
                        <td>In Progress</td>
                        <td><span class='engineer_inprogress'></span></td>
                      </tr>
                     
                      <tr>
                        <td>Completed</td>
                        <td><span class='engineer_completed'></span></td>
                      </tr>
                    </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Modeler Status Activity</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
               <div class="container-fluid">
                  <table class="table table-hover">
                    <thead>
                      <tr class="bg bg-success" style="color: white">
                        <th>Desc</th>
                        <th>Activity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Open</td>
                         <td><span class='modeler_open'></span></td>
                      </tr>
                      <tr>
                        <td>In Progress</td>
                        <td><span class='modeler_inprogress'></span></td>
                      </tr>
                     
                      <tr>
                        <td>Completed</td>
                        <td><span class='modeler_completed'></span></td>
                      </tr>
                    </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
 <?php } ?>
   <div class="row">
     <div class="col-md-12">
         <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Engineering Status Activity</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
               <div class="container-fluid">
                  <table class="table table-hover">
                    <thead>
                      <tr class="bg bg-yellow" style="color: white">
                        <th>Project</th>
                        <th>Open</th>
                        <th>In Progress</th>
                        <th>Completed</th>
                        <th>Transmitted</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>AL-SHAHEEN GALLAF</td>
                        <td><span class='galaf_open'></span></td>
                        <td><span class='galaf_inprogress'></span></td>
                        <td><span class='galaf_completed'></span></td>
                        <td><span class='galaf_transmitted'></span></td>
                        <td><span class='galaf_total'></span></td>
                      </tr>
                      <tr>
                        <td>FORMOSA 2</td>
                        <td><span class='formosa2_open'></span></td>
                        <td><span class='formosa2_inprogress'></span></td>
                        <td><span class='formosa2_completed'></span></td>
                        <td><span class='formosa2_transmitted'></span></td>
                        <td><span class='formosa2_total'></span></td>
                      </tr>
                      <tr>
                        <td>Hornsea 2 Jacket</td>
                        <td><span class='hs_jacket_2_open'></span></td>
                        <td><span class='hs_jacket_2_inprogress'></span></td>
                        <td><span class='hs_jacket_2_completed'></span></td>
                        <td><span class='hs_jacket_2_transmitted'></span></td>
                        <td><span class='hs_jacket_2_total'></span></td>
                      </tr>
                      <tr>
                        <td>Hornsea 2 Topside</td>
                        <td><span class='hs_topside_2_open'></span></td>
                        <td><span class='hs_topside_2_inprogress'></span></td>
                        <td><span class='hs_topside_2_completed'></span></td>
                        <td><span class='hs_topside_2_transmitted'></span></td>
                        <td><span class='hs_topside_2_total'></span></td>
                      </tr>
                      <tr>
                        <td>Tangguh Pack-B</td>
                        <td><span class='tangguh_pack_b_open'></span></td>
                        <td><span class='tangguh_pack_b_inprogress'></span></td>
                        <td><span class='tangguh_pack_b_completed'></span></td>
                        <td><span class='tangguh_pack_b_transmitted'></span></td>
                        <td><span class='tangguh_pack_b_total'></span></td>
                      </tr>
                      
                    </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
  <?php if($this->user_cookie[0] == 2){
  // Under Construction
  ?>
  <div class="row">
    <div class="col-md-6">
       <h4>Drafter Statistic</h4>
       <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">Drafter List</h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
             <div class="container-fluid">
                <table class="table table-hover">
                   <thead>
                      <tr class="bg bg-success" style="color: white">
                         <th>Drafter</th>
                         <th>Open</th>
                         <th>Submit</th>
                      </tr>
                   </thead>
                   <tbody>
                    <?php foreach ($recent as $row) { 
                      ?>
                      <tr>
                       
                         <td><?php 
                            foreach ($user as $key) { 
                         if($row['id_user'] == $key['id_user']){
                          ?>
                             <a href="<?php echo site_url();?>drafter/performance/<?php echo strtr($this->encryption->encrypt($key['id_user']), '+=/', '.-~'); ?>"><span class=""><?php echo $key['full_name'];  ?></span></a>
                          <?php }
                         }
                          ?> </td>                    
                         <td></td>
                         <td></td>
                      </tr>
                    <?php } ?>
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-6">
       <h4>Checker Statistic</h4>
       <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">Checker List</h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
             <div class="container-fluid">
                <table class="table table-hover">
                   <thead>
                      <tr class="bg bg-aqua" style="color: white">
                         <th>Checker</th>
                         <th>Open</th>
                         <th>Submit</th>
                      </tr>
                   </thead>
                   <tbody>
                    <?php foreach ($checker as $row) { 
                      ?>
                      <tr>
                       
                         <td><?php 
                            foreach ($user as $key) { 
                         if($row['id_user'] == $key['id_user']){
                          ?>
                             <a href="<?php echo site_url();?>drafter/performance/<?php echo strtr($this->encryption->encrypt($key['id_user']), '+=/', '.-~'); ?>"><span class=""><?php echo $key['full_name'];  ?></span></a>
                          <?php }
                         }
                          ?> </td>                    
                         <td></td>
                         <td></td>
                      </tr>
                    <?php } ?>
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
 
  </div>
  <?php } ?>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->


<script>          
  var fnc=function(){
    $(".drafter_open").load("<?php echo base_url().'home/data_count/drafter_open'; ?>");
    $(".drafter_completed").load("<?php echo base_url().'home/data_count/drafter_completed'; ?>");
    $(".drafter_inprogress").load("<?php echo base_url().'home/data_count/drafter_inprogress'; ?>");
    
    $(".checker_inprogress").load("<?php echo base_url().'home/data_count/checker_inprogress'; ?>");
    $(".checker_open").load("<?php echo base_url().'home/data_count/checker_open'; ?>");
    $(".checker_completed").load("<?php echo base_url().'home/data_count/checker_completed'; ?>");
   
    $(".engineer_inprogress").load("<?php echo base_url().'home/data_count/engineer_inprogress'; ?>");
    $(".engineer_open").load("<?php echo base_url().'home/data_count/engineer_open'; ?>");
    $(".engineer_completed").load("<?php echo base_url().'home/data_count/engineer_completed'; ?>");

    $(".modeler_inprogress").load("<?php echo base_url().'home/data_count/modeler_inprogress'; ?>");
    $(".modeler_open").load("<?php echo base_url().'home/data_count/modeler_open'; ?>");
    $(".modeler_completed").load("<?php echo base_url().'home/data_count/modeler_completed'; ?>");

    $(".galaf_open").load("<?php echo base_url().'home/data_count/Open/7'; ?>");
    $(".galaf_inprogress").load("<?php echo base_url().'home/data_count/In-Progress/7'; ?>");
    $(".galaf_completed").load("<?php echo base_url().'home/data_count/Completed/7'; ?>");
    $(".galaf_transmitted").load("<?php echo base_url().'home/data_count/Transmitted/7'; ?>");
    $(".galaf_total").load("<?php echo base_url().'home/data_count/Total/7'; ?>");

    $(".formosa2_open").load("<?php echo base_url().'home/data_count/Open/8'; ?>");
    $(".formosa2_inprogress").load("<?php echo base_url().'home/data_count/In-Progress/8'; ?>");
    $(".formosa2_completed").load("<?php echo base_url().'home/data_count/Completed/8'; ?>");
    $(".formosa2_transmitted").load("<?php echo base_url().'home/data_count/Transmitted/8'; ?>");
    $(".formosa2_total").load("<?php echo base_url().'home/data_count/Total/8'; ?>");

    $(".hs_jacket_2_open").load("<?php echo base_url().'home/data_count/Open/6'; ?>");
    $(".hs_jacket_2_inprogress").load("<?php echo base_url().'home/data_count/In-Progress/6'; ?>");
    $(".hs_jacket_2_completed").load("<?php echo base_url().'home/data_count/Completed/6'; ?>");
    $(".hs_jacket_2_transmitted").load("<?php echo base_url().'home/data_count/Transmitted/6'; ?>");
    $(".hs_jacket_2_total").load("<?php echo base_url().'home/data_count/Total/6'; ?>");

    $(".hs_topside_2_open").load("<?php echo base_url().'home/data_count/Open/4'; ?>");
    $(".hs_topside_2_inprogress").load("<?php echo base_url().'home/data_count/In-Progress/4'; ?>");
    $(".hs_topside_2_completed").load("<?php echo base_url().'home/data_count/Completed/4'; ?>");
    $(".hs_topside_2_transmitted").load("<?php echo base_url().'home/data_count/Transmitted/4'; ?>");
    $(".hs_topside_2_total").load("<?php echo base_url().'home/data_count/Total/4'; ?>");

    $(".tangguh_pack_b_open").load("<?php echo base_url().'home/data_count/Open/1'; ?>");
    $(".tangguh_pack_b_inprogress").load("<?php echo base_url().'home/data_count/In-Progress/1'; ?>");
    $(".tangguh_pack_b_completed").load("<?php echo base_url().'home/data_count/Completed/1'; ?>");
    $(".tangguh_pack_b_transmitted").load("<?php echo base_url().'home/data_count/Transmitted/1'; ?>");
    $(".tangguh_pack_b_total").load("<?php echo base_url().'home/data_count/Total/1'; ?>");
                  
    setTimeout(fnc, 10000);
  };

 $(document).ready(function(){
    fnc();
    load_data_chart();
    console.log(Date.UTC(2019, 12, 9));
  });
</script>
<script>
  var last_json;
  var load_data_chart=function(){
    $.ajax({
      url: '<?php echo base_url() ?>home/get_data_weekly',
      type: 'GET',
      async: true,
      dataType: "json",
      success: function (data) {
        if(JSON.stringify(last_json) != JSON.stringify(data)){
          draw_highchart(data);
          last_json = data;
          console.log('last_json = '+last_json);
        }
        console.log('data = '+data);
        setTimeout(load_data_chart, 10000);
      }
    });    
  };

  function draw_highchart(data) {
    Highcharts.chart('container_charts', {
      title: {
        text: 'Engineering Activity'
      }, 
      subtitle: {
         text: 'Weekly Report'
      }, 
      yAxis: {
        title: {
          text: 'Documents'
        },
        min: 0
      },
      xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
          hour: ' ',
          month: '%e %b',
          year: '%b'
        },
        title: {
          text: 'Date'
        }
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
      },
   
      plotOptions: {
        series: {
          marker: {
            enabled: true
          }
        }
      },
   
      series: data,
   
      responsive: {
        rules: [{
          condition: {
            maxWidth: 500
          },
          chartOptions: {
            plotOptions: {
              series: {
                marker: {
                  radius: 2.5
                }
              }
            }
          }
        }]
      }
   
    });
  }
</script>