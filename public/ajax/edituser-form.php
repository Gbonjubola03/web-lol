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

if(!isset($_POST["edituser"])){
    echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
    exit;
}

// Extract values from POST data
$user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';
$username = isset($_POST["username"]) ? $_POST["username"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$balance = isset($_POST["balance"]) ? $_POST["balance"] : '';
$earnings = isset($_POST["earnings"]) ? $_POST["earnings"] : '';
$role = isset($_POST["role"]) ? $_POST["role"] : '';
$phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
$whatsapp = isset($_POST["whatsapp"]) ? $_POST["whatsapp"] : '';
// Permission values - Convert checkbox values to proper format
$users = isset($_POST["users"]) ? 1 : 2;
$services = isset($_POST["services"]) ? 1 : 2;
$verifications = isset($_POST["verifications"]) ? 1 : 2;
$orders = isset($_POST["orders"]) ? 1 : 2;
$websites = isset($_POST["websites"]) ? 1 : 2;
$campaigns = isset($_POST["campaigns"]) ? 1 : 2;
$links = isset($_POST["links"]) ? 1 : 2;
$statements = isset($_POST["statements"]) ? 1 : 2;
$invoices = isset($_POST["invoices"]) ? 1 : 2;
$withdrawals = isset($_POST["withdrawals"]) ? 1 : 2;
$settings = isset($_POST["settings"]) ? 1 : 2;

// Prepare data for API request
$info = [
    'edituser' => true,
    'api' => do_config(21),
    'user_id' => $user_id,
    'username' => $username,
    'email' => $email,
    'balance' => $balance,
    'earnings' => $earnings,
    'phone' => $phone,
    'whatsapp' => $whatsapp,
    'role' => $role,
    'role' => $role,
    'users' => $users,
    'services' => $services,
    'verifications' => $verifications,
    'orders' => $orders,
    'websites' => $websites,
    'campaigns' => $campaigns,
    'links' => $links,
    'statements' => $statements,
    'invoices' => $invoices,
    'withdrawals' => $withdrawals,
    'settings' => $settings
];

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, do_config(127));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute request
$response = curl_exec($ch);
curl_close($ch);

// Try to decode JSON response
$data = json_decode($response);

// Handle API response
if($data && isset($data->status)) {
    // JSON response handling
    if($data->status == 'success'){
        echo '<div class="alert alert-success">'.$data->message.'</div>';
    } else {
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
} else {
    // Direct HTML response (which is what your API now returns)
    echo $response;
}
exit;
?>
