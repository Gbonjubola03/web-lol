<?php
    if (!defined('pg_active')) {
        define('pg_active','announcements');
    }
?>
   <div class="tile p-0">
       <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='announcements'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/announcements">
                      <i class="fa fa-bullhorn"></i> ANNOUNCEMENTS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='addannouncement'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/add-announcement">
                      <i class="fa fa-plus-circle"></i> ADD ANNOUNCEMENT 
                  </a>
              </li>
      </ul>
   </div>