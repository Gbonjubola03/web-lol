<?php require_once('header.php'); ?>
<?php
  // Try to get the withdrawal data from the API
  $withdrawal_data = viewadminwithdraw($member->user_id);
  
  // If we couldn't get data from the API, try to use cached data from session
  if (empty($withdrawal_data) || strpos($withdrawal_data, 'alert-danger') !== false || strpos($withdrawal_data, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['withdrawal'])) {
      $withdrawal_data = $_SESSION['admin']['withdrawal'];
      error_log("Using cached admin withdrawal data from session");
    }
  }
?>
<?php do_winfo('WEBSITE EARNINGS WITHDRAWAL'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_withdraw');
} ?>
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> <?php echo SITE_TITLE;?> - Withdraw Earnings</h1>
          <p>Withdraw your website earnings to your bank account</p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
<?php
// Output the withdrawal content
echo $withdrawal_data;
?>
<?php require_once('footer.php'); ?>
