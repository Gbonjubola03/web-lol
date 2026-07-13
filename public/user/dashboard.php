<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
  $search_response = viewsearch();

  $search = $search_response ?: ($_SESSION['user']['search'] ?? '');
  
  if (empty($search)) {
    $search = "<div class='alert alert-danger'>search data could not be loaded. Please try again later.</div>";
  }
?>

<?php 

  echo $search; 
?>



<style>
  /* Article Ticker Styles - Based on Announcement Styles */
  .article-feed {
    margin: 20px 0;
    font-family: 'Poppins', sans-serif;
  }
  
  .article-ticker {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;
    border: 1px solid rgba(230, 230, 250, 0.7);
  }
  
  .article-ticker:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  }
  
  .article-ticker::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(to bottom, #4f46e5, #6366f1);
    border-radius: 3px 0 0 3px;
  }
  
  .article-ticker-header {
    display: flex;
    align-items: center;
    padding: 18px 24px;
    border-bottom: 1px solid rgba(230, 230, 250, 0.5);
    position: relative;
    z-index: 1;
  }
  
  .article-ticker-icon {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
  }
  
  .article-ticker-icon i {
    color: white;
    font-size: 18px;
    animation: pulse 2s infinite;
  }
  
  .article-ticker-info {
    flex: 1;
  }
  
  .article-ticker-title {
    font-weight: 700;
    font-size: 18px;
    color: #2d3748;
    margin-bottom: 4px;
    letter-spacing: -0.3px;
  }
  
  .article-ticker-subtitle {
    font-size: 13px;
    color: #718096;
    font-weight: 400;
  }
  
  .article-ticker-content {
    padding: 20px 24px;
    position: relative;
    min-height: 120px;
  }
  
  .article-ticker-items {
    position: relative;
  }
  
  .article-ticker-item {
    display: none;
    animation: fadeIn 0.5s ease-in-out;
    padding: 5px 0;
  }
  
  .article-ticker-item img {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
  }
  
  .article-ticker-item:hover img {
    transform: scale(1.05);
  }
  
  .article-link {
    display: inline-flex;
    align-items: center;
    color: #4f46e5;
    font-weight: 600;
    font-size: 13px;
    margin-top: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: rgba(79, 70, 229, 0.1);
    padding: 5px 12px;
    border-radius: 20px;
  }
  
  .article-link:hover {
    background: rgba(79, 70, 229, 0.2);
    color: #4338ca;
    transform: translateX(3px);
    text-decoration: none;
  }
  
  .article-link-icon {
    margin-left: 6px;
    font-size: 10px;
    transition: transform 0.3s ease;
  }
  
  .article-link:hover .article-link-icon {
    transform: translateX(3px);
  }
  
  .article-ticker-dots {
    display: flex;
    justify-content: center;
    margin-top: 15px;
    padding-bottom: 15px;
  }
  
  .article-ticker-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #e2e8f0;
    margin: 0 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
  }
  
  .article-ticker-dot:hover {
    background-color: #cbd5e0;
    transform: scale(1.2);
  }
  
  .article-ticker-dot.active {
    background-color: #4f46e5;
    transform: scale(1.2);
  }
  
  .article-ticker-dot.active::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid rgba(79, 70, 229, 0.3);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: ripple 1.5s infinite;
  }
  
  .article-progress {
    z-index: 2;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
  }
  
  /* Custom styling for article content */
  .article-ticker-item-title {
    color: #2d3748;
    font-size: 16px;
    line-height: 1.4;
    font-weight: 600;
    transition: color 0.3s ease;
  }
  
  .article-ticker-item:hover .article-ticker-item-title {
    color: #4f46e5;
  }
  
  .article-ticker-item-excerpt {
    line-height: 1.5;
    margin: 6px 0;
    color: #4a5568;
    font-size: 0.9rem;
  }
  
  /* Media queries for responsiveness */
  @media (max-width: 768px) {
    .article-ticker-header {
      padding: 15px 18px;
    }
    
    .article-ticker-content {
      padding: 15px 18px;
    }
    
    .article-ticker-title {
      font-size: 16px;
    }
    
    .article-ticker-icon {
      width: 36px;
      height: 36px;
    }
  }
</style>

