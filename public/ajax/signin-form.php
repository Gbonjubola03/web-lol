<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(logged){
      echo 'error';
      exit;
  }
    if(isset($_POST['signin'])){
      if(csrf_token() != $_POST["csrfToken"]){
          echo '<div class="alert alert-danger">ERROR: REQUEST WRONG!</div>';
          exit;
      }
      $info = [
          'signin' => true,
          'username' => $_POST["username"],
          'password' => $_POST["password"],
          'api' => do_config(21)
      ];
    
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, do_config(127));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      $data = json_decode($response);
      //var_export($data);
      //exit;
      if($data->status == 'success'){
            $_SESSION['user']['logged'] = true;
            $_SESSION['user']['uid'] = $data->message->user_id;
            $_SESSION['user']['account'] = $data->message;
            echo 'user';
            exit;
      }elseif($data->status == 'error'){
            echo '<div class="alert alert-danger">'.$data->message.'</div>';
            exit;
      }
   }else{
        echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
        exit;
    }

?>