<?php 
   if(!logged){
    header("Location: ".do_config(14).'signin');
    exit;
}


?>
<?php

$articles = $query->limit('articles','*','id','desc','0,9','i',1,'status=?');
$announcements = $query->limit('announcements','*','id','desc','0,9','i',1,'status=?');
  $header_response = viewheader($member->user_id) ?: $_SESSION['user']['header'];
  

  $header_data = json_decode($header_response);
  

  if ($header_data && isset($header_data->status) && $header_data->status === "success") {
    // Extract the message content
    $header_content = $header_data->message;
  } else {
   
    $header_content = '<div class="alert alert-warning">Could not load header content</div>';
    if(!logged){
      header("Location: ".do_config(14).'signin');
      exit;
 }
      
 
  }
?>



<?php echo $header_content; ?>

<a class="navbar-brand" href="<?php echo do_config(14);?>">
          <img src="<?php echo do_config(14);?><?php echo do_config(85);?>" class="navbar-brand-img" alt="logo" height="60" width="220" onerror="this.style.display='none';">
        </a>


        <style>
  /* Modern Announcement Styles */
  .pn-feed {
    margin: 20px 0;
    font-family: 'Poppins', sans-serif;
  }
  
  .pn-announcement {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;
    border: 1px solid rgba(230, 230, 250, 0.7);
  }
  
  .pn-announcement:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  }
  
  .pn-announcement::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(to bottom, #6c5ce7, #00b894);
    border-radius: 3px 0 0 3px;
  }
  
  .pn-announcement-header {
    display: flex;
    align-items: center;
    padding: 18px 24px;
    border-bottom: 1px solid rgba(230, 230, 250, 0.5);
    position: relative;
    z-index: 1;
  }
  
  .pn-announcement-icon {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    box-shadow: 0 4px 10px rgba(108, 92, 231, 0.3);
  }
  
  .pn-announcement-icon i {
    color: white;
    font-size: 18px;
    animation: pulse 2s infinite;
  }
  
  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }
  
  .pn-announcement-info {
    flex: 1;
  }
  
  .pn-announcement-title {
    font-weight: 700;
    font-size: 18px;
    color: #2d3748;
    margin-bottom: 4px;
    letter-spacing: -0.3px;
  }
  
  .pn-announcement-time {
    font-size: 13px;
    color: #718096;
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
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
  }
  
  .pn-ticker-item:hover img {
    transform: scale(1.05);
  }
  
  .pn-announcement-link {
    display: inline-flex;
    align-items: center;
    color: #6c5ce7;
    font-weight: 600;
    font-size: 13px;
    margin-top: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: rgba(108, 92, 231, 0.1);
    padding: 5px 12px;
    border-radius: 20px;
  }
  
  .pn-announcement-link:hover {
    background: rgba(108, 92, 231, 0.2);
    color: #5344c7;
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
    background-color: #e2e8f0;
    margin: 0 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
  }
  
  .pn-ticker-dot:hover {
    background-color: #cbd5e0;
    transform: scale(1.2);
  }
  
  .pn-ticker-dot.active {
    background-color: #6c5ce7;
    transform: scale(1.2);
  }
  
  .pn-ticker-dot.active::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid rgba(108, 92, 231, 0.3);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: ripple 1.5s infinite;
  }
  
  @keyframes ripple {
    0% { width: 8px; height: 8px; opacity: 1; }
    100% { width: 24px; height: 24px; opacity: 0; }
  }
  
  .announcement-progress {
    z-index: 2;
    box-shadow: 0 2px 8px rgba(108, 92, 231, 0.3);
  }
  
  /* Custom styling for the announcement content */
  .pn-ticker-item div:nth-child(2) div:first-child {
    color: #2d3748;
    font-size: 16px;
    line-height: 1.4;
    transition: color 0.3s ease;
  }
  
  .pn-ticker-item:hover div:nth-child(2) div:first-child {
    color: #6c5ce7;
  }
  
  .pn-ticker-item div:nth-child(2) div:nth-child(2) {
    line-height: 1.5;
    margin: 6px 0;
    color: #4a5568;
  }
  
  /* Fallback icon container */
  .pn-ticker-item div[style*="background-color: var(--pn-blue)"] {
    background: linear-gradient(135deg, #6c5ce7, #00b894) !important;
    box-shadow: 0 6px 15px rgba(108, 92, 231, 0.3);
    transition: transform 0.3s ease;
  }
  
  .pn-ticker-item:hover div[style*="background-color: var(--pn-blue)"] {
    transform: rotate(10deg);
  }
  
  /* Media queries for responsiveness */
  @media (max-width: 768px) {
    .pn-announcement-header {
      padding: 15px 18px;
    }
    
    .pn-ticker {
      padding: 15px 18px;
    }
    
    .pn-announcement-title {
      font-size: 16px;
    }
    
    .pn-announcement-icon {
      width: 36px;
      height: 36px;
    }
  }
</style>

<!-- Main Feed -->
<div class="pn-feed">
  <!-- Announcements Ticker -->
  <?php if($announcements->num_rows > 0){ ?>
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
                <?php if($res['preview'] != NULL){ ?>
                  <img src="<?php echo $res['preview'];?>" alt="<?php echo htmlspecialchars($res['title']);?>" style="width: 60px; height: 60px; border-radius: 8px; margin-right: 12px; object-fit: cover;" onerror="this.style.display='none';">
                <?php } else { ?>
                  <div style="width: 60px; height: 60px; border-radius: 8px; margin-right: 12px; background-color: var(--pn-blue); display: flex; align-items: center; justify-content: center; color: white;">
                    <i class="fa fa-bullhorn fa-lg"></i>
                  </div>
                <?php } ?>
                <div>
                  <div style="font-weight: 600; margin-bottom: 4px;"><?php echo htmlspecialchars($res['title']);?></div>
                  <div style="font-size: 0.9rem; color: var(--pn-dark-gray);"><?php echo substr(strip_tags($res['content']), 0, 80);?>...</div>
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
  <?php } ?>
</div>

<!-- Add this JavaScript code before the closing </body> tag or in your ajax.js.php file -->
<script>
// Announcement ticker function that changes every 5 seconds and shows only 3 announcements
document.addEventListener('DOMContentLoaded', function() {
  // Get all ticker items and dots
  const tickerItems = document.querySelectorAll('.pn-ticker-item');
  const tickerDots = document.querySelectorAll('.pn-ticker-dot');
  
  // If no announcements, exit
  if (tickerItems.length === 0) return;
  
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
      background: linear-gradient(to right, #6c5ce7, #00b894);
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
});
</script>



          
            </div>
          </div>
          
          <div class="pn-ticker-dots" id="tickerDots">
            <?php for($i = 1; $i <= $slideIndex; $i++) { ?>
              <div class="pn-ticker-dot <?php echo ($i == 1) ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></div>
            <?php } ?>
          </div>
        </div>
    

        <?php require_once '../css-js.php';?>

        <?php
  $premium_content = viewpremium($member->user_id) ?: $_SESSION['user']['premium'];
?>



<!-- Optional Header Ad Container -->
<div class="ad-container ad-container-header">
  <span class="ad-label">Advertisement</span>
  <?php echo do_config(17); ?>
</div>

<?php echo $premium_content; ?>
