<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_log extends CI_Model {
 	
 	public function __construct(){
  		parent::__construct();
 	}

    public function save_log($param)
    {
        $sql  = $this->db->insert('qcs_approval_nos',$param);
       
    }
}