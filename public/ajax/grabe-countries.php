<?php
  require_once (dirname(dirname(__FILE__))."/preload.php");
  if(!logged){
      echo 'error';
      exit;
  }
     if(isset($_POST['country-type']) && !empty(trim($_POST['country-type']))){
      $type = $_POST['country-type'];
      switch($type){
          default:
                 echo '<div class="row mb-12">
                          <div class="col-md-12">
                          <label class="text-uppercase">COUNTRIES</label>
                          <select class="form-control text-uppercase" name="countries[]" multiple="">';
                              /* availble countries */
                              foreach (explode(',',do_config(23)) as $country) {
                                  echo '<option value="'.trim($country).'">'.trim($country).'</option>';
                              }
                 
                 echo '</select>
                       </div></div><br />';
          break;
          case 'all':
              echo '<br />';
          break;
      }
  }
?>