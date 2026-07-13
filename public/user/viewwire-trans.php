<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
  // Check if we're viewing a specific wire transfer
  $wire_id = isset($_GET['wire_id']) ? intval($_GET['wire_id']) : null;
  
  if ($wire_id) {
    // Fetch specific wire transfer details
    $wire = viewwire($wire_id);
    
    // If the API call fails, use the session value if available
    if (!$wire && isset($_SESSION['wire'][$wire_id])) {
      $wire = $_SESSION['wire'][$wire_id];
    }
    
    do_winfo('WIRE TRANSFER DETAILS');
    if (!defined('eu_active')) {
      define('eu_active', 'wire_details');
    }
  } else {
    // Fetch transaction view for the current user
    $transaction = viewtransaction();
    
    // If the API call fails, use the session value if available
    if (!$transaction && isset($_SESSION['transaction'])) {
      $transaction = $_SESSION['transaction'];
    }
    
    do_winfo('TRANSACTION DETAILS');
    if (!defined('eu_active')) {
      define('eu_active', 'wire_transfer');
    }
  }
?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<?php if (isset($wire_id) && $wire): ?>
  <!-- Display the wire transfer details -->
  <?php echo $wire; ?>
<?php elseif (isset($transaction) && $transaction): ?>
  <!-- Display the transaction view -->
  <?php echo $transaction; ?>
<?php else: ?>
  <div class="alert alert-danger">
    Failed to load details. Please try again.
  </div>
<?php endif; ?>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
