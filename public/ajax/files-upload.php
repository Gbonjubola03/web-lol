<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
   if(isset($_FILES["upload-files"])){
       if(empty(trim($_FILES["upload-files"]["name"]))){
         //required
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
       }
        // File path config 
        $location = 'assets/files/'; //files location
        $fileName = basename($_FILES["upload-files"]["name"]); //org name 
        $targetFilePath = $location . $fileName; //target
        $fileExt = pathinfo($targetFilePath, PATHINFO_EXTENSION); //ext

        // Allow certain file formats 
        $allowTypes = array('png','jpeg','jpg'); 
      
        if(in_array($fileExt, $allowTypes)){ 
          
          // Upload file to the server 
          if(move_uploaded_file($_FILES["upload-files"]["tmp_name"], PUBLIC_ROOT.$targetFilePath)){ 
              $newroundfile = round(microtime(true));
              rename(PUBLIC_ROOT.$targetFilePath,PUBLIC_ROOT.$location.'upload-'.$newroundfile.'.'.$fileExt);
              $fullsrc = do_config(14).'public/assets/files/upload-'.$newroundfile.'.'.$fileExt; //full url src
              $fileName = 'upload-'.$newroundfile.'.'.$fileExt; //file name
              $source = 'https://'.$_SERVER['HTTP_HOST'].'/assets/files/upload-'.$newroundfile.'.'.$fileExt; //path/source
              //$preview = '<img src="'.do_config(14).'public/assets/files/upload-'.$newroundfile.'.'.$fileExt.'" class="img-circle" alt="'.$fileName.'" height="100">';
              
              //insert file db
              $query->addquery('insert','files','user_id,path,name,ext','isss',[$member->user_id,$source,$_FILES["upload-files"]["name"],$fileExt]);

              //fetch the files to show them from db
              $fthfiles = $query->limit('files','*','id','desc','0,10','i', $member->user_id,'user_id=?');
              
              while ($res=$fthfiles->fetch_assoc()) {
                  echo '<option value="'.$res["path"].'">'.$res["name"].'</option>';
			  }
              exit;
          }else{ 
              echo '<div class="alert alert-danger">Error: There was an error uploading your file.</div>';
              exit;
          } 
        }else{ 
          echo '<div class="alert alert-danger">Error: This type of file are not allowed!</div>';
          exit;
        } 
   }else{
      echo 'error';
      exit;
   }

?>