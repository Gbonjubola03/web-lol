<?php require_once('header.php'); ?>
<?php
  $dashboard = viewadmindashboard($member->user_id);
  if (empty($dashboard) || strpos($dashboard, 'alert-danger') !== false || strpos($dashboard, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['dashboard'])) {
      $dashboard = $_SESSION['admin']['dashboard'];
      error_log("Using cached admin dashboard data from session");
    }
  }
?>
<?php do_winfo('ADMIN DASHBOARD'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_dashboard');
} ?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-cog"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
          
<?php 

echo $dashboard; 
?>


<?php require_once('footer.php'); ?>
