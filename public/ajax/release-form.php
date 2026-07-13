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
      echo json_encode(['status' => 'error', 'message' => 'Please provide an order ID']);
      exit;
  }

  // Get the ID from the form submission
  $id = intval($_POST["id"]);
  
  // Construct the URL for the API call with GET parameters
  $apiUrl = do_config(127) . "?release=1&id=" . $id;
  
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
  curl_close($ch);
  
  // Try to decode the response as JSON
  $data = json_decode($response);

  // Handle API response
  if(isset($data->status) && $data->status == 'success'){
     // Success - return redirect information
     echo json_encode([
         'status' => 'success',
         'redirect' => do_config(14).'user/order?id='.$id.'&message=MONEY+WAS+RELEASED+TO+SELLER'
     ]);
  } elseif(isset($data->status) && $data->status == 'error'){
      echo json_encode(['status' => 'error', 'message' => $data->message]);
  } else {
      // Check if the response is a URL (for redirect)
      if(filter_var($response, FILTER_VALIDATE_URL)) {
          echo json_encode(['status' => 'redirect', 'url' => $response]);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Error: ' . $response]);
      }
  }
  exit;
?>
