<div id="content" class="container-fluid">
  <div class="row">

    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <!-- <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6> -->
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <div id="chartContainer_drafter" style="height: 370px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <!-- <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6> -->
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <div id="chartContainer_checker" style="height: 370px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  window.onload = function () {

  var chart = new CanvasJS.Chart("chartContainer_drafter", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
      text: "Productivity Drafter"
    },
    axisY: {
      title: "Man Hours"
    },
    data: [{        
      type: "column",  
      showInLegend: true, 
      legendMarkerColor: "grey",
      legendText: "Date",
      dataPoints: [   
        <?php for($i = 0; $i <= 7; $i++): ?>   
        { y: <?php echo(rand(30,45)); ?>, label: "<?php echo date("d-m-Y", strtotime("-".$i." days")) ?>" },
        <?php endfor; ?>
      ]
    }]
  });
  chart.render();

  var chart = new CanvasJS.Chart("chartContainer_checker", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
      text: "Productivity Checker"
    },
    axisY: {
      title: "Man Hours"
    },
    data: [{        
      type: "column",  
      showInLegend: true, 
      legendMarkerColor: "grey",
      legendText: "Date",
      dataPoints: [   
        <?php for($i = 0; $i <= 7; $i++): ?>   
        { y: <?php echo(rand(20,35)); ?>, label: "<?php echo date("d-m-Y", strtotime("-".$i." days")) ?>" },
        <?php endfor; ?>
      ]
    }]
  });
  chart.render();

  }
</script>