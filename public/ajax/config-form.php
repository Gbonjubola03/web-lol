<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if($member->role != 'admin'){
      echo 'error';
      exit;
  }
  if(isset($_POST["general"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["url"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["name"],'name'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["site_title"],'site_title'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["site_description"],'site_description'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["keywords"],'keywords'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["home_sec_desc"],'home_sec_desc'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["url"],'url'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["account_activate_email"],'account_activate_email'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["meta_perfix"],'meta_perfix'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["position"],'position'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["amount_decimal"],'amount_decimal'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["support_email"],'support_email'],'header=?');

    //changed
         echo '<div class="alert alert-success">Your general configuration was saved.</div>';
  }
  if(isset($_POST["design"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["logo_url"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["icon_url"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["logo_url"],'logo_url'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["icon_url"],'icon_url'],'header=?');
    //changed
         echo '<div class="alert alert-success">Your design configuration was saved.</div>';
  }
  if(isset($_POST["integration"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["head_code"],'head_code'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["body_code"],'body_code'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["footer_code"],'footer_code'],'header=?');
    //changed
         echo '<div class="alert alert-success">Your integration configuration was saved.</div>';
  }
  if(isset($_POST["captcha"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["reCAPTCHA_site_key"],'reCAPTCHA_site_key'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["reCAPTCHA_secret_key"],'reCAPTCHA_secret_key'],'header=?');
    //changed
         echo '<div class="alert alert-success">Your captcha configuration was saved.</div>';
  }
  if(isset($_POST["system"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["min_deposit"],'min_deposit'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["currency"],'currency'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["protected_usernames"],'protected_usernames'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["admin_percent"],'admin_percent'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["cpc_cost"],'cpc_cost'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["api_link"],'api_link'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["api"],'api'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["min_withdraw"],'min_withdraw'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["verification_notice"],'verification_notice'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["verification_price"],'verification_price'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["enable_email_victims"],'enable_email_victims'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["enable_promote"],'enable_promote'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["announce_timer"],'announce_timer'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["fraud_clicks"],'fraud_clicks'],'header=?');


    //changed
         echo '<div class="alert alert-success">Your system configuration was saved.</div>';
  }
  if(isset($_POST["ads"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["ads"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["merchant_percent"],'merchant_percent'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["merchant_notice"],'merchant_notice'],'header=?');
    //changed
         echo '<div class="alert alert-success">Your ads configuration was saved.</div>';
  }
  if(isset($_POST["deposits"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["deposits"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["amount_tax"],'amount_tax'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["paystack_public_key"],'paystack_public_key'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["paystack_secret_key"],'paystack_secret_key'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["bank_informations"],'bank_informations'],'header=?');
    //changed
         echo '<div class="alert alert-success">Your deposits configuration was saved.</div>';
  }
  if(isset($_POST["email"])){
     if(do_config(44) == 1){
         echo '<div class="alert alert-danger">Error: Not allowed on demo mode.</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($_POST["email"])))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
         $query->addquery('update','config','value=?','ss',[$_POST["mailer_option"],'mailer_option'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["mailer_username"],'mailer_username'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["mailer_host"],'mailer_host'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["mailer_port"],'mailer_port'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["mailer_use"],'mailer_use'],'header=?');
         $query->addquery('update','config','value=?','ss',[$_POST["mailer_pass"],'mailer_pass'],'header=?');

    //changed
         echo '<div class="alert alert-success">Your e-mail configuration was saved.</div>';
  }
?>