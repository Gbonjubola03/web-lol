<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php 
 if($member->type != 'seller'){
      echo '<br> <h2 class="text-center">ERROR: YOU MUST BE VERIFIED SELLER</h2><br>';
      require_once 'footer.php';
      exit;
 }
 if($member->premium == 2){
      echo '<br> <h2 class="text-center">ERROR: YOU MUST BE VERIFIED SELLER</h2><br>';
      require_once 'footer.php';
      exit;
 }
  if (!isset($_GET["id"])){
      echo '<br> <h2 class="text-center">ERROR: not found</h2><br>';
      require_once 'footer.php';
      exit;
  }else{
      $service = $query->addquery('select','services','*','i', $_GET["id"],'id=?');
  }
?>
<?php do_winfo('EDIT'); ?>
<?php define('eu_active','newservice'); ?>
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
              <div class="card-body">
                <!-- Form -->
				<form id="editservice_form" autocomplete="off" method="post">
				    <input type="hidden" name="editservice" value="editservice" />
				    <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
				    <input type="hidden" name="serv_id" value="<?php echo $service->id; ?>"/>
				    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                  <div class="row">
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">NAME</label>
                        <input class="form-control" type="text" name="name" placeholder="TITLE" value="<?php echo $service->name; ?>">
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">DESCRIPTION</label>
                        <textarea type="text" class="form-control" name="description" placeholder="DESCRIPTION"><?php echo $service->description; ?></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">PRICE</label>
                        <input class="form-control" type="number" name="price" placeholder="PRICE" min="1" step="1" value="<?php echo $service->price; ?>">
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">INSTRUCTIONS</label>
                        <textarea type="text" class="form-control" name="instructions" placeholder="INSTRUCTIONS"><?php echo $service->instructions; ?></textarea>
                      </div>
                    </div><hr>
                    <h4>ACCOUNT INFO <small>(ACCOUNT YOU WANT TO SELL)</small></h4>
                    <div class="col-12">
                        <label class="form-label">OPTION</label>
                        <select onchange="upOption(this.value)" class="form-control" type="text" name="type">
                            <option value="email" selected >EMAIL</option>
                            <option value="username">USERNAME</option>
                        </select>
                    </div>
                    <span id="email-option">
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">EMAIL</label>
                        <input class="form-control" type="email" name="email" placeholder="EMAIL" value="<?php echo $service->email; ?>">
                      </div>
                    </div>
                    </span>
                    <span id="username-option" style="display:none;">
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">USERNAME</label>
                        <input class="form-control" type="text" name="username" placeholder="USERNAME" value="<?php echo $service->email; ?>">
                      </div>
                    </div>
                    </span>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">PASSWORD</label>
                        <input class="form-control" type="text" name="password" placeholder="PASSWORD" value="<?php echo $service->password; ?>">
                      </div>
                    </div>
                    
                    <div class="col-12 col-md-auto">
                      <!-- Button -->
                      <button type="submit" onclick="editserviceForm();" id="editservice-button"  class="btn w-100 btn-primary">
                          <span id="icon-button"><i class="fa fa-check-circle"></i></span>
                          <span id="button-loader" style="display:none;">
                              <i class="fa fa-spinner fa-spin"></i>
                          </span>
                           EDIT
                      </button>

                    </div>
                <!-- ALERTS RESPONSE HERE-->
                <span id="editservice-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                  </div>
                </form>
              </div>
        </div>
    </div>
    </div>
  </div>
</main>
    
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>