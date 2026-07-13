<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");

  if(isset($_POST["editbuild"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> ERROR: REQUEST WRONG!</div>';
        exit;
    }
     $tempid = $_POST["tempid"];
     $name = $_POST["name"];
     $body_color = $_POST["body_color"] ?: '#111';
     $button_color = $_POST["button_color"] ?: '#125ec3';
     $text_color = $_POST["text_color"] ?: '#ffffff';

     $description = $_POST["description"];
     $link = $_POST["link"];
     $preview = $_POST["preview"] ?: NULL;
     $banner = $_POST["banner"] ?: NULL;
     $button = $_POST["button"] ?: 'Log In';
     
     
     $button_width = $_POST["button_width"] ?: '200px';
    
     $preview_size = $_POST["preview_size"] ?: 'width="70px" height="70px"';
     $banner_size = $_POST["banner_size"] ?: 'width="300px" height="50px"';
     

     if(empty(str_replace(' ', '', trim($name)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($body_color)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($button_color)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     if(empty(str_replace(' ', '', trim($button)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }
     
     /*if(empty(str_replace(' ', '', trim($preview)))){
         echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
         exit;
     }*/
     
     /* -------- content form ------ */
    if($preview == NULL || empty(trim($preview))){
        $image_element = ' '; 
    }else{
        $image_element = '<img src="'.do_config(121).$preview.'" alt="image" '.$preview_size.'>'; 
    }
    if($banner == NULL || empty(trim($banner))){
        $banner_element = ' '; 
    }else{
        $banner_element = '<img src="'.do_config(121).$banner.'" alt="image" '.$banner_size.'>'; 
    }
    
    $content = '<html lang="en">
                 <head>
                 <meta charset="UTF-8">
                 <meta name="viewport" content="width=device-width, initial-scale=1.0">
                 <title>Login</title>
                 <script crossorigin="" src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
                 <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
                 <script src="https://cdn.tailwindcss.com"></script>
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js" integrity="sha512-aoTNnqZcT8B4AmeCFmiSnDlc4Nj/KPaZyB5G7JnOnUEkdNpCZs1LCankiYi01sLTyWy+m2P+W4XM+BuQ3Q4/Dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/b8b432d7d3.js" crossorigin="anonymous"></script>
    <!-- import css file (style.css) -->
    <link rel="stylesheet" href="https://pinnocent.com/assets/style.css">

   <style type="text/css" id="operaUserStyle">
   :root {
    --primary-bg: #171717;
    --secondary-bg: #262626;
    --accent-bg: #4f46e5;

    --primary-color: '.$text_color.';
    --secondary-color: rgba(255,255,255, 70%);
    --accent-color: #818cf8;

    --border-color: rgba(255,255,255, 30%);
    
    --username-size: 32px;
    --title-size: 28px;
    --subtitle: 24px;
}
                 body{
                   color:'.$text_color.'; 
                   background:'.$body_color.'; 
                 
}
.container {
    height: 100vh;
    backdrop-filter: blur(20px);
    
    display: flex;
    justify-content: center;
    align-items: center;
}

.profile-card {
    width: clamp(428px, 990px, 990px);
    height: 670px;
    background-color: var(--primary-bg);
    border-radius: 40px;
    border: 2px solid var(--accent-bg);

    display: grid;
    grid-template-rows: 220px auto;
    overflow: auto;
}
/* ------ profile header section */
.profile-header {
    background-image: url("'.do_config(121).$banner.'");
    background-size: cover;
    margin: 10px;
    border-radius: 30px 30px 0 0;
    position: relative;
}
    .main-profile {
        display: flex;
        align-items: center;
        position: absolute;
        inset: calc(100% - 75px) auto auto 70px;
    }
        .profile-image {
            width: 150px;
            height: 150px;
            background: url("'.do_config(121).$preview.'") center !important;
            background-size: cover;
            border-radius: 50%;
           display: flex;
  justify-content: center;
  align-items: center;
  width: 150px; /* Maintain the original width */
  height: 150px; /* Maintain the original height */
  border-radius: 50%;
  border: 10px solid var(--primary-bg);
        }
        .profile-names {
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: var(--primary-color);
            background-color: var(--primary-bg);
            padding: 10px 30px;
            border-radius: 0 50px 50px 0;
            transform: translateX(-10px);
        }
            .page-title {
                color: var(--secondary-color);
            }
            .post-cover {
                position: relative;
                background: url("'.do_config(121).$preview.'") center !important;
                background-size: cover;
                border-radius: 5px;
            }
            
                 </style>
                 </head>
                 <body class="bg-['.$body_color.']">
<body>
    <div class="container">
                        
        <div class="profile-card">
            <div class="profile-header"><!-- profile header section -->
                <div class="main-profile">
                    <a href="'.$link.'" target="_blank" rel="noopener noreferrer"> <div class="profile-image"></div></a>
                    <div class="message">
                    
                        <h1 class="message">'.$name.'<i class="fas fa-check-circle verified-badge"></i></h1>
                        
                    </div>
                </div>
            </div>

            <div class="profile-body"><!-- profile body section -->
                <div class="profile-actions">
                 <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                    <button class="follow">follow</button></a>
                     <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                    <button class="message" type="submit" class="text-black font-semibold p-3 rounded-md w-full bg-['.$button_color.'] hover:bg-blue-600" style="width: '.$button_width.'">'.$button.'</button></a>
                    <section class="bio">
                        <div class="bio-header">
                            <i class="fa fa-info-circle"></i>
                            Bio
                        </div>
                        <p class="bio-text">
                            '.$description.'
                        </p>
                    </section>
                </div>

                <div class="account-info">
                    <div class="data">
                        <div class="important-data">
                            <section class="data-item">
                               

                    
                    
                        <div class="post-cover">
                            <span class="last-badge">Last Post</span>
                        </div>
                        <h3 class="post-title">
                        <div class="flex justify-center w-full">
                         <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                      '.$image_element.' </a>
                    </div>
                    
                     <div class="flex justify-center w-full">
                      <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                      '.$banner_element.' </a>
                    </div>
                        </h3>
                         <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                        <button class="post-CTA">View</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>'; 
     
     //insert
     $query->addquery('update','templates','body_color=?,name=?,preview=?,content=?','ssssi',[$body_color,$name,$preview,$content,$tempid],'id=?');
     $query->addquery('update','templates','description=?,link=?,text_color=?,button_color=?,button=?','ssssi',[$description,$link,$text_color,$button_color,$button,$tempid],'id=?');
     $query->addquery('update','templates','preview_size=?,banner_size=?,banner=?,button_width=?','ssssi',[$preview_size,$banner_size,$banner,$button_width,$tempid],'id=?');

    //added
        echo '<div class="alert alert-success text-center"><i class="fa fa-code"></i> YOUR TEMPLATE WAS SUCCESSFULLY GENERATED.</div><hr>';
        echo '<div class="col-md-12">
                 <textarea class="form-control" rows="5" cols="20" disabled>';
        echo $content;  
        echo '</textarea><br/>
                 <div class="col-md-12">
                 <div class="form-group"><label>LINK</label>
                        <input class="form-control" type="text" value="'.do_config(40).'form?user='.$member->user_id.'&ref='.$tempid.'" disabled>
                 </div>
                 </div>
           </div>';
        exit;


     //$no_title = "NEW MESSAGE BY ".$member->user_id;
     //$query->addquery('insert','notifications','user_id,title,type,role','isss',[$reciever_user_id,$no_title,'support',"user"]);
  }else{
     //required
     echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
     exit;
  }

?>