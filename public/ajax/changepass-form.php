<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["passave"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }
     $currentpassword = md5($_POST["currentpassword"]);
     $newpassword = md5($_POST["newpassword"]);
     $confpassword = md5($_POST["confpassword"]);

     if(empty(str_replace(' ', '', trim($_POST["currentpassword"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["newpassword"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["confpassword"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     //email first
     if($newpassword != $confpassword){
         echo '<div class="alert alert-danger">Error: New passwords does not match.</div>';
         exit;
     }
     if($member->password == $currentpassword){
         $query->addquery('update','users','password=?','si',[$newpassword,$member->user_id],'user_id=?');
         
         //changed
         echo '<div class="alert alert-success">Your password was changed.</div>';
         exit;
     }     
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }

?>