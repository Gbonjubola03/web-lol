<?php
    if (!defined('eu_active')) {
      define('eu_active','dashboard');
    }
    $countmsg = $query->normal("SELECT count(id) FROM ".dbperfix."messages as msg WHERE reciever_user_id='$member->user_id' and order_id='0' AND isread='2';");
    $countmsg = $countmsg->fetch_assoc();
    $countmsg = number_format($countmsg['count(id)']);
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
  WELCOME <a class="text-reset" href="/profile/<?php echo isset($member->username) ? $member->username : $member->user_id; ?>/"><?php echo isset($member->username) ? $member->username : 'User'; ?></a>
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
                          <a href="<?php echo do_config(14)?>user/dashboard" class="list-link text-reset">
                               <?php echo _DASHBOARD ?>
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'viewvictim'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/view-victim" class="list-link text-reset">
                               VIEW VICTIM 
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'atmvictim'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/atm-victim" class="list-link text-reset">
                               ATM VICTIM
                          </a>
					    </li>
                    <?php if($member->type == 'seller'){ ?>
					    <li class="list-item <?php if(eu_active == 'verification'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/verification" class="list-link text-reset">
                               VERIFICATION
                          </a>
					    </li>
					   <?php if($member->premium == 1){ ?>
					    <li class="list-item <?php if(eu_active == 'newservice'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/new-service" class="list-link text-reset">
                               SELL ACCOUNTS
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'services'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/services" class="list-link text-reset">
                                SERVICES
                          </a>
					    </li>
					    <?php if(do_config(108) == 1){ ?>
					    <li class="list-item <?php if(eu_active == 'promote'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/promote" class="list-link text-reset">
                                PROMOTE
                          </a>
					    </li>
					    <?php } ?>
					  <?php } ?>
                    <?php } ?>
                  </ul>

                  <!-- Heading -->
                  <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fa fa-lock"></i> OTHER
                  </h6>

                  <!-- List -->
                  <ul class="card-list list text-gray-700 mb-0 text-uppercase">
					    <li class="list-item <?php if(eu_active == 'messages'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/messages" class="list-link text-reset">
                               MESSAGES &nbsp; <div class="message-count"><?php echo $countmsg ?></div>
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'orders'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/orders" class="list-link text-reset">
                               ORDERS
                          </a>
					    </li>

					    <li class="list-item <?php if(eu_active == 'settings'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/settings" class="list-link text-reset">
                               <?php echo _SETTINGS ?>
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'settings'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/settings?r=password" class="list-link text-reset">
                               <?php echo _CHANGE_PASSWORD ?>
                          </a>
					    </li>
					    <li class="list-item <?php if(eu_active == 'deposit'){ ?>active<?php } ?>">
                          <a href="<?php echo do_config(14)?>user/deposit" class="list-link text-reset">
                               <?php echo _DEPOSIT;?>
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
