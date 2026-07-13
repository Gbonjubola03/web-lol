<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); 

// Check if user is logged in
if(!logged) {
    header('location: '.do_config(14).'login');
    exit;
}

// Check if ID parameter is provided
if(!isset($_GET["id"]) || empty($_GET["id"])) {
    echo '<div class="alert alert-danger">Invalid shipment ID</div>';
    exit;
}

// Get the shipment ID
$id = intval($_GET["id"]);

// Simply output the viewprint function result
echo viewprint($id);
?>
