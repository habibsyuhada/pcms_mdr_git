<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

	public function __construct() {
			
		parent::__construct();

		$this->load->model('general_mod');
		$this->load->model('production_mod');
		$this->load->model('m_vendor_mod');

		$this->load->helper('cookies');
		helper_cookies();
		// cek_login($this->input->cookie('portal_user'));
		
		// $this->load->helper('access');
		// access_helper();

		$this->user_cookie 		  				= explode(";",$this->input->cookie('portal_user'));
		$this->permission_cookie  			= explode(";",$this->input->cookie('portal_qcs'));
		$this->permission_eng_act 			= explode(";",$this->input->cookie('portal_pcms'));

		$this->sidebar_mdr 			  	= "production/sidebar_mdr";
		$this->sidebar_vmdr 			  = "production/sidebar_vmdr";
		$this->load->helper('url');

  	$this->permission_delete_data = 0;
		if(in_array($this->user_cookie[0], array(1, 2, 76, 146, 169))){
			$this->permission_delete_data = 1;
		}

		$this->permission_discipline_view_data = [];
		if(in_array($this->user_cookie[0], array(1000448, 1000447, 1000446))){
			$this->permission_discipline_view_data = [10, 18, 31, 50, 51, 53, 60, 61, 68, 69];
		}
	}

	public function index(){
		redirect('production/mdr_dc_list');
	}

  // MDR Document Control ===
	public function mdr_dc_list(){
		log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Open MDR List');

		$where['status'] = 1;
		$data = array(
			'project_chain' 		 => $this->general_mod->data_project($where),
			'module_chain' 			 => $this->general_mod->data_module(null),
			'project_chain_selected' => '',
			'module_chain_selected'  => ''
		);
		unset($where);

		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}
		
		$data['read_cookies']   = $this->user_cookie;
    	$data['meta_title']     = 'MDR List';
    	$data['subview']        = 'production/mdr_dc_list';
  	  	$data['sidebar']        = $this->sidebar_mdr;

  	  	

    	$this->load->view('index', $data);
	}

	public function mdr_dc_new(){

		$where['status'] = 1;
		$data = array(
            'project_chain' 		 => $this->general_mod->data_project($where),
            'module_chain' 			 => $this->general_mod->data_module(null),
           	'project_chain_selected' => '',
            'module_chain_selected'  => ''
        );
        unset($where);

		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}

		
		$data['read_cookies']   = $this->user_cookie;
  		$data['meta_title']     = 'Add New MDR';
  		$data['subview']        = 'production/mdr_dc_new';
	  	$data['sidebar']        = $this->sidebar_mdr;

  		$this->load->view('index', $data);
	}


	public function mdr_dc_list_import(){
		$data['read_cookies']   = $this->user_cookie;
    	$data['meta_title']     = 'Import MDR';
    	$data['subview']        = 'production/mdr_dc_list_import';
  	  	$data['sidebar']        = $this->sidebar_mdr;

    	$this->load->view('index', $data);
	}

	public function mdr_dc_detail($id){
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}

		$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
	
		$data['mws_list'] = $this->production_mod->find_document_mws($id);
		$data['dnv_list'] = $this->production_mod->find_document_dnv($id);

		$data['document_list'] 					= $this->production_mod->document_list($id);
		$where['status_delete']					= '1';
		$where['id_document']						= $id;
		$data['document_revision_list'] = $this->production_mod->document_revision_list(NULL, $where);
		$data['user_rev_list'] 					= $this->user_name_data("SELECT DISTINCT revision_by as id_user FROM mdr_document_revision WHERE id_document = '".$id."'");
		
		if($this->input->get('t')){
			$data['t'] 	= $this->input->get('t');
		}else{
			$data['t'] 	= 'd';
		}

		$data['meta_title'] 	  = 'Design Document Detail';
		$data['subview']    	  = 'production/mdr_dc_detail';
		$data['sidebar']    		= $this->sidebar_mdr;
		$this->load->view('index', $data);
	}

	public function mdr_dc_new_process(){
		$post 						= $this->input->post();
		$where['ref_no']	= $post['ref_no'];
		$where['status_delete']	= 1;
		$document_list 		= $this->production_mod->document_list(NULL, $where);
		if(count($document_list) > 0){
			$this->session->set_flashdata('error', 'Duplicate Reference Number!');
			redirect('production/mdr_dc_new/');
			return false;
		}
		$date_now = date('Y-m-d H:i:s');
		$form_data = array(
			'ref_no' 					=> $post['ref_no'],
			'description' 		=> $post['description'],
			// 'country' 				=> $post['country'],
			'project_id' 			=> $post['project_id'],
			'discipline' 			=> $post['discipline'],
			'module' 					=> $post['module'],
			'document_type' 	=> $post['document_type'],
			'system'					=> $post['system'],
			'subsystem' 			=> $post['subsystem'],
			'generator' 			=> $post['generator'],
			// 'vendor_code' 		=> $post['vendor_code'],
			// 'po_number' 			=> $post['po_number'],
			'cetegory' 				=> 2,
			'upload_by' 			=> $this->user_cookie[0],
			'upload_date' 		=> $date_now,
			'revision_no' 		=> '-',
			'remarks' 				=> $post['remarks'],

			'wp' 									=> $post['wp'],
			'wu' 									=> $post['wu'],
			'interface_doc' 			=> $post['interface_doc'],
			'asb' 								=> $post['asb'],
			'ctr_lead' 						=> $post['ctr_lead'],
			'asb_planned_date'		=> $post['asb_planned_date'],
			'ifr_planned_date' 		=> $post['ifr_planned_date'],
			'ifa_planned_date' 		=> $post['ifa_planned_date'],
			'afc_planned_date' 		=> $post['afc_planned_date'],
			'ifi_planned_date' 		=> $post['ifi_planned_date'],

			'afd_planned_date' 												=> $post['afd_planned_date'],
			'equipment_class' 												=> $post['equipment_class'],
			'equipment_subclass' 											=> $post['equipment_subclass'],
			'criticality' 														=> $post['criticality'],
			'originator_doc_number' 									=> $post['originator_doc_number'],
			'tag' 																		=> $post['tag'],
			'cable_tag' 															=> $post['cable_tag'],
			'line_tag' 																=> $post['line_tag'],
			'spp_tag' 																=> $post['spp_tag'],
			'mdr_update_information' 									=> $post['mdr_update_information'],
			'field_operations_delivrable'				 			=> $post['field_operations_delivrable'],
			'weight' 																	=> $post['weight'],
			'progress' 																=> $post['progress'],
			'contractor_transmittal_sheet_number' 		=> $post['contractor_transmittal_sheet_number'],
			'issue_date_contractor_transmittal_sheet' => $post['issue_date_contractor_transmittal_sheet'],
			'mdr_revision_request_nb' 								=> $post['mdr_revision_request_nb'],
			'fdb_volume' 															=> $post['fdb_volume'],
			'brownfield_interface' 										=> $post['brownfield_interface'],
			'folio_drawing' 													=> $post['folio_drawing'],
		);
		$id_insert = $this->production_mod->document_new_process_db($form_data);

		$this->session->set_flashdata('success', 'Your data has been Uploaded!');
		redirect('production/mdr_dc_list/');
	}

	public function mdr_document_revision_new_process(){
		$revision_no 				= $this->input->post('revision_no');
		$id_document 				= $this->input->post('id_document');
		$revision_date 			= $this->input->post('revision_date');
		$remarks 						= $this->input->post('remarks');
		$code 							= $this->input->post('code');
		$status_remark 			= $this->input->post('status_remark');
		$class							= $this->input->post('class');
		$transmittal_no			= $this->input->post('transmittal_no');
		$transmittal_date	= $this->input->post('transmittal_date');
		$weight						= $this->input->post('weight');
		$progress					= $this->input->post('progress');
		// $transmittal_sheet_no					= $this->input->post('transmittal_sheet_no');
		// $issue_date_transmittal_sheet	= $this->input->post('issue_date_transmittal_sheet');
		// $mdr_revision_request_nb			= $this->input->post('mdr_revision_request_nb');
		// test_var($this->input->post());

		$name_file 					= $this->user_cookie[0].'-'.date('YmdHis');

		$config['upload_path']    = 'upload/production_design/file';
		$config['file_name']      = $name_file;
		$config['allowed_types']  = '*';
		// $config['max_size']       = '200000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')){
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('production/mdr_dc_detail/'.strtr($this->encryption->encrypt($id_document), '+=/', '.-~').'?t='.strtolower($status_remark));
			return false;
		}
		
		upload_ftp_server($config['upload_path']."/".$this->upload->data('file_name'), $config['upload_path']."/".$this->upload->data('file_name'));

		$form_data = array(
			'revision_no' 	=> $revision_no,
			'code' 					=> $code,
			'status_remark' => $status_remark,
			'class' 				=> $class,
			'transmittal_no'=> $transmittal_no,
			'transmittal_date'=> $transmittal_date,
			'id_document' 	=> $id_document,
			'revision_date' => $revision_date,
  		'attachment' 		=> $this->upload->data('file_name'),
  		'remarks' 			=> $remarks,
			'revision_by' 	=> $this->user_cookie[0],
			'weight' 												=> $weight,
			'progress' 											=> $progress,
			// 'transmittal_sheet_no' 					=> $transmittal_sheet_no,
			// 'issue_date_transmittal_sheet' 	=> $issue_date_transmittal_sheet,
			// 'mdr_revision_request_nb' 			=> $mdr_revision_request_nb,
		);
		$id_detail = $this->production_mod->insert_data_pmt_document_revision($form_data);

		// $form_data = array(
		// 	'revision_no' 	=> $revision_no,
		// 	'revision_date' => $revision_date,
		// 	'code' 					=> $code,
		// 	'status_remark' => $status_remark,
		// 	'class' 				=> $class,
		// 	'transmittal_no'=> $transmittal_no,
		// 	'attachment' 		=> $this->upload->data('file_name'),
		// 	'upload_date' 	=> date('Y-m-d H:i:s'),
		// );
		// $where['id'] 			= $id_document;
		// $this->production_mod->document_edit_process_db($form_data, $where);
		$this->change_to_newest($id_document, $id_detail);
		

		$this->session->set_flashdata('success', 'Your data has been Uploaded!');

		redirect('production/mdr_dc_detail/'.strtr($this->encryption->encrypt($id_document), '+=/', '.-~').'?t='.strtolower($status_remark));
	}

	public function mdr_document_edit_process(){
		$id 								= $this->input->post('id');
		$project_id 				= $this->input->post('project_id');
		$discipline 				= $this->input->post('discipline');
		$module 						= $this->input->post('module');
		$description 				= $this->input->post('description');
		$remarks 						= $this->input->post('remarks');
		$document_type 			= $this->input->post('document_type');
		$system 						= $this->input->post('system');
		$subsystem 					= $this->input->post('subsystem');
		$generator				= $this->input->post('generator');

		$form_data = array(
			'project_id' 		=> $project_id,
			'discipline' 		=> $discipline,
			'module' 				=> $module,
			'description' 	=> $description,
			'remarks' 			=> $remarks,
			'document_type'	=> $document_type,
			'system' 				=> $system,
			'subsystem' 		=> $subsystem,
			'generator' 		=> $generator,
		);
		$where['id'] 			= $id;
		$this->production_mod->document_edit_process_db($form_data, $where);

		$this->session->set_flashdata('success', 'Your data has been Updated!');
		redirect('production/mdr_dc_detail/'.strtr($this->encryption->encrypt($id), '+=/', '.-~').'?t=d');
	}

	public function mdr_document_planner_edit_process(){
		$id 											= $this->input->post('id');
		$wp 											= $this->input->post('wp');
		$wu 											= $this->input->post('wu');
		$interface_doc 						= $this->input->post('interface_doc');
		$asb 											= $this->input->post('asb');
		$ctr_lead 								= $this->input->post('ctr_lead');
		$asb_planned_date 				= $this->input->post('asb_planned_date');
		$ifr_planned_date 				= $this->input->post('ifr_planned_date');
		$ifa_planned_date 				= $this->input->post('ifa_planned_date');
		$afc_planned_date					= $this->input->post('afc_planned_date');
		$ifi_planned_date					= $this->input->post('ifi_planned_date');
		$post											= $this->input->post();

		$form_data = array(
			'wp' 									=> $wp,
			'wu' 									=> $wu,
			'interface_doc' 			=> $interface_doc,
			'asb' 								=> $asb,
			'ctr_lead' 						=> $ctr_lead,
			'asb_planned_date'		=> $asb_planned_date,
			'ifr_planned_date' 		=> $ifr_planned_date,
			'ifa_planned_date' 		=> $ifa_planned_date,
			'afc_planned_date' 		=> $afc_planned_date,
			'ifi_planned_date' 		=> $ifi_planned_date,

			'afd_planned_date' 												=> $post['afd_planned_date'],
			'equipment_class' 												=> $post['equipment_class'],
			'equipment_subclass' 											=> $post['equipment_subclass'],
			'criticality' 														=> $post['criticality'],
			'originator_doc_number' 									=> $post['originator_doc_number'],
			'tag' 																		=> $post['tag'],
			'cable_tag' 															=> $post['cable_tag'],
			'line_tag' 																=> $post['line_tag'],
			'spp_tag' 																=> $post['spp_tag'],
			'mdr_update_information' 									=> $post['mdr_update_information'],
			'field_operations_delivrable'				 			=> $post['field_operations_delivrable'],
			'weight' 																	=> $post['weight'],
			'progress' 																=> $post['progress'],
			'contractor_transmittal_sheet_number' 		=> $post['contractor_transmittal_sheet_number'],
			'issue_date_contractor_transmittal_sheet' => $post['issue_date_contractor_transmittal_sheet'],
			'mdr_revision_request_nb' 								=> $post['mdr_revision_request_nb'],
			'fdb_volume' 															=> $post['fdb_volume'],
			'brownfield_interface' 										=> $post['brownfield_interface'],
			'folio_drawing' 													=> $post['folio_drawing'],
		);
		$where['id'] 			= $id;
		$this->production_mod->document_edit_process_db($form_data, $where);

		$this->session->set_flashdata('success', 'Your data has been Updated!');
		redirect('production/mdr_dc_detail/'.strtr($this->encryption->encrypt($id), '+=/', '.-~').'?t=p');
	}

	function mdr_design_list_json(){
		$where['status_delete'] 	= 1;
		$where['cetegory'] 				= 2;
		//filter
		if($this->input->post('submit')){
			if($this->input->post('project_id')){
				$where['project_id'] 	= $this->input->post('project_id');
			}
			if($this->input->post('module')){
				$where['module'] 	= $this->input->post('module');
			}
			if($this->input->post('discipline')){
				$where['discipline'] 	= $this->input->post('discipline');
			}
			if($this->input->post('code')){
				$where['code'] 	= $this->input->post('code');
			}
			if($this->input->post('class')){
				$where['class'] 	= $this->input->post('class');
			}
		}
		if($this->permission_eng_act[39] == '0'){
      $where['project_id'] 	= $this->user_cookie[10];
		}
		if(count($this->permission_discipline_view_data) > 0){
			$where['discipline IN ('.join(", ", $this->permission_discipline_view_data).')'] 	= NULL;
		}

		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$project_list[$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$module_list[$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ["discipline_code" => "ASC"]);
		foreach ($datadb as $value) {
			$discipline_list[$value['id']] = "(".$value['discipline_code'].") ".$value['discipline_name'];
		}

		// echo json_encode($where);exit;

    $lists 						= $this->production_mod->design_list_datatables('data', $where, 'MDR');
  	
  	$design_id = array();
  	foreach ($lists as $list){
  		if(!in_array($list->id, $design_id)){
  			$design_id[] = $list->id;
  		}
  	}
  	if(count($design_id) > 0){
  		$user_list = $this->user_name_data("SELECT DISTINCT upload_by as id_user FROM mdr_document WHERE id IN(".join(',', $design_id).")");
  	}

    $data = array();
    $no   = $_POST['start'];
    foreach ($lists as $list){

			$row   	= array();
			$row[] 	= $list->id;
    	$row[] 	= $list->ref_no;
    	$row[] 	= ($list->revision_no == '' ? '00' : $list->revision_no);
    	$row[] 	= $list->code;
    	$row[] 	= ($list->revision_date == '0000-00-00' ? date('Y-m-d', strtotime($list->upload_date)) : $list->revision_date);
			$row[] 	= $list->status_remark;
			$row[] 	= $list->class;
    	$row[] 	= $list->description;
    	$row[] 	= @$project_list[$list->project_id];
    	$row[] 	= @$discipline_list[$list->discipline];
    	$row[] 	= @$module_list[$list->module];
			$row[] 	= $list->document_type;
			$row[] 	= $list->system;
    	$row[] 	= @$user_list[$list->upload_by];
			$row[] 	= $list->upload_date;
			if($list->attachment == ""){
				$row[] 	= '<span class="text-danger font-weight-bold">No Data Available</span>';
			}
			else{
				$row[] 	= '<a target="_blank" href="'.base_url_ftp().'upload/production_design/file/'.$list->attachment.'" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a>';
			}
			$row[] 	= $list->transmittal_no;
			$row[] 	= ($list->transmittal_date == '0000-00-00' ? '' : $list->transmittal_date);
    	$row[] 	= $list->remarks;
    	$detrow 	= '<a href="'.base_url().'production/mdr_dc_detail/'.strtr($this->encryption->encrypt($list->id), '+=/', '.-~').'" target="_blank" class="btn btn-secondary" title="Detail"><i class="fas fa-file-alt"></i> Detail</a>';
    	if($this->permission_delete_data == 1){
    		$detrow .= ' <button type="button" onclick="delete_data(\''.strtr($this->encryption->encrypt($list->id), '+=/', '.-~').'\')" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i> Delete</button>';
    	}
    	$row[] 	= $detrow;
                 
      $data[] = $row;
    }
    
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->production_mod->design_list_datatables('count_all', $where, 'MDR'),
      "recordsFiltered" => $this->production_mod->design_list_datatables('count_filter', $where, 'MDR'),
      "data" => $data
    );
    //output to json format
    echo json_encode($output);
	}
	
	function mdr_design_list_excel(){
		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_name'];
		}

		$data['lists'] = $this->general_mod->manual_query_db("SELECT a.ref_no, a.description, a.project_id, a.discipline, a.module, a.remarks, b.revision_no, date(b.revision_date) as revision_date, b.code, b.status_remark, b.class, b.transmittal_no, b.transmittal_date, b.weight, b.progress, b.remarks FROM mdr_document a JOIN mdr_document_revision b ON a.id = b.id_document AND a.status_delete = 1 AND b.status_delete = 1 WHERE a.cetegory = 2 ORDER by a.ref_no ASC, b.revision_date DESC, b.transmittal_date DESC");

		$this->load->view('production/mdr_excel', $data);

		// test_var($lists);
	}

	function mdr_design_list_smop_excel(){
		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_code'];
		}

		$data['lists'] = $this->general_mod->manual_query_db("SELECT a.*, b.* FROM mdr_document a JOIN mdr_document_status b ON a.id = b.id_document AND a.status_delete = 1  WHERE a.cetegory = 2 ORDER by a.ref_no ASC, a.revision_date DESC, a.transmittal_date DESC");
		// test_var($data['lists']);
		$this->load->view('production/mdr_smop_excel', $data);

		// test_var($lists);
	}

	function mdr_design_list_smop_excel2(){
		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_code'];
		}
		$data_main = array();
		$data_ifr = array();
		$data_ifa = array();
		$data_afc = array();
		$data_ifi = array();

		$datadb = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE cetegory = 2 AND status_delete = 1 ORDER BY ref_no ASC");
		foreach ($datadb as $key => $value) {
			$data_main[$value['id']] = $value;
		}
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 2 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.status_remark = 'IFR' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_ifr[$value['id_document']])){
				$data_ifr[$value['id_document']] = $value;
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 2 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.status_remark = 'IFA' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_ifa[$value['id_document']])){
				$data_ifa[$value['id_document']] = $value;
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 2 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.status_remark = 'AFC' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_afc[$value['id_document']])){
				$data_afc[$value['id_document']] = $value;
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 2 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.status_remark = 'IFI' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_ifi[$value['id_document']])){
				$data_ifi[$value['id_document']] = $value;
			}
		}

		$data['lists'] = $data_main;
		$data['ifr'] = $data_ifr;
		$data['ifa'] = $data_ifa;
		$data['afc'] = $data_afc;
		$data['ifi'] = $data_ifi;
		// test_var($data);
		$this->load->view('production/mdr_smop_excel', $data);

		// test_var($lists);
	}

	function mdr_design_list_smop_excel3(){
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}
		$datadb  = $this->production_mod->vendor_master_list();
		foreach ($datadb as $value) {
			$data['vendor_list'][$value['vendor_code']] = $value['package_name'];
		}
		$data_main 							= array();
		$data_status 						= array();
		unset($where);
		$where['cetegory IN (2)'] = NULL;
		$where['status_delete'] = 1;
		if($this->input->post('project_id')){
			$where['project_id'] 	= $this->input->post('project_id');
		}
		if($this->input->post('module')){
			$where['module'] 	= $this->input->post('module');
		}
		if($this->input->post('discipline')){
			$where['discipline'] 	= $this->input->post('discipline');
		}
		if($this->input->post('code')){
			$where['code'] 	= $this->input->post('code');
		}
		if($this->input->post('class')){
			$where['class'] 	= $this->input->post('class');
		}
		unset($where);
		$where['main.cetegory IN (2)'] = NULL;
		$where['main.status_delete'] = 1;
		$where['t1.status_delete'] = 1;
		$datadb = $this->production_mod->document_main_planned_list($where);
		foreach ($datadb as $key => $value) {
			if(!isset($data_main[$value['cetegory']][$value['id']])){
				$data_main[$value['cetegory']][$value['id']] = $value;
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE id NOT IN (SELECT DISTINCT id_document FROM mdr_document_revision WHERE status_delete = 1) AND status_delete = 1 AND cetegory IN (2,3)");
		foreach ($datadb as $key => $value) {
			if(!isset($data_main[$value['cetegory']][$value['id']])){
				$data_main[$value['cetegory']][$value['id']] = $value;
			}
		}

		unset($where);
		$where['main.cetegory IN (2)'] = NULL;
		$where['main.status_delete'] = 1;
		$where['t1.status_delete'] = 1;
		$where["t1.status_remark IN ('IFR', 'IFA', 'AFC', 'IFI')"] = NULL;
		if($this->input->post('project_id')){
			$where['project_id'] 	= $this->input->post('project_id');
		}
		if($this->input->post('module')){
			$where['module'] 	= $this->input->post('module');
		}
		if($this->input->post('discipline')){
			$where['discipline'] 	= $this->input->post('discipline');
		}
		$datadb = $this->production_mod->document_main_revision_list($where);
		foreach ($datadb as $key => $value) {
			if(!isset($data_status[$value['cetegory']][$value['status_remark']][$value['id_document']])){
				$data_status[$value['cetegory']][$value['status_remark']][$value['id_document']] = $value;
			}
			if(!isset($vendor_transmittal[$value['transmittal_status']][$value['id_document']])){
				$vendor_transmittal[$value['transmittal_status']][$value['id_document']] = $value;
			}
		}

		if(isset($data_main[2])){
			$data['mdr_lists'] 			= $data_main[2];
			$data['mdr_status'] 		= $data_status[2];
		}
		$this->load->view('production/mdr_smop_excel3', $data);
	}

	// Vendor Package Document Control ===
	public function vendor_pack_dc_list(){

		$where['status'] = 1;
		$data = array(
            'project_chain' 		 => $this->general_mod->data_project($where),
            'module_chain' 			 => $this->general_mod->data_module(null),
           	'project_chain_selected' => '',
            'module_chain_selected'  => ''
        );
        unset($where);

		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}
		$datadb  = $this->m_vendor_mod->vendor_list(["status_delete" => 1, "category" => 1]);
		$vendor_list = [];
		foreach ($datadb as $value) {
			$vendor_list[$value['id_company']] = $value;
		}
		$data['vendor_list'] = $vendor_list;
		
		$data['read_cookies']   = $this->user_cookie;
    	$data['meta_title']     = 'Vendor Package List';
    	$data['subview']        = 'production/vendor_pack_dc_list';
  	  	$data['sidebar']        = $this->sidebar_vmdr;

  	  	

    	$this->load->view('index', $data);
	}

	public function vendor_pack_dc_new(){

		$where['status'] = 1;
		$data = array(
            'project_chain' 		 => $this->general_mod->data_project($where),
            'module_chain' 			 => $this->general_mod->data_module(null),
           	'project_chain_selected' => '',
            'module_chain_selected'  => ''
        );
        unset($where);

		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}

		$datadb  = $this->m_vendor_mod->vendor_list(["status_delete" => 1, "category" => 1]);
		$vendor_list = [];
		foreach ($datadb as $value) {
			$vendor_list[$value['id_company']] = $value;
		}
		$data['vendor_list'] = $vendor_list;
		
		$data['read_cookies']   = $this->user_cookie;
  		$data['meta_title']     = 'Add New Vendor Package';
  		$data['subview']        = 'production/vendor_pack_dc_new';
	  	$data['sidebar']        = $this->sidebar_vmdr;

  		$this->load->view('index', $data);
	}


	public function vendor_pack_dc_list_import(){
		$data['read_cookies']   = $this->user_cookie;
    	$data['meta_title']     = 'Import Vendor Package';
    	$data['subview']        = 'production/vendor_pack_dc_list_import';
  	  	$data['sidebar']        = $this->sidebar_vmdr;

    	$this->load->view('index', $data);
	}

	public function vendor_pack_dc_detail($id){
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}

		$datadb  = $this->m_vendor_mod->vendor_list(["status_delete" => 1, "category" => 1]);
		$vendor_list = [];
		foreach ($datadb as $value) {
			$vendor_list[$value['id_company']] = $value;
		}
		$data['vendor_list'] = $vendor_list;

		$id 														= $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		$data['document_list'] 					= $this->production_mod->document_list($id);
		$where['status_delete']					= '1';
		$where['id_document']						= $id;
		if($this->input->get('show')){
			$where['transmittal_status'] = $this->input->get('show');
		}
		$data['document_revision_list'] = $this->production_mod->document_revision_list(NULL, $where);

		$where = [
			'id_document'	=> $id
		];
		$datadb 				= $this->production_mod->reviewer_list($where);
		$approval 			= [];
		$reviewer_list 	= [];
		foreach ($datadb as $key => $value) {
			if($value['category'] == "Approval"){
				$approval = $value;
			}
			elseif($value['category'] == "Review"){
				$reviewer_list[] = $value;
			}
		}
		$data['approval'] 						= $approval;
		$data['reviewer_list'] 				= $reviewer_list;
		$data['reviewer_detail_list'] = $this->production_mod->reviewer_detail_list($where);
		$datadb 											= $this->general_mod->portal_user_db_list();
		$user_reviewer_list = [];
		foreach ($datadb as $key => $value) {
			$user_reviewer_list[$value['id_user']] = $value;
		}
		$data['user_reviewer_list'] 	= $user_reviewer_list;

		$data['user_rev_list'] 				= $this->user_name_data("SELECT DISTINCT revision_by as id_user FROM mdr_document_revision WHERE id_document = '".$id."'");
		
		if($this->input->get('t')){
			$data['t'] 	= $this->input->get('t');
		}else{
			$data['t'] 	= 'd';
		}
		$data['mws_list'] = $this->production_mod->find_document_mws($id);
		$data['dnv_list'] = $this->production_mod->find_document_dnv($id);
		$data['meta_title'] 	  = 'Design Document Detail';
		$data['subview']    	  = 'production/vendor_pack_dc_detail';
		$data['sidebar']    		= $this->sidebar_vmdr;
		$this->load->view('index', $data);
	}

	public function vendor_pack_dc_new_process(){
		$ref_no 				= $this->input->post('ref_no');
		$description 		= $this->input->post('description');
		$project_id 		= $this->input->post('project_id');
		$discipline 		= $this->input->post('discipline');
		$module 				= $this->input->post('module');
		$remarks 				= $this->input->post('remarks');
		$revision_no 		= $this->input->post('revision_no');
		$revision_date 	= $this->input->post('revision_date');
		$code 					= $this->input->post('code');
		$status_remark 	= $this->input->post('status_remark');
		$class 					= $this->input->post('class');
		$transmittal_no	= $this->input->post('transmittal_no');
		$transmittal_date	= $this->input->post('transmittal_date');
		$transmittal_status	= $this->input->post('transmittal_status');
		$vendor_code	  = $this->input->post('vendor_code');
		$po_number	    = $this->input->post('po_number');
		$same_ref 			= false;

		$where['ref_no'] 			= $ref_no;
		$where['status_delete'] = 1;
		$data_check 					= $this->production_mod->document_list(NULL, $where);
		if(count($data_check) > 0){
			$data_check					= $data_check[0];
			if($data_check['cetegory'] != 3){
				$this->session->set_flashdata('error', "Duplicate Reference Number on other category!");
				redirect('production/vendor_pack_dc_new/');
				return false;
			}
			$same_ref 					= true;
			if($data_check['revision_no'] == $revision_no){
				$this->session->set_flashdata('error', "Duplicate Reference Number with same Revision Number!");
				redirect('production/vendor_pack_dc_new/');
				return false;
			}
			$id_insert 					= $data_check['id'];
		}

		if (!empty($_FILES['file']['name'])) {
			$name_file 			= $this->user_cookie[0].'-'.$project_id.'-'.date('YmdHis');

			$config['upload_path']    = 'upload/production_design/file';
			$config['file_name']      = $name_file;
			$config['allowed_types']  = '*';
			// $config['max_size']       = '200000';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')){
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('production/vendor_pack_dc_list/');
				return false;
			}
			upload_ftp_server($config['upload_path']."/".$this->upload->data('file_name'), $config['upload_path']."/".$this->upload->data('file_name'));
		}

		if($same_ref == false){
			unset($form_data);
			$form_data = array(
				'ref_no' 				=> $ref_no,
				'description' 	=> $description,
				'project_id' 		=> $project_id,
		  	'discipline' 		=> $discipline,
		  	'module' 				=> $module,
		  	'upload_by' 		=> $this->user_cookie[0],
		  	'upload_date' 	=> date('Y-m-d H:i:s'),
		  	'attachment' 		=> $this->upload->data('file_name'),
		  	'revision_no' 	=> '-',
		  	'revision_date' => $revision_date,
		  	'code' 					=> $code,
		  	'status_remark' => $status_remark,
		  	'class' 				=> $class,
		  	'transmittal_no'=> $transmittal_no,
		  	'transmittal_date'=> $transmittal_date,
		  	'transmittal_status'=> $transmittal_status,
		  	'vendor_code'   => $vendor_code,
		  	'po_number'     => $po_number,
		  	'cetegory' 			=> 3,
		  	'remarks' 			=> $remarks,
			);
			$id_insert = $this->production_mod->document_new_process_db($form_data);
		}
		else{
			unset($form_data);
			unset($where);
			// $form_data = array(
			// 	'revision_no' 	=> $revision_no,
			// 	'revision_date' => $revision_date,
			// 	'code' 					=> $code,
			// 	'status_remark' => $status_remark,
			// 	'class' 				=> $class,
			// 	'transmittal_no'=> $transmittal_no,
			// 	'transmittal_date'=> $transmittal_date,
			// 	'vendor_code'   => $vendor_code,
			// 	'po_number'     => $po_number,
			// 	'upload_date' 	=> date('Y-m-d H:i:s'),
			// 	'attachment' 		=> $this->upload->data('file_name'),
			// );
			// $where['id'] 			= $id_insert;
			// $this->production_mod->document_edit_process_db($form_data, $where);
		}

		if($this->upload->data('file_name') != ""){
			unset($form_data);
			$form_data = array(
				'revision_no' 	=> $revision_no,
				'id_document' 	=> $id_insert,
				'revision_date' => $revision_date,
				'code' 					=> $code,
				'status_remark' => $status_remark,
				'class' 				=> $class,
				'transmittal_no'=> $transmittal_no,
				'transmittal_date'=> $transmittal_date,
				'transmittal_status'=> $transmittal_status,
				'vendor_code'   => $vendor_code,
				'po_number'     => $po_number,
				'attachment' 		=> $this->upload->data('file_name'),
				'remarks' 			=> $remarks,
				'revision_by' 	=> $this->user_cookie[0],
			);
			$this->production_mod->insert_data_pmt_document_revision($form_data);
			$this->change_to_newest($id_insert);
		}
		

		$this->session->set_flashdata('success', 'Your data has been Uploaded!');
		redirect('production/vendor_pack_dc_list/');
	}

	public function vendor_pack_document_revision_new_process(){
		$revision_no 				= $this->input->post('revision_no');
		$id_document 				= $this->input->post('id_document');
		$revision_date 			= $this->input->post('revision_date');
		$remarks 						= $this->input->post('remarks');
		$code 							= $this->input->post('code');
		$status_remark 			= $this->input->post('status_remark');
		$class							= $this->input->post('class');
		$transmittal_no			= $this->input->post('transmittal_no');
		$transmittal_date		= $this->input->post('transmittal_date');
		$transmittal_status	= $this->input->post('transmittal_status');
		$vendor_code  			= $this->input->post('vendor_code');
		$po_number			    = $this->input->post('po_number');

		$name_file 					= $this->user_cookie[0].'-'.date('YmdHis');

		$config['upload_path']    = 'upload/production_design/file';
		$config['file_name']      = $name_file;
		$config['allowed_types']  = '*';
		// $config['max_size']       = '200000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')){
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('production/vendor_pack_dc_detail/'.strtr($this->encryption->encrypt($id_document), '+=/', '.-~').'?t=r');
			return false;
		}
		upload_ftp_server($config['upload_path']."/".$this->upload->data('file_name'), $config['upload_path']."/".$this->upload->data('file_name'));

		$form_data = array(
			'revision_no' 	=> $revision_no,
			'code' 					=> $code,
			'status_remark' => $status_remark,
			'class' 				=> $class,
			'transmittal_no'=> $transmittal_no,
			'transmittal_date'=> $transmittal_date,
			'transmittal_status'=> $transmittal_status,
			'vendor_code'   => $vendor_code,
			'po_number'     => $po_number,
			'id_document' 	=> $id_document,
			'revision_date' => $revision_date,
  		'attachment' 		=> $this->upload->data('file_name'),
  		'remarks' 			=> $remarks,
  		'revision_by' 	=> $this->user_cookie[0],
		);
		$this->production_mod->insert_data_pmt_document_revision($form_data);

		// $form_data = array(
		// 	'revision_no' 	=> $revision_no,
		// 	'revision_date' => $revision_date,
		// 	'code' 					=> $code,
		// 	'status_remark' => $status_remark,
		// 	'class' 				=> $class,
		// 	'transmittal_no'=> $transmittal_no,
		// 	'transmittal_date'=> $transmittal_date,
		// 	'vendor_code'   => $vendor_code,
		// 	'po_number'     => $po_number,
		// 	'upload_date' 	=> date('Y-m-d H:i:s'),
		// 	'attachment' 		=> $this->upload->data('file_name'),
		// );
		// $where['id'] 			= $id_document;
		// $this->production_mod->document_edit_process_db($form_data, $where);
		$this->change_to_newest($id_document);

		$this->session->set_flashdata('success', 'Your data has been Uploaded!');

		redirect('production/vendor_pack_dc_detail/'.strtr($this->encryption->encrypt($id_document), '+=/', '.-~').'?t=r');
	}

	public function vendor_pack_document_edit_process(){
		$id 								= $this->input->post('id');
		$project_id 				= $this->input->post('project_id');
		$discipline 				= $this->input->post('discipline');
		$module 						= $this->input->post('module');
		$description 				= $this->input->post('description');
		$remarks 						= $this->input->post('remarks');
		$vendor_code 				= $this->input->post('vendor_code');
		$po_number 					= $this->input->post('po_number');

		$form_data = array(
			'project_id' 		=> $project_id,
			'discipline' 		=> $discipline,
			'module' 				=> $module,
			'description' 	=> $description,
			'description' 	=> $description,
			'remarks' 			=> $remarks,
			'vendor_code' 	=> $vendor_code,
			'po_number' 		=> $po_number,
		);
		$where['id'] 			= $id;
		$this->production_mod->document_edit_process_db($form_data, $where);

		$this->session->set_flashdata('success', 'Your data has been Updated!');
		redirect('production/vendor_pack_dc_detail/'.strtr($this->encryption->encrypt($id), '+=/', '.-~').'?t=d');
	}

	public function vendor_pack_document_planner_edit_process(){
		$id 											= $this->input->post('id');
		$wp 											= $this->input->post('wp');
		$wu 											= $this->input->post('wu');
		$interface_doc 						= $this->input->post('interface_doc');
		$asb 											= $this->input->post('asb');
		$ctr_lead 								= $this->input->post('ctr_lead');
		$asb_planned_date 				= $this->input->post('asb_planned_date');
		$ifr_planned_date 				= $this->input->post('ifr_planned_date');
		$ifa_planned_date 				= $this->input->post('ifa_planned_date');
		$afc_planned_date					= $this->input->post('afc_planned_date');
		$ifi_planned_date					= $this->input->post('ifi_planned_date');

		$form_data = array(
			'wp' 									=> $wp,
			'wu' 									=> $wu,
			'interface_doc' 			=> $interface_doc,
			'asb' 								=> $asb,
			'ctr_lead' 						=> $ctr_lead,
			'asb_planned_date'		=> $asb_planned_date,
			'ifr_planned_date' 		=> $ifr_planned_date,
			'ifa_planned_date' 		=> $ifa_planned_date,
			'afc_planned_date' 		=> $afc_planned_date,
			'ifi_planned_date' 		=> $ifi_planned_date,
		);
		$where['id'] 			= $id;
		$this->production_mod->document_edit_process_db($form_data, $where);

		$this->session->set_flashdata('success', 'Your data has been Updated!');
		redirect('production/vendor_pack_dc_detail/'.strtr($this->encryption->encrypt($id), '+=/', '.-~').'?t=p');
	}

	function vendor_pack_design_list_json(){
		$where['status_delete'] 	= 1;
		$where['cetegory'] 				= 3;
		//filter
		if($this->input->post('submit')){
			if($this->input->post('project_id')){
				$where['project_id'] 	= $this->input->post('project_id');
			}
			if($this->input->post('module')){
				$where['module'] 	= $this->input->post('module');
			}
			if($this->input->post('discipline')){
				$where['discipline'] 	= $this->input->post('discipline');
			}
			if($this->input->post('code')){
				$where['code'] 	= $this->input->post('code');
			}
			if($this->input->post('class')){
				$where['class'] 	= $this->input->post('class');
			}
			if($this->input->post('vendor')){
				$where['vendor_code'] 	= $this->input->post('vendor');
			}
			if($this->input->post('status_review') != ''){
				$where['status_review'] 	= $this->input->post('status_review');
			}
		}
		if($this->permission_eng_act[39] == '0'){
      $where['project_id'] 	= $this->user_cookie[10];
		}
		if(count($this->permission_discipline_view_data) > 0){
			$where['discipline IN ('.join(", ", $this->permission_discipline_view_data).')'] 	= NULL;
		}

		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$project_list[$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$module_list[$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$discipline_list[$value['id']] = $value['discipline_name'];
		}

		// echo json_encode($where);exit;

    $lists 						= $this->production_mod->design_list_datatables('data', $where, 'Vendor');
  	
  	$design_id = array();
  	$id_user = array();
  	foreach ($lists as $list){
  		if(!in_array($list->id, $design_id)){
  			$design_id[] = $list->id;
				if(!in_array($list->upload_by, $id_user)){
					$id_user[] = $list->upload_by;
				}
  		}
  	}
  	$reviewer = array();
  	if(count($design_id) > 0){
			$datadb = $this->production_mod->reviewer_list(["id_document IN(".join(',', $design_id).")" => NULL, "action" => 0]);
			foreach ($datadb as $key => $value) {
				if($value['category'] == "Approval" || @$reviewer[$value['id_document']]["category"] == "Approval"){
					$reviewer[$value['id_document']] = [
						"id_user" => $value['id_user'],
						"overdue_date" => $value['overdue_date'],
						"category" => $value['category'],
					];
					if(!in_array($value['id_user'], $id_user)){
						$id_user[] = $value['id_user'];
					}
				}
			}
  	}
		if(count($id_user) > 0){
  		$user_list = $this->user_name_data($id_user);
		}

    $data = array();
    $no   = $_POST['start'];
    foreach ($lists as $list){

			$row   	= array();
			$row[] 	= $list->id;
    	$row[] 	= $list->ref_no;
    	$row[] 	= ($list->revision_no == '' ? '00' : $list->revision_no);
    	$row[] 	= $list->code;
    	$row[] 	= ($list->revision_date == '0000-00-00' ? date('Y-m-d', strtotime($list->upload_date)) : $list->revision_date);
    	$row[] 	= $list->status_remark;
    	$row[] 	= $list->class;
    	$row[] 	= $list->description;
    	$row[] 	= @$project_list[$list->project_id];
    	$row[] 	= @$discipline_list[$list->discipline];
    	$row[] 	= @$module_list[$list->module];
    	$row[] 	= @$user_list[$list->upload_by];
    	$row[] 	= $list->upload_date;
			if($list->attachment == ""){
				$row[] 	= '<span class="text-danger font-weight-bold">No Data Available</span>';
			}
			else{
				$row[] 	= '<a target="_blank" href="'.base_url_ftp().'upload/production_design/file/'.$list->attachment.'" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a>';
			}
    	$row[] 	= $list->transmittal_no;
    	$row[] 	= $list->transmittal_date;
    	$row[] 	= $list->transmittal_status;
    	$row[] 	= $list->vendor_code;
    	$row[] 	= $list->po_number;

			if($list->status_review == 0){
				$row[] 	= "<span class='badge badge-secondary badge-pill'>Open</span>";
			}
			elseif($list->status_review == 1){
				$row[] 	= "<span class='badge badge-primary badge-pill'>Submitted</span>";
			}
			elseif($list->status_review == 2){
				$row[] 	= "<span class='badge badge-danger badge-pill'>Rejected</span>";
			}
			elseif($list->status_review == 3){
				$row[] 	= "<span class='badge badge-info badge-pill'>Reviewed</span>";
			}
			elseif($list->status_review == 4){
				$row[] 	= "<span class='badge badge-success badge-pill'>Completed</span>";
			}
			
			$overdue_text = "";
			if(in_array($list->status_review, [1, 3])){
				$overdue_text = @$reviewer[$list->id]["overdue_date"];
			}
			if($overdue_text != ""){
				if($overdue_text < date("Y-m-d")){
					$row["DT_RowClass"] 	= "bg-alert-warning";
					$overdue_text = "<b>".$overdue_text."</b>";
				}
			}
			$row[] 	= $overdue_text;
			$row[] 	= (in_array($list->status_review, [1, 3]) ? @$user_list[@$reviewer[$list->id]["id_user"]] : "");
			$row[] 	= $list->remarks;
    	$detrow 	= '<a target="_blank" href="'.base_url().'production/vendor_pack_dc_detail/'.strtr($this->encryption->encrypt($list->id), '+=/', '.-~').'" class="btn btn-secondary" title="Detail"><i class="fas fa-file-alt"></i> Detail</a>';
    	if($this->permission_delete_data == 1){
    		$detrow .= ' <button type="button" onclick="delete_data(\''.strtr($this->encryption->encrypt($list->id), '+=/', '.-~').'\')" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i> Delete</button>';
    	}
    	$row[] 	= $detrow;
                 
      $data[] = $row;
    }
    
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->production_mod->design_list_datatables('count_all', $where, 'Vendor'),
      "recordsFiltered" => $this->production_mod->design_list_datatables('count_filter', $where, 'Vendor'),
      "data" => $data
    );
    //output to json format
    echo json_encode($output);
	}
	
	function vendor_pack_design_list_excel(){
		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_name'];
		}

		$data['lists'] = $this->general_mod->manual_query_db("SELECT a.ref_no, a.description, a.project_id, a.discipline, a.module, a.remarks, b.revision_no, date(b.revision_date) as revision_date, b.code, b.status_remark, b.class, b.transmittal_no, b.transmittal_date, b.transmittal_status, b.vendor_code, b.po_number, b.remarks FROM mdr_document a JOIN mdr_document_revision b ON a.id = b.id_document WHERE a.cetegory = 3 AND a.status_delete = 1 AND b.status_delete = 1 ORDER by a.ref_no ASC, b.revision_date DESC, transmittal_date DESC");

		$this->load->view('production/vendor_pack_excel', $data);

		// test_var($lists);
	}
	
	function vendor_pack_design_list_smop_excel(){
		//master data
		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_code'];
		}
		$data_main = array();
		$data_from_vendor = array();
		$data_to_noc = array();
		$data_from_noc = array();
		$data_to_vendor = array();

		$datadb = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE cetegory = 3 AND status_delete = 1");
		foreach ($datadb as $key => $value) {
			$data_main[$value['id']] = $value;
		}
		// $datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.id = (SELECT t2.id FROM mdr_document_revision t2 WHERE t2.id_document = t1.id_document AND transmittal_status = 'FROM VENDOR' ORDER BY revision_date DESC, transmittal_date DESC LIMIT 1)");
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.transmittal_status = 'FROM VENDOR' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_from_vendor[$value['id_document']])){
				$data_from_vendor[$value['id_document']] = $value;
			}
		}
		// $datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.id = (SELECT t2.id FROM mdr_document_revision t2 WHERE t2.id_document = t1.id_document AND transmittal_status = 'TO NOC' ORDER BY revision_date DESC, transmittal_date DESC LIMIT 1)");
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.transmittal_status = 'TO NOC' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_to_noc[$value['id_document']])){
				$data_to_noc[$value['id_document']] = $value;
			}
		}
		// $datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.id = (SELECT t2.id FROM mdr_document_revision t2 WHERE t2.id_document = t1.id_document AND transmittal_status = 'FROM NOC' ORDER BY revision_date DESC, transmittal_date DESC LIMIT 1)");
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.transmittal_status = 'FROM NOC' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_from_noc[$value['id_document']])){
				$data_from_noc[$value['id_document']] = $value;
			}
		}
		// $datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.id = (SELECT t2.id FROM mdr_document_revision t2 WHERE t2.id_document = t1.id_document AND transmittal_status = 'TO VENDOR' ORDER BY revision_date DESC, transmittal_date DESC LIMIT 1)");
		$datadb = $this->general_mod->manual_query_db("SELECT t1.* FROM mdr_document main JOIN mdr_document_revision t1 ON main.id = t1.id_document WHERE main.cetegory = 3 AND main.status_delete = 1 AND t1.status_delete = 1 AND t1.transmittal_status = 'TO VENDOR' ORDER BY t1.revision_date DESC, t1.transmittal_date DESC");
		foreach ($datadb as $key => $value) {
			if(!isset($data_to_vendor[$value['id_document']])){
				$data_to_vendor[$value['id_document']] = $value;
			}
		}

		$data['lists'] = $data_main;
		$data['from_vendor'] = $data_from_vendor;
		$data['to_noc'] = $data_to_noc;
		$data['from_noc'] = $data_from_noc;
		$data['to_vendor'] = $data_to_vendor;
		// test_var($data);
		$this->load->view('production/vendor_pack_smop_excel', $data);

		// test_var($lists);
	}

	// Others
	public function user_name_data($query){
		if(is_array($query) != 1){
			$data = $this->general_mod->manual_query_db($query);
			$id_user = array();
			foreach ($data as $key => $value) {
				$id_user[] = $value['id_user'];
			}
		}
		else{
			$id_user = $query;
		}
		
		if(sizeof($id_user) > 0){
			$data = $this->general_mod->portal_user_db_id($id_user);
		}
		
		$result = array();
		if(@$data){
			foreach ($data as $key => $value) {
				$result[$value['id_user']] = $value['full_name'];
			}			
		}
		return $result;
	}

	public function mdr_download_multi_process(){
		$id_document 			= $this->input->post('id_document');
		$id_document 			= explode("; ", $id_document);

		$where['id IN ('.join(", ", $id_document).')'] = NULL;
		$document_list	= $this->production_mod->document_list(NULL, $where);
		foreach($document_list as $value){
			$ext 				= explode(".", $value['attachment']);
			$ext 				= end($ext);
			$name_file 	= $value['ref_no']." ".($value['revision_no'] == "" ? "00" : $value['revision_no']).".".$ext;
			$image 			= "upload/production_design/file/".$value['attachment'];
			$this->zip->read_file($image, NULL, $name_file);
		}

		$this->zip->download(''.time().'.zip');
	}

	public function delete_data_dc($category, $id){
		$id 							= $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		$form_data = array(
			'status_delete'				=> 0,
			'status_delete_by'		=> $this->user_cookie[0],
			'status_delete_date'	=> date('Y-m-d H:i:s'),
		);
		$where['id'] 			= $id;
		$this->production_mod->document_edit_process_db($form_data, $where);

		$this->session->set_flashdata('success','Your data has been Deleted!');
		if($category == 0){
			redirect("production/dc_list");
		}
		elseif($category == 1){
			redirect("production/smoe_dc_list");
		}
		elseif($category == 2){
			redirect("production/mdr_dc_list");
		}
		elseif($category == 3){
			redirect("production/vendor_pack_dc_list");
		}
	}

	public function change_data_rev_doc_prod(){
		// test_var();
		$id 					= $this->input->post('id');
		$id_document 	= $this->input->post('id_document');
		$content 			= $this->input->post('content');
		$column 			= $this->input->post('column');

		$form_data = array(
			$column 		=> $content,
		);
		$where['id'] 			= $id;
		$this->production_mod->document_revision_edit_process_db($form_data, $where);

		$this->change_to_newest($id_document, NULL, 1);
	}

	public function delete_data_rev_doc_prod($id, $id_document, $category = 3){
		// test_var();
		if($category == 3){
			$link_redirect = 'production/vendor_pack_dc_detail/';
		}
		if($category == 2){
			$link_redirect = 'production/mdr_dc_detail/';
		}
		$revision = $this->general_mod->manual_query_db("SELECT * FROM mdr_document_revision WHERE id_document = $id_document AND status_delete = 1 ORDER BY revision_date DESC, timestamp DESC");
		// test_var(count($revision));
		if(count($revision) > 1){
			$form_data = array(
				"status_delete" 		=> '0',
			);
			$where['id'] 			= $id;
			$this->production_mod->document_revision_edit_process_db($form_data, $where);
			
			$revision = $this->general_mod->manual_query_db("SELECT * FROM mdr_document_revision WHERE id_document = $id_document AND status_delete = 1 ORDER BY revision_date DESC, transmittal_date DESC");
			$revision = $revision[0];
			// test_var($revision);
			unset($form_data);
			unset($where);
			$form_data = array(
				'revision_no' 			=> $revision['revision_no'],
				'revision_date' 		=> $revision['revision_date'],
				'transmittal_no' 		=> $revision['transmittal_no'],
				'transmittal_date' 	=> $revision['transmittal_date'],
				'transmittal_status'=> $revision['transmittal_status'],
				'upload_date' 			=> $revision['timestamp'],
				'upload_by' 				=> $revision['revision_by'],
				'attachment' 				=> $revision['attachment'],
				'status_remark' => $revision['status_remark'],
				'class' 				=> $revision['class'],
				'vendor_code' 	=> $revision['vendor_code'],
				'po_number' 		=> $revision['po_number'],
				'remarks' 			=> $revision['remarks'],
			);

			$where['id'] 			= $id_document;
			$this->production_mod->document_edit_process_db($form_data, $where);
	
			$this->session->set_flashdata('success', 'Your data has been Deleted!');
			redirect($_SERVER['HTTP_REFERER'].'?t='.$revision['status_remark']);
		}
		else{
			$this->session->set_flashdata('error', 'Error: This document should have more than one revision!');
			redirect($_SERVER['HTTP_REFERER'].'?t=d');
		}
	}

	public function change_to_newest($id, $id_detail = NULL, $allow_downgrade = 0){
		$main = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE id = '$id' AND status_delete = 1");
		$sub = $this->general_mod->manual_query_db("SELECT * FROM mdr_document_revision WHERE id_document = '$id' AND status_delete = 1 ORDER BY revision_date DESC, transmittal_date DESC, id DESC LIMIT 1");

		$main = $main[0];
		$sub = $sub[0];

		if((strtotime($main['revision_date']) <= strtotime($sub['revision_date']) && strtotime($main['transmittal_date']) <= strtotime($sub['transmittal_date'])) || $allow_downgrade == 1){
			$form_data = array(
				'revision_no' 	=> $sub['revision_no'],
				'revision_date' => $sub['revision_date'],
				'code' 					=> $sub['code'],
				'status_remark' => $sub['status_remark'],
				'class' 				=> $sub['class'],
				'transmittal_no'=> $sub['transmittal_no'],
				'transmittal_date'=> $sub['transmittal_date'],
				'transmittal_status'=> $sub['transmittal_status'],
				'vendor_code'   => $sub['vendor_code'],
				'po_number'     => $sub['po_number'],
				'remarks' 			=> $sub['remarks'],
				'upload_date' 	=> $sub['timestamp'],
				'upload_by' 		=> $sub['revision_by'],
				'attachment' 		=> $sub['attachment'],
			);
			$where['id'] 			= $id;
			$this->production_mod->document_edit_process_db($form_data, $where);
		}
	}

	public function fixdataold(){
		// $main = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE status_delete = 1 AND cetegory  = 2");

		// foreach ($main as $key => $value) {
		// 	$this->change_to_newest($value['id']);
		// }

		// $main = $this->general_mod->manual_query_db("SELECT b.* FROM mdr_document a JOIN mdr_document_revision b ON a.id = b.id_document WHERE a.status_delete = 1 AND b.status_delete = 1 AND cetegory  = 2");
		$main = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE status_delete = 1 AND cetegory  = 2");
		echo "<pre>";
		foreach ($main as $key => $value) {
			unset($form_data);
			unset($where);
			$form_data = array(
				'transmittal_no'=> $value['remarks'],
				'remarks' 			=> $value['transmittal_no'],
			);
			$where['id'] 			= $value['id'];
			print_r(array($form_data, $where));
			$this->production_mod->document_edit_process_db($form_data, $where);
			// $this->production_mod->document_revision_edit_process_db($form_data, $where);
		}
		echo "</pre>";
	}

	public function mdr_definition_import_preview($cetegory){
		$id_user = $this->user_cookie[0];
		$config['upload_path']   = 'upload/production_design/template';
		$config['allowed_types'] = 'xlsx';
		$config['file_name'] = 'TemplateDefinition_By'.$id_user.date("ymdhis");

		//Load upload library
		$this->load->library('upload',$config);
		$this->upload->initialize($config); 

		// File upload
		if(!$this->upload->do_upload('file')){
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect("production/mdr_dc_list_import");
			return false;
		}
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excelreader 	= new PHPExcel_Reader_Excel2007();
		$loadexcel 	 	= $excelreader->load('upload/production_design/template/'.$this->upload->data('file_name')); // Load file yang telah diupload ke folder excel
		$sheet 		 		= $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$data_excel 	= array();
		foreach ($sheet as $key => $value) {
			if($key > 1){
				if(preg_replace('/\s+/', '', $value['A']) != ""){
					$data_tmp = $value;
					$data_tmp['A'] = preg_replace('/\s+/', '', $value['A']);
					$data_excel[] = $data_tmp;
				}
			}
		}
		$data['data_excel'] = $data_excel;

		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['project_code']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_desc']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['initial']] = $value;
		}
		unset($where);
		$where['status_delete'] 		= 1;
		$where['cetegory IN (2,3)'] = NULL;
		$datadb											= $this->production_mod->document_list(NULL, $where);
		foreach ($datadb as $key => $value) {
			$data['document_list'][$value['ref_no']] = $value;
		}
		$data['cetegory']		    = $cetegory;
		$data['meta_title']     = 'Import MDR Document Definition';
		$data['subview']        = 'production/mdr_definition_import_preview';
		$data['sidebar']        = $this->sidebar_mdr;
		if($cetegory == 3){
			$data['sidebar']      = $this->sidebar_vmdr;
		}
		$this->load->view('index', $data);
	}

	public function mdr_definition_import_process(){
		$post = $this->input->post();
		// test_var($post);
		$form_data = array();
		$date_now = date('Y-m-d H:i:s');
		foreach ($post['ref_no'] as $key => $value) {
			$form_data[] = array(
				'ref_no' 					=> $post['ref_no'][$key],
				'description' 		=> $post['description'][$key],
				'country' 				=> $post['country'][$key],
				'project_id' 			=> $post['project_id'][$key],
				'discipline' 			=> $post['discipline'][$key],
				'module' 					=> $post['module'][$key],
				'document_type' 	=> $post['document_type'][$key],
				'system'					=> $post['system'][$key],
				'subsystem' 			=> $post['subsystem'][$key],
				'generator' 			=> $post['generator'][$key],
				'vendor_code' 		=> $post['vendor_code'][$key],
				'po_number' 			=> $post['po_number'][$key],
				'cetegory' 				=> $post['cetegory'],
				'upload_by' 			=> $this->user_cookie[0],
				'upload_date' 		=> $date_now,
				'revision_no' 		=> '-',
				'remarks' 				=> $post['remarks'][$key],
			);
		}
		if($post['cetegory'] == 2){
			$link = "production/mdr_dc_list_import";
		}
		elseif($post['cetegory'] == 3){
			$link = "production/vendor_pack_dc_list_import";
		}
		if(count($form_data) > 0){
			$this->production_mod->document_import_process_db($form_data);
			$this->session->set_flashdata('success', 'Your Data has been imported!');
			redirect($link);
			return false;
		}
		else{
			$this->session->set_flashdata('error', 'No Data to Imported!');
			redirect($link);
			return false;
		}
	}

	public function mdr_status_progress_import_preview(){
		$id_user = $this->user_cookie[0];
		$config['upload_path']   = 'upload/production_design/template';
		$config['allowed_types'] = 'xlsx';
		$config['file_name'] = 'TemplateStatusProgress_By'.$id_user.date("ymdhis");

		//Load upload library
		$this->load->library('upload',$config);
		$this->upload->initialize($config); 

		// File upload
		if(!$this->upload->do_upload('file_excel')){
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect("production/mdr_dc_list_import");
			return false;
		}
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excelreader 	= new PHPExcel_Reader_Excel2007();
		$loadexcel 	 	= $excelreader->load('upload/production_design/template/'.$this->upload->data('file_name')); // Load file yang telah diupload ke folder excel
		$sheet 		 		= $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$data_excel 	= array();
		$file_exist  	= array();

		foreach ($sheet as $key => $value) {
			if($key > 1){
				if(preg_replace('/\s+/', '', $value['A']) != ""){
					$data_tmp = $value;
					$data_tmp['A'] = preg_replace('/\s+/', '', $value['A']);
					$data_tmp['status'] = '';
					if(isset($file_exist[$data_tmp['J']])){
						$data_tmp['status'] = 'Failed Upload file : Duplicate Filename attachment in excel!';
					}
					elseif(count(array_keys($_FILES['file_attachments']['name'], $data_tmp['J'])) > 0){
						$file_exist[$data_tmp['J']] = 'Ada';
					}
					$data_excel[] = $data_tmp;
				}
			}
		}
		$data['data_excel'] = $data_excel;
		// test_var($_FILES['file_attachments']);
		$data_file = array();
		$countfiles = count($_FILES['file_attachments']['name']);
		for($i=0;$i<$countfiles;$i++){
			if(!empty($_FILES['file_attachments']['name'][$i])){
				if(isset($file_exist[$_FILES['file_attachments']['name'][$i]])){
					$_FILES['file']['name'] 		= $_FILES['file_attachments']['name'][$i];
					$_FILES['file']['type'] 		= $_FILES['file_attachments']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['file_attachments']['tmp_name'][$i];
					$_FILES['file']['error'] 		= $_FILES['file_attachments']['error'][$i];
					$_FILES['file']['size'] 		= $_FILES['file_attachments']['size'][$i];

					unset($config);
					$config['upload_path'] = 'upload/production_design/file'; 
					$config['allowed_types'] = '*';
					// $config['max_size'] = '5000'; // max_size in kb
					$config['file_name'] = $this->user_cookie[0].'-'.$i.'-'.date('YmdHis');
					$this->load->library('upload',$config);
					$this->upload->initialize($config); 
					if(!$this->upload->do_upload('file')){
						$file_exist[$_FILES['file_attachments']['name'][$i]] = 'Failed Upload file : '.$this->upload->display_errors();
					}
					else{
						upload_ftp_server($config['upload_path']."/".$this->upload->data('file_name'), $config['upload_path']."/".$this->upload->data('file_name'));
						$file_exist[$_FILES['file_attachments']['name'][$i]] = $this->upload->data('file_name');
					}
				}
			}
		}
		$data['file_exist'] 		= $file_exist;

		
		unset($where);
		$where['t1.status_delete'] 				= 1;
		$where['main.status_delete'] 			= 1;
		$where['main.cetegory IN (2,3)'] 	= NULL;
		$datadb														= $this->production_mod->get_doc_rev_all($where);
		$id_document_list									= array();
		foreach ($datadb as $key => $value) {
			$data['document_list'][$value['ref_no']][$value['revision_no']][$value['transmittal_no']] = $value;
			$id_document_list[$value['ref_no']] = $value['id_document'];
		}
		$datadb = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE id NOT IN (SELECT DISTINCT id_document FROM mdr_document_revision WHERE status_delete = 1) AND status_delete = 1 AND cetegory IN (2,3)");
		foreach ($datadb as $key => $value) {
			$data['document_list'][$value['ref_no']]["0"]["0"] = $value;
			$id_document_list[$value['ref_no']] = $value['id'];
		}

		$data['id_document_list'] = $id_document_list;

		$data['meta_title']     = 'Import MDR Document Definition';
		$data['subview']        = 'production/mdr_status_progress_import_preview';
		$this->load->view('index', $data);
	}

	public function mdr_status_progress_import_process(){
		$date_now = date('Y-m-d H:i:s');
		$post = $this->input->post();
		$doc = [];
		$document_list = $this->production_mod->checking_data_doc();
		foreach ($document_list as $key => $value) {
			$doc[$value['id']] = $value;
		}
		foreach ($post['id_document'] as $key => $value) {
			unset($form_data);
			$form_data = array(
				'id_document' 				=> $post['id_document'][$key],
				'revision_no' 				=> $post['revision_no'][$key],
				'revision_by' 				=> $this->user_cookie[0],
				'revision_date' 			=> $post['revision_date'][$key],
				'code' 						=> $post['code'][$key],
				'status_remark' 			=> $post['status_remark'][$key],
				'class' 					=> $post['class'][$key],
				'transmittal_no' 			=> $post['transmittal_no'][$key],
				'transmittal_date' 			=> $post['transmittal_date'][$key],
				'transmittal_status' 		=> $post['transmittal_status'][$key],
				'attachment' 				=> $post['attachment'][$key],
				'remarks' 					=> $post['remarks'][$key],
				'timestamp' 				=> $date_now,
			);
			$this->production_mod->insert_data_pmt_document_revision($form_data);

			unset($form_data);
			unset($where);
			$doc_check = $doc[$post['id_document'][$key]];
			
			if (strtotime($post['revision_date'][$key]) > strtotime($doc_check['revision_date']) && strtotime($post['transmittal_date'][$key]) > strtotime($doc_check['transmittal_date'])) {
				
				$form_data = array(
					'revision_no' 				=> $post['revision_no'][$key],
					'upload_by'		 				=> $this->user_cookie[0],
					'upload_date'		 			=> $date_now,
					'revision_date' 			=> $post['revision_date'][$key],
					'code' 						=> $post['code'][$key],
					'status_remark' 			=> $post['status_remark'][$key],
					'class' 					=> $post['class'][$key],
					'transmittal_no' 			=> $post['transmittal_no'][$key],
					'transmittal_date' 			=> $post['transmittal_date'][$key],
					'transmittal_status' 		=> $post['transmittal_status'][$key],
					'attachment' 					=> $post['attachment'][$key],
					'remarks' 						=> $post['remarks'][$key],
				);
				$where['id'] = $post['id_document'][$key];
				$this->production_mod->document_edit_process_db($form_data, $where);
			}
		}

		$this->session->set_flashdata('success', 'Your Data has been imported!');
		redirect("production/mdr_dc_list_import");
		return false;
	}

	public function mws_upload_preview() {
		$id_user = $this->user_cookie[0];
		if($_FILES['mws_template']['name'] != ""){
 
			$_FILES['file']['name'] 	 = $_FILES['mws_template']['name'];
			$_FILES['file']['type'] 	 = $_FILES['mws_template']['type'];
			$_FILES['file']['tmp_name']  = $_FILES['mws_template']['tmp_name'];
			$_FILES['file']['error']     = $_FILES['mws_template']['error'];
			$_FILES['file']['size']      = $_FILES['mws_template']['size'];

			$config['upload_path']   = 'upload/production_design/template';
			$config['allowed_types'] = 'xlsx';
			$config['file_name'] = 'TemplateMWS_By'.$id_user.date("ymdhis");
			$filename_to_call = 'TemplateMWS_By'.$id_user.date("ymdhis");

			//Load upload library
			$this->load->library('upload',$config);
			$this->upload->initialize($config); 

			// File upload
			if($this->upload->do_upload('mws_template')){
				  // Get data about the file
				  $uploadDatax = $this->upload->data();

				  //print_r($datax);
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
			  redirect("production/mdr_dc_list_import");
			  return false;
			}

			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel 	 = $excelreader->load('upload/production_design/template/'.$filename_to_call.".xlsx"); // Load file yang telah diupload ke folder excel
			$sheet 		 = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			$data_export = [];
			$check = [];
			$dup_data = [];
			$duplicate = false;
			$doc_no_found = false;
			$total_not_found = 0;
			$validate = [];
			$docs = $this->production_mod->find_document_pmt();
			foreach ($docs as $key => $value) {
				$doct[$value['ref_no']] = $value;
			}
			
			foreach ($sheet as $key => $value) {
				$duplicate = false;
				if($key != 1 && $value['A'] != "") {
					// $doc = $this->production_mod->find_document_id(str_replace(" ","", $value['A']));
					$doc = isset($doct[str_replace(" ","", $value['A'])]) ? $doct[str_replace(" ","", $value['A'])] : null;
					$validate = [
						'A' => str_replace(" ","", $value['A']),
						'B' => isset($value['B']) ? $value['B'] : null,
						'C' => isset($value['C']) ? $value['C'] : null,
						'D' => isset($value['D']) ? $value['D'] : null,
						'E' => isset($value['E']) ? $value['E'] : null,
						'F' => isset($value['F']) ? $value['F'] : null,
						'G' => isset($value['G']) ? $value['G'] : null,
						'H' => isset($value['H']) ? $value['H'] : null,
						'I' => isset($value['I']) ? $value['I'] : null,
					];
					$array_validate = [$validate['A'],$validate['B'],$validate['C'],$validate['D'],$validate['E'],$validate['F'],$validate['G'],$validate['H'],$validate['I']];
					if($doc) {
						
						if(in_array($array_validate, $check)) {
							$duplicate = true;
							$dup_data[] = $validate;
						}
						$data_export[] = [
							'found' => $doc_no_found,
							'duplicate' => $duplicate,
							'data' => $validate
						];
						
					} else {
						$total_not_found++;
						$data_export[] = [
							'found' => true,
							'duplicate' => $duplicate,
							'data' => $validate
						];
					}
					$check[] = $array_validate;
				}

			}
			$data['total_not_found'] = $total_not_found;
			$data['total_data'] = count($data_export);
			$data['dup_data'] = count($dup_data);
			$data['meta_title']     = 'Import MDR';
			$data['subview']        = 'production/mws_upload_preview';
			$data['export'] 	= $data_export;
			$this->load->view('index', $data);
	  }

	}

	public function process_submit_mws(){
		log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Import MWS ');

		$user = $this->user_cookie;
		$ref_no = $this->input->post('ref_no');
		$mark_up = $this->input->post('mark_up');
		$ts_out_no = $this->input->post('ts_out_no');
		$ts_out_date = $this->input->post('ts_out_date');
		$doc_revision = $this->input->post('doc_revision');
		$review_status = $this->input->post('review_status');
		$ts_in_no = $this->input->post('ts_in_no');
		$ts_in_date = $this->input->post('ts_in_date');	
		$remarks = $this->input->post('remarks');	
		$data_to_submit = [];
		$dup_data = [];
		$form_data = [];
		$docs = $this->production_mod->find_document_pmt();
			foreach ($docs as $key => $value) {
				$doct[$value['ref_no']] = $value;
			}
		
		foreach ($ref_no as $key => $value) {
			// $doc = $this->production_mod->find_document_id(trim($value));
			$doc = isset($doct[trim($value)]) ? $doct[trim($value)] : null;
			
			if($doc) { 
				$data_to_submit = [
					'ref_no' => $doc['id'],
					'mark_up' => $mark_up[$key],
					'ts_out_no' => $ts_out_no[$key],
					'ts_out_date' => $ts_out_date[$key],
					'doc_revision' => $doc_revision[$key],
					'review_status' => $review_status[$key],
					'ts_in_no' => $ts_in_no[$key],
					'upload_by' => $user[0],
					'ts_in_date' => $ts_in_date[$key],
					'remarks' => $remarks[$key]
				];
				$check = $this->production_mod->check_duplicate_mws($data_to_submit);
				if($check) {
					$dup_data[$key] = $data_to_submit;
				} else {
					$form_data[] = $data_to_submit;
				}
			}


		}

		if(!empty($dup_data)) {
			$data = [
				'success' => false,
				'duplicate' => $dup_data
			];
		} else {
			$this->production_mod->process_submit_mws($form_data);
			$data = [
				'success' => true,
				'redirect' => site_url('production/redirect/MWS')
			]; 
		}
		
		echo json_encode($data);
		exit;
	}


	public function dnv_upload_preview() {
		$id_user = $this->user_cookie[0];
		if($_FILES['dnv_template']['name'] != ""){
 
			$_FILES['file']['name'] 	 = $_FILES['dnv_template']['name'];
			$_FILES['file']['type'] 	 = $_FILES['dnv_template']['type'];
			$_FILES['file']['tmp_name']  = $_FILES['dnv_template']['tmp_name'];
			$_FILES['file']['error']     = $_FILES['dnv_template']['error'];
			$_FILES['file']['size']      = $_FILES['dnv_template']['size'];

			$config['upload_path']   = 'upload/production_design/template';
			$config['allowed_types'] = 'xlsx';
			$config['file_name'] = 'TemplateDNV_By'.$id_user.date("ymdhis");
			$filename_to_call = 'TemplateDNV_By'.$id_user.date("ymdhis");

			//Load upload library
			$this->load->library('upload',$config);
			$this->upload->initialize($config); 

			// File upload
			if($this->upload->do_upload('dnv_template')){
				  // Get data about the file
				  $uploadDatax = $this->upload->data();

				  //print_r($datax);
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
			  redirect("production/mdr_dc_list_import");
			  return false;
			}

			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel 	 = $excelreader->load('upload/production_design/template/'.$filename_to_call.".xlsx"); // Load file yang telah diupload ke folder excel
			$sheet 		 = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			$data_export = [];
			$check = [];
			$dup_data = [];
			$array_validate = [];
			$duplicate = false;
			$doc_no_found = false;
			$validate = [];
			$total_not_found = 0;
			$docs = $this->production_mod->find_document_pmt();
			foreach ($docs as $key => $value) {
				$doct[$value['ref_no']] = $value;
			}
			foreach ($sheet as $key => $value) {
			$duplicate = false;
				if($key != 1 && $value['A'] != "") {
					// $doc = $this->production_mod->find_document_id(str_replace(" ","", $value['A']));
					$doc = isset($doct[str_replace(" ","", $value['A'])]) ? $doct[str_replace(" ","", $value['A'])] : null;
					$validate = [
						'A' => str_replace(" ","", $value['A']),
						'B' => isset($value['B']) ? $value['B'] : null,
						'C' => isset($value['C']) ? $value['C'] : null,
						'D' => isset($value['D']) ? $value['D'] : null,
						'E' => isset($value['E']) ? $value['E'] : null,
						'F' => isset($value['F']) ? $value['F'] : null,
						'G' => isset($value['G']) ? $value['G'] : null,
						'H' => isset($value['H']) ? $value['H'] : null,
						'I' => isset($value['I']) ? $value['I'] : null,
					];
					$array_validate = [$validate['A'],$validate['B'],$validate['C'],$validate['D'],$validate['E'],$validate['F'],$validate['G'],$validate['H'],$validate['I']];
					if($doc) {
						
						if(in_array($array_validate, $check)) {
							$duplicate = true;
							$dup_data[] = $validate;
						}
						$data_export[] = [
							'found' => $doc_no_found,
							'duplicate' => $duplicate,
							'data' => $validate
						];
						
					} else {
						$total_not_found++;
						$data_export[] = [
							'found' => true,
							'duplicate' => $duplicate,
							'data' => $validate
						];
					}
					$check[] = $array_validate;
				}

			}


			$data['total_not_found'] = $total_not_found;
			$data['total_data'] = count($data_export);
			$data['dup_data'] = count($dup_data);
			$data['meta_title']     = 'Import DNV';
			$data['subview']        = 'production/dnv_upload_preview';
			$data['export'] 	= $data_export;

			$this->load->view('index', $data);
	  }

	}

	public function process_submit_dnv(){
		log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Import DNV ');


		$user = $this->user_cookie;
		$ref_no = $this->input->post('ref_no');
		$mark_up = $this->input->post('mark_up');
		$ts_out_no = $this->input->post('ts_out_no');
		$ts_out_date = $this->input->post('ts_out_date');
		$doc_revision = $this->input->post('doc_revision');
		$review_status = $this->input->post('review_status');
		$ts_in_no = $this->input->post('ts_in_no');
		$ts_in_date = $this->input->post('ts_in_date');	
		$remarks = $this->input->post('remarks');	
		$data_to_submit = [];
		$dup_data = [];
		$form_data = [];
		$docs = $this->production_mod->find_document_pmt();
			foreach ($docs as $key => $value) {
				$doct[$value['ref_no']] = $value;
			}
		foreach ($ref_no as $key => $value) {
			// $doc = $this->production_mod->find_document_id(trim($value));
			$doc = isset($doct[trim($value)]) ? $doct[trim($value)] : null;
			if($doc) {
				$data_to_submit = [
					'ref_no' => $doc['id'],
					'mark_up' => $mark_up[$key],
					'ts_out_no' => $ts_out_no[$key],
					'ts_out_date' => $ts_out_date[$key],
					'doc_revision' => $doc_revision[$key],
					'review_status' => $review_status[$key],
					'ts_in_no' => $ts_in_no[$key],
					'upload_by' => $user[0],
					'ts_in_date' => $ts_in_date[$key],
					'remarks' => $remarks[$key]

				];
				$check = $this->production_mod->check_duplicate_dnv($data_to_submit);
			if($check) {
				$dup_data[$key] = $data_to_submit;
			} else {
				$form_data[] = $data_to_submit;
			}
			}
		}

		if(!empty($dup_data)) {
			$data = [
				'success' => false,
				'duplicate' => $dup_data
			];
		} else {
			$this->production_mod->process_submit_dnv($form_data);
			$data = [
				'success' => true,
				'redirect' => site_url('production/redirect/DNV')
			]; 
		}
		
		echo json_encode($data);
		exit;
	
	}

	public function planner_upload_preview(){
		$id_user = $this->user_cookie[0];
		if($_FILES['planner_template']['name'] != ""){
			$_FILES['file']['name'] 	 = $_FILES['planner_template']['name'];
			$_FILES['file']['type'] 	 = $_FILES['planner_template']['type'];
			$_FILES['file']['tmp_name']  = $_FILES['planner_template']['tmp_name'];
			$_FILES['file']['error']     = $_FILES['planner_template']['error'];
			$_FILES['file']['size']      = $_FILES['planner_template']['size'];

			$config['upload_path']   = 'upload/production_design/template';
			$config['allowed_types'] = 'xlsx';
			$config['file_name'] = 'Templateplanner_By'.$id_user.date("ymdhis");
			$filename_to_call = 'Templateplanner_By'.$id_user.date("ymdhis");

			//Load upload library
			$this->load->library('upload',$config);
			$this->upload->initialize($config); 

			// File upload
			if($this->upload->do_upload('planner_template')){
				  // Get data about the file
				  $uploadDatax = $this->upload->data();

				  //print_r($datax);
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
			  redirect("production/mdr_dc_list_import");
			  return false;
			}

			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel 	 = $excelreader->load('upload/production_design/template/'.$filename_to_call.".xlsx"); // Load file yang telah diupload ke folder excel
			$sheet 		 = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			$data_export = [];
			$check = [];
			$dup_data = [];
			$duplicate = false;
			$doc_no_found = false;
			$validate = [];
			$total_not_found = 0;
			foreach ($sheet as $key => $value) {
			$duplicate = false;
				if($key != 1 && $value['A'] != "") {
					$doc = $this->production_mod->find_document_id(str_replace(" ","", $value['A']));
					$validate = [
						'A' => str_replace(" ","", $value['A']),
						'B' => $value['B'],
						'C' => $value['C'],
						'D' => $value['D'],
						'E' => $value['E'],
						'F' => $value['F'],
						'G' => $value['G'],
						'H' => $value['H'],
						'I' => $value['I'],
						'J' => $value['J'],
						'K' => $value['K'],
					];
					if($doc) {
						$data_export[] = [
							'not_found' => $doc_no_found,
							'data' => $validate
						];
					} else {
						$total_not_found++;
						$data_export[] = [
							'not_found' => true,
							'data' => $validate
						];
					}
				}

			}
			$data['total_not_found'] = $total_not_found;
			$data['total_data'] = count($data_export);
			$data['dup_data'] = count($dup_data);
			$data['meta_title']     = 'Import Planner';
			$data['subview']        = 'production/planner_upload_preview';
			$data['export'] 	= $data_export;

			$this->load->view('index', $data);
	  }

	}

	public function proceed_submit_planner(){
		log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Import planner ');
		$post = $this->input->post();
		$ref_no = $this->input->post('ref_no');
		$wp = $this->input->post('wp');
		$wu = $this->input->post('wu');
		$ctr_lead = $this->input->post('ctr_lead');
		$interface_doc = $this->input->post('interface_doc');
		$asb = $this->input->post('asb');
		$ifr_planned_date = $this->input->post('ifr_planned_date');
		$ifa_planned_date = $this->input->post('ifa_planned_date');
		$afc_planned_date = $this->input->post('afc_planned_date');
		$asb_planned_date = $this->input->post('asb_planned_date');
		$ifi_planned_date = $this->input->post('ifi_planned_date');
		foreach ($ref_no as $key => $value) {
			$doc = $this->production_mod->find_document_id(trim($value));
			if($doc) {
				$data_to_submit = [
					'wp' => $wp[$key],
					'wu' => $wu[$key],
					'ctr_lead' => $ctr_lead[$key],
					'interface_doc' => $interface_doc[$key],
					'asb' => $asb[$key],
					'ifr_planned_date' => $ifr_planned_date[$key],
					'ifa_planned_date' => $ifa_planned_date[$key],
					'afc_planned_date' => $afc_planned_date[$key],
					'asb_planned_date' => $asb_planned_date[$key],
					'ifi_planned_date' => $ifi_planned_date[$key],

					'afd_planned_date' 												=> $post['afd_planned_date'][$key],
					'equipment_class' 												=> $post['equipment_class'][$key],
					'equipment_subclass' 											=> $post['equipment_subclass'][$key],
					'criticality' 														=> $post['criticality'][$key],
					'originator_doc_number' 									=> $post['originator_doc_number'][$key],
					'tag' 																		=> $post['tag'][$key],
					'cable_tag' 															=> $post['cable_tag'][$key],
					'line_tag' 																=> $post['line_tag'][$key],
					'spp_tag' 																=> $post['spp_tag'][$key],
					'mdr_update_information' 									=> $post['mdr_update_information'][$key],
					'field_operations_delivrable'				 			=> $post['field_operations_delivrable'][$key],
					'weight' 																	=> $post['weight'][$key],
					'progress' 																=> $post['progress'][$key],
					'contractor_transmittal_sheet_number' 		=> $post['contractor_transmittal_sheet_number'][$key],
					'issue_date_contractor_transmittal_sheet' => $post['issue_date_contractor_transmittal_sheet'][$key],
					'mdr_revision_request_nb' 								=> $post['mdr_revision_request_nb'][$key],
					'fdb_volume' 															=> $post['fdb_volume'][$key],
					'brownfield_interface' 										=> $post['brownfield_interface'][$key],
					'folio_drawing' 													=> $post['folio_drawing'][$key],
				];
				$this->production_mod->update_planner($data_to_submit, $doc['id']);
			}
		}
		$data = [
			'success' => true,
			'redirect' => site_url('production/redirect/Planner')
		];
		
		echo json_encode($data); 
	}

	public function multiple_delete_mdr(){
		$user_id = $this->user_cookie[0];
		$delete_date = date("Y-m-d H:i:s");
		$status_delete = 0;
		$ref_no = $this->input->post('ref_no');
		$data = [
			'status_delete' => $status_delete,
			'status_delete_by' => $user_id,
			'status_delete_date' => $delete_date	
		];
		foreach ($ref_no as $key => $value) {
			$this->production_mod->update_document_status_to_delete($data, $value);
		}
		log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Delete document number '.json_encode($ref_no));

		$this->session->set_flashdata('success','Successfully delete MDR');
		redirect('production/mdr_dc_list');
	}

	public function multiple_delete_vendor(){
		$user_id = $this->user_cookie[0];
		$delete_date = date("Y-m-d H:i:s");
		$status_delete = 0;
		$ref_no = $this->input->post('ref_no');
		$data = [
			'status_delete' => $status_delete,
			'status_delete_by' => $user_id,
			'status_delete_date' => $delete_date	
		];
		foreach ($ref_no as $key => $value) {
			$this->production_mod->update_document_status_to_delete($data, $value);
		}
		log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Delete document number '.json_encode($ref_no));
		$this->session->set_flashdata('success','Successfully delete Vendor');
		redirect('production/vendor_pack_dc_list');
	}

	public function multiple_delete_mdr_revision(){
		$document_number = $this->input->post('document_number');
		$id_rev = $this->input->post('id_rev');
		$total_rev = count($id_rev);

		if($total_rev < 1){
			$this->session->set_flashdata('error', 'Error: You didnt select any revision to delete, Please Try Again!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$total_current_rev = $this->production_mod->find_total_document_revision($document_number);
		if($total_rev >= $total_current_rev) {
			$this->session->set_flashdata('error', 'Error: Cannot delete all revision,  This document should have more than one revision!');
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$user_id = $this->user_cookie[0];
			$delete_date = date("Y-m-d H:i:s");
			$status_delete = 0;
			$ref_no = $this->input->post('ref_no');
			$data = [
				'status_delete' => $status_delete,
				'status_delete_by' => $user_id,
				'status_delete_date' => $delete_date	
			];
			$this->production_mod->update_revision_status_to_delete($data, $id_rev);
			log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Delete revision '.json_encode($id_rev).' on table mdr_document_revision');
		}
		$this->session->set_flashdata('success', 'Successfully delete document revision');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function multiple_delete_vendor_revision(){
		$document_number = $this->input->post('document_number');
		$id_rev = $this->input->post('id_rev');
		$total_rev = count($id_rev);
		$total_current_rev = $this->production_mod->find_total_document_revision($document_number);
		if($total_rev >= $total_current_rev) {
			$this->session->set_flashdata('error', 'Error: Cannot delete all revision,  This document should have more than one revision!');
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$user_id = $this->user_cookie[0];
			$delete_date = date("Y-m-d H:i:s");
			$status_delete = 0;
			$ref_no = $this->input->post('ref_no');
			$data = [
				'status_delete' => $status_delete,
				'status_delete_by' => $user_id,
				'status_delete_date' => $delete_date	
			];
			$this->production_mod->update_revision_status_to_delete($data, $id_rev);
			log_message('LOG', 'User '.$this->user_cookie[0].' - '.$this->user_cookie[1].' Delete revision '.json_encode($id_rev).' on table mdr_document_revision');
		}
		
		$this->session->set_flashdata('success', 'Successfully delete document revision');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function redirect($param){
		$this->session->set_flashdata("success", "Successfully import $param  Data");
		redirect('production/mdr_dc_list_import');
	}

	public function vendor_review_update_user_process(){
		$post = $this->input->post();
		$date_now = date("Y-m-d H:i:s");
		if($post['approval'] != "" && $post['id_approval'] == ""){
			$form_data = [
				'id_document' => $post['id_document'],
				'id_user' 		=> $post['approval'],
				'overdue_date'=> $post['approval_overdue'],
				'category' 		=> "Approval",
				'update_by' 	=> $this->user_cookie[0],
			];
			$this->production_mod->reviewer_new_process_db($form_data);
		}
		elseif($post['approval'] != "" && $post['id_approval'] != ""){
			$form_data = [
				'id_user' 		=> $post['approval'],
				'overdue_date'=> $post['approval_overdue'],
				'update_by'		=> $this->user_cookie[0],
				'update_date' => $date_now,
			];
			$where = [
				'id' => $post['id_approval']
			];
			$this->production_mod->reviewer_update_process_db($form_data, $where);
		}

		if(isset($post['reviewer'])){
			foreach ($post['reviewer'] as $key => $value) {
				if($post['id_review'][$key] == ""){
					$form_data = [
						'id_document' => $post['id_document'],
						'id_user' 		=> $value,
						'overdue_date'=> $post['overdue_date'][$key],
						'category' 		=> "Review",
						'update_by' 	=> $this->user_cookie[0],
					];
					$this->production_mod->reviewer_new_process_db($form_data);
				}
				elseif($post['id_review'][$key] != ""){
					$form_data = [
						'id_user' 		=> $value,
						'overdue_date'=> $post['overdue_date'][$key],
						'update_by' 	=> $this->user_cookie[0],
						'update_date' => $date_now,
					];
					$where = [
						'id' => $post['id_review'][$key]
					];
					$this->production_mod->reviewer_update_process_db($form_data, $where);
				}
			}
		}

		$this->session->set_flashdata("success", "Successfully insert new data!");
		redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($post['id_document']), '+=/', '.-~')."?t=rw");
	}

	public function vendor_review_delete_user_process($id, $id_document){
		$where = [
			"id" => $id
		];
		$this->production_mod->reviewer_delete_process_db($where);

		$this->session->set_flashdata("success", "Successfully deleted the data!");
		redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($id_document), '+=/', '.-~')."?t=rw");
	}

	public function vendor_review_approval_process(){
		$post = $this->input->post();
		
		if($post['action'] == 1){
			$where = [
				'id_document'	=> $post['id_document'],
				'id_user'			=> $this->user_cookie[0],
				'action'			=> 0,
			];
			$datadb 				= $this->production_mod->reviewer_list($where);
			if(count($datadb) == 0){
				$this->session->set_flashdata("error", "Something Wrong. Please try again!");
				redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($post['id_document']), '+=/', '.-~')."?t=rw");
			}
			$approval = [];
			$review = [];
			foreach ($datadb as $key => $value) {
				if($value['category'] == "Approval"){
					$approval = $value;
				}
				elseif($value['category'] == "Review" && count($review) < 1){
					$review = $value;
				}
			}
			if(count($review) < 1){
				$review = $approval;
			}
	
			$form_data = [
				'action' 		=> $post['action'],
			];
			$where = [
				'id' => $review['id']
			];
			
			$this->production_mod->reviewer_update_process_db($form_data, $where);
		}
		elseif($post['action'] == 2){
			$form_data = [
				'action' 		=> 0,
			];
			$where = [
				'id_document' => $post['id_document']
			];
			
			$this->production_mod->reviewer_update_process_db($form_data, $where);
		}
		

		$form_data = [
			'id_document' => $post['id_document'],
			'id_user' 		=> $this->user_cookie[0],
			'category' 		=> $post['category'],
			'action' 			=> $post['action'],
			'remarks' 		=> $post['remarks'],
		];
		$this->production_mod->reviewer_detail_new_process_db($form_data);

		$action = $post['action'];
		if($post['action'] == 1){
			$action = 3;
		}
		if($review['id'] == $approval['id'] && $action == 3){
			$action = 4;
		}
		$form_data = [
			'status_review' 		=> $action,
		];
		$where = [
			'id' => $post['id_document']
		];
		$this->production_mod->document_edit_process_db($form_data, $where);

		if($post['action'] == 2){
			$where = [
				"id_document" 	=> $post['id_document'],
				"status_delete" => 1,
				"status_review" => 1
			];
			$revision = $this->production_mod->document_revision_list(NULL, $where);
			$revision = $revision[0];
	
			$form_data = [
				'status_review' 		=> 2,
			];
			$where = [
				'id' => $revision['id']
			];
			$this->production_mod->document_revision_edit_process_db($form_data, $where);
		}

		$this->session->set_flashdata("success", "Successfully ".($post['action'] == "2" ? "Reject" : "Approve")." the data!");
		redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($post['id_document']), '+=/', '.-~')."?t=rw");
	}

	public function vendor_review_submit_process($id){
		$where = [
			"id_document" 	=> $id,
			"status_delete" => 1,
			"status_review" => 0
		];
		$revision = $this->production_mod->document_revision_list(NULL, $where);
		
		if(count($revision) < 1){
			$this->session->set_flashdata("error", "No file uploaded!");
			redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($id), '+=/', '.-~')."?t=rw");
		}
		$revision = $revision[0];

		$form_data = [
			'status_review' 		=> 1,
		];
		$where = [
			'id' => $revision['id']
		];
		$this->production_mod->document_revision_edit_process_db($form_data, $where);

		$form_data = [
			'status_review' 		=> 1,
		];
		$where = [
			'id' => $id
		];
		$this->production_mod->document_edit_process_db($form_data, $where);

		$form_data = [
			'id_document' => $id,
			'id_user' 		=> $this->user_cookie[0],
			'category' 		=> "Vendor",
			'action' 			=> 0,
			'remarks' 		=> "-",
		];
		$this->production_mod->reviewer_detail_new_process_db($form_data);

		$this->session->set_flashdata("success", "Successfully submit data!");
		redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($id), '+=/', '.-~')."?t=rw");
	}

	public function vendor_review_revise_process(){
		$post = $this->input->post();
		$form_data = [
			'status_review' 		=> 0,
		];
		$where = [
			'id' => $post['id_document']
		];
		$this->production_mod->document_edit_process_db($form_data, $where);

		$form_data = [
			'action' 		=> 0,
		];
		$where = [
			'id_document' => $post['id_document']
		];
		$this->production_mod->reviewer_update_process_db($form_data, $where);

		$form_data = [
			'id_document' => $post['id_document'],
			'id_user' 		=> $this->user_cookie[0],
			'category' 		=> $post['category'],
			'action' 			=> $post['action'],
			'remarks' 		=> $post['remarks'],
		];
		$this->production_mod->reviewer_detail_new_process_db($form_data); 

		$this->session->set_flashdata("success", "Successfully open revision for this document!");
		redirect("production/vendor_pack_dc_detail/".strtr($this->encryption->encrypt($post['id_document']), '+=/', '.-~')."?t=rw");
	}

	public function vmdr_transmit_preview(){
		$post = $this->input->post();

		$datadb = $this->general_mod->project();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value;
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value;
		}
		$datadb  = $this->general_mod->discipline(null, null, ['discipline_code' => "ASC", "discipline_name" => "ASC"]);
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value;
		}
		
		$id_document = explode("; ", $post['id_document']);
		$data['document_list'] 					= $this->production_mod->document_list(NULL, ["id IN (".join(", ", $id_document).")" => NULL]);
		$where = [
			"id_document IN (".join(", ", $id_document).")" => NULL,
			"status_delete" => 1,
		];
		$datadb = $this->production_mod->document_revision_list(NULL, $where);
		$revision_list = [];
		foreach ($datadb as $key => $value) {
			if(!isset($revision_list[$value['id_document']])){
				$revision_list[$value['id_document']] = $value;
			}
		}
		$data['revision_list'] 	= $revision_list;
		$data['meta_title'] 	  = 'Transmit Preview';
		$data['subview']    	  = 'production/vmdr_transmit_preview';
		$data['sidebar']    		= $this->sidebar_vmdr;
		$this->load->view('index', $data);
	}

	public function vmdr_transmit_process(){
		$post = $this->input->post();

		if(count($post['id_document']) == 0){
			$this->session->set_flashdata("error", "No document selected!");
			redirect("production/vendor_pack_dc_list/");
		}

		$datadb  = $this->m_vendor_mod->vendor_list(["status_delete" => 1, "id_company" => $this->user_cookie[11]]);
		if($datadb == 0){
			$this->session->set_flashdata("error", "Vendor Not Found!");
			redirect("production/vendor_pack_dc_list/");
		}
		$vendor = $datadb[0];

		$transmittal_no = "SOF-SMOE-".$vendor['company_code']."-TVI-";
		$document_list = $this->production_mod->document_list(NULL, ["transmittal_no LIKE '".$transmittal_no."%'" => NULL], ["transmittal_no" => "DESC"], 1);
		if(count($document_list) > 0){
			$document_list = $document_list[0];
			$transmittal_no = $transmittal_no.substr($document_list, -4);
		}
		else{
			$transmittal_no = $transmittal_no."0001";
		}

		$form_data = [
			'status_review' 		=> 1,
			'transmittal_date' 	=> date("Y-m-d"),
			'transmittal_no' 		=> $transmittal_no,
		];
		$where = [
			"id IN (".join(", ", $post['id_revision']).")" => NULL
		];
		$this->production_mod->document_revision_edit_process_db($form_data, $where);

		$form_data = [
			'status_review' 		=> 1,
			'transmittal_date' 	=> date("Y-m-d"),
			'transmittal_no' 		=> $transmittal_no,
		];
		$where = [
			"id IN (".join(", ", $post['id_document']).")" => NULL
		];
		$this->production_mod->document_edit_process_db($form_data, $where);

		foreach ($post['id_document'] as $key => $value) {
			$form_data = [
				'id_document' => $value,
				'id_user' 		=> $this->user_cookie[0],
				'category' 		=> "Vendor",
				'action' 			=> 0,
				'remarks' 		=> "-",
			];
			$this->production_mod->reviewer_detail_new_process_db($form_data);
		}

		$this->session->set_flashdata("success", "Successfully submit data!");
		redirect("production/vendor_pack_dc_list/");
	}
}