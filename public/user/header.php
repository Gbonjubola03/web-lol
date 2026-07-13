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
          <img src="<?php echo do_config(14);?><?php echo do_config(27);?>" class="navbar-brand-img" alt="logo" height="60" width="220" onerror="this.style.display='none';">
        </a>



<style>
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
    color: #888;
    margin-bottom: 5px;
    font-family: Arial, sans-serif;
  }

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

<?php require_once '../css-js.php';?>


</body>
</html>

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

