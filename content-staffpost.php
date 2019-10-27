<?php
/**
 * The default template for displaying a staff post item.
 */
?>

<?php 
            
	$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
	$pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
	$pm_staff_quote_meta = get_post_meta(get_the_ID(), 'pm_staff_quote_meta', true);
	
	$pm_staff_post_view_btn_text = get_option('pm_staff_post_view_btn_text');
	
?>

<?php 
$terms = get_the_terms($post->ID, 'staff_cats' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>


<div class="isotope-item col-lg-4 col-md-4 col-sm-12 col-xs-12 pm-column-spacing <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all" style="margin-bottom:0px;">
                	
    <!-- Staff profile -->
    <div class="pm-staff-profile-parent-container">
    
        <div class="pm-staff-profile-container" style="background-image:url(<?php echo esc_html($pm_staff_image_meta); ?>);">
    
            <div class="pm-staff-profile-overlay-container">
            
                <ul class="pm-staff-profile-icons">
                
                	
                    <?php if($pm_staff_twitter_meta !== '') : ?>
                    
                        <li>
                            <a href="<?php echo esc_html($pm_staff_twitter_meta); ?>" target="_blank" class="fa fa-twitter"></a>
                        </li>
                    
                    <?php endif; ?>
                
                    <?php if($pm_staff_facebook_meta !== '') : ?>
                    
                        <li>
                            <a href="<?php echo esc_html($pm_staff_facebook_meta); ?>" target="_blank" class="fa fa-facebook"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_gplus_meta !== '') : ?>
                    
                        <li>
                            <a href="<?php echo esc_html($pm_staff_gplus_meta); ?>" target="_blank" class="fa fa-google-plus"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_linkedin_meta !== '') : ?>
                    
                        <li>
                            <a href="<?php echo esc_html($pm_staff_linkedin_meta); ?>" target="_blank" class="fa fa-linkedin"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_email_address_meta !== '') : ?>
                    
                        <li>
                            <a href="mailto:<?php echo esc_attr($pm_staff_email_address_meta); ?>" target="_blank" class="fa fa-envelope"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                </ul>
                
                <div class="pm-staff-profile-quote">
                
                    <p><?php echo esc_attr($pm_staff_quote_meta); ?></p>
                    
                    <?php if( !empty($pm_staff_post_view_btn_text) ) { ?>
                    	<a href="<?php the_permalink(); ?>" class="pm-square-btn pm-center-align"><?php echo esc_attr($pm_staff_post_view_btn_text); ?></a>
                    <?php } else { ?>
                    	<a href="<?php the_permalink(); ?>" class="pm-square-btn pm-center-align"><?php esc_attr_e('View profile', 'medicallinktheme') ?></a>
                    <?php } ?>
                    
                </div>
            
            </div>
            
            <?php if( !empty($pm_staff_quote_meta) ) { ?>
            	<a href="#" class="pm-staff-profile-expander fa fa-plus"></a>
            <?php } else { ?>
            	<a href="<?php the_permalink(); ?>" class="pm-staff-profile-expander fa fa-plus"></a>
            <?php } ?>
                                    
            
                                
        </div>
        
        <div class="pm-staff-profile-info">
            <p class="pm-staff-profile-name"><?php the_title(); ?></p>
            <p class="pm-staff-profile-title"><?php esc_attr_e(esc_attr($pm_staff_title_meta), 'medicallinktheme'); ?></p>
        </div>
        
    </div>                    
    <!-- Staff profile end -->
    
</div>