<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["uproof"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }
     $invid = $_POST["invoice_id"];
     $proof = $_POST["proof"];
     $method = $_POST["method"];

     if(empty(str_replace(' ', '', trim($invid)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($proof)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     $query->addquery('update','invoice','proof=?','si',[$proof,$invid],'id=?');
     echo 'OK';
     exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }
?>