<?php require_once ('header.php'); ?>
<?php
 //catgories
 $previewfth = $query->limit('files','*','id','desc','0,10','i',$member->user_id,'user_id=?');

?>
<?php define('pg_active','addip'); ?>
<?php do_winfo('ADD'); ?>
  
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
       color: #426e10;
   }
   </style>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-plus-circle"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
      <div class="row user">
        <div class="col-md-3">
            <?php require_once ('ban-menu.php'); ?>
        </div>
        <div class="col-md-9">
      <div class="bs-component">
          <div class="card">
              <h4 class="card-header"> ADD IP(s)</h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <!-- ALERTS RESPONSE HERE-->
                          <span id="addip-response" class="text-uppercase"></span>
                          <!-- ALERTS RESPONSE END HERE -->
                          <form id="addip_form" autocomplete="off" method="POST">
                              <input type="hidden" name="addip" value="addip" />
                              <input type="hidden" name="csrf" value="$csrfToken"/>
                              <input autocomplete="false" name="hidden" type="text" style="display:none;">

                              <div class="row mb-6">
                                <div class="col-md-6">
                                     <label>IP</label>
                                     <input type="text" class="form-control" name="ip" placeholder="IP">
                               </div>
                                  <div class="col-md-6">
                                     <label>STATUS</label>
                                    <select class="form-control" name="status">
                                      <option value="1">WHITELIST</option>
                                      <option value="2">BLACKLIST</option>
                                    </select>
                                </div>
                             </div><br />
                              <div class="row mb-12">
                                  <div class="col-md-12">
                                      <label>REASON</label>
                                      <textarea type="text" class="form-control" name="reason"></textarea>
                                  </div>
                             </div>
                             <hr>
                            <div class="row mb-10">
                              <div class="col-md-12">
                                <button type="button" onclick="addipForm();" id="addip-button" class="btn btn-primary">
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