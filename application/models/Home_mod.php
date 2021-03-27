<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_mod extends CI_Model {

	public function __construct()
 	{
  	parent::__construct();
  $this->db2 = $this->load->database('db_portal', TRUE);
 	}

  public function summary_mdr_vmdr(){
    $query = "SELECT project_id,
        SUM(CASE WHEN cetegory = 2 AND attachment IS NULL THEN 1 ELSE 0 END) AS MDR_META,
        SUM(CASE WHEN cetegory = 2 AND attachment IS NOT NULL THEN 1 ELSE 0 END) AS MDR_COMPLETE,
        SUM(CASE WHEN cetegory = 3 AND attachment IS NULL THEN 1 ELSE 0 END) AS VMDR_META,
        SUM(CASE WHEN cetegory = 3 AND attachment IS NOT NULL AND status_review != 4 THEN 1 ELSE 0 END) AS VMDR_REVIEW,
        SUM(CASE WHEN cetegory = 3 AND attachment IS NOT NULL AND status_review = 4 THEN 1 ELSE 0 END) AS VMDR_COMPLETE
    FROM mdr_document
    GROUP BY project_id";
    $query = $this->db->query($query);
    return $query->result_array();
  }

}
/*
	End Model Auth_mod
*/