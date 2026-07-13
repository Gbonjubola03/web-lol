<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
  // Get the order ID from the URL parameter
  $order_id = isset($_GET['id']) ? $_GET['id'] : null;
 
  // If no order ID is provided, redirect to orders page
  if(empty($order_id)) {
    header("Location: ".do_config(14).'user/orders');
    exit;
  }
 
  // Clear the cached response to ensure we get fresh data
  unset($_SESSION['user']['viewpurchase']);
 
  // Get purchase details
  $purchase_response = viewpurchase($order_id, $member->user_id);
 
  // Check if we have a valid response
  if (!$purchase_response) {
    // Log the error for debugging
    error_log("Invalid purchase response for order ID: $order_id, User ID: {$member->user_id}");
    error_log("Response: " . print_r($purchase_response, true));
    
    // Set a fallback message
    $error_message = "Unable to load order details. Please try again later.";
  } else {
    // Decode the JSON response
    $response_data = json_decode($purchase_response, true);
    
    // Check if JSON is valid and has required fields
    if (json_last_error() !== JSON_ERROR_NONE || empty($response_data) || $response_data['status'] !== 'success' || empty($response_data['html'])) {
      error_log("Invalid JSON response for order ID: $order_id, User ID: {$member->user_id}");
      error_log("Response: " . substr($purchase_response, 0, 500));
      $error_message = "Unable to process order details. Please try again later.";
    }
  }
?>
<?php do_winfo('ORDER'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'order');
} ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
<?php if (isset($error_message)): ?>
  <div class="alert alert-danger">
    <h4><i class="fa fa-exclamation-triangle"></i> Error</h4>
    <p><?php echo $error_message; ?></p>
    <p>Order ID: <?php echo htmlspecialchars($order_id); ?></p>
    <p>Response: <code><?php echo htmlspecialchars(substr($purchase_response, 0, 100) . (strlen($purchase_response) > 100 ? '...' : '')); ?></code></p>
    <a href="<?php echo do_config(14); ?>user/orders" class="btn btn-primary">Back to Orders</a>
  </div>
<?php else: ?>
  <?php echo $response_data['html']; ?>
    <!-- Report Issue Button Styling -->
  <style>
    .report-issue-btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: var(--primary-color);
      color: #fff !important;
      border-radius: 5px;
      font-weight: bold;
      transition: all 0.3s ease;
      text-decoration: none;
      margin: 15px 0;
      border: 2px solid var(--primary-color);
    }
    
    .report-issue-btn:hover {
      background-color: #fff;
      color: var(--primary-color) !important;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transform: translateY(-2px);
    }
    
    .report-issue-btn i {
      margin-right: 8px;
      font-size: 1.1em;
    }
  </style>

  <div class="row">
                <div class="col-md-6">
                    <a href="https://wa.me/<?php echo do_config(2); ?>" target="_blank" class="report-issue-btn">
                        <i class="fa fa-flag"></i> REPORT ISSUE
                    </a>
                </div>

<?php endif; ?>
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
