<?php
/**
 * The default template for displaying a gallery post item.
 */
?>

<?php 

	$pm_services_image_meta = get_post_meta(get_the_ID(), 'pm_services_image_meta', true);
	
	$servicePostIconImage = get_theme_mod('servicePostIconImage');
	$servicePostIcon = get_theme_mod('servicePostIcon', 'fa fa-medkit');
	$displayServicePostIcon = get_theme_mod('displayServicePostIcon', 'on');
	
?>

<!-- Service post 1 -->
<div class="col-lg-4 col-md-6 col-sm-12 pm-column-spacing">
    
    <?php if( $pm_services_image_meta !== '' ) { ?>
    	<div class="pm-services-post" style="background-image:url(<?php echo esc_html($pm_services_image_meta); ?>);">
    <?php } else { ?>
    	<div class="pm-services-post no-img">
    <?php } ?>
            
        <div class="pm-services-post-overlay">
            
            
            <?php if($displayServicePostIcon === 'on') { ?>
            
            	<?php if(!empty($servicePostIconImage)) { ?>
            
                    <div class="pm-services-post-icon">
                         <?php 
                            echo '<img src="'. esc_html($servicePostIconImage) .'" width="33" height="41" alt="icon">';
                        ?>
                                            
                    </div>
                
                <?php } else { ?>
                
                    <div class="pm-services-post-icon">
                       <?php 
                            echo '<i class="'.esc_attr($servicePostIcon).'"></i>';		
                        ?>
                    </div>            
                
                <?php } ?>
            
            <?php } else { ?>
            
            	<div class="pm-services-post-icon inactive"></div>
            
            <?php } ?>            

            
            <h6 class="pm-services-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
            
        </div>
    
    </div>
    
    <div class="pm-services-post-excerpt">
        <p><?php $excerpt = get_the_excerpt(); echo pm_ln_string_limit_words($excerpt, 40); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
        
        <a href="<?php the_permalink(); ?>" class="pm-rounded-btn no-border pm-center-align"><?php esc_attr_e('Read More', 'medicallinktheme'); ?>  <i class="fa fa-plus"></i></a>
        
    </div>
    
</div>
<!-- Service post 1 end -->