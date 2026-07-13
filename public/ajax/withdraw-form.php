<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["withdraw"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> ERROR: REQUEST WRONG!</div>';
        exit;
    }
     $amount = do_amount($_POST["amount"], FALSE);
     $method = $_POST["method"];
     $token = strtoupper(do_token(5));
     $account = $_POST["account"];
     
     if($member->earnings < do_amount(do_config(5), FALSE)){
         echo '<div class="alert alert-danger"><i class="fa fa-times"></i> You must reach the requirements ('.do_amount(do_config(5)).') amount before you can withdraw</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($amount)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($method)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($account)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     
     //Create withdrawal
     $id = $query->addquery('insert','withdrawal','user_id,method,account,amount','isss',[$member->user_id,$method,$account,$amount]);
    $query->addquery('update','users','earnings=earnings-?','si',[$member->earnings,$member->user_id],'user_id=?');
    
     $no_title = "NEW WITHDRAWAL BY ".$member->username." (#".$id.")";
     $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'withdraw',"admin"]);
     $no_title = "NEW WITHDRAWAL (#".$id.")";
     $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'withdraw',"user"]);
     
     //Redirect To Invoice
     echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> YOUR WITHDRAWAL #'.$id.' ON THE WAY!</div>';
     exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }
?>