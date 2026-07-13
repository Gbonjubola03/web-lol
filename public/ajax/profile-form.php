<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["prfsave"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }
      $info = [
          'prfsave' => true,
          'first_name' => $_POST["first_name"],
          'last_name' => $_POST["last_name"],
          'phone' => $_POST["phone"],
          'country' => $_POST["country"],
          'user_id' => $member->user_id,
          'api' => do_config(21)
      ];
      
      //curl post 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, do_config(127));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      $data = json_decode($response);

      //check response
      if($data->status == 'success'){
            echo $data->message;
            exit;
      }elseif($data->status == 'error'){
            echo '<div class="alert alert-danger">'.$data->message.'</div>';
            exit;
      }
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }

?>