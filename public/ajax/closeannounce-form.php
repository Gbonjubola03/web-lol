<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(isset($_POST["close"])){
     $time = $_POST["close"];
     setcookie('closed', 1, time()+ $time, '/', $_SERVER['HTTP_HOST']);
  }
?>