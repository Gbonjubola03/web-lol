<?php
require_once (dirname(dirname(__FILE__)).'/preload.php');

if(!logged){
    echo 'error';
    exit;
}

// Get parameters from URL
$ref = isset($_GET["ref"]) ? $_GET["ref"] : '';
$status = isset($_GET["status"]) ? $_GET["status"] : '';
$user_id = isset($_GET["user_id"]) ? intval($_GET["user_id"]) : 0;
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Prepare data for API request
$info = [
    'process_payment' => true,
    'api' => do_config(21),
    'ref' => $ref,
    'status' => $status,
    'user_id' => $user_id,
    'id' => $id
];

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, do_config(127));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute request and decode response
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response);

// Handle API response
if(isset($data->status) && $data->status == 'success'){
    header('location:'.do_config(14).'user/deposit?status=DEPOSIT+SUCCESSFUL');
} elseif(isset($data->status) && $data->status == 'error'){
    header('location:'.do_config(14).'user/deposit?status=TRANSACTION+FAILED&message='.$data->message);
} else {
    // Check if the response is a URL (for redirect)
    if(filter_var($response, FILTER_VALIDATE_URL)) {
        header('location:'.$response);
    } else {
        header('location:'.do_config(14).'user/deposit?status=UNKNOWN+ERROR');
    }
}
exit;
?>
