<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  
  if(!isset($_POST["newservice"])){
      echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
      exit;
  }
  
  // Extract values from POST data
  $type = isset($_POST["type"]) ? $_POST["type"] : '';
  $preview = isset($_POST["preview"]) ? $_POST["preview"] : '';
  $fa2_enabled = isset($_POST["2fa_enabled"]) ? $_POST["2fa_enabled"] : '';
  $title = isset($_POST["name"]) ? $_POST["name"] : '';
  $description = isset($_POST["description"]) ? $_POST["description"] : '';
  $price = isset($_POST["price"]) ? $_POST["price"] : '';
  $instructions = isset($_POST["instructions"]) ? $_POST["instructions"] : '';
  $password = isset($_POST["password"]) ? $_POST["password"] : '';
  $contact = isset($_POST["contact"]) ? $_POST["contact"] : '';
  
  // Conditional fields based on type
  $email = ($type == 'email' && isset($_POST["email"])) ? $_POST["email"] : '';
  $profile_link = ($type == 'email' && isset($_POST["profile_link"])) ? $_POST["profile_link"] : '';
  $access_link = ($type == 'access_link' && isset($_POST["access_link"])) ? $_POST["access_link"] : '';
  
  // Generate link from title
  $link = do_btitle($title);
  
  // Prepare data for API request
  $info = [
      'newservice' => true,
      'api' => do_config(21),
      'user_id' => $member->user_id,
      'name' => $title,
      'price' => $price,
      'description' => $description,
      'instructions' => $instructions,
      '2fa_enabled' => $fa2_enabled,
      'type' => $type,
      'password' => $password,
      'contact' => $contact,
      'preview' => $preview,
      'link' => $link,
        ];
  
  // Add conditional fields based on type
  if ($type == 'email') {
      $info['email'] = $email;
      $info['profile_link'] = $profile_link;
  } elseif ($type == 'access_link') {
      $info['access_link'] = $access_link;
  }
  
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
