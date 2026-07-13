<?php require_once ('header.php'); ?>
<?php
 //files
 $previewfth = $query->limit('files','*','id','desc','0,10','i',$member->user_id,'user_id=?');
?>
<?php define('pg_active','addannouncement'); ?>
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
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
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
            <?php require_once ('an-menu.php'); ?>
        </div>
        <div class="col-md-9">
      <div class="bs-component">
          <div class="card">
              <h4 class="card-header"> ADD ANNOUNCEMENT</h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <!-- ALERTS RESPONSE HERE-->
                          <span id="addannouncement-response"></span>
                          <!-- ALERTS RESPONSE END HERE -->
                          <form id="addannouncement_form" autocomplete="off" method="POST">
                              <input type="hidden" name="addannouncement" value="addannouncement" />
                              <input type="hidden" name="csrf" value="$csrfToken"/>
                              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                              <div class="row mb-12">
                                  <div class="col-md-12 text-center">
                                     <label><i class="fa fa-check-circle"></i> UPLOAD PREVIEW</label>

                                     <div id="upload-files" class="upload-file">
                                         <label for="file-input">
                                             <i class="fa fa-cloud-upload up-icon"></i>
                                         </label>
                                         <input id="file-input" type="file" name="upload-files" onchange="uploadFile('addannouncement')"/>
                                         <br><small class="text-uppercase">(PNG / JPG / JPEG )</small>
                                         <div id="status-response"></div>
                                         <div class="col-md-12 text-center">
                                             <div id="progress" class="progress" style="display: none;">
                                                 <div class="progress-bar progress-bar-striped progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%
                                                 </div><br />
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div><hr><br/>
                            <select id="preview-response" name="preview" class="form-control text-uppercase" style="display:none;">
                                <?php while ($res= $previewfth->fetch_assoc()) { ?>
                                    <option value="<?php echo $res["path"]; ?>"><?php echo $res["name"]; ?></option>
                                <?php } ?>
                            </select><br>
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
                             </div><br />
                              <div class="row mb-12">
                                  <div class="col-md-12">
                                      <label>LINK</label>
                                      <input type="text" class="form-control" name="link" placeholder="LINK">
                                  </div>
                             </div>
                             
                             <hr>
                            <div class="row mb-10">
                              <div class="col-md-12">
                                <button type="button" onclick="addannouncementForm();" id="addannouncement-button" class="btn btn-primary">
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