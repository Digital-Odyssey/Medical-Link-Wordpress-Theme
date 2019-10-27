<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_milestone extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(			
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#fff',
			"bg_color" => '#333',
			"text_color" => '#333333',
			"text_size" => '24',
			"border_radius" => '99',
			"padding" => '10',
			"width" => "160",
			"height" => "160",
			"font_size" => 60,
			"line_height" => '1.5'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="milestone">
            <?php if($icon !== '') : ?>
            
            <i class="<?php esc_attr_e($icon); ?>" style="background-color:<?php esc_attr_e($bg_color); ?>; line-height:<?php esc_attr_e($line_height); ?>; color:<?php esc_attr_e($icon_color); ?>; border-radius:<?php esc_attr_e($border_radius); ?>px; padding:<?php esc_attr_e($padding); ?>px; font-size:<?php esc_attr_e($font_size); ?>px; width:<?php esc_attr_e($width); ?>px; height:<?php esc_attr_e($height); ?>px;"></i>
            
            <?php endif; ?>
            
            <div class="milestone-content" style="font-size:<?php esc_attr_e($font_size); ?>px;">                        
                <span data-speed="<?php echo esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value" style="color:<?php esc_attr_e($text_color); ?>; font-size:<?php esc_attr_e($text_size); ?>px;"></span>
                <div class="milestone-description" style="font-size:<?php esc_attr_e($text_size); ?>px;"><?php esc_attr_e($caption); ?></div>
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

    "base"      => "pm_ln_milestone",
    "name"      => __("Milestone", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	

		array(
            "type" => "textfield",
            "heading" => __("Speed", 'medicallinktheme'),
            "param_name" => "speed",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stop value", 'medicallinktheme'),
            "param_name" => "stop",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'medicallinktheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "icon",
            "description" => __("Enter a Typicon icon or FontAwesome 4 icon value. (Ex. typcn typcn-cog / fa fa-ambulance)", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'medicallinktheme'),
            "param_name" => "icon_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'medicallinktheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'medicallinktheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'medicallinktheme'),
			"value" => '#FFE1A0'
        ),

		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'medicallinktheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Text Size", 'medicallinktheme'),
            "param_name" => "text_size",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => '24'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Border Radius", 'medicallinktheme'),
            "param_name" => "border_radius",
            "description" => __("Enter a positive integer value between 0 and 99px.", 'medicallinktheme'),
			"value" => '0'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Padding", 'medicallinktheme'),
            "param_name" => "padding",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => '10'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'medicallinktheme'),
            "param_name" => "width",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => '160'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Height", 'medicallinktheme'),
            "param_name" => "height",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => '160'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'medicallinktheme'),
            "param_name" => "font_size",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => 60
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Height", 'medicallinktheme'),
            "param_name" => "line_height",
            "description" => __("Enter a positive integer value. Use this field to adjust the vertical positioning of the icon.", 'medicallinktheme'),
			"value" => '1.5'
        ),

				

    )

));