<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
  // Fetch transaction view for the current user
  $transaction = viewtransaction();
 
  // If the API call fails, use the session value if available
  if (!$transaction && isset($_SESSION['transaction'])) {
    $transaction = $_SESSION['transaction'];
  }
?>
<?php do_winfo('TRANSACTION DETAILS'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'wire_transfer');
} ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<?php if ($transaction): ?>
  <!-- Display the transaction view -->
  <?php echo $transaction; ?>
<?php else: ?>
  <div class="alert alert-danger">
    Failed to load transaction details. Please try again.
  </div>
<?php endif; ?>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
