<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>

<?php

$orders_html = vieworders($member->user_id);
?>

<?php do_winfo('ORDERS'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'orders');
} ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>


<?php echo $orders_html; ?>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
