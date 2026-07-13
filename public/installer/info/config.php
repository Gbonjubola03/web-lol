<?php

 if ($info->install == 'off'){
     header("Location: http://".$_SERVER['HTTP_HOST']);
     exit;
 }


if (!defined('APP')) {
    define('APP', 'PINNOCENT');
}

 define('VERSION','1.0.0');
 define('DEV',"https://pinnocent.com");

 function check_conn_db($host,$user,$pass,$dbname){
      $mycheck = new mysqli($host, $user, $pass, $dbname);
      if($mycheck->connect_errno){
           return true;
      }else{
         return false;
      }
  }
?>