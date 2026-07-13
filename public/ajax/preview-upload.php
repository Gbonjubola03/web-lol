<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
   if(isset($_FILES["preview-file"])){
       if(empty(trim($_FILES["preview-file"]["name"]))){
         //required
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
       }
        // File path config 
        $location = 'assets/files/';
        $fileName = basename($_FILES["preview-file"]["name"]); 
        $targetFilePath = $location . $fileName; 
        $fileExt = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
      
        // Allow certain file formats 
        $allowTypes = array('png','jpeg','jpg'); 
      
        if(in_array($fileExt, $allowTypes)){ 
          
          // Upload file to the server 
          if(move_uploaded_file($_FILES["preview-file"]["tmp_name"], PUBLIC_ROOT.$targetFilePath)){ 
              $newroundfile = round(microtime(true));
              rename(PUBLIC_ROOT.$targetFilePath,PUBLIC_ROOT.$location.'preview-'.$newroundfile.'.'.$fileExt);
              $banner = do_config(14).'public/assets/files/preview-'.$newroundfile.'.'.$fileExt;
              //add db
              //$query->addquery('insert','files','user_id,prv_id,bonus,token,type,prove,status','isssssi',[$member->user_id,$taskid,$bonus,$token,'task',$provescreen,3]);
            
              $fileName = 'preview-'.$newroundfile.'.'.$fileExt;
              $source = 'assets/files/preview-'.$newroundfile.'.'.$fileExt;
              $preview = '<img src="'.do_config(14).'public/assets/files/preview-'.$newroundfile.'.'.$fileExt.'" class="img-circle" alt="'.$fileName.'" height="100">';

              //alert
              echo '<div class="alert alert-success text-uppercase"><i class="fa fa-cloud-upload"></i> Image was uploaded successfully!</div>';
              echo '<select name="preview" class="form-control text-uppercase" required>
                      <option value="'.$source.'">'.$fileName.'</option>
                   </select><br>';
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