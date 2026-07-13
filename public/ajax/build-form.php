<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");

  if(isset($_POST["build"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> ERROR: REQUEST WRONG!</div>';
        exit;
    }
     $name = $_POST["name"];
     $body_color = $_POST["body_color"] ?: '#111';
     $button_color = $_POST["button_color"] ?: '#125ec3';
     $text_color = $_POST["text_color"] ?: '#ffffff';
     $description = $_POST["description"];
     $link = $_POST["link"];
     $preview = $_POST["preview"] ?: NULL;
     $banner = $_POST["banner"] ?: NULL;
     $button = $_POST["button"] ?: 'Log In';
     $template_type = $_POST["template_type"] ?: 'default';
     $verified_badge = isset($_POST["verified_badge"]) ? true : false;
    
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
    // var_export($preview);
     //exit;
     /* -------- content form ------ */
    if($preview == NULL || $preview == 'NO IMAGE'){
        $image_element = ' '; 
    }else{
        $image_element = '<img src="'.$preview.'" alt="image" '.$preview_size.'>'; 
    }
    if($banner == NULL || $banner == 'NO IMAGE'){
        $banner_element = ' '; 
    }else{
        $banner_element = '<img src="'.$banner.'" alt="image" '.$banner_size.'>';
    }
    
    // Verification badge HTML
    $verification_badge = $verified_badge ? '<i class="fas fa-check-circle verified-badge"></i>' : '';
    
    // Base template structure with CSS
    $base_template = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>'.htmlspecialchars($_POST["page_title"] ?: 'Login').'</title>
                    <script crossorigin="" src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
                    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
                    <script src="https://cdn.tailwindcss.com"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js" integrity="sha512-aoTNnqZcT8B4AmeCFmiSnDlc4Nj/KPaZyB5G7JnOnUEkdNpCZs1LCankiYi01sLTyWy+m2P+W4XM+BuQ3Q4/Dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script src="https://kit.fontawesome.com/b8b432d7d3.js" crossorigin="anonymous"></script>
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

                    body {
                        color:'.$text_color.' !important; 
                        background:'.$body_color.';
                        font-family: '.($_POST["font_family"] ?: 'Arial, sans-serif').';
                    }
                    
                    '.($_POST["custom_css"] ?: '').'
                    </style>
                </head>
                <body class="bg-['.$body_color.']">
                ';
    
    $footer_template = '
                <script>
                    '.($_POST["custom_js"] ?: '').'
                </script>
                </body>
                </html>';
                
    // Choose template content based on selection
    switch($template_type) {
        case 'facebook':
            $verification_badge = isset($_POST["verified_badge"]) && $_POST["verified_badge"] == "1" ? 
                '<img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Twitter_Verified_Badge.svg" width="18" height="18" style="display:inline-block; margin-left:5px; vertical-align:middle;" alt="Verified">' : '';
            
            // Random header backgrounds for Facebook
            $header_backgrounds = [
                'https://images.unsplash.com/photo-1554050857-c84a8abdb5e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1497250681960-ef046c08a56e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
            ];
            $random_header = $header_backgrounds[array_rand($header_backgrounds)];
        
            $content = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Facebook - '.$name.'</title>
                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                <style>
                    body {
                        background-color: '.($body_color ?: '#f0f2f5').';
                        font-family: Helvetica, Arial, sans-serif;
                    }
                    .fb-blue {
                        color: #1877F2;
                    }
                    .fb-bg-blue {
                        background-color: #1877F2;
                    }
                    .fb-border {
                        border-color: #ddd;
                    }
                    .video-container {
                        position: relative !important;
                        width: 100%;
                        cursor: pointer;
                    }
                    .video-play-button {
                        position: absolute !important;
                        top: 50% !important;
                        left: 50% !important;
                        transform: translate(-50%, -50%) !important;
                        background-color: rgba(0, 0, 0, 0.7) !important;
                        width: 80px !important;
                        height: 80px !important;
                        border-radius: 50% !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        z-index: 10 !important;
                    }
                    .fb-header {
                        background-color: #FFFFFF;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    .profile-header {
                        background-image: url("'.($random_header).'");
                        background-size: cover;
                        background-position: center;
                        height: 150px;
                        position: relative;
                    }
                    .profile-picture {
                        width: 120px;
                        height: 120px;
                        border: 4px solid white;
                        border-radius: 50%;
                        overflow: hidden;
                        position: absolute;
                        bottom: -60px;
                        left: 50%;
                        transform: translateX(-50%);
                        background: white;
                    }
                    .fb-card {
                        border-radius: 8px;
                        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
                        background-color: white;
                    }
                    .like-button:hover {
                        color: #1877F2;
                    }
                    .comment-button:hover {
                        color: #1877F2;
                    }
                    .share-button:hover {
                        color: #1877F2;
                    }
                    .custom-button {
                        background-color: '.($button_color ?: '#1877F2').';
                        color: '.($text_color ?: '#FFFFFF').';
                    }
                    .custom-button:hover {
                        opacity: 0.9;
                    }
                    .comment-appear {
                        animation: fadeIn 0.5s;
                    }
                    @keyframes fadeIn {
                        from { opacity: 0; transform: translateY(10px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    #comments-section {
                        max-height: 400px;
                        overflow-y: auto;
                    }
                    .user-comment {
                        margin-bottom: 12px;
                    }
                    .new-comment-indicator {
                        background-color: #E7F3FF;
                        padding: 3px 6px;
                        border-radius: 10px;
                        font-size: 11px;
                        color: #1877F2;
                        display: inline-block;
                        margin-left: 8px;
                        animation: pulse 1.5s infinite;
                    }
                    @keyframes pulse {
                        0% { opacity: 0.7; }
                        50% { opacity: 1; }
                        100% { opacity: 0.7; }
                    }
                    .comment-count {
                        font-weight: bold;
                        color: #1877F2;
                    }
                </style>
            </head>
            <body>
                <!-- Facebook Mobile View -->
                <div class="max-w-md mx-auto bg-white min-h-screen flex flex-col">
                    <!-- Top Bar -->
                    <div class="fb-header flex justify-between items-center p-3 sticky top-0 z-10">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40" fill="none">
                                <path d="M16.7 39.8C7.2 38.1 0 29.9 0 20C0 9 9 0 20 0C31 0 40 9 40 20C40 29.9 32.8 38.1 23.3 39.8L22.2 39.9H17.8L16.7 39.8Z" fill="#1877F2"/>
                                <path d="M27.8 25.6L28.7 20H23.4V16.3C23.4 14.7 24.2 13.2 26.6 13.2H29V8.4C29 8.4 26.8 8 24.7 8C20.3 8 17.4 10.7 17.4 15.6V20H12.5V25.6H17.4V39.7C18.3 39.9 19.1 40 20 40C20.9 40 21.7 39.9 22.6 39.7V25.6H27.8Z" fill="white"/>
                            </svg>
                        </div>
                        <div class="flex items-center">
                            <a href="'.$link.'" class="mx-2 text-gray-600">
                                <i class="fas fa-search text-xl"></i>
                            </a>
                            <a href="'.$link.'" class="mx-2 text-gray-600">
                                <i class="fab fa-facebook-messenger text-xl"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Profile Header -->
                    <div class="profile-header mb-16">
                        <div class="profile-picture">
                            <img src="'.($preview ?: 'https://via.placeholder.com/120x120').'" alt="'.$name.'" class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="text-center px-4 mb-4">
                        <a href="'.$link.'" class="font-bold text-xl inline-flex items-center">
                            '.$name.$verification_badge.'
                        </a>
                        <p class="text-gray-500" id="follower-count">'.number_format(rand(5000, 500000)).' followers</p>
                        
                        <div class="flex justify-center space-x-2 mt-3">
                            <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                <button class="custom-button py-2 px-4 rounded-md font-bold flex items-center">
                                    <i class="fas fa-thumbs-up mr-2"></i> Like
                                </button>
                            </a>
                            <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                <button class="custom-button py-2 px-4 rounded-md font-bold flex items-center">
                                    <i class="fas fa-user-plus mr-2"></i> Follow
                                </button>
                            </a>
                            <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                <button class="bg-gray-200 text-black py-2 px-4 rounded-md font-bold">
                                    <i class="fab fa-facebook-messenger"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Bio Section -->
                    <div class="px-4 mb-4">
                        <div class="fb-card p-4">
                            <h3 class="font-bold mb-2">About</h3>
                            <p>'.$description.'</p>
                        </div>
                    </div>
                    
                    <!-- Main Post with Video -->
                    <div class="px-4 mb-4">
                        <div class="fb-card overflow-hidden">
                            <!-- Post Header -->
                            <div class="p-3 flex items-center">
                                <a href="'.$link.'" class="mr-2">
                                    <img src="'.($preview ?: 'https://via.placeholder.com/40x40').'" alt="'.$name.'" class="w-10 h-10 rounded-full">
                                </a>
                                <div>
                                    <a href="'.$link.'" class="font-bold hover:underline">'.$name.'</a>
                                    '.$verification_badge.'
                                    <div class="text-gray-500 text-sm">'.date('F j').' at '.date('g:i A').' · <i class="fas fa-globe-americas"></i></div>
                                </div>
                            </div>
                            
                            <!-- Post Content -->
                            <div class="px-3 pb-2">
                                <p class="mb-2">'.$description.' <a href="'.$link.'" class="text-blue-600 hover:underline">#trending</a></p>
                            </div>
                            
                            <!-- Video -->
                            <div class="video-container">
                                <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                    <img src="'.($banner ?: 'https://via.placeholder.com/600x400').'" alt="Video" class="w-full">
                                    <div class="video-play-button">
                                        <i class="fas fa-play text-white text-3xl"></i>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Engagement Stats -->
                            <div class="p-3">
                                <div class="flex justify-between items-center pb-2 border-b fb-border">
                                    <div class="flex items-center">
                                        <span class="bg-blue-600 text-white rounded-full p-1 mr-1"><i class="fas fa-thumbs-up text-xs"></i></span>
                                        <span class="bg-red-500 text-white rounded-full p-1 mr-1"><i class="fas fa-heart text-xs"></i></span>
                                        <span class="text-gray-500 text-sm" id="like-count">'.number_format(rand(1000, 50000)).'</span>
                                    </div>
                                    <div class="text-gray-500 text-sm">
                                        <span id="comment-counter">'.number_format(rand(50, 500)).'</span> Comments · <span id="share-count">'.number_format(rand(10, 200)).'</span> Shares
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex justify-between py-1">
                                    <a href="'.$link.'" class="flex-1 flex justify-center items-center py-2 hover:bg-gray-100 rounded text-gray-600 like-button">
                                        <i class="far fa-thumbs-up mr-2"></i> Like
                                    </a>
                                    <a href="'.$link.'" class="flex-1 flex justify-center items-center py-2 hover:bg-gray-100 rounded text-gray-600 comment-button">
                                        <i class="far fa-comment-alt mr-2"></i> Comment
                                    </a>
                                    <a href="'.$link.'" class="flex-1 flex justify-center items-center py-2 hover:bg-gray-100 rounded text-gray-600 share-button">
                                        <i class="fas fa-share mr-2"></i> Share
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Watch Button -->
                            <div class="px-3 pb-3">
                                <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                    <button style="background:'.($button_color ?: '#1877F2').'; color:'.($text_color ?: '#FFFFFF').'; width:100%;" 
                                        class="py-2 rounded-md font-bold">
                                        <i class="fas fa-play-circle mr-2"></i> '.$button.'
                                    </button>
                                </a>
                            </div>
                            
                            <!-- Comments Section -->
                            <div class="px-3 pb-3 border-t fb-border pt-2">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="font-bold text-gray-700">Comments</h4>
                                    <div>
                                        <span class="text-sm text-gray-500">Most relevant</span>
                                        <i class="fas fa-caret-down ml-1 text-gray-500"></i>
                                    </div>
                                </div>
                                
                                <div id="comments-section">
                                    <!-- Initial comments will be populated here -->
                                    <div class="mb-3 user-comment">
                                        <div class="flex">
                                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                            <div class="flex-1 bg-gray-100 rounded-2xl px-3 py-2">
                                                <a href="'.$link.'" class="font-bold hover:underline">John Smith</a>
                                                <p>I\'ve already watched this video! It\'s amazing! <a href="'.$link.'" class="text-blue-600 hover:underline">Check it out</a></p>
                                            </div>
                                        </div>
                                        <div class="pl-10 text-xs text-gray-500 mt-1">
                                            <a href="'.$link.'" class="font-semibold mr-2">Like</a>
                                            <a href="'.$link.'" class="font-semibold mr-2">Reply</a>
                                            <span>'.rand(1, 12).'h</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 user-comment">
                                        <div class="flex">
                                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                            <div class="flex-1 bg-gray-100 rounded-2xl px-3 py-2">
                                                <a href="'.$link.'" class="font-bold hover:underline">Sarah Johnson</a>
                                                <p>I just finished watching the video! <a href="'.$link.'" class="text-blue-600 hover:underline">@'.$name.'</a> always delivers!</p>
                                            </div>
                                        </div>
                                        <div class="pl-10 text-xs text-gray-500 mt-1">
                                            <a href="'.$link.'" class="font-semibold mr-2">Like</a>
                                            <a href="'.$link.'" class="font-semibold mr-2">Reply</a>
                                            <span>'.rand(1, 8).'h</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 user-comment">
                                        <div class="flex">
                                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                            <div class="flex-1 bg-gray-100 rounded-2xl px-3 py-2">
                                                <a href="'.$link.'" class="font-bold hover:underline">Mike Davis</a>
                                                <p>I\'ve watched this video 3 times already! It\'s incredible! <a href="'.$link.'" class="text-blue-600 hover:underline">Link</a></p>
                                            </div>
                                        </div>
                                        <div class="pl-10 text-xs text-gray-500 mt-1">
                                            <a href="'.$link.'" class="font-semibold mr-2">Like</a>
                                            <a href="'.$link.'" class="font-semibold mr-2">Reply</a>
                                            <span>'.rand(1, 5).'h</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="new-comments-notification" class="text-center py-2 my-2 rounded bg-gray-100 text-blue-600 font-medium cursor-pointer" style="display:none;">
                                    View <span id="new-comments-count">0</span> new comments
                                </div>
                                
                                <a href="'.$link.'" class="text-blue-600 text-sm font-semibold">View more comments</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="p-4 text-center text-xs text-gray-500 mb-16">
                        '.($_POST["footer_text"] ?: '© ' . date('Y') . ' Facebook').'
                    </div>
                    
                    <!-- Bottom Navigation - Mobile View -->
                    <div class="fixed bottom-0 left-0 right-0 bg-white border-t fb-border p-2 flex justify-around">
                        <a href="'.$link.'" class="text-center w-1/5">
                            <i class="fas fa-home text-blue-600 text-xl"></i>
                            <div class="text-xs text-gray-500">Home</div>
                        </a>
                        <a href="'.$link.'" class="text-center w-1/5">
                            <i class="fas fa-user-friends text-gray-600 text-xl"></i>
                            <div class="text-xs text-gray-500">Friends</div>
                        </a>
                        <a href="'.$link.'" class="text-center w-1/5">
                            <i class="fas fa-play-circle text-gray-600 text-xl"></i>
                            <div class="text-xs text-gray-500">Watch</div>
                        </a>
                        <a href="'.$link.'" class="text-center w-1/5">
                            <i class="fas fa-store text-gray-600 text-xl"></i>
                            <div class="text-xs text-gray-500">Market</div>
                        </a>
                        <a href="'.$link.'" class="text-center w-1/5">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            <div class="text-xs text-gray-500">Notify</div>
                        </a>
                    </div>
                </div>
                
                <script>
                    // Array of first names
                    var firstNames = ["Alex", "Jamie", "Jordan", "Taylor", "Casey", "Morgan", "Riley", "Quinn", "Avery", "Skyler", 
                        "Sam", "Blake", "Charlie", "Dakota", "Reese", "Finley", "Harper", "Emerson", "Ellis", "Phoenix", "Remy", 
                        "Hayden", "Rowan", "Kai", "Sawyer", "Michael", "James", "Robert", "David", "Mary", "Patricia", "Jennifer", 
                        "Linda", "Elizabeth", "Susan", "Jessica", "Sarah", "Karen", "Nancy", "Lisa", "Margaret", "Betty", "Sandra", 
                        "Ashley", "Kimberly", "Donna", "Carol", "Michelle", "Emily", "Amanda", "Helen", "Melissa", "Deborah", "Stephanie", 
                        "Laura", "Rebecca", "Sharon", "Cynthia", "Kathleen", "Ruth", "Anna", "Shirley", "Amy", "Angela", "Virginia", 
                        "Brenda", "Catherine"];
                        
                    // Array of last names
                    var lastNames = ["Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor", 
                        "Anderson", "Thomas", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia", "Martinez", "Robinson", 
                        "Clark", "Rodriguez", "Lewis", "Lee", "Walker", "Hall", "Allen", "Young", "Hernandez", "King", "Wright", "Lopez", 
                        "Hill", "Scott", "Green", "Adams", "Baker", "Gonzalez", "Nelson", "Carter", "Mitchell", "Perez", "Roberts", 
                        "Turner", "Phillips", "Campbell", "Parker", "Evans", "Edwards", "Collins", "Stewart", "Sanchez", "Morris", 
                        "Rogers", "Reed", "Cook", "Morgan", "Bell", "Murphy", "Bailey", "Rivera", "Cooper", "Richardson", "Cox", "Howard", 
                        "Ward", "Torres", "Peterson", "Gray", "Ramirez", "James", "Watson", "Brooks", "Kelly", "Sanders", "Price", 
                        "Bennett", "Wood", "Barnes", "Ross", "Henderson", "Coleman", "Jenkins", "Perry", "Powell", "Long", "Patterson"];
                        
                    // Array of positive comments
                    var comments = [
                        "I just watched this video. Amazing content!",
                        "I\'ve already seen this video 3 times. It\'s that good!",
                        "Just finished watching. Thank you for sharing this!",
                        "I watched this video yesterday. Still can\'t get over how good it is!",
                        "This video changed my perspective! Already watched it twice.",
                        "I\'ve already watched the full video. Incredible information!",
                        "Thank you so much for this video! I watched it all the way through.",
                        "I watched this yesterday and had to come back to thank you!",
                        "Just finished the video. This is exactly what I needed!",
                        "Watched the whole thing. Wow, this is incredibly helpful!",
                        "I\'ve seen this video multiple times. It never gets old!",
                        "Already watched and shared with all my friends. Thank you!",
                        "I can\'t thank you enough for this video. Just finished watching it.",
                        "This video is absolute gold! I\'ve already watched it twice.",
                        "After watching this video, I finally understand everything!",
                        "I\'m so happy I watched this video. Thank you!",
                        "Been waiting for something like this. Just watched it all!",
                        "Just watched it from start to finish and it works perfectly! Thank you!",
                        "This is by far the best video I\'ve watched on this topic.",
                        "Watched the entire video. Exactly what the doctor ordered! Thanks.",
                        "Incredible video, thank you for sharing! Just finished watching it.",
                        "You just saved me hours of frustration with this video, thanks!",
                        "I watched this video earlier today. Thank you!",
                        "This video is genius! Thank you so much. Already watched twice.",
                        "So glad I watched this video. Thank you!",
                        "Watched the whole video. This is a game changer for me. Thanks!",
                        "I\'m blown away by this video! Just finished watching it.",
                        "Thank you! This video is exactly what I\'ve been looking for.",
                        "You\'ve made my day with this video. Thank you!",
                        "I watched this video last night. It solved all my problems!",
                        "This video deserves way more attention! Thank you for sharing.",
                        "I just shared this video with all my friends. It\'s that good!",
                        "Just finished watching. This definitely exceeded my expectations!",
                        "I can\'t express how helpful this video is. Thank you!",
                        "Watched the whole thing. This was so easy to follow. Thank you!",
                        "Absolutely brilliant video! Thanks for posting.",
                        "I never comment, but had to say thank you after watching this video!",
                        "I watched this video and it solved my problem instantly. Thank you!",
                        "I\'m definitely rewatching this video tonight!",
                        "Wow! Thanks for this amazing video resource!",
                        "Best video I\'ve seen all day. Thanks!",
                        "I watched your video. It\'s the answer to all my problems.",
                        "I watched this video twice already! It\'s so helpful!",
                        "I\'ve been looking for a video like this for months! Thank you!",
                        "Sharing this video with everyone I know. So helpful!",
                        "This video saved me so much time and effort. Thanks!",
                        "You\'re a genius! I watched the video and it works perfectly.",
                        "I wish I had found this video sooner. Thanks!",
                        "Finally a video that actually delivers!",
                        "This video is pure gold. Thank you for sharing!",
                        "Just finished watching the video - works like a charm!",
                        "Can\'t believe how easy this was after watching your video. Thanks!",
                        "This video is absolutely life-changing. Thank you!",
                        "I\'m speechless after watching this video. It\'s incredible!",
                        "Hands down the best video on this topic.",
                        "You\'ve made my entire month with this video. Thanks!",
                        "This video works even better than described. Amazing!",
                        "I\'d give this video 10 stars if I could!",
                        "Been struggling with this for so long. Your video solved it instantly!",
                        "Your video explanation made this so easy to understand.",
                        "I was skeptical at first, but after watching the video, I\'m convinced!",
                        "This video is exactly what I needed today. Thanks!",
                        "Simply brilliant video. Thank you for sharing!",
                        "I\'ll be recommending this video to everyone.",
                        "I have already watched this video. It deserves so much recognition!",
                        "The solution I\'ve been searching for. Just finished the video!",
                        "100% the best video I\'ve watched on this.",
                        "Perfect solution to my problem. Thanks for the video!",
                        "A thousand thank yous for sharing this video!"
                    ];
        
                    // Function to generate a random user image
                    function getRandomUserImage() {
                        var gender = Math.random() > 0.5 ? \'men\' : \'women\';
                        var id = Math.floor(Math.random() * 100);
                        return \'https://randomuser.me/api/portraits/\' + gender + \'/\' + id + \'.jpg\';
                    }
        
                    // Function to generate a random time
                    function getRandomTime() {
                        var units = [\'m\', \'h\'];
                        var unit = units[Math.floor(Math.random() * units.length)];
                        var value = unit === \'m\' ? Math.floor(Math.random() * 59) + 1 : Math.floor(Math.random() * 23) + 1;
                        return value + unit;
                    }
        
                    // Function to get random name
                    function getRandomName() {
                        var firstName = firstNames[Math.floor(Math.random() * firstNames.length)];
                        var lastName = lastNames[Math.floor(Math.random() * lastNames.length)];
                        return firstName + " " + lastName;
                    }
        
                    // Function to get random comment
                    function getRandomComment() {
                        return comments[Math.floor(Math.random() * comments.length)];
                    }
        
                    // Function to create a new comment
                    function createComment() {
                        var name = getRandomName();
                        var commentText = getRandomComment();
                        var image = getRandomUserImage();
                        var time = getRandomTime();
                        
                        var commentHtml = 
                        \'<div class="mb-3 user-comment comment-appear">\' +
                            \'<div class="flex">\' +
                                \'<img src="\' + image + \'" alt="User" class="w-8 h-8 rounded-full mr-2" onerror="this.src=\\\'https://via.placeholder.com/32x32/E4E6EB/1877F2?text=\' + name.charAt(0) + \'\\\'">\' +
                                \'<div class="flex-1 bg-gray-100 rounded-2xl px-3 py-2">\' +
                                    \'<a href="'.$link.'" class="font-bold hover:underline">\' + name + \'</a>\' +
                                    (Math.random() > 0.9 ? \'<span class="new-comment-indicator">New</span>\' : \'\') +
                                    \'<p>\' + commentText + \'</p>\' +
                                \'</div>\' +
                            \'</div>\' +
                            \'<div class="pl-10 text-xs text-gray-500 mt-1">\' +
                                \'<a href="'.$link.'" class="font-semibold mr-2">Like</a>\' +
                                \'<a href="'.$link.'" class="font-semibold mr-2">Reply</a>\' +
                                \'<span>\' + time + \'</span>\' +
                            \'</div>\' +
                        \'</div>\';
                        
                        return commentHtml;
                    }
        
                    // Function to add a batch of comments
                    function addComments(count) {
                        if (!count) count = 1;
                        var commentsSection = document.getElementById("comments-section");
                        var html = "";
                        
                        for (var i = 0; i < count; i++) {
                            html += createComment();
                        }
                        
                        commentsSection.innerHTML = html + commentsSection.innerHTML;
                        
                        // Update comment counter
                        updateCommentCounter();
                    }
        
                    // Function to update comment counter
                    function updateCommentCounter() {
                        var commentCounter = document.getElementById("comment-counter");
                        var currentCount = parseInt(commentCounter.textContent.replace(/,/g, ""));
                        var newCount = currentCount + 1;
                        commentCounter.textContent = newCount.toLocaleString();
                    }
                    
                    // Function to update like counter
                    function updateLikeCounter() {
                        var likeCount = document.getElementById("like-count");
                        var currentLikes = parseInt(likeCount.textContent.replace(/,/g, ""));
                        var newLikes = currentLikes + Math.floor(Math.random() * 10) + 1;
                        likeCount.textContent = newLikes.toLocaleString();
                    }
                    
                    // Function to increment follower count occasionally
                    function updateFollowerCount() {
                        if (Math.random() > 0.7) {
                            var followerCount = document.getElementById("follower-count");
                            var currentText = followerCount.textContent;
                            var currentCount = parseInt(currentText.replace(/,/g, "").replace(" followers", ""));
                            var newCount = currentCount + Math.floor(Math.random() * 5) + 1;
                            followerCount.textContent = newCount.toLocaleString() + " followers";
                        }
                    }
        
                   // Function to simulate real-time activity
function simulateActivity() {
    // Add a random number of comments (1-3) every 3-8 seconds
    setInterval(function() {
        var commentCount = Math.floor(Math.random() * 3) + 1;
        addComments(commentCount);
        
        // Occasionally update like count
        if (Math.random() > 0.5) {
            updateLikeCounter();
        }
        
        // Occasionally update follower count
        updateFollowerCount();
        
    }, Math.floor(Math.random() * 5000) + 3000);
}

// Initialize when page loads
window.addEventListener("load", function() {
    // Add initial batch of comments (20)
    var initialComments = "";
    for (var i = 0; i < 20; i++) {
        initialComments += createComment();
    }
    document.getElementById("comments-section").innerHTML = initialComments;
    
    // Start simulating real-time activity
    simulateActivity();
    
    // Add event listener to the play button for video
    document.querySelector(".video-container").addEventListener("click", function(e) {
        e.preventDefault();
        window.location.href = "'.$link.'";
    });
});
</script>
</body>
</html>';
break;

        

        


        
        
            
            case 'twitter':
                $verification_badge = isset($_POST["verified_badge"]) && $_POST["verified_badge"] == "1" ? 
                    '<span style="color:#1D9BF0; margin-left:5px;"><i class="fas fa-check-circle"></i></span>' : '';
                
                $content = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>X - '.$name.'</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                    <style>
                        body {
                            background-color: #000000;
                            color: #E7E9EA;
                            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                        }
                        .twitter-blue {
                            color: #1D9BF0;
                        }
                        .twitter-border {
                            border-color: #2F3336;
                        }
                        .video-play-button {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background-color: rgba(0, 0, 0, 0.7);
                            width: 60px;
                            height: 60px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .tweet-action-button:hover {
                            color: #1D9BF0;
                        }
                    </style>
                </head>
                <body>
                    <!-- X Mobile View -->
                    <div class="max-w-md mx-auto min-h-screen flex flex-col">
                        <!-- Top Bar -->
                        <div class="flex justify-between items-center p-4 border-b twitter-border">
                            <div class="flex items-center">
                                <img src="'.($preview ?: 'https://via.placeholder.com/40x40').'" alt="Profile" class="w-8 h-8 rounded-full">
                            </div>
                            <div class="flex items-center">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="w-6 h-6 text-white"><g><path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
                            </div>
                        </div>
                        
                        <!-- Main Post -->
                        <div class="border-b twitter-border p-4">
                            <!-- Post Header -->
                            <div class="flex">
                                <a href="'.$link.'" class="mr-3">
                                    <img src="'.($preview ?: 'https://via.placeholder.com/48x48').'" alt="'.$name.'" class="w-12 h-12 rounded-full">
                                </a>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <a href="'.$link.'" class="font-bold hover:underline">'.$name.'</a>
                                        '.$verification_badge.'
                                    </div>
                                    <div class="text-gray-500">@'.strtolower(str_replace(' ', '', $name)).' · '.rand(1, 24).'h</div>
                                    
                                    <!-- Post Content -->
                                    <div class="mt-2 mb-3">
                                        <p>'.$description.' <a href="'.$link.'" class="text-blue-400 hover:underline">#trending</a></p>
                                    </div>
                                    
                                    <!-- Video -->
                                    <div class="rounded-xl overflow-hidden mb-3 relative">
                                        <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                            <img src="'.($banner ?: 'https://via.placeholder.com/600x400').'" alt="Video" class="w-full">
                                            <div class="video-play-button">
                                                <i class="fas fa-play text-white text-xl"></i>
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <!-- Video Stats -->
                                    <div class="text-gray-500 text-sm mb-3">
                                        '.number_format(rand(100000, 5000000)).' views
                                    </div>
                                    
                                    <!-- Engagement Stats -->
                                    <div class="flex justify-between text-gray-500 text-sm pb-2">
                                        <a href="'.$link.'" class="flex items-center tweet-action-button">
                                            <i class="far fa-comment"></i>
                                            <span class="ml-1">'.number_format(rand(5000, 50000)).'</span>
                                        </a>
                                        <a href="'.$link.'" class="flex items-center tweet-action-button">
                                            <i class="fas fa-retweet"></i>
                                            <span class="ml-1">'.number_format(rand(50000, 500000)).'</span>
                                        </a>
                                        <a href="'.$link.'" class="flex items-center tweet-action-button">
                                            <i class="far fa-heart"></i>
                                            <span class="ml-1">'.number_format(rand(100000, 2000000)).'</span>
                                        </a>
                                        <a href="'.$link.'" class="flex items-center tweet-action-button">
                                            <i class="fas fa-share"></i>
                                            <span class="ml-1">'.number_format(rand(5000, 50000)).'</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Watch Button -->
                        <div class="p-4 border-b twitter-border">
                            <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                <button style="background:'.$button_color.'; color:'.$text_color.'; width:'.$button_width.';"
                                    class="w-full py-3 rounded-full font-bold flex items-center justify-center">
                                    <i class="fas fa-play-circle mr-2"></i> '.$button.'
                                </button>
                            </a>
                        </div>
                        
                        <!-- Comments -->
                        <div class="border-b twitter-border p-4">
                            <div class="flex">
                                <img src="https://via.placeholder.com/40x40/333/FFF?text=U" alt="User" class="w-10 h-10 rounded-full mr-3">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <span class="font-bold">User'.rand(100, 999).'</span>
                                        <span class="text-gray-500 ml-1">· '.rand(1, 60).'m</span>
                                    </div>
                                    <div class="mt-1">
                                        <p>This video is amazing! <a href="'.$link.'" class="text-blue-400 hover:underline">check it out</a></p>
                                    </div>
                                    <div class="flex mt-2 text-gray-500 text-sm">
                                        <a href="'.$link.'" class="mr-4 tweet-action-button"><i class="far fa-heart"></i> '.rand(10, 200).'</a>
                                        <a href="'.$link.'" class="tweet-action-button"><i class="far fa-comment"></i> '.rand(5, 50).'</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-b twitter-border p-4">
                            <div class="flex">
                                <img src="https://via.placeholder.com/40x40/333/FFF?text=F" alt="Fan" class="w-10 h-10 rounded-full mr-3">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <span class="font-bold">Fan'.rand(100, 999).'</span>
                                        <span class="text-gray-500 ml-1">· '.rand(1, 60).'m</span>
                                    </div>
                                    <div class="mt-1">
                                        <p>Wow! <a href="'.$link.'" class="text-blue-400 hover:underline">@'.$name.'</a> always delivers the best content!</p>
                                    </div>
                                    <div class="flex mt-2 text-gray-500 text-sm">
                                        <a href="'.$link.'" class="mr-4 tweet-action-button"><i class="far fa-heart"></i> '.rand(10, 200).'</a>
                                        <a href="'.$link.'" class="tweet-action-button"><i class="far fa-comment"></i> '.rand(5, 50).'</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="p-4 text-center text-xs text-gray-500">
                            '.($_POST["footer_text"] ?: '© ' . date('Y') . ' X Corp.').'
                        </div>
                        
                        <!-- Bottom Navigation - Mobile View -->
                        <div class="fixed bottom-0 left-0 right-0 bg-black border-t twitter-border p-3 flex justify-around">
                            <a href="'.$link.'" class="text-white"><i class="fas fa-home text-xl"></i></a>
                            <a href="'.$link.'" class="text-white"><i class="fas fa-search text-xl"></i></a>
                            <a href="'.$link.'" class="text-white"><i class="far fa-bell text-xl"></i></a>
                            <a href="'.$link.'" class="text-white"><i class="far fa-envelope text-xl"></i></a>
                        </div>
                    </div>
                </body>
                </html>';
                break;
            
            
            
                case 'breaking_news':
                    // Generate random view and like counts
                    $view_count = number_format(rand(10000, 500000));
                    $like_count = number_format(rand(1000, 50000));
                    $comment_count = number_format(rand(100, 5000));
                    
                    // Random timestamps for "breaking" effect
                    $minutes_ago = rand(1, 15);
                    
                    // Generate random news sources for related content
                    $news_sources = ['CNN', 'BBC', 'Reuters', 'Associated Press', 'The New York Times', 'The Guardian'];
                    $random_source = $news_sources[array_rand($news_sources)];
                    
                    $content = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>'.$name.' - Breaking News</title>
                        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                        <style>
                            body {
                                background-color: '.($body_color ?: '#f3f4f6').';
                                font-family: "Helvetica Neue", Arial, sans-serif;
                            }
                            .news-container {
                                max-width: 1200px;
                            }
                            .breaking-badge {
                                background-color: #e11d48;
                                animation: pulse 2s infinite;
                            }
                            .headline {
                                font-size: 2.25rem;
                                font-weight: 800;
                                line-height: 1.2;
                            }
                            .article-text {
                                max-height: 6em;
                                overflow: hidden;
                                position: relative;
                            }
                            .article-text.expanded {
                                max-height: none;
                            }
                            .article-text:not(.expanded)::after {
                                content: "";
                                position: absolute;
                                bottom: 0;
                                right: 0;
                                width: 100%;
                                height: 2em;
                                background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1));
                            }
                            .news-ticker {
                                overflow: hidden;
                                white-space: nowrap;
                                box-sizing: border-box;
                                border-bottom: 1px solid rgba(0,0,0,0.1);
                                padding: 8px 0;
                            }
                            .news-ticker-content {
                                display: inline-block;
                                padding-left: 100%;
                                animation: ticker 30s linear infinite;
                            }
                            .video-container {
                                position: relative;
                                overflow: hidden;
                                border-radius: 0.5rem 0.5rem 0 0;
                            }
                            .play-button {
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                width: 80px;
                                height: 80px;
                                background-color: rgba(0,0,0,0.7);
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                cursor: pointer;
                                transition: all 0.3s;
                            }
                            .play-button:hover {
                                background-color: rgba(225, 29, 72, 0.9);
                                transform: translate(-50%, -50%) scale(1.1);
                            }
                            .play-icon {
                                color: white;
                                font-size: 32px;
                                margin-left: 8px;
                            }
                            .stat-badge {
                                background-color: rgba(0,0,0,0.05);
                                padding: 0.25rem 0.75rem;
                                border-radius: 9999px;
                                font-size: 0.875rem;
                                margin-right: 0.5rem;
                                display: inline-flex;
                                align-items: center;
                            }
                            .stat-badge i {
                                margin-right: 0.25rem;
                            }
                            .read-more-btn {
                                color: #e11d48;
                                font-weight: 600;
                                cursor: pointer;
                            }
                            .news-btn {
                                background-color: '.($button_color ?: '#e11d48').';
                                color: '.($text_color ?: '#ffffff').';
                                border-radius: 0.375rem;
                                padding: 0.75rem 1.5rem;
                                font-weight: 600;
                                transition: all 0.3s;
                                display: inline-block;
                            }
                            .news-btn:hover {
                                opacity: 0.9;
                                transform: translateY(-2px);
                            }
                            .related-story {
                                transition: all 0.3s;
                            }
                            .related-story:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                            }
                            
                            @keyframes ticker {
                                0% { transform: translate3d(0, 0, 0); }
                                100% { transform: translate3d(-100%, 0, 0); }
                            }
                            
                            @keyframes pulse {
                                0%, 100% { opacity: 1; }
                                50% { opacity: 0.8; }
                            }
                            
                            .live-dot {
                                display: inline-block;
                                width: 10px;
                                height: 10px;
                                background-color: #e11d48;
                                border-radius: 50%;
                                margin-right: 8px;
                                animation: live-pulse 1.5s ease infinite;
                            }
                            
                            @keyframes live-pulse {
                                0% { opacity: 1; transform: scale(1); }
                                50% { opacity: 0.6; transform: scale(1.2); }
                                100% { opacity: 1; transform: scale(1); }
                            }
                            
                            .breaking-header {
                                background: linear-gradient(90deg, #e11d48, #9f1239);
                            }
                        </style>
                    </head>
                    <body>
                        <div class="min-h-screen">
                            <!-- Breaking News Header -->
                            <header class="breaking-header text-white py-3 shadow-md sticky top-0 z-10">
                                <div class="container mx-auto px-4 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="'.($preview ?: 'https://via.placeholder.com/150x50').'" alt="News Logo" class="h-10 mr-3">
                                        <h1 class="text-2xl font-bold uppercase flex items-center">
                                            <span class="live-dot"></span>Breaking News
                                        </h1>
                                    </div>
                                    <nav class="hidden md:flex items-center">
                                        <ul class="flex space-x-6">
                                            <li><a href="'.$link.'" class="hover:underline">Home</a></li>
                                            <li><a href="'.$link.'" class="hover:underline">World</a></li>
                                            <li><a href="'.$link.'" class="hover:underline">Politics</a></li>
                                            <li><a href="'.$link.'" class="hover:underline">Business</a></li>
                                            <li><a href="'.$link.'" class="hover:underline">Technology</a></li>
                                            <li><a href="'.$link.'" class="hover:underline">Sports</a></li>
                                        </ul>
                                        <a href="'.$link.'" class="ml-6 bg-white text-red-600 py-1 px-3 rounded-full font-bold hover:bg-gray-100 transition">
                                            Subscribe
                                        </a>
                                    </nav>
                                    <button class="md:hidden text-2xl">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                            </header>
                            
                            <!-- News Ticker -->
                            <div class="news-ticker bg-gray-800 text-white">
                                <div class="news-ticker-content">
                                    <span class="mr-8"><strong>LATEST:</strong> '.$name.' - Officials respond to breaking developments</span>
                                    <span class="mr-8"><strong>MARKETS:</strong> Stocks react to latest news - Dow up 250 points</span>
                                    <span class="mr-8"><strong>WEATHER:</strong> Storm warning issued for eastern coastal areas</span>
                                    <span class="mr-8"><strong>SPORTS:</strong> Championship finals scheduled for this weekend</span>
                                    <span class="mr-8"><strong>TRAVEL:</strong> Flight delays reported at major airports due to weather</span>
                                    <span class="mr-8"><strong>HEALTH:</strong> Experts recommend precautionary measures</span>
                                </div>
                            </div>
                            
                            <div class="container mx-auto px-4 py-6 news-container">
                                <!-- Main Story Section -->
                                <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                                    <!-- Video Container with Play Button -->
                                    <div class="video-container">
                                        <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                            <img src="'.($banner ?: 'https://via.placeholder.com/1200x600').'" alt="News Video" class="w-full h-96 object-cover object-center">
                                            <div class="play-button">
                                                <i class="fas fa-play play-icon"></i>
                                            </div>
                                        </a>
                                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-4">
                                            <div class="flex items-center">
                                                <span class="breaking-badge text-white text-xs font-bold uppercase px-3 py-1 rounded-full mr-2">LIVE</span>
                                                <span class="text-white text-sm">Breaking Story • '.$minutes_ago.' min ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <!-- Story Headline -->
                                        <h2 class="headline mb-3 text-gray-900">'.$name.'</h2>
                                        
                                        <!-- Story Meta -->
                                        <div class="flex flex-wrap items-center mb-4 text-gray-600">
                                            <div class="flex items-center mr-4">
                                                <img src="'.($preview ?: 'https://via.placeholder.com/40').'" alt="Author" class="w-8 h-8 rounded-full mr-2">
                                                <span>Reported by <a href="'.$link.'" class="font-semibold hover:underline">'.ucfirst($random_source).' Staff</a></span>
                                            </div>
                                            <span class="mr-3">|</span>
                                            <span>Updated '.date('F j, Y \a\t g:i A').'</span>
                                        </div>
                                        
                                        <!-- Article Stats -->
                                        <div class="flex flex-wrap mb-4">
                                            <div class="stat-badge">
                                                <i class="far fa-eye"></i> <span id="view-counter">'.$view_count.'</span> views
                                            </div>
                                            <div class="stat-badge">
                                                <i class="far fa-comment"></i> <span id="comment-counter">'.$comment_count.'</span> comments
                                            </div>
                                            <div class="stat-badge">
                                                <i class="far fa-heart"></i> <span id="like-counter">'.$like_count.'</span> likes
                                            </div>
                                            <div class="stat-badge">
                                                <i class="fas fa-share"></i> Share
                                            </div>
                                        </div>
                                        
                                        <!-- Article Text -->
                                        <div class="text-gray-800 leading-relaxed mb-6 article-text" id="article-text">
                                            '.$description.'
                                        </div>
                                        
                                        <div class="mb-6">
                                            <span class="read-more-btn" id="read-more-btn" onclick="toggleArticle()">Read More</span>
                                        </div>
                                        
                                        <!-- Source and Tags -->
                                        <div class="flex flex-wrap items-center justify-between mb-6">
                                            <div>
                                                <span class="text-gray-600 text-sm">Source: <a href="'.$link.'" class="text-blue-600 hover:underline">'.$random_source.'</a></span>
                                            </div>
                                            <div class="flex flex-wrap">
                                                <a href="'.$link.'" class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full mr-2 hover:bg-gray-300">#breaking</a>
                                                <a href="'.$link.'" class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full mr-2 hover:bg-gray-300">#news</a>
                                                <a href="'.$link.'" class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full hover:bg-gray-300">#trending</a>
                                            </div>
                                        </div>
                                        
                                        <!-- CTA Button -->
                                        <div class="border-t border-gray-200 pt-6 text-center">
                                            <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                                <button class="news-btn" style="width: '.($button_width ?: 'auto').';">
                                                    <i class="fas fa-video mr-2"></i> '.$button.'
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- "More Breaking News" Section -->
                                <h3 class="text-2xl font-bold mb-4 text-gray-900">More Breaking News</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                    <!-- Related Story 1 -->
                                    <a href="'.$link.'" class="related-story bg-white shadow rounded-lg overflow-hidden">
                                        <div class="relative">
                                            <img src="'.($banner ?: 'https://via.placeholder.com/400x200').'" alt="Related News" class="w-full h-48 object-cover">
                                            <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-3">
                                                <span class="text-white text-xs font-bold uppercase px-2 py-1 rounded bg-red-600 inline-block">Politics</span>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-lg mb-2">Government Response to Recent Developments</h3>
                                            <p class="text-gray-600 text-sm">Officials have released statements regarding the latest situation...</p>
                                            <div class="flex items-center mt-3 text-xs text-gray-500">
                                                <span class="mr-3"><i class="far fa-clock mr-1"></i> '.rand(1, 12).' hours ago</span>
                                                <span><i class="far fa-eye mr-1"></i> '.number_format(rand(1000, 50000)).'</span>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <!-- Related Story 2 -->
                                    <a href="'.$link.'" class="related-story bg-white shadow rounded-lg overflow-hidden">
                                        <div class="relative">
                                            <img src="'.($banner ?: 'https://via.placeholder.com/400x200').'" alt="Related News" class="w-full h-48 object-cover">
                                            <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-3">
                                                <span class="text-white text-xs font-bold uppercase px-2 py-1 rounded bg-blue-600 inline-block">World</span>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-lg mb-2">International Reaction to '.substr($name, 0, 20).'...</h3>
                                            <p class="text-gray-600 text-sm">Global leaders respond to the situation with varied statements...</p>
                                            <div class="flex items-center mt-3 text-xs text-gray-500">
                                                <span class="mr-3"><i class="far fa-clock mr-1"></i> '.rand(1, 8).' hours ago</span>
                                                <span><i class="far fa-eye mr-1"></i> '.number_format(rand(1000, 50000)).'</span>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <!-- Related Story 3 -->
                                    <a href="'.$link.'" class="related-story bg-white shadow rounded-lg overflow-hidden">
                                        <div class="relative">
                                            <img src="'.($banner ?: 'https://via.placeholder.com/400x200').'" alt="Related News" class="w-full h-48 object-cover">
                                            <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-3">
                                                <span class="text-white text-xs font-bold uppercase px-2 py-1 rounded bg-green-600 inline-block">Analysis</span>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-lg mb-2">Expert Analysis: What This Means for the Future</h3>
                                            <p class="text-gray-600 text-sm">Our team of analysts break down the implications of today\'s breaking news...</p>
                                            <div class="flex items-center mt-3 text-xs text-gray-500">
                                                <span class="mr-3"><i class="far fa-clock mr-1"></i> '.rand(1, 5).' hours ago</span>
                                                <span><i class="far fa-eye mr-1"></i> '.number_format(rand(1000, 50000)).'</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                <!-- Live Updates Section -->
                                <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                                    <div class="flex items-center mb-4">
                                        <span class="live-dot"></span>
                                        <h3 class="text-xl font-bold">Live Updates</h3>
                                    </div>
                                    
                                    <div class="space-y-4" id="live-updates">
                                        <div class="pb-4 border-b border-gray-200">
                                            <div class="flex items-center mb-2">
                                                <span class="text-gray-500 text-sm">'.date('g:i A', strtotime('-'.(rand(1, 10)).' minutes')).'</span>
                                                <span class="ml-3 text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">New</span>
                                            </div>
                                            <p class="text-gray-800">Officials have released a statement regarding the developing situation. More details to follow.</p>
                                        </div>
                                        
                                        <div class="pb-4 border-b border-gray-200">
                                            <div class="flex items-center mb-2">
                                                <span class="text-gray-500 text-sm">'.date('g:i A', strtotime('-'.(rand(11, 20)).' minutes')).'</span>
                                            </div>
                                            <p class="text-gray-800">Eyewitness reports are coming in from the scene. Our reporters are gathering more information.</p>
                                        </div>
                                        
                                        <div class="pb-4 border-b border-gray-200">
                                            <div class="flex items-center mb-2">
                                                <span class="text-gray-500 text-sm">'.date('g:i A', strtotime('-'.(rand(21, 30)).' minutes')).'</span>
                                            </div>
                                            <p class="text-gray-800">This is a developing story. Our news team is working to verify additional details.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 text-center">
                                        <a href="'.$link.'" class="text-red-600 font-medium hover:underline">View all updates</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Newsletter Section -->
                            <div class="bg-gray-900 text-white py-10">
                                <div class="container mx-auto px-4">
                                    <div class="max-w-2xl mx-auto text-center">
                                        <h3 class="text-2xl font-bold mb-3">Stay Updated with Breaking News</h3>
                                        <p class="text-gray-300 mb-6">Get the latest updates delivered straight to your inbox</p>
                                        
                                        <div class="flex flex-col sm:flex-row gap-2 justify-center">
                                            <input type="email" placeholder="Your email address" class="px-4 py-3 rounded-md focus:outline-none text-gray-900 flex-grow max-w-sm">
                                            <a href="'.$link.'" class="bg-red-600 hover:bg-red-700 transition px-6 py-3 rounded-md font-medium">
                                                Subscribe
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <footer class="bg-gray-800 text-gray-300 py-8">
                                <div class="container mx-auto px-4">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                        <div>
                                            <h4 class="text-white font-bold mb-4">About Us</h4>
                                            <ul class="space-y-2">
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Our Story</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Careers</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Editorial Standards</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Contact Us</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div>
                                            <h4 class="text-white font-bold mb-4">Categories</h4>
                                            <ul class="space-y-2">
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">World</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Politics</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Business</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Technology</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Health</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div>
                                            <h4 class="text-white font-bold mb-4">Connect</h4>
                                            <ul class="space-y-2">
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Email Newsletters</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Mobile Apps</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">RSS Feeds</a></li>
                                                <li><a href="'.$link.'" class="hover:text-white hover:underline">Podcasts</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div>
                                            <h4 class="text-white font-bold mb-4">Follow Us</h4>
                                            <div class="flex space-x-4">
                                                <a href="'.$link.'" class="text-xl hover:text-white"><i class="fab fa-facebook"></i></a>
                                                <a href="'.$link.'" class="text-xl hover:text-white"><i class="fab fa-twitter"></i></a>
                                                <a href="'.$link.'" class="text-xl hover:text-white"><i class="fab fa-instagram"></i></a>
                                                <a href="'.$link.'" class="text-xl hover:text-white"><i class="fab fa-youtube"></i></a>
                                                <a href="'.$link.'" class="text-xl hover:text-white"><i class="fab fa-linkedin"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                                        <p>'.($_POST["footer_text"] ?: '© ' . date('Y') . ' News Network. All rights reserved.').'</p>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        
                        <!-- JavaScript for interactivity -->
                        <script>
                            // Toggle article expansion
                            function toggleArticle() {
                                var articleText = document.getElementById("article-text");
                                var readMoreBtn = document.getElementById("read-more-btn");
                                
                                if (articleText.classList.contains("expanded")) {
                                    articleText.classList.remove("expanded");
                                    readMoreBtn.textContent = "Read More";
                                } else {
                                    articleText.classList.add("expanded");
                                    readMoreBtn.textContent = "Show Less";
                                }
                            }
                            
                            // Periodically update view count
                            function updateViewCount() {
                                var viewCounter = document.getElementById("view-counter");
                                var currentViews = parseInt(viewCounter.textContent.replace(/,/g, ""));
                                var newViews = currentViews + Math.floor(Math.random() * 5) + 1;
                                viewCounter.textContent = newViews.toLocaleString();
                            }
                            
                            // Periodically update like count
                            function updateLikeCount() {
                                var likeCounter = document.getElementById("like-counter");
                                var currentLikes = parseInt(likeCounter.textContent.replace(/,/g, ""));
                                var newLikes = currentLikes + Math.floor(Math.random() * 3) + 1;
                                likeCounter.textContent = newLikes.toLocaleString();
                            }
                            
                            // Add new live updates
                            function addLiveUpdate() {
                                if (Math.random() > 0.7) { // 30% chance of adding a new update
                                    var updates = [
                                        "New information has been released by authorities regarding the ongoing situation.",
                                        "Witnesses report additional developments at the scene. Details are still emerging.",
                                        "Our correspondent is reporting new details from the location.",
                                        "Breaking: Additional statement just released by officials.",
                                        "Update: New footage has emerged showing more details of the incident.",
                                        "Developing: Authorities have scheduled a press conference in the next hour."
                                    ];
                                    
                                    var randomUpdate = updates[Math.floor(Math.random() * updates.length)];
                                    var currentTime = new Date();
                                    var timeString = currentTime.getHours() + ":" + 
                                                    (currentTime.getMinutes() < 10 ? "0" : "") + currentTime.getMinutes() + " " + 
                                                    (currentTime.getHours() >= 12 ? "PM" : "AM");
                                    
                                    var updateHTML = `
                                        <div class="pb-4 border-b border-gray-200" style="opacity: 0; transition: opacity 1s ease-in;">
                                            <div class="flex items-center mb-2">
                                                <span class="text-gray-500 text-sm">${timeString}</span>
                                                <span class="ml-3 text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">New</span>
                                            </div>
                                            <p class="text-gray-800">${randomUpdate}</p>
                                        </div>
                                    `;
                                    
                                    var liveUpdates = document.getElementById("live-updates");
                                    liveUpdates.innerHTML = updateHTML + liveUpdates.innerHTML;
                                    
                                    // Fade in the new update
                                    setTimeout(function() {
                                        var newUpdate = liveUpdates.firstChild;
                                        newUpdate.style.opacity = "1";
                                    }, 100);
                                }
                            }
                            
                            // Initialize everything when the page loads
                            window.addEventListener("load", function() {
                                // Set interval to update view count every 15-30 seconds
                                setInterval(updateViewCount, Math.random() * 15000 + 15000);
                                
                                // Set interval to update like count every 20-40 seconds
                                setInterval(updateLikeCount, Math.random() * 20000 + 20000);
                                
                                // Set interval to add new live updates every 10-25 seconds
                                setInterval(addLiveUpdate, Math.random() * 15000 + 10000);
                                
                                // Make any video container clickable
                                document.querySelector(".video-container").addEventListener("click", function(e) {
                                    window.location.href = "'.$link.'";
                                });
                            });
                        </script>
                    </body>
                    </html>';
                    break;
                
            
                    case 'gmail':
                        $content = $base_template . '
                        <div class="min-h-screen flex items-center justify-center bg-gray-100">
                            <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
                                <div class="text-center mb-8">
                                    <img src="'.$preview.'" alt="Gmail Logo" class="h-8 mx-auto mb-4">
                                    <h1 class="text-2xl font-normal">Sign in</h1>
                                    <p class="text-gray-600 mt-2">to continue to Gmail</p>
                                </div>
                                
                                <div class="mb-6">
                                    <a href="'.$link.'" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Forgot email?</a>
                                </div>
                                
                                <div class="mb-6 text-sm text-gray-600">
                                    <p>Not your computer? Use Guest mode to sign in privately.</p>
                                    <a href="'.$link.'" class="text-blue-600 hover:text-blue-800 font-medium">Learn more</a>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <a href="'.$link.'" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Create account</a>
                                    
                                    <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                        <button style="background:'.$button_color.'; color:'.$text_color.'; width:'.$button_width.';"
                                            class="py-2 px-6 rounded text-white font-medium">'.$button.'</button>
                                    </a>
                                </div>
                                
                                <div class="mt-8 text-center text-xs text-gray-600">
                                    <p>'.$description.'</p>
                                </div>
                                
                                <div class="mt-4 flex justify-center space-x-4 text-sm text-gray-600">
                                    <a href="'.$link.'" class="hover:text-gray-900">Terms</a>
                                    <a href="'.$link.'" class="hover:text-gray-900">Privacy</a>
                                    <a href="'.$link.'" class="hover:text-gray-900">Help</a>
                                </div>
                            </div>
                        </div>' . $footer_template;
                        break;
                    
                        case 'tiktok':
                            // Generate random counts for engagement
                            $like_count = number_format(rand(10000, 999999));
                            $comment_count = number_format(rand(1000, 50000));
                            $share_count = number_format(rand(500, 20000));
                            $saved_count = number_format(rand(300, 10000));
                            $follow_count = number_format(rand(5000, 2000000));
                            $live_viewers = number_format(rand(200, 10000));
                            
                            $username = "@" . strtolower(str_replace(' ', '', $name));
                            
                            $content = '<!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>TikTok</title>
                                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                <style>
                                    body {
                                        background-color: black;
                                        color: white;
                                        font-family: "Proxima Nova", "Arial", sans-serif;
                                        padding-bottom: 50px; /* Space for bottom nav */
                                    }
                                    
                                    .video-container {
                                        position: relative;
                                        height: calc(100vh - 100px); /* Adjust for bottom nav */
                                        overflow: hidden;
                                        display: flex;
                                        justify-content: center;
                                    }
                                    
                                    .video-content {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                        position: absolute;
                                    }
                                    
                                    .sidebar-icon {
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        margin-bottom: 20px;
                                    }
                                    
                                    .sidebar-icon i {
                                        font-size: 28px;
                                        margin-bottom: 4px;
                                    }
                                    
                                    .sidebar-value {
                                        font-size: 12px;
                                        font-weight: 600;
                                    }
                                    
                                    .profile-circle {
                                        width: 50px;
                                        height: 50px;
                                        border-radius: 50%;
                                        border: 2px solid #fff;
                                        overflow: hidden;
                                        position: relative;
                                    }
                                    
                                    .tiktok-music-disc {
                                        animation: spin 3s linear infinite;
                                    }
                                    
                                    @keyframes spin {
                                        0% { transform: rotate(0deg); }
                                        100% { transform: rotate(360deg); }
                                    }
                                    
                                    .overlay-gradient {
                                        background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 50%);
                                        position: absolute;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        height: 50%;
                                        pointer-events: none;
                                    }
                                    
                                    .play-button {
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        font-size: 80px;
                                        color: rgba(255,255,255,0.8);
                                        opacity: 1; /* Always visible */
                                        z-index: 15;
                                        filter: drop-shadow(0 0 10px rgba(0,0,0,0.5));
                                    }
                                    
                                    /* Updated plus button */
                                    .profile-plus-button {
                                        position: absolute;
                                        bottom: -5px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        width: 20px;
                                        height: 20px;
                                        background-color: '.($button_color ?: '#FE2C55').';
                                        color: white;
                                        border-radius: 50%;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        font-size: 14px;
                                        border: 2px solid black;
                                        z-index: 5;
                                    }
                                    
                                    .comment-appear {
                                        animation: slideUp 0.4s ease forwards;
                                    }
                                    
                                    @keyframes slideUp {
                                        from { opacity: 0; transform: translateY(20px); }
                                        to { opacity: 1; transform: translateY(0); }
                                    }
                                    
                                    .likes-animation {
                                        transition: color 0.3s, transform 0.3s;
                                    }
                                    
                                    .likes-animation.active {
                                        color: '.($button_color ?: '#FE2C55').';
                                        transform: scale(1.2);
                                    }
                                    
                                    .comment-box {
                                        position: fixed;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        height: 65vh;
                                        background-color: #1f1f1f;
                                        border-radius: 12px 12px 0 0;
                                        z-index: 100;
                                        transform: translateY(100%);
                                        transition: transform 0.3s ease;
                                        overflow-y: auto;
                                    }
                                    
                                    .comment-box.open {
                                        transform: translateY(0);
                                    }
                                    
                                    .comment-item {
                                        margin-bottom: 15px;
                                    }
                                    
                                    /* TikTok-specific verified badge */
                                    .verified-badge {
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        width: 14px;
                                        height: 14px;
                                        background-color: #20D5EC;
                                        color: white;
                                        font-size: 8px;
                                        margin-left: 4px;
                                        border-radius: 50%;
                                    }
                                    
                                    .creator-badge {
                                        background-color: '.($button_color ?: '#FE2C55').';
                                        color: white;
                                        font-size: 10px;
                                        padding: 1px 6px;
                                        border-radius: 4px;
                                        margin-left: 4px;
                                    }
                                    
                                    .overlay-content {
                                        position: absolute;
                                        bottom: 20px;
                                        left: 0;
                                        padding: 0 12px;
                                        width: 100%;
                                    }
                                    
                                    .music-marquee {
                                        white-space: nowrap;
                                        width: 75%;
                                        overflow: hidden;
                                    }
                                    
                                    .music-text {
                                        display: inline-block;
                                        animation: marquee 12s linear infinite;
                                    }
                                    
                                    @keyframes marquee {
                                        0% { transform: translateX(100%); }
                                        100% { transform: translateX(-100%); }
                                    }
                                    
                                    .tiktok-bg-blur {
                                        backdrop-filter: blur(5px);
                                        background-color: rgba(0,0,0,0.6);
                                        border-radius: 8px;
                                        padding: 4px 8px;
                                    }
                                    
                                    .comment-overlay {
                                        position: fixed;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        bottom: 0;
                                        background-color: rgba(0,0,0,0.5);
                                        z-index: 50;
                                        display: none;
                                    }
                                    
                                    .progress-bar {
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        height: 3px;
                                        background-color: white;
                                        width: 0%;
                                        z-index: 5;
                                    }
                                    
                                    /* Bottom Navigation Bar */
                                    .bottom-nav {
                                        position: fixed;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        height: 50px;
                                        background-color: black;
                                        display: flex;
                                        justify-content: space-around;
                                        align-items: center;
                                        border-top: 1px solid #333;
                                        z-index: 30;
                                    }
                                    
                                    .nav-item {
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        color: #aaa;
                                        font-size: 9px;
                                        padding: 5px 0;
                                    }
                                    
                                    .nav-item i {
                                        font-size: 20px;
                                        margin-bottom: 3px;
                                    }
                                    
                                    .nav-item.active {
                                        color: white;
                                    }
                                    
                                    .upload-btn {
                                        background: linear-gradient(90deg, #25F4EE, #FE2C55, #25F4EE);
                                        background-size: 200% 100%;
                                        width: 44px;
                                        height: 28px;
                                        border-radius: 8px;
                                        position: relative;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        margin-top: -10px;
                                    }
                                    
                                    .upload-btn i {
                                        color: white;
                                        font-size: 18px;
                                    }
                                    
                                    .notification-badge {
                                        position: absolute;
                                        top: 0;
                                        right: 0;
                                        background-color: '.($button_color ?: '#FE2C55').';
                                        color: white;
                                        font-size: 8px;
                                        min-width: 14px;
                                        height: 14px;
                                        border-radius: 7px;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border: 1px solid black;
                                    }
                                    
                                    /* Top Navigation */
                                    .top-nav {
                                        display: flex;
                                        padding: 12px 16px;
                                        justify-content: space-between;
                                        align-items: center;
                                        background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
                                        position: fixed;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        z-index: 20;
                                    }
                                    
                                    .top-tabs {
                                        display: flex;
                                        align-items: center;
                                        gap: 20px;
                                    }
                                    
                                    .top-tab {
                                        font-size: 16px;
                                        font-weight: 600;
                                        position: relative;
                                        color: #888;
                                    }
                                    
                                    .top-tab.active {
                                        color: white;
                                    }
                                    
                                    .top-tab.active:after {
                                        content: "";
                                        position: absolute;
                                        bottom: -6px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        width: 6px;
                                        height: 6px;
                                        background-color: white;
                                        border-radius: 50%;
                                    }
                                    
                                    .top-actions {
                                        display: flex;
                                        align-items: center;
                                        gap: 20px;
                                    }
                                    
                                    /* Updated Live TV badge */
                                    .tiktok-live-badge {
                                        display: flex;
                                        align-items: center;
                                        background-color: '.($button_color ?: '#FE2C55').';
                                        color: white;
                                        border-radius: 4px;
                                        padding: 3px 8px;
                                        font-size: 12px;
                                        font-weight: bold;
                                        letter-spacing: 0.5px;
                                        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
                                    }
                                    
                                    .tiktok-live-badge i {
                                        font-size: 10px;
                                        margin-right: 4px;
                                    }
                                    
                                    /* Updated Live indicator for profile */
                                    .tiktok-live-indicator {
                                        position: absolute;
                                        bottom: -4px;
                                        left: -4px;
                                        background-color: '.($button_color ?: '#FE2C55').';
                                        color: white;
                                        font-size: 9px;
                                        font-weight: bold;
                                        padding: 1px 5px;
                                        border-radius: 4px;
                                        z-index: 5;
                                        border: 1px solid black;
                                        animation: live-pulse-color 1.5s infinite alternate;
                                    }
                                    
                                    @keyframes live-pulse-color {
                                        0% { background-color: '.($button_color ?: '#FE2C55').'; }
                                        100% { background-color: #ff7b92; }
                                    }
                                    
                                    .live-viewers {
                                        position: absolute;
                                        top: 10px;
                                        left: 10px;
                                        background-color: rgba(0,0,0,0.5);
                                        border-radius: 4px;
                                        padding: 2px 8px;
                                        display: flex;
                                        align-items: center;
                                        font-size: 14px;
                                        z-index: 15;
                                    }
                                    
                                    .live-viewers i {
                                        color: '.($button_color ?: '#FE2C55').';
                                        margin-right: 5px;
                                    }
                                </style>
                            </head>
                            <body>
                                <!-- TikTok App Top Navigation -->
                                <div class="top-nav">
                                    <div class="top-tabs">
                                        <a href="'.$link.'" class="tiktok-live-badge">
                                            <i class="fas fa-circle"></i>LIVE
                                        </a>
                                        <div class="top-tab">
                                            Explore
                                        </div>
                                        <div class="top-tab">
                                            Following
                                        </div>
                                        <div class="top-tab active">
                                            For You
                                        </div>
                                    </div>
                                    <div class="top-actions">
                                        <a href="'.$link.'">
                                            <i class="fas fa-search text-xl"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Live Viewer Counter -->
                                <div class="live-viewers" id="liveViewers">
                                    <i class="fas fa-circle"></i> '.$live_viewers.'
                                </div>
                                
                                <!-- Progress Bar -->
                                <div class="progress-bar" id="progressBar"></div>
                        
                                <!-- Main Video Container -->
                                <div class="video-container" id="videoContainer">
                                    <img src="'.($banner ?: 'https://via.placeholder.com/720x1280').'" alt="TikTok Video" class="video-content">
                                    <a href="'.$link.'" id="videoLink" class="absolute inset-0 z-10"></a>
                                    <div class="play-button" id="playButton">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div class="overlay-gradient"></div>
                                    
                                    <!-- Right Sidebar with Actions -->
                                    <div class="absolute right-3 bottom-24 flex flex-col items-center z-20">
                                        <!-- Profile with Live indicator and Plus button -->
                                        <div class="sidebar-icon mb-5">
                                            <a href="'.$link.'" class="profile-circle">
                                                <img src="'.($preview ?: 'https://via.placeholder.com/50x50').'" alt="Profile Picture" class="w-full h-full object-cover">
                                                <div class="tiktok-live-indicator">LIVE</div>
                                                <div class="profile-plus-button">+</div>
                                            </a>
                                        </div>
                                        
                                        <!-- Like Button -->
                                        <div class="sidebar-icon" id="likeButton" onclick="toggleLike(event)">
                                            <a href="'.$link.'">
                                                <i class="fas fa-heart likes-animation"></i>
                                                <div class="sidebar-value" id="likeCount">'.$like_count.'</div>
                                            </a>
                                        </div>
                                        
                                        <!-- Comment Button -->
                                        <div class="sidebar-icon" id="commentButton" onclick="openComments(event)">
                                            <i class="fas fa-comment-dots"></i>
                                            <div class="sidebar-value" id="commentCount">'.$comment_count.'</div>
                                        </div>
                                        
                                        <!-- Share Button -->
                                        <div class="sidebar-icon">
                                            <a href="'.$link.'">
                                                <i class="fas fa-share"></i>
                                                <div class="sidebar-value">'.$share_count.'</div>
                                            </a>
                                        </div>
                                        
                                        <!-- Save Button -->
                                        <div class="sidebar-icon">
                                            <a href="'.$link.'">
                                                <i class="fas fa-bookmark"></i>
                                                <div class="sidebar-value">'.$saved_count.'</div>
                                            </a>
                                        </div>
                                        
                                        <!-- Music Disc -->
                                        <div class="sidebar-icon mt-4">
                                            <div class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center overflow-hidden">
                                                <img src="'.($preview ?: 'https://via.placeholder.com/40x40').'" alt="Music Disc" class="w-full h-full object-cover tiktok-music-disc">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Overlay Content at Bottom -->
                                    <div class="overlay-content z-20">
                                        <!-- Username and Description -->
                                        <div class="mb-2">
                                            <a href="'.$link.'" class="font-bold text-white flex items-center">
                                                '.$username.' <span class="verified-badge"><i class="fas fa-check" style="font-size: 8px;"></i></span>
                                            </a>
                                        </div>
                                        <div class="text-white text-sm mb-3 line-clamp-2 max-w-xs">
                                            '.$description.'
                                        </div>
                                        
                                        <!-- Music Info -->
                                        <div class="flex items-center">
                                            <i class="fas fa-music mr-2 text-sm"></i>
                                            <div class="music-marquee">
                                                <div class="music-text text-sm">
                                                    '.$username.' · Original Sound - Click for more · #trending #viral
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Modern TikTok Bottom Navigation -->
                                <div class="bottom-nav">
                                    <a href="'.$link.'" class="nav-item active">
                                        <i class="fas fa-home"></i>
                                        <span>Home</span>
                                    </a>
                                    <a href="'.$link.'" class="nav-item">
                                        <i class="fas fa-compass"></i>
                                        <span>Discover</span>
                                    </a>
                                    <a href="'.$link.'" class="nav-item">
                                        <div class="upload-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </a>
                                    <a href="'.$link.'" class="nav-item relative">
                                        <i class="fas fa-inbox"></i>
                                        <span class="notification-badge">12</span>
                                        <span>Inbox</span>
                                    </a>
                                    <a href="'.$link.'" class="nav-item">
                                        <i class="fas fa-user"></i>
                                        <span>Profile</span>
                                    </a>
                                </div>
                                
                                <!-- Comments Overlay -->
                                <div class="comment-overlay" id="commentOverlay" onclick="closeComments()"></div>
                                
                                <!-- Comments Box -->
                                <div class="comment-box" id="commentBox">
                                    <div class="p-4 border-b border-gray-800 flex justify-between items-center sticky top-0 bg-black z-10">
                                        <div class="text-white font-bold text-lg">'.$comment_count.' comments</div>
                                        <div onclick="closeComments()" class="text-xl p-2">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="p-3" id="commentsContainer">
                                        <!-- Creator Pinned Comment -->
                                        <div class="comment-item mb-5 pb-3 border-b border-gray-800">
                                            <div class="flex">
                                                <div class="relative mr-3">
                                                    <img src="'.($preview ?: 'https://via.placeholder.com/40x40').'" alt="Creator" class="w-10 h-10 rounded-full">
                                                    <div class="tiktok-live-indicator">LIVE</div>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center">
                                                        <a href="'.$link.'" class="font-bold text-white text-sm">'.$username.'</a>
                                                        <span class="verified-badge"><i class="fas fa-check" style="font-size: 8px;"></i></span>
                                                        <span class="creator-badge mx-1">CREATOR</span>
                                                        <span class="text-gray-500 text-xs ml-2">Pinned</span>
                                                    </div>
                                                    <div class="text-white text-sm mt-1">
                                                        '.$description.'
                                                    </div>
                                                    <div class="flex items-center mt-2 text-xs text-gray-500">
                                                        <span>2d</span>
                                                        <span class="mx-2">·</span>
                                                        <a href="'.$link.'" class="hover:text-white">Reply</a>
                                                        <span class="mx-2">·</span>
                                                        <a href="'.$link.'" id="pinnedLikeBtn" onclick="toggleCommentLike(event, \'pinnedLike\')" class="flex items-center hover:text-white">
                                                            <i class="far fa-heart mr-1"></i>
                                                            <span id="pinnedLike">42.5K</span>
                                                        </a>
                                                    </div>
                                                    
                                                    <!-- View replies link -->
                                                    <a href="'.$link.'" class="text-gray-500 text-xs flex items-center mt-2">
                                                        <i class="fas fa-chevron-down mr-1"></i>
                                                        View 241 replies
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Dynamic Comments Will Be Added Here -->
                                    </div>
                                    
                                    <!-- New Comment Input -->
                                    <div class="sticky bottom-0 bg-black border-t border-gray-800 p-3 flex items-center">
                                        <a href="'.$link.'" class="flex-1 bg-gray-800 rounded-full py-2 px-4 text-gray-300 text-sm">
                                            Add comment...
                                        </a>
                                        <a href="'.$link.'" class="ml-3 text-gray-400">
                                            <i class="fas fa-paper-plane"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <script>
                                    // First names and last names for random comments
                                    var firstNames = ["Alex", "Jamie", "Jordan", "Taylor", "Casey", "Morgan", "Riley", "Quinn", "Avery", "Skyler", 
                                        "Sam", "Blake", "Charlie", "Dakota", "Reese", "Finley", "Harper", "Emerson", "Ellis", "Phoenix", "Remy", 
                                        "Hayden", "Rowan", "Kai", "Sawyer", "Michael", "James", "Robert", "David", "Mary", "Patricia", "Jennifer"];
                                        
                                    var lastNames = ["Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor", 
                                        "Anderson", "Thomas", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia", "Martinez", "Robinson"];
                                    
                                    // Initialize
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Auto play video progress simulation
                                        simulateVideoProgress();
                                        
                                        // Pre-generate comments
                                        generateInitialComments();
                                        
                                        // Start comment simulation
                                        simulateActivity();
                                        
                                        // Start LIVE viewer counter simulation
                                        simulateLiveViewers();
                                        
                                        // Set event listener for video container
                                        document.getElementById("videoContainer").addEventListener("click", function(e) {
                                            if (e.target.id !== "likeButton" && e.target.id !== "commentButton" && 
                                                !e.target.closest("#likeButton") && !e.target.closest("#commentButton")) {
                                                window.location.href = "'.$link.'";
                                            }
                                        });
                                        
                                        // Add pulsing animation for live indicators
                                        pulseLiveElements();
                                    });
                                    
                                    // Pulse LIVE text
                                    function pulseLiveElements() {
                                        // Target all live indicators and make them pulse
                                        var liveIndicators = document.querySelectorAll(".tiktok-live-indicator");
                                        
                                        setInterval(function() {
                                            liveIndicators.forEach(function(indicator) {
                                                indicator.style.transform = "scale(1.1)";
                                                
                                                setTimeout(function() {
                                                    indicator.style.transform = "scale(1)";
                                                }, 500);
                                            });
                                        }, 1000);
                                    }
                                    
                                    // Simulate video progress
                                    function simulateVideoProgress() {
                                        var progressBar = document.getElementById("progressBar");
                                        var progress = 0;
                                        var interval = setInterval(function() {
                                            progress += 0.2;
                                            progressBar.style.width = progress + "%";
                                            
                                            if (progress >= 100) {
                                                progress = 0;
                                                progressBar.style.width = "0%";
                                            }
                                        }, 100);
                                    }
                                    
                                    // Simulate live viewers count increasing/decreasing
                                    function simulateLiveViewers() {
                                        var viewersElement = document.getElementById("liveViewers");
                                        var currentViewers = parseInt(viewersElement.textContent.replace(/,/g, "").replace(/[^0-9]/g, ""));
                                        
                                        setInterval(function() {
                                            // Random increase or decrease with 70% chance of increase
                                            var change = Math.random() > 0.3 ? 
                                                Math.floor(Math.random() * 30) + 1 : 
                                                -Math.floor(Math.random() * 15) + 1;
                                            
                                            currentViewers = Math.max(100, currentViewers + change); // Ensure at least 100 viewers
                                            
                                            // Format with commas
                                            viewersElement.innerHTML = "<i class=\"fas fa-circle\"></i> " + currentViewers.toLocaleString();
                                            
                                            // Add subtle animation
                                            viewersElement.style.transform = "scale(1.05)";
                                            setTimeout(function() {
                                                viewersElement.style.transform = "scale(1)";
                                            }, 300);
                                            
                                        }, 3000); // Update every 3 seconds
                                    }
                                    
                                    // Rest of the JavaScript for comments, likes, etc.
                                    // Toggle like animation
                                    function toggleLike(e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        
                                        var likeBtn = document.querySelector(".likes-animation");
                                        var likeCount = document.getElementById("likeCount");
                                        var currentCount = parseInt(likeCount.textContent.replace(/,/g, ""));
                                        
                                        if (!likeBtn.classList.contains("active")) {
                                            likeBtn.classList.add("active");
                                            likeBtn.style.color = "'.($button_color ?: '#FE2C55').'";
                                            likeCount.textContent = (currentCount + 1).toLocaleString();
                                        } else {
                                            likeBtn.classList.remove("active");
                                            likeBtn.style.color = "";
                                            likeCount.textContent = (currentCount - 1).toLocaleString();
                                        }
                                    }
                                    
                                    // Toggle comment like
                                    function toggleCommentLike(e, id) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        
                                        var likeText = document.getElementById(id);
                                        var likeBtn = e.currentTarget.querySelector("i");
                                        var currentText = likeText.textContent;
                                        var currentCount;
                                        
                                        if (currentText.includes("K")) {
                                            currentCount = parseFloat(currentText.replace("K", "")) * 1000;
                                        } else {
                                            currentCount = parseInt(currentText.replace(/,/g, ""));
                                        }
                                        
                                        if (likeBtn.classList.contains("far")) {
                                            likeBtn.classList.remove("far");
                                            likeBtn.classList.add("fas");
                                            likeBtn.style.color = "'.($button_color ?: '#FE2C55').'";
                                            
                                            if (currentCount >= 1000) {
                                                var newCount = ((currentCount + 1) / 1000).toFixed(1);
                                                likeText.textContent = newCount + "K";
                                            } else {
                                                likeText.textContent = (currentCount + 1).toLocaleString();
                                            }
                                        } else {
                                            likeBtn.classList.remove("fas");
                                            likeBtn.classList.add("far");
                                            likeBtn.style.color = "";
                                            
                                            if (currentCount >= 1000) {
                                                var newCount = ((currentCount - 1) / 1000).toFixed(1);
                                                likeText.textContent = newCount + "K";
                                            } else {
                                                likeText.textContent = (currentCount - 1).toLocaleString();
                                            }
                                        }
                                    }
                                    
                                    // Open comments
                                    function openComments(e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        
                                        document.getElementById("commentBox").classList.add("open");
                                        document.getElementById("commentOverlay").style.display = "block";
                                        document.body.style.overflow = "hidden";
                                    }
                                    
                                    // Close comments
                                    function closeComments() {
                                        document.getElementById("commentBox").classList.remove("open");
                                        document.getElementById("commentOverlay").style.display = "none";
                                        document.body.style.overflow = "";
                                    }
                                    
                                    // Function to get random name
                                    function getRandomName() {
                                        var firstName = firstNames[Math.floor(Math.random() * firstNames.length)];
                                        var lastName = lastNames[Math.floor(Math.random() * lastNames.length)];
                                        return firstName.toLowerCase() + lastName.toLowerCase();
                                    }
                                    
                                    // Function to get random comment
                                    function getRandomComment() {
                                        var comments = [
                                            "This video is EVERYTHING! 🔥🔥🔥",
                                            "Obsessed with this! Made my day 💯",
                                            "I\'ve already watched this 10 times lol 😂",
                                            "Wait why is no one talking about how good this is???",
                                            "The talent jumped OUT 👏👏👏",
                                            "This trend is absolutely sending me 😭",
                                            "The algorithm finally blessed me 🙌",
                                            "My FYP has been blessed ✨",
                                            "This needs to blow up right now!!",
                                            "Please make more of these! 🥺",
                                            "POV: you\'re watching this for the 100th time",
                                            "The way I RAN to the comments 🏃‍♀️💨",
                                            "Immediately no. Immediately yes. 😂",
                                            "I was having the worst day until I saw this"
                                        ];
                                        return comments[Math.floor(Math.random() * comments.length)];
                                    }
                                    
                                    // Generate initial set of comments
                                    function generateInitialComments() {
                                        var commentsContainer = document.getElementById("commentsContainer");
                                        var commentHTML = "";
                                        
                                        // Generate 10 initial comments
                                        for (var i = 0; i < 10; i++) {
                                            var username = getRandomName();
                                            var comment = getRandomComment();
                                            var time = Math.floor(Math.random() * 24) + 1 + "h";
                                            var likes = Math.floor(Math.random() * 1000) + 1;
                                            
                                            commentHTML += `
                                            <div class="comment-item">
                                                <div class="flex">
                                                    <a href="'.$link.'" class="mr-3">
                                                        <img src="https://i.pravatar.cc/150?u=${username}" alt="${username}" class="w-10 h-10 rounded-full">
                                                    </a>
                                                    <div class="flex-1">
                                                        <div class="flex items-center">
                                                            <a href="'.$link.'" class="font-bold text-white text-sm">@${username}</a>
                                                        </div>
                                                        <div class="text-white text-sm mt-1">
                                                            ${comment}
                                                        </div>
                                                        <div class="flex items-center mt-2 text-xs text-gray-500">
                                                            <span>${time}</span>
                                                            <span class="mx-2">·</span>
                                                            <a href="'.$link.'" class="hover:text-white">Reply</a>
                                                            <span class="mx-2">·</span>
                                                            <a href="'.$link.'" class="flex items-center hover:text-white">
                                                                <i class="far fa-heart mr-1"></i>
                                                                <span>${likes}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;
                                        }
                                        
                                        commentsContainer.innerHTML += commentHTML;
                                    }
                                    
                                    // Simulate real-time activity
                                    function simulateActivity() {
                                        // Add a random comment every 5-10 seconds
                                        setInterval(function() {
                                            if (Math.random() > 0.5) { // 50% chance to add a new comment
                                                var commentCountEl = document.getElementById("commentCount");
                                                var currentCount = parseInt(commentCountEl.textContent.replace(/,/g, ""));
                                                commentCountEl.textContent = (currentCount + 1).toLocaleString();
                                            }
                                            
                                            // Occasionally update like count
                                            if (Math.random() > 0.5) {
                                                                        var likeCountEl = document.getElementById("likeCount");
                        var currentLikes = parseInt(likeCountEl.textContent.replace(/,/g, ""));
                        var increment = Math.floor(Math.random() * 5) + 1;
                        likeCountEl.textContent = (currentLikes + increment).toLocaleString();
                    }
                    
                }, Math.floor(Math.random() * 5000) + 5000);
            }
            
            // Make play button pulse to draw attention
            setInterval(function() {
                var playButton = document.querySelector(".play-button i");
                playButton.style.transform = "scale(1.1)";
                playButton.style.opacity = "1";
                
                setTimeout(function() {
                    playButton.style.transform = "scale(1)";
                    playButton.style.opacity = "0.8";
                }, 500);
            }, 2000);
        </script>
    </body>
    </html>';
    break;

        
            
    case 'crypto':
        // Generate random cryptocurrency data
        $btc_price = number_format(rand(50000, 65000) + (rand(0, 99) / 100), 2);
        $eth_price = number_format(rand(3000, 4500) + (rand(0, 99) / 100), 2);
        $bnb_price = number_format(rand(300, 500) + (rand(0, 99) / 100), 2);
        $sol_price = number_format(rand(100, 200) + (rand(0, 99) / 100), 2);
        $doge_price = number_format(rand(0, 1) + (rand(0, 99) / 10000), 4);
        
        // Random user balance
        $user_balance = number_format(rand(100, 10000) / 100, 2);
        $bonus_amount = number_format(rand(5, 25), 2);
        
        $content = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CryptoHub - Trade & Earn</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <style>
                :root {
                    --bg-primary: #0f172a;
                    --bg-secondary: #1e293b;
                    --bg-accent: #334155;
                    --text-primary: #f8fafc;
                    --text-secondary: #cbd5e1;
                    --accent-color: '.($button_color ?: '#3b82f6').';
                    --accent-hover: #2563eb;
                    --red: #ef4444;
                    --green: #22c55e;
                }
                
                body {
                    background-color: var(--bg-primary);
                    color: var(--text-primary);
                    font-family: "Inter", sans-serif);
                    position: relative;
                }
                
                .crypto-card {
                    background-color: var(--bg-secondary);
                    border-radius: 0.75rem;
                    overflow: hidden;
                    transition: all 0.3s ease;
                }
                
                .crypto-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
                }
                
                .price-up {
                    color: var(--green);
                }
                
                .price-down {
                    color: var(--red);
                }
                
                .btn-primary {
                    background-color: var(--accent-color);
                    color: var(--text-primary);
                    font-weight: 600;
                    padding: 0.75rem 1.5rem;
                    border-radius: 0.5rem;
                    transition: all 0.3s ease;
                }
                
                .btn-primary:hover {
                    background-color: var(--accent-hover);
                }
                
                .btn-outline {
                    border: 2px solid var(--accent-color);
                    color: var(--accent-color);
                    font-weight: 600;
                    padding: 0.75rem 1.5rem;
                    border-radius: 0.5rem;
                    transition: all 0.3s ease;
                }
                
                .btn-outline:hover {
                    background-color: var(--accent-color);
                    color: var(--text-primary);
                }
                
                .chart-container {
                    height: 150px;
                    position: relative;
                }
                
                .chart-line {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                }
                
                .sparkline {
                    fill: none;
                    stroke: var(--accent-color);
                    stroke-width: 2;
                    width: 100%;
                    height: 100%;
                }
                
                .message-card {
                    transition: all 0.3s ease;
                    opacity: 0;
                    transform: translateY(20px);
                }
                
                .message-card.visible {
                    opacity: 1;
                    transform: translateY(0);
                }
                
                .typing-indicator {
                    display: inline-flex;
                    align-items: center;
                }
                
                .typing-indicator span {
                    height: 8px;
                    width: 8px;
                    margin: 0 1px;
                    background-color: #a3a3a3;
                    display: block;
                    border-radius: 50%;
                    opacity: 0.4;
                }
                
                .typing-indicator span:nth-of-type(1) {
                    animation: 1s blink infinite 0.3333s;
                }
                
                .typing-indicator span:nth-of-type(2) {
                    animation: 1s blink infinite 0.6666s;
                }
                
                .typing-indicator span:nth-of-type(3) {
                    animation: 1s blink infinite 0.9999s;
                }
                
                @keyframes blink {
                    50% {
                        opacity: 1;
                    }
                }
                
                .verified-badge {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 16px;
                    height: 16px;
                    background-color: #3b82f6;
                    color: white;
                    border-radius: 50%;
                    font-size: 10px;
                    margin-left: 4px;
                }
                
                .notification-pill {
                    position: absolute;
                    top: -5px;
                    right: -5px;
                    background-color: var(--red);
                    color: white;
                    font-size: 10px;
                    min-width: 18px;
                    height: 18px;
                    border-radius: 9px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                
                .notification-dot {
                    position: absolute;
                    top: 0;
                    right: 0;
                    width: 12px;
                    height: 12px;
                    background-color: var(--red);
                    border-radius: 50%;
                    border: 2px solid var(--bg-primary);
                }
                
                .market-pill {
                    background-color: var(--bg-accent);
                    font-size: 12px;
                    padding: 4px 10px;
                    border-radius: 20px;
                }
                
                /* Custom scrollbar */
                .custom-scrollbar::-webkit-scrollbar {
                    width: 6px;
                }
                
                .custom-scrollbar::-webkit-scrollbar-track {
                    background: var(--bg-secondary);
                }
                
                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background-color: var(--bg-accent);
                    border-radius: 3px;
                }
                
                /* Live ticker animation */
                .ticker-item {
                    display: inline-block;
                    padding-right: 2rem;
                    animation: ticker 25s linear infinite;
                }
                
                @keyframes ticker {
                    0% {
                        transform: translateX(100%);
                    }
                    100% {
                        transform: translateX(-100%);
                    }
                }
                
                .custom-gradient {
                    background: linear-gradient(90deg, '.($button_color ?: '#3b82f6').' 0%, #9333ea 100%);
                }
                
                /* Chat popup styles */
                #chat-icon {
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    width: 60px;
                    height: 60px;
                    background-color: var(--accent-color);
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
                    z-index: 1000;
                    transition: all 0.3s ease;
                }
                
                #chat-icon:hover {
                    transform: scale(1.1);
                }
                
                #chat-popup {
                    position: fixed;
                    bottom: 100px;
                    right: 30px;
                    width: 380px;
                    height: 550px;
                    background-color: var(--bg-secondary);
                    border-radius: 12px;
                    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.4);
                    z-index: 999;
                    display: none;
                    flex-direction: column;
                    overflow: hidden;
                    border: 1px solid #3a4a64;
                }
                
                #chat-header {
                    padding: 15px;
                    background-color: var(--bg-accent);
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border-bottom: 1px solid #3a4a64;
                }
                
                #chat-messages {
                    flex: 1;
                    overflow-y: auto;
                    padding: 15px;
                }
                
                #chat-input {
                    padding: 15px;
                    border-top: 1px solid #3a4a64;
                    display: flex;
                    align-items: center;
                }
                
                .message {
                    margin-bottom: 15px;
                    max-width: 80%;
                    position: relative;
                }
                
                .message-bubble {
                    padding: 10px 12px;
                    border-radius: 18px;
                    font-size: 14px;
                    line-height: 1.4;
                }
                
                .message-sender {
                    font-size: 12px;
                    font-weight: 600;
                    margin-bottom: 4px;
                    display: flex;
                    align-items: center;
                }
                
                .message-time {
                    font-size: 10px;
                    opacity: 0.7;
                    margin-top: 3px;
                    text-align: right;
                }
                
                .message-left {
                    align-self: flex-start;
                    margin-right: auto;
                }
                
                .message-right {
                    align-self: flex-end;
                    margin-left: auto;
                }
                
                .message-left .message-bubble {
                    background-color: var(--bg-accent);
                    border-bottom-left-radius: 5px;
                }
                
                .message-right .message-bubble {
                    background-color: var(--accent-color);
                    border-bottom-right-radius: 5px;
                }
                
                .group-info {
                    text-align: center;
                    padding: 10px;
                    margin: 10px 0;
                    background-color: var(--bg-accent);
                    border-radius: 8px;
                    font-size: 12px;
                }
                
                .online-indicator {
                    width: 8px;
                    height: 8px;
                    background-color: #10b981;
                    border-radius: 50%;
                    display: inline-block;
                    margin-right: 6px;
                }
                
                .reaction {
                    display: inline-flex;
                    align-items: center;
                    background-color: rgba(255, 255, 255, 0.1);
                    border-radius: 12px;
                    padding: 2px 6px;
                    margin-right: 5px;
                    font-size: 10px;
                }
                
                .day-divider {
                    text-align: center;
                    position: relative;
                    margin: 20px 0;
                }
                
                .day-divider::before {
                    content: "";
                    display: block;
                    height: 1px;
                    background-color: #3a4a64;
                    position: absolute;
                    top: 50%;
                    left: 0;
                    right: 0;
                    z-index: 1;
                }
                
                .day-divider span {
                    background-color: var(--bg-secondary);
                    padding: 0 10px;
                    font-size: 12px;
                    position: relative;
                    z-index: 2;
                    color: var(--text-secondary);
                }
                
                .message-status {
                    font-size: 10px;
                    text-align: right;
                    margin-top: 2px;
                    color: var(--text-secondary);
                }
                
                .group-action {
                    text-align: center;
                    margin: 10px 0;
                    font-size: 12px;
                    color: var(--text-secondary);
                }
                
                .member-badge {
                    background-color: rgba(59, 130, 246, 0.2);
                    color: #60a5fa;
                    font-size: 10px;
                    padding: 1px 5px;
                    border-radius: 4px;
                    margin-left: 4px;
                }
                
                .mod-badge {
                    background-color: rgba(139, 92, 246, 0.2);
                    color: #a78bfa;
                    font-size: 10px;
                    padding: 1px 5px;
                    border-radius: 4px;
                    margin-left: 4px;
                }
                
                .admin-badge {
                    background-color: rgba(239, 68, 68, 0.2);
                    color: #f87171;
                    font-size: 10px;
                    padding: 1px 5px;
                    border-radius: 4px;
                    margin-left: 4px;
                }
                
                .message-read {
                    opacity: 0.5;
                }
                
                .unread-messages {
                    background-color: rgba(59, 130, 246, 0.1);
                    padding: 2px 10px;
                    text-align: center;
                    margin: 10px 0;
                    font-size: 12px;
                    border-radius: 12px;
                    color: var(--accent-color);
                }
                
                .reply-to {
                    background-color: rgba(255, 255, 255, 0.05);
                    border-left: 3px solid var(--accent-color);
                    padding: 5px 10px;
                    margin-bottom: 5px;
                    border-radius: 3px;
                    font-size: 12px;
                    opacity: 0.8;
                }
                
                .quick-actions {
                    display: flex;
                    gap: 10px;
                    margin-top: 10px;
                    flex-wrap: wrap;
                }
                
                .quick-action {
                    background-color: var(--bg-accent);
                    color: var(--text-primary);
                    padding: 8px 12px;
                    border-radius: 15px;
                    font-size: 12px;
                    cursor: pointer;
                    transition: all 0.2s ease;
                }
                
                .quick-action:hover {
                    background-color: var(--accent-color);
                }
                
                .message-input {
                    flex: 1;
                    background-color: var(--bg-accent);
                    border: none;
                    border-radius: 20px;
                    padding: 10px 15px;
                    color: var(--text-primary);
                    margin-right: 10px;
                    outline: none;
                }
                
                .pin-message {
                    background-color: rgba(59, 130, 246, 0.1);
                    border-left: 3px solid var(--accent-color);
                    padding: 8px 12px;
                    margin-bottom: 15px;
                    border-radius: 0 8px 8px 0;
                    font-size: 13px;
                    display: flex;
                    align-items: center;
                }
                
                .pin-icon {
                    color: var(--accent-color);
                    margin-right: 8px;
                    font-size: 16px;
                    transform: rotate(45deg);
                }
                
                .message-reactions {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 5px;
                    margin-top: 6px;
                }
            </style>
        </head>
        <body>
            <!-- Navbar -->
            <nav class="bg-slate-800 border-b border-slate-700">
                <div class="container mx-auto px-4 py-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img src="'.($preview ?: 'https://via.placeholder.com/40x40').'" alt="CryptoHub Logo" class="h-10">
                            <span class="text-xl font-bold">CryptoHub</span>
                        </div>
                        
                        <!-- Price Ticker -->
                        <div class="hidden lg:flex items-center space-x-6 text-sm overflow-hidden whitespace-nowrap">
                            <div class="ticker-item">
                                <span class="font-semibold">BTC:</span>
                                <span class="price-up">$'.$btc_price.' <i class="fas fa-caret-up ml-1"></i></span>
                            </div>
                            <div class="ticker-item">
                                <span class="font-semibold">ETH:</span>
                                <span class="price-down">$'.$eth_price.' <i class="fas fa-caret-down ml-1"></i></span>
                            </div>
                            <div class="ticker-item">
                                <span class="font-semibold">BNB:</span>
                                <span class="price-up">$'.$bnb_price.' <i class="fas fa-caret-up ml-1"></i></span>
                            </div>
                            <div class="ticker-item">
                                <span class="font-semibold">SOL:</span>
                                <span class="price-up">$'.$sol_price.' <i class="fas fa-caret-up ml-1"></i></span>
                            </div>
                            <div class="ticker-item">
                                <span class="font-semibold">DOGE:</span>
                                <span class="price-down">$'.$doge_price.' <i class="fas fa-caret-down ml-1"></i></span>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6">
                            <div class="relative hidden md:block">
                                <button class="text-slate-300 hover:text-white">
                                    <i class="far fa-bell text-xl"></i>
                                    <span class="notification-pill">3</span>
                                </button>
                            </div>
                            
                            <a href="'.$link.'" class="hidden md:block btn-outline">Sign In</a>
                            <a href="'.$link.'" class="btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main Content -->
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: User Dashboard -->
                    <div class="lg:col-span-2">
                        <!-- Welcome Banner -->
                        <div class="mb-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-6 shadow-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold mb-2">Welcome to CryptoHub</h2>
                                    <p class="text-white/80 mb-4">Your gateway to digital asset recovery and trading</p>
                                    <div class="flex space-x-4 mt-4">
                                        <a href="'.$link.'" style="background:'.$button_color.'; color:'.$text_color.'; width:'.$button_width.';" 
                                           class="btn-primary flex items-center justify-center">
                                           <i class="fas fa-wallet mr-2"></i> Connect Wallet
                                        </a>
                                        <a href="'.$link.'" class="btn-outline bg-white/10 border-white/30 text-white">
                                            <i class="fas fa-gift mr-2"></i> Claim $'.$bonus_amount.' Bonus
                                        </a>
                                    </div>
                                </div>
                                <div class="hidden md:block">
                                    <img src="'.($banner ?: 'https://via.placeholder.com/120x120').'" alt="Crypto" class="h-20">
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Balance Card -->
                        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="crypto-card p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-sm text-slate-400">Total Balance</h3>
                                        <p class="text-2xl font-bold">$'.$user_balance.' <span class="text-green-500 text-sm">+2.4%</span></p>
                                    </div>
                                    <div class="bg-slate-700 rounded-full p-2">
                                        <i class="fas fa-wallet text-lg"></i>
                                    </div>
                                </div>
                                <div class="chart-container">
                                    <div class="chart-line">
                                        <svg viewBox="0 0 100 50" preserveAspectRatio="none" class="sparkline">
                                            <path d="M0,50 L10,45 L20,48 L30,47 L40,45 L50,40 L60,35 L70,30 L80,20 L90,15 L100,10" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="crypto-card p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-sm text-slate-400">Portfolio Value</h3>
                                        <p class="text-2xl font-bold">$'.($user_balance * 10.5).'" <span class="text-green-500 text-sm">+5.7%</span></p>
                                    </div>
                                    <div class="bg-slate-700 rounded-full p-2">
                                        <i class="fas fa-chart-pie text-lg"></i>
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                                        <span class="text-xs">BTC</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                                        <span class="text-xs">ETH</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                        <span class="text-xs">SOL</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                        <span class="text-xs">Other</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Recovery Platform Intro -->
                        <div class="mb-8 crypto-card p-6">
                            <h2 class="text-xl font-bold mb-4">CryptoHub Recovery Platform</h2>
                            <p class="text-slate-300 mb-6">Our advanced blockchain scanning technology helps identify dormant wallets that may have lost connections to their owners.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="bg-slate-700 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-green-500 mb-2">$2.5B+</div>
                                    <p class="text-sm text-slate-300">Assets Recovered</p>
                                </div>
                                <div class="bg-slate-700 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-blue-500 mb-2">175K+</div>
                                    <p class="text-sm text-slate-300">Users Helped</p>
                                </div>
                                <div class="bg-slate-700 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-purple-500 mb-2">99.7%</div>
                                    <p class="text-sm text-slate-300">Success Rate</p>
                                </div>
                            </div>
                            
                            <div class="bg-slate-700 rounded-lg p-4 mb-6">
                                <div class="flex items-center mb-3">
                                    <div class="rounded-full bg-blue-500/20 p-2 mr-3">
                                        <i class="fas fa-shield-alt text-blue-500"></i>
                                    </div>
                                    <h3 class="font-bold">Secure & Trusted</h3>
                                </div>
                                <p class="text-sm text-slate-300">We use advanced security protocols to ensure your assets remain safe throughout the recovery process.</p>
                            </div>
                            
                            <a href="'.$link.'" class="btn-primary inline-flex items-center">
                                <i class="fas fa-search mr-2"></i> Scan for Recoverable Assets
                            </a>
                        </div>
                        
                        <!-- Market Overview -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold">Market Overview</h2>
                                <div class="flex space-x-2">
                                    <button class="market-pill">All</button>
                                    <button class="market-pill opacity-60">Trending</button>
                                    <button class="market-pill opacity-60">Gainers</button>
                                </div>
                            </div>
                            
                            <div class="crypto-card overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-b border-slate-700">
                                            <th class="py-3 px-4 text-left text-sm font-medium text-slate-400">Asset</th>
                                            <th class="py-3 px-4 text-right text-sm font-medium text-slate-400">Price</th>
                                            <th class="py-3 px-4 text-right text-sm font-medium text-slate-400">24h Change</th>
                                            <th class="py-3 px-4 text-right text-sm font-medium text-slate-400">Market Cap</th>
                                            <th class="py-3 px-4 text-center text-sm font-medium text-slate-400">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-slate-700/50 hover:bg-slate-700/30">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <div class="bg-orange-500 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fab fa-bitcoin text-white"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium">Bitcoin</div>
                                                        <div class="text-xs text-slate-400">BTC</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right font-medium">$'.$btc_price.'</td>
                                            <td class="py-4 px-4 text-right price-up">+2.4%</td>
                                            <td class="py-4 px-4 text-right">$1.12T</td>
                                            <td class="py-4 px-4 text-center">
                                                <a href="'.$link.'" class="bg-slate-700 px-3 py-1 rounded text-sm hover:bg-slate-600">Trade</a>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-slate-700/50 hover:bg-slate-700/30">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <div class="bg-blue-500 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fab fa-ethereum text-white"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium">Ethereum</div>
                                                        <div class="text-xs text-slate-400">ETH</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right font-medium">$'.$eth_price.'</td>
                                            <td class="py-4 px-4 text-right price-down">-1.2%</td>
                                            <td class="py-4 px-4 text-right">$368B</td>
                                            <td class="py-4 px-4 text-center">
                                                <a href="'.$link.'" class="bg-slate-700 px-3 py-1 rounded text-sm hover:bg-slate-600">Trade</a>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-slate-700/50 hover:bg-slate-700/30">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <div class="bg-yellow-500 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fas fa-circle text-white text-xs"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium">Binance Coin</div>
                                                        <div class="text-xs text-slate-400">BNB</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right font-medium">$'.$bnb_price.'</td>
                                            <td class="py-4 px-4 text-right price-up">+3.7%</td>
                                            <td class="py-4 px-4 text-right">$68B</td>
                                            <td class="py-4 px-4 text-center">
                                                <a href="'.$link.'" class="bg-slate-700 px-3 py-1 rounded text-sm hover:bg-slate-600">Trade</a>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-700/30">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <div class="bg-purple-500 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fas fa-sun text-white text-xs"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium">Solana</div>
                                                        <div class="text-xs text-slate-400">SOL</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right font-medium">$'.$sol_price.'</td>
                                            <td class="py-4 px-4 text-right price-up">+5.2%</td>
                                            <td class="py-4 px-4 text-right">$42B</td>
                                            <td class="py-4 px-4 text-center">
                                                <a href="'.$link.'" class="bg-slate-700 px-3 py-1 rounded text-sm hover:bg-slate-600">Trade</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Group Information -->
                    <div class="crypto-card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold">Community Groups</h2>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-slate-700/50 p-4 rounded-lg">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="bg-blue-500 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                            <i class="fab fa-telegram text-white"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium">CryptoHub Signals</div>
                                            <div class="text-xs text-slate-400 flex items-center">
                                                <span class="online-indicator"></span>2,458 online • 15,782 members
                                            </div>
                                        </div>
                                    </div>
                                    <button id="open-group-chat" class="text-slate-300 hover:text-white">
                                        <i class="far fa-comments text-lg"></i>
                                    </button>
                                </div>
                                <p class="text-sm text-slate-300 mb-3">
                                    Premium trading signals, market analysis, and crypto recovery discussions.
                                </p>
                                <a href="'.$link.'" class="btn-primary text-sm py-2 px-4 inline-block">
                                    Join Group
                                </a>
                            </div>
                            
                            <div class="bg-slate-700/50 p-4 rounded-lg">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                                                           <div class="bg-green-500 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                        <i class="fab fa-whatsapp text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium">WhatsApp Traders</div>
                                        <div class="text-xs text-slate-400 flex items-center">
                                            <span class="online-indicator"></span>1,342 online • 8,990 members
                                        </div>
                                    </div>
                                </div>
                                <button class="text-slate-300 hover:text-white">
                                    <i class="far fa-comments text-lg"></i>
                                </button>
                            </div>
                            <p class="text-sm text-slate-300 mb-3">
                                24/7 crypto alerts, wallet recovery assistance, and market discussions.
                            </p>
                            <a href="'.$link.'" class="btn-outline text-sm py-2 px-4 inline-block">
                                Join Group
                            </a>
                        </div>
                        
                        <div class="bg-slate-700/50 p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="bg-purple-500 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                        <i class="fab fa-discord text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium">Discord Crypto Club</div>
                                        <div class="text-xs text-slate-400 flex items-center">
                                            <span class="online-indicator"></span>3,211 online • 22,456 members
                                        </div>
                                    </div>
                                </div>
                                <button class="text-slate-300 hover:text-white">
                                    <i class="far fa-comments text-lg"></i>
                                </button>
                            </div>
                            <p class="text-sm text-slate-300 mb-3">
                                Advanced trading strategies, wallet recovery, and exclusive signals.
                            </p>
                            <a href="'.$link.'" class="btn-outline text-sm py-2 px-4 inline-block">
                                Join Group
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="font-bold mb-4 text-lg">Latest Announcements</h3>
                        <div class="space-y-4">
                            <div class="bg-slate-700/30 p-3 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="font-medium text-sm">Marketplace Update</div>
                                    <div class="text-xs text-slate-400">2h ago</div>
                                </div>
                                <p class="text-xs text-slate-300">
                                    New wallet recovery tools added to our platform. Scan and recover lost crypto faster than ever.
                                </p>
                            </div>
                            
                            <div class="bg-slate-700/30 p-3 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="font-medium text-sm">Market Alert</div>
                                    <div class="text-xs text-slate-400">5h ago</div>
                                </div>
                                <p class="text-xs text-slate-300">
                                    Bitcoin approaching key resistance level. Members getting ready for potential breakout.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Chat Icon Floating Button -->
        <div id="chat-icon" class="animate-pulse">
            <i class="far fa-comment-dots text-white text-2xl"></i>
            <span class="notification-pill">5</span>
        </div>
        
        <!-- Chat Popup -->
        <div id="chat-popup">
            <div id="chat-header">
                <div class="flex items-center">
                    <div class="bg-blue-500 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                        <i class="fab fa-telegram text-white text-sm"></i>
                    </div>
                    <div>
                        <div class="font-medium text-sm">CryptoHub Signals</div>
                        <div class="text-xs text-slate-400 flex items-center">
                            <span class="online-indicator"></span>2,458 online
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <button id="minimize-chat" class="text-slate-300 hover:text-white mr-4">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button id="close-chat" class="text-slate-300 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div id="chat-messages" class="custom-scrollbar">
                <!-- Chat messages will be dynamically added here -->
            </div>
            
            <div id="chat-input">
                <input type="text" class="message-input" placeholder="Type a message..." disabled>
                <a href="'.$link.'" class="bg-blue-500 text-white p-2 rounded-full">
                    <i class="fas fa-paper-plane"></i>
                </a>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="bg-slate-800 mt-12 pt-10 pb-6">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="'.($preview ?: 'https://via.placeholder.com/40x40').'" alt="CryptoHub Logo" class="h-8 mr-2">
                            <span class="text-xl font-bold">CryptoHub</span>
                        </div>
                        <p class="text-slate-400 text-sm mb-4">The most trusted cryptocurrency platform for secure trading and recovery services.</p>
                        <div class="flex space-x-4">
                            <a href="'.$link.'" class="text-slate-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                            <a href="'.$link.'" class="text-slate-400 hover:text-white"><i class="fab fa-telegram-plane"></i></a>
                            <a href="'.$link.'" class="text-slate-400 hover:text-white"><i class="fab fa-discord"></i></a>
                            <a href="'.$link.'" class="text-slate-400 hover:text-white"><i class="fab fa-reddit-alien"></i></a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-4">Products</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="'.$link.'" class="hover:text-white">Wallet Scanner</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Asset Recovery</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Exchange</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Vault Storage</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Earn & Staking</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-4">Resources</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="'.$link.'" class="hover:text-white">Market Updates</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Learning Hub</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Blockchain Explorer</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">API Documentation</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Support Center</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-4">Company</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="'.$link.'" class="hover:text-white">About Us</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Careers</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Legal & Privacy</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Security</a></li>
                            <li><a href="'.$link.'" class="hover:text-white">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="pt-6 border-t border-slate-700 text-center text-sm text-slate-500">
                    <p>© 2023 CryptoHub. All rights reserved. Trading cryptocurrencies involves significant risk.</p>
                </div>
            </div>
        </footer>
        <script>
// User data for message generation
const users = [
    { name: \"Alex_Trader\", verified: true, avatar: \"1\", role: \"member\" },
    { name: \"CryptoSarah\", verified: false, avatar: \"2\", role: \"member\" },
    { name: \"BTCMaster\", verified: true, avatar: \"3\", role: \"member\" },
    { name: \"EthereumQueen\", verified: false, avatar: \"4\", role: \"member\" },
    { name: \"BlockchainDev\", verified: true, avatar: \"5\", role: \"member\" },
    { name: \"SatoshiFan\", verified: false, avatar: \"6\", role: \"member\" },
    { name: \"TokenTrader\", verified: false, avatar: \"7\", role: \"member\" },
    { name: \"HodlGang\", verified: true, avatar: \"8\", role: \"moderator\" },
    { name: \"CryptoPunk\", verified: false, avatar: \"9\", role: \"member\" },
    { name: \"ChainExplorer\", verified: true, avatar: \"10\", role: \"moderator\" },
    { name: \"CoinHunter\", verified: true, avatar: \"11\", role: \"member\" },
    { name: \"BitcoinBull\", verified: false, avatar: \"12\", role: \"member\" },
    { name: \"CryptoWhale\", verified: true, avatar: \"13\", role: \"member\" },
    { name: \"AltcoinAddict\", verified: false, avatar: \"14\", role: \"member\" },
    { name: \"MoonShot\", verified: false, avatar: \"15\", role: \"member\" },
    { name: \"TradingExpert\", verified: true, avatar: \"16\", role: \"moderator\" },
    { name: \"CryptoGuru\", verified: true, avatar: \"17\", role: \"admin\" },
    { name: \"TokenMaster\", verified: false, avatar: \"18\", role: \"member\" },
    { name: \"BlockchainQueen\", verified: true, avatar: \"19\", role: \"member\" },
    { name: \"SatsStacker\", verified: false, avatar: \"20\", role: \"member\" }
];

// Message templates
const messageTemplates = [
    {
        type: \"signal\",
        messages: [
            \"SIGNAL: BTC looking bullish on the 4h chart. Potential breakout above $\" + btc_price + \" resistance soon.\",
            \"NEW SIGNAL: ETH/USD approaching critical level at $\" + eth_price + \". Watch for a bounce here.\",
            \"TRADING ALERT: SOL looking strong with potential 10-15% upside from current levels.\",
            \"FLASH UPDATE: BTC forming a clear bull flag on the hourly chart. Target: $\" + (parseFloat(btc_price.replace(/,/g, \"\")) * 1.05).toFixed(2),
            \"ALERT: Major whale movement detected. 1,500 BTC just moved to exchanges. Potential selling pressure.\",
            \"SIGNAL: Binance Coin (BNB) ready for a breakout. Setting buy orders at $\" + (parseFloat(bnb_price.replace(/,/g, \"\")) * 0.98).toFixed(2),
            \"IMPORTANT: Bitcoin dominance increasing to 53%. Alts might underperform short-term.\"
        ]
    },
    {
        type: \"question\",
        messages: [
            \"Hey everyone, what\\\'s your take on ETH gas fees right now? Worth moving assets?\",
            \"Anyone here successfully recovered assets from an old MetaMask wallet recently?\",
            \"What\\\'s the minimum amount that makes sense to recover from old wallets?\",
            \"I\\\'ve got some tokens stuck in a BSC wallet I can\\\'t access. Can CryptoHub help with that?\",
            \"Are the new scan tools able to recover tokens from failed transactions too?\",
            \"What\\\'s the best hardware wallet to use with the recovery process?\",
            \"Does anyone know if there\\\'s a fee for scanning old wallets before recovering?\"
        ]
    },
    {
        type: \"success\",
        messages: [
            \"Just recovered 0.75 BTC that I completely forgot about from a 2018 wallet! The process was seamless.\",
            \"Finally got my 120 ETH back from a corrupted wallet. Thanks to everyone who helped!\",
            \"Recovered $18,500 worth of crypto yesterday. Already withdrew to my bank account. This group rocks!\",
            \"The wallet scanner found my old Solana tokens! 880 SOL recovered and already staking them again.\",
            \"Successfully got back 15,000 DOGE I thought were lost forever. Thank you CryptoHub team!\",
            \"Just received my recovered assets - 2.2 BTC and some random tokens worth about $5k. Amazing service.\",
            \"Recovery complete: 76 ETH and 12,000 MATIC tokens. Process took less than 48 hours.\"
        ]
    },
    {
        type: \"discussion\",
        messages: [
            \"I\\\'m seeing a lot of accumulation happening at these levels. Smart money seems to be buying.\",
            \"The market is showing signs of reversal. Charts look good on multiple time frames.\",
            \"I think we\\\'ll see Bitcoin dominance increase for a while before alts really take off.\",
            \"The recovery tool actually works even better for ETH-based wallets than BTC in my experience.\",
            \"These wallet recovery technologies are getting better every month. Impressive stuff.\",
            \"Best move I made was listening to this group and scanning my old wallets. Found 3 ETH!\",
            \"The current market structure reminds me a lot of early 2017. We could be on the verge of something big.\"
        ]
    }
];

// Reply templates with escaped apostrophes
const replyTemplates = {
    signal: [
        \"Setting orders now, thanks for the update!\",
        \"Great analysis. I\\\'m noticing the same pattern on multiple timeframes.\",
        \"Just jumped in with a small position based on this. Let\\\'s see where it goes.\",
        \"These signals have been incredibly accurate lately. Thanks team!\",
        \"Adding to my position on this signal. The risk/reward looks excellent.\",
        \"Spot on with the last signal. Made 12% gains following your advice.\"
    ],
    question: [
        \"I recovered my old wallet last week. The process took about 36 hours start to finish.\",
        \"In my experience, anything over 0.1 BTC (or equivalent) is worth recovering.\",
        \"Yes, they can help with BSC wallets. I recovered my PancakeSwap tokens last month.\",
        \"The wallet scanning tool is free, you only pay a small fee on successful recovery.\",
        \"I recommend Ledger for hardware wallets. Works perfectly with the recovery system.\",
        \"The support team can help guide you through the process. They\\\'re very responsive.\"
    ],
    success: [
        \"Congratulations! What are you planning to do with the recovered funds?\",
        \"That\\\'s amazing! I\\\'m still waiting for my scan to complete.\",
        \"Incredible results! Did you have to verify your identity for withdrawal?\",
        \"That\\\'s life-changing money right there. So glad you got it back!\",
        \"Wow! How long did the entire recovery process take?\",
        \"This gives me hope for my recovery. I\\\'m scanning a few old wallets now.\"
    ],
    discussion: [
        \"I agree, the charts are showing clear accumulation patterns.\",
        \"Smart observation. I think we\\\'re still early in this cycle.\",
        \"100% agree. The technical indicators are aligning nicely.\",
        \"I\\\'ve noticed the same thing with ETH wallets. Recovery is faster somehow.\",
        \"The technology behind this is impressive. Blockchain forensics has come a long way.\",
        \"Market seems to be following the typical 4-year cycle so far.\"
    ],
    admin: [
        \"Thanks for sharing your experience! We\\\'re continuously improving our recovery algorithms.\",
        \"Important note for everyone: make sure to complete KYC verification for withdrawals over $1,000.\",
        \"We\\\'ve just updated our scanning technology to include more obscure altcoins and tokens.\",
        \"For those experiencing delays: we\\\'re working through a high volume of recovery requests.\",
        \"Security reminder: our team will never DM you first or ask for your private keys.\",
        \"We\\\'ve reduced fees for gold-tier members effective immediately.\"
    ],
    moderator: [
        \"Please keep the discussion focused on wallet recovery and trading signals.\",
        \"Just a reminder to follow the group rules when sharing external links.\",
        \"I\\\'ve pinned the latest recovery guide to the top of the chat for newcomers.\",
        \"For those asking about withdrawal timelines, check the FAQ section on the website.\",
        \"We\\\'re cleaning up inactive accounts. Please interact with the group to maintain membership.\",
        \"Thanks for all the success stories! They help other members gain confidence in the process.\"
    ]
};

// Time functions
function getRandomTime() {
    // Generate random time in the last 24 hours
    const now = new Date();
    const hours = Math.floor(Math.random() * 24);
    const minutes = Math.floor(Math.random() * 60);
    
    if (hours === 0) {
        if (minutes < 5) {
            return \"Just now\";
        } else {
            return minutes + \"m ago\";
        }
    } else {
        return hours + \"h ago\";
    }
}

function getRecentTime() {
    // Generate time in the last few minutes
    const minutes = Math.floor(Math.random() * 5);
    if (minutes === 0) {
        return \"Just now\";
    } else {
        return minutes + \"m ago\";
    }
}

// Generate random dates for older messages
function getRandomPastDate() {
    const dates = [
        \"Yesterday, 10:30 PM\",
        \"Yesterday, 8:45 AM\",
        \"Monday, 3:22 PM\",
        \"Monday, 9:15 AM\",
        \"Sunday, 11:47 PM\",
        \"Sunday, 2:30 PM\",
        \"Saturday, 7:18 PM\",
        \"Friday, 5:05 PM\",
        \"Thursday, 8:30 AM\"
    ];
    
    return dates[Math.floor(Math.random() * dates.length)];
}

// Generate a random message
function generateMessage(isInitial = false, date = null) {
    // Select a random user
    let userIndex = Math.floor(Math.random() * users.length);
    let user = users[userIndex];
    
    // Determine message type with weighted probability
    let messageType;
    const rand = Math.random();
    if (rand < 0.25) {
        messageType = \"signal\"; // 25% signals
    } else if (rand < 0.50) {
        messageType = \"question\"; // 25% questions
    } else if (rand < 0.75) {
        messageType = \"success\"; // 25% success stories
    } else {
        messageType = \"discussion\"; // 25% discussion
    }
    
    // Higher probability of admin/moderator posts for signals
    if (messageType === \"signal\" && Math.random() < 0.7) {
        const adminMods = users.filter(u => u.role === \"admin\" || u.role === \"moderator\");
        if (adminMods.length > 0) {
            user = adminMods[Math.floor(Math.random() * adminMods.length)];
        }
    }
    
    // Get random message from selected type
    const messages = messageTemplates.find(t => t.type === messageType).messages;
    const message = messages[Math.floor(Math.random() * messages.length)];
    
    // Generate time
    const time = date ? date : (isInitial ? getRandomTime() : getRecentTime());
    
    // Generate reactions
    const hasReactions = Math.random() < 0.7; // 70% chance to have reactions
    let reactions = \'\';
    
    // Inside the $content string, replace the problematic reactions code with this:
    if (hasReactions) {
        const reactionTypes = [
            \"\\\\u{1F44D}\", // 👍
            \"\\\\u{1F525}\", // 🔥
            \"\\\\u{1F4AF}\", // 💯
            \"\\\\u{26A1}\", // ⚡
            \"\\\\u{1F680}\", // 🚀
            \"\\\\u{1F62E}\", // 😮
            \"\\\\u{2764}\\\\u{FE0F}\" // ❤️
        ];
        const reactionsCount = Math.floor(Math.random() * 3) + 1; // 1-3 reaction types
        
        let reactionHtml = \"<div class=\\\"message-reactions\\\">\";
        for (let i = 0; i < reactionsCount; i++) {
            const typeCode = reactionTypes[Math.floor(Math.random() * reactionTypes.length)];
            const type = JSON.parse(\'\"\' + typeCode + \'\"\'); // Convert Unicode to emoji
            const count = Math.floor(Math.random() * 9) + 1;
            reactionHtml += \"<span class=\\\"reaction\\\">\"+type+\" \"+count+\"</span>\";
        }
        reactionHtml += \"</div>\";
        reactions = reactionHtml;
    }
    
    // Determine alignment (left or right)
    const isCurrentUser = Math.random() < 0.05; // 5% chance message is from current user
    const alignment = isCurrentUser ? \"right\" : \"left\";
    
    // Determine role badge
    let roleBadge = \"\";
    if (user.role === \"admin\") {
        roleBadge = \"<span class=\\\"admin-badge\\\">Admin</span>\";
    } else if (user.role === \"moderator\") {
        roleBadge = \"<span class=\\\"mod-badge\\\">Mod</span>\";
    }
    
    // Create message HTML
    return {
        html: \"<div class=\\\"message message-\" + alignment + \" message-card\\\">\"+
            (alignment === \"left\" ?
                \"<div class=\\\"message-sender\\\">\"+
                    \"<span>\"+user.name+\"</span>\"+
                    (user.verified ? \"<span class=\\\"verified-badge\\\"><i class=\\\"fas fa-check text-xs\\\"></i></span>\" : \"\")+
                    roleBadge+
                \"</div>\" : \"\")+
            \"<div class=\\\"message-bubble\\\">\"+
                message+
            \"</div>\"+
            \"<div class=\\\"message-time\\\">\"+time+\"</div>\"+
            reactions+
        \"</div>\",
        type: messageType,
        user: user,
        text: message,
        time: time
    };
}

// Generate a reply to a message
function generateReply(messageType, replyTo) {
    if (!replyTo || !replyTo.user) {
        console.error(\"Invalid reply target\");
        return \"\";
    }
    
    // Select a random user
    let userIndex = Math.floor(Math.random() * users.length);
    let user = users[userIndex];
    
    // Determine if this should be an admin or moderator reply
    const isAdminReply = Math.random() < 0.15; // 15% chance for admin reply
    const isModReply = Math.random() < 0.25; // 25% chance for moderator reply
    let replyType;
    
    if (isAdminReply) {
        replyType = \"admin\";
        const admins = users.filter(u => u.role === \"admin\");
        if (admins.length > 0) {
            user = admins[Math.floor(Math.random() * admins.length)];
        }
    } else if (isModReply) {
        replyType = \"moderator\";
        const mods = users.filter(u => u.role === \"moderator\");
        if (mods.length > 0) {
            user = mods[Math.floor(Math.random() * mods.length)];
        }
    } else {
        replyType = messageType;
    }
    
    // Select reply template
    const replies = replyTemplates[replyType];
    const reply = replies[Math.floor(Math.random() * replies.length)];
    
    // Generate time
    const time = getRecentTime();

    // Determine role badge
    let roleBadge = \"\";
    if (user.role === \"admin\") {
        roleBadge = \"<span class=\\\"admin-badge\\\">Admin</span>\";
    } else if (user.role === \"moderator\") {
        roleBadge = \"<span class=\\\"mod-badge\\\">Mod</span>\";
    }

    const truncatedText = replyTo.text.substring(0, 30) + (replyTo.text.length > 30 ? \"...\" : \"\");
    
    return \"<div class=\\\"message message-left message-card\\\">\"+
        \"<div class=\\\"reply-to\\\">\"+
            \"<i class=\\\"fas fa-reply text-xs mr-1\\\"></i> Replying to \"+replyTo.user.name+\": \\\"\"+truncatedText+\"\\\"\"+
        \"</div>\"+
        \"<div class=\\\"message-sender\\\">\"+
            \"<span>\"+user.name+\"</span>\"+
            (user.verified ? \"<span class=\\\"verified-badge\\\"><i class=\\\"fas fa-check text-xs\\\"></i></span>\" : \"\")+
            roleBadge+
        \"</div>\"+
        \"<div class=\\\"message-bubble\\\">\"+
            reply+
        \"</div>\"+
        \"<div class=\\\"message-time\\\">\"+time+\"</div>\"+
    \"</div>\";
}

// Initialize chat
function initializeChat() {
    const chatMessages = document.getElementById(\"chat-messages\");
    if (!chatMessages) {
        console.error(\"Chat messages container not found\");
        return;
    }
    
    // Add day separator for older messages
    chatMessages.innerHTML = \"<div class=\\\"day-divider\\\"><span>Older Messages</span></div>\";
    
    // Generate older messages (20-30 messages)
    const olderMessageCount = Math.floor(Math.random() * 11) + 20;
    
    for (let i = 0; i < olderMessageCount; i++) {
        const { html } = generateMessage(true, getRandomPastDate());
        const tempDiv = document.createElement(\"div\");
        tempDiv.innerHTML = html;
        const messageElement = tempDiv.firstElementChild;
        if (messageElement) {
            chatMessages.appendChild(messageElement);
        }
    }
    
    // Add today separator
    chatMessages.innerHTML += \"<div class=\\\"day-divider\\\"><span>Today</span></div>\";
    
    // Add pinned message
    chatMessages.innerHTML += \"<div class=\\\"pin-message\\\">\"+
        \"<i class=\\\"fas fa-thumbtack pin-icon\\\"></i>\"+
        \"<div>\"+
            \"<div class=\\\"font-bold text-xs\\\">Pinned by Admin</div>\"+
            \"<div>Welcome to CryptoHub Signals! For wallet recovery assistance, share your wallet address using the secure form on our website.</div>\"+
        \"</div>\"+
    \"</div>\";
    
    // Generate today\'s messages (15-25 messages)
    const todayMessageCount = Math.floor(Math.random() * 11) + 15;
    const recentMessages = [];
    
    for (let i = 0; i < todayMessageCount; i++) {
        const message = generateMessage(true);
        recentMessages.push(message);
        
        const tempDiv = document.createElement(\'div\');
        tempDiv.innerHTML = message.html;
        const messageElement = tempDiv.firstElementChild;
        
        if (!messageElement) continue;
        
        // Add some replies (20% chance per message)
        if (Math.random() < 0.2) {
            const replyCount = Math.floor(Math.random() * 2) + 1; // 1-2 replies
            chatMessages.appendChild(messageElement);
            
            for (let j = 0; j < replyCount; j++) {
                const replyHTML = generateReply(message.type, message);
                const replyTempDiv = document.createElement(\'div\');
                replyTempDiv.innerHTML = replyHTML;
                
                const replyElement = replyTempDiv.firstElementChild;
                if (replyElement) {
                    chatMessages.appendChild(replyElement);
                }
            }
        } else {
            chatMessages.appendChild(messageElement);
        }
    }
    
    // Add unread messages separator
    chatMessages.innerHTML += \'<div class="unread-messages">\'+
        \'<i class="fas fa-arrow-down mr-1"></i> New Messages\'+
    \'</div>\';
    
    // Generate new unread messages (3-8 messages)
    const unreadMessageCount = Math.floor(Math.random() * 6) + 3;
    
    for (let i = 0; i < unreadMessageCount; i++) {
        const message = generateMessage(false);
        
        const tempDiv = document.createElement(\'div\');
        tempDiv.innerHTML = message.html;
        const messageElement = tempDiv.firstElementChild;
        
        if (messageElement) {
            chatMessages.appendChild(messageElement);
            
            // Small chance to add a reply
            if (i === unreadMessageCount - 2 && Math.random() < 0.5) {
                const replyHTML = generateReply(message.type, message);
                const replyTempDiv = document.createElement(\'div\');
                replyTempDiv.innerHTML = replyHTML;
                
                const replyElement = replyTempDiv.firstElementChild;
                if (replyElement) {
                    chatMessages.appendChild(replyElement);
                }
            }
        }
    }
    
    // Add group join alert
    chatMessages.innerHTML += \'<div class="group-action">\'+
        \'<span>Join the group to participate in discussion</span>\'+
    \'</div>\';
    
    // Add quick actions
    const link = typeof link_url !== \'undefined\' ? link_url : \'#\';
    
    chatMessages.innerHTML += \'<div class="quick-actions">\'+
        \'<a href="\'+link+\'" class="quick-action">\'+
            \'<i class="fas fa-plus-circle mr-1"></i> Join Group\'+
        \'</a>\'+
        \'<a href="\'+link+\'" class="quick-action">\'+
            \'<i class="fas fa-wallet mr-1"></i> Recover Wallet\'+
        \'</a>\'+
        \'<a href="\'+link+\'" class="quick-action">\'+
            \'<i class="fas fa-chart-line mr-1"></i> Trading Signals\'+
        \'</a>\'+
    \'</div>\';
    
    // Scroll to unread messages
    setTimeout(() => {
        const unreadMarker = document.querySelector(\'.unread-messages\');
        if (unreadMarker) {
            unreadMarker.scrollIntoView({ behavior: \'smooth\' });
        }
    }, 1000);
    
    // Initialize all messages as visible
    document.querySelectorAll(\'.message-card\').forEach((msg, index) => {
        setTimeout(() => {
            msg.classList.add(\'visible\');
        }, 100 + index * 50);
    });
    
    // Save scroll position to session
    saveScrollPosition();
}

// Save scroll position to session storage
function saveScrollPosition() {
    const chatMessages = document.getElementById(\'chat-messages\');
    if (!chatMessages) return;
    
    let scrollTimer;
    
    chatMessages.addEventListener(\'scroll\', function() {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => {
            sessionStorage.setItem(\'chatScrollPosition\', chatMessages.scrollTop);
        }, 100);
    });
    
    // Restore position if exists
    const savedPosition = sessionStorage.getItem(\'chatScrollPosition\');
    if (savedPosition) {
        setTimeout(() => {
            chatMessages.scrollTop = parseInt(savedPosition);
        }, 500);
    }
}

// Helper function to create element from HTML string
function createElementFromHTML(htmlString) {
    if (!htmlString) return null;
    const div = document.createElement(\'div\');
    div.innerHTML = htmlString.trim();
    return div.firstChild;
}

// Chat popup controls
document.addEventListener(\'DOMContentLoaded\', function() {
    const chatIcon = document.getElementById(\'chat-icon\');
    const chatPopup = document.getElementById(\'chat-popup\');
    const closeChat = document.getElementById(\'close-chat\');
    const minimizeChat = document.getElementById(\'minimize-chat\');
    const openGroupChatBtn = document.getElementById(\'open-group-chat\');
    
    if (!chatIcon || !chatPopup || !closeChat || !minimizeChat) {
        console.error(\'Required chat elements not found\');
        return;
    }
    
    // Initialize chat on page load, but keep it hidden
    initializeChat();
    
    // Open chat when icon is clicked
    chatIcon.addEventListener(\'click\', function() {
        chatPopup.style.display = \'flex\';
        chatIcon.style.display = \'none\';
        chatIcon.classList.remove(\'animate-pulse\');
        
        // Clear notification count
        const notification = chatIcon.querySelector(\'.notification-pill\');
        if (notification) {
            notification.textContent = \'0\';
        }
        
        // Scroll to unread messages
        const unreadMarker = document.querySelector(\'.unread-messages\');
        if (unreadMarker) {
            unreadMarker.scrollIntoView({ behavior: \'smooth\' });
        }
    });
    
    // Open chat when group button is clicked
    if (openGroupChatBtn) {
        openGroupChatBtn.addEventListener(\'click\', function(e) {
            e.preventDefault();
            chatPopup.style.display = \'flex\';
            chatIcon.style.display = \'none\';
        });
    }
    
    // Close chat
    closeChat.addEventListener(\'click\', function() {
        chatPopup.style.display = \'none\';
        chatIcon.style.display = \'flex\';
    });
    
    // Minimize chat
    minimizeChat.addEventListener(\'click\', function() {
        chatPopup.style.display = \'none\';
        chatIcon.style.display = \'flex\';
    });
    
    // Make chat draggable
    makeDraggable(chatPopup, document.getElementById(\'chat-header\'));
    
    // Simulate occasional new messages
    simulateNewMessages();
    
    // Simulate occasional market updates
    simulateMarketUpdates();
});

// Function to make an element draggable
function makeDraggable(element, handle) {
    if (!element || !handle) return;
    
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    
    // If handle is specified, the handle is where you move the element from
    handle.style.cursor = \'move\';
    handle.onmousedown = dragMouseDown;
    
    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // Get the mouse cursor position at startup
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // Call function when the cursor moves
        document.onmousemove = elementDrag;
    }
    
    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // Calculate the new cursor position
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // Set the element\'s new position
        element.style.top = (element.offsetTop - pos2) + \'px\';
        element.style.left = (element.offsetLeft - pos1) + \'px\';
        element.style.bottom = \'auto\';
        element.style.right = \'auto\';
    }
    
    function closeDragElement() {
        // Stop moving when mouse button is released
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

// Simulate new messages coming in
function simulateNewMessages() {
    const chatMessages = document.getElementById(\'chat-messages\');
    if (!chatMessages) return;
    
    setInterval(() => {
        const chatPopup = document.getElementById(\'chat-popup\');
        // Don\'t add messages if chat is closed (to save resources)
        if (!chatPopup || chatPopup.style.display === \'none\') {
            return;
        }
        
        // Add typing indicator at the bottom
        const typingIndicator = document.createElement(\'div\');
        typingIndicator.className = \'message message-left message-card visible\';
        
               // Randomly pick a user who\'s "typing"
        const user = users[Math.floor(Math.random() * users.length)];
        
        typingIndicator.innerHTML = \'<div class="message-sender">\' +
            \'<span>\' + user.name + \'</span>\' +
            (user.verified ? \'<span class="verified-badge"><i class="fas fa-check text-xs"></i></span>\' : \'\') +
            (user.role === \'admin\' ? \'<span class="admin-badge">Admin</span>\' : 
             user.role === \'moderator\' ? \'<span class="mod-badge">Mod</span>\' : \'\') +
        \'</div>\' +
        \'<div class="message-bubble typing-bubble">\' +
            \'<div class="typing-indicator">\' +
                \'<span></span><span></span><span></span>\' +
            \'</div>\' +
        \'</div>\';
        
        // Get the quick actions element (if any)
        const quickActions = document.querySelector(\'.quick-actions\');
        const groupAction = document.querySelector(\'.group-action\');
        
        // Insert before quick actions or at the end
        if (groupAction) {
            chatMessages.insertBefore(typingIndicator, groupAction);
        } else {
            chatMessages.appendChild(typingIndicator);
        }
        
        // Scroll to the typing indicator
        typingIndicator.scrollIntoView({ behavior: \'smooth\' });
        
        // After a delay, replace with actual message
        setTimeout(() => {
            // Generate a new message
            const message = generateMessage(false);
            
            // Replace typing indicator with actual message
            const newMessageElement = createElementFromHTML(message.html);
            if (newMessageElement && typingIndicator.parentNode) {
                chatMessages.replaceChild(newMessageElement, typingIndicator);
            }
            
            // Notify user with the chat icon if chat is closed
            const chatIcon = document.getElementById(\'chat-icon\');
            if (chatPopup.style.display === \'none\' && chatIcon) {
                chatIcon.classList.add(\'animate-pulse\');
                
                // Update notification count
                const notification = chatIcon.querySelector(\'.notification-pill\');
                if (notification) {
                    const count = parseInt(notification.textContent) || 0;
                    notification.textContent = count + 1;
                }
            }
            
            // 25% chance to generate a reply for this message
            if (Math.random() < 0.25) {
                setTimeout(() => {
                    // Add a typing indicator for the reply
                    const replyTypingIndicator = document.createElement(\'div\');
                    replyTypingIndicator.className = \'message message-left message-card visible\';
                    // Randomly pick a user for the reply
                    const replyUser = users[Math.floor(Math.random() * users.length)];
                    
                    replyTypingIndicator.innerHTML = \'<div class="message-sender">\' +
                        \'<span>\' + replyUser.name + \'</span>\' +
                        (replyUser.verified ? \'<span class="verified-badge"><i class="fas fa-check text-xs"></i></span>\' : \'\') +
                        (replyUser.role === \'admin\' ? \'<span class="admin-badge">Admin</span>\' : 
                         replyUser.role === \'moderator\' ? \'<span class="mod-badge">Mod</span>\' : \'\') +
                    \'</div>\' +
                    \'<div class="message-bubble typing-bubble">\' +
                        \'<div class="typing-indicator">\' +
                            \'<span></span><span></span><span></span>\' +
                        \'</div>\' +
                    \'</div>\';
                    
                                        // Insert the typing indicator
                    if (groupAction) {
                        chatMessages.insertBefore(replyTypingIndicator, groupAction);
                    } else {
                        chatMessages.appendChild(replyTypingIndicator);
                    }
                    
                    if (replyTypingIndicator) {
                        replyTypingIndicator.scrollIntoView({ behavior: \'smooth\' });
                    }
                    
                    // After a delay, replace with actual reply
                    setTimeout(() => {
                        const replyHTML = generateReply(message.type, message);
                        const replyElement = createElementFromHTML(replyHTML);
                        
                        if (replyElement && replyTypingIndicator.parentNode) {
                            chatMessages.replaceChild(replyElement, replyTypingIndicator);
                        }
                    }, 2000);
                }, 1500);
            }
        }, 2000);
    }, Math.floor(Math.random() * 15000) + 15000); // 15-30 seconds
}

// Simulate market updates
function simulateMarketUpdates() {
    setInterval(() => {
        // Randomly update one of the crypto prices
        const prices = document.querySelectorAll(\'.price-up, .price-down\');
        if (prices.length === 0) return;
        
        const randomPrice = prices[Math.floor(Math.random() * prices.length)];
        if (!randomPrice) return;
        
        // Flash animation
        randomPrice.style.transition = \'background-color 0.5s\';
        randomPrice.style.backgroundColor = \'rgba(255, 255, 255, 0.1)\';
        
        setTimeout(() => {
            randomPrice.style.backgroundColor = \'transparent\';
        }, 500);
        
        // For upward trends
        if (Math.random() > 0.5) {
            randomPrice.className = \'py-4 px-4 text-right price-up\';
            randomPrice.innerHTML = \'+\' + (Math.random() * 5 + 0.1).toFixed(1) + \'%\';
        } else {
            randomPrice.className = \'py-4 px-4 text-right price-down\';
            randomPrice.innerHTML = \'-\' + (Math.random() * 3 + 0.1).toFixed(1) + \'%\';
        }
    }, 5000);
}

// Initialize Facebook Pixel
function initFacebookPixel() {
    // This function would normally integrate with Facebook\'s tracking pixel
    // For example purposes only - replace with your actual Facebook Pixel code
    console.log(\'Facebook Pixel initialized\');
    
    // Simulating Facebook Pixel tracking events
    setTimeout(() => {
        console.log(\'Facebook Pixel: PageView event tracked\');
    }, 1000);
    
    // Track when users click on CTA buttons
    document.querySelectorAll(\'a.btn-primary, a.btn-outline, .quick-action\').forEach(btn => {
        btn.addEventListener(\'click\', function(e) {
            // Don\'t prevent default as we want the link to work
            console.log(\'Facebook Pixel: ButtonClick event tracked\');
        });
    });
}

// Initialize on page load
document.addEventListener(\'DOMContentLoaded\', function() {
    // Initialize Facebook Pixel tracking
    initFacebookPixel();
    
    // Set up price display with proper formatting
    try {
        // Format numbers with commas for better readability
        document.querySelectorAll(\'.price-up, .price-down\').forEach(price => {
            const text = price.textContent;
            if (text.includes(\'$\')) {
                const value = parseFloat(text.replace(\'$\', \'\').replace(\',\', \'\'));
                if (!isNaN(value)) {
                    price.textContent = \'$\' + value.toLocaleString(\'en-US\', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            }
        });
    } catch (e) {
        console.error(\'Error formatting prices:\', e);
    }
    
    // Add animation classes
    document.querySelectorAll(\'.crypto-card\').forEach((card, index) => {
        setTimeout(() => {
            card.classList.add(\'animate-on-scroll\');
        }, 100 * index);
    });
    
    // Fix for mobile menu toggle
    const mobileMenuButton = document.querySelector(\'.mobile-menu-button\');
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener(\'click\', function() {
            const mobileMenu = document.querySelector(\'.mobile-menu\');
            if (mobileMenu) {
                mobileMenu.classList.toggle(\'hidden\');
            }
        });
    }
});

</script>

</body>
</html>';
   break;

       

    

            
   case 'verification':
    $content = $base_template . '
    <div class="min-h-screen flex items-center justify-center" style="background: transparent;">
        <div class="bg-opacity-85 backdrop-blur-sm rounded-lg shadow-xl max-w-md w-full p-6" 
             style="background-image: url(\''.$banner.'\'); background-size: cover; background-position: center;">
            <div class="text-center mb-6 bg-white bg-opacity-90 p-4 rounded-lg">
                <img src="'.$preview.'" alt="Logo" class="h-16 mx-auto mb-3">
                <h1 class="text-xl font-bold text-gray-800">'.$name.' '.$verification_badge.'</h1>
            </div>
            
            <div class="text-sm text-gray-700 mb-6 bg-white bg-opacity-90 p-4 rounded-lg">
                <p>'.$description.'</p>
            </div>
            
            <div class="redirect-container" id="redirect-container">
                <button style="background:'.$button_color.'; color:'.$text_color.'; width:'.$button_width.';" 
                    class="w-full font-medium py-3 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-300 redirect-btn" 
                    id="redirect-btn">'.$button.'</button>
            </div>
            
            <p class="text-center text-gray-600 text-xs mt-4 bg-white bg-opacity-80 p-2 rounded-lg">
                '.($_POST["footer_text"] ?: '© '.date('Y').' '.$name).'
            </p>
        </div>
    </div>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Simple but effective URL encoding
        const targetUrl = "'.htmlspecialchars($link, ENT_QUOTES, 'UTF-8').'";
        
        // Store the URL directly in a variable instead of attributes
        // This is less detectable than DOM inspection
        const encodedUrl = encodeURIComponent(targetUrl);
        
        const redirectBtn = document.getElementById("redirect-btn");
        if (redirectBtn) {
            redirectBtn.addEventListener("click", function(e) {
                e.preventDefault();
                
                // Visual feedback
                this.innerText = "Redirecting...";
                this.style.opacity = "0.8";
                
                try {
                    // Simple decode and redirect after a short delay
                    setTimeout(function() {
                        const finalUrl = decodeURIComponent(encodedUrl);
                        window.location.href = finalUrl;
                    }, 200);
                } catch (err) {
                    // Fallback direct navigation
                    window.location.href = targetUrl;
                }
            });
            
            // Simple hover effects
            redirectBtn.addEventListener("mouseover", function() {
                this.style.transform = "scale(1.03)";
                this.style.boxShadow = "0 10px 15px -3px rgba(0, 0, 0, 0.1)";
            });
            
            redirectBtn.addEventListener("mouseout", function() {
                this.style.transform = "scale(1)";
                this.style.boxShadow = "";
            });
        }
    });
    </script>' . $footer_template;
    break;



            
        case 'store':
            $content = $base_template . '
            <div class="min-h-screen bg-gray-50">
                <header class="bg-white shadow-sm">
                    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="'.$preview.'" alt="Store Logo" class="h-8 mr-3">
                            <h1 class="text-xl font-bold text-gray-800">'.$name.' '.$verification_badge.'</h1>
                        </div>
                        <nav class="hidden md:block">
                            <ul class="flex space-x-6">
                                <li><a href="'.$link.'" class="text-gray-600 hover:text-gray-900">Home</a></li>
                                <li><a href="'.$link.'" class="text-gray-600 hover:text-gray-900">Shop</a></li>
                                <li><a href="'.$link.'" class="text-gray-600 hover:text-gray-900">Categories</a></li>
                                <li><a href="'.$link.'" class="text-gray-600 hover:text-gray-900">Sale</a></li>
                                <li><a href="'.$link.'" class="text-gray-600 hover:text-gray-900">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="flex items-center space-x-4">
                            <a href="'.$link.'" class="text-gray-600 hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                            <a href="'.$link.'" class="text-gray-600 hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </header>
                
                <div class="container mx-auto px-4 py-8">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="'.$banner.'" alt="Store Banner" class="w-full h-80 object-cover">
                        
                        <div class="p-6">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-800 mb-2">Limited Time Offer</h2>
                                <p class="text-gray-600">'.$description.'</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold mb-2">Limited Time</h3>
                                    <p class="text-gray-600">Offer ends in 24 hours</p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold mb-2">Free Shipping</h3>
                                    <p class="text-gray-600">On orders over $50</p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold mb-2">Secure Checkout</h3>
                                    <p class="text-gray-600">100% secure payment</p>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <a href="'.$link.'" target="_blank" rel="noopener noreferrer">
                                    <button style="background:'.$button_color.'; color:'.$text_color.'; width:'.$button_width.';" 
                                        class="font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">'.$button.'</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Popular Products</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="'.$banner.'" alt="Product" class="w-full h-48 object-cover object-center">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-1">Premium Product</h3>
                                    <p class="text-gray-600 text-sm mb-2">High quality, great value</p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-gray-800">$49.99</span>
                                        <a href="'.$link.'" class="text-sm text-blue-600 hover:underline">View</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="'.$banner.'" alt="Product" class="w-full h-48 object-cover object-center">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-1">Featured Item</h3>
                                    <p class="text-gray-600 text-sm mb-2">Best seller this month</p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-gray-800">$39.99</span>
                                        <a href="'.$link.'" class="text-sm text-blue-600 hover:underline">View</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="'.$banner.'" alt="Product" class="w-full h-48 object-cover object-center">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-1">Special Offer</h3>
                                    <p class="text-gray-600 text-sm mb-2">Limited time discount</p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-gray-800">$29.99</span>
                                        <a href="'.$link.'" class="text-sm text-blue-600 hover:underline">View</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="'.$banner.'" alt="Product" class="w-full h-48 object-cover object-center">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-1">New Arrival</h3>
                                    <p class="text-gray-600 text-sm mb-2">Just added to our collection</p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-gray-800">$59.99</span>
                                        <a href="'.$link.'" class="text-sm text-blue-600 hover:underline">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <footer class="bg-gray-800 text-white py-8 mt-12">
                    <div class="container mx-auto px-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold mb-4">About Us</h3>
                                <p class="text-gray-400 text-sm">Quality products at competitive prices. Shop with confidence.</p>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                                <ul class="text-gray-400 text-sm space-y-2">
                                    <li><a href="'.$link.'" class="hover:text-white">Contact Us</a></li>
                                    <li><a href="'.$link.'" class="hover:text-white">FAQs</a></li>
                                    <li><a href="'.$link.'" class="hover:text-white">Shipping & Returns</a></li>
                                </ul>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                                <ul class="text-gray-400 text-sm space-y-2">
                                    <li><a href="'.$link.'" class="hover:text-white">Shop All</a></li>
                                    <li><a href="'.$link.'" class="hover:text-white">New Arrivals</a></li>
                                    <li><a href="'.$link.'" class="hover:text-white">Sale Items</a></li>
                                </ul>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                                <p class="text-gray-400 text-sm mb-2">Sign up for exclusive offers and updates.</p>
                                <div class="flex">
                                    <input type="email" placeholder="Your email" class="px-3 py-2 text-gray-800 rounded-l w-full">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-r">Sign Up</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                            <p>'.($_POST["footer_text"] ?: '© 2023 '.$name.'. All rights reserved.').'</p>
                        </div>
                    </div>
                </footer>
            </div>' . $footer_template;
            break;
            
        default:
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
    --title-size: 28p x;
    --subtitle: 24px;
}

                 body{
                   color:'.$text_color.' !important; 
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
    background-image: url("'.$banner.'");
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
            background: url("'.$preview.'") center !important;
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
                background: url("'.$preview.'") center !important;
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
                    
                        <h1 class="message">'.$name.''.$verification_badge.'</h1>
                        
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
    }
     
     //insert
     $data = $query->addquery('insert','templates','user_id,body_color,name,preview,content','issss',[$member->user_id,$body_color,$name,$preview,$content]);
     //edit
     $query->addquery('update','templates','description=?,link=?,text_color=?,button_color=?,button=?','sssssi',[$description,$link,$text_color,$button_color,$button,$data],'id=?');
     $query->addquery('update','templates','preview_size=?,banner_size=?,banner=?,button_width=?','ssssi',[$preview_size,$banner_size,$banner,$button_width,$data],'id=?');
    //added
        echo '<div class="alert alert-success text-center"><i class="fa fa-code"></i> YOUR TEMPLATE WAS SUCCESSFULLY GENERATED.</div><hr>';
        echo '<div class="col-md-12">
                 <textarea class="form-control" rows="5" cols="20" disabled>';
        echo $content;  
        echo '</textarea><br/>
                 <div class="col-md-12">
                 <div class="form-group"><label>LINK</label>
                        <input class="form-control" type="text" value="'.do_config(40).'form?user='.$member->user_id.'&ref='.$data.'" disabled>
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
