<?php require_once('header.php'); ?>
<?php
  
  $orders_data = viewadminorders($member->user_id);
  
 
  if (empty($orders_data) || strpos($orders_data, 'alert-danger') !== false || strpos($orders_data, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['orders'])) {
      $orders_data = $_SESSION['admin']['orders'];
      error_log("Using cached admin orders data from session");
    }
  }
?>
<?php do_winfo('ORDERS MANAGEMENT'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_orders');
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

echo $orders_data;
?>
<?php require_once('footer.php'); ?>
