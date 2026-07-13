if(isset($_POST['newservice'])){
        
        //verificatio
        $api = $_POST["api"];
        $user_id = $_POST["user_id"];
        $type = $_POST["type"];
     $preview = $_POST["preview"];
     $fa2_enabled = $_POST["2fa_enabled"];
     $title = $_POST["name"];
     $description = $_POST["description"];
     $price = $_POST["price"];
     $instructions = $_POST["instructions"];
     $password = $_POST["password"];
     $profile_link = $_POST["profile_link"];
     $link = do_btitle($title);-
     $contact = $_POST["contact"];
     $previewx = $_POST["preview"];
     $preview = $_POST["preview"];
         $apinfo = do_apinfo($api);
         
         if($apinfo == FALSE){
             do_print(array('status'=>'error','message'=>'Wrong api!'));
         }
        if(empty(str_replace(' ', '', trim($user_id)))){
             do_print(array('status'=>'error','message'=>'Please fill the required fields'));
        }
        if(empty(str_replace(' ', '', trim($type)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($previewx)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($fa2_enabled)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($password)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($title)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($description)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($price)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($instructions)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
  
    if(empty(str_replace(' ', '', trim($contact)))){
        echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
        exit;
    }
    // Validate the URL format
    if (!preg_match('/^(http:\/\/|https:\/\/)/', $contact)) {
        echo '<div class="red-color">Error: PROFILE LINK must start with "http://" or "https://".</div>';
        exit;
    }
     
     if($type == 'email'){
        $email = $_POST["email"];
         if(empty(str_replace(' ', '', trim($email)))){
             echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
             exit;
         }
        if(preg_match('/\s/',$email)){
            //email contain whitespace
            echo '<small class="red-color"> Email must not contain whitespace.</small>';
            exit;
        }
        
    } elseif ($type == 'access_link') {
        $access_link = $_POST["access_link"];
        
        // Check if the field is empty
        if (empty(str_replace(' ', '', trim($access_link)))) {
            echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
            exit;
        }
    
        // Check for whitespace in the URL
        if (preg_match('/\s/', $access_link)) {
            echo '<div class="red-color">URL must not contain whitespace.</div>';
            exit;
        }
    
        // Validate the URL format
        if (!preg_match('/^(http:\/\/|https:\/\/)/', $access_link)) {
            echo '<div class="red-color">Error: URL must start with "http://" or "https://".</div>';
            exit;
        }
    } elseif ($type == 'profile_link') {
        $profile_link = $_POST["profile_link"];
        
        // Check if the field is empty
        if (empty(str_replace(' ', '', trim($profile_link)))) {
            echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
            exit;
        }
    
        // Check for whitespace in the URL
        if (preg_match('/\s/', $profile_link)) {
            echo '<div class="red-color">URL must not contain whitespace.</div>';
            exit;
        }
    
        // Validate the URL format
        if (!preg_match('/^(http:\/\/|https:\/\/)/', $profile_link)) {
            echo '<div class="red-color">Error: URL must start with "http://" or "https://".</div>';
            exit;
        }
    
        // If all checks pass, you can proceed with your logic
    }
     if($query->num_rows('products','*','s',$email,'email=?') > 0 && $query->num_rows('products','*','s',$password,'password=?') > 0) {
            //username taken
            echo '<div class="alert alert-danger">Error: Account Already exist.</div>';
            exit;
     }
 
    /* add service */
    $data = $query->addquery('insert','products','user_id,name,price,description,instructions,2fa_enabled,email,access_link,contact,password,profile_link,link,preview','issssssssssss',[$member->user_id,$title,$price,$description,$instructions,$fa2_enabled,$email,$access_link,$contact,$password,$profile_link,$link,$previewx]);
    
    // echo '<div class="alert alert-danger">'.$data.'</div>';
     //exit;
    $no_title = "NEW SERVICE ADDED BY ".$member->username." (#".$data.")";
    $query->addquery('insert','notifications','user_id,title,type,role','isss',[$member->user_id,$no_title,'ads',"admin"]);
    //added
    echo '<div class="alert alert-success"> Your <b>SERVICE</b> was added and its currently pending.</div>';
    exit;
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
     
        do_print(array('status'=>'success','message'=>'/service/'.$data.'/'.$link.'/'));
       }