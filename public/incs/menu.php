		<div class="on-desktop">
					  <ul class="nav nav-pills mb-3 wd-tab-menu col-7 text-uppercase" id="pills-tab" role="tablist">
					    <li class="nav-item col-6 col-md">
					      <a href="<?php echo do_config(14).'item/'.$item->link?>/" class="nav-link <?php if(it_active == 'desc'){?>active<?php } ?>">
					          <i class="fa fa-file-text"></i> <?php echo _DESCRIPTION?>
					      </a>
					    </li>
					    <li class="nav-item col-6 col-md">
					      <a href="<?php echo do_config(14).'item/'.$item->link?>/comments" class="nav-link <?php if(it_active == 'comments'){?>active<?php } ?>">
					          <i class="fa fa-comment"></i> <?php echo _COMMENTS?> <span class="badge badge-secondary"><?php echo $comments; ?></span>
					      </a>
					    </li>
					  </ul>
	    </div>
		<div class="on-phone">
		    <div class="card col-12">
		        <div class="card-body">
		            <select class="form-control" onchange="document.location.href=this.options[this.selectedIndex].value;">
		                <option value="<?php echo do_config(14).'item/'.$item->link?>/" <?php if(it_active == 'desc'){?>selected<?php } ?>>
		                    <?php echo _DESCRIPTION?>
		                </option>
		                <option value="<?php echo do_config(14).'item/'.$item->link?>/comments" <?php if(it_active == 'comments'){?>selected<?php } ?>>
		                    <?php echo _COMMENTS?> (<?php echo $comments; ?>)
		                </option>
		            </select>
		        </div>
		    </div>
		    <div class="empty-h"></div>
	    </div>