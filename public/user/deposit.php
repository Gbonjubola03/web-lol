<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>

<?php
  // Get user ID parameter
  $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : $member->user_id; // Default to current user
  
  // Fetch deposit view
  $deposit = deposit_view($user_id);
  
  // If the API call fails, use the session value if available
  if (!$deposit && isset($_SESSION['deposit'][$user_id])) {
    $deposit = $_SESSION['deposit'][$user_id];
  }
?>

<?php do_winfo('DEPOSIT'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'deposit');
} ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   
   <?php if ($deposit): ?>
     <!-- Display the deposit view -->
     <?php echo $deposit; ?>
   <?php else: ?>
     <div class="alert alert-danger">
       Failed to load deposit view. Please try again.
     </div>
   <?php endif; ?>
   
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
