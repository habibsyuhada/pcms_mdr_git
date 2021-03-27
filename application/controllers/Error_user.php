<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_user extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		
	}

	public function index()
	{
		$data['heading'] = 'Nothing';
		$data['message'] = '<p>Seriusly it is nothing</p>';
		$this->load->view('errors/html/error_general', $data);
	}

	public function browser()
	{
		$data['heading'] = 'Browser Suggested';
		$data['message'] = '<p>Please use <b>Google Chrome</b> to open this web</p>';
		$this->load->view('errors/html/error_general', $data);
	}
}
