<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_piechart extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(			
			"bar_size" => 220,
			"line_width" => 12,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			"text_color" => "#ffffff",
			"percentage" => 75,
			"icon" => "typcn typcn-thumbs-up",
			"caption" => "Cost Reduction",
			"font_size" => 40
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div data-barsize="<?php esc_attr_e($bar_size); ?>" data-linewidth="<?php esc_attr_e($line_width); ?>" data-trackcolor="<?php esc_attr_e($track_color); ?>" data-barcolor="<?php esc_attr_e($bar_color); ?>" data-percent="<?php esc_attr_e($percentage); ?>" class="pm-pie-chart">
            <div class="pm-pie-chart-percent" style="font-size:<?php esc_attr_e($font_size); ?>px; color:<?php esc_attr_e($text_color); ?>">
                <span style="color:<?php esc_attr_e($text_color); ?>"></span>%
            </div>			
        </div>
        <div class="pm-pie-chart-description" style="color:<?php esc_attr_e($text_color); ?>">
            <i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($text_color); ?>"></i>
            <?php esc_attr_e($caption); ?>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_piechart",
    "name"      => __("Pie Chart", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Bar Size", 'medicallinktheme'),
            "param_name" => "bar_size",
            "description" => __("Enter a positive numeric value to set the size of the track bar.", 'medicallinktheme'),
			"value" => 220
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Width", 'medicallinktheme'),
            "param_name" => "line_width",
            "description" => __("Enter a positive numeric value to set the size of the line bar.", 'medicallinktheme'),
			"value" => 12
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Track Color", 'medicallinktheme'),
            "param_name" => "track_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'medicallinktheme'),
			"value" => "#dbdbdb"
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Bar Color", 'medicallinktheme'),
            "param_name" => "bar_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'medicallinktheme'),
			"value" => "#2B5C84"
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'medicallinktheme'),
			"value" => "#ffffff"
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'medicallinktheme'),
            "param_name" => "percentage",
            "description" => __("Enter a positive numeric value.", 'medicallinktheme'),
			"value" => 75
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "icon",
            "description" => __("Accepts a Typicon value. (Ex. typcn typcn-thumbs-up)", 'medicallinktheme'),
			"value" => 'typcn typcn-thumbs-up'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'medicallinktheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'medicallinktheme'),
			"value" => "Cost Reduction"
        ),
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Display Overlay?", 'medicallinktheme'),
            "param_name" => "overlay_mode",
            "description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),*/
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'medicallinktheme'),
            "param_name" => "font_size",
            "description" => __("Enter a positive numeric value.", 'medicallinktheme'),
			"value" => 40
        ),

    )

));