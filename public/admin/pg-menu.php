<?php
    if (!defined('pg_active')) {
        define('pg_active','pages');
    }
?>
   <div class="tile p-0">
       <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='pages'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/pages">
                      <i class="fa fa-files-o"></i> PAGES
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='addpage'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/add-page">
                      <i class="fa fa-plus-circle"></i> ADD PAGE 
                  </a>
              </li>
      </ul>
   </div>