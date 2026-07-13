<?php
 if (!defined('se_active')) {
     define('se_active','downloads');
 }
?>
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs text-uppercase">
              <li class="nav-item">
                  <a class="nav-link<?php if(se_active=='services'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/services">
                      <i class="fa fa-arrow-down"></i> SERVICES
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(se_active=='orders'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/orders">
                      <i class="fa fa-history"></i> ORDERS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(se_active=='verifications'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/verifications">
                      <i class="fa fa-check-circle"></i> VERIFICATIONS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(se_active=='merchants'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/merchants">
                      <i class="fa fa-bank"></i> MERCHANTS
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(se_active=='reports'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/reports">
                      <i class="fa fa-bug"></i> REPORTS
                  </a>
              </li>
            </ul>
          </div>