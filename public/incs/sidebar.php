							<div class="product-details-gallery">
							   
		                     <!-- ALERTS RESPONSE HERE-->
		                     <span id="purchase-response" class="text-uppercase"></span>
		                     <!-- ALERTS RESPONSE END HERE -->
						        <div class="card">
							      <div class="card-body">
								   <div class="list-group">
									<h4 class="list-group-item-heading product-title">
										<?php echo $item->name; ?>
									</h4>
									<div class="media">
										<div class="media-left media-middle">
											<div class="rating">
											    <?php echo str_repeat('<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>',number_format(5-$item->stars)); ?>
											    <?php echo str_repeat('<a href="#"><i class="fa fa-star star-active-color" aria-hidden="true"></i></a>',$item->stars); ?>
											</div>
										</div>
										<div class="media-body">
											<p><span class="product-ratings-text"><?php echo $reviews; ?> <?php echo _RATINGS?></span></p>
										</div>
									</div>
								</div>
							      </div>
						        </div>
						        <div class="product-informations">
						      <?php if (logged){ ?>
						            <!-- Purchase form -->
								   <div class="list-group content-list">
								    <div class="alert alert-success box-action" role="alert" itemscope="" itemtype="http://schema.org/Product">
								        <meta itemprop="name" content="<?php echo $item->name; ?>">	 
								        <hr class="on-phone">
								        <span class="price-box">
								           <div class="pull-left">
								            <?php echo $item->price; ?>$
								           </div>
								           <div class="pull-right">
								            <i class="fa fa-lock"></i>
								           </div>
								        </span>
								        <hr>
								        <p><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo _VERIFIED_PRODUCT?></p>
								        <p><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo _LOWEST_PRICE_GUARANTEED?></p> 
								        <div class="text">
								            <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
								                <meta itemprop="price" content="<?php echo $item->price; ?>">
								                <meta itemprop="priceCurrency" content="USD">
										        <meta itemprop="availability" content="instock" />

								            <!-- Person -->
								            <div class="data-none" itemscope="" itemprop="seller" itemtype="http://schema.org/Person" style="display: none;">
								                <div itemprop="url"><?php echo do_config(14); ?></div>
								                <div itemprop="name"><?php echo do_config(1); ?></div>
								                <div itemprop="image"><?php echo do_config(1); ?></div>
								            </div>
								          </div>
								        </div>
								        <div class="col-12"><hr>
								<?php if ($item->status == 1){?>
										<p class="text-center">
										    <a href="<?php echo do_config(14)?>user/deposit"><i class="fa fa-check"></i> <?php echo _MAKE_DEPOSIT?></a>
										</p>
								<?php }elseif ($item->status == 3){?>
										<p class="text-center">
										    <i class="fa fa-history"></i> ITEM TEMPORARILY NOT AVAILBLE
										</p>
								<?php }elseif ($item->status == 4){?>
										<p class="text-center">
										    <i class="fa fa-times"></i> ITEM NO LONGER AVAILBLE
										</p>
								<?php } ?>
								        </div>
								        <div class="col-12 product-store-box on-desktop">
								    <?php if ($item->status == 1){?>
										<form id="frm_purchase" name="frm_purchase" method="POST">
										    <input type="hidden" name="purchase" value="purchase" />
										    <input type="hidden" name="csrfToken" value="<?php echo csrf_token()?>" />
										    <input type="hidden" id="license" name="license" value="standard-license" />
										    <input type="hidden" name="item_id" value="<?php echo $item->id?>" />
										    <br>
										    
										<div class="col-12">
										    <p class="text-center">
										        <small>
										            <b><i class="fa fa-arrow-right"></i> COMPLETE PURCHASE</b>
										        </small>
                                            </p>
										</div><hr>
								        <div class="row">
									    <div class="col-8 store-border-img">
									        <img src="<?php echo do_config(14); ?>assets/custom/img/verified.svg" width="170" height="40" alt="verified" title="verified">	
								        </div>
										<div class="col-4 store-border-button">
										    <button onclick="purchaseForm();" id="purchase-button" type="submit" class="btn btn-primary btn-btx wd-shop-btn pull-right text-uppercase">
										        <span id="purchase-icon-button"><i class="fa fa-check-circle"></i></span>
										        <span id="purchase-button-loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>	
										        <?php echo _PURCHASE?>
											</button><br>
										</div>
										</div>
										</form>
									<?php } ?>	
								        </div>
								        <div class="col-12 product-store-box on-phone">
								          <center>
									        <img src="<?php echo do_config(14); ?>assets/custom/img/verified.svg" width="170" height="40" alt="verified" title="verified">	
                                            <div class="empty-h"></div>
											<button onClick = "AddCart('{$product_id}')"  class="btn btn-primary btn-btx wd-shop-btn">
												<i class="fa fa-shopping-cart"></i> <?php echo _PURCHASE?>
											</button>
										  </center>
								       </div>
								    </div>
						 	       </div>
							  <?php }else{ ?>
								   <div class="list-group content-list">
								    <div class="alert alert-success box-action" role="alert" itemscope="" itemtype="http://schema.org/Product">
								        <meta itemprop="name" content="<?php echo $item->name; ?>">	 
								        <hr class="on-phone">
								        <span class="price-box">
								           <div class="pull-left">
								            <?php echo $item->price; ?>$
								           </div>
								           <div class="pull-right">
								            <i class="fa fa-lock"></i>
								           </div>
								        </span><hr>
								        <p><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo _VERIFIED_PRODUCT?></p>
								        <p><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo _LOWEST_PRICE_GUARANTEED?></p> 
								        <div class="text">
								            <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
								                <meta itemprop="price" content="<?php echo $item->price; ?>">
								                <meta itemprop="priceCurrency" content="USD">
										        <meta itemprop="availability" content="instock" />

								            <!-- Person -->
								            <div class="data-none" itemscope="" itemprop="seller" itemtype="http://schema.org/Person" style="display: none;">
								                <div itemprop="url"><?php echo do_config(14); ?></div>
								                <div itemprop="name"><?php echo do_config(1); ?></div>
								                <div itemprop="image"><?php echo do_config(1); ?></div>
								            </div>
								          </div>
								        </div>
								        <div class="col-12 product-store-box on-desktop">
								        <hr>
									    <div class="col-12">
									        <p class="text-center text-uppercase">
									            <i class="fa fa-check"></i> PLEASE REGISTER OR LOGIN TO ORDER.
									        </p>
									    </div>
								</div>
								<div class="col-12 product-store-box on-phone">
								    <center>
                                            <div class="empty-h"></div><hr>
									        <p class="text-center text-uppercase">
									            <i class="fa fa-check"></i> PLEASE REGISTER OR LOGIN TO ORDER.
									        </p>
									</center>
								</div>
								</div>
							</div>
							  <?php } ?>
							</div>
							</div>
							<div class="product-informations">
						            <ul class="list-group wd-info-section">
									<li class="list-group-item d-flex justify-content-between align-items-center p0">
										<div class="col-12 col-md-6 info-section">
											<p><?php echo _CREATED?></p>
										</div>
										<div class="col-12 col-md-5 info-section">
											<p><?php echo date('M j Y g:i A', strtotime($item->created));?></p>
										</div>
										<div class="col-1"></div>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p0">
										<div class="col-12 col-md-6 info-section">
											<p><?php echo _CATEGORY?></p>
										</div>
										<div class="col-12 col-md-5 info-section">
											<p><?php echo do_catparent($item->category)?></p>
										</div>
										<div class="col-1"></div>
									</li>
								</ul>
						        </div>
						        <div class="card">
							      <div class="card-body">
								   <div class="list-group">
                                   <p class="tags-block">
                                       <?php echo do_buildtags($item->tags)?>
                                   </p>
								</div>
							      </div>
						        </div>