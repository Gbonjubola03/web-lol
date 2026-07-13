<?php
require_once (dirname(dirname(__FILE__))."/preload.php");

if(!logged){
    echo 'error';
    exit;
}

if(!isset($_POST["track"])){
    echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
    exit;
}


// Extract values from POST data
$pname = isset($_POST["pname"]) ? $_POST["pname"] : '';
$image = isset($_POST["image"]) ? $_POST["image"] : '';
$shipdate = isset($_POST["shipdate"]) ? $_POST["shipdate"] : '';
$saddress = isset($_POST["saddress"]) ? $_POST["saddress"] : '';
$sname = isset($_POST["sname"]) ? $_POST["sname"] : '';
$raddress = isset($_POST["raddress"]) ? $_POST["raddress"] : '';
$rname = isset($_POST["rname"]) ? $_POST["rname"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$status = isset($_POST["status"]) ? $_POST["status"] : '';
$location = isset($_POST["location"]) ? $_POST["location"] : '';
$pdate = isset($_POST["pdate"]) ? $_POST["pdate"] : '';
$pid = isset($_POST["pid"]) ? $_POST["pid"] : '';
$edd = isset($_POST["edd"]) ? $_POST["edd"] : '';
$weight = isset($_POST["weight"]) ? $_POST["weight"] : '';
$servicetype = isset($_POST["servicetype"]) ? $_POST["servicetype"] : '';
$pdesc = isset($_POST["pdesc"]) ? $_POST["pdesc"] : '';
$qty = isset($_POST["qty"]) ? $_POST["qty"] : '';
$remark = isset($_POST["remark"]) ? $_POST["remark"] : '';

// Prepare data for API request
$info = [
    'track' => true,
    'api' => do_config(21),
    'user_id' => $member->user_id,
    'pname' => $pname,
    'image' => $image,
    'shipdate' => $shipdate,
    'saddress' => $saddress,
    'sname' => $sname,
    'raddress' => $raddress,
    'rname' => $rname,
    'email' => $email,
    'status' => $status,
    'location' => $location,
    'pdate' => $pdate,
    'pid' => $pid,
    'edd' => $edd,
    'weight' => $weight,
    'servicetype' => $servicetype,
    'pdesc' => $pdesc,
    'qty' => $qty,
    'remark' => $remark,
    'amount' => do_config(49),
    'csrfToken' => $_POST["csrfToken"]
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

// Check for cURL errors
if(curl_errno($ch)) {
    echo '<div class="alert alert-danger">Error: ' . curl_error($ch) . '</div>';
    curl_close($ch);
    exit;
}

curl_close($ch);
$data = json_decode($response);

// Handle API response
if(isset($data->status) && $data->status == 'success'){
    echo '<div class="alert alert-success">'.$data->message.'</div>';
} elseif(isset($data->status) && $data->status == 'error'){
    echo '<div class="alert alert-danger">'.$data->message.'</div>';
} else {
    // Check if the response is a URL (for redirect)
    if(filter_var($response, FILTER_VALIDATE_URL)) {
        echo $response; // Return the URL for redirection
    } else {
        echo $response; // Return error message or raw response
    }
}
exit;
?>
