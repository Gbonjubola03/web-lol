    <!-- Optional Ad Container Before Footer -->
    <div class="ad-container ad-container-footer">
      <span class="ad-label">Advertisement</span>
      <?php echo do_config(17); ?>
    </div>

    <!-- FOOTER -->
    <footer class="">
      <div class="col-12 col-md-12">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
              <!-- Brand -->
              <img src="<?php echo do_config(14);?><?php echo do_config(27);?>" alt="logo" class="footer-brand img-fluid mb-2">
              
              <!-- Text -->
              <p class="text-gray-700 mb-2">
                <?php echo do_config(11); ?>
              </p>
              
              <!-- Social -->
              <ul class="list-unstyled list-inline list-social mb-6 mb-md-0">
                <?php if (!empty(do_config(2))){ ?>
                  <li class="list-inline-item list-social-item me-3">
                    <a href="<?php echo do_config(2); ?>" class="text-decoration-none">
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
            
            <div class="col-6 col-md-5 col-lg-3">
              <!-- Heading -->
              <h6 class="fw-bold text-uppercase text-gray-700">
                <?php echo _MORE;?> <?php echo _INFO;?>
              </h6>
              
              <!-- List -->
              <ul class="list-unstyled text-body-secondary mb-6 mb-md-8 mb-lg-0">
                <li class="mb-3">
                   <?php while($res=$pages->fetch_assoc()){ ?>
                    <li class="mb-3">
                    <a href="<?php echo do_config(14);?>page/<?php echo $res['link'];?>/" class="text-reset">
                      <?php echo $res['title'];?>
                    </a>
                  </li>
                  
                </li>
              </ul>
            </div>
            
           
            
        
             
            
    
    </footer>

    

    <!-- AdSense-friendly CSS -->
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
        min-height: 90px;
        width: 100%;
        background-color: transparent;
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
      
      /* Footer styling */
      footer {
        padding: 3rem 0;
        background-color: #f8f9fa;
        margin-top: 2rem;
      }
      
      footer .footer-brand {
        max-height: 60px;
        margin-bottom: 1rem;
      }
      
      footer h6 {
        font-size: 0.875rem;
        letter-spacing: 0.08em;
        margin-bottom: 1.25rem;
      }
      
      footer .text-gray-700 {
        color: #495057;
      }
      
      footer .text-body-secondary {
        color: #6c757d;
      }
      
      footer a.text-reset {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s ease;
      }
      
      footer a.text-reset:hover {
        color: #0d6efd;
        text-decoration: none;
      }
      
      footer .list-social-item a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: rgba(108, 117, 125, 0.1);
        transition: all 0.2s ease;
      }
      
      footer .list-social-item a:hover {
        background-color: rgba(13, 110, 253, 0.1);
      }
    </style>

    <!-- AdSense-friendly script - avoid blocking ads -->
    <script>
      // Ensure ads are not blocked by the site's own code
      function ensureAdsVisible() {
        // Find all ad containers
        const adContainers = document.querySelectorAll('.ad-container');
        
        // Make sure they're visible and not blocked
        adContainers.forEach(container => {
          container.style.display = 'block';
          container.style.visibility = 'visible';
          container.style.opacity = '1';
        });
      }
      
      // Run after page load
      window.addEventListener('load', ensureAdsVisible);
      
      // Run after any AJAX content loads
      document.addEventListener('DOMContentLoaded', ensureAdsVisible);
    </script>
  </body>
</html>
<?php } ?>