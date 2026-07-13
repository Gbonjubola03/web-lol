<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php $viewwithdrawhistory = viewwithdrawhistory($member->user_id) ?: $_SESSION['user']['viewwithdrawhistory']; ?>
<?php do_winfo('WITHDRAW'); ?>
<?php define('eu_active','withdraw'); ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<div></div>

<?php $viewwithdraw = viewwithdraw($member->user_id) ?: $_SESSION['user']['viewwithdraw']; ?>


<?php 

if (is_string($viewwithdraw) && !empty($viewwithdraw)) {
    $decoded_response = json_decode($viewwithdraw, true);
    
    // If it's a valid JSON and contains an error
    if (json_last_error() === JSON_ERROR_NONE && isset($decoded_response['status']) && $decoded_response['status'] === 'error') {
        // Show a user-friendly message
        echo '<div class="alert alert-info">No withdrawal history available.</div>';
    } else {
       
        echo $viewwithdraw;
    }
} else {

    echo '<div class="alert alert-info">No withdrawal history available.</div>';
}
?>


<?php

$withdrawal_response = $viewwithdrawhistory;


if (is_string($withdrawal_response) && !empty($withdrawal_response)) {
    $decoded_response = json_decode($withdrawal_response, true);
    

    if (json_last_error() === JSON_ERROR_NONE && isset($decoded_response['status']) && $decoded_response['status'] === 'error') {
       
        echo '<div class="alert alert-info">No withdrawal history available.</div>';
    } else {

        echo $withdrawal_response;
    }
} else {
    
    echo '<div class="alert alert-info">No withdrawal history available.</div>';
}
?>

<?php require_once 'footer.php';?>
