<?php
    if (!defined('eu_active')) {
      define('eu_active','dashboard');
    }
?>

    <!-- HEADER -->
    <header class="bg-dark pt-9 pb-11 d-none d-md-block">
      <div class="container-md">
        <div class="row align-items-center">
          <div class="col text-uppercase">

            <!-- Heading -->
            <h1 class="fw-bold text-white mb-2">
              <?php echo SITE_TITLE; ?>
            </h1>

            <!-- Text -->
            <p class="fs-lg text-white text-opacity-75 mb-0">
              WELCOME <a class="text-reset" href="#!"><?php echo $member->username; ?></a>
            </p>

          </div>
          <div class="col-auto">

            <!-- Button -->
            <a href="<?php echo do_config(14);?>signout" class="btn btn-sm bg-gray-300 bg-opacity-20 bg-opacity-25-hover text-white text-uppercase">
             <i class="fa fa-sign-out"></i> <?php echo _SIGN_OUT;?>
            </a>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </header>

    <!-- MAIN -->
    <main class="pb-8 pb-md-11 mt-md-n6">
      <div class="container-md">
        <div class="row">
          <div class="col-12 col-md-3">

            <!-- Card -->
            <div class="card card-bleed border-bottom border-bottom-md-0 shadow-light-lg">

              <!-- Collapse -->
              <div class="collapse d-md-block" id="sidenavCollapse">
                <div class="card-body">

                  <!-- Heading -->
                  <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fa fa-user-circle"></i> <?php echo _ACCOUNT;?>
                  </h6>

                  <!-- List -->
                  <ul class="card-list list text-gray-700 mb-6 text-uppercase">
					    <li class="list-item <?php if(eu_active == 'dashboard'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>bio/dashboard" class="list-link text-reset">
                               <?php echo _DASHBOARD ?>
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'templates'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>bio/templates" class="list-link text-reset">
                               TEMPLATES
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'build'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>bio/build" class="list-link text-reset">
                               BUILD TEMPLATE
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'settings'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/settings" class="list-link text-reset">
                               <?php echo _SETTINGS ?>
                          </a>
					    </li>
                  </ul>

                  <!-- Heading -->
                  <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fa fa-lock"></i> OTHER
                  </h6>

                  <!-- List -->
                  <ul class="card-list list text-gray-700 mb-0 text-uppercase">
					    <li class="list-item <?php if(eu_active == 'settings'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/settings?r=password" class="list-link text-reset">
                               <?php echo _CHANGE_PASSWORD ?>
                          </a>
					    </li>
					    <?php if( detectDevice() == 'MOBILE'){ ?>
					    <li class="list-item">
                          <a href="<?php echo do_config(14)?>signout" class="list-link text-reset">
                               <?php echo _SIGN_OUT ?>
                          </a>
					    </li>
                        <?php } ?>
                  </ul>

                </div>
              </div>

            </div>

          </div>
