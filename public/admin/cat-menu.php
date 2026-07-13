<?php
    if (!defined('cat_active')) {
      define('cat_active','categories');
    }
?>
   <div class="tile p-0">
       <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link<?php if(cat_active=='categories'){?> active<?php }?> text-uppercase" href="<?php echo do_config(14); ?>admin/categories">
                      <i class="fa fa-sitemap"></i> CATEGORIES
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(cat_active=='addcat'){?> active<?php }?> text-uppercase" href="<?php echo do_config(14); ?>admin/add-cat">
                      <i class="fa fa-plus-circle"></i>  ADD CATEGORY
                  </a>
              </li>
      </ul>
   </div>