<?php require_once('header.php'); ?>

<?php
  $users_data = viewadminusers($member->user_id);
  if (empty($users_data) || strpos($users_data, 'alert-danger') !== false || strpos($users_data, 'alert-warning') !== false) {
    if (isset($_SESSION['admin']['users'])) {
      $users_data = $_SESSION['admin']['users'];
      error_log("Using cached admin users data from session");
    }
  }
?>
<?php do_winfo('USER MANAGEMENT'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'admin_users');
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
echo $users_data;
?>
<?php require_once('footer.php'); ?>
