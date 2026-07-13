<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>
<?php
  if(!isset($_GET['id'])){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
  if(!isset($_GET['link'])){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
 
  $serviceid = $_GET['id'];
  $servicelink = $_GET['link'];
  $service = fetch_service($serviceid, $servicelink);
 
  if(!$service){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }

  // Check if service is a string (error message) or an object
  if (is_string($service) && strpos($service, 'alert-danger') !== false) {
      echo $service;
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }

  // Set page title and meta info
  do_winfo(is_object($service) && isset($service->name) ? $service->name : 'Service Details');

  // Set active menu item
  if (!defined('eu_active')) {
      define('eu_active', 'service');
  }
?>

<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<?php
  // Simply echo the service content
  echo $service;
?>


<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>