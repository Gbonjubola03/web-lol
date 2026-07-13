<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>

<?php
       // fetch page
       if(!isset($_GET['id'])){
            echo 'Error: 404 Page was not found';
            exit;
       }
      $fhpage = $query->addquery('select','pages','*','s',$_GET['id'],'link=?');
       if(!$fhpage){
            echo 'Error: 404 Page was not found';
            exit;
       }
?>
    <title><?php echo $fhpage->title; ?> <?php echo do_config(8); ?> <?php echo do_config(1); ?></title>
    <!-- CONTENT -->
    <section class="pt-8 pt-md-11 pb-8 pb-md-14">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md">

            <!-- Heading -->
            <h1 class="display-4 mb-2">
              <?php echo $fhpage->title; ?>
            </h1>

            <!-- Text -->
            <p class="fs-lg text-gray-700 mb-md-0"></p>

          </div>
          <div class="col-auto"></div>
        </div> <!-- / .row -->
        <div class="row">
          <div class="col-12">

            <!-- Divider -->
            <hr class="my-6 my-md-8">

          </div>
        </div> <!-- / .row -->
        <div class="row">
          <div class="col-12 col-md-12">

            <!-- Text -->
            <p class="fs-lg text-gray-800 mb-6 mb-md-8">
                <?php echo $fhpage->content; ?>
            </p>
          </div>
        </div>
      </div>
    </section>

<?php require_once dirname(dirname(__FILE__)).'/ajax.js.php';?>