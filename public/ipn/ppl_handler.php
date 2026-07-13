<?php
 require_once (dirname(dirname(__FILE__)).'/preload.php');

  $token = $_POST['token'];
  
  $payment_info = file_get_contents("https://faucetpay.io/merchant/get-payment/" . $token);
  $payment_info = json_decode($payment_info, true);
  $token_status = $payment_info['valid'];
  
  $merchant_username = $payment_info['merchant_username'];
  $amount1 = $payment_info['amount1'];
  $currency1 = $payment_info['currency1'];
  $amount2 = $payment_info['amount2'];
  $currency2 = $payment_info['currency2'];
  $custom = $payment_info['custom'];
  $transaction_id = $payment_info['transaction_id'];
  
  $my_username = "codesem";
   if($my_username == $merchant_username && $token_status == true) {
      $invoice = $query->addquery('select','invoice_short','*','i',$custom,'id=?');
      if(!$invoice){
        echo 'ERROR';
        exit;
      }
     if($invoice->amount != $amount1){
       echo 'ERROR';
       exit;
     }
     $no_title = "DEPOSIT OF ".$invoice->amount." PAID/CREDITED - INVOICE #".$invoice->id;
     $query->addquery('update','user_short','earnings=earnings+?','si',[$invoice->amount,$invoice->user_id],'user_id=?');
     $query->addquery('update','invoice_short','status=?,txn_id=?,status_text=?','issi',[1,$transaction_id,$token_status,$invoice->id],'id=?'); 
     $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'deposit',"user"]);
     $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'deposit',"admin"]);
     header("HTTP/1.1 200 OK");
     echo 'OK';
  } else {
       echo 'ERROR';
       exit;
  }