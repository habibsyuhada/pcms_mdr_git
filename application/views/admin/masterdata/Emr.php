<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emr extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$this->load->helper('browser');
		check_browser();

		$this->load->model('emr_mod');
		$this->load->model('general_mod');

	}

	public function index()
	{
		redirect('home/home');
	}

	
	public function cookie_get(){
		return $cookie = explode(";",$this->input->cookie('portal_user'));
	}

	public function cookie_get_permission(){
		return $cookie = explode(";",$this->input->cookie('portal_emr'));
	}

	public function home() {
		redirect('home/home');
	}

	public function form() {
		$data["read_cookies"] = $this->cookie_get();
		$data['meta_title'] = 'Form Page';
		$data['subview']= 'emr/masterdata/form';
		$this->load->view('emr/index', $data);
	}

	public function req_list() {

		$this->session->unset_userdata('material');
		$this->session->unset_userdata('addmaterial');
		
		$data["read_cookies"] 		= $this->cookie_get();
		$data["read_permission"] 	= $this->cookie_get_permission();

		$read_permission 	= $this->cookie_get_permission();
		$getScope_cookies 	= $read_permission[6];

		$read_cookies 	= $this->cookie_get();
		$get_DeptID 	= $read_cookies[4];
		$get_UserRole 	= $read_cookies[7];
		$get_UserID 	= $read_cookies[0];

		if($get_UserRole == '2'){

			$data['req_list']  = $this->emr_mod->req_list_db_PresDir();
			
		} else if($get_DeptID == '5'){

			$data['req_list']  			= $this->emr_mod->req_list_db_Contract();
			$data['req_list_Contract']  = $this->emr_mod->req_list_db_2($get_DeptID);

			//get user data
			$req_list_Contract = $data['req_list_Contract'];
			
			if($req_list_Contract){

				$where_in_Contract = array();
				$where_in_rejected = array();
					foreach ($req_list_Contract as $key => $value) {
						$where_in_Contract [] = $value['request_by'];
						$where_in_rejected [] = $value['rejected_by'];
					}
				
				$query_Contract = $this->general_mod->get_user($where_in_Contract);
				$user_Contract = array();
				foreach ($query_Contract as $key => $value) {
					$user_Contract[$value['id_user']] = $value;
				}
				$data['user_list_Contract'] = $user_Contract;


				$query_rejected = $this->general_mod->get_user($where_in_rejected);
				$user_rejected = array();
				foreach ($query_rejected as $key => $value) {
					$user_rejected[$value['id_user']] = $value;
				}
				$data['user_list_rejected'] = $user_rejected;

			}
		//get user data END

		} else {
			if($getScope_cookies == '1'){
				$data['req_list']  = $this->emr_mod->req_list_db_1();
			} else {
				if($get_UserRole == 3 OR $get_UserRole == 4){
					
					//echo $get_UserID;
					//return false;

					$get_DeptID = NULL;
					//$get_UserRole = NULL;
					$data['req_list']  = $this->emr_mod->req_list_db_2($get_DeptID,$get_UserID,$get_UserRole);

				} else {

					$get_UserID   = NULL;
					$get_UserRole = NULL;
					$data['req_list']  = $this->emr_mod->req_list_db_2($get_DeptID,$get_UserID,$get_UserRole);

				}
			}
		}


		//get user data
		$req_list = $data['req_list'];
		if($req_list){
			$where_in = array();
			$where_in_rejected = array();
			foreach ($req_list as $key => $value) {
				$where_in [] 	   		= $value['request_by'];
				$where_in_rejected [] 	= $value['rejected_by'];
			}

			$query = $this->general_mod->get_user($where_in);
			$user = array();
			foreach ($query as $key => $value) {
				$user[$value['id_user']] = $value;
			}
			$data['user_list'] = $user;

			$query_rejected = $this->general_mod->get_user($where_in_rejected);
			$user_rejected = array();
			foreach ($query_rejected as $key => $value_rejected) {
				$user_rejected[$value_rejected['id_user']] = $value_rejected;
			}

			$data['user_list_rejected'] = $user_rejected;

		}
		//get user data END

		$data['cost_list'] 		= $this->general_mod->get_dept_cost_code();
		$data['status_view']	= "Normal_View";	
		$data['meta_title'] 	= 'Material Request List';
		$data['subview']    	= 'admin/masterdata/req_list';
		$this->load->view('admin/index', $data);

	}


	public function report_process() {

		$date_from 	= $this->input->get('date_from');
		$date_to 	= $this->input->get('date_to');
		$status 	= $this->input->get('status');
		$id_cost 	= $this->input->get('id_cost');

		$data['date_from']  	= $date_from;
		$data['date_to']    	= $date_to;
		$data['status_view']    = $status;
		

		$where = array(
      		'`emr_table.request_date` >=' => $date_from,
      		'`emr_table.request_date` <=' => $date_to,
   		);


		if($status == 'Approved'){
			$where['`authorized_by` !='] = '';
			$where['`rejected_by`']      = '';
			$where['`eta_date`']         = '0000-00-00';
		}
		elseif($status == 'Rejected'){
			$where['`rejected_by` !='] = '';
		}
		elseif($status == 'In-Progress'){
			$where['`authorized_by`'] = '';
			$where['`rejected_by`'] = '';
		}
		elseif($status == 'Completed'){
			$where['`authorized_by` !='] = '';
			$where['`rejected_by` ='] = '';
			$where['`completed_by` !='] = '';
			$where['`completed_by` !='] = '0000-00-00';
		}

		if($id_cost != 'All'){
			$where['`project_id`'] = $id_cost;
		}

		$data["read_cookies"] 		= $this->cookie_get();
		$data["read_permission"] 	= $this->cookie_get_permission();

		$read_permission 	= $this->cookie_get_permission();
		$getScope_cookies 	= $read_permission[6];

		$read_cookies 	= $this->cookie_get();
		$get_DeptID 	= $read_cookies[4];
		$get_UserRole 	= $read_cookies[7];
		$get_UserID 	= $read_cookies[0];


		if($getScope_cookies == '1' || $get_DeptID == '5'){
    		$data['req_list'] = $this->emr_mod->get_req_mr($where);
    	} else {
    		if($get_UserRole == 3 OR $get_UserRole == 4){
					
					$get_DeptID = NULL;
					$data['req_list']  = $this->emr_mod->get_req_mr($where,$get_DeptID,$get_UserID,$get_UserRole);

				} else {

					$get_UserID   = NULL;
					$get_UserRole = NULL;
					$data['req_list']  = $this->emr_mod->get_req_mr($where,$get_DeptID,$get_UserID,$get_UserRole);

				}
    		}

    	$data['cost_list'] = $this->general_mod->get_dept_cost_code();

    //get user data
		$req_list = $data['req_list'];
		if($req_list){
			$where_in = array();
			$where_in_rejected = array();
			foreach ($req_list as $key => $value) {
				$where_in [] 	   		= $value['request_by'];
				$where_in_rejected [] 	= $value['rejected_by'];
			}
			$query = $this->general_mod->get_user($where_in);
			$user = array();
			foreach ($query as $key => $value) {
				$user[$value['id_user']] = $value;
			}
			$data['user_list'] = $user;
			$query_rejected = $this->general_mod->get_user($where_in_rejected);
			$user_rejected = array();
			foreach ($query_rejected as $key => $value_rejected) {
				$user_rejected[$value_rejected['id_user']] = $value_rejected;
			}
			$data['user_list_rejected'] = $user_rejected;
		}
			
		//get user data END

		$data['meta_title'] = 'Report';
		$data['subview']    = 'admin/masterdata/report_result';
		
		$this->load->view('admin/index', $data);
	}



	public function req_list_apr_reject($status = NULL) {

		$request_no_post = $this->input->post('request_no');
		if(isset($request_no_post)){
		 	$save_completed = $this->emr_mod->update_completed();
		 	$this->session->set_flashdata('notif', 'Completed!');
		 	redirect('emr/req_list_apr_reject/'.$status);
		}

		$this->session->unset_userdata('material');
		$this->session->unset_userdata('addmaterial');
		
		$data["read_cookies"] 		= $this->cookie_get();
		$data["read_permission"] 	= $this->cookie_get_permission();

		$read_permission 	= $this->cookie_get_permission();
		$getScope_cookies 	= $read_permission[6];

		$read_cookies 	= $this->cookie_get();
		$get_DeptID 	= $read_cookies[4];
		$get_UserRole 	= $read_cookies[7];
		$get_UserID 	= $read_cookies[0];

		if($get_UserRole == '2'){
			unset($where);

			// $data['req_list']  = $this->emr_mod->req_list_db_PresDir();
			if($status == 'Approved'){
				$where['emr_table.authorized_by !='] = '';
				$where['emr_table.rejected_by'] = '';
				$where['`emr_table.ref_po_no`'] = '';
				$where['`emr_table.completed_by`'] = '';
			}
			elseif($status == 'Completed'){
				$where['`emr_table.authorized_by` !='] = '';
				$where['`emr_table.eta_date` !='] = '';
				$where['`emr_table.ref_po_no` !='] = '';
				$where['`emr_table.completed_by` !='] = '';
			}
			elseif($status == 'Rejected'){
				$where['emr_table.rejected_by !='] = '';
			}
			elseif($status == 'Pending'){
				$where['emr_table.rejected_by'] = '';
				$where['emr_table.authorized_by'] = '';
				$where['emr_table.reviewed_by !='] = '';
			}
			elseif($status == 'In-Progress'){
				$where['emr_table.rejected_by'] = '';
				$where['emr_table.authorized_by'] = '';
			}
			$where['emr_table.status'] = '1';

			$data['req_list']  = $this->emr_mod->get_req_mr_list($where);

		} else if($get_DeptID == '11'){

			unset($where);
			$where['group_department'] = $get_DeptID;	
			$cost_data  = $this->general_mod->get_dept_cost_code($where);
			$view_cost_id = array();

  			foreach($cost_data as $row){
     			$view_cost_id[] = $row['id_cost'];
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			unset($where);
  			// $data['req_list']  = $this->emr_mod->req_list_db_PresDir();
			if($status == 'Approved'){
				$where['emr_table.authorized_by !='] = '';
				$where['emr_table.rejected_by'] = '';
				$where['`emr_table.ref_po_no`'] = '';
				$where['`emr_table.completed_by`'] = '';
			}
			elseif($status == 'Completed'){
				$where['`emr_table.authorized_by` !='] = '';
				$where['`emr_table.eta_date` !='] = '';
				$where['`emr_table.ref_po_no` !='] = '';
				$where['`emr_table.completed_by` !='] = '';
			}
			elseif($status == 'Rejected'){
				$where['emr_table.rejected_by !='] = '';
			}
			elseif($status == 'Pending'){
				$where['emr_table.rejected_by'] = '';
				$where['emr_table.authorized_by'] = '';
				$where['emr_table.approved_by'] = '';
			}
			elseif($status == 'In-Progress'){
				$where['emr_table.rejected_by'] = '';
				$where['emr_table.authorized_by'] = '';
			}
			$where['emr_table.status'] = '1';

			if($status == 'In-Progress' || $status == 'Approved' || $status == 'Rejected' || $status == 'Completed'){
				$data['req_list']  = $this->emr_mod->get_req_mr_list_11($where);
			} else {
				$data['req_list']  = $this->emr_mod->get_req_mr_list($where, $where_in);
			}
			
					
		} else if($get_DeptID == '5'){
			
			unset($where);
			$where['group_department'] = $get_DeptID;	
			$cost_data  = $this->general_mod->get_dept_cost_code($where);
			$view_cost_id = array();

			//print_r($cost_data);
			//return false;

  			foreach($cost_data as $row){
     			$view_cost_id[] = $row['id_cost'];
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			unset($where);
			if($status == 'Approved'){
				$where['emr_table.authorized_by !='] = '';
				$where['emr_table.rejected_by'] = '';
				$where['`emr_table.ref_po_no`'] = '';
				$where['`emr_table.completed_by`'] = '';
			}
			elseif($status == 'Completed'){
				$where['`emr_table.authorized_by` !='] = '';
				$where['`emr_table.eta_date` !='] = '';
				$where['`emr_table.ref_po_no` !='] = '';
				$where['`emr_table.completed_by` !='] = '';
			}
			elseif($status == 'Rejected'){
				$where['emr_table.rejected_by !='] = '';
			}
			elseif($status == 'Pending'){
				$where['emr_table.rejected_by'] = '';
				$where['emr_table.authorized_by'] = '';
				$where['emr_table.approved_by !='] = '';
				$where['emr_table.reviewed_by'] = '';
				$where['emr_table.category_emr'] = 'job_cost';
			}
			elseif($status == 'In-Progress'){
				$where['emr_table.rejected_by'] = '';
				$where['emr_table.authorized_by'] = '';
			}
			$data['req_list']  = $this->emr_mod->get_req_mr_list($where);

			unset($where);
			$where['emr_table.approved_by ='] = '';
			$where['emr_table.reviewed_by'] = '';
			$where['emr_table.rejected_by'] = '';
			$where['emr_table.authorized_by'] = '';
			$where['emr_table.status'] = '1';

			$data['req_list_Contract']  = $this->emr_mod->get_req_mr_list($where, $where_in);

			//get user data
			$req_list_Contract = $data['req_list_Contract'];
			
			if($req_list_Contract){

				$where_in_Contract = array();
				$where_in_rejected = array();
					foreach ($req_list_Contract as $key => $value) {
						$where_in_Contract [] = $value['request_by'];
						$where_in_rejected [] = $value['rejected_by'];
					}
				
				$query_Contract = $this->general_mod->get_user($where_in_Contract);
				$user_Contract = array();
				foreach ($query_Contract as $key => $value) {
					$user_Contract[$value['id_user']] = $value;
				}
				$data['user_list_Contract'] = $user_Contract;


				$query_rejected = $this->general_mod->get_user($where_in_rejected);
				$user_rejected = array();
				foreach ($query_rejected as $key => $value) {
					$user_rejected[$value['id_user']] = $value;
				}
				$data['user_list_rejected'] = $user_rejected;

			}
		//get user data END

		} else {

			if($getScope_cookies == '1'){

				unset($where);
				if($status == 'Approved'){
				$where['emr_table.authorized_by !='] = '';
				$where['emr_table.rejected_by'] = '';
				$where['`emr_table.ref_po_no`'] = '';
				$where['`emr_table.completed_by`'] = '';
			}
			elseif($status == 'Completed'){
				$where['`emr_table.authorized_by` !='] = '';
				$where['`emr_table.ref_po_no` !='] = '';
				$where['`emr_table.completed_by` !='] = '';
			}
				elseif($status == 'Rejected'){
					$where['emr_table.rejected_by !='] = '';
				}
				elseif($status == 'Pending'){
					$where['emr_table.rejected_by'] = '';
					$where['emr_table.approved_by'] = '';
				}
				elseif($status == 'In-Progress'){
					$where['emr_table.rejected_by'] = '';
					$where['emr_table.authorized_by'] = '';
				}
				$where['emr_table.status'] = '1';

				$data['req_list']  = $this->emr_mod->get_req_mr_list($where, NULL);
				// $data['req_list']  = $this->emr_mod->req_list_db_1();
			} elseif($get_UserRole == '3' || $get_UserRole == '4') {
				
				unset($where);

				if($get_UserRole == '3'){
				
					$where['cost_hod'] = $get_UserID;	

				} else {

					$where['cost_spv'] = $get_UserID;	

				}
				
				$cost_data  = $this->general_mod->get_dept_cost_code($where);
				$view_cost_id = array();
	  			
	  			foreach($cost_data as $row){
	     			$view_cost_id[] = $row['id_cost'];
	   			}
	 			
	 			$view_cost 	= implode(",",$view_cost_id);
	  			$where_in 	= explode(",", $view_cost);

	  			unset($where);

				if($status == 'Approved'){
				$where['emr_table.authorized_by !='] = '';
				$where['emr_table.rejected_by'] = '';
				$where['`emr_table.ref_po_no`'] = '';
				$where['`emr_table.completed_by`'] = '';
				}
				elseif($status == 'Completed'){
				$where['`emr_table.authorized_by` !='] = '';
				$where['`emr_table.ref_po_no` !='] = '';
				$where['`emr_table.completed_by` !='] = '';
				}
				elseif($status == 'Rejected'){
					$where['emr_table.rejected_by !='] = '';
				}
				elseif($status == 'Pending'){
					$where['emr_table.rejected_by'] = '';
					$where['emr_table.approved_by'] = '';
				}
				elseif($status == 'In-Progress'){
					$where['emr_table.rejected_by'] = '';
					$where['emr_table.authorized_by'] = '';
				}
				$where['emr_table.status'] = '1';

				$data['req_list']  = $this->emr_mod->get_req_mr_list($where, $where_in);

				// $data['req_list']  = $this->emr_mod->req_list_db_2($get_DeptID);
			} else {
				unset($where);
				$where['group_department'] = $get_DeptID;	
				$cost_data  = $this->general_mod->get_dept_cost_code($where);
				$view_cost_id = array();
	  		foreach($cost_data as $row){
	     		$view_cost_id[] = $row['id_cost'];
	   		}
	 			$view_cost 	= implode(",",$view_cost_id);
	  		$where_in 		= explode(",", $view_cost);

	  		unset($where);
				if($status == 'Approved'){
				$where['emr_table.authorized_by !='] = '';
				$where['emr_table.rejected_by'] = '';
				$where['`emr_table.ref_po_no`'] = '';
				$where['`emr_table.completed_by`'] = '';
			}
			elseif($status == 'Completed'){
				$where['`emr_table.authorized_by` !='] = '';
				$where['`emr_table.ref_po_no` !='] = '';
				$where['`emr_table.completed_by` !='] = '';
			}
				elseif($status == 'Rejected'){
					$where['emr_table.rejected_by !='] = '';
				}
				elseif($status == 'In-Progress'){
					$where['emr_table.rejected_by'] = '';
					$where['emr_table.authorized_by'] = '';
				}
				$where['emr_table.status'] = '1';

				if($status == 'Pending'){
					$data['req_list']  = array();
				}else{
					$data['req_list']  = $this->emr_mod->get_req_mr_list($where, $where_in);
				}

				// $data['req_list']  = $this->emr_mod->req_list_db_2($get_DeptID);
			}
		}

		//get user data
		$req_list = $data['req_list'];
		if($req_list){
			$where_in = array();
			$where_in_rejected = array();
			foreach ($req_list as $key => $value) {
				$where_in [] 	   		= $value['request_by'];
				$where_in_rejected [] 	= $value['rejected_by'];
			}

			$query = $this->general_mod->get_user($where_in);
			$user = array();
			foreach ($query as $key => $value) {
				$user[$value['id_user']] = $value;
			}
			$data['user_list'] = $user;

			$query_rejected = $this->general_mod->get_user($where_in_rejected);
			$user_rejected = array();
			foreach ($query_rejected as $key => $value_rejected) {
				$user_rejected[$value_rejected['id_user']] = $value_rejected;
			}
			$data['user_list_rejected'] = $user_rejected;
		}
		//get user data END

		$data['cost_list'] 		= $this->general_mod->get_dept_cost_code();
		$data['status_view']	= $status;
		$data['meta_title'] 	= 'Material Request List';
		$data['subview']    	= 'admin/masterdata/req_list';
		$this->load->view('admin/index', $data);

	}

	public function req_new($cat_mr = NULL) {
		$data['cost_list']       = $this->general_mod->get_dept_cost_code();
		$data['cookie'] 		 = $this->cookie_get();
		$data["read_cookies"] 	 = $this->cookie_get();
		$data["read_permission"] = $this->cookie_get_permission();
		
		//$this->session->unset_userdata('material');
		
		$data['cat_mr']		= $cat_mr;
		$data['meta_title'] = 'New Request';
		$data['subview']	= 'admin/masterdata/req_new';

		$this->load->view('admin/index', $data);
	}

	public function req_new_process() {
		$user = $this->cookie_get();
		
		$name 			= $user[0];
		$badge 			= $this->input->post('badge');
		$date 			= $this->input->post('date');
		$departement 	= $this->input->post('departement');
		$cost_cat 		= $this->input->post('cost_cat');
		$id_cost 		= $this->input->post('id_cost');
		$request_no 	= $this->general_mod->get_id_mr($id_cost);
		
		$form_data = array('request_no' => $request_no,
						   'request_by' => $name,
						   'request_date' => set_value('date'),
						   'category_emr' => set_value('cost_cat'),
						   'project_id' => set_value('id_cost'),
						   'status' => '1');

		$this->emr_mod->req_new_process_db($form_data);

		$item = $this->session->userdata('material');

		foreach ($item as $key => $value) {

			$id_details = $this->general_mod->get_id_details();
			$data_detail = array(
		    					'id_eimr' => $request_no,
		    					'description' => $value['m_description'], 
		    					'size' => $value['m_size'], 
		    					'qty' => $value['m_qty'], 
		    					'uom' => $value['m_uom'], 
		    					'expected_cost' => $value['m_expected_cost'], 
		    					'currency_symbol' => $value['m_currency_symbol'], 
		    					'ros' => $value['m_ros'], 
		    					'reason' => $value['m_reason'], 
		    					'remarks' => $value['m_remark']
		  	);

		  	$this->emr_mod->req_mat_new_process_db($data_detail);

		  	// print_r($value['file']);
		  
		  	$data_atc = array();
		  	if($value['file']){
			  foreach ($value['file'] as $key_atc => $value_atc) {
			  		array_push($data_atc, array(
				    	'id_details' => $id_details,
				    	'file_name' => $value_atc
				  	));
			  }

			  $this->emr_mod->req_mat_atc_new_process_db($data_atc);
		  }
		}

		$this->session->unset_userdata('material');
		$this->session->unset_userdata('addmaterial');
		$this->session->set_flashdata('notif', 'Inserted!');
		redirect('emr/req_list');
	}

	public function req_detail($request_no) {

		$data['cost_list'] 		= $this->general_mod->get_dept_cost_code();
		$data['req_list'] 		= $this->emr_mod->req_list_db($request_no);

		$hasil = $this->emr_mod->cari_data_emr($request_no);
		if ($hasil->num_rows() == 1) {

			foreach ($hasil->result() as $cari_emr_table) {

				$id_user = $cari_emr_table->request_by;

			}

		}

		$data["request_by"] 	=  $this->emr_mod->find_user_details($id_user);

		$data["read_cookies"] 	=  $this->cookie_get();

		$sess_data = array();
		
		$req_mat_list = $this->emr_mod->req_mat_list_db($request_no);
		foreach ($req_mat_list as $key => $req_mat) {

			$item['id_details'] 		= $req_mat['id_details'];
			$item['m_description'] 		= $req_mat['description'];
			$item['m_size'] 			= $req_mat['size'];
			$item['m_uom'] 				= $req_mat['uom'];
			$item['m_qty'] 				= $req_mat['qty'];
			$item['m_currency_symbol'] 	= $req_mat['currency_symbol'];
			$item['m_expected_cost'] 	= $req_mat['expected_cost'];
			$item['m_ros'] 				= $req_mat['ros'];
			$item['m_reason'] 			= $req_mat['reason'];
			$item['m_remark'] 			= $req_mat['remarks'];

			$req_mat_atc_list = $this->emr_mod->req_mat_atc_list_db($item['id_details']);

			foreach ($req_mat_atc_list as $key_atc => $req_mat_atc) {
				$item['file'][] = $req_mat_atc['file_name'];
			}

			$sess_data[] = $item;
			unset($item);
		}

		$this->session->set_userdata('material', $sess_data);

		$data['meta_title'] = 'Material Request Detail';
		$data['subview']= 'admin/masterdata/req_detail';
		$this->load->view('admin/index', $data);
	}


	public function req_detail_approve($request_no) {

		$data['cost_list'] = $this->general_mod->get_dept_cost_code();
		$data['req_list'] = $this->emr_mod->req_list_db($request_no);
		$data["read_cookies"] = $this->cookie_get();

		$sess_data = array();
		
		$req_mat_list = $this->emr_mod->req_mat_list_db($request_no);
		foreach ($req_mat_list as $key => $req_mat) {

			$item['id_details'] 		= $req_mat['id_details'];
			$item['m_description'] 		= $req_mat['description'];
			$item['m_size'] 			= $req_mat['size'];
			$item['m_uom'] 				= $req_mat['uom'];
			$item['m_qty'] 				= $req_mat['qty'];
			$item['m_currency_symbol'] 	= $req_mat['currency_symbol'];
			$item['m_expected_cost'] 	= $req_mat['expected_cost'];
			$item['m_ros'] 				= $req_mat['ros'];
			$item['m_reason'] 			= $req_mat['reason'];
			$item['m_remark'] 			= $req_mat['remarks'];

			$req_mat_atc_list = $this->emr_mod->req_mat_atc_list_db($item['id_details']);

			foreach ($req_mat_atc_list as $key_atc => $req_mat_atc) {
				$item['file'][] = $req_mat_atc['file_name'];
			}

			$sess_data[] = $item;
			unset($item);
		}

		$this->session->set_userdata('material', $sess_data);

		$data['meta_title'] = 'Material Request Detail';
		$data['subview']= 'admin/masterdata/req_detail';
		$this->load->view('admin/index', $data);
	}



	public function req_edit($request_no) {
		$data['cost_list'] = $this->general_mod->get_dept_cost_code();
		$data['req_list'] = $this->emr_mod->req_list_db($request_no);
		$data["read_cookies"] = $this->cookie_get();

		$sess_data = array();
		
		if($this->session->userdata('addmaterial')){
			$sess_data = $this->session->userdata('material');
			$this->session->unset_userdata('addmaterial');
		}
		else{
			$req_mat_list = $this->emr_mod->req_mat_list_db($request_no);
			foreach ($req_mat_list as $key => $req_mat) {
				$item['id_details'] = $req_mat['id_details'];
				$item['m_description'] = $req_mat['description'];
				$item['m_size'] = $req_mat['size'];
				$item['m_uom'] = $req_mat['uom'];
				$item['m_qty'] = $req_mat['qty'];
				$item['m_currency_symbol'] = $req_mat['currency_symbol'];
				$item['m_expected_cost'] = $req_mat['expected_cost'];
				$item['m_ros'] = $req_mat['ros'];
				$item['m_reason'] = $req_mat['reason'];
				$item['m_remark'] = $req_mat['remarks'];

				$req_mat_atc_list = $this->emr_mod->req_mat_atc_list_db($item['id_details']);

				foreach ($req_mat_atc_list as $key_atc => $req_mat_atc) {
					$item['file'][] = $req_mat_atc['file_name'];
				}
				$sess_data[] = $item;
				unset($item);
			}
		}
		$this->session->set_userdata('material', $sess_data);

		$hasil = $this->emr_mod->cari_data_emr($request_no);
		if ($hasil->num_rows() == 1) {

			foreach ($hasil->result() as $cari_emr_table) {

				$id_user = $cari_emr_table->request_by;

			}

		}

		$data["request_by"] 	=  $this->emr_mod->find_user_details($id_user);

		$data['meta_title'] = 'New Request';
		$data['subview']= 'admin/masterdata/req_edit';
		$this->load->view('admin/index', $data);
	}


	public function req_edit_process() {
		$data["read_cookies"] = $this->cookie_get();
		$request_no = $this->input->post('request_no');
		$name = $this->input->post('name');
		$badge = $this->input->post('badge');
		$date = $this->input->post('date');
		$departement = $this->input->post('departement');
		$project = $this->input->post('project');
		$where = array(
      'request_no' => $request_no,
    );
		$form_data = array(
      'request_no' => $request_no,
      'request_by' => set_value('name'),
      'request_date' => set_value('date'),
      'project_id' => set_value('project'),
      'status' => '1'
    );
		$this->emr_mod->req_edit_process_db($form_data, $where);
		$this->emr_mod->req_mat_replace_process_db($request_no);

		$item = $this->session->userdata('material');

		foreach ($item as $key => $value) {
			$id_details = $this->general_mod->get_id_details();
			$data_detail = array(
		    'id_eimr' => $request_no,
		    'description' => $value['m_description'], 
		    'qty' => $value['m_qty'], 
		    'size' => $value['m_size'], 
		    'uom' => $value['m_uom'], 
		    'expected_cost' => $value['m_expected_cost'], 
		    'currency_symbol' => $value['m_currency_symbol'], 
		    'ros' => $value['m_ros'], 
		    'reason' => $value['m_reason'], 
		    'remarks' => $value['m_remark']
		  );
		  $this->emr_mod->req_mat_new_process_db($data_detail);
		  if(isset($value['file'])){
		  	$data_atc = array();
			  foreach ($value['file'] as $key_atc => $value_atc) {
			  	array_push($data_atc, array(
				    'id_details' => $id_details,
				    'file_name' => $value_atc
				  ));
			  }
			  $this->emr_mod->req_mat_atc_new_process_db($data_atc);
		  }
		}

		$this->session->set_flashdata('notif', 'Updated!');
		redirect('emr/req_edit/'.$request_no);
	}


	public function req_del_process($request_no) {
		$where = array(
      'request_no' => $request_no,
    );
		$form_data = array(
      'status' => '0'
    );
		$data["read_cookies"] = $this->cookie_get();	
		$this->emr_mod->req_del_process_db($form_data, $where);
		$this->session->set_flashdata('notif', 'Deleted!');
		redirect('emr/req_list');
	}

	public function req_approve_process($request_no, $field, $cat_field) {

		//echo $field."-".$request_no."-".$cat_field;
		//return false;

		$id_user = $this->cookie_get();
		$where = array(
      		'request_no' => $request_no,
   		);
		
		if($cat_field == 'cost_centre'){

			$form_data = array(
				'reviewed_by' => $id_user[0],
      			$field.'_by' => $id_user[0],
      			$field.'_date' => date('Y-m-d H:i:s')
    		);

		} else {

			$form_data = array(
      			$field.'_by' => $id_user[0],
      			$field.'_date' => date('Y-m-d H:i:s')
    		);

		}

		//send email to group department approvall

		if($field == 'approved'){

			$pending_id = $this->emr_mod->find_pending_data_hod($request_no);
			
			$project_id = array();
			$request_by = array();
  			foreach($pending_id as $row){
     			$project_id[] = $row['project_id'];
     			$request_by[] = $row['request_by'];
   			}

 			$full_project_id = implode(",",$project_id);
  			$where_project 		 	 = explode(",", $full_project_id);

  			//print_r($project_id);
  			//return false;

  			$full_requestby = implode(",",$request_by);
  			$req_by_id 		= explode(",", $full_requestby);

  			$cost_data  = $this->general_mod->get_user_full_name($req_by_id);
  			$requested_by 	= $cost_data['0']['full_name'];
  			$department 	= $cost_data['0']['name_of_department'];
  			//print_r($cost_data);
  			//return false;
  			

  			if($cat_field == 'cost_centre'){

  			$cost_data  = $this->general_mod->get_id_cost_code($where_project);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = 21;
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);

  			//echo $total_mail;
  			//print_r($unique_email);
  			//return false;

  			if($total_mail > 0){

  				$user_full_name = $email_data[0]['full_name'];
				$links = 'http://10.5.253.8/emr/emr/req_list_apr_reject/Pending';
	
				$ci =& get_instance();
				$ci->load->library('email');
				$config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "10.5.252.31";
				$config['smtp_port'] 	= "25";
				$config['smtp_user'] 	= "";
				$config['smtp_pass'] 	= "";
				$config['charset'] 		= "utf-8";
				$config['mailtype'] 	= "html";
				$config['newline'] 		= "\r\n";
				$config['wordwrap'] 	= TRUE;
				$ci->email->initialize($config);
				$ci->email->set_crlf( "\r\n" );
				$ci->email->from('smtpservice.batam@sembmarine.com', 'Material Request List - Pending Approval');
								
				$list = $unique_email;

				//echo $total_mail;
  				//print_r($unique_email);
  				//return false;

				$ci->email->to($list);
				$ci->email->subject("Pending Approval - MR No : $request_no");
				$ci->email->message("<html>
									   <body>
									   		<p>Dear Mr. $user_full_name, </p>
									   		<p>The following Material request is awaiting your approval.</p>
									   		<p>Please refer to data on below :</p>
									   		<p>
									   		<table>
									   			<tr>
									   				<td>MR No</td>
									   				<td>:</td>
									   				<td>$request_no</td>
									   			</tr>
									   			<tr>
									   				<td>Requested By</td>
									   				<td>:</td>
									   				<td>$requested_by / $department</td>
									   			</tr>
									   			<tr>
									   				<td>Approval Link</td>
									   				<td>:</td>
									   				<td><a href='$links' target='_blank'><b>Link</b></a></td>
									   			</tr>
									   		</table>
									   		</p>
									   		
									   		<p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
									   		<br/>
									   		<p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
									   </body>
									 </html>
									");
				$ci->email->send();

			}

  			} else {

  			$cost_data  = $this->general_mod->get_id_cost_code($where_project);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = 5;
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);

  			//echo $total_mail;
  			//print_r($unique_email);
  			//return false;

  			if($total_mail > 0){

  				$user_full_name = $email_data[0]['full_name'];
				$links = 'http://10.5.253.8/emr/emr/req_list_apr_reject/Pending';
	
				$ci =& get_instance();
				$ci->load->library('email');
				$config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "10.5.252.31";
				$config['smtp_port'] 	= "25";
				$config['smtp_user'] 	= "";
				$config['smtp_pass'] 	= "";
				$config['charset'] 		= "utf-8";
				$config['mailtype'] 	= "html";
				$config['newline'] 		= "\r\n";
				$config['wordwrap'] 	= TRUE;
				$ci->email->initialize($config);
				$ci->email->set_crlf( "\r\n" );
				$ci->email->from('smtpservice.batam@sembmarine.com', 'Material Request List - Pending Approval');
								
				$list = $unique_email;

				//echo $total_mail;
  				//print_r($unique_email);
  				//return false;

				$ci->email->to($list);
				$ci->email->subject("Pending Approval - MR No : $request_no");
				$ci->email->message("<html>
									   <body>
									   		<p>Dear All, </p>
									   		<p>The following Material request is awaiting your approval.</p>
									   		<p>Please refer to data on below :</p>
									   		<p>
									   		<table>
									   			<tr>
									   				<td>MR No</td>
									   				<td>:</td>
									   				<td>$request_no</td>
									   			</tr>
									   			<tr>
									   				<td>Requested By</td>
									   				<td>:</td>
									   				<td>$requested_by / $department</td>
									   			</tr>
									   			<tr>
									   				<td>Approval Link</td>
									   				<td>:</td>
									   				<td><a href='$links' target='_blank'><b>Link</b></a></td>
									   			</tr>
									   		</table>
									   		</p>
									   		
									   		<p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
									   		<br/>
									   		<p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
									   </body>
									 </html>
									");
				$ci->email->send();

			}  			

			}

  			
		} else if($field == 'reviewed'){

			$pending_id = $this->emr_mod->find_pending_data_contract($request_no);
			
			$project_id = array();
			$request_by = array();
  			foreach($pending_id as $row){
     			$project_id[] = $row['project_id'];
     			$request_by[] = $row['request_by'];
   			}

 			$full_project_id = implode(",",$project_id);
  			$where_project 	 = explode(",", $full_project_id);

  			//print_r($project_id);
  			//return false;

  			$full_requestby = implode(",",$request_by);
  			$req_by_id 		= explode(",", $full_requestby);

  			$cost_data  = $this->general_mod->get_user_full_name($req_by_id);
  			$requested_by 	= $cost_data['0']['full_name'];
  			$department 	= $cost_data['0']['name_of_department'];
  			//print_r($cost_data);
  			//return false;

  			$cost_data  = $this->general_mod->get_id_cost_code($where_project);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = 21;
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);

  			//echo $total_mail;
  			//print_r($unique_email);
  			//return false;

  			if($total_mail > 0){

  				$user_full_name = $email_data[0]['full_name'];
				$links = 'http://10.5.253.8/emr/emr/req_list_apr_reject/Pending';
	
				$ci =& get_instance();
				$ci->load->library('email');
				$config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "10.5.252.31";
				$config['smtp_port'] 	= "25";
				$config['smtp_user'] 	= "";
				$config['smtp_pass'] 	= "";
				$config['charset'] 		= "utf-8";
				$config['mailtype'] 	= "html";
				$config['newline'] 		= "\r\n";
				$config['wordwrap'] 	= TRUE;
				$ci->email->initialize($config);
				$ci->email->set_crlf( "\r\n" );
				$ci->email->from('smtpservice.batam@sembmarine.com', 'Material Request List - Pending Approval');
								
				$list = $unique_email;

				//echo $total_mail;
  				//print_r($unique_email);
  				//return false;

				$ci->email->to($list);
				$ci->email->subject("Pending Approval - MR No : $request_no");
				$ci->email->message("<html>
									   <body>
									   		<p>Dear Mr. $user_full_name, </p>
									   		<p>The following Material request is awaiting your approval.</p>
									   		<p>Please refer to data on below :</p>
									   		<p>
									   		<table>
									   			<tr>
									   				<td>MR No</td>
									   				<td>:</td>
									   				<td>$request_no</td>
									   			</tr>
									   			<tr>
									   				<td>Requested By</td>
									   				<td>:</td>
									   				<td>$requested_by / $department</td>
									   			</tr>
									   			<tr>
									   				<td>Approval Link</td>
									   				<td>:</td>
									   				<td><a href='$links' target='_blank'><b>Link</b></a></td>
									   			</tr>
									   		</table>
									   		</p>
									   		
									   		<p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
									   		<br/>
									   		<p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
									   </body>
									 </html>
									");
				$ci->email->send();

			}

		} else if($field == 'authorized'){

			$pending_id = $this->emr_mod->find_pending_data_PD($request_no);
			
			$project_id = array();
			$request_by = array();
  			foreach($pending_id as $row){
     			$project_id[] = $row['project_id'];
     			$request_by[] = $row['request_by'];
   			}

 			$full_project_id = implode(",",$project_id);
  			$where_project 	 = explode(",", $full_project_id);

  			//print_r($project_id);
  			//return false;

  			$full_requestby = implode(",",$request_by);
  			$req_by_id 		= explode(",", $full_requestby);

  			$cost_data  = $this->general_mod->get_user_full_name($req_by_id);
  			$requested_by 	= $cost_data['0']['full_name'];
  			$department 	= $cost_data['0']['name_of_department'];
  			//print_r($cost_data);
  			//return false;

  			$cost_data  = $this->general_mod->get_id_cost_code($where_project);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = 11;
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);

  			//echo $total_mail;
  			//print_r($unique_email);
  			//return false;

  			if($total_mail > 0){

  				$user_full_name = $email_data[0]['full_name'];
				$links = 'http://10.5.253.8/emr/emr/req_list_apr_reject/Approved';
	
				$ci =& get_instance();
				$ci->load->library('email');
				$config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "10.5.252.31";
				$config['smtp_port'] 	= "25";
				$config['smtp_user'] 	= "";
				$config['smtp_pass'] 	= "";
				$config['charset'] 		= "utf-8";
				$config['mailtype'] 	= "html";
				$config['newline'] 		= "\r\n";
				$config['wordwrap'] 	= TRUE;
				$ci->email->initialize($config);
				$ci->email->set_crlf( "\r\n" );
				$ci->email->from('smtpservice.batam@sembmarine.com', 'Material Request List - Approval Completed');
								
				$list = $unique_email;

				//echo $total_mail;
  				//print_r($unique_email);
  				//return false;

				$ci->email->to($list);
				$ci->email->subject("Approval Completed - MR No : $request_no");
				$ci->email->message("<html>
									   <body>
									   		<p>Dear All, </p>
									   		<p>Material Request Approval is Completed.</p>
									   		<p>Please help to process this request, and refer to data on below :</p>
									   		<p>
									   		<table>
									   			<tr>
									   				<td>MR No</td>
									   				<td>:</td>
									   				<td>$request_no</td>
									   			</tr>
									   			<tr>
									   				<td>Requested By</td>
									   				<td>:</td>
									   				<td>$requested_by / $department</td>
									   			</tr>
									   			<tr>
									   				<td>Approval Link</td>
									   				<td>:</td>
									   				<td><a href='$links' target='_blank'><b>Link</b></a></td>
									   			</tr>
									   		</table>
									   		</p>
									   		
									   		<p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
									   		<br/>
									   		<p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
									   </body>
									 </html>
									");
				$ci->email->send();

			}

		}




		//send email to group department approvall
		$data["read_cookies"] = $this->cookie_get();	
		$this->emr_mod->req_edit_process_db($form_data, $where);
		$this->session->set_flashdata('notif', 'Approved!');
		redirect('emr/req_list');
	}

	public function req_reject_process($request_no) {

		$id_user = $this->cookie_get();
		$where = array(
     		 'request_no' => $request_no,
    	);

		$form_data = array(
      		'rejected_by' => $id_user[0],
      		'rejected_date' => date('Y-m-d H:i:s')
    	);

		$this->emr_mod->req_edit_process_db($form_data, $where);
		$this->session->set_flashdata('notif', 'Rejected!');
		redirect('emr/req_list');
	}

	public function add_reason_reject($request_no) {
		$id_user   = $this->cookie_get();
		$where 	   = array('request_no' => $request_no,);
		$form_data = array(
      		'rejected_reason' => $this->input->post('reason')
   		);
		$this->emr_mod->req_edit_process_db($form_data, $where);
	}

	public function req_resubmit_process($request_no) {
		$id_user = $this->cookie_get();
		$where = array(
      'request_no' => $request_no,
    );
		$form_data = array(
      
      'approved_by' => '',
      'approved_date' => '',
      'reviewed_by' => '',
      'reviewed_date' => '',
      'authorized_by' => '',
      'authorized_date' => '',
      'rejected_by' => '',
      'rejected_date' => '',
      'rejected_reason' => ''
    );
		$this->emr_mod->req_edit_process_db($form_data, $where);

		$this->session->set_flashdata('notif', ' Resubmit!');
		redirect('emr/req_list');

	}

	public function search_name_badge(){
        if (isset($_GET['term']))
        {
            $result = $this->emr_mod->search_name_badge_db($_GET['term']);
            if ($result == TRUE)
            {
                foreach ($result as $row)
                    $arr_result[] = $row->badge_no . ' - ' . $row->full_name;
                echo json_encode($arr_result);
            }
            else
            {
                $arr_result[] = "Employee Not Registered. Please Register Employee First in ISS Employee";
                echo json_encode($arr_result);
            }
        }
  }

  public function set_session_emr_data($name, $value) {
		$this->session->set_userdata($name.'_emr_data', $value);
  }

  public function add_material_temp() {

		$item['m_description'] 	   = $this->input->post('m_description');
		$item['m_size']			   = $this->input->post('m_size');
		$item['m_uom'] 			   = $this->input->post('m_uom');
		$item['m_qty'] 			   = $this->input->post('m_qty');
		$item['m_currency_symbol'] = $this->input->post('m_currency_symbol');
		$item['m_expected_cost']   = $this->input->post('m_expected_cost');
		$item['m_ros']             = $this->input->post('m_ros');
		$item['m_reason']          = $this->input->post('m_reason');
		$item['m_remark']          = $this->input->post('m_remark');
		$item['file'] 			   = array();

		if($this->session->userdata('material')){
			$sess_data = $this->session->userdata('material');
		}
		$sess_data[] = $item;
		$this->session->set_userdata('material', $sess_data);
		$this->session->set_userdata('addmaterial', '1');

	}

	public function import_add_material_temp(){
		$id_user = $this->cookie_get();

		$cat_mr = $this->input->post('cat_mr');

		//echo $cat_mr;
		//return false;

		// Upload File
		$config['upload_path']          = 'file/';
		$config['file_name']            = 'excel_'.$id_user[0];
		$config['allowed_types']        = 'xlsx';
		$config['overwrite'] 			= TRUE;
		// $config['max_width']            = 1024;
	 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	 // echo 'asd';
		if ( ! $this->upload->do_upload('file')){
			echo $this->upload->display_errors();
			return $this->upload->display_errors();
		}
		// echo 'asd2';

		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('file/'.'excel_'.$id_user[0].'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			
			if($numrow > 1){
				
				array_push($data, array(
					'm_description'=>$row['A'], // Insert data nis dari kolom A di excel
					'm_size'=>$row['B'], // Insert data nis dari kolom A di excel
					'm_uom'=>$row['C'], // Insert data nama dari kolom B di excel
					'm_qty'=>$row['D'], // Insert data jenis kelamin dari kolom C di excel
					'm_currency_symbol'=>$row['E'], // Insert data alamat dari kolom D di excel
					'm_expected_cost'=>$row['F'], // Insert data alamat dari kolom D di excel
					'm_ros'=>$row['G'], // Insert data alamat dari kolom D di excel
					'm_reason'=>$row['H'], // Insert data alamat dari kolom D di excel
					'm_remark'=>$row['I'], // Insert data alamat dari kolom D di excel
					'file'=> array(), // Insert data alamat dari kolom D di excel
				));

				$key = $numrow-2;
				foreach ($data[$key] as $i => $value) {
					if($i != 'file'){
						if($value == NULL){
							$data[$key][$i] = '';
						}
					}
				}
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		$sess_data = $data;
		$this->session->set_userdata('material', $sess_data);

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		// $this->staff_mod->insert_multiple($data);
		
		redirect("emr/req_new/$cat_mr"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function del_material_temp($index) {
		$sess_data = $this->session->userdata('material');
		unset($sess_data[$index]);
		$this->session->set_userdata('material', $sess_data);
		$this->session->set_userdata('addmaterial', '1');
		redirect('emr/req_new');
	}

	public function reset_material_temp($action_form,$cat_mr = NULL, $id_req = NULL) {
		$this->session->unset_userdata('material');
		$this->session->set_userdata('addmaterial', '1');
		if(isset($cat_mr)){
			redirect('emr/'.$action_form.'/'.$cat_mr);
		} else {
			redirect('emr/'.$action_form.'/'.$id_req);
		}
	}

	public function upl_material_temp($action_form, $id_req = NULL) {
		$index     = $this->input->post('file_index');
		$sess_data = $this->session->userdata('material');
		$no = count($sess_data[$index]['file']);
		$id_user = $this->cookie_get();
		$name_file = $id_user[0].'-'.$no.'-'.date('YmdHis');

		// Upload File
		$config['upload_path']          = 'upload/';
		$config['file_name']            = $name_file;
		$config['allowed_types']        = 'gif|jpg|png|pdf';
		// $config['max_width']            = 1024;
	 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	 
		if ( ! $this->upload->do_upload('file')){
			return $this->upload->display_errors();
		}

		upload_ftp_server($config['upload_path'].$this->upload->data('file_name'), $config['upload_path'].$this->upload->data('file_name'));

		if($this->upload->data('file_ext') != '.pdf'){
			$source_path = $_SERVER['DOCUMENT_ROOT'] . '/emr/upload/' . $this->upload->data('file_name');
	    $target_path = $_SERVER['DOCUMENT_ROOT'] . '/emr/upload/' . $this->upload->data('file_name');
	    $config_manip = array(
	        'image_library' => 'gd2',
	        'source_image' => $source_path,
	        'new_image' => $target_path,
	        'quality' => '50%',
	        'maintain_ratio' => TRUE,
	        'width' => 400,
	    );
	 
	    $this->load->library('image_lib', $config_manip);
	    $this->image_lib->initialize($config_manip);

	    if (!$this->image_lib->resize()) {
	        return $this->image_lib->display_errors();
	    }
	 
	    $this->image_lib->clear();
		}
		
		// Upload File END=

		$sess_data[$index]['file'][] = $saved_file_name = $this->upload->data('file_name');
		$this->session->set_userdata('material', $sess_data);		
		$this->session->set_userdata('addmaterial', '1');

		redirect('emr/'.$action_form.'/'.$id_req);
	}

	public function download_req_detail_excel($request_no) {


		$data['req_list'] = $this->emr_mod->req_list_db($request_no);
		$data['cost_list']    = $this->general_mod->get_dept_cost_code($data['req_list'][0]['project_id']);
		$where_in = array($req_list['request_by'], $req_list['approved_by'], $req_list['reviewed_by'], $req_list['reviewed_by'], $req_list['authorized_by'], $req_list['received_by']);
		$query = $this->general_mod->get_user($where_in);
		$user = array();
		foreach ($query as $key => $value) {
			$user[$value['id_user']] = $value;
		}
		$data['user_list'] = $user;
		$req_mat_list 	  = $this->emr_mod->req_mat_list_db($request_no);
		$data['filename'] = $request_no;
		$sess_data 		  = array();

		foreach ($req_mat_list as $key => $req_mat) {

			$item['id_details'] 		= $req_mat['id_details'];
			$item['m_description'] 		= $req_mat['description'];
			$item['m_size'] 			= $req_mat['size'];
			$item['m_uom'] 				= $req_mat['uom'];
			$item['m_qty'] 				= $req_mat['qty'];
			$item['m_currency_symbol'] 	= $req_mat['currency_symbol'];
			$item['m_expected_cost'] 	= $req_mat['expected_cost'];
			$item['m_ros'] 				= $req_mat['ros'];
			$item['m_reason'] 			= $req_mat['reason'];
			$item['m_remark'] 			= $req_mat['remarks'];

			$req_mat_atc_list = $this->emr_mod->req_mat_atc_list_db($item['id_details']);
			$item['file'] = array();
			foreach ($req_mat_atc_list as $key_atc => $req_mat_atc) {
				$item['file'][] = $req_mat_atc['file_name'];
			}
			$sess_data[] = $item;
			unset($item);
		}
		$this->session->set_userdata('material', $sess_data);
		$this->load->view('admin/masterdata/req_detail_excel', $data);
	}

	public function req_approval() {
		$check = $this->input->post('check');
		$acknowledge = $this->input->post('acknowledge');

		if($acknowledge = 'Approve'){
			
		}

		foreach ($check as $key => $value) {
			
		}
	}

	public function report() {

		//$this->session->unset_userdata('material');
		//$this->session->unset_userdata('addmaterial');

		$data['meta_title']   = 'Report';
		$data['cookie'] 	  = $this->cookie_get();
		$data["read_cookies"] = $this->cookie_get();
		$data["read_permission"] = $this->cookie_get_permission();
		$data['cost_list']    = $this->general_mod->get_dept_cost_code();
		$data['subview']      = 'admin/masterdata/report_section';

		$this->load->view('admin/index', $data);
	}

	

	public function cetak_pdf($request_no) {

  	$data['cost_list'] = $this->general_mod->get_dept_cost_code();
		$data['req_list'] = $this->emr_mod->req_list_db($request_no);
		$req_mat_list = $this->emr_mod->req_mat_list_db($request_no);
		// print_r($req_mat_list);
		// return false;
		$data['req_mat_list'] = $req_mat_list;

		$req_atc = array();
		foreach ($req_mat_list as $key => $req_mat) {
			$req_mat_atc_list = $this->emr_mod->req_mat_atc_list_db($req_mat['id_details']);
			foreach ($req_mat_atc_list as $key2 => $value) {
				$req_atc [$req_mat['id_details']][] = $value['file_name'];
			}
		}
		$data['req_atc_list'] = $req_atc;

		$req_list = $data['req_list'][0];
		$where_in = array($req_list['request_by'], $req_list['approved_by'], $req_list['reviewed_by'], $req_list['reviewed_by'], $req_list['authorized_by'], $req_list['received_by']);
		$query = $this->general_mod->get_user($where_in);
		$user = array();
		foreach ($query as $key => $value) {
			$user[$value['id_user']] = $value;
		}
		$data['user_list'] = $user;

    $this->load->library('Pdfgenerator');
 
    $html = $this->load->view('admin/masterdata/req_detail_pdf', $data, true);
    
    $this->pdfgenerator->generate($html,$request_no);
 }

 public function get_all_pending_data_hod() {

		//$data['pending_data']  = $this->emr_mod->find_pending_data_hod();
		
			$pending_id = $this->emr_mod->find_pending_data_hod();
			$project_id = array();

  			foreach($pending_id as $row){
     			$project_id[] = $row['project_id'];
   			}

 			$full_project_id = implode(",",$project_id);
  			$where 		 = explode(",", $full_project_id);

  			$cost_data  = $this->general_mod->get_id_cost_code($where);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = $row['group_department'];
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);
  			
  			//print_r($unique_email);
			//echo count($unique_email);
  			//print_r($email_send);
  			//return false;

  		$data['status']         = "HOD";	
  		$data['pending_data']   = $email_send;
  		$data['total_pending']  = $total_mail;

		$this->load->view('pending/pending', $data);

	}


	public function get_all_pending_data_contract() {

		//$data['pending_data']  = $this->emr_mod->find_pending_data_hod();
		
			$pending_id = $this->emr_mod->find_pending_data_contract();
			$project_id = array();

  			foreach($pending_id as $row){
     			$project_id[] = $row['project_id'];
   			}

 			$full_project_id = implode(",",$project_id);
  			$where 		 = explode(",", $full_project_id);

  			$cost_data  = $this->general_mod->get_id_cost_code($where);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = 5;
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);
  			
  			//print_r($unique_email);
			//echo count($unique_email);
  			//print_r($email_send);
  			//return false;

  		$data['status']         = "Contract";	
  		$data['pending_data']   = $email_send;
  		$data['total_pending']  = $total_mail;

		$this->load->view('pending/pending', $data);

	}


	public function get_all_pending_data_PD() {

		//$data['pending_data']  = $this->emr_mod->find_pending_data_hod();
		
			$pending_id = $this->emr_mod->find_pending_data_PD();
			$project_id = array();

  			foreach($pending_id as $row){
     			$project_id[] = $row['project_id'];
   			}

 			$full_project_id = implode(",",$project_id);
  			$where 		     = explode(",", $full_project_id);

  			//$total_mail     = count($project_id);
  			//print_r($total_mail);
  			//return false;

  			$cost_data  = $this->general_mod->get_id_cost_code($where);
			$view_cost_id = array();
  			foreach($cost_data as $row){
     			$view_cost_id[] = 21;
   			}

 			$view_cost 	= implode(",",$view_cost_id);
  			$where_in 	= explode(",", $view_cost);

  			//print_r($where_in);
  			//return false;

  			$email_data  = $this->general_mod->get_email_user($where_in);
  			$view_email_data = array();
  			foreach($email_data as $row){
     			$view_email_data[] = $row['email'];
   			}

 			$view_email 	= implode(",",$view_email_data);
  			$email_send		= explode(",", $view_email);
  			$unique_email 	= array_unique($email_send);
  			$total_mail     = count($view_email_data);
  			
  			//print_r($unique_email);
			//echo count($unique_email);
  			//print_r($email_send);
  			//return false;

  			$data['user']  			= $this->general_mod->get_email_user($where_in);	
  			$data['status']         = "PD";	
  			$data['pending_data']   = $email_send;
  			$data['total_pending']  = $total_mail;

			$this->load->view('pending/pending', $data);

	}

}