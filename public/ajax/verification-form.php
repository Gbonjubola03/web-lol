<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if(isset($_POST["verification"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }
      $info = [
          'verification' => true,
          'user_id' => $member->user_id,
          'ful_name' => $_POST["ful_name"],
          'preview' => $_POST["preview"],
          'backcard' => $_POST["backcard"],
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
            //$_SESSION['user']['account'] = $data->message;
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