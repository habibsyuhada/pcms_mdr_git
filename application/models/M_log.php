<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model {
 	
 	public function __construct(){
  		parent::__construct();
    	$this->db2 = $this->load->database('db_portal', TRUE);
 	}

    public function save_log($param)
    {
        $sql        = $this->db2->insert_string('portal_user_history_log',$param);
        $ex         = $this->db2->query($sql);
        return $this->db2->affected_rows($sql);
    }
}