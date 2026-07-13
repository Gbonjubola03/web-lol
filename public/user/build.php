<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php 
/*VICTIMS
 $downloads = $query->normal("SELECT count(id) FROM ".dbperfix."download as downloads WHERE user_id='$member->user_id'");
 $downloads = $downloads->fetch_assoc();
 $downloads = number_format($downloads['count(id)']);
 
 $deposited = $query->normal("SELECT sum(amount) FROM ".dbperfix."invoice as deposited WHERE user_id='$member->user_id' AND status='1'");
 $deposited = $deposited->fetch_assoc();
 $deposited = $deposited['sum(amount)'];*/
 
?>
<?php do_winfo('BUILD TEMPLATE'); ?>
<?php define('eu_active','build'); ?>
<style>
.bodycolor {
    height: 50px;
}
   .upload-file > input {
       display: none; 
   }
   .upload-file > div > span {
       display: none; 
   }
   .up-icon{
       cursor: pointer;
       font-size: 80px;
       color: #333;
   }
   .up-icon:hover {
       cursor: pointer;
       color: rgb(27 42 78);
   }
</style>
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
                <!-- ALERTS RESPONSE HERE-->
                <span id="build-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <!-- Form -->
				<form id="build_form" autocomplete="off" method="post">
				    <input type="hidden" name="build" value="build" />
				    <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
				    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                  <div class="row">
                              <div class="row">
                                  <div class="col-md-12 text-center">
                                     <label><i class="fa fa-check-circle"></i> IMAGE <small>(UPLOAD)</small></label>

                                     <div id="upload-files" class="upload-file">
                                         <label for="file-input">
                                             <i class="fa fa-cloud-upload up-icon"></i>
                                         </label>
                                         <input id="file-input" type="file" name="upload-files" onchange="uploadFile('build')"/>
                                         <br><small class="text-uppercase">(PNG / JPG / JPEG / GIF)</small>
                                         <div id="status-response" class="text-uppercase"></div>
                                         <div class="col-md-12 text-center">
                                             <div id="progress" class="progress" style="display: none;">
                                                 <div class="progress-bar progress-bar-striped progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div><HR>
                    <div class="row">
                    <div class="col-6">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">LOGO</label>
                          <select id="preview-response" name="preview" class="form-control text-uppercase">
                              <option>NO IMAGE</option>
                          </select>
                      </div>
                    </div>
                        <div class="col-6">
                      <!-- Name -->
                      <div class="form-group">LOGO SIZE</label>
                        <input class="form-control" type="text" name="preview_size" placeholder="LOGO SIZE" value='width="70px" height="70px"'>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-6">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">BANNER</label>
                          <select id="banner-response" name="banner" class="form-control text-uppercase">
                              <option>NO IMAGE</option>
                          </select>
                      </div>
                    </div>
                        <div class="col-6">
                      <!-- Name -->
                      <div class="form-group">BANNER SIZE</label>
                        <input class="form-control" type="text" name="banner_size" placeholder="BANNER SIZE" value='width="300px" height="50px"'>
                      </div>
                    </div>

                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">TEMPLATE NAME</label>
                        <input class="form-control" type="text" name="name" placeholder="NAME">
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">BODY COLOR</label>
                        <input class="form-control bodycolor" type="color" name="body_color" placeholder="NAME" value="#111111">
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">BUTTON COLOR</label>
                        <input class="form-control bodycolor" type="color" name="button_color" placeholder="BUTTON" value="#125ec3">
                      </div>
                    </div>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">
                        <label class="form-label">TEXT COLOR</label>
                        <input class="form-control bodycolor" type="color" name="text_color" placeholder="BUTTON" value="#ffffff">
                      </div>
                    </div><br>
                    <h4><b><i class="fa fa-cog"></i> INPUTs CONFUGRATION</b></h4><hr>
                    <div class="col-12">
                      <!-- Name -->
                      <div class="form-group">DESCRIPTION</label>
                        <input class="form-control" type="text" name="description" placeholder="DESCRIPTION" value="Login First">
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                      <!-- Name -->
                      <div class="form-group">EMAIL CONTENT</label>
                        <input class="form-control" type="text" name="email" placeholder="EMAIL CONTENT" value="Email or Phone">
                      </div>
                    </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="color-black">EMAIL LABEL</label>
				                 <select name="email_label" class="form-control">
				                     <option value="1">SHOW</option>
				                     <option value="2">HIDE</option>
				                 </select>
				            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <!-- Name -->
                        <div class="form-group">PASSWORD CONTENT</label>
                          <input class="form-control" type="text" name="password" placeholder="PASSWORD CONTENT" value="Password">
                        </div>
                      </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="color-black">PASSWORD LABEL</label>
				                 <select name="password_label" class="form-control">
				                     <option value="1">SHOW</option>
				                     <option value="2">HIDE</option>
				                 </select>
				            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Name -->
                        <div class="form-group">BUTTON CONTENT</label>
                          <input class="form-control" type="text" name="button" placeholder="BUTTON CONTENT" value="Log In">
                        </div>
                       </div>
                        <div class="col-6">
                            <!-- Name -->
                        <div class="form-group">BUTTON WIDTH</label>
                          <input class="form-control" type="text" name="button_width" placeholder="BUTTON WIDTH" value="200px">
                        </div>
                       </div>
                    </div>

                    <div class="col-12 col-md-auto">
                      <!-- Button -->
                      <button type="submit" onclick="buildForm();" id="build-button"  class="btn w-100 btn-primary">
                          <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                          <span id="button-loader" style="display:none;">
                              <i class="fa fa-spinner fa-spin"></i>
                          </span>
                           GENERATE
                      </button>

                    </div>
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