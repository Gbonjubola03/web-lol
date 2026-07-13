<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["emailverify"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> ERROR: REQUEST WRONG!</div>';
        exit;
    }
    if(reCaptcha() == false){
        echo '<div class="alert alert-danger"><i class="fa fa-times"></i> Error: Captcha wrong, Please try again. </div>';
        exit;
    }
    $token = strtoupper(do_token(5));
    $emailcoded = base64_encode($member->email);
    $tsmponcheck = date("F j, Y \a\t g:ia");
    if($member->security_check == 1){
      //already verified
        echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> Error: Wrong request, Already verified! </div>';
        exit;
    }
    //secure verification 
    $upverify = $query->addquery('update','members','security_check=?,token=?','ssi',[$tsmponcheck,$token,$member->user_id],'user_id=?');
    if(!$upverify){
      //problem on update user
        echo '<div class="alert alert-danger"><i class="fa fa-times"></i> Error: Wrong request, Please try again! </div>';
        exit;
     }
    //Send verification e-mail
    $array = ['m_user'=>$member->username,
                    'm_subject'=>'Confirm your account at '.do_config(0),
                    'm_avatar'=>do_config(14).$member->avatar,
                    'm_token'=>$token,
                    'm_encode'=>$emailcoded
                  ];
                  do_maildata('activate',$array);
                  $mail = mailer(['from'=>do_config(41),'to'=>$email,'subject'=>'Confirm your account at '.do_config(0),'msg'=> file_get_contents(ROOT."/incs/mailer.php")]);
                 if(!$mail){
                   echo $mail;
                   exit;
                 }
   }

?>