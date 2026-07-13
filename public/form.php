<?php require_once ('preload.php'); ?>
<?php
  if(!isset($_GET['ref']) || empty(trim($_GET['ref']))){
      echo "NOT FOUND";
      exit;
  }
  $id = $_GET['ref'];
  $form = $query->addquery('select','templates','*','i',$id,'id=?');
  if($form->status == 2){
      echo "INACTIVE FORM";
      exit;
  }
?>
<?php do_winfo('login'); ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   <?php echo $form->content; ?>