<?php require_once('header.php'); ?>
<?php
  // Try to get the invoice data from the API
  $invoice_data = viewadmininvoice($member->user_id);
  
  // If we couldn't get data from the API, try to use cached data from session
  if (empty($invoice_data) || strpos($invoice_data, 'alert-danger') !== false || strpos($invoice_data, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['invoice'])) {
      $invoice_data = $_SESSION['admin']['invoice'];
      error_log("Using cached admin invoice data from session");
    }
  }
?>
<?php do_winfo('INVOICE MANAGEMENT'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_invoices');
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
// Output the invoice content
echo $invoice_data;
?>

<?php require_once('footer.php'); ?>
