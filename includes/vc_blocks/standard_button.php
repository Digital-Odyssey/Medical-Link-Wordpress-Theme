<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(			
			"link" => '#',
			"btn_text" => '',
			"margin_top" => 0,
			"margin_bottom" => 0,
			"target" => '_self',
			"icon" => 'fa fa-angle-right',
			//"text_color" => '#ffffff',
			//"flip_colors" => "no",
			"animated" => 'off',
			"button_type" => '',
			"class" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
       <a class="pm-rounded-btn <?php echo ($class !== '' ? $class : '').' '.($button_type === 'transparent' ? 'transparent' : '').' '. ( $animated == 'on' ? 'animated' : ''); ?>" href="<?php echo esc_url($link); ?>" target="<?php esc_attr_e($target); ?>" style="margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"><?php esc_attr_e($btn_text); ?> &nbsp;<i class="<?php esc_attr_e($icon); ?>"></i></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(

	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'medicallinktheme'),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => '#'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'medicallinktheme'),
            "param_name" => "btn_text",
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'medicallinktheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'medicallinktheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer value.", 'medicallinktheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'medicallinktheme'),
            "param_name" => "target",
            "description" => __("Set the target window for the button.", 'medicallinktheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-angle-right)", 'medicallinktheme'),
			"value" => 'fa fa-angle-right'
        ),
		
		/*array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an icon value.", 'medicallinktheme'),
			"value" => '#ffffff'
        ),*/
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Flip Colors?", 'medicallinktheme'),
            "param_name" => "flip_colors",
            "description" => __("Reverse the order of the button colors.", 'medicallinktheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),*/
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Animation?", 'medicallinktheme'),
            "param_name" => "animated",
            "description" => __("Adds a rollover animation effect to the icon.", 'medicallinktheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Type", 'medicallinktheme'),
            "param_name" => "button_type",
            //"description" => __("Adds a rollover animation effect to the icon.", 'medicallinktheme'),
			"value"      => array( 'opaque' => 'opaque', 'transparent' => 'transparent' ), //Add default value in $atts
        ),
		
		
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'medicallinktheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'medicallinktheme'),
			"value" => ''
        ),


    )

));