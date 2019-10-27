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
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	$pm_staff_quote_meta = get_post_meta(get_the_ID(), 'pm_staff_quote_meta', true);
?>
                	
<div class="row">

	<div class="col-lg-4 col-md-4 col-sm-6">
    	
        <div class="pm-staff-profile-parent-container">

            <div class="pm-staff-profile-container single-post" style="background-image:url(<?php echo esc_html($pm_staff_image_meta); ?>);">
        
                <div class="pm-staff-profile-overlay-container single-post">
                
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
                        <p><?php esc_attr_e(esc_attr($pm_staff_quote_meta), 'medicallinktheme'); ?></p>
                    </div>
                
                </div>
                               
                <?php if( !empty($pm_staff_quote_meta) ) : ?>
                	<a href="#" class="pm-staff-profile-expander fa fa-plus"></a>
                <?php endif; ?>         
                
                                    
            </div>
            
            <div class="pm-staff-profile-info">
                <p class="pm-staff-profile-name"><?php the_title(); ?></p>
                <p class="pm-staff-profile-title"><?php esc_attr_e(esc_attr($pm_staff_title_meta), 'medicallinktheme'); ?></p>
            </div>
            
        </div>  
        
    </div>
    
    <div class="col-lg-8 col-md-8 col-sm-6">
    	<?php the_content(); ?>
    </div>

</div>            
<!-- Staff profile item end -->

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','pageoptions'); ?>
<?php endif; ?>