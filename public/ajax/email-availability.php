<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");

    if(isset($_POST['email']) && !empty(trim($_POST['email']))){

        if(preg_match('/\s/',$_POST['email'])){
            //email contain whitespace
            echo '<small class="red-color"> Email must not contain whitespace.</small>';
            exit;
        }
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
             //email Invalid
             echo '<small class="red-color"> Invalid email format</small>';
             exit;
        }
        $data = $query->num_rows('users','*','s',$_POST['email'],'email=?');
        if($data > 0) {
            //email taken
            echo '<small class="red-color"> Email already registered.</small>';
        }elseif($data == 0){
            //email available
            echo '<small class="green-color"> Email Correct.</small>';
        }
        
   }

?>