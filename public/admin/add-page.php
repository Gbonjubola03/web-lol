<?php require_once ('header.php'); ?>
<?php
 //catgories

?>
<?php define('pg_active','addpage'); ?>
<?php do_winfo('ADD'); ?>
  
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
            <?php require_once ('pg-menu.php'); ?>
        </div>
        <div class="col-md-9">
      <div class="bs-component">
          <div class="card">
              <h4 class="card-header"> ADD PAGE</h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <!-- ALERTS RESPONSE HERE-->
                          <span id="addpage-response"></span>
                          <!-- ALERTS RESPONSE END HERE -->
                          <form id="addpage_form" autocomplete="off" method="POST">
                              <input type="hidden" name="addpage" value="addpage" />
                              <input type="hidden" name="csrf" value="$csrfToken"/>
                              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                              <div class="row mb-12">
                                <div class="col-md-12">
                                     <label>TITLE</label>
                                     <input type="text" class="form-control" name="title" placeholder="TITLE">
                               </div>
                             </div><br />
                              <div class="row mb-12">
                                  <div class="col-md-12">
                                      <label>CONTENT</label>
                                      <textarea type="text" class="form-control" name="content"></textarea>
                                  </div>
                             </div><hr>
                            <div class="row mb-10">
                              <div class="col-md-12">
                                <button type="button" onclick="addpageForm();" id="addpage-button" class="btn btn-primary">
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