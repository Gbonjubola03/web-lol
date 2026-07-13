<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
// Make sure $member is defined before using it
if (!isset($member) && isset($_SESSION['user_id'])) {
    // If $member is not defined but we have a user_id in session, try to get the member
    $member = $query->addquery('select', 'users', '*', 'i', $_SESSION['user_id'], 'user_id=?');
}

// Only try to get shipment if $member is defined
if (isset($member) && isset($member->user_id)) {
    // Use the new shipmentpage function instead of viewshipment
    $shipment = shipmentpage($member->user_id);
    if (!$shipment && isset($_SESSION['shipmentpage'][$member->user_id])) {
        $shipment = $_SESSION['shipmentpage'][$member->user_id];
    }
} else {
    $shipment = null;
}
?>
<?php do_winfo('shipment'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'shipment');
} ?> 
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   
<?php
// Check if shipment exists before outputting it
if ($shipment) {
    echo $shipment;
} else {
    echo '<div class="alert alert-warning">No shipment information available. Please create a shipment first.</div>';
}
?> 
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
