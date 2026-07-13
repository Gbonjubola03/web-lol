<?php require_once('header.php'); ?>
<?php
  // Try to get the services data from the API
  $services_data = viewadminservices($member->user_id);
  
  // If we couldn't get data from the API, try to use cached data from session
  if (empty($services_data) || strpos($services_data, 'alert-danger') !== false || strpos($services_data, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['services'])) {
      $services_data = $_SESSION['admin']['services'];
      error_log("Using cached admin services data from session");
    }
  }
?>
<?php do_winfo('SERVICES MANAGEMENT'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_services');
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
// Output the services content
echo $services_data;
?>

<?php require_once('footer.php'); ?>
