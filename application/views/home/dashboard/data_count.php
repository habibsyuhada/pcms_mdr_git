<?php
if($module == 'drafter_open'){
	
	$total_open_drafter = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$drafter_open_data = $total_open_drafter - $total_inprogress;

	echo $drafter_open_data;

} else if($module == 'checker_open'){
	
	$total_open_checker = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$checker_open_data = $total_open_checker - $total_inprogress;

	echo $checker_open_data;	

} else if($module == 'engineer_open'){
	
	$total_open_engineer = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$engineer_open_data = $total_open_engineer - $total_inprogress;

	echo $engineer_open_data;	

} else if($module == 'modeler_open'){
	
	$total_open_modeler = $total[0]["total"];
	
	echo $total_open_modeler;	

} else if($module == 'galaf_open'){
	
	$total_open_galaf = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$galaf_open_data = $total_open_galaf - $total_inprogress;

	echo $galaf_open_data;	

} else if($module == 'formosa2_open'){
	
	$total_open_formosa2 = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$formosa2_open_data = $total_open_formosa2 - $total_inprogress;

	echo $formosa2_open_data;

} else if($module == 'hs_jacket_2_open'){
	
	$total_open_hs_jacket_2 = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$hs_jacket_2_open_data = $total_open_hs_jacket_2 - $total_inprogress;

	echo $hs_jacket_2_open_data;	

} else if($module == 'hs_topside_2_open'){
	
	$total_open_hs_topside_2 = $total[0]["total"];
	$total_inprogress 	= $total_inprogress[0]["total"];

	$hs_topside_2_open_data = $total_open_hs_topside_2 - $total_inprogress;

	echo $hs_topside_2_open_data;		

} else if($module == 'summary'){
	if(count($sum) > 0){
		$summary = $sum[0];
		if($column == 'Open'){
			echo $summary['Total']-($summary['Transmitted']+$summary['Completed']+$summary['In-Progress']);
		}
		else{
			echo $summary[$column];
		}		
	}
	else{
		echo '0';
	}
} else {
	print_r($total[0]["total"]);
}
?>