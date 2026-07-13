<?php
require_once (dirname(dirname(__FILE__)).'/preload.php');
if(!logged){
    echo 'error';
    exit;
}


                
// Get the transaction reference from the URL parameter
$trx_ref = $_GET["reference"];
$message = $_GET["message"];
$reference = $_GET["reference"];
$id = $_GET["id"];

$invoice = $query->addquery('select','invoice','*','s',$response->data->reference,'token=?');
    $txn_id = $response->data->reference;
   
if (!$invoice) {
    $response = array('status' => 'error', 'message' => 'Invoice Not Found');
    echo json_encode($response);
    exit;
}



if ($message == 'Successful') {
    $no_title = "DEPOSIT OF ".$invoice->amount." PAID/CREDITED - INVOICE #".$invoice->id;
    $query->addquery('update','users','balance=balance+?','si',[$invoice->amount,$invoice->user_id],'user_id=?');
    
    
    $response = array('status' => 'success', 'message' => 'Deposit Successful');
    echo json_encode($response);
    exit;
{
    $response = array('status' => 'error', 'message' => 'Unknown Transaction Status');
    echo json_encode($response);
    exit;
}
}

?>