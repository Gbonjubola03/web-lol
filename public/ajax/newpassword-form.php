<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(logged){
      echo 'error';
      exit;
  }
  
  if(isset($_POST['newpassword'])){
      $token = $_POST["token"];
      
      if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if(empty(str_replace(' ', '', trim($token)))){
            echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
            exit;
        }
        
        // Make API request to Pinnocent
        $url = do_config(127);

        
        // Prepare the data for the API request
        $postData = [
            'newpassword' => true,
            'token' => $token,
            'new_password' => $_POST["new_password"],
            'confirm_password' => $_POST["confirm_password"],
            'api' => do_config(21)
        ];
        
        // Initialize cURL session
        $ch = curl_init();
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        // Execute the cURL request
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if(curl_errno($ch)){
            echo '<div class="alert alert-danger">Error: Connection failed: ' . curl_error($ch) . '</div>';
            curl_close($ch);
            exit;
        }
        
        // Get HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Check for HTTP errors
        if($httpCode >= 400){
            echo '<div class="alert alert-danger">Error: API returned error code ' . $httpCode . '</div>';
            exit;
        }
        
        // Process the API response
        $apiResponse = json_decode($response, true);
        
        if(json_last_error() !== JSON_ERROR_NONE){
            // Not a valid JSON response
            if(strpos($response, 'OK') !== false){
                echo 'OK';
            } else {
                echo '<div class="alert alert-danger">Error: Invalid response from API</div>';
            }
            exit;
        }
        
        // Handle the API response
        if(isset($apiResponse['status']) && $apiResponse['status'] === 'success'){
            echo 'OK';
        } else {
            $errorMessage = isset($apiResponse['message']) ? $apiResponse['message'] : 'Unknown error occurred';
            echo '<div class="alert alert-danger">Error: ' . $errorMessage . '</div>';
        }
        
        exit;
      } else {
        echo '<div class="alert alert-danger">Error: Something wrong! Please try again.</div>';
        exit;
      }
  } else {
      echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
      exit;
  }
?>
