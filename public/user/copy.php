<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php 
  $links = fetch_links() ?: $_SESSION['user']['links'];
  $viewlinks = viewlinks($member->user_id) ?: $_SESSION['user']['viewlinks'];
  $user_stats = fetch_user_stats($member->user_id) ?: $_SESSION['user']['userstats'];

?>
<?php do_winfo('DASHBOARD'); ?>
<?php define('eu_active','dashboard'); ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

                                        
					 <div class="row">
					    <?php echo $links; ?>
					 </div>
              </div>
    </div>
    </div>
</div>
    </div>
    </main>
    <?php echo $viewlinks; ?>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>