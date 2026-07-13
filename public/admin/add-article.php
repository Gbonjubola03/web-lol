<?php require_once ('header.php'); ?>
<?php
 //catgories
 $previewfth = $query->limit('files','*','id','desc','0,10','i',$member->user_id,'user_id=?');

?>
<?php define('pg_active','addarticle'); ?>
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
        <div class="tile p-0">
       <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='pages'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/articles">
                      <i class="fa fa-files-o"></i> ARTICLES
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='addpage'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/add-article">
                      <i class="fa fa-plus-circle"></i> ADD ARTICLES
                  </a>
              </li>
      </ul>
   </div>
      <div class="bs-component">
          <div class="card">
              <h4 class="card-header"> ADD ARTICLE</h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <!-- ALERTS RESPONSE HERE-->
                          <span id="addarticle-response" class="text-uppercase"></span>
                          <!-- ALERTS RESPONSE END HERE -->
                          <form id="addarticle_form" autocomplete="off" method="POST">
                              <input type="hidden" name="addarticle" value="addarticle" />
                              <input type="hidden" name="csrf" value="$csrfToken"/>
                              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                              <div class="row mb-12">
                                  <div class="col-md-12 text-center">
                                     <label><i class="fa fa-check-circle"></i> UPLOAD PREVIEW</label>

                                     <div id="upload-files" class="upload-file">
                                         <label for="file-input">
                                             <i class="fa fa-cloud-upload up-icon"></i>
                                         </label>
                                         <input id="file-input" type="file" name="upload-files" onchange="uploadFile('addarticle')"/>
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
                             </div>
                             <hr>
                            <div class="row mb-10">
                              <div class="col-md-12">
                                <button type="button" onclick="addarticleForm();" id="addarticle-button" class="btn btn-primary">
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