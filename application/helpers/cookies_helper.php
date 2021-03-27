<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function helper_cookies($user = NULL){
   	
  $CI =& get_instance();
  $CI->load->model('general_mod');
  $read_cookies    = explode(";",$CI->input->cookie('portal_user'));
  $permission_cookie = $CI->input->cookie('portal_pcms');
  $portal_cookie = $CI->input->cookie('portal_user');
  $link_portal = "https://10.5.252.116";
  $cookies_expired_default = 86400 * 30; //24jam * 30hari;
  if(empty($read_cookies[0])){
    $where["id_user"] 		= $user;
  	$where["login_status"] 	= 1;
  	$datadb = $CI->general_mod->portal_user_db_list($where);
    unset($where);
    
    if($datadb){
      $array_value = $datadb[0]['id_user'].";".$datadb[0]['full_name'].";".$datadb[0]['badge_no'].";".$datadb[0]['username'].";".$datadb[0]['department'].";".$datadb[0]['email'].";".$datadb[0]['sign_id'].";".$datadb[0]['id_role'].";".$datadb[0]['status_user'].";".$link_portal.";".$datadb[0]['project_id'].";".$datadb[0]['company'];

      $id_user_cookies = array(
  			'name' 		=> 'portal_user',
  			'value' 	=> $array_value,
  			'expire' 	=> $cookies_expired_default
      );
      
      $CI->input->set_cookie($id_user_cookies);

  		$app_pcms_permission = array(
  			'name' 		=> 'portal_pcms',
  			'value' 	=> $datadb[0]['pcms_permission'],
  			'expire' 	=> $cookies_expired_default
  		);

  		$CI->input->set_cookie($app_pcms_permission);

  		redirect(base_url().'home/home');
    }
    else{
      $CI->load->helper('cookie');
      delete_cookie('portal_user');	
      delete_cookie('portal_emr');
      delete_cookie('portal_qcs');	
      delete_cookie('portal_pcms');
      delete_cookie('portal_wh');	
      delete_cookie('filterActivityList');
      header("Location: http://10.5.252.108/pcms/public_smoe/logout");
    }
  }
  else{
    if($user){
      if($read_cookies[0] != $user){
        $CI->load->helper('cookie');
        delete_cookie('portal_user');	
        delete_cookie('portal_emr');
        delete_cookie('portal_qcs');	
        delete_cookie('portal_pcms');
        delete_cookie('portal_wh');	
        delete_cookie('filterActivityList');
        header("Location: http://10.5.252.108/pcms/public_smoe/logout");
        return false;
      }
    }
    $where["id_user"] 		= $read_cookies[0];
  	$where["login_status"] 	= 1;
  	$datadb = $CI->general_mod->portal_user_db_list($where);
  	unset($where);

  	if(!$datadb){
      $CI->load->helper('cookie');
      delete_cookie('portal_user');	
      delete_cookie('portal_emr');
      delete_cookie('portal_qcs');	
      delete_cookie('portal_pcms');
      delete_cookie('portal_wh');	
      delete_cookie('filterActivityList');
  		header("Location: http://10.5.252.108/pcms/public_smoe/logout");
    }
    if($datadb[0]['pcms_permission'] != $permission_cookie){
      delete_cookie('portal_pcms');
      $app_pcms_permission = array(
  			'name' 		=> 'portal_pcms',
  			'value' 	=> $datadb[0]['pcms_permission'],
  			'expire' 	=> $cookies_expired_default
  		);
      $CI->input->set_cookie($app_pcms_permission);
      
      redirect($_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], 'refresh');
    }
    
    $array_value = $datadb[0]['id_user'].";".$datadb[0]['full_name'].";".$datadb[0]['badge_no'].";".$datadb[0]['username'].";".$datadb[0]['department'].";".$datadb[0]['email'].";".$datadb[0]['sign_id'].";".$datadb[0]['id_role'].";".$datadb[0]['status_user'].";".$link_portal.";".$datadb[0]['project_id'].";".$datadb[0]['company'];
    if($array_value != $portal_cookie){
      delete_cookie('portal_user');
      $app_pcms_permission = array(
  			'name' 		=> 'portal_user',
  			'value' 	=> $array_value,
  			'expire' 	=> $cookies_expired_default
  		);
      $CI->input->set_cookie($app_pcms_permission);
      
      redirect($_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], 'refresh');
    }
  }

  $validate_permission_cookies = explode(";",$CI->input->cookie('portal_pcms'));    
  $validate_cookies = count(array_keys($validate_permission_cookies, "1"));   
  if($validate_cookies <= 0){        
    redirect(base_url()."Error_access/error_page");
  }

}

function base_url_ftp(){
  return "https://10.5.252.116/pcms_ori/";
}

function upload_ftp_server($source, $destination){
  $CI =& get_instance();

  $CI->load->model('general_mod');
  $ftpsrc = $CI->general_mod->ftp_find_master();

  //print_r($ftpsrc);exit;

  include_once APPPATH.'third_party/Net/SFTP.php';
  $ftp = [
    "hostname" => $ftpsrc[0]['hostname'],//Destination
    "username" => $ftpsrc[0]['username'],//username
    "password" => $ftpsrc[0]['password'],//password
  ];
  // print_r($ftp);exit;
  $sftp = new Net_SFTP($ftp['hostname']);
  if (!$sftp->login($ftp['username'], $ftp['password'])) {
    $CI->load->library('ftp');
    $ftp_config['hostname'] = $ftp['hostname']; 
    $ftp_config['username'] = $ftp['username'];
    $ftp_config['password'] = $ftp['password'];
    $ftp_config['debug']    = TRUE;
    $CI->ftp->connect($ftp_config);
    $destination 			= 'pcms_ori/'.$destination;
    $CI->ftp->upload($source, $destination);
    $CI->ftp->close();
    // @unlink($source);
  }
  else {
    $destination  = '/var/www/pcms_ori/'.$destination;
    $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
    // @unlink($source);
  }
}

function cek_login($cookie = NULL){
// echo 'asd';
	// print_r($cookie);

	if($cookie == ""){
		// echo '5';
		header('Location: /portal');
		
	}
	// exit;
}

function test_var($value, $pass = 0){
  echo '<pre>';
  print_r($value);
  echo '</pre>';
  if($pass == 0){
    exit;
  }
}

function convert2utf8($data){
  // translate UTF8 to English characters
  $data = iconv('UTF-8', 'ASCII//TRANSLIT', $data);
  // $data = preg_replace("/[\'\"\^\~\`]/i", '', $data);

  return $data;
}

function convert2null($form_data){
  foreach ($form_data as $key => $value) {
    if(is_array($value)){
      foreach ($value as $key2 => $value2) {
        if($value2 == '' && $value2 != 0){
          $form_data[$key][$key2] = NULL;
        }
      }
    }
    else{
      if($value == '' && $value != 0){
        $form_data[$key] = NULL;
      }
    }
  }
  return $form_data;
}

function send_email_smtp($data){
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
  $ci->email->from('smtpservice.batam@sembmarine.com', 'No Reply - PCMS Support');
  
  $ci->email->to($data["to"]);
  if(isset($data['cc'])){
    $ci->email->cc($data["cc"]);
  }
  if(isset($data['bcc'])){
    $ci->email->bcc($data["bcc"]);
  }
  $ci->email->subject($data["subject"]);
  $ci->email->message($data["message"]);
  $ci->email->send();
}

?>