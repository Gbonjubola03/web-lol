<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once (dirname(dirname(__FILE__)).'/incs/account.php');?>
    <title><?php echo _ERROR_404; ?>  <?php echo do_config(8); ?> <?php echo do_config(1); ?></title>
    <!-- CONTENT -->
    <section class="section-border border-primary">
      <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center gx-0 min-vh-100">
          <div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">

            <!-- Image -->

          </div>
          <div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
            
            <!-- Heading -->
            <h1 class="display-3 fw-bold text-center">
              <?php echo _ERROR_404; ?>!
            </h1>

            <!-- Text -->
            <p class="mb-5 text-center text-body-secondary">
              <i class="fa fa-times"></i> <?php echo _ERROR_404; ?> <?php echo __ERROR_404; ?>
            </p>

            <!-- Link -->
            <div class="text-center">
                <a class="btn btn-primary" href="<?php echo do_config(14); ?>">
                    <i class="fa fa-arrow-left"></i> <?php echo _GO_BACK; ?>
                </a>
            </div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
  
    <!-- JAVASCRIPT -->
    <script src="<?php echo do_config(14);?>assets/custom/js/jquery.min.js"></script>
    <!-- Map JS -->
    <script src='<?php echo do_config(14);?>assets/theme/js/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="<?php echo do_config(14);?>assets/theme/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="<?php echo do_config(14);?>assets/theme/js/theme.bundle.js"></script>
  </body>
</html>