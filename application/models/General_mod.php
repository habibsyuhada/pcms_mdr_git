<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_mod extends CI_Model {

	public function __construct()
 	{
	  	parent::__construct();
	    $this->db2 = $this->load->database('db_portal', TRUE);
	    $this->db3 = $this->load->database('db_qcs', TRUE);
 	}

 	function check_cookies($id_user,$permission_cookie,$link){		
		$this->db2->where('id_user', $id_user);
		$query = $this->db2->get('portal_user_db')->result();

		$db_cookies = $query[0]->pcms_permission;
		if($db_cookies !== $permission_cookie){
			redirect($link."/auth/logout");
		}
		
	}
	
	function drawing_type($id = null, $where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		elseif(isset($id)){
			$this->db->where('id', $id);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('number_order', 'ASC');
		$query = $this->db->get('master_drawing_type');
		return $query->result_array();
	}

	function discipline($id = null, $where = null, $order_by = null){
		if(isset($where)){
			$this->db3->where($where);
		}
		elseif(isset($id)){
			$this->db3->where('id', $id);
		}
		else{
			$this->db3->where('status_delete', '0');
		}
		if($order_by){
			foreach ($order_by as $key => $value) {
				$this->db3->order_by($key, $value);
			}
		}
		$query = $this->db3->get('master_discipline');
		return $query->result_array();
	}

	function module($id = null, $where = null){
		if(isset($where)){
			$this->db3->where($where);
		}
		elseif(isset($id)){
			$this->db3->where('id', $id);
		}
		else{
			$this->db3->where('status_delete', '1');
		}
		$query = $this->db3->get('master_module');
		return $query->result_array();
	}

	function project($id = null, $where = null){
		if(isset($where)){
			$this->db2->where($where);
		}
		elseif(isset($id)){
			$this->db2->where('id', $id);
		}
		else{
			$this->db2->where('status', '1');
		}
		$query = $this->db2->get('portal_project');
		return $query->result_array();
	}

	function project_all($id = null, $where = null){
		if(isset($where)){
			$this->db2->where($where);
		}
		elseif(isset($id)){
			$this->db2->where('id', $id);
		}
		$query = $this->db2->get('portal_project');
		return $query->result_array();
	}

	function portal_user_db_id($where_in){
		$this->db2->where_in('id_user', $where_in);
		$query = $this->db2->get('portal_user_db');
		return $query->result_array();
	}

	function portal_user_db_list($where = NULL){
		if($where){
			$query = $this->db2->where($where);
		}

		$query = $this->db2->get('portal_user_db');
		return $query->result_array();
	}

	function manual_query_db($query){
		$query = $this->db->query($query);
		return $query->result_array();
	}

	function manual_query_db_portal($query){
		$query = $this->db2->query($query);
		return $query->result_array();
	}

	function manual_query_db_qcs($query){
		$query = $this->db3->query($query);
		return $query->result_array();
	}

	public function insert_access_log($param){
    $sql  = $this->db2->insert('portal_access_history',$param);
  }

	function notif($id_user){		
		$this->db->where('drafter', $id_user);
		$this->db->where('status', 0);
		$this->db->limit(10);
		$query = $this->db->get('pcms_eng_activity');
		return $query->result_array();
	}

	function notif_checker(){		
		
		$this->db->where('checker_approval_status', 1);
		$this->db->where('status_delete', 1);
		$this->db->where('status', 2);
		$this->db->where('project_id', '8');
		$this->db->where('draft_submit_status', 1);
		$this->db->or_where('checker_approval_status', 1);
		$this->db->where('status_delete', 1);
		$this->db->where('status', 2);
		$this->db->where('project_id', '7');
		$this->db->where('draft_submit_status', 1);
		$this->db->limit(100);
		$query = $this->db->get('pcms_eng_activity');
		return $query->result_array();
	}

	function notif_engineer(){		
			
		$this->db->where('checker_approval_status', 3);
		$this->db->where('engineer_approval_status', 1);
		$this->db->where('status_delete', 1);
		$this->db->where('project_id', '8');
		$this->db->where('status', 2);
		$this->db->or_where('checker_approval_status', 3);
		$this->db->where('engineer_approval_status', 1);
		$this->db->where('status_delete', 1);
		$this->db->where('project_id', '7');
		$this->db->where('status', 2);
		$this->db->limit(100);
		$query = $this->db->get('pcms_eng_activity');
		return $query->result_array();
	}

	function notif_qc(){
		$this->db->where('checker_approval_status', 3);
		$this->db->where('engineer_approval_status', 1);
		$this->db->where('status_delete', 1);
		$this->db->where('project_id IN (7,8)', NULL);
		$this->db->where('drawing_type IN (9,14)', NULL);
		$this->db->limit(100);
		$query = $this->db->get('pcms_eng_activity');
		return $query->result_array();
	}

	function notif_doccon($project_id){
		$this->db->where('checker_approval_status', 3);
		$this->db->where('doccon_check_status', 1);
		$this->db->where('status_delete', 1);
		$this->db->where('project_id', $project_id);
		$this->db->where('drawing_type IN (9,14)', NULL);
		$this->db->limit(100);
		$query = $this->db->get('pcms_eng_activity');
		return $query->result_array();
	}

	function running($id_user){		
		$this->db->where('id_user', $id_user);
		$this->db->where('status', 0);
		$this->db->limit(10);
		$query = $this->db->get('pcms_eng_activity_detail');
		return $query->result_array();
	}

	function onprogress_activity($id_user){
		$query = $this->db->select('b.document_no, a.start_time, b.id');
		$query = $this->db->where('a.id_user', $id_user);
		$query = $this->db->where('a.status', 0);
		$query = $this->db->where('a.status_delete', 1);
		$query = $this->db->where('b.status_delete', 1);
		$query = $this->db->join('pcms_eng_activity b', 'a.id_activity = b.id');
		$query = $this->db->get('pcms_eng_activity_detail a');
		return $query->result_array();
	}

	function onprogress_activity_modeler($id_user){
		$query = $this->db->select('b.document_no, a.start_time, b.id');
		$query = $this->db->where('a.id_user', $id_user);
		$query = $this->db->where('a.status', 0);
		$query = $this->db->where('a.status_delete', 1);
		$query = $this->db->where('b.status_delete', 1);
		$query = $this->db->join('pcms_eng_activity_design b', 'a.id_activity_design = b.id');
		$query = $this->db->get('pcms_eng_activity_design_detail a');
		return $query->result_array();
	}

	function running_modeler($id_user){		
		$this->db->where('id_user', $id_user);
		$this->db->where('status', 0);
		$this->db->limit(10);
		$query = $this->db->get('pcms_eng_activity_design_detail');
		return $query->result_array();
	}

	function data_module($where = null){
		if($where){
			$query = $this->db3->where($where);
		}

 		$query = $this->db3->get('master_module');
		return $query->result_array();
	}

	function data_project($where = NULL){
		if($where){
			$query = $this->db2->where($where);
		}

		$query = $this->db2->get('portal_project');
		return $query->result_array();
	}

	public function ftp_find_master(){
		//$_SERVER['server_addr'];
		$this->db2->where('server_source', '10.5.252.108');
		$query = $this->db2->get('portal_ftp_server')->result_array();
		return $query;
	}

	public function find_email_data($where) {
		if($where){
			$query = $this->db2->where($where);
		}
		$this->db2->from('portal_email_notification');
		$query = $this->db2->get(); 
		return $query->result_array();
	}

}
/*
	End Model Auth_mod
*/