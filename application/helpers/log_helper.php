<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  
    function get_client_ip() {
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

function helper_log($tipe = "", $str = "", $str_user = ""){

   
    $CI =& get_instance();

    $CI->load->helper('cookie');
    $user_cookie = explode(";",$CI->input->cookie('portal_user'));

  
 
    if (strtolower($tipe) == "login"){
        $log_tipe  = 0;
    }
    elseif(strtolower($tipe) == "logout")
    {
        $log_tipe  = 1;
    }
    elseif(strtolower($tipe) == "add")
    {
        $log_tipe  = 2;
    }
    elseif(strtolower($tipe) == "update")
    {
        $log_tipe  = 3;
    }
    elseif(strtolower($tipe) == "submited")
    {
        $log_tipe  = 4;
    }
    elseif(strtolower($tipe) == "drafted")
    {
        $log_tipe  = 5;   
    }
    elseif(strtolower($tipe) == "rejected")
    {
        $log_tipe  = 6;   
    }
    elseif(strtolower($tipe) == "approved")
    {
        $log_tipe  = 7;   
    }
    elseif(strtolower($tipe) == "delete")
    {
        $log_tipe  = 8;   
    }
    else{
        $log_tipe  = 9;
    }
 
    // paramter
    $param['username']      = $user_cookie['1'];
    $param['ip_address']    = get_client_ip();
    $param['method']        = $log_tipe;
    $param['history_log']   = $str;
    $param['user_log']      = $str_user;
    $param['pcms_type']     = '1';
 
    //load model log
    $CI->load->model('m_log');
 
    //save to database
    $CI->m_log->save_log($param);
}