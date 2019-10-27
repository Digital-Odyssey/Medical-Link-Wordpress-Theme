<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_staff_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"id" => '',
			"name_color" => '#0db7c4',
			"title_color" => '#f15b5a',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
			
			$queried_post = get_post($id);
			$postID = $queried_post->ID;
			$postLink = $queried_post->guid;
			$postTitle = $queried_post->post_title;
			//$postTags = get_the_tags($postID);
			$postExcerpt = $queried_post->post_excerpt;
			$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 20);
			
			$pm_staff_image_meta = get_post_meta($postID, 'pm_staff_image_meta', true);
			$pm_staff_title_meta = get_post_meta($postID, 'pm_staff_title_meta', true);
			$pm_staff_twitter_meta = get_post_meta($postID, 'pm_staff_twitter_meta', true);
			$pm_staff_facebook_meta = get_post_meta($postID, 'pm_staff_facebook_meta', true);
			$pm_staff_gplus_meta = get_post_meta($postID, 'pm_staff_gplus_meta', true);
			$pm_staff_linkedin_meta = get_post_meta($postID, 'pm_staff_linkedin_meta', true);
			$pm_staff_email_address_meta = get_post_meta($postID, 'pm_staff_email_address_meta', true);
			$pm_staff_quote_meta = get_post_meta($postID, 'pm_staff_quote_meta', true);
			
			$pm_staff_post_view_btn_text = get_option('pm_staff_post_view_btn_text');
		?>

        <!-- Element Code start -->
        
        <div class="pm-staff-profile-parent-container">
                    
            <div class="pm-staff-profile-container" style="background-image:url(<?php echo esc_url($pm_staff_image_meta); ?>);">
        
                <div class="pm-staff-profile-overlay-container">
                
                    <ul class="pm-staff-profile-icons">
                    
                        <?php if($pm_staff_twitter_meta !== '') : ?>
                    
                            <li>
                                <a href="<?php esc_html_e($pm_staff_twitter_meta); ?>" class="fa fa-twitter"></a>
                            </li>
                        
                        <?php endif; ?>
                        
                        <?php if($pm_staff_facebook_meta !== '') : ?>
                        
                            <li>
                                <a href="<?php esc_html_e($pm_staff_facebook_meta); ?>" class="fa fa-facebook"></a>
                            </li>
                        
                        <?php endif; ?>
                        
                        <?php if($pm_staff_gplus_meta !== '') : ?>
                        
                            <li>
                                <a href="<?php esc_html_e($pm_staff_gplus_meta); ?>" class="fa fa-google-plus"></a>
                            </li>
                        
                        <?php endif; ?>
                        
                        <?php if($pm_staff_linkedin_meta !== '') : ?>
                        
                            <li>
                                <a href="<?php esc_html_e($pm_staff_linkedin_meta); ?>" class="fa fa-linkedin"></a>
                            </li>
                        
                        <?php endif; ?>
                        
                        <?php if($pm_staff_email_address_meta !== '') : ?>
                        
                            <li>
                                <a href="mailto:<?php esc_html_e($pm_staff_email_address_meta); ?>" class="fa fa-envelope"></a>
                            </li>
                        
                        <?php endif; ?>
                    
                    </ul>
                    
                    <div class="pm-staff-profile-quote">
                    
                        <p><?php echo esc_attr($pm_staff_quote_meta); ?></p>
                        
                        <?php if($pm_staff_post_view_btn_text !== '') { ?>
                            <a href="<?php echo get_permalink($postID); ?>" class="pm-square-btn pm-staff-profile-btn pm-center-align"><?php echo esc_attr($pm_staff_post_view_btn_text); ?></a>
                        <?php } else { ?>
                            <a href="<?php echo get_permalink($postID); ?>" class="pm-square-btn pm-staff-profile-btn pm-center-align"><?php esc_attr_e('View profile', 'medicallinktheme'); ?></a>
                        <?php } ?>
                        
                    </div>
                
                </div>
                                        
                <?php if( !empty($pm_staff_quote_meta) ) { ?>
                    <a href="#" class="pm-staff-profile-expander fa fa-plus"></a>
                <?php } else { ?>
                    <a href="<?php echo get_permalink($postID); ?>" class="pm-staff-profile-expander fa fa-plus"></a>
                <?php } ?>
                                    
            </div>
            
            <div class="pm-staff-profile-info">
                <p class="pm-staff-profile-name" style="color:<?php esc_attr_e($name_color); ?> !important;"><?php esc_attr_e($postTitle); ?></p>
                <p class="pm-staff-profile-title" style="color:<?php esc_attr_e($title_color); ?> !important;"><?php esc_attr_e($pm_staff_title_meta, 'medicallinktheme'); ?></p>
            </div>
            
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_staff_profile",
    "name"      => __("Staff Profile", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Staff Post ID", 'medicallinktheme'),
            "param_name" => "id",
            "description" => __("Enter the ID number of the staff post you wish to display.", 'medicallinktheme'),
			"value" => ''
        ),

		array(
            "type" => "colorpicker",
            "heading" => __("Name Color", 'medicallinktheme'),
            "param_name" => "name_color",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => '#0db7c4' //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'medicallinktheme'),
            "param_name" => "title_color",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => '#f15b5a' //Add default value in $atts
        ),
		
		

    )

));