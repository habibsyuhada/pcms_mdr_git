<?php

	$servername = "10.5.252.116";
	$username   = "admin_dev";
	$password   = "Abcd12345";
	$database   = "portal_database";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}


?>
	
	<script type="text/javascript" src="assets/jquery/jquery-3.4.1.min.js"></script>

    <!-- Datatable -->
    <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/datatables/jquery.dataTables.min.js"></script>

    <center>

    	<h1>Project Code</h1>

    <div style="width:700px;">

		<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="5px">No</th>
                    <th>Project Code</th>
                    <th>Project Name</th>
                                       
                  </tr>
                </thead>
                <tbody>
                  <?php

                   $no=1;	
                   $query = "SELECT * FROM portal_project WHERE status = '1'";
                   $query_view = mysqli_query($conn, $query);
                   $total_spec_category = mysqli_num_rows($query_view);
                   while($view = mysqli_fetch_array($query_view)){ 

                   ?>
                  <tr>
                    <td>
                      <?php echo $no; ?>                       
                    </td>
                    <td>
                      <center>
                        <input type="text" value="<?php echo $view["project_code"]; ?>" id="myInput<?php echo $no; ?>" readonly>
                        <button style='background-color: #ffffa3;' onclick="myFunction(<?php echo $no; ?>)">Copy Code</button>
                        </center> 
                    </td>
                    <td>
                     <?php echo $view["project_name"]; ?>               
                    </td>
                                
                  </tr>
                  <?php $no++; ?>
                  <?php } ?>

                </tbody>
    	</table>

	</div>

	</center>

<script>

function myFunction(f){

  <?php for($i=1;$i<=$total_spec_category;$i++){ ?>
    var no = "<?php echo $i; ?>";
    if(no == f){
      var copyText<?php echo $i; ?> = document.getElementById("myInput<?php echo $i; ?>");
      copyText<?php echo $i; ?>.select();
      copyText<?php echo $i; ?>.setSelectionRange(0, 99999)
      document.execCommand("copy");
      alert("Copied Code : " + copyText<?php echo $i; ?>.value +"\nPaste to excel material template file to import.");
    }
  <?php } ?>

}

 $('#dataTable').DataTable( {
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
</script>