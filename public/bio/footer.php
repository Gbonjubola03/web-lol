    <!-- FOOTER -->
    <footer class="py-8 py-md-11 bg-gray-200">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4 col-lg-3">
    
            <!-- Brand -->
            <img src="<?php echo do_config(14);?><?php echo do_config(85);?>" alt="logo" class="footer-brand img-fluid mb-2">
    
            <!-- Text -->
            <p class="text-gray-700 mb-2">
              <?php echo do_config(1); ?>
            </p>
    
            <!-- Social -->
            <ul class="list-unstyled list-inline list-social mb-6 mb-md-0">
            <?php if (!empty(do_config(58))){ ?>
              <li class="list-inline-item list-social-item me-3">
                <a href="<?php echo do_config(58); ?>" class="text-decoration-none">
                  <img src="https://landkit.goodthemes.co//assets/img/icons/social/facebook.svg" class="list-social-icon" alt="...">
                </a>
              </li>
            <?php } ?>
            <?php if (!empty(do_config(60))){ ?>
              <li class="list-inline-item list-social-item me-3">
                <a href="<?php echo do_config(60); ?>" class="text-decoration-none">
                  <img src="https://landkit.goodthemes.co//assets/img/icons/social/twitter.svg" class="list-social-icon" alt="...">
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
                  <a href="<?php echo do_config(14);?>page/about-us/" class="text-reset"> ABOUT US</a>
              </li>
              <li class="mb-3">
                  <a href="<?php echo do_config(14);?>page/faqs/" class="text-reset"> FAQS</a>
              </li>
            </ul>
    
          </div>
          <div class="col-6 col-md-5 col-lg-3">
    
            <!-- Heading -->
            <h6 class="fw-bold text-uppercase text-gray-700">
              <?php echo _HELP;?> &amp; <?php echo _SUPPORT;?>
            </h6>
    
            <!-- List -->
            <ul class="list-unstyled text-body-secondary mb-6 mb-md-8 mb-lg-0">
              <li class="mb-3">
                  <a href="<?php echo do_config(14);?>page/privacy-policy/" class="text-reset">
                      <?php echo _PRIVACY_POLICY;?>
                  </a>
              </li>
              <li class="mb-3">
                  <a href="<?php echo do_config(14);?>page/terms-conditions/" class="text-reset">
                      <?php echo _TERMS_CONDITIONS;?>
                  </a>
              </li>
            </ul>
    
          </div>
          <div class="col-6 col-md-5 col-lg-3">
    
            
    
          </div>

        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </footer>

    <!-- JAVASCRIPT -->
    <script src="<?php echo do_config(14);?>assets/custom/js/jquery.min.js"></script>
    <script src="<?php echo do_config(14);?>assets/custom/js/jquery-ui.js"></script>
    <script src="<?php echo do_config(14);?>assets/custom/js/popper.js"></script>
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="<?php echo do_config(14);?>assets/landkit/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="<?php echo do_config(14);?>assets/landkit/js/theme.bundle.js"></script>
  </body>
</html>