<!-- Articles Ticker -->
<div class="article-feed">
  <?php 
  // Query to get latest articles
  $ticker_articles = $query->normal("SELECT * FROM articles WHERE status='1' ORDER BY id DESC LIMIT 5");
  
  if($ticker_articles->num_rows > 0){ 
  ?>
  <div class="article-ticker">
    <div class="article-ticker-header">
      <div class="article-ticker-icon">
        <i class="fa fa-newspaper-o"></i>
      </div>
      <div class="article-ticker-info">
        <div class="article-ticker-title">Latest Articles</div>
        <div class="article-ticker-subtitle">Stay informed with our newest content</div>
      </div>
    </div>
    
    <div class="article-ticker-content" id="articleTicker">
      <div class="article-ticker-items" id="articleTickerItems">
        <?php
        $ticker_articles->data_seek(0);
        $slideIndex = 0;
        while($res = $ticker_articles->fetch_assoc()){
          $slideIndex++;
          // Only show first 5 articles
          if($slideIndex > 5) break;
          
          // Get a snippet of the content
          $content_snippet = substr(strip_tags($res['content']), 0, 100) . '...';
        ?>
          <div class="article-ticker-item" data-index="<?php echo $slideIndex; ?>">
            <div style="display: flex; align-items: center; width: 100%;">
              <?php if($res['preview'] != NULL){ ?>
                <img src="<?php echo $res['preview'];?>" alt="<?php echo htmlspecialchars($res['title']);?>" style="width: 80px; height: 80px; border-radius: 8px; margin-right: 12px; object-fit: cover;" onerror="this.style.display='none';">
              <?php } else { ?>
                <div style="width: 80px; height: 80px; border-radius: 8px; margin-right: 12px; background-color: #4f46e5; display: flex; align-items: center; justify-content: center; color: white;">
                  <i class="fa fa-newspaper-o fa-lg"></i>
                </div>
              <?php } ?>
              <div>
                <div class="article-ticker-item-title"><?php echo htmlspecialchars($res['title']);?></div>
                <div class="article-ticker-item-excerpt"><?php echo $content_snippet;?></div>
                <a href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>/" class="article-link">
                  READ MORE<i class="fa fa-chevron-right article-link-icon"></i>
                </a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    
    <div class="article-ticker-dots" id="articleTickerDots">
      <?php for($i = 1; $i <= min($slideIndex, 5); $i++) { ?>
        <div class="article-ticker-dot <?php echo ($i == 1) ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</div>

<!-- Add this JavaScript code before the closing </body> tag or in your ajax.js.php file -->
<script>
// Article ticker function that changes every 5 seconds
document.addEventListener('DOMContentLoaded', function() {
  // Get all ticker items and dots
  const articleTickerItems = document.querySelectorAll('.article-ticker-item');
  const articleTickerDots = document.querySelectorAll('.article-ticker-dot');
  
  // If no articles, exit
  if (articleTickerItems.length === 0) return;
  
  // Initialize variables
  let currentArticleIndex = 0;
  let articleTickerInterval;
  
  // Function to show a specific article
  function showArticle(index) {
    // Hide all articles
    articleTickerItems.forEach(item => {
      item.style.display = 'none';
    });
    
    // Remove active class from all dots
    articleTickerDots.forEach(dot => {
      dot.classList.remove('active');
    });
    
    // Show the selected article with a fade-in effect
    articleTickerItems[index].style.opacity = '0';
    articleTickerItems[index].style.display = 'block';
    
    // Trigger reflow for animation
    void articleTickerItems[index].offsetWidth;
    
    // Fade in the article
    articleTickerItems[index].style.transition = 'opacity 0.5s ease-in-out';
    articleTickerItems[index].style.opacity = '1';
    
    // Add active class to the corresponding dot
    articleTickerDots[index].classList.add('active');
    
    // Update current index
    currentArticleIndex = index;
  }
  
  // Function to show the next article
  function nextArticle() {
    let nextIndex = currentArticleIndex + 1;
    if (nextIndex >= articleTickerItems.length) {
      nextIndex = 0; // Loop back to the first article
    }
    showArticle(nextIndex);
  }
  
  // Show the first article initially
  showArticle(0);
  
  // Set up the interval to change articles every 5 seconds (5000 ms)
  articleTickerInterval = setInterval(nextArticle, 5000);
  
  // Add click event listeners to the dots for manual navigation
  articleTickerDots.forEach((dot, index) => {
    dot.addEventListener('click', function() {
      // Clear the existing interval
      clearInterval(articleTickerInterval);
      
      // Show the clicked article
      showArticle(index);
      
      // Restart the interval
      articleTickerInterval = setInterval(nextArticle, 5000);
    });
  });
  
  // Pause the rotation when hovering over the ticker
  const articleTicker = document.getElementById('articleTicker');
  if (articleTicker) {
    articleTicker.addEventListener('mouseenter', function() {
      clearInterval(articleTickerInterval);
    });
    
    articleTicker.addEventListener('mouseleave', function() {
      // Restart the interval when mouse leaves
      clearInterval(articleTickerInterval);
      articleTickerInterval = setInterval(nextArticle, 5000);
    });
  }
  
  // Add a progress indicator to show time until next article
  const articleTickerContainer = document.querySelector('.article-ticker-content');
  if (articleTickerContainer) {
    // Create progress bar element
    const progressBar = document.createElement('div');
    progressBar.className = 'article-progress';
    progressBar.style.cssText = `
      width: 0%;
      height: 3px;
      background: linear-gradient(to right, #4f46e5, #6366f1);
      position: absolute;
      bottom: 0;
      left: 0;
      transition: width 1s linear;
      border-radius: 0 3px 3px 0;
    `;
    
    // Add progress bar to ticker container
    articleTickerContainer.style.position = 'relative';
    articleTickerContainer.appendChild(progressBar);
    
    // Function to animate progress bar
    function animateArticleProgressBar() {
      progressBar.style.width = '0%';
      
      // Animate to 100% over 5 seconds
      setTimeout(() => {
        progressBar.style.transition = 'width 5s linear';
        progressBar.style.width = '100%';
      }, 50);
    }
    
    // Start progress bar animation
    animateArticleProgressBar();
    
    // Reset and restart progress bar when article changes
    setInterval(animateArticleProgressBar, 5000);
    
         // Reset progress bar when manually changing articles
      articleTickerDots.forEach(dot => {
        dot.addEventListener('click', animateArticleProgressBar);
      });
    }
  }
);
</script>
<?php
  $dashboard = viewdashboard($member->user_id) ?: $_SESSION['user']['dashboard'];
?>

<?php do_winfo('DASHBOARD'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'dashboard');
} ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   
 <!-- Optional Header Ad Container -->
<div class="ad-container ad-container-header">
  <span class="ad-label">Advertisement</span>
  <?php echo do_config(17); ?>
</div>
   
   <?php echo $dashboard; ?>
   
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
