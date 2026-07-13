<?php
require_once (dirname(dirname(__FILE__))."/preload.php");

if(!logged){
    echo 'error';
    exit;
}

if(!isset($_POST["contact"])){
    echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
    exit;
}

// Extract values from POST data
$whatsapp = isset($_POST["whatsapp"]) ? $_POST["whatsapp"] : '';
$phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
$premium = isset($_POST["premium"]) ? $_POST["premium"] : '';

// Prepare data for API request
$info = [
    'contact' => true,
    'api' => do_config(21),
    'user_id' => $member->user_id,
    'whatsapp' => $whatsapp,
    'phone' => $phone,
    'premium' => $premium
];

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, do_config(127));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute request and get response
$response = curl_exec($ch);
curl_close($ch);

// Try to decode the response as JSON
$data = json_decode($response);

// Handle API response
if(isset($data->status) && $data->status == 'success'){
    echo '<div class="alert alert-success">'.$data->message.'</div>';
} elseif(isset($data->status) && $data->status == 'error'){
    echo '<div class="alert alert-danger">'.$data->message.'</div>';
} else {
    // If not valid JSON, return the raw response
    echo $response;
}

exit;
?>
