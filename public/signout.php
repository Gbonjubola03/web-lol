<?php

 require_once ('preload.php'); 

 session_destroy();
 header("Location:" .do_config(14));
 exit;
?>