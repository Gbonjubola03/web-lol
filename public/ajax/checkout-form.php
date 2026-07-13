<?php
require_once (dirname(dirname(__FILE__))."/preload.php");
if(!logged){
    echo 'error';
    exit;
}

// Process the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug log
    error_log("POST data received: " . print_r($_POST, true));
    
    // Validate required fields
    $required_fields = ['invoice_id', 'amount', 'name', 'email'];
    $missing_fields = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }
    
    if (!empty($missing_fields)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Required fields missing: ' . implode(', ', $missing_fields)
        ]);
        exit;
    }
    
    // Extract required data from the POST array
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $invoice_id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : '';
    
   // Get API response and extract credentials
$api_response = viewpapi($member->user_id);
$api_data = json_decode($api_response, true);

// Check if we have valid API credentials
if (!isset($api_data['api_credentials'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unable to process payment at this time. Please try again later.'
    ]);
    error_log("API credentials not found in API response");
    exit;
}

// Extract API credentials
$api_credentials = $api_data['api_credentials'];

    
    // Generate unique payment reference
    $paymentReference = 'INV' . time() . rand(1000, 9999);
    
    // Update database with payment reference
    global $query;
    $query->addquery('update','invoice','token=?','si',[$paymentReference,$invoice_id],'id=?');
    $query->addquery('update','invoice','txn_id=?','si',[$paymentReference,$invoice_id],'id=?');
    
    // Process amount - ensure it's a valid number in kobo (cents)
    $cleanAmount = preg_replace('/[^0-9.]/', '', $amount);
    $amountInKobo = (int)(floatval($cleanAmount) * 100);
    
    // Get domain for callback URLs
    $mainDomain = $_SERVER['HTTP_HOST'];
    
    // Create callback URLs
    $failureRedirect = 'https://' . $mainDomain . '/ipn/callback-qorepay?status=failed&ref=' . $paymentReference . '&user_id=' . $user_id . '&id=' . $id;
    $successRedirect = 'https://' . $mainDomain . '/ipn/callback-qorepay?status=success&ref=' . $paymentReference . '&user_id=' . $user_id . '&id=' . $id;
    
    // Prepare request data
    $requestData = [
        'client' => [
            'email' => $email
        ],
        'purchase' => [
            'currency' => 'NGN',
            'products' => [
                [
                    'name' => $name,
                    'quantity' => 1,
                    'price' => $amountInKobo
                ]
            ]
        ],
        'brand_id' => $api_credentials['brand_id'],
        'failure_redirect' => $failureRedirect,
        'success_redirect' => $successRedirect
    ];
    
    // Convert to JSON
    $jsonData = json_encode($requestData);
    
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, 'https://gate.qorepay.com/api/v1/purchases/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $api_credentials['api_key'],
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    
    // Execute cURL request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    
    // Close cURL session
    curl_close($ch);
    
    // Debug log
    error_log("API Response: " . $response);
    
    // Handle cURL errors
    if ($curlError) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Connection error: ' . $curlError
        ]);
        exit;
    }
    
    // Handle empty response
    if (empty($response)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Empty response from payment gateway'
        ]);
        exit;
    }
    
    // Try to parse JSON response
    $responseData = json_decode($response, true);
    
    // Handle JSON parsing errors
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid response format from payment gateway'
        ]);
        exit;
    }
    
    // Check for error in response
    if (isset($responseData['error']) || $httpCode >= 400) {
        $errorMessage = isset($responseData['error']) ?
            (is_string($responseData['error']) ? $responseData['error'] : json_encode($responseData['error'])) :
            'Payment gateway returned an error';
        
        echo json_encode([
            'status' => 'error',
            'message' => $errorMessage
        ]);
        exit;
    }
    
    // Extract checkout URL
    $checkoutUrl = null;
    
    if (isset($responseData['checkout_url'])) {
        $checkoutUrl = $responseData['checkout_url'];
    } elseif (isset($responseData['data']['checkout_url'])) {
        $checkoutUrl = $responseData['data']['checkout_url'];
    } elseif (isset($responseData['url'])) {
        $checkoutUrl = $responseData['url'];
    } elseif (isset($responseData['data']['url'])) {
        $checkoutUrl = $responseData['data']['url'];
    }
    
    // Store response in session for reference
    $_SESSION['user']['deposit'] = $response;
    
    // Return success with checkout URL if found
    if ($checkoutUrl) {
        echo json_encode([
            'status' => 'success',
            'checkout_url' => $checkoutUrl,
            'reference' => $paymentReference
        ]);
        exit;
    }
    
    // If we get here, no checkout URL was found
    echo json_encode([
        'status' => 'error',
        'message' => 'Unable to generate checkout URL. Please try again.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

exit;
?>
