<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Public_smoe extends CI_Controller {

	public function __construct() {
			
		parent::__construct();

		$this->load->model('general_mod');
		$this->load->model('home_mod');
		$this->load->model('activity_mod');
		$this->load->model('production_mod');

		$this->load->helper('cookies');
		
		// $this->load->helper('access');
	}

	public function index(){
		redirect('production/drawing_register_list');
	}

	// Drawing Register ===

	public function open_atc($status, $id_dec){
		$where['id_activity']				= $this->encryption->decrypt(strtr($id_dec, '.-~', '+=/'));
		$where['transmittal_file']	= $status;
		$file												= $this->activity_mod->open_atc($where);
		if($file){
			$file									= $file[0];
			redirect(base_url_ftp().'upload/activity_revision/'.$file['attachment']);
		}
		else{
			header("location: ".show_404());
		}
	}

	public function transmittal_pdf($transmittal_no){
		$transmittal_no 					= $this->encryption->decrypt(strtr($transmittal_no, '.-~', '+=/'));
		if($transmittal_no == "2013J310004-ENG-CUT-TRN-0072"){
			echo "Transmittal Dont Have Data.";//Error Double Click
			exit;
		}
		$datadb = $this->general_mod->drawing_type();
		foreach ($datadb as $value) {
			$data['drawing_type_list'][$value['id']] = $value['code'];
		}
		$datadb = $this->general_mod->project_all();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}
		// $transmittal_nox 					= $transmittal_no;
		// if($transmittal_no == '2013J310005-ENG-STR-TRN-0002'){
		// 	$transmittal_no = '2013J310005-ENG-STR-TRN-0003';
		// }
		$where['transmittal_no'] 	= $transmittal_no;
		$where['status_delete '] 	= 1;
		$data['activity_list'] 		= $this->activity_mod->drawing_register_list(NULL, $where);
		// if($transmittal_nox == '2013J310005-ENG-STR-TRN-0002'){
		// 	$data['activity_list'][0]['transmittal_no'] = '2013J310005-ENG-STR-TRN-0002';
		// 	$data['activity_list'][0]['transmittal_date'] = '2020-03-19 07:55:10';
		// 	$data['activity_list'][0]['revision_no'] = '00';
		// }
		$data['user_list'] 				= $this->user_name_data("SELECT DISTINCT transmittal_by as id_user FROM `pcms_eng_drawing_register` WHERE transmittal_no = '$transmittal_no'");
		
		$this->load->library('Pdfgenerator_potrait');

    $html = $this->load->view('activity/transmittal_pdf', $data, true);
    
    $this->pdfgenerator_potrait->generate($html,$transmittal_no,$app_nos);exit;
	}

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

	public function logout($pass_login_status = 0) {
		$this->load->helper('cookie');
		delete_cookie('portal_user');	
		delete_cookie('portal_emr');
		delete_cookie('portal_qcs');	
		delete_cookie('portal_pcms');
		delete_cookie('portal_wh');	
		delete_cookie('filterActivityList');	

		if($this->input->get('notif')){
			$notif = explode(";", $this->input->get('notif'));
			if(count($notif) == 3){
				redirect("http://10.5.252.116/smoe_portal/auth/logout/".$pass_login_status."?notif=".$this->input->get('notif'));
			}
		}
		// print_r($notif);
		// exit;
		
		redirect("http://10.5.252.116/smoe_portal/auth/logout/".$pass_login_status);
	}

	public function convert_to_time_format($sec){
		$s = $sec % 60;
		$min = floor($sec / 60);
		$m = $min % 60;
		$h = floor($min / 60);
		$full = $s."s";
		if($h > 0 || $m > 0){
			$full = $m."m ".$full;
		}
		if($h > 0){
			$full = $h."h ".$full;
		}
		return $full;
	}

	public function weekly_notification(){
		$date_from 					= date("Y-m-d", strtotime("previous week Monday"));
		$date_to 						= date("Y-m-d", strtotime("previous week Sunday"));
		$data['date_from'] 	= date("d-m-Y", strtotime($date_from));
		$data['date_to'] 		= date("d-m-Y", strtotime($date_to));

		$init_project = array(7,8);
		
		$id_user = [];

		$datadb 			= $this->home_mod->activity_design_detail_inrange($date_from, $date_to);
		$modeler 			= [];
		$modeler_user = [];
		$modeler_new 	= [];
		foreach ($init_project as $key => $value) {
			$modeler[$value]['modeler_outstanding'] = 0;
			$modeler[$value]['modeler_complete'] = 0;
			$modeler[$value]['modeler_revise'] = 0;
			$modeler[$value]['modeler_open'] = 0;
		}
		// test_var($datadb);
		foreach ($datadb as $value) {
			if(!isset($modeler_user[$value['project_id']][$value['id_user']])){
				$modeler_user[$value['project_id']][$value['id_user']] = [
					'num' => 0,
					'sec' => 0,
				];
			}
			if(!in_array($value['id_user'], $id_user)){
				$id_user[] = $value['id_user'];
			}
			$modeler_user[$value['project_id']][$value['id_user']]['sec'] += $value['sec'];

			if(!isset($modeler_new[$value['id_activity_design']])){
				if($value['action'] == 0){
					$modeler[$value['project_id']]['modeler_outstanding']++;
				}
				elseif($value['action'] == 1){
					$modeler[$value['project_id']]['modeler_complete']++;
				}
				elseif($value['action'] == 2){
					$modeler[$value['project_id']]['modeler_revise']++;
				}

				$modeler_user[$value['project_id']][$value['id_user']]['num']++;

				$modeler_new[$value['id_activity_design']] = $value;
			}
		}
		$datadb 			= $this->home_mod->activity_design_inrange($date_from, $date_to);
		foreach ($datadb as $value) {
			if(!isset($modeler_new[$value['id']])){
				$modeler[$value['project_id']]['modeler_open']++;
			}
		}
		foreach ($init_project as $valuem) {
			foreach ($modeler_user[$valuem] as $key => $value) {
				$modeler_user[$valuem][$key]['sec'] = $this->convert_to_time_format($modeler_user[$valuem][$key]['sec']);
			}
		}
		$data['modeler_user'] = $modeler_user;
		$data['modeler'] 			= $modeler;

		// test_var(array($date_from, $date_to));
		$datadb = $this->general_mod->project_all();
		foreach ($datadb as $value) {
			$data['project_list'][$value['id']] = $value['project_name'];
		}
		
		

		$total_type = array();
		$datadb = $this->home_mod->count_total_activit_per_role_inrange($date_from, $date_to);
		foreach ($datadb as $key => $value) {
			$total_type[$value['project_id']] = $value;
		}

		$datadb = $this->home_mod->count_total_transmitted_document_inrange($date_from, $date_to);
		foreach ($datadb as $key => $value) {
			$total_type[$value['project_id']]['transmitted'] = $value['transmitted'];
		}

		$datadb = $this->home_mod->count_total_revised_document_inrange($date_from, $date_to);
		foreach ($datadb as $key => $value) {
			$total_type[$value['project_id']]['revised'] = $value['revised'];
		}
		
		$data['total_type'] = $total_type;
		
		$data_user = [];
		$datadb = $this->home_mod->count_total_document_perrole_inrange($date_from, $date_to);
		foreach ($datadb as $key => $value) {
			$value['sec'] = $this->convert_to_time_format($value['sec']);
			$data_user[$value['project_id']][$value['category']][] = $value;
			if(!in_array($value['id_user'], $id_user)){
				$id_user[] = $value['id_user'];
			}
		}
		$data['data_role_num'] 	= $data_user;
		// test_var($data_user);
		$data['user_list'] 			= $this->user_name_data($id_user);

		$data['logo'] 	= base64_encode(file_get_contents("img/logo.png"));

		// $data['project'] 		= 7;
		// $data['meta_title'] = "Weekly Report ".$data['project_list'][$project]." (".$date_from." - ".$date_to.")";
		// $html = $this->load->view('home/weekly_report_pdf', $data, true);
		// $this->load->library('Pdfgenerator_potrait');
		// $this->pdfgenerator_potrait->generate($html, $data['meta_title'].".pdf");
		// exit;
		
		$this->load->library('Pdfgenerator_weekly_notif');
		$this->pdfgenerator_weekly_notif->define_contant();
		$filename = [];
		foreach ($init_project as $key => $project) {
			$data['meta_title'] = "Weekly Report ".$data['project_list'][$project]." (".$date_from." - ".$date_to.")";
			$filename[] = $data['meta_title'];
			$data['project'] 		= $project;
			$html = $this->load->view('home/weekly_report_pdf', $data, true);
			$this->pdfgenerator_weekly_notif->generate($html, $data['meta_title'].".pdf");
		}
		
		$email_data = $this->general_mod->find_email_data(['process' => 'Weekly Report Engineering Activity']);
		$email_data = $email_data[0];
		$ci =& get_instance();
		$ci->load->library('email');
		$config['protocol']     = "smtp";
		$config['smtp_host']    = "10.5.252.31";
		$config['smtp_port']    = "25";
		$config['smtp_user']    = "";
		$config['smtp_pass']    = "";
		$config['charset']      = "utf-8";
		$config['mailtype']     = "html";
		$config['newline']      = "\r\n";
		$config['wordwrap']     = TRUE;
		$ci->email->initialize($config);
		$ci->email->set_crlf( "\r\n" );
		$ci->email->from('smtpservice.batam@sembmarine.com', 'No Reply - TES ATTACHMENT');
		$ci->email->to($email_data['email_to']);
		$ci->email->cc($email_data['email_cc']);
		$ci->email->bcc($email_data['email_bcc']);
		$ci->email->subject("Weekly Summary Report Engineering Activity");
		$message = "<html>
			<body>
				<p>Dear all,</p>
				<p>Please refer to attachment about Weekly Summary Report Engineering Activity Period ".$date_from." - ".$date_to."</p>
				<p><br>Regards,<br/>SMOE Portal<br></p>
				<p><b>This email auto generated by system. <br/> Please do not reply to this email address.</b></p>
			</body>
		</html>";
		$ci->email->message($message);
		foreach ($filename as $key => $value) {
			$ci->email->attach('file/weekly_notif/'.$value.".pdf");
		}
		$ci->email->send();
	}
}