<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_browser(){
  if(!preg_match('/Chrome/i',$_SERVER['HTTP_USER_AGENT'])){ 
    redirect('error_user/browser');
  } 

  // echo $_SERVER['HTTP_USER_AGENT'];
  // echo preg_match('/Chrome/i',$_SERVER['HTTP_USER_AGENT']);
}