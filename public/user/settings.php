<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
//files
 
$avatar = $query->limit('files','*','id','desc','0,10','i', $member->user_id,'user_id=?');
$users = $query->addquery('select','users','*','i', $member->user_id,'user_id=?');
 $countries = explode(',',do_config(23));
 $ro = $_GET["r"]?: 'profile';
?>

   
<?php do_winfo('SETTINGS'); ?>
<?php define('eu_active','settings'); ?>
<style>
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
    
   <?php require_once ('setup-menu.php'); ?>
    <div class="col-12 col-md-9">
    <!-- Card -->
    <div class="">
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
                <?php if($member->is_email_verified == 2){ ?>
                  <div class="alert alert-warning text-center">
                      <p>PLEASE HELP US BY VERIFY YOUR ACCOUNT, SO YOU CAN USE ALL OUR SERVICES.</p>
                      <a href="?verify=1" class="btn btn-primary">
                        <i class="fa fa-send"></i>  SEND VERIFICATION EMAIL
                      </a>
                  </div>
                <?php } ?>
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

							<h6>use this website to generate an image <h5>upload.pinnocent.com</h5> </h6>
              <h6>or click the menu to open the image generator</h6>
              <h5>you don't need to copy the generate link, it will automatically appear here when you upload</h5>
                    <div class="row">
                        <label class="form-label">PROFILE</label>
                        <select type="text" id="preview-response" class="form-control text-uppercase" name="avatar">
                        <?php while ($res= $previewfiles->fetch_assoc()) { ?>
                            <option value="<?php echo $res["path"]; ?>"><?php echo $res["name"]; ?></option>
                        <?php } ?>
                        </select>
                    </div>
				            
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="last" class="color-black"><?php echo _USERNAME;?></label>
				                        <input type="text" class="form-control" value="<?php echo $member->username;?>" disabled>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="last" class="color-black"><?php echo _EMAIL;?></label>
				                        <input type="email" class="form-control" value="<?php echo $member->email;?>" disabled>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="last" class="color-black"><?php echo _FIRST_NAME;?></label>
				                        <input type="text" class="form-control" name="first_name" value="<?php echo $member->first_name;?>" required>
				                    </div>
				                    
				                    
				                    
				                    
				                    
				                    
				                    
				                    
				                    
				                    
				                    
				                    
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="last" class="color-black"><?php echo _LAST_NAME;?></label>
				                        <input type="text" class="form-control" name="last_name" value="<?php echo $member->last_name;?>" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="last" class="color-black">WHATSAPP PHONE NUMBER</label>
				                        <input type="tel" class="form-control" name="phone" value="<?php echo $member->phone;?>"required>
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
				                        <label for="first" class="color-black"><?php echo _CURRENT_PASSWORD;?> *</label>
				                        <input type="password" name="currentpassword" class="form-control" autocomplete="disabled">
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                        <label for="first" class="color-black"><?php echo _NEW_PASSWORD;?> *</label>
				                        <input type="password" name="newpassword" class="form-control" autocomplete="disabled">
				                    </div>
				                </div>
				                <div class="col-md-12">
				                    <div class="form-group">
				                        <label for="first" class="color-black"><?php echo _CONFIRM_NEW_PASSWORD;?> *</label>
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