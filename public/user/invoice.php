<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>

<?php
  // Get invoice ID parameter
  $invoice_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Default invoice ID
  
  // Fetch invoice view
  $invoice = invoice_view($invoice_id);
  
  // If the API call fails, use the session value if available
  if (!$invoice && isset($_SESSION['invoice'][$invoice_id])) {
    $invoice = $_SESSION['invoice'][$invoice_id];
  }
?>

<?php do_winfo('INVOICE'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'invoice');
} ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   
   <?php if ($invoice): ?>
     <!-- Display the invoice -->
     <?php echo $invoice; ?>
   <?php else: ?>
     <div class="alert alert-danger">
       Failed to load invoice. Please try again.
     </div>
   <?php endif; ?>
   
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
