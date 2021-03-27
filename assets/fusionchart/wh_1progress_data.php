<?php

	header('Content-Type: application/json');

	include '../../config.php';	
	$query = "SELECT * FROM v_dash_wh_progress WHERE plant NOT IN (SELECT plant FROM v_dash_wh_progress WHERE not_count = '0' AND counted = '0'
)";
	$result = sqlsrv_query($conn, $query); 

	//initialize the array to store the processed data
	$jsonArray = array();

	/*while($row=sqlsrv_fetch_array($result)) {
	    $jsonArrayItem = array();
	    $jsonArrayItem['label'] = $row['plant'];
	    $jsonArrayItem['value'] = $row['not_count'];
	    array_push($jsonArray, $jsonArrayItem);
  	}*/

  	if ($result) {        	
		$arrData = array(
        "chart" => array(
        	"caption"=> "Multi Series Chart",
        	"showValues"=> "0"
              	)
           	);

        	// creating array for categories object        	
        	$categoryArray=array();
        	$dataseries1=array();
        	$dataseries2=array();
        	// pushing category array values
        	while($row = sqlsrv_fetch_array($result)) {				
				array_push($categoryArray, array(
          		"label" => $row["plant"]
					)
				);
				array_push($dataseries1, array(					
          		"value" => $row["not_count"]
					) 
				);			
				array_push($dataseries2, array(
          		"value" => $row["counted"]
					)
				);
        	}
        	
        	$arrData["categories"]=array(array("category"=>$categoryArray));
			// creating dataset object
			$arrData["dataset"] = array(array("seriesName"=> "Bins Not Counted", "data"=>$dataseries1), array("seriesName"=> "Bins Counted", "data"=>$dataseries2));
		
            $jsonEncodedData = json_encode($arrData);            
            echo $jsonEncodedData;
        }
	// $conn->close();

	// echo json_encode($jsonArray);
?>
