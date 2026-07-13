<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  
  // Check if user is logged in
  if(!logged){
      echo 'error';
      exit;
  }

  // Check if form was submitted
  if(!isset($_POST["deposit"])){
      echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
      exit;
  
  }

  // Prepare data for API request
  $info = [
      'deposit' => true,
      'api' => do_config(21),
      'amount' => $_POST["amount"],
      'method' => $_POST["method"],
      'user_id' => $member->user_id
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
      echo '<div class="alert alert-success">'.$data->message.'</div>';
  } elseif(isset($data->status) && $data->status == 'error'){
      echo '<div class="alert alert-danger">'.$data->message.'</div>';
  } else {
      // Check if the response is a URL (for redirect)
      if(filter_var($response, FILTER_VALIDATE_URL)) {
          echo $response; // Return the URL for redirection
      } else {
          echo $response; // Return error message
      }
  }
  exit;
?>
