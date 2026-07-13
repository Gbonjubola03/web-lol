<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
 $countries = explode(',',do_config(23));
 $ro = $_GET["r"]?: 'profile';
?>
<?php do_winfo('SETTINGS'); ?>
<?php define('eu_active','settings'); ?>

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
    <div class="col-12 col-md-9">
    <!-- Card -->
    <div class="card card-bleed shadow-light-lg mb-6">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">

                    <!-- Heading -->
                    <h4 class="mb-0 text-uppercase">
                      <?php echo _SETTINGS;?>
                    </h4><hr>
                  </div>
                </div>
              </div>
              <div class="card-body">
						    <div class="col-12">
							<div class="row">
							<!-- PERSONAL INFORMATION-->
							<div class="review-comment-section">
							  <div class="row">
							  <div class="col-12 col-md-12 col-lg-12 col-xl-8">
								 <!-- ALERTS RESPONSE HERE-->
								 <span id="profile-response" class="text-uppercase"></span>
								 <!-- ALERTS RESPONSE END HERE -->
								 <!-- ALERTS RESPONSE HERE-->
								 <span id="password-response" class="text-uppercase"></span>
								 <!-- ALERTS RESPONSE END HERE -->
					<?php if($ro == 'profile'){ ?>
						<!-- PERSONAL INFORMATION -->
				        <form id="profile_form" autocomplete="off" method="post">
				            <input type="hidden" name="prfsave" value="prfsave" />
				            <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
				            <input autocomplete="false" name="hidden" type="text" style="display:none;">
				            
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="last" class="color-black"><?php echo _EMAIL;?></label>
				                        <input type="email" class="form-control" value="<?php echo $member->email;?>" disabled>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="country" class="color-black"><?php echo _COUNTRY;?> *</label>
				                        <select name="country" class="form-control col-md-12">
				                            <?php foreach ($countries as $foo) { ?>
				                            <option value="<?php echo $foo; ?>"<?php if($foo == $member->country){?> selected="selected"<?php } ?>><?php echo $foo; ?></option>
				                            <?php } ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="col-md-12">
									<button type="submit" onclick="profileForm();" id="profile-button" class="btn btn-primary btn-btx wd-shop-btn text-uppercase">
									    <span id="icon-button"><i class="fa fa-floppy-o"></i></span>
									    <span id="button-loader" style="display:none;">
									        <i class="fa fa-spinner fa-spin"></i>
									    </span>
									    <?php echo _SAVE;?>
									</button> 
				                </div>
				            </div>
                        </form>
					<?php }elseif($ro == 'password'){ ?>
						<!-- CHANGE PASSWORD -->
				        <form id="password_form" autocomplete="off" method="post">
				            <input type="hidden" name="passave" value="passave" />
				            <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
				            <input autocomplete="false" name="hidden" type="text" style="display:none;">

				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="first" class="color-black text-uppercase"><?php echo _CURRENT_PASSWORD;?> *</label>
				                        <input type="password" name="currentpassword" class="form-control" autocomplete="disabled">
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="first" class="color-black text-uppercase"><?php echo _NEW_PASSWORD;?> *</label>
				                        <input type="password" name="newpassword" class="form-control" autocomplete="disabled">
				                    </div>
				                </div>
				                <div class="col-md-12">
				                    <div class="form-group">
				                        <label for="first" class="color-black text-uppercase"><?php echo _CONFIRM_NEW_PASSWORD;?> *</label>
				                        <input type="password" name="confpassword" class="form-control" autocomplete="disabled">
				                    </div>
				                </div>
				                
				                <div class="col-md-12">
									<button type="submit" onclick="ChangPasswordForm();" id="password-button" class="btn btn-primary btn-btx wd-shop-btn text-uppercase">
									    <span id="password-icon-button"><i class="fa fa-floppy-o"></i></span>
									    <span id="password-button-loader" style="display:none;">
									        <i class="fa fa-spinner fa-spin"></i>
									    </span>
									    <?php echo _SAVE;?>
									</button> 
				                </div>
				            </div>
                        </form>
					<?php } ?>
					</div>
					</div>
				</div>
				</div>
			</div>

              </div>
    </div>
    </div>
</div>
    </div>
    </main>
    
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>