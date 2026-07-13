<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>
<?php
  if(!isset($_GET['id'])){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
  $profile = fetch_profile($_GET['id'],'profile');
  $stats = fetch_profile($profile->user_id,'stats');
  //var_export($profile);exit;
  
  if(!$profile){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
  //$isfollowed = $query->addquery('select','followers','*','i', $member->user_id,'user_id=?');

?>
<?php do_winfo($profile->username); ?>

    <!-- Title -->
    <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?> </title>
    <link rel="stylesheet" href="<?php echo do_config(14);?>assets/landkit/css/profile.css">
    <section class="section about-section gray-bg" id="about">
            <div class="container">
                <hr>
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color">
                                <img src="<?php echo do_config(14);?>assets/img/verified-badge.png" title="avatar" alt="avatar" width="50" height="50">
                                <?php echo strtoupper($profile->username); ?></h3>
                            <h6 class="theme-color lead text-uppercase">
                                ABOUT <?php echo strtoupper($profile->username); ?>
                            </h6>
                            <div class="row about-list">
                                <div class="col-md-12">
                                    <div class="media">
                                        <label>USERNAME</label>
                                        <p><?php echo $profile->username; ?></p>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                            <?php if(empty($profile->phone)){ ?>
                                    <a href="#!" class="btn btn-success">
                                        <i class="fa fa-whatsapp"></i> WHATSAPP
                                    </a>
                            <?php }else{ ?>
                                    <a href="<?php echo $profile->phone; ?>" class="btn btn-success">
                                        <i class="fa fa-whatsapp"></i> WHATSAPP
                                    </a>
                            <?php } ?>
                                </div>
                                <div class="col-md-4">
                                    <a href="/user/new-message?id=<?php echo $profile->user_id; ?>" class="btn btn-danger"><i class="fa fa-envelope"></i> CONTACT</a>
                                </div>
                                <div class="col-md-4">
                <?php if($isfollowed > 0){ ?>
					    <a href="#!" class="btn btn-warning text-uppercase" disabled>
					        <i class="fa fa-user-plus"></i>
					        FOLLOWED
					    </a> 
                <?php }else{ ?>
		        <form id="follow_form" autocomplete="false" method="POST">
		            <input type="hidden" name="csrfToken" value="<?php echo csrf_token();?>" />
		            <input type="hidden" name="follow" value="follow" />
		            <input type="hidden" name="profile_user_id" value="<?php echo $profile->user_id;?>" />
		            <input autocomplete="false" name="hidden" type="text" style="display:none;">
		            
					<div class="col-md-12">
					    <button onclick="followForm();" id="follow-button" class="btn btn-warning text-uppercase">
					        <span id="icon-button"><i class="fa fa-user-plus"></i></span>
					        <span id="button-loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
					        FOLLOW
					    </button> 
					 </div>
				</form><br>
				<!-- ALERTS RESPONSE HERE-->
				<span id="follow-response" class="text-uppercase"></span>
				<!-- ALERTS RESPONSE END HERE -->
                <?php } ?>

                                </div>
                            </div><hr>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="<?php echo do_config(14);?><?php echo $profile->avatar; ?>" title="avatar" alt="avatar" width="315" height="315">
                        </div>
                    </div>
                </div>
                <div class="counter">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="500" data-speed="500">
                                    +<?php echo $profile->score; ?>
                                </h6>
                                <p class="m-0px font-w-600"><i class="fa fa-check"></i> SCORE</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="150" data-speed="150"><?php echo $stats->accounts; ?></h6>
                                <p class="m-0px font-w-600"><i class="fa fa-users"></i> ACCOUNTS</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="850" data-speed="850"><?php echo 0; ?></h6>
                                <p class="m-0px font-w-600"><i class="fa fa-user-plus"></i> FOLLOWERS</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="850" data-speed="850"><?php echo $stats->corders; ?></h6>
                                <p class="m-0px font-w-600"><i class="fa fa-check-circle"></i> COMPLETED ORDERS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>