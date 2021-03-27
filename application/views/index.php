<?php $this->load->view('_partial/header');?>
<?php $this->load->view('_partial/top');?>  
<?php 
	if(isset($sidebar)){
		$this->load->view($sidebar);
	}
?>  
<?php $this->load->view($subview);?>
<?php $this->load->view('_partial/footer');?>