<?php
require_once (dirname(dirname(__FILE__)).'/preload.php');
if(!logged){
    echo 'error';
    exit;
}

// Get the request parameters
$amount = $_POST['amount'];

// Update the invoice status and transaction ID
$query->addquery('update','invoice','status=?,txn_id=?,status_text=?','issi',[1,$txn_id,"SUCCESS",$invoice_id],'id=?');

// Update the user balance
$query->addquery('update','users','balance=balance+?','si',[$amount,$user_id],'user_id=?');

// Insert notifications
$query->addquery('insert','notifications','user_id,title,type,role','isss',[$user_id,$no_title,'deposit',"user"]);
$query->addquery('insert','notifications','user_id,title,type,role','isss',[$user_id,$no_title,'deposit',"admin"]);

// Return a success response
echo 'success';
?>
