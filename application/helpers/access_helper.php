<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 function get_client_ip_data() {
         $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function access_helper(){
   	
    $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    $CI =& get_instance();
    $read_cookies      = explode(";",$CI->input->cookie('portal_user'));
    $CI->load->model('general_mod');

    // parameter
    $param['user_id']      = $read_cookies[0];
    $param['ip_address']   = get_client_ip_data();
    $param['access_link']  = $actual_link;

    $CI->general_mod->insert_access_log($param);

}

?>