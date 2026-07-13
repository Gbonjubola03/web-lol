<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
   if(logged){
      echo 'error';
      exit;
   }
    if(isset($_POST['signup'])){
    
    
      //start connection
      $ip_address = get_ip();
      $info = [
          'signup' => true,
          'type' => $_POST["type"],
          'username' => $_POST["username"],
          'email' => $_POST["email"],
          'password' => $_POST["password"],
          'confpass' => $_POST["confpass"],
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
         $no_title = "NEW USER SIGNUP ".$_POST["username"]." BY IP (".$ip_address.")";
         $query->addquery('insert','notifications','user_id,title,type,role','isss',[$data->message,$no_title,'users',"admin"]);
         echo 'OK';
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