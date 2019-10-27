<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 
			
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }	 
	 
	 //Meta boxes
	 $pm_ln_location_address_title_meta = get_post_meta( get_the_ID(), 'pm_ln_location_address_title_meta', true );
	 $pm_ln_location_address_meta = get_post_meta( get_the_ID(), 'pm_ln_location_address_meta', true );
	 $pm_ln_location_city_meta = get_post_meta( get_the_ID(), 'pm_ln_location_city_meta', true );
	 $pm_ln_location_province_meta = get_post_meta( get_the_ID(), 'pm_ln_location_province_meta', true );
	 $pm_ln_location_zip_meta = get_post_meta( get_the_ID(), 'pm_ln_location_zip_meta', true );
	 
	 $pm_ln_location_social_title_meta = get_post_meta( get_the_ID(), 'pm_ln_location_social_title_meta', true );
	 $pm_ln_location_twitter_meta = get_post_meta( get_the_ID(), 'pm_ln_location_twitter_meta', true );
	 $pm_ln_location_facebook_meta = get_post_meta( get_the_ID(), 'pm_ln_location_facebook_meta', true );
	 $pm_ln_location_gplus_meta = get_post_meta( get_the_ID(), 'pm_ln_location_gplus_meta', true );
	 $pm_ln_location_linkedin_meta = get_post_meta( get_the_ID(), 'pm_ln_location_linkedin_meta', true );
	 $pm_ln_location_email_address_meta = get_post_meta( get_the_ID(), 'pm_ln_location_email_address_meta', true );

?>

<article <?php post_class('pm-location-post'); ?>>
            
	<?php if(has_post_thumbnail()) { ?>
        
        <div class="col-lg-4 col-md-4 col-sm-4 pm-location-archive-post-img">                
            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title(); ?>" /></a>                                                        
        </div>
        
    <?php } ?>
 
    
    <div class="col-lg-<?php echo has_post_thumbnail() ? '8' : '12' ?> col-md-<?php echo has_post_thumbnail() ? '8' : '12' ?> col-sm-<?php echo has_post_thumbnail() ? '8' : '12' ?>">
        <a href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
        
        <?php if( !empty($pm_ln_location_address_meta) ) : ?>
            <p>
                <?php echo esc_attr($pm_ln_location_address_meta); ?> <br />
                <?php echo esc_attr($pm_ln_location_city_meta); ?>, <?php echo esc_attr($pm_ln_location_province_meta); ?> <br />
                <?php echo esc_attr($pm_ln_location_zip_meta); ?>
            </p>
        <?php endif; ?>  
        
        <?php the_excerpt(); ?>
        
        <ul class="pm-staff-profile-icons locations-post">
                        
			<?php if( !empty($pm_ln_location_twitter_meta) ) : ?>
                <li><a href="<?php echo esc_url($pm_ln_location_twitter_meta); ?>" class="fa fa-twitter" target="_blank"></a></li> 
            <?php endif; ?>
            
            <?php if( !empty($pm_ln_location_facebook_meta) ) : ?>
                <li><a href="<?php echo esc_url($pm_ln_location_facebook_meta); ?>" class="fa fa-facebook"  target="_blank"></a></li> 
            <?php endif; ?>
            
            <?php if( !empty($pm_ln_location_gplus_meta) ) : ?>
                <li><a href="<?php echo esc_url($pm_ln_location_gplus_meta); ?>" class="fa fa-google-plus"  target="_blank"></a></li> 
            <?php endif; ?>
            
            <?php if( !empty($pm_ln_location_linkedin_meta) ) : ?>
                <li><a href="<?php echo esc_url($pm_ln_location_linkedin_meta); ?>" class="fa fa-linkedin"  target="_blank"></a></li> 
            <?php endif; ?>
            
            <?php if( !empty($pm_ln_location_email_address_meta) ) : ?>
                <li><a href="mailto:<?php echo esc_attr($pm_ln_location_email_address_meta); ?>" class="fa fa-envelope"></a></li>
            <?php endif; ?>                            
            
        </ul> 
        
    </div>

</article>