<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_vendor_mod extends CI_Model {

	public function __construct()
 	{
	  	parent::__construct();
	    $this->db_portal = $this->load->database('db_portal', TRUE);
 	}

 	public function vendor_new_process_db($data){
		$this->db_portal->insert('portal_company', $data);

		//user history log
		$insert_id = $this->db_portal->insert_id();
    helper_log("add", "Insert data table portal_company id_company = ".$insert_id);
	}

	public function vendor_edit_process_db($data, $where){
		$this->db_portal->where($where);
		$this->db_portal->update('portal_company',$data);

		//user history log
    helper_log("update", "Update data table portal_company data = ".json_encode($data)." where = ".json_encode($where));
	}

	function vendor_list($where = null){
		if(isset($where)){
			$this->db_portal->where($where);
		}
		elseif(isset($id)){
			$this->db_portal->where('id_company', $id);
		}
		else{
			$this->db_portal->where('status_delete', '1');
		}
		$query = $this->db_portal->order_by('id_company', 'DESC');
		$query = $this->db_portal->get('portal_company');
		return $query->result_array();
	}

	function vendor_new_import_process_db($data) {
		$this->db_portal->insert_batch('portal_company', $data);

		//user history log
    helper_log("add", "IMPORT data table portal_company");
	}
}
/*
	End Model Auth_mod
*/