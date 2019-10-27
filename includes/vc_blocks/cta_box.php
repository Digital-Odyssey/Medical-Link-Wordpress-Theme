<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_cta_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => '',
			"text_color" => '#ffffff',
			"link" => '',
			"button_text" => "Purchase Now",
			"button_text_color" => "#000000",
			"button_color" => "#0db7c4",
			"bg_color" => "#5D656F",
			"border_color" => "#0DB7C4",
			"target" => "_blank"
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-cta-message" style="background-color:<?php echo esc_attr($bg_color); ?>; border-left:5px solid <?php echo esc_attr($border_color); ?>;">
            <p class="pm-quantum-alert-title" style="color:<?php echo esc_attr($text_color); ?>"><?php echo esc_attr($title); ?></p>
            <p class="pm-quantum-alert-details" style="color:<?php echo esc_attr($text_color); ?>"><?php echo $content ?></p>
            <p class="pm-quantum-alert-btn"><a href="<?php echo esc_url($link) ?>" class="pm-rounded-btn cta-btn" style="color:<?php echo esc_attr($button_text_color) ?> !important; background-color:<?php echo esc_attr($button_color) ?>" target="<?php echo esc_attr($target); ?>"><?php echo esc_attr($button_text); ?></a></p>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_cta_box",
    "name"      => __("Call to Action", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Title", 'medicallinktheme'),
            "param_name" => "title",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Link", 'medicallinktheme'),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'medicallinktheme'),
            "param_name" => "button_text",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => 'Purchase Now'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", 'medicallinktheme'),
            "param_name" => "button_text_color",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => '#000000'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Color", 'medicallinktheme'),
            "param_name" => "button_color",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => '#0db7c4'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'medicallinktheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => '#5D656F'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Border Color", 'medicallinktheme'),
            "param_name" => "border_color",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => '#0DB7C4'
        ),		
				
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'medicallinktheme'),
            "param_name" => "target",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank'), //Add default value in $atts
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'medicallinktheme'),
            "param_name" => "content",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			//"value" => 'Purchase Now'
        ),
		
		

    )

));