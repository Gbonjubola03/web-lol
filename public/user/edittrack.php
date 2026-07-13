<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>

<?php
// Make sure $member is defined before using it
if (!isset($member) && isset($_SESSION['user_id'])) {
    // If $member is not defined but we have a user_id in session, try to get the member
    $member = $query->addquery('select', 'users', '*', 'i', $_SESSION['user_id'], 'user_id=?');
}

// Only try to get tracking data if $member is defined and id is provided
if (isset($member) && isset($member->user_id) && isset($_GET["id"])) {
    // Use the updatetracking function
    $tracking = updatetracking($_GET["id"], $member->user_id);
    if (!$tracking && isset($_SESSION['updatetracking'][$_GET["id"]])) {
        $tracking = $_SESSION['updatetracking'][$_GET["id"]];
    }
} else {
    $tracking = null;
}
?>

<?php do_winfo('Edit Tracking'); ?>
<?php if (!defined('eu_active')) {
    define('eu_active', 'tracking');
} ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<?php
// Check if tracking exists before outputting it
if ($tracking) {
    echo $tracking;
} else {
    echo '<div class="alert alert-warning">No tracking information available or invalid tracking ID.</div>';
}
?>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
