<?php require_once ('header.php'); ?>
<?php
 //catgories
 $catgories = explode(',',do_config(62));
?>
<?php define('eu_active','users'); ?>
<?php do_winfo('Edit User'); ?>
<style>
/* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid dark;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>
      <div class="row user">
       
        <div class="col-md-9">
        <?php
        // Only try to get user data if id is provided
        if (isset($_GET["id"])) {
            // Use the updateuser function
            $userdata = updateuser($_GET["id"]);
            if (!$userdata && isset($_SESSION['updateuser'][$_GET["id"]])) {
                $userdata = $_SESSION['updateuser'][$_GET["id"]];
            }
        } else {
            $userdata = null;
        }
        ?>

        <?php
        // Check if user data exists before outputting it
        if ($userdata) {
            echo $userdata;
        } else {
            echo '<div class="bs-component">
                <div class="card">
                    <h4 class="card-header">Edit User</h4>
                    <div class="card-body">
                        <div class="alert alert-warning">No user information available or invalid user ID.</div>
                    </div>
                </div>
            </div>';
        }
        ?>
        </div>
      </div>
    </main>
<?php require_once ('footer.php'); ?>