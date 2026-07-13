<?php require_once ('header.php'); ?>
<?php
// $countries = explode(',',do_config(23));
// $lt_prizes = explode(',',do_config(67));

?>
<style>
#upload-files {
    position: relative;
    clear: both;
    text-align: center;
    padding: 10px 0 25px;
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
    color: #426e10;
}
</style>
<?php 
do_winfo('APP_CONFIGURATION'); ?>
   
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
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link active" href="#appinfo" data-toggle="tab">
                      <i class="fa fa-warning"></i> APP INFO
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#plugins" data-toggle="tab">
                      <i class="fa fa-plug"></i> PLUGINS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#update" data-toggle="tab">
                      <i class="fa fa-refresh"></i> UPDATE
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#faqs" data-toggle="tab">
                      <i class="fa fa-question-circle"></i> FAQS
                  </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
           <div class="alert alert-danger text-center">
                    <i class="fa fa-copyright"></i> ALL THE COPYRIGHTS HOLD TO <b>pinnocent.com LTD</b>, WE PROVIDE <b>UPDATES + PLUGINS</b> AND MORE!
            </div>
            <div class="tab-pane active" id="appinfo">
              <div class="tile user-settings">
                <!-- ALERTS RESPONSE HERE-->
                <span id="appinfo-response"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head">APP INFORMATIONS</h4>
                <form id="appinfo_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="appinfo" value="appinfo" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-6">
                    <div class="col-md-6">
                      <label>PURCHASE CODE</label>
                      <input type="text" class="form-control" name="purchase_code" value="<?php echo do_config(71);?>" placeholder="PURCHASE CODE">
                      <small> YOUR PURCHASE CODE YOU RECIEVED FROM <a href="https://hololatikom.com" target="_blank">pinnocent.com</a></small>
                    </div>
                    <div class="col-md-6">
                      <label>LICENSE </label>
                      <input type="text" class="form-control" value="<?php echo do_config(72);?>" disabled>
                    </div>
                  </div>
                  <br /><hr>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button type="button" onclick="appinfoForm();" id="appinfo-button" class="btn btn-primary">
                        <span id="appinfo-icon-button"><i class="fa fa-floppy-o"></i></span>
                        <span id="appinfo-button-loader" style="display:none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                          Save
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="plugins">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="plugins-response"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head">PLUGINS</h4>
                <form id="plugins_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="plugins" value="plugins" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">

                  <div class="row mb-12 text-center">
                                <div class="col-md-12">
                                  <div id="upload-files" class="upload-file">
                                    <label for="Icon">PLUGIN FILE (ZIP)</label><br>
                                    <span id="file-update"></span>
                                    <label for="file-input">
                                      <i class="fa fa-cloud-upload up-icon"></i>
                                    </label>
                                    <input id="file-input" type="file" name="update-file" onchange="uploadUpdate()"/>
                                 </div>
                                  <div id="progress" class="progress" style="display: none;">
                                    <div class="progress-bar progress-bar-striped progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%
                                  </div><br />
                       </div>
                </div>
           </div><br /><hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <div class="alert alert-warning text-center">
                        <i class="fa fa-plug"></i> UPLOAD PLUGIN FILE PROVIDED FROM <a href="https://hololatikom.com" target="_blank">pinnocent.com</a>
                      </div>
                    </div>
                   </div><br /><hr>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <h4><I class="fa fa-check-circle"></I> YOUR INSTALLED PLUGINS</h4><hr>

                    </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="update">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="update-response"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head">APP UPDATE</h4>
                <form id="update_form" autocomplete="off" role="form" method="POST">
                  <input type="hidden" name="update" value="update" />
                  <input type="hidden" name="csrf" value="$csrfToken"/>
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                 
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <label>YOUR APP VERSION</label>
                      <input  class="form-control"  value="V<?php echo do_config(22); ?>" disabled  /> 
                    </div>
                    </div><br /><hr>
                  <div class="row mb-12 text-center">
                                <div class="col-md-12">
                                  <div id="upload-files" class="upload-file">
                                    <label for="Icon">UPDATE FILE (ZIP)</label><br>
                                    <span id="file-update"></span>
                                    <label for="file-input">
                                      <i class="fa fa-cloud-upload up-icon"></i>
                                    </label>
                                    <input id="file-input" type="file" name="update-file" onchange="uploadUpdate()"/>
                                 </div>
                                  <div id="progress" class="progress" style="display: none;">
                                    <div class="progress-bar progress-bar-striped progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%
                                  </div><br />
                       </div>
                </div>
           </div><br>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      <div class="alert alert-warning text-center">
                        <i class="fa fa-refresh"></i> UPLOAD THE UPDATE FILE PROVIDED FROM <a href="https://hololatikom.com" target="_blank">pinnocent.com</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
           <div class="tab-pane fade" id="faqs">
              <div class="tile user-timeline">
                <!-- ALERTS RESPONSE HERE-->
                <span id="faqs-response"></span>
                <!-- ALERTS RESPONSE END HERE -->
                <h4 class="line-head">FAQS</h4>              
                  <div class="row mb-12">
                    <div class="col-md-12">

                    </div>
                    </div><br><hr>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </main>
    
<?php require_once ('footer.php'); ?>