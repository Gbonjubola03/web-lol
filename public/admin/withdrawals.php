<?php require_once('header.php'); ?>
<?php
  // Try to get the withdrawals data from the API
  $withdrawals_data = viewadminwithdrawals($member->user_id);
  
  // If we couldn't get data from the API, try to use cached data from session
  if (empty($withdrawals_data) || strpos($withdrawals_data, 'alert-danger') !== false || strpos($withdrawals_data, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['withdrawals'])) {
      $withdrawals_data = $_SESSION['admin']['withdrawals'];
      error_log("Using cached admin withdrawals data from session");
    }
  }
?>
<?php do_winfo('WITHDRAWALS MANAGEMENT'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_withdrawals');
} ?>
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-exchange-alt"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
<?php
// Output the withdrawals content
echo $withdrawals_data;
?>
<?php require_once('footer.php'); ?>
