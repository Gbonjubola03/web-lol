<?php require_once ('header.php'); ?>
<?php do_winfo('Page not found'); ?>
   <title><?php echo site1_title.' '.do_config(8).' '.do_config(1); ?></title>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-warning"></i> <?php echo site1_title;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
        <div class="card">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <div class="page-error alert alert-danger">
                        <h3><i class="fa fa-warning"></i> Error 404: Page not found</h3>
                        <p>The page you have requested is not found.</p>
                        <p><a class="btn btn-primary btn-sm" href="javascript:window.history.back();">Go Back</a></p>
                      </div>
                    </div>
                  </div>
             </div>
       </div>
    </main>
<?php require_once ('footer.php'); ?>