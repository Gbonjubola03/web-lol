<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/account.php';?>
<?php
  // Set page title
  do_winfo('FORGOT PASSWORD');
  
  // Get the forgot password content
  $forgetpassword_response = forgetpassword();
  
  // Fallback to session data if available
  $forget = $forgetpassword_response ?: ($_SESSION['user']['forget'] ?? '');
  
  // Default error message if no content is available
  if (empty($forget)) {
    $forget = "<div class='alert alert-danger'>Forgot password form could not be loaded. Please try again later.</div>";
  }
?>

<?php 
  // Output the content
  echo $forget; 
?>
<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>
