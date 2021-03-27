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

function approval_log($approved_table = "", $approved_category = "", $approved_request_no = ""){
   
    $CI =& get_instance();

    $CI->load->helper('cookie');
    $user_cookie = explode(";",$CI->input->cookie('portal_user'));
 
    // paramter
    $param['approved_ip_address']   = get_client_ip_data();
    $param['approved_table']        = $approved_table;
    $param['approved_category']     = $approved_category;
    $param['approved_request_no']   = $approved_request_no;
    $param['approved_by']           = $user_cookie['0'];
    
    //load model log
    $CI->load->model('approval_log');
 
    //save to database
    $CI->approval_log->save_log($param);
}