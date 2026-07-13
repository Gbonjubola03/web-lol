<?php require_once ('header.php'); ?>
<?php do_winfo('Settings'); ?>
   
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-cog"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
      <div class="row user">
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs text-uppercase">
              <li class="nav-item">
                  <a class="nav-link active" href="#general" data-toggle="tab">
                      <i class="fa fa-cog"></i> General
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#design" data-toggle="tab">
                      <i class="fa fa-paint-brush"></i> Desgin
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#integration" data-toggle="tab">
                      <i class="fa fa-code"></i> Integration
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#captcha" data-toggle="tab">
                      <i class="fa fa-refresh"></i> Captcha
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#system" data-toggle="tab">
                      <i class="fa fa-cog"></i> System
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#ads" data-toggle="tab">
                      <i class="fa fa-bullhorn"></i> ADS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#deposits" data-toggle="tab">
                      <i class="fa fa-arrow-down"></i> DEPOSITS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#email" data-toggle="tab">
                      <i class="fa fa-envelope"></i> E-mail
                  </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content text-uppercase">
            <div class="alert alert-warning">
              <i class="fa fa-cog"></i> WEBSITE THEM<a href="css-js-editor"><b>CHANGE DESIGNE + ADVANCE CSS-JS</b></a>
            </div>
            <div class="tab-pane active" id="general">
              <div class="tile user-settings">
                <!-- ALERTS RESPONSE HERE-->
                <span id="general-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">General</h4>
                <form id="general_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="general" value="general" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="<?php echo do_config(1);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Title </label>
                      <input type="text" class="form-control" name="site_title" value="<?php echo do_config(11);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Description</label>
                      <input type="text" class="form-control" name="site_description" value="<?php echo do_config(10);?>">
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>Keywords</label>
                      <input type="text" class="form-control" name="keywords" value="<?php echo do_config(26);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Landing Page Note</label>
                      <input type="text" class="form-control" name="home_sec_desc" value="<?php echo do_config(24);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Main Domain</label>
                      <input type="url" class="form-control" name="url" value="<?php echo do_config(14);?>" />
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>User Mail Activation</label>
                      <select class="form-control" name="account_activate_email">
                          <option value="1"<?php if(do_config(30) == 1){?> selected="selected"<?php } ?>>Yes</option>
                          <option value="2"<?php if(do_config(30) == 2){?> selected="selected"<?php } ?>>No</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>Title Perfix</label>
                      <input type="text" class="form-control" name="meta_perfix" value="<?php echo do_config(8);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Symbole Position</label>
                      <select class="form-control" name="position">
                          <option value="before"<?php if(do_config(30) == 'before'){?> selected="selected"<?php } ?>>Before</option>
                          <option value="after"<?php if(do_config(30) == 'after'){?> selected="selected"<?php } ?>>After</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>Amount Decimal</label>
                      <input type="text" class="form-control" name="amount_decimal" value="<?php echo do_config(20);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Default Language</label>
                      <select class="form-control" name="language">
                          <option value="language"selected="selected"><?php echo do_config(13);?></option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>phone Support</label>
                      <input type="text" class="form-control" name="support_email" value="<?php echo do_config(2);?>">
                    </div>
                  </div>
                  
                 
                  <hr>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button type="button" onclick="generalForm();" id="general-button" class="btn btn-primary text-uppercase">
                        <span id="general-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="general-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="design">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="design-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">Design</h4>
                <form id="design_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="design" value="design" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>Logo URL</label>
                      <input type="text" class="form-control" name="logo_url" value="<?php echo do_config(27);?>">
                    </div>
                    <div class="col-md-4">
                      <label>Favicon</label>
                      <input type="text" class="form-control" name="icon_url" value="<?php echo do_config(9);?>">
                    </div>
                  </div><hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="designForm();" id="design-button" class="btn btn-primary text-uppercase">
                        <span id="design-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="design-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="integration">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="integration-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">Integration</h4>
                <form id="integration_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="integration" value="integration" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-9">
                    <div class="col-md-9">
                      <label>Head Code</label>
                      <textarea  class="form-control" name="head_code"> <?php echo do_config(15);?></textarea>
                    </div>
                    </div><br>
                  <div class="row mb-9">
                    <div class="col-md-9">
                      <label>Body Code</label>
                      <textarea class="form-control" name="body_code"><?php echo do_config(17);?></textarea>
                    </div>
                    </div><br>
                  <div class="row mb-9">
                    <div class="col-md-9">
                      <label>Footer Code</label>
                      <textarea class="form-control" name="footer_code"><?php echo do_config(16);?></textarea>
                    </div>
                  </div>
                  <hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="integrationForm();" id="integration-button" class="btn btn-primary text-uppercase">
                        <span id="integration-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="integration-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
           <div class="tab-pane fade" id="captcha">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="captcha-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">Captcha</h4>
                <form id="captcha_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="captcha" value="captcha" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <label>reCAPTCHA Site key</label>
                      <input type="text" class="form-control" name="reCAPTCHA_site_key" value="<?php echo do_config(6);?>">
                    </div>
                    </div><br>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <label>reCAPTCHA Secret key</label>
                      <input type="text" class="form-control" name="reCAPTCHA_secret_key" value="<?php echo do_config(7);?>">
                    </div>
                  </div><br>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <label>TYPE</label>
                      <select class="form-control" name="type">
                          <option value="recaptcha"selected="selected">reCAPTCHA</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="captchaForm();" id="captcha-button" class="btn btn-primary text-uppercase">
                        <span id="captcha-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="captcha-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
           <div class="tab-pane fade" id="system">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="system-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">System</h4>
                <form id="system_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="system" value="system" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>Min Deposit</label>
                      <input type="text" class="form-control" name="min_deposit" value="<?php echo do_config(3);?>">
                    </div>
                    <div class="col-md-6">
                      <label>Main Currency</label>
                      <input type="text" class="form-control" name="currency" value="<?php echo do_config(18);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>Admin Percent</label>
                      <input type="text" class="form-control" name="admin_percent" value="<?php echo do_config(43);?>">
                    </div>
                    <div class="col-md-6">
                      <label>premium link shortener</label>
                      <input type="text" class="form-control" name="cpc_cost" value="<?php echo do_config(40);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>Api Link</label>
                      <input type="text" class="form-control" name="api_link" value="<?php echo do_config(127);?>">
                    </div>
                    <div class="col-md-6">
                      <label>Api key</label>
                      <input type="text" class="form-control" name="api" value="<?php echo do_config(21);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>Min Withdrawal</label>
                      <input type="text" class="form-control" name="min_withdraw" value="<?php echo do_config(5);?>">
                    </div>
                    <div class="col-md-6">
                      <label>Protected Usernames</label>
                      <input type="text" class="form-control" name="protected_usernames" value="<?php echo do_config(12);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>announcement timer</label>
                      <input type="number" class="form-control" name="announce_timer" value="<?php echo do_config(55);?>">
                    </div>
                    <div class="col-md-6">
                      <label>promotion price</label>
                      <input type="text" class="form-control" name="promote_price" value="<?php echo do_config(54);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>verification notice</label>
                      <input type="text" class="form-control" name="verification_notice" value="<?php echo do_config(48);?>">
                    </div>
                    <div class="col-md-6">
                      <label>verification price</label>
                      <input type="text" class="form-control" name="verification_price" value="<?php echo do_config(49);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>EMAIL VICTIMS</label>
                      <select class="form-control" name="enable_email_victims">
                          <option value="1"<?php if(do_config(51) == 1){?> selected="selected"<?php } ?>>ENABLE</option>
                          <option value="2"<?php if(do_config(51) == 2){?> selected="selected"<?php } ?>>DISABLE</option>
                      </select>
                      <small>SEND EMAIL TO VICTIMS?</small>
                    </div>
                    <div class="col-md-6">
                      <label>FRAUD CLICKS</label>
                      <input type="text" class="form-control" name="fraud_clicks" value="<?php echo do_config(105);?>">
                      <small>IF FRAUD CLICKS FOUND BIGGER THEN OR EQUAL (<?php echo do_config(105);?>) EARNINGS WILL BE SUSPENDED.</small>
                    </div>
                  </div>
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>PROMOTE</label>
                      <select class="form-control" name="enable_promote">
                          <option value="1"<?php if(do_config(108) == 1){?> selected="selected"<?php } ?>>ENABLE</option>
                          <option value="2"<?php if(do_config(108) == 2){?> selected="selected"<?php } ?>>DISABLE</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="systemForm();" id="system-button" class="btn btn-primary text-uppercase">
                        <span id="system-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="system-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
           <div class="tab-pane fade" id="ads">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="ads-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">ADS</h4>
                <form id="ads_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="ads" value="ads" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>MERCHANT PERCENT</label>
                      <input type="text" class="form-control" name="fb_link" value="<?php echo do_config(106);?>">
                      <small>MERCHANTS DEPOSIT BONUS %</small>
                    </div>
                    <div class="col-md-6">
                      <label>MERCHANT NOTICE</label>
                      <input type="text" class="form-control" name="merchant_notice" value="<?php echo do_config(107);?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="adsForm();" id="ads-button" class="btn btn-primary text-uppercase">
                        <span id="ads-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="ads-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
           <div class="tab-pane fade" id="deposits">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="deposits-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase"> DEPOSITS</h4>
                <form id="deposits_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="deposits" value="deposits" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>MIN DEPOSIT CRYPTO</label>
                      <input type="text" class="form-control" name="min_deposit_crypto" value="<?php echo do_config(100);?>">
                    </div>
                    <div class="col-md-6">
                      <label>MIN DEPOSIT BANK</label>
                      <input type="text" class="form-control" name="min_deposit_bank" value="<?php echo do_config(101);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>MIN DEPOSIT PAYSTACK</label>
                      <input type="text" class="form-control" name="min_deposit_paystack" value="<?php echo do_config(102);?>">
                    </div>
                    <div class="col-md-6">
                      <label>1$ TO NGN RATE</label>
                      <input type="text" class="form-control" name="rate" value="<?php echo do_config(103);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>BTC ADDRESS</label>
                      <input type="text" class="form-control" name="btc_address" value="<?php echo do_config(98);?>">
                    </div>
                    <div class="col-md-6">
                      <label>USDT (TRC20) ADDRESS</label>
                      <input type="text" class="form-control" name="usdt_address" value="<?php echo do_config(99);?>">
                    </div>
                  </div><br />
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <label>CRYPTO TAX AMOUNT</label>
                      <input type="text" class="form-control" name="crypto_tax" value="<?php echo do_config(104);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>PAYSTACK TAX AMOUNT</label>
                      <input type="text" class="form-control" name="paystack_tax" value="<?php echo do_config(52);?>">
                    </div>
                    <div class="col-md-6">
                      <label>BANK TAX AMOUNT</label>
                      <input type="text" class="form-control" name="bank_tax" value="<?php echo do_config(53);?>">
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>PAYSTACK PUBLIC KEY</label>
                      <input type="text" class="form-control" name="paystack_public_key" value="<?php echo do_config(45);?>">
                    </div>
                    <div class="col-md-6">
                      <label>PAYSTACK SECRET KEY</label>
                      <input type="text" class="form-control" name="paystack_secret_key" value="<?php echo do_config(46);?>">
                    </div>
                  </div><br />
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <label>BANK INFORMATIONS</label>
                      <textarea type="text" class="form-control" name="bank_informations"><?php echo do_config(47);?></textarea>
                    </div>
                  </div><br />
                  <hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="depositsForm();" id="deposits-button" class="btn btn-primary text-uppercase">
                        <span id="deposits-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="deposits-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
           <div class="tab-pane fade" id="email">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="email-response" class="text-uppercase"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head text-uppercase">E-mail Configuration</h4>
                <form id="email_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="email" value="email" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>OPTION</label>
                      <select class="form-control" name="mailer_option">
                          <option value="php_mail"<?php if(do_config(31) == 'php_mail'){?> selected="selected"<?php } ?>>PHP MAIL</option>
                          <option value="smtp"<?php if(do_config(31) == 'smtp'){?> selected="selected"<?php } ?>>SMTP</option>
                      </select>
                      <small>MAILER TYPE</small>
                    </div>
                    <div class="col-md-6">
                      <label>USERNAME</label>
                      <input type="text" class="form-control" name="mailer_username" value="<?php echo do_config(32);?>">
                      <small>MAILER USERNAME</small>
                    </div>
                  </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>HOST</label>
                      <input type="text" class="form-control" name="mailer_host" value="<?php echo do_config(33);?>">
                      <small>MAILER HOST</small>
                    </div>
                    <div class="col-md-6">
                      <label> PORT</label>
                      <input type="number" class="form-control" name="mailer_port" value="<?php echo do_config(34);?>">
                      <small>MAILER PORT</small>
                    </div>
                    </div><br />
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>ENCRYPT</label>
                      <select class="form-control" name="mailer_use">
                          <option value="ssl"<?php if(do_config(35) == 'ssl'){?> selected="selected"<?php } ?>>SSL</option>
                          <option value="tls"<?php if(do_config(35) == 'tls'){?> selected="selected"<?php } ?>>TLS</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>PASSWORD</label>
                      <input type="password" class="form-control" name="mailer_pass" value="<?php echo do_config(36);?>">
                      <small>MAILER PASSWORD</small>
                    </div>
                  </div><hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <button type="button" onclick="emailForm();" id="email-button" class="btn btn-primary text-uppercase">
                        <span id="email-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="email-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          SAVE
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
    
<?php require_once ('footer.php'); ?>