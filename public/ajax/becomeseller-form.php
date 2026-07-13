<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["becomeseller"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }
     $becomeseller = $_POST["becomeseller"];
     
     if(empty(str_replace(' ', '', trim($becomeseller)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     
    /* Update profile Information */
    $data = $query->addquery('update','users','type=?','si',['seller',$member->user_id],'user_id=?');
    $array = ['m_user'=>$member->username,
              'm_subject'=>'YOU BECAME A SELLER',
              'm_comment'=>'You became a new seller on '.do_config(1).' get verified and start selling Your social accounts.',
             ];
    do_maildata('message',$array);
    $mailer = mailer(['from'=>do_config(32),'to'=>$member->email,'subject'=>'YOU BECAME A SELLER','msg'=>fetch('/public/mail/template.php')]);
    
    //updated
        echo '<div class="alert alert-success">'.$mailer.'You became a seller, You will need to verify to start.</div>';
        exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }

?>