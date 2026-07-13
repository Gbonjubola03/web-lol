<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if($member->role != 'admin'){
      echo 'error';
      exit;
  }
  if(isset($_POST["editpage"])){
     $id = $_POST["id"];
     $title = $_POST["title"];
     $content = $_POST["content"];
     //$link = $_POST["link"];

     if(empty(str_replace(' ', '', trim($id)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($title)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($content)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }

    /* update user */
    $query->addquery('update','pages','title=?,content=?','ssi',[$title,$content,$id],'id=?');
    //updated
    echo '<div class="alert alert-success"> Page was updated.</div>';
    exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }
?>