<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$this->load->helper('browser');
		//check_browser();
		$this->load->helper('cookies');
		helper_cookies();

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('production_mod');

		$this->user_cookie = explode(";",$this->input->cookie('portal_user'));
		$this->permission_cookie = explode(";",$this->input->cookie('portal_qcs'));
    $this->permission_eng_act = explode(";",$this->input->cookie('portal_pcms'));
    
    $this->sidebar 	= "report/sidebar";
	}

	public function index(){
		redirect('report/monthly_report');
	}

	function mdr_design_list_smop_excel3($project = NULL){
		$datadb = $this->general_mod->project_all();
		foreach ($datadb as $value) {
			$project_list[$value['id']] = $value['project_name'];
		}
		$datadb = $this->general_mod->module();
		foreach ($datadb as $value) {
			$module_list[$value['mod_id']] = $value['mod_desc'];
		}
		$datadb  = $this->general_mod->discipline();
		foreach ($datadb as $value) {
			$discipline_list[$value['id']] = $value;
		}
		$datadb  = $this->production_mod->vendor_master_list();
		foreach ($datadb as $value) {
			$vendor_list[$value['vendor_code']] = $value['package_name'];
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
		if($project != NULL){
			$where['main.project_id'] = $project;
		}
		$where['main.cetegory IN (2)'] = NULL;
		$where['main.status_delete'] = 1;
		$where['t1.status_delete'] = 1;
		$datadb = $this->production_mod->document_main_planned_list($where);
		foreach ($datadb as $key => $value) {
			if(!isset($data_main[$value['cetegory']][$value['id']])){
				$data_main[$value['cetegory']][$value['id']] = $value;
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT * FROM mdr_document WHERE id NOT IN (SELECT DISTINCT id_document FROM mdr_document_revision WHERE status_delete = 1) AND status_delete = 1 AND cetegory IN (2,3)".($project != NULL ? " AND project_id = ".$project : ""));
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
		if($project != NULL){
			$where['main.project_id'] = $project;
		}
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
			$mdr_lists 			= $data_main[2];
			$mdr_status 		= $data_status[2];
		}

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excel = new PHPExcel();
		$sheet = $excel->getActiveSheet(0);
		
		$sheet->setCellValue('A1', 'COMPANY Document number');
		$sheet->setCellValue('B1', 'Document Title');
		$sheet->setCellValue('C1', 'Revision');
		$sheet->setCellValue('D1', 'Revision Date');
		$sheet->setCellValue('E1', 'Country');
		$sheet->setCellValue('F1', 'Site');
		$sheet->setCellValue('G1', 'Sector');
		$sheet->setCellValue('H1', 'Originator');
		$sheet->setCellValue('I1', 'Sequantial Number<br>(Doc Type 2 digits+Seq Number)');
		$sheet->setCellValue('J1', 'Discipline');
		$sheet->setCellValue('K1', 'Project Code');
		$sheet->setCellValue('L1', 'Document type');
		$sheet->setCellValue('M1', 'System');
		$sheet->setCellValue('N1', 'Sub-System');
		$sheet->setCellValue('O1', 'Equipment Class');
		$sheet->setCellValue('P1', 'Equipment SubClass');
		$sheet->setCellValue('Q1', 'Criticality');
		$sheet->setCellValue('R1', 'Approval Class');
		$sheet->setCellValue('S1', 'Status');
		$sheet->setCellValue('T1', 'Originator Doc. Number');

		$sheet->setCellValue('U1', 'IFR Planned Date');
		$sheet->setCellValue('V1', 'IFR Actual Date');
		$sheet->setCellValue('W1', 'IFA Planned Date');
		$sheet->setCellValue('X1', 'IFA Actual Date');
		$sheet->setCellValue('Y1', 'AFC Planned Date');
		$sheet->setCellValue('Z1', 'AFC Actual Date');
		$sheet->setCellValue('AA1', 'ASB Planned Date');
		$sheet->setCellValue('AB1', 'ASB Actual Date');
		$sheet->setCellValue('AC1', 'AFD Planned Date');
		$sheet->setCellValue('AD1', 'AFD Actual Date');
		$sheet->setCellValue('AE1', 'IFI Planned Date');
		$sheet->setCellValue('AF1', 'IFI Actual Date');

		$sheet->setCellValue('AG1', 'TAG (tag separated with"";"")');
		$sheet->setCellValue('AH1', 'Cable TAG (tag separated with"";"")');
		$sheet->setCellValue('AI1', 'Line TAG (tag separated with"";"")');
		$sheet->setCellValue('AJ1', 'SPP TAG (tag separated with"";"")');
		$sheet->setCellValue('AK1', 'MDR Update  Information');
		$sheet->setCellValue('AL1', 'Is Interface (true / false)');
		$sheet->setCellValue('AM1', 'Field Operations  Delivrable (true/false)');
		$sheet->setCellValue('AN1', 'ASB Required (Y/N)');
		$sheet->setCellValue('AO1', 'Weight %');
		$sheet->setCellValue('AP1', 'Progress %');
		$sheet->setCellValue('AQ1', 'Contractor  Transmittal Sheet Number');
		$sheet->setCellValue('AR1', 'Issue Date Contractor Transmittal Sheet');
		$sheet->setCellValue('AS1', 'MDR Revision or Change Request nb');

		$sheet->setCellValue('AT1', 'FDB Volume');
		$sheet->setCellValue('AU1', 'Work Pack');
		$sheet->setCellValue('AV1', 'Work Unit');
		$sheet->setCellValue('AW1', 'Document Generator');
		$sheet->setCellValue('AX1', 'Brownfield Interface?');
		$sheet->setCellValue('AY1', 'Folio Drawing?');

		$style_col = array(
			'font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF'),), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '28A745')
			)
		);
		$excel->getActiveSheet()->getStyle('A1:AY1')->applyFromArray($style_col);

		$numrows = 1;
		if($mdr_lists):
			foreach($mdr_lists as $key => $list):
				$numrows++;
				$doc_arr = explode("-", $list['ref_no']);

				$sheet->setCellValue('A'.$numrows, $list['ref_no']);
				$sheet->setCellValue('B'.$numrows, $list['description']);
				$sheet->setCellValue('C'.$numrows, '="'.$list['revision_no'].'"');
				$sheet->setCellValue('D'.$numrows, $list['revision_date']);
				$sheet->setCellValue('E'.$numrows, "QA");
				$sheet->setCellValue('F'.$numrows, @$doc_arr[2][0].@$doc_arr[2][1].@$doc_arr[2][2]);
				$sheet->setCellValue('G'.$numrows, @$doc_arr[2][3].@$doc_arr[2][4]);
				$sheet->setCellValue('H'.$numrows, @$doc_arr[1]);
				$sheet->setCellValue('I'.$numrows, @$doc_arr[4].(isset($doc_arr[5]) ? "-".$doc_arr[5] : ""));
				$sheet->setCellValue('J'.$numrows, '="'.@$discipline_list[$list['discipline']]['discipline_code'].'"');
				$sheet->setCellValue('K'.$numrows, @$doc_arr[0]);
				$sheet->setCellValue('L'.$numrows, $list['document_type']);
				$sheet->setCellValue('M'.$numrows, $list['system']);
				$sheet->setCellValue('N'.$numrows, $list['subsystem']);
				$sheet->setCellValue('O'.$numrows, $list['equipment_class']);
				$sheet->setCellValue('P'.$numrows, $list['equipment_subclass']);
				$sheet->setCellValue('Q'.$numrows, $list['criticality']);
				$sheet->setCellValue('R'.$numrows, $list['class']);
				$sheet->setCellValue('S'.$numrows, $list['status_remark']);
				$sheet->setCellValue('T'.$numrows, $list['originator_doc_number']);

				$sheet->setCellValue('U'.$numrows, ($list['ifr_planned_date'] == '0000-00-00' ? '' : $list['ifr_planned_date']));
				$sheet->setCellValue('V'.$numrows, (@$mdr_status['IFR'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFR'][$key]['transmittal_date']));
				$sheet->setCellValue('W'.$numrows, ($list['ifa_planned_date'] == '0000-00-00' ? '' : $list['ifa_planned_date']));
				$sheet->setCellValue('X'.$numrows, (@$mdr_status['IFA'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFA'][$key]['transmittal_date']));
				$sheet->setCellValue('Y'.$numrows, ($list['afc_planned_date'] == '0000-00-00' ? '' : $list['afc_planned_date']));
				$sheet->setCellValue('Z'.$numrows, (@$mdr_status['AFC'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['AFC'][$key]['transmittal_date']));
				$sheet->setCellValue('AA'.$numrows, ($list['asb_planned_date'] == '0000-00-00' ? '' : $list['asb_planned_date']));
				$sheet->setCellValue('AB'.$numrows, (@$mdr_status['ASB'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['ASB'][$key]['transmittal_date']));
				$sheet->setCellValue('AC'.$numrows, ($list['afd_planned_date'] == '0000-00-00' ? '' : $list['afd_planned_date']));
				$sheet->setCellValue('AD'.$numrows, (@$mdr_status['AFD'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['AFD'][$key]['transmittal_date']));
				$sheet->setCellValue('AE'.$numrows, ($list['ifi_planned_date'] == '0000-00-00' ? '' : $list['ifi_planned_date']));
				$sheet->setCellValue('AF'.$numrows, (@$mdr_status['IFI'][$key]['transmittal_date'] == '0000-00-00' ? '' :  @$mdr_status['IFI'][$key]['transmittal_date']));
				
				$sheet->setCellValue('AG'.$numrows, $list['tag']);
				$sheet->setCellValue('AH'.$numrows, $list['cable_tag']);
				$sheet->setCellValue('AI'.$numrows, $list['line_tag']);
				$sheet->setCellValue('AJ'.$numrows, $list['spp_tag']);
				$sheet->setCellValue('AK'.$numrows, $list['mdr_update_information']);
				$sheet->setCellValue('AL'.$numrows, $list['interface_doc']);
				$sheet->setCellValue('AM'.$numrows, $list['field_operations_delivrable']);
				$sheet->setCellValue('AN'.$numrows, $list['asb']);
				$sheet->setCellValue('AO'.$numrows, $list['weight']);
				$sheet->setCellValue('AP'.$numrows, $list['progress']);
				$sheet->setCellValue('AQ'.$numrows, $list['contractor_transmittal_sheet_number']);
				$sheet->setCellValue('AR'.$numrows, $list['issue_date_contractor_transmittal_sheet']);
				$sheet->setCellValue('AS'.$numrows, $list['mdr_revision_request_nb']);

				$sheet->setCellValue('AT'.$numrows, $list['fdb_volume']);
				$sheet->setCellValue('AU'.$numrows, $list['wp']);
				$sheet->setCellValue('AV'.$numrows, $list['wu']);
				$sheet->setCellValue('AW'.$numrows, $list['generator']);
				$sheet->setCellValue('AX'.$numrows, $list['brownfield_interface']);
				$sheet->setCellValue('AY'.$numrows, $list['folio_drawing']);
				
				$style_row = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					),
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
					)
				);
				$excel->getActiveSheet()->getStyle('A'.$numrows.':AY'.$numrows)->applyFromArray($style_row);
			endforeach; 
		endif;

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$excel->getActiveSheet(0)->setTitle("Attendance Payroll");
		$excel->setActiveSheetIndex(0);

		foreach(range('A','Z') as $columnID){
			$excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
		foreach(range('A','Y') as $columnID){
			$excel->getActiveSheet()->getColumnDimension('A'.$columnID)->setAutoSize(true);
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="MDR-Report-'.date('YmdHis').'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
}