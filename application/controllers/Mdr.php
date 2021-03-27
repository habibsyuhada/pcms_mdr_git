<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdr extends CI_Controller {

	public function __construct() {
			
		parent::__construct();

		$this->load->model('general_mod');

		$this->load->helper('cookies');
		helper_cookies();

		$this->user_cookie 		  = explode(";",$this->input->cookie('portal_user'));
		$this->permission_cookie  = explode(";",$this->input->cookie('portal_qcs'));
		$this->permission_eng_act = explode(";",$this->input->cookie('portal_pcms'));

		$this->sidebar 			  = "mdr/sidebar";
	}

	public function index(){
		redirect('mdr/');
	}

	public function vmdr_create(){
    # code...
  }
}