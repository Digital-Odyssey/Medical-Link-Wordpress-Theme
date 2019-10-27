<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $enableTooltip = get_theme_mod('enableTooltip', 'on');
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }	 
	 
	 //Meta boxes
	 $pm_ln_location_address_title_meta = get_post_meta( $post->ID, 'pm_ln_location_address_title_meta', true );
	 $pm_ln_location_address_meta = get_post_meta( $post->ID, 'pm_ln_location_address_meta', true );
	 $pm_ln_location_city_meta = get_post_meta( $post->ID, 'pm_ln_location_city_meta', true );
	 $pm_ln_location_province_meta = get_post_meta( $post->ID, 'pm_ln_location_province_meta', true );
	 $pm_ln_location_zip_meta = get_post_meta( $post->ID, 'pm_ln_location_zip_meta', true );
	 
	 $pm_ln_location_gmap_lat_meta = get_post_meta( $post->ID, 'pm_ln_location_gmap_lat_meta', true );
	 $pm_ln_location_gmap_long_meta = get_post_meta( $post->ID, 'pm_ln_location_gmap_long_meta', true );
	 $pm_ln_location_gmap_message_meta = get_post_meta( $post->ID, 'pm_ln_location_gmap_message_meta', true );
	 $pm_ln_location_gmap_height_meta = get_post_meta( $post->ID, 'pm_ln_location_gmap_height_meta', true );
	 
	 $pm_ln_location_social_title_meta = get_post_meta( $post->ID, 'pm_ln_location_social_title_meta', true );
	 $pm_ln_location_twitter_meta = get_post_meta( $post->ID, 'pm_ln_location_twitter_meta', true );
	 $pm_ln_location_facebook_meta = get_post_meta( $post->ID, 'pm_ln_location_facebook_meta', true );
	 $pm_ln_location_gplus_meta = get_post_meta( $post->ID, 'pm_ln_location_gplus_meta', true );
	 $pm_ln_location_linkedin_meta = get_post_meta( $post->ID, 'pm_ln_location_linkedin_meta', true );
	 $pm_ln_location_email_address_meta = get_post_meta( $post->ID, 'pm_ln_location_email_address_meta', true );
	 
	 $pm_ln_location_disable_share = get_post_meta( $post->ID, 'pm_ln_location_disable_share', true );
	              
?>

<!-- PANEL 1 -->
<div class="container pm-containerPadding110">

    <div class="row">
        <div class="col-lg-12 pm-single-location-post-column">
        
        	<div class="row">
            	                
                <!-- Post image -->
                
                
                <div class="col-lg-<?php echo has_post_thumbnail() ? '6' : '12' ?> col-md-<?php echo has_post_thumbnail() ? '6' : '12' ?> col-sm-<?php echo has_post_thumbnail() ? '6' : '12' ?> pm-location-post-img-column">
                
                    <?php if(has_post_thumbnail()) { ?>
                        <img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title(); ?>" />
                    <?php } ?>
                    
                    
                    <?php if( !empty($pm_ln_location_social_title_meta) ) : ?>
                                    
                        <p><b><?php echo esc_attr($pm_ln_location_social_title_meta); ?></b>:</p>
                
                    <?php endif; ?>
                    
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
                    
                    
                    <?php if( !empty($pm_ln_location_address_title_meta) ) : ?>
                        <p><b><?php echo esc_attr($pm_ln_location_address_title_meta); ?></b>:</p>
                    <?php endif; ?>    
                    
                    
                    <?php if( !empty($pm_ln_location_address_meta) ) : ?>
                        <p>
                            <?php echo esc_attr($pm_ln_location_address_meta); ?> <br />
                            <?php echo esc_attr($pm_ln_location_city_meta); ?>, <?php echo esc_attr($pm_ln_location_province_meta); ?> <br />
                            <?php echo esc_attr($pm_ln_location_zip_meta); ?>
                        </p>
                    <?php endif; ?> 
                    
                    <?php if( !empty($pm_ln_location_gmap_lat_meta) && !empty($pm_ln_location_gmap_long_meta) ) : ?>
                        
                        <?php 
                        
                        echo '<div id="'.$post->ID.'" data-id="'.$post->ID.'" data-latitude="'.$pm_ln_location_gmap_lat_meta.'" data-longitude="'.$pm_ln_location_gmap_long_meta.'" data-mapType="ROADMAP" data-mapZoom="13" data-message="'.$pm_ln_location_gmap_message_meta.'" style="width:100%; height:'.$pm_ln_location_gmap_height_meta.'px;" class="pm-location-googleMap"></div>';
                        
                        ?>
                        
                    <?php endif; ?> 
                    
                    
                                            
                </div>
                
                
                <div class="col-lg-<?php echo has_post_thumbnail() ? '6' : '12' ?> col-md-<?php echo has_post_thumbnail() ? '6' : '12' ?> col-sm-<?php echo has_post_thumbnail() ? '6' : '12' ?> pm-location-post-content-column">
                                
                	<?php the_content(); ?>
                    
					<?php 
    
                        $pag_defaults = array(
                                'before'           => '<p>' . esc_attr__( 'READ MORE:', 'medicallinktheme' ),
                                'after'            => '</p>',
                                'link_before'      => '',
                                'link_after'       => '',
                                'next_or_number'   => 'number',
                                'separator'        => ' ',
                                'nextpagelink'     => '',
                                'previouspagelink' => '',
                                'pagelink'         => '%',
                                'echo'             => 1
                            );
                        
                        wp_link_pages($pag_defaults); 
                    
                    ?>
                    
                </div>
                
            </div>
            
            <?php if($pm_ln_location_disable_share === 'no') : ?>
            
                <!-- Post info and tags -->
                <div class="pm-single-post-social-features location-post">
                
                	<div class="pm-location-post-print-btn">
                    	
                        <ul class="pm-single-post-social-icons pull-left">
                        
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Print page', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="#" id="pm-print-btn" class="fa fa-print" target="_blank"></a>
                            </li>
    
                        </ul>
                    
                    </div>
                    
                    <div class="pm-single-post-share-icons relative-position">
                    
                        <ul class="pm-single-post-social-icons">
                        
                            <li><p><?php esc_attr_e('Share This', 'medicallinktheme'); ?></p></li>
                        
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" class="fa fa-twitter" target="_blank"></a>
                            </li>
                            
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-facebook" target="_blank"></a>
                            </li>
                        
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-google-plus" target="_blank"></a>
                            </li>
                            
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" class="fa fa-linkedin" target="_blank"></a>
                            </li>
                            
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Reddit', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="http://reddit.com/submit?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" class="fa fa-reddit" target="_blank"></a>
                            </li>
    
                        </ul>
                    
                    </div>
                    
                </div>
                <!-- Post info and tags end -->
            
            <?php endif; ?>
            
        </div>
    </div>

</div>
<!-- PANEL 1 end -->