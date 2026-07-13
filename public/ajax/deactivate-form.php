<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
  if($member->role != 'admin'){
    echo '<div class="alert alert-danger">Error: NOT ALLOWED!.</div>';
    exit;
  }
  if(isset($_POST["deactivate"])){
     
     $table = $_POST["deactivate"];
     $id = $_GET["id"];
     $status = $_POST["status"]?:2;

     if(empty(str_replace(' ', '', trim($id)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($table)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }

      $query->addquery('update',$table,'status=?','ii',[$status,$id],'id=?');
      echo '<div class="alert alert-success"><i class="fa fa-check"></i> Row #'.$id.' Done successfully!</div>';
      exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }
?>