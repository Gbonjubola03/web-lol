<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>
<?php

?>
    <?php do_winfo('START SELLING'); ?>

    <!-- Title -->
    <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?> </title>
  <!-- WELCOME -->
    <section class="pt-4 pt-md-11">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-5 order-md-2">

            <!-- Image -->
            <img src="https://landkit.goodthemes.co/assets/img/illustrations/illustration-1.png" class="img-fluid mb-6 mb-md-0" alt="...">

          </div>
          <div class="col-12 col-md-7 order-md-1">

            <!-- Heading -->
            <h1 class="display-4">
             <b class=" text-uppercase">Become a Seller</b> <br>
              <span class="text-primary">Start making money by selling your accounts</span>
            </h1>

            <!-- Text -->
            <p class="lead text-body-secondary mb-0">
              All the tools you’ll need to manage your accounts and services.
            </p>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>

    <!-- ARTICLES -->
    <section class="pb-8 pt-7 pb-md-11 pt-md-10">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12 d-flex">

            <!-- Card -->
            <div class="card pt-14 bg-cover overlay overlay-primary overlay-80 text-white shadow-light-lg mb-6" style="background-image: url(https://landkit.goodthemes.co/assets/img/covers/cover-17.jpg);">

              <!-- Badge -->
              <span class="badge rounded-pill text-bg-light badge-float badge-float-inside">
                <span class="h6 text-uppercase">SELLER</span>
              </span>

              <!-- Body -->
              <a class="card-body mt-auto" href="#!">

                <!-- Heading -->
                <h3 class="mt-auto text-uppercase">
                  SELL YOUR ACCOUNTS THE EASY WAY!
                </h3>

                <!-- Text -->
                <p class="mb-0 text-white text-opacity-80">
                  SELLING YOUR SOCIAL ACCOUNTS AND PAGES NEVER BEEN EASY, START TODAY WITH US! <br>
                  NO FEES WILL BE CHARGED
                </p>

              </a>

              <!-- Meta -->
              <a class="card-meta" href="#!">

                <!-- Divider -->
                <hr class="card-meta-divider text-white text-opacity-20">

                <!-- Avatar -->
                <div class="avatar avatar-sm me-2">
                  <img src="<?php echo do_config(14); ?>assets/img/avatar.jpg" alt="..." class="avatar-img rounded-circle">
                </div>

                <!-- Author -->
                <h6 class="text-uppercase text-white text-opacity-80 me-2 mb-0">
                  ADMIN
                </h6>

                <!-- Date -->
                <p class="h6 text-uppercase text-white text-opacity-80 mb-0 ms-auto">
                  <time datetime="2019-05-02">HAPPY EARNINGS!</time>
                </p>

              </a>

            </div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
    <?php if($member->type != 'seller'){ ?>
    <div class="col-md-12 text-center">
		        <form id="becomeseller_form" autocomplete="false" method="POST">
		            <input type="hidden" name="csrfToken" value="<?php echo csrf_token();?>" />
		            <input type="hidden" name="becomeseller" value="becomeseller" />
		            <input autocomplete="false" name="hidden" type="text" style="display:none;">
		            
					<div class="col-md-12">
					    <button onclick="becomesellerForm();" id="becomeseller-button" class="btn btn-warning text-uppercase">
					        <span id="icon-button"><i class="fa fa-user-plus"></i></span>
					        <span id="button-loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
					        BECOME SELLER
					    </button> 
					 </div>
				</form><br>
				<!-- ALERTS RESPONSE HERE-->
				<span id="becomeseller-response" class="text-uppercase"></span>
				<!-- ALERTS RESPONSE END HERE -->
    </div>
    <?php } ?>
    <!-- SHAPE -->
    <div class="position-relative">
      <div class="shape shape-bottom shape-fluid-x text-gray-200">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"/></svg>      </div>
    </div>
    
<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>