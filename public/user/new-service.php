<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
  $productform = viewproductform($member->user_id) ?: $_SESSION['viewproductform'][$member->user_id];
?>
<?php do_winfo('SELL ACCOUNTS'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'newservice');
} ?>
  
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
    
<?php echo $productform; ?>
  
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
