<?php require_once ("preload.php"); ?>
<?php do_winfo('SIGN_UP'); ?>
<?php require_once (dirname(__FILE__) . '/incs/account.php');?>

<title><?php echo SITE_TITLE;?> <?php echo do_config(8);?> <?php echo do_config(1);?> </title>

<?php
 
  $signup = viewsignup();
  
 
  if (!$signup && isset($_SESSION['signup_content'])) {
    $signup = $_SESSION['signup_content'];
  }
?>

<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
  
<?php if ($signup): ?>

  <?php echo $signup; ?>
<?php else: ?>
  <div class="alert alert-danger">
    Failed to load signup content. Please try again.
  </div>
<?php endif; ?>


<?php require_once 'ajax.js.php';?>
<script src="<?php echo do_config(14);?>assets/custom/js/jquery.min.js"></script>
