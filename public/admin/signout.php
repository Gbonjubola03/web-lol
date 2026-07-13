<?php

 require_once (dirname(dirname(__FILE__)).'/preload.php'); 

 session_destroy();
 header("Location:" .do_config(14).'auth/login');
 exit;
?>