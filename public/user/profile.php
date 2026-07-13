<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>

<?php
  // Get the user ID from the URL parameter
  $user_id = isset($_GET['id']) ? $_GET['id'] : null;

  // If no user ID is provided, redirect to home page
  if(empty($user_id)) {
    header("Location: ".do_config(14));
    exit;
  }

  // Get user profile details using a viewcontact function
  // You'll need to create this function similar to viewpurchase
  $profile_response = viewcontact($user_id) ?: $_SESSION['user']['viewcontact'];

  // Decode the JSON response
  $profile_data = json_decode($profile_response, true);
?>

<?php do_winfo('User Profile'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'profile');
} ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   
   <!-- Display the profile details -->
   <?php
   if(isset($profile_data['status']) && $profile_data['status'] === 'success') {
       echo $profile_data['html'];
   } else {
       // Display an error message if the API call failed or returned an error
       echo '<div class="alert alert-danger">Failed to load user profile. Please try again later.</div>';
   }
   ?>
   
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
