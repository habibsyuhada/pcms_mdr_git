<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$this->load->helper('browser');
		//check_browser();
		$this->load->helper('cookies');
		helper_cookies(@$this->input->get('id'));
		// cek_login($this->input->cookie('portal_user'));
		
		// $this->load->helper('access');
		// access_helper();

		$this->load->model('home_mod');
		$this->load->model('general_mod');

		$this->user_cookie 		  = explode(";",$this->input->cookie('portal_user'));
		$this->permission_cookie  = explode(";",$this->input->cookie('portal_pcms'));
		$this->permission_eng_act = explode(";",$this->input->cookie('portal_pcms'));
	}

	public function index(){
		redirect('home/home');
	}

	public function home(){
		$data['summary'] = $this->home_mod->summary_mdr_vmdr();
		
		$datadb = $this->general_mod->project();
		foreach ($datadb as $key => $value) {
			$data['project_list'][$value['id']] = $value;
		}

		$data['meta_title']  = 'Home';
		$data['subview']     = 'home/home';
		$this->load->view('index', $data);
	}
}