<?php
    if (!defined('eu_active')) {
        define('eu_active','scripts');
    }
?>
   <div class="tile p-0">
       <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link<?php if(eu_active=='links'){?> active<?php }?> text-uppercase" href="<?php echo do_config(14); ?>admin/links">
                      <i class="fa fa-code"></i> LINKS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(eu_active=='addlink'){?> active<?php }?> text-uppercase" href="<?php echo do_config(14); ?>admin/add-link">
                      <i class="fa fa-plus"></i> NEW LINK
                  </a>
              </li>
      </ul>
   </div>