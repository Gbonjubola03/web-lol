<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");

    if(isset($_POST['username']) && !empty(trim($_POST['username']))){
        $protected = explode(',',do_config(12));
        
        if(strlen($_POST['username']) < 4){
            //username contain whitespace
            echo '<small class="red-color"> Username must be longer</small>';
            exit;
        }
        if(preg_match('/\s/',$_POST['username'])){
            //username contain whitespace
            echo '<small class="red-color"> Username must not contain whitespace.</small>';
            exit;
        }
        if(in_array($_POST['username'], $protected)){
            //username protected
            echo '<small class="red-color"> Username Not Available.</small>';
            exit;
        }
        $data = $query->num_rows('users','*','s',$_POST['username'],'username=?');
        if($data > 0) {
            //username taken
            echo '<small class="red-color"> Username Not Available.</small>';
        }elseif($data == 0){
            //username available
            echo '<small class="green-color"> Username Available.</small>';
        }
        
   }

?>