<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>
<?php
 
 
  
  $market_response = viewmarket();
  

  $market = $market_response ?: ($_SESSION['user']['market'] ?? '');
  

  if (empty($market)) {
    $market = "<div class='alert alert-danger'>Market data could not be loaded. Please try again later.</div>";
  }
?>

<?php 

  echo $market; 
?>
<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>
