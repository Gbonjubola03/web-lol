<?php
 require_once (dirname(dirname(__FILE__)).'/preload.php');

 $secret_key = do_config(46);

 $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$_GET["reference"],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer $secret_key",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  $response = json_decode($response);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $invoice = $query->addquery('select','invoice','*','s',$response->data->reference,'token=?');
    $txn_id = $response->data->reference;

    if($response->status == 'true'){
        
    /* transaction successful */
     $no_title = "DEPOSIT OF ".$invoice->amount." PAID/CREDITED - INVOICE #".$invoice->id;
     $query->addquery('update','users','balance=balance+?','si',[$invoice->amount,$invoice->user_id],'user_id=?');
     $query->addquery('update','invoice','status=?,txn_id=?,status_text=?','issi',[1,$txn_id,"SUCCESS",$invoice->id],'id=?'); 
     $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'deposit',"user"]);
     $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'deposit',"admin"]);
    } else {
       echo 'ERROR';
       exit;
    }
    
    header('location:'.do_config(14).'user/deposit?status='.$no_title);
	exit;
  }
  