<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_staff_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_order" => 'DESC',
			"staff_title" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		//Fetch data
		if($staff_title !== '') {
			
			$arguments = array(
				'post_type' => 'post_staff',
				'post_status' => 'publish',
				'order' => (string) $post_order,
				'posts_per_page' => -1,
				'tax_query' => array(
						array(
							'taxonomy' => 'staff_cats',
							'field' => 'slug',
							'terms' => array( $staff_title )
						)
				),
				
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post_staff',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'order' => (string) $post_order,
			);
			
		}	
		
		$pm_staff_post_view_btn_text = get_option('pm_staff_post_view_btn_text');
	
		$post_query = new WP_Query($arguments);
	

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="row">
		
        <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
            
            <?php 
				$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
				$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
				$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
				$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
				$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
				$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
				$pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
				$pm_staff_quote_meta = get_post_meta(get_the_ID(), 'pm_staff_quote_meta', true);	
			?>
            
            <div class="col-lg-4 col-md-4 col-sm-12">
            
                <div class="pm-staff-profile-parent-container">
        
                    <div class="pm-staff-profile-container" style="background-image:url(<?php echo esc_url(esc_html($pm_staff_image_meta)); ?>);">
                
                        <div class="pm-staff-profile-overlay-container">
                        
                            <ul class="pm-staff-profile-icons">
                                
                                <?php if($pm_staff_twitter_meta !== '') : ?>
                                
                                    <li><a href="<?php esc_html_e($pm_staff_twitter_meta); ?>" target="_blank" class="fa fa-twitter"></a></li>
                                
                                <?php endif; ?>
                            
                                <?php if($pm_staff_facebook_meta !== '') : ?>
                                
                                    <li><a href="<?php esc_html_e($pm_staff_facebook_meta); ?>" target="_blank" class="fa fa-facebook"></a></li>
                                
                                <?php endif; ?>
                                
                               <?php  if($pm_staff_gplus_meta !== '') : ?>
                                
                                    <li><a href="<?php esc_html_e($pm_staff_gplus_meta); ?>" target="_blank" class="fa fa-google-plus"></a></li>
                                
                                <?php endif; ?>
                                
                                <?php if($pm_staff_linkedin_meta !== '') : ?>
                                
                                    <li><a href="<?php esc_html_e($pm_staff_linkedin_meta); ?>" target="_blank" class="fa fa-linkedin"></a></li>
                                
                                <?php endif; ?>
                                
                                <?php if($pm_staff_email_address_meta !== '') : ?>
                                
                                    <li><a href="mailto:<?php esc_attr_e($pm_staff_email_address_meta); ?>" target="_blank" class="fa fa-envelope"></a></li>
                                
                                <?php endif; ?>
                                
                            </ul>
                            
                            <div class="pm-staff-profile-quote">
                                <p><?php esc_attr($pm_staff_quote_meta); ?></p>
                                
                                <?php if( !empty($pm_staff_post_view_btn_text) ) { ?>
                                    <a href="<?php the_permalink(); ?>" class="pm-square-btn pm-center-align"><?php esc_attr_e($pm_staff_post_view_btn_text); ?></a>
                                <?php } else { ?>
                                    <a href="<?php the_permalink(); ?>" class="pm-square-btn pm-center-align"><?php esc_attr_e('View profile', 'medicallinktheme'); ?></a>
                                <?php } ?>  
                            </div>
                        </div>
                                                
                        <a href="#" class="pm-staff-profile-expander fa fa-plus"></a>
                                            
                    </div>
                    
                    <div class="pm-staff-profile-info">
                        <p class="pm-staff-profile-name"><?php the_title(); ?></p>
                        <p class="pm-staff-profile-title"><?php  esc_attr_e($pm_staff_title_meta); ?></p>
                    </div>
                    
                </div> 
            
            </div>
        
        <?php endwhile; else: ?>
            <div class="col-lg-12 pm-column-spacing">
             <p><?php esc_attr_e('No staff profiles were found.', 'medicallinktheme'); ?></p>
            </div>
        <?php endif; ?>
        
        </div>
        
        <!-- Element Code / END -->
        
        <?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_staff_posts",
    "name"      => __("Staff Posts", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
		
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'medicallinktheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which service posts are displayed.", 'medicallinktheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Staff Title", 'medicallinktheme'),
            "param_name" => "staff_title",
            "description" => __("Enter a staff title slug to retrieve staff posts based on their assigned title.", 'medicallinktheme'),
			"value" => ''
        ),

    )

));