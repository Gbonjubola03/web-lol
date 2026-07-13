<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php do_winfo('USER DETAILS'); ?>
<?php define('eu_active','users'); ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<nav class="bg-dark d-md-none">
  <div class="container-md">
    <div class="row align-items-center">
      <div class="col">
      </div>
      <div class="col-auto">
      </div>
    </div>
  </div>
</nav>


<div class="col-12 col-md-9">
  <!-- Card -->
  <div class="row">
    <?php 
    // Try to fetch user details - with PHP 8.2 compatibility
    try {
        if (isset($member) && isset($member->user_id)) {
            // Clear previous session data to ensure fresh content
            if (isset($_SESSION['user']['tbl_users'])) {
                unset($_SESSION['user']['tbl_users']);
            }
            
            // Fetch user table data
            $tbl_users = fetch_tbl_users($member->user_id);
            
            // Display the result or error
            echo $tbl_users;
        } else {
            echo '<div class="alert alert-danger">Error: User not logged in or user ID not available</div>';
        }
    } catch (Throwable $e) {
        // PHP 8.2 uses Throwable interface for all exceptions
        error_log("Exception in bank.php: " . $e->getMessage());
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    ?>
  </div>
</div>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>
