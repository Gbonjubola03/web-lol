<?php
require_once (dirname(dirname(__FILE__))."/preload.php");

// Set content type to JSON
header('Content-Type: application/json');

// Check if user is logged in
if(!logged){
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

// Check if form was submitted with the required ID field
if(!isset($_POST["id"]) || empty($_POST["id"])){
    echo json_encode(['status' => 'error', 'message' => 'Please provide a product ID']);
    exit;
}

// Get the ID from the form submission
$id = intval($_POST["id"]);

// Construct the URL for the API call with GET parameters
$apiUrl = do_config(127) . "?delete&id=" . $id;

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'api' => do_config(21)
]));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute request and decode response
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Try to decode the response as JSON
$data = json_decode($response);

// Handle API response
if(isset($data->status) && $data->status == 'success'){
    // Success - return success information
    echo json_encode([
        'status' => 'success',
        'message' => 'Product deleted successfully',
        'redirect' => do_config(14).'user/services'
    ]);
} elseif(isset($data->status) && $data->status == 'error'){
    echo json_encode(['status' => 'error', 'message' => $data->message]);
} else {
    // If response couldn't be parsed as JSON, return error
    echo json_encode([
        'status' => 'error', 
        'message' => 'Error processing request: ' . $response,
        'httpCode' => $httpCode
    ]);
}
exit;
?>
