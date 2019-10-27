<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs', 'on'); ?>




<!-- Breadcrumbs -->
<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>

	<?php if( is_shop() || is_product() || is_product_category() || is_product_tag()  ) { ?>
	
		<?php if($enableBreadCrumbs === 'on') : ?>
                    
            <div class="pm-sub-header-breadcrumbs">
            	
                <div class="container">
                	<div class="row">
                    	<div class="col-lg-12">
                            
                            <?php				
								$args = array(
										'delimiter' => '',
										'wrap_before' => '<ul class="pm-breadcrumbs">',
										'wrap_after' => '</ul>',
										'before' => '<li>',
										'after' => '</li>',
								);
							?>
							
							<?php woocommerce_breadcrumb( $args ); ?>
                            
                            <?php if(is_single()) : ?>
                            	<ul class="pm-post-navigation">
                                    <li class="pm_tip_static_top" title="<?php _e('Prev. Post', 'medicallinktheme'); ?>"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
                                    <li class="pm_tip_static_top" title="<?php _e('Next Post', 'medicallinktheme'); ?>"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
                                </ul>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        
        <?php endif; ?>
		
	<?php } else { ?>
	
		<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
			
			<?php if($enableBreadCrumbs === 'on'){ ?>
            
            		<div class="pm-sub-header-breadcrumbs">
            	
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    
                                    
                                    <?php pm_ln_breadcrumbs();  ?>
                                    
                                    <?php if(is_single()) : ?>
                                        <ul class="pm-post-navigation">
                                            <li class="pm_tip_static_top" title="Prev. Post"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
                                        	<li class="pm_tip_static_top" title="Next Post"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
                                        </ul>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
            
                    
                    
			<?php } ?>
		
		<?php endif ?>    
	
	<?php } ?>	

<?php } else {//Woocommerce not enabled ?>

	<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
		
		<?php if($enableBreadCrumbs === 'on'){ ?>
				
                <div class="pm-sub-header-breadcrumbs">
            	
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <?php pm_ln_breadcrumbs();  ?>
                                
                                <?php if(is_single()) : ?>
                                    <ul class="pm-post-navigation">
                                        <li class="pm_tip_static_top" title="Prev. Post"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
                                        <li class="pm_tip_static_top" title="Next Post"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
                                    </ul>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                
		<?php } ?>
	
	<?php endif ?>  

<?php } ?>