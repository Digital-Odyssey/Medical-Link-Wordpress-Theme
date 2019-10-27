<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonial_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_name" => '',
			"el_title" => '',
			"el_date" => '',
			"el_image" => '',
			"el_icon_image" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_image, "large"); 
			$el_image = $img[0];
			
			$icon_img = wp_get_attachment_image_src($el_icon_image, "large"); 
			$el_icon_image = $icon_img[0];
		?>

        <!-- Element Code start -->
        <div class="pm-single-testimonial-shortcode">
            <div style="background-image:url(<?php echo esc_url($el_image); ?>);" class="pm-single-testimonial-img-bg">
                
            <?php if($el_icon_image !== '') : ?>
                <div class="pm-single-testimonial-avatar-icon">
                    <img width="33" height="41" class="img-responsive" src="<?php echo esc_url($el_icon_image); ?>" alt="<?php esc_attr_e($el_title); ?>">
                </div>
            <?php endif; ?>
                
            </div>
            <p class="name"><?php esc_attr_e($el_name); ?></p>
            <p class="title"><?php esc_attr_e($el_title); ?></p>
            <div class="pm-single-testimonial-divider"></div>
            <p class="quote"><?php echo $content; ?></p>
            <div class="pm-single-testimonial-divider"></div>
            <p class="date"><?php esc_attr_e($el_date); ?></p>
        
        </div>
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonial_profile",
    "name"      => __("Testimonial Profile", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Name", 'medicallinktheme'),
            "param_name" => "el_name",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'medicallinktheme'),
            "param_name" => "el_title",
			"value" => '',
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Date", 'medicallinktheme'),
            "param_name" => "el_date",
			"value" => '',
            "description" => __("Enter a date if required.", 'medicallinktheme')
        ),

		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'medicallinktheme'),
            "param_name" => "el_image",
            "description" => __("Upload an avatar for your testimonial. Recommended size 230x230px", 'medicallinktheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar Icon", 'medicallinktheme'),
            "param_name" => "el_icon_image",
            "description" => __("Upload an icon for your avatar.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Description", 'medicallinktheme'),
            "param_name" => "content",
            "description" => __("Enter your testimonial quote.", 'medicallinktheme')
        ),
		
		

    )

));