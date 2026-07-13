<?php 
// Include required files
require_once (dirname(dirname(__FILE__)).'/preload.php');
require_once 'header.php';

// Set active page for navigation highlighting
if (!defined('eu_active')) {
    define('eu_active', 'verification');
}

// Set page title and meta information
do_winfo('Verification Badge');

// Get verification content - try to fetch from API first, fallback to session if API call fails
$verification = purchaseverification($member->user_id);

// If empty, try to get from session
if (empty($verification) || $verification == '<div class="alert alert-danger">Invalid response format from API</div>') {
    if (isset($_SESSION['user']['verification'])) {
        $verification = $_SESSION['user']['verification'];
    } elseif (isset($_SESSION['user']['userverification'])) {
        // Try alternative session key
        $verification = $_SESSION['user']['userverification'];
    }
}

// If still empty, show a default message
if (empty($verification)) {
    $verification = '<div class="alert alert-warning">
        <i class="fa fa-exclamation-circle"></i> 
        Unable to load verification content. Please try again later.
    </div>';
}
?>

<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo $verification; ?>
        </div>
    </div>
</div>

<?php 
// Include required footer files
require_once 'ajax.js.php';
require_once 'footer.php';
?>
