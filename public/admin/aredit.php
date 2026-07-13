<?php require_once ('header.php'); ?>
<?php
 //catgories
 //$catgories = explode(',',do_config(62));
?>
<?php define('pg_active','articles'); ?>
<?php do_winfo('EDIT'); ?>
  
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-pencil"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
      <div class="row user">
        <div class="col-md-3">
            <?php require_once ('ar-menu.php'); ?>
        </div>
        <div class="col-md-9">
      <div class="bs-component">
          <div class="card">
              <h4 class="card-header"> EDIT #<?php echo $_GET["id"];?></h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                        <?php if (!isset($_GET["id"])){ ?>
                        <div class="'alert alert-danger"> 'Error: Something wrong, Please try again.</div>
                        <?php }else{ ?>
                        <?php 
                                    $data = $query->addquery('select','articles','*','i', $_GET["id"],'id=?');
                                    if(!$data){
                        ?>
                        <div class="'alert alert-danger"> 'Error: Something wrong, Please try again.</div>
                        <?php
                                    }
                        ?>
                          <!-- ALERTS RESPONSE HERE-->
                          <span id="editarticle-response"></span>
                          <!-- ALERTS RESPONSE END HERE -->
                          <form id="editarticle_form" autocomplete="off" method="POST">
                              <input type="hidden" name="editarticle" value="editarticle" />
                              <input type="hidden" name="csrf" value="$csrfToken"/>
                              <input type="hidden" name="id" value="<?php echo $data->id;?>"/>
                              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                              
                              <div class="row mb-12">
                                  <div class="col-md-12">
                                     <label>TITLE</label>
                                     <input type="text" class="form-control" name="title" placeholder="title" value="<?php echo $data->title;?>">
                                </div>
                             </div><br />
                              <div class="row mb-12">
                                  <div class="col-md-12">
                                      <label>CONTENT</label>
                                      <textarea type="text" class="form-control" name="content"><?php echo $data->content;?></textarea>
                                  </div>
                             </div><hr>
                            <div class="row mb-10">
                              <div class="col-md-12">
                                <button type="button" onclick="editarticleForm();" id="editarticle-button" class="btn btn-primary">
                                  <span id="icon-button"><i class="fa fa-pencil"></i></span>
                                  <span id="button-loader" style="display:none;">
                                    <i class="fa fa-spinner fa-spin"></i>
                                 </span>
                                  EDIT
                              </button>
                              </div>
                            </div>
                        </form>
                        <?php } ?>
                      </div>
                  </div>
              </div>
              <div class="card-footer text-muted">
                  <strong>
                  <i class="fa fa-cog"></i> <a href="config"> CONFIGURATION</a>
                  </strong>
              </div>
          </div>
        </div>
        </div>
      </div>
    </main>
<?php require_once ('footer.php'); ?>