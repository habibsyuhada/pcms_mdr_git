<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class M_vendor extends CI_Controller {

	public function __construct() {
			
		parent::__construct();

		$this->load->model('general_mod');
		$this->load->model('m_vendor_mod');

		$this->load->helper('cookies');
		helper_cookies();
		// cek_login($this->input->cookie('portal_user'));

		$this->user_cookie 				= explode(";",$this->input->cookie('portal_user'));
    $this->permission_cookie 	= explode(";",$this->input->cookie('portal_qcs'));
    
    $this->permission_eng_act = explode(";",$this->input->cookie('portal_pcms'));

    $this->sidebar 						= "production/sidebar_vmdr";
	}

	public function index(){
		redirect('m_vendor/vendor_list');
	}

	// C_Activity Design
	public function vendor_new(){
		$data['meta_title'] 	  		= 'Vendor New';
		$data['subview']    	  		= 'master/vendor/vendor_new';
		$data['sidebar']    				= $this->sidebar;
		$this->load->view('index', $data);
	}

	public function vendor_new_process(){
		$company_code 			= $this->input->post('company_code');
		$company_name 			= $this->input->post('company_name');

		$form_data = array(
			'company_code' 	=> $company_code,
			'company_name' 	=> $company_name,
			'category' 			=> 1,
		);
		$this->m_vendor_mod->vendor_new_process_db($form_data);
		$this->session->set_flashdata('success', 'Your data has been Created!');

		redirect('m_vendor/vendor_new');
	}

	public function vendor_list(){
		$data['dt_list'] 				= $this->m_vendor_mod->vendor_list(["status_delete" => 1, "category" => 1]);
		$data['meta_title'] 	  = 'Vendor List';
		$data['subview']    	  = 'master/vendor/vendor_list';
		$data['sidebar']    		= $this->sidebar;
		$this->load->view('index', $data);
	}

	public function vendor_edit($id_dec){
		$id_company 										= $this->encryption->decrypt(strtr($id_dec, '.-~', '+=/'));
		
		$data['dt_list'] 				= $this->m_vendor_mod->vendor_list(["id_company" => $id_company]);
		$data['meta_title'] 	  = 'Vendor Edit';
		$data['subview']    	  = 'master/vendor/vendor_edit';
		$data['sidebar']    		= $this->sidebar;
		$this->load->view('index', $data);
	}

	public function vendor_edit_process(){
		$id_company 							= $this->input->post('id_company');
		$company_code 						= $this->input->post('company_code');
		$company_name 			= $this->input->post('company_name');

		$form_data = array(
			'company_code' 					=> $company_code,
			'company_name' 	=> $company_name,
		);

		$where['id_company']			= $id_company;
		$this->m_vendor_mod->vendor_edit_process_db($form_data, $where);
		$this->session->set_flashdata('success', 'Your data has been Updated!');

		redirect('m_vendor/vendor_edit/'.strtr($this->encryption->encrypt($id_company), '+=/', '.-~'));
	}

	public function vendor_delete_process($id_dec){
		$id_company 							= $this->encryption->decrypt(strtr($id_dec, '.-~', '+=/'));

		$form_data = array(
			'status_delete' => '0',
		);

		$where['id_company']			= $id_company;
		$this->m_vendor_mod->vendor_edit_process_db($form_data, $where);
		$this->session->set_flashdata('success', 'Your data has been Deleted!');

		redirect('m_vendor/vendor_list/');
	}

	// C_Activity Design_Import
	public function vendor_import(){

		$data['meta_title'] 	  		= 'Activity Design Import';
		$data['subview']    	  		= 'm_vendor/vendor_import';
		$data['sidebar']    				= $this->sidebar;
		$this->load->view('index', $data);
	}

	public function vendor_import_process(){
		$document_no 						= $this->input->post('document_no');
		$project_id 						= $this->input->post('project_id');
		$vendor 					= $this->input->post('vendor');
		$module 								= $this->input->post('module');
		$discipline 						= $this->input->post('discipline');
		$created_by 						= $this->user_cookie[0];
		$created_date 					= date("Y-m-d H:i:s");
		if($vendor != '1'){
			$drawing_ga 					= $this->input->post('drawing_ga');
		}

		if(count($document_no) > 0){
			$form_data = array();
			foreach ($document_no as $key => $value) {
				if($vendor == '1'){
					array_push($form_data, array(
						'document_no'		=>$document_no[$key], // Insert data nis dari kolom A di excel
						'project_id'		=>$project_id[$key], // Insert data nis dari kolom A di excel
						'vendor'	=>$vendor, // Insert data nis dari kolom A di excel
						'module'				=>$module[$key], // Insert data nis dari kolom A di excel
						'discipline'		=>$discipline[$key], // Insert data nis dari kolom A di excel
						'created_by'		=>$created_by, // Insert data nis dari kolom A di excel
						'created_date'	=>$created_date, // Insert data nis dari kolom A di excel
					));
				}
				else{
					array_push($form_data, array(
						'drawing_ga'		=>$drawing_ga[$key], // Insert data nis dari kolom A di excel
						'document_no'		=>$document_no[$key], // Insert data nis dari kolom A di excel
						'project_id'		=>$project_id[$key], // Insert data nis dari kolom A di excel
						'vendor'	=>$vendor, // Insert data nis dari kolom A di excel
						'module'				=>$module[$key], // Insert data nis dari kolom A di excel
						'discipline'		=>$discipline[$key], // Insert data nis dari kolom A di excel
						'created_by'		=>$created_by, // Insert data nis dari kolom A di excel
						'created_date'	=>$created_date, // Insert data nis dari kolom A di excel
					));
				}
			}
			$this->m_vendor_mod->vendor_new_import_process_db($form_data);
			$this->session->set_flashdata('success', 'Your data has been imported!');
			redirect("m_vendor/vendor_import");
		}
		else{
			$this->session->set_flashdata('error', 'No Data to import!');
			redirect("m_vendor/vendor_import");
		}
	}

	// Others
	public function company_code_check(){
		$company_code 									= $this->input->post('company_code');

		$where['company_code']					= $company_code;
		$where['status_delete']	= '1';
		$datadb 								= $this->m_vendor_mod->vendor_list($where);
		if($datadb){
			echo 'Error: Duplicate Document Number!';
		}
		else{
			echo '0';
		}
	}

	public function company_name_check(){
		$company_name 						= $this->input->post('company_name');

		$where['company_name']		= $company_name;
		$where['status_delete']	= '1';
		$datadb 								= $this->m_vendor_mod->vendor_list($where);
		if($datadb){
			echo 'Error: Duplicate Document Number!';
		}
		else{
			echo '0';
		}
	}
}