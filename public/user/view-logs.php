<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php

  $viewvictim = view_victim($member->user_id) ?: $_SESSION['user']['viewvictim'];
 
?>
<?php define('eu_active','viewvictim'); ?>
<?php do_winfo('VIEW VICTIM'); ?>
<?php
  $premium_content = viewpremium($member->user_id) ?: $_SESSION['user']['premium'];
?>
<?php echo $premium_content; ?>
              <div class="card-body">
                  <?php if(isset($_GET["message"])){ ?>
                  <div class="alert alert-warning"><?php echo $_GET["message"]; ?></div>
                  <?php }?>
                  <?php echo $viewvictim; ?>
  
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>