<?php require_once ("preload.php"); ?>
<?php do_winfo('SIGN_IN'); ?>
<?php require_once (dirname(__FILE__)).'/incs/account.php';?>
    <!-- Title -->
    <title><?php echo SITE_TITLE;?> <?php echo do_config(8);?> <?php echo do_config(1);?> </title>
    <!-- CONTENT -->
    <section>
      <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center gx-0 min-vh-100">
          <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">

            <!-- Heading -->
            <h1 class="mb-0 fw-bold text-uppercase">
              <i class="fa fa-arrow-right"></i> <?php echo SITE_TITLE;?>
            </h1>

            <!-- Text -->
            <p class="mb-6 text-body-secondary">
              SIGN IN TO YOUR ACCOUNT
            </p>
            <!-- ALERTS RESPONSE HERE-->
            <span id="signin-response" class="text-uppercase"></span>
            <!-- ALERTS RESPONSE END HERE -->
            
            <!-- Form -->
            <form class="mb-6" id="signin_form" autocomplete="off" method="POST">
                                              <input type="hidden" name="signin" value="signin"/>
                                              <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                                              <input autocomplete="false" name="hidden" type="text" style="display:none;">
							    
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="last" class="color-black"><?php echo _USERNAME;?> *</label>
                                                    <input type="text" name="username" class="form-control" autocomplete="disabled" placeholder="<?php echo _USERNAME;?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="last" class="color-black"><?php echo _PASSWORD;?> *</label>
                                                    <input type="password" name="password"  required="" placeholder="<?php echo _PASSWORD;?>" class="form-control" autocomplete>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button onclick="signinForm();" id="signin-button" class="btn btn-primary btn-btx wd-shop-btn text-uppercase">
                                                    <span id="icon-signin-button"><i class="fa fa-chevron-circle-right"></i></span>
                                                    <span id="button-signin-loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
                                                    <?php echo _SIGN_IN;?>
                                                    </button>
                                            </div>

                                            </div><hr>
              <div class="wd-policy">
                  <p>FORGOT
                  <a href="<?php echo do_config(14);?>forgot-password" class="black-color">
                      <strong><small>PASSWORD?</small></strong>
                  </a>
                  </p>
              </div>
                                         <hr>
                                            <div class="wd-policy text-uppercase">
                                              <p><?php echo _NO_ACCOUNT;?>
                                                <a href="<?php echo do_config(14);?>signup" class="black-color">
                                                    <strong><u><?php echo _SIGN_UP;?></u></strong>
                                                </a>
                                              </p>
                                            </div>
                                    
            </form>

          </div>
          <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

            <!-- Image -->
            <div class="h-100 w-cover bg-cover" style="background-image: url(https://landkit.goodthemes.co/assets/img/covers/cover-14.jpg);"></div>

            <!-- Shape -->
            <div class="shape shape-start shape-fluid-y text-white"></div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
    
    <?php require_once 'ajax.js.php';?>

    <!-- JAVASCRIPT -->
    <script src="<?php echo do_config(14);?>assets/custom/js/jquery.min.js"></script>
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="https://landkit.goodthemes.co/assets/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="https://landkit.goodthemes.co/assets/js/theme.bundle.js"></script>
  </body>
</html>