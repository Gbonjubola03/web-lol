<?php
// Define logged status first
$logged = isset($member) && $member !== null;

// Check if $member is defined before using it
if ($logged) {
    $previewfiles = $query->limit('files','*','id','desc','0,10','i',$member->user_id,'user_id=?');
    $avatar = $query->limit('files','*','id','desc','0,10','i', $member->user_id,'user_id=?');
   
} else {
    // Set default values or skip these queries when $member is not available
    $previewfiles = null;
    $avatar = null;
    $admin = null;
}

// Get announcements for the ticker
$announcements = $query->limit('announcements','*','id','desc','0,9','i',1,'status=?');

// Define constants if they don't exist
if (!defined('_SIGN_UP')) define('_SIGN_UP', 'Sign Up');
if (!defined('_REGISTER')) define('_REGISTER', 'Register');
if (!defined('_SIGN_IN')) define('_SIGN_IN', 'Sign In');
if (!defined('_DASHBOARD')) define('_DASHBOARD', 'Dashboard');
if (!defined('REGISTER')) define('REGISTER', 'Register');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> <?php echo do_config(1)?></title>
  <meta charset="UTF-8">
  <meta name="description" content=" <?php echo do_config(10)?>">
  <meta name="keywords" content=" <?php echo do_config(26)?>">
  <meta name="author" content=" <?php echo do_config(1)?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://use.fontawesome.com/08d0c47985.js"></script>
  <link rel="stylesheet" type="text/css" href="css/custom_styles.css">
  <script src="js/jquery.min.js"></script>
  <link rel="shortcut icon" type="image/png" href="<?php echo do_config(27)?>"/>
  
  <!-- Modern Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Roboto+Mono:wght@300;400;500&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  
  <!-- Modern CSS Framework -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom Modern Styling -->
  <style>
    :root {
      --primary-color: #00ff41;
      --primary-dark: #00cc33;
      --secondary-color: #ff00ff;
      --accent-color: #00ffff;
      --dark-bg: #121212;
      --darker-bg: #0a0a0a;
      --terminal-bg: #1a1a1a;
      --text-primary: #ffffff;
      --text-secondary: #cccccc;
      --text-muted: #888888;
      --border-dark: #333333;
      --danger-color: #ff3e3e;
      --info-color: #00e5ff;
      --success-color: #00ff41;
      --warning-color: #ffcc00;
      --font-main: 'Inter', sans-serif;
      --font-mono: 'Roboto Mono', monospace;
      --font-display: 'Orbitron', sans-serif;
      --header-height: 70px;
      --terminal-shadow: 0 0 15px rgba(0, 255, 65, 0.2);
      --pn-blue: #6c5ce7;
      --pn-dark-gray: #4a5568;
    }
    
    body {
      font-family: var(--font-main);
      background-color: var(--dark-bg);
      color: var(--text-primary);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      line-height: 1.6;
    }
    
    /* Modern Navbar Styling */
    .navbar {
      padding: 0.75rem 0;
      transition: all 0.3s ease;
    }
    
    .navbar-dark.bg-gradient-primary {
      background: linear-gradient(135deg, #121212 0%, #1a1a1a 100%);
      border-bottom: 1px solid rgba(0, 255, 65, 0.3);
    }
    
    .navbar-brand {
      font-family: var(--font-display);
      font-weight: 700;
      letter-spacing: 1px;
    }
    
    .navbar-brand img {
      filter: drop-shadow(0 0 5px rgba(0, 255, 65, 0.5));
      transition: all 0.3s ease;
    }
    
    .navbar-brand:hover img {
      transform: scale(1.05);
    }
    
    .nav-link {
      font-family: var(--font-mono);
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 0.5rem 1rem;
      margin: 0 0.25rem;
      color: var(--text-secondary) !important;
      position: relative;
      transition: all 0.3s ease;
    }
    
    .nav-link:before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background-color: var(--primary-color);
      transition: all 0.3s ease;
      transform: translateX(-50%);
      opacity: 0;
    }
    
    .nav-link:hover {
      color: var(--primary-color) !important;
    }
    
    .nav-link:hover:before {
      width: 80%;
      opacity: 1;
    }
    
    .nav-link i {
      margin-right: 0.5rem;
      font-size: 1rem;
    }
    
    /* Modern Button Styling */
    .btn {
      font-family: var(--font-mono);
      text-transform: uppercase;
      letter-spacing: 1px;
      font-size: 0.85rem;
      padding: 0.5rem 1.25rem;
      border-radius: 0;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .btn:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.1);
      z-index: -2;
    }
    
    .btn:before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      z-index: -1;
    }
    
    .btn:hover:before {
      width: 100%;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      color: var(--dark-bg);
      box-shadow: 0 0 10px rgba(0, 255, 65, 0.3);
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
      box-shadow: 0 0 15px rgba(0, 255, 65, 0.5);
    }
    
    .btn-light {
      background-color: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.1);
      color: var(--text-primary);
    }
    
    .btn-light:hover {
      background-color: rgba(255, 255, 255, 0.15);
      border-color: rgba(255, 255, 255, 0.15);
      color: var(--primary-color);
    }
    
    .lift {
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    
    .lift:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }
    
    /* Second Navbar Styling */
    .navbar.bg-dark {
      background-color: var(--darker-bg) !important;
      border-bottom: 1px solid var(--border-dark);
      padding: 0.5rem 0;
    }
    
    /* Glitch Effect */
    .glitch {
      position: relative;
      color: var(--primary-color);
      text-shadow: 0 0 5px rgba(0, 255, 65, 0.5);
    }
    
    .glitch:before, .glitch:after {
      content: attr(data-text);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.8;
    }
    
    .glitch:before {
      left: 2px;
      text-shadow: -1px 0 red;
      animation: glitch-anim-1 2s infinite linear alternate-reverse;
    }
    
    .glitch:after {
      left: -2px;
      text-shadow: -1px 0 blue;
      animation: glitch-anim-2 3s infinite linear alternate-reverse;
    }
    
    @keyframes glitch-anim-1 {
      0% {
        clip-path: inset(20% 0 80% 0);
      }
      20% {
        clip-path: inset(60% 0 1% 0);
      }
      40% {
        clip-path: inset(25% 0 58% 0);
      }
      60% {
        clip-path: inset(94% 0 2% 0);
      }
      80% {
        clip-path: inset(36% 0 38% 0);
      }
      100% {
        clip-path: inset(11% 0 83% 0);
      }
    }
    
    @keyframes glitch-anim-2 {
      0% {
        clip-path: inset(59% 0 43% 0);
      }
      20% {
        clip-path: inset(22% 0 68% 0);
      }
      40% {
        clip-path: inset(25% 0 58% 0);
      }
      60% {
        clip-path: inset(67% 0 11% 0);
      }
      80% {
        clip-path: inset(92% 0 6% 0);
      }
      100% {
        clip-path: inset(100% 0 0% 0);
      }
    }
    
    /* Scan Line Effect */
    .scanline {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: linear-gradient(
        to bottom,
        transparent 50%,
        rgba(0, 255, 65, 0.02) 50%
      );
      background-size: 100% 4px;
      pointer-events: none;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
      .navbar-collapse {
        background-color: var(--terminal-bg);
        border: 1px solid var(--primary-color);
        border-radius: 0;
        box-shadow: var(--terminal-shadow);
        padding: 1rem;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        z-index: 1000;
        margin: 0 1rem;
      }
      
      .nav-link:before {
        display: none;
      }
      
      .nav-link {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border-dark);
      }
      
      .nav-item:last-child .nav-link {
        border-bottom: none;
      }
    }
    
    /* Animated Background */
    .animated-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -2;
      opacity: 0.05;
      background: radial-gradient(circle at center, transparent 0%, var(--darker-bg) 70%);
    }
    
    /* Floating Particles */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }
    
    .particle {
      position: absolute;
      display: block;
      background-color: var(--primary-color);
      pointer-events: none;
      opacity: 0;
      border-radius: 50%;
      animation: float 15s infinite ease-in-out;
    }
    
    /* Status Indicator */
    .status-indicator {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: var(--primary-color);
      box-shadow: 0 0 10px var(--primary-color);
      animation: pulse 2s infinite;
    }
    
    .status-text {
      font-family: var(--font-mono);
      font-size: 0.75rem;
      color: var(--text-secondary);
      letter-spacing: 1px;
    }
    
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(0, 255, 65, 0.7);
      }
      70% {
        box-shadow: 0 0 0 5px rgba(0, 255, 65, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(0, 255, 65, 0);
      }
    }
    
    /* Terminal Line */
    .terminal-line {
      background-color: var(--terminal-bg);
      border-bottom: 1px solid var(--border-dark);
      padding: 0.5rem 0;
      overflow: hidden;
    }
    
    .terminal-text {
      font-family: var(--font-mono);
      font-size: 0.85rem;
      color: var(--primary-color);
      white-space: nowrap;
    }
    
    .terminal-prompt {
      color: var(--text-secondary);
    }
    
    .terminal-cursor {
      animation: blink 1s infinite;
    }
    
    @keyframes blink {
      0%, 49% {
        opacity: 1;
      }
      50%, 100% {
        opacity: 0;
      }
    }
    
    /* Cyber Button Enhancement */
    .cyber-btn {
      position: relative;
      border: 1px solid var(--primary-color);
      background-color: transparent;
      color: var(--primary-color);
      text-transform: uppercase;
      font-family: var(--font-mono);
      font-size: 0.8rem;
      letter-spacing: 1px;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .cyber-btn:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(
        90deg,
        transparent,
        rgba(0, 255, 65, 0.2),
        transparent
      );
      transition: all 0.6s ease;
    }
    
    .cyber-btn:hover:before {
      left: 100%;
    }
    
    .cyber-btn:hover {
      background-color: rgba(0, 255, 65, 0.1);
      color: var(--primary-color);
      box-shadow: 0 0 10px rgba(0, 255, 65, 0.3);
    }
    
    @keyframes float {
      0%, 100% {
        transform: translateY(0) translateX(0);
        opacity: 0;
      }
      10% {
        opacity: 0.5;
      }
      50% {
        transform: translateY(-100px) translateX(30px);
        opacity: 0.2;
      }
      90% {
        opacity: 0.1;
      }
    }

    /* Modern Announcement Styles */
    .pn-feed {
      margin: 20px 0;
      font-family: 'Poppins', sans-serif;
    }
    
    .pn-announcement {
      background: linear-gradient(135deg, #1a1a1a, #121212);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      position: relative;
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 255, 65, 0.2);
    }
    
    .pn-announcement:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(0, 255, 65, 0.4);
    }
    
    .pn-announcement::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 6px;
      height: 100%;
      background: linear-gradient(to bottom, var(--primary-color), var(--primary-dark));
      border-radius: 3px 0 0 3px;
    }
    
    .pn-announcement-header {
      display: flex;
      align-items: center;
      padding: 18px 24px;
      border-bottom: 1px solid rgba(0, 255, 65, 0.1);
      position: relative;
      z-index: 1;
    }
    
    .pn-announcement-icon {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 16px;
      box-shadow: 0 0 15px rgba(0, 255, 65, 0.3);
    }
    
    .pn-announcement-icon i {
      color: var(--dark-bg);
      font-size: 18px;
      animation: pulse 2s infinite;
    }
    
    .pn-announcement-info {
      flex: 1;
    }
    
    .pn-announcement-title {
      font-weight: 700;
      font-size: 18px;
      color: var(--text-primary);
      margin-bottom: 4px;
      letter-spacing: -0.3px;
    }
    
    .pn-announcement-time {
      font-size: 13px;
      color: var(--text-secondary);
      font-weight: 400;
    }
    
    .pn-ticker {
      padding: 20px 24px;
      position: relative;
      min-height: 120px;
    }
    
    .pn-ticker-items {
      position: relative;
    }
    
    .pn-ticker-item {
      display: none;
      animation: fadeIn 0.5s ease-in-out;
      padding: 5px 0;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .pn-ticker-item img {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }
    
    .pn-ticker-item:hover img {
      transform: scale(1.05);
    }
    
    .pn-announcement-link {
      display: inline-flex;
      align-items: center;
      color: var(--primary-color);
      font-weight: 600;
      font-size: 13px;
      margin-top: 8px;
      text-decoration: none;
      transition: all 0.3s ease;
      background: rgba(0, 255, 65, 0.1);
      padding: 5px 12px;
      border-radius: 20px;
    }
    
    .pn-announcement-link:hover {
      background: rgba(0, 255, 65, 0.2);
      color: var(--primary-color);
      transform: translateX(3px);
      text-decoration: none;
    }
    
    .pn-announcement-link-icon {
      margin-left: 6px;
      font-size: 10px;
      transition: transform 0.3s ease;
    }
    
    .pn-announcement-link:hover .pn-announcement-link-icon {
      transform: translateX(3px);
    }
    
    .pn-ticker-dots {
      display: flex;
      justify-content: center;
      margin-top: 15px;
      padding-bottom: 15px;
    }
    
    .pn-ticker-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: var(--border-dark);
      margin: 0 5px;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }
    
    .pn-ticker-dot:hover {
      background-color: var(--text-muted);
      transform: scale(1.2);
    }
    
    .pn-ticker-dot.active {
      background-color: var(--primary-color);
      transform: scale(1.2);
    }
    
    .pn-ticker-dot.active::after {
      content: '';
      position: absolute;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      border: 2px solid rgba(0, 255, 65, 0.3);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation: ripple 1.5s infinite;
    }
    
    .announcement-progress {
      z-index: 2;
      box-shadow: 0 2px 8px rgba(0, 255, 65, 0.3);
    }

    /* AdSense Containers */
    .ad-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px auto;
      overflow: hidden;
      clear: both;
      text-align: center;
    }
    
    .ad-container-header {
      min-height: 90px;
      margin-bottom: 20px;
    }
    
    .ad-container-sidebar {
      min-height: 250px;
      margin: 0 auto 20px;
    }
    
    .ad-container-footer {
      min-height: 90px;
      margin-top: 20px;
    }
    
    .ad-container-in-article {
      min-height: 250px;
      margin: 20px auto;
    }
    
    /* Ad label for compliance */
    .ad-label {
      display: block;
      text-align: center;
      font-size: 12px;
      color: var(--text-muted);
      margin-bottom: 5px;
      font-family: var(--font-sans);
    }
  </style>
</head>
<body>
  <!-- Animated Background Elements -->
  <div class="animated-bg"></div>
  <div class="scanline"></div>
  <div class="particles" id="particles"></div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>">
      <img src="<?php echo do_config(85);?>" class="navbar-brand-img" alt="logo" height="60" width="220" onerror="this.style.display='none';">
     
        </span>
      </a>
      
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Navbar content -->
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <!-- Close button -->
        <div class="d-flex justify-content-end mb-3 d-lg-none">
          <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Close">
            <i class="fa fa-times me-1"></i> Close
          </button>
        </div>
        
        <!-- Navigation -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>marketplace">
              <i class="fa fa-shopping-cart me-2"></i>Marketplace
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>blog">
              <i class="fa fa-bars me-2"></i>Blog
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>user/atm-logs">
              <i class="fa fa-credit-card me-2"></i>ATM Logs
            </a>
          </li>
          <?php if(!$logged): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>signup">
              <i class="fa fa-user-plus me-2"></i><?php echo _SIGN_UP; ?>
            </a>
          </li>
          <?php endif; ?>
        </ul>
        
        <!-- Authentication buttons -->
        <div class="d-flex mt-3 mt-lg-0">
          <?php if(!$logged): ?>
            <a class="btn btn-light me-2 cyber-btn" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>signup">
              <i class="fa fa-user-plus me-1"></i> <?php echo _REGISTER; ?>
            </a>
            <a class="btn btn-light cyber-btn" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>signin">
              <i class="fa fa-sign-in me-1"></i> <?php echo _SIGN_IN; ?>
            </a>
          <?php else: ?>
            <a class="btn btn-light cyber-btn" href="<?php echo function_exists('do_config') ? do_config(14) : '/'; ?>user/dashboard">
              <i class="fa fa-tachometer me-1"></i> <?php echo _DASHBOARD; ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</div>
  <!-- End of Navbar -->

  <!-- Announcements Section - Only displayed if there are announcements -->
  <?php if(isset($announcements) && $announcements->num_rows > 0): ?>
  <div class="container mt-4">
    <div class="pn-feed">
      <div class="pn-announcement">
        <div class="pn-announcement-header">
          <div class="pn-announcement-icon">
            <i class="fa fa-bullhorn"></i>
          </div>
          <div class="pn-announcement-info">
            <div class="pn-announcement-title">Latest Announcements</div>
            <div class="pn-announcement-time">Stay updated with important information</div>
          </div>
        </div>
        
        <div class="pn-ticker" id="announcementTicker">
          <div class="pn-ticker-items" id="tickerItems">
            <?php
            $announcements->data_seek(0);
            $slideIndex = 0;
            $announcementCount = 0;
            while($res=$announcements->fetch_assoc()){
              $slideIndex++;
              $announcementCount++;
              // Only show first 3 announcements
              if($announcementCount > 3) break;
            ?>
              <div class="pn-ticker-item" data-index="<?php echo $slideIndex; ?>">
                <div style="display: flex; align-items: center; width: 100%;">
                  <?php if(isset($res['preview']) && $res['preview'] != NULL){ ?>
                    <img src="<?php echo $res['preview'];?>" alt="<?php echo htmlspecialchars($res['title']);?>" style="width: 60px; height: 60px; border-radius: 8px; margin-right: 12px; object-fit: cover;" onerror="this.style.display='none';">
                  <?php } else { ?>
                    <div style="width: 60px; height: 60px; border-radius: 8px; margin-right: 12px; background-color: var(--primary-dark); display: flex; align-items: center; justify-content: center; color: var(--dark-bg);">
                      <i class="fa fa-bullhorn fa-lg"></i>
                    </div>
                  <?php } ?>
                  <div>
                    <div style="font-weight: 600; margin-bottom: 4px; color: var(--text-primary);"><?php echo htmlspecialchars($res['title']);?></div>
                    <div style="font-size: 0.9rem; color: var(--text-secondary);"><?php echo substr(strip_tags($res['content']), 0, 80);?>...</div>
                    <a href="<?php echo $res['link'];?>" class="pn-announcement-link">
                      OPEN<i class="fa fa-chevron-right pn-announcement-link-icon"></i>
                    </a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        
        <div class="pn-ticker-dots" id="tickerDots">
          <?php for($i = 1; $i <= min($slideIndex, 3); $i++) { ?>
            <div class="pn-ticker-dot <?php echo ($i == 1) ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- JavaScript for Enhanced Functionality -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Create floating particles
      const particlesContainer = document.getElementById('particles');
      const particleCount = 50;
      
      for (let i = 0; i < particleCount; i++) {
        createParticle(particlesContainer);
      }
      
      // Terminal typing effect
      const terminalText = document.getElementById('terminalText');
      if (terminalText) {
        const commands = [
          'connecting to secure server...',
          'access granted',
          'initializing security protocols...',
          'encryption enabled',
          'welcome to  <?php echo do_config(1)?> network',
          'system status: online'
        ];
        
        let commandIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typingSpeed = 100;
        
        function typeEffect() {
          const currentCommand = commands[commandIndex];
          const promptSpan = terminalText.querySelector('.terminal-prompt');
          
          if (isDeleting) {
            // Deleting text
            const currentText = currentCommand.substring(0, charIndex);
            promptSpan.nextSibling.textContent = ' ' + currentText;
            charIndex--;
            typingSpeed = 30;
            
            if (charIndex < 0) {
              isDeleting = false;
              commandIndex = (commandIndex + 1) % commands.length;
              typingSpeed = 1000; // Pause before typing next command
            }
          } else {
            // Typing text
            const currentText = currentCommand.substring(0, charIndex);
            promptSpan.nextSibling.textContent = ' ' + currentText;
            charIndex++;
            typingSpeed = 100;
            
            if (charIndex > currentCommand.length) {
              isDeleting = true;
              typingSpeed = 2000; // Pause before deleting
            }
          }
          
          setTimeout(typeEffect, typingSpeed);
        }
        
        // Start the typing effect
        setTimeout(typeEffect, 1000);
      }
      
      // Navbar scroll effect
      window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar.bg-gradient-primary');
        if (window.scrollY > 10) {
          navbar.style.background = 'linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%)';
          navbar.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.3)';
        } else {
          navbar.style.background = '';
          navbar.style.boxShadow = '';
        }
      });
      
      // Glitch effect on hover for brand
      const brandText = document.querySelector('.navbar-brand .glitch');
      if (brandText) {
        brandText.addEventListener('mouseover', function() {
          this.style.animation = 'none';
          void this.offsetWidth; // Trigger reflow
          this.style.animation = 'glitch-anim-1 0.5s infinite';
        });
        
        brandText.addEventListener('mouseout', function() {
          this.style.animation = 'none';
        });
      }
      
      // Announcement ticker functionality
      const tickerItems = document.querySelectorAll('.pn-ticker-item');
      const tickerDots = document.querySelectorAll('.pn-ticker-dot');
      
      // Only run ticker code if announcements exist
      if (tickerItems.length > 0) {
        // Initialize variables
        let currentIndex = 0;
        let tickerInterval;
        
        // Function to show a specific announcement
        function showAnnouncement(index) {
          // Hide all announcements
          tickerItems.forEach(item => {
            item.style.display = 'none';
          });
          
          // Remove active class from all dots
          tickerDots.forEach(dot => {
            dot.classList.remove('active');
          });
          
          // Show the selected announcement with a fade-in effect
          tickerItems[index].style.opacity = '0';
          tickerItems[index].style.display = 'block';
          
          // Trigger reflow for animation
          void tickerItems[index].offsetWidth;
          
          // Fade in the announcement
          tickerItems[index].style.transition = 'opacity 0.5s ease-in-out';
          tickerItems[index].style.opacity = '1';
          
          // Add active class to the corresponding dot
          tickerDots[index].classList.add('active');
          
          // Update current index
          currentIndex = index;
        }
        
        // Function to show the next announcement
        function nextAnnouncement() {
          let nextIndex = currentIndex + 1;
          if (nextIndex >= tickerItems.length || nextIndex >= 3) {
            nextIndex = 0; // Loop back to the first announcement
          }
          showAnnouncement(nextIndex);
        }
        
        // Show the first announcement initially
        showAnnouncement(0);
        
        // Set up the interval to change announcements every 5 seconds (5000 ms)
        tickerInterval = setInterval(nextAnnouncement, 5000);
        
        // Add click event listeners to the dots for manual navigation
        tickerDots.forEach((dot, index) => {
          dot.addEventListener('click', function() {
            // Clear the existing interval
            clearInterval(tickerInterval);
            
            // Show the clicked announcement
            showAnnouncement(index);
            
            // Restart the interval
            tickerInterval = setInterval(nextAnnouncement, 5000);
          });
        });
        
        // Pause the rotation when hovering over the ticker
        const ticker = document.getElementById('announcementTicker');
        if (ticker) {
          ticker.addEventListener('mouseenter', function() {
            clearInterval(tickerInterval);
          });
          
          ticker.addEventListener('mouseleave', function() {
            // Restart the interval when mouse leaves
            clearInterval(tickerInterval);
            tickerInterval = setInterval(nextAnnouncement, 5000);
          });
        }
        
        // Add a progress indicator to show time until next announcement
        const tickerContainer = document.querySelector('.pn-ticker');
        if (tickerContainer) {
          // Create progress bar element
          const progressBar = document.createElement('div');
          progressBar.className = 'announcement-progress';
          progressBar.style.cssText = `
            width: 0%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            position: absolute;
            bottom: 0;
            left: 0;
            transition: width 1s linear;
            border-radius: 0 3px 3px 0;
          `;
          
          // Add progress bar to ticker container
          tickerContainer.style.position = 'relative';
          tickerContainer.appendChild(progressBar);
          
          // Function to animate progress bar
          function animateProgressBar() {
            progressBar.style.width = '0%';
            
            // Animate to 100% over 5 seconds
            setTimeout(() => {
              progressBar.style.transition = 'width 5s linear';
              progressBar.style.width = '100%';
            }, 50);
          }
          
          // Start progress bar animation
          animateProgressBar();
          
          // Reset and restart progress bar when announcement changes
          setInterval(animateProgressBar, 5000);
          
          // Reset progress bar when manually changing announcements
          tickerDots.forEach(dot => {
            dot.addEventListener('click', animateProgressBar);
          });
        }
      }
    });
    
    // Function to create a floating particle
    function createParticle(container) {
      if (!container) return;
      
      const particle = document.createElement('span');
      particle.classList.add('particle');
      
      // Random size between 1-3px
      const size = Math.random() * 2 + 1;
      particle.style.width = `${size}px`;
      particle.style.height = `${size}px`;
      
      // Random position
      const posX = Math.random() * 100;
      const posY = Math.random() * 100;
      particle.style.left = `${posX}%`;
      particle.style.top = `${posY}%`;
      
      // Random opacity
      particle.style.opacity = Math.random() * 0.5;
      
      // Random animation delay
      const delay = Math.random() * 15;
      particle.style.animationDelay = `${delay}s`;
      
      // Random animation duration
      const duration = Math.random() * 10 + 10;
      particle.style.animationDuration = `${duration}s`;
      
      container.appendChild(particle);
    }
  </script>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <?php require_once './css-js.php';?>

  

<script>
(function() {
  // Create a list of known ad blocker indicators
  const adBlockerIndicators = [
    // Common ad blocker domains
    'dns.adguard.com',
    'adblock.dns.yandex.net',
    'dns-family.adguard.com',
    'adblock.dns.yandex.ru',
    'dns.adguard-dns.com',
    'blockads.fivefilters.org',
    'adaway.org',
    'adblock.mahakala.is',
    'adblock-nocoin-list',
    'easylist.to',
    'fanboy.co.nz',
    'malwaredomains.lehigh.edu',
    'someonewhocares.org',
    'winhelp2002.mvps.org',
    'zeustracker.abuse.ch',
    'dshield.org',
    'malwaredomainlist.com',
    'hosts-file.net',
    'pgl.yoyo.org',
    'ransomwaretracker.abuse.ch',
    'blocklist.site',
    'hostsfile.org',
    'www.malwaredomainlist.com',
    'www.hostsfile.org',
    'www.joewein.net',
    'spam404.com',
    'adblock.gjtech.net',
    'hostsfile.mine.nu',
    'hosts-file.malwareteks.com',
    'www.hosts-file.net',
    // Common ad blocker extensions and patterns
    'ublock',
    'adblock',
    'adguard',
    'ghostery',
    'privacy badger',
    'disconnect',
    'blockadblock',
    'adblockplus',
    'adblock ultimate',
    'adblock pro',
    'adaway',
    'blokada',
    'blockada',
    'pihole',
    'pi-hole',
    'privoxy',
    'noscript',
    'scriptsafe',
    'adshield',
    'adtrap',
    'ad muncher',
    'ad-blocker',
    'adblocker',
    'ad-block',
    'adremover',
    'ad remover',
    'adkiller',
    'ad killer'
  ];

  // Add 450+ more patterns to reach over 500 total
  // Common ad network domains that might be blocked
  const adNetworks = [
    'doubleclick.net', 'googlesyndication.com', 'google-analytics.com', 'googleadservices.com',
    'googletagmanager.com', 'googletagservices.com', 'scorecardresearch.com', 'amazon-adsystem.com',
    'advertising.com', 'adnxs.com', 'openx.net', 'rubiconproject.com', 'pubmatic.com', 'casalemedia.com',
    'smartadserver.com', 'criteo.com', 'criteo.net', 'facebook.net', 'moatads.com', 'taboola.com',
    'outbrain.com', 'adtechus.com', 'bluekai.com', 'adsrvr.org', 'demdex.net', 'rlcdn.com', 'adsafeprotected.com',
    'adform.net', 'mathtag.com', 'bidswitch.net', 'adition.com', 'omtrdc.net', 'mookie1.com', 'exelator.com',
    'nexac.com', 'quantserve.com', 'contextweb.com', 'sharethrough.com', 'triplelift.com', 'teads.tv',
    'lijit.com', 'gumgum.com', 'vi.ai', 'flashtalking.com', 'innovid.com', 'fwmrm.net', 'adsymptotic.com',
    'adelphic.com', 'adriver.ru', 'adroll.com', 'adsense.com', 'adtech.com', 'adtarget.com', 'adtegrity.com',
    'adtiger.de', 'adtoll.com', 'adultadworld.com', 'adultmoda.com', 'adversal.com', 'adverticum.net',
    'advertise.com', 'advertisespace.com', 'advertising.com', 'advertur.com', 'affinity.com', 'aimatch.com',
    'aimtell.com', 'adblade.com', 'adcash.com', 'addthis.com', 'admob.com', 'adnium.com', 'adocean.pl',
    'adpushup.com', 'adsafeprotected.com', 'adskeeper.co.uk', 'adsnative.com', 'adspirit.de', 'adsymptotic.com',
    'adtaily.com', 'adtaily.pl', 'adtegrity.net', 'adthrive.com', 'adverline.com', 'adverserve.net',
    'adyoulike.com', 'affiliatly.com', 'amazon-adsystem.com', 'amung.us', 'appnexus.com', 'atdmt.com',
    'atwola.com', 'bidvertiser.com', 'bnmla.com', 'bounceexchange.com', 'buysellads.com', 'carbonads.com',
    'cdn.at.atwola.com', 'chitika.com', 'clicksor.com', 'clkdeals.com', 'cloudfront.net', 'coinzilla.io',
    'commission-junction.com', 'cpmstar.com', 'criteo.net', 'crwdcntrl.net', 'doublepimp.com', 'ebay.com',
    'exoclick.com', 'exosrv.com', 'exponential.com', 'eyeota.net', 'fqtag.com', 'getclicky.com', 'getsitecontrol.com',
    'heias.com', 'histats.com', 'hotjar.com', 'intellitxt.com', 'intermarkets.net', 'juicyads.com', 'komoona.com',
    'krxd.net', 'linksynergy.com', 'livejasmin.com', 'lkqd.net', 'mads.com', 'mediavoice.com', 'mgid.com',
    'moatpixel.com', 'mobfox.com', 'mopub.com', 'netaffiliation.com', 'netseer.com', 'newrelic.com', 'nsaudience.pl',
    'onclasrv.com', 'onclickads.net', 'optimizely.com', 'outbrain.org', 'pagefair.com', 'pagefair.net',
    'piwik.org', 'plista.com', 'popads.net', 'popcash.net', 'popunder.com', 'propellerads.com', 'proper.io',
    'pubdirecte.com', 'pubmine.com', 'pulsepoint.com', 'pushengage.com', 'qksrv.net', 'revcontent.com',
    'revjet.com', 'rfihub.com', 'rfihub.net', 'rhythmone.com', 'rlcdn.com', 'rtmark.net', 'sitemeter.com',
    'skimresources.com', 'smaato.net', 'smartadserver.com', 'smartclip.net', 'sonobi.com', 'sovrn.com',
    'specificclick.net', 'spotxchange.com', 'stackadapt.com', 'statcounter.com', 'stickyadstv.com',
    'stormiq.com', 'sumome.com', 'tapad.com', 'tapjoy.com', 'trafficjunky.net', 'tremorhub.com',
    'tribalfusion.com', 'tynt.com', 'undertone.com', 'unrulymedia.com', 'vibrantmedia.com', 'viglink.com',
    'visualwebsiteoptimizer.com', 'xiti.com', 'yieldlab.net', 'yieldmanager.com', 'yieldmanager.net',
    'yieldmo.com', 'yieldoptimizer.com', 'zedo.com', 'zemanta.com', 'zergnet.com', 'zorosrv.com',
    'zqtk.net'
  ];

  // Add all ad networks to the indicators list
  adBlockerIndicators.push(...adNetworks);

  // Add common ad blocker CSS selectors and element IDs
  const adBlockerSelectors = [
    '#ad-block-notice', '#ad-blocker-notice', '#adblock-notice', '#adblock-warning',
    '#adblock-popup', '#adblock-overlay', '#adblock-message', '#adblock-info',
    '#adblock-detect', '#adblock-detector', '#adblock-alert', '#adblock-notification',
    '#ad-block-modal', '#ad-blocker-modal', '#adblock-modal', '#adblock-warning-modal',
    '.ad-block-notice', '.ad-blocker-notice', '.adblock-notice', '.adblock-warning',
    '.adblock-popup', '.adblock-overlay', '.adblock-message', '.adblock-info',
    '.adblock-detect', '.adblock-detector', '.adblock-alert', '.adblock-notification',
    '.ad-block-modal', '.ad-blocker-modal', '.adblock-modal', '.adblock-warning-modal',
    '#adsense', '#banner-ad', '#sponsored-ad', '#top-ad', '#side-ad', '#bottom-ad',
    '#footer-ad', '#header-ad', '#ad-container', '#ad-wrapper', '#ad-frame',
    '.adsense', '.banner-ad', '.sponsored-ad', '.top-ad', '.side-ad', '.bottom-ad',
    '.footer-ad', '.header-ad', '.ad-container', '.ad-wrapper', '.ad-frame',
    'div[id*="google_ads"]', 'div[id*="ad-"]', 'div[id*="ad_"]', 'div[id*="ads-"]',
    'div[id*="ads_"]', 'div[class*="google_ads"]', 'div[class*="ad-"]', 'div[class*="ad_"]',
    'div[class*="ads-"]', 'div[class*="ads_"]', 'iframe[id*="google_ads"]', 'iframe[id*="ad-"]',
    'iframe[id*="ad_"]', 'iframe[id*="ads-"]', 'iframe[id*="ads_"]', 'iframe[src*="ad"]',
    'iframe[src*="ads"]', 'img[src*="ad"]', 'img[src*="ads"]', 'a[href*="adclick"]',
    'a[href*="adsclick"]', 'script[src*="ad"]', 'script[src*="ads"]'
  ];

  // Add all selectors to the indicators list
  adBlockerIndicators.push(...adBlockerSelectors);

  // Function to check if an ad blocker is active
  function detectAdBlocker() {
    return new Promise((resolve) => {
      // Create a bait element
      const bait = document.createElement('div');
      bait.setAttribute('class', 'ads ad adsbox doubleclick ad-placement carbon-ads');
      bait.setAttribute('id', 'ads-test-element');
      bait.innerHTML = '&nbsp;';
      bait.style.position = 'absolute';
      bait.style.left = '-999px';
      bait.style.top = '-999px';
      bait.style.height = '1px';
      bait.style.width = '1px';
      document.body.appendChild(bait);

      // Check if the bait element is hidden
      setTimeout(() => {
        let adBlockDetected = false;
        
        // Check if the bait element is hidden or removed
        if (bait.offsetHeight === 0 || 
            bait.offsetWidth === 0 || 
            bait.clientHeight === 0 || 
            bait.clientWidth === 0 || 
            !document.getElementById('ads-test-element')) {
          adBlockDetected = true;
        } else {
          // Check computed style
          const baitStyle = window.getComputedStyle(bait);
          if (baitStyle.display === 'none' || 
              baitStyle.visibility === 'hidden' || 
              baitStyle.opacity === '0') {
            adBlockDetected = true;
          }
        }

        // Check for blocked resources
        const testScript = document.createElement('script');
        testScript.src = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
        testScript.onerror = function() {
          adBlockDetected = true;
          document.body.removeChild(testScript);
          resolve(true);
        };
        testScript.onload = function() {
          document.body.removeChild(testScript);
          if (!adBlockDetected) {
            resolve(false);
          }
        };
        document.body.appendChild(testScript);

        // If we've already detected an ad blocker, resolve immediately
        if (adBlockDetected) {
          if (document.body.contains(testScript)) {
            document.body.removeChild(testScript);
          }
          resolve(true);
        }

        // Clean up the bait element
        if (document.body.contains(bait)) {
          document.body.removeChild(bait);
        }
      }, 100);
    });
  }

  // Function to create and show the ad blocker warning banner
  function showAdBlockerWarning() {
    // Create overlay
    const overlay = document.createElement('div');
    overlay.id = 'adblock-warning-overlay';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
    overlay.style.zIndex = '999999';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.flexDirection = 'column';
    overlay.style.textAlign = 'center';
    overlay.style.color = 'white';
    overlay.style.fontFamily = 'Arial, sans-serif';
    overlay.style.padding = '20px';

    // Create warning message
    const warningMessage = document.createElement('div');
    warningMessage.innerHTML = `
      <h1 style="color: #ff4d4d; font-size: 32px; margin-bottom: 20px;">Ad Blocker Detected</h1>
      <p style="font-size: 18px; line-height: 1.6; margin-bottom: 20px;">We've detected that you're using an ad blocker. Our website relies on advertising revenue to provide free content.</p>
      <p style="font-size: 18px; line-height: 1.6; margin-bottom: 30px;">Please disable your ad blocker to continue using Pinnocent.</p>
      <div style="background-color: #ff4d4d; color: white; padding: 15px 30px; font-size: 18px; font-weight: bold; border-radius: 5px; display: inline-block; margin-bottom: 20px;">I've Disabled My Ad Blocker</div>
      <p style="font-size: 16px; opacity: 0.8;">After disabling your ad blocker, please refresh the page.</p>
    `;
    overlay.appendChild(warningMessage);

    // Add the overlay to the body
    document.body.appendChild(overlay);

    // Prevent scrolling on the body
    document.body.style.overflow = 'hidden';

    // Prevent the overlay from being removed
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.removedNodes) {
          for (let i = 0; i < mutation.removedNodes.length; i++) {
            if (mutation.removedNodes[i].id === 'adblock-warning-overlay') {
              document.body.appendChild(overlay);
              document.body.style.overflow = 'hidden';
            }
          }
        }
      });
    });

    observer.observe(document.body, { childList: true });

    // Prevent keyboard shortcuts and right-click
    document.addEventListener('keydown', function(e) {
      if (e.key === 'F12' || 
          (e.ctrlKey && e.shiftKey && e.key === 'I') || 
          (e.ctrlKey && e.key === 'u')) {
        e.preventDefault();
      }
    });

    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
  }

  // Initialize the ad blocker detection when the DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAdBlockDetection);
  } else {
    initAdBlockDetection();
  }

  function initAdBlockDetection() {
    detectAdBlocker().then(isBlocked => {
      if (isBlocked) {
        showAdBlockerWarning();
      }
    });
  }
})();
 </script>
<!-- AdSense Header Code -->
<?php echo do_config(15); ?>