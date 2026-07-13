<?php require_once ('header.php'); ?>
<?php
 //catgories

?>
<?php define('eu_active','adduser'); ?>
<?php do_winfo('ADD'); ?>
<style>
/* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid dark;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
  
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-bars"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
      <div class="row user">
        <div class="col-md-3">
            <?php require_once ('eu-menu.php'); ?>
        </div>
        <div class="col-md-9">
      <div class="bs-component">
          <div class="card">
              <h4 class="card-header"> ADD USER</h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <!-- ALERTS RESPONSE HERE-->
                          <span id="adduser-response" class="text-uppercase"></span>
                          <!-- ALERTS RESPONSE END HERE -->
                          <form id="adduser_form" autocomplete="off" method="POST">
                              <input type="hidden" name="adduser" value="adduser" />
                              <input type="hidden" name="csrf" value="$csrfToken"/>
                              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                              <div class="row mb-6">
                                <div class="col-md-6">
                                     <label>USERNAME</label>
                                     <input type="text" class="form-control" name="username" placeholder="Username">
                               </div>
                                  <div class="col-md-6">
                                     <label>ROLE</label>
                                    <select onchange="upOption(this.value)" class="form-control" name="role">
                                      <option value="user" selected>USER</option>
                                      <option value="admin">ADMIN</option>
                                    </select>
                                </div>
                             </div><br>
                           
                             <span id="admin-option" style="display:none;">
                             <hr>
                              <div class="row mb-12 text-uppercase">
                                <div class="col-md-6">
                                 <label class="container"> USERS
                                    <input type="checkbox"  name="users" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                                <div class="col-md-6">
                                 <label class="container"> services
                                    <input type="checkbox" name="services" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                             </div>
                              <div class="row mb-12 text-uppercase">
                                <div class="col-md-6">
                                 <label class="container"> verifications
                                    <input type="checkbox"  name="verifications" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                                <div class="col-md-6">
                                 <label class="container"> orders
                                    <input type="checkbox" name="orders" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                             </div>
                              <div class="row mb-12 text-uppercase">
                                <div class="col-md-6">
                                 <label class="container"> websites
                                    <input type="checkbox"  name="websites" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                                <div class="col-md-6">
                                 <label class="container"> campaigns
                                    <input type="checkbox" name="campaigns" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                             </div>

                              <div class="row mb-12 text-uppercase">
                                <div class="col-md-6">
                                 <label class="container"> links
                                    <input type="checkbox"  name="links" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                                <div class="col-md-6">
                                 <label class="container"> statements
                                    <input type="checkbox" name="statements" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                             </div>
                              <div class="row mb-12 text-uppercase">
                                <div class="col-md-6">
                                 <label class="container"> invoices
                                    <input type="checkbox"  name="invoices" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                                <div class="col-md-6">
                                 <label class="container"> withdrawals
                                    <input type="checkbox" name="withdrawals" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                             </div>
                              <div class="row mb-12 text-uppercase">
                                <div class="col-md-12">
                                 <label class="container"> settings
                                    <input type="checkbox"  name="settings" value="1">
                                    <span class="checkmark"></span>
                                 </label>
                               </div>
                             </div>

                             <hr>
                             </span>

                              <div class="row mb-12">
                                <div class="col-md-12">
                                    <label>PASSWORD</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                               </div>
                             </div>
                              <div class="row mb-6">
                                <div class="col-md-6">
                                     <label>EMAIL</label>
                                     <input type="email" class="form-control" name="email" placeholder="Email">
                               </div>
                                  <div class="col-md-6">
                                     <label>STATUS</label>
                                    <select class="form-control" name="status">
                                      <option value="1">ACTIVE</option>
                                      <option value="2">INACTIVE</option>
                                    </select>
                                </div>
                             </div><hr>
                            <div class="row mb-10">
                              <div class="col-md-12">
                                <button type="button" onclick="adduserForm();" id="adduser-button" class="btn btn-primary">
                                  <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                  <span id="button-loader" style="display:none;">
                                    <i class="fa fa-spinner fa-spin"></i>
                                 </span>
                                  ADD
                              </button>
                              </div>
                            </div>
                        </form>
                      </div>
                  </div>
              </div>
              <div class="card-footer text-muted">
                  <strong>
                  <i class="fa fa-cog"></i> <a href="settings"> CONFIGURATION</a>
                  </strong>
              </div>
          </div>
        </div>
        </div>
      </div>
    </main>
<?php require_once ('footer.php'); ?>