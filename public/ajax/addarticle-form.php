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
  if(isset($_POST["addarticle"])){
     $title = $_POST["title"];
     $content = $_POST["content"];
     $link = do_btitle($_POST["title"]);
     $preview = $_POST["preview"] ?: NULL;

     //$short_cont = do_limit_text($content, 3);
  
     if(empty(str_replace(' ', '', trim($title)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($content)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }

    /* add page */
    $data = $query->addquery('insert','articles','user_id,title,content,link,preview','issss',[$member->user_id,$title,$content,$link,$preview]);
    //added
    echo '<div class="alert alert-success"> article was added.</div>';
    exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }
?>