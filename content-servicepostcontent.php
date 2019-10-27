<?php
/**
 * The default template for displaying a staff post item.
 */
?>

<?php 

	$pm_services_image_meta = get_post_meta(get_the_ID(), 'pm_services_image_meta', true);
	$servicePostIconImage = get_theme_mod('servicePostIconImage');
	$servicePostIcon = get_theme_mod('servicePostIcon', 'fa fa-medkit');
	$displayServicePostIcon = get_theme_mod('displayServicePostIcon', 'on');
	
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	
?>
      
<div class="pm-services-post single-post">
		
    <img src="<?php echo esc_url(esc_html($pm_services_image_meta)); ?>" alt="<?php the_title(); ?>" />
        
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
		
		<h6 class="pm-services-post-title"><a><?php the_title(); ?></a></h6>
		
	</div>

</div>

<?php the_content(); ?>


<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','pageoptions'); ?>
<?php endif; ?>