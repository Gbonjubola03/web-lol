<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
$services_html = viewservices($member->user_id);
?>
<?php do_winfo('SERVICES'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'services');
} ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
<?php echo $services_html; ?>
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
