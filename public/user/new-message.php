<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php 
  if(!isset($_GET['id']) || empty(trim($_GET['id']))){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
  $usr_id = $_GET['id'];
  $reciever = fetch_user($usr_id);
  //$reciever = $query->addquery('select','users','*','i', $usr_id,'user_id=?');
?>
<?php do_winfo('NEW MESSAGE'); ?>
<?php define('eu_active','messages'); ?>

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
                    <h4 class="mb-0">
                      <?php echo SITE_TITLE; ?>
                    </h4><hr>
                  </div>
                </div>
              </div>
              <div class="card-body text-center">
              <?php if($reciever->user_id != $member->user_id){ ?>
                  <div class="alert alert-warning">
                      <small>
                          <b>
                              <i class="fa fa-send"></i> 
                              SEND NEW MESSAGE TO <?php echo strtoupper($reciever->username); ?>
                          </b>
                      </small>
                  </div>
              <?php }elseif($reciever->user_id == $member->user_id){ ?>
                  <div class="alert alert-danger">
                      <small>
                          <b>
                              <i class="fa fa-ban"></i> 
                              YOU CAN'T SEND A MESSAGE TO YOURSELF!
                          </b>
                      </small>
                  </div>
              <?php } ?>
              </div>
    </div>
    <?php if($reciever->user_id != $member->user_id){ ?>
    <div class="card card-bleed shadow-light-lg mb-6">
		<div class="card">
		    <div class="card-body">
		        <form id="newmessage_form" autocomplete="false" method="POST">
		            <input type="hidden" name="csrfToken" value="<?php echo csrf_token();?>" />
		            <input type="hidden" name="newmessage" value="newmessage" />
		            <input type="hidden" name="reciever_user_id" value="<?php echo $reciever->user_id;?>" />
		            <input autocomplete="false" name="hidden" type="text" style="display:none;">
		            
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label class="text-uppercase">
		                        <i class="fa fa-envelope"></i> <?php echo _YOUR_MESSAGE;?>
							</label><br>
							<textarea name="message" class="form-control col-12" id="reply"></textarea>
						</div>
					</div>
					<div class="col-md-12">
					    <button onclick="newmessageForm();" id="newmessage-button" class="btn btn-primary text-uppercase">
					        <span id="icon-button"><i class="fa fa-send"></i></span>
					        <span id="button-loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
					        send
					    </button> 
					 </div>
				</form><br>
				<!-- ALERTS RESPONSE HERE-->
				<span id="newmessage-response" class="text-uppercase"></span>
				<!-- ALERTS RESPONSE END HERE -->
			</div>
		</div>
    </div>
    <?php } ?>

    </div>
</div>
    </div>
    </main>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>