<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_icon_element extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_link" => '',
			"el_icon" => 'fa fa-twitter',
			"el_icon_color" => '#ffffff',
			"el_target" => '_self'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <a <?php echo ($el_link !== '' ? 'href="'. esc_url($el_link) .'" target="'. esc_attr_e($el_target) .'" ' : ''); ?> class="<?php esc_attr_e($el_icon); ?> pm-icon-btn" style="color:<?php esc_attr_e($el_icon_color); ?>;"></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_icon_element",
    "name"      => __("Icon Element", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Link", 'medicallinktheme'),
            "param_name" => "el_link",
            "description" => __("Leave this field blank if you wish to only display the icon.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "el_icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-twitter)", 'medicallinktheme'),
			"value" => 'fa fa-twitter'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'medicallinktheme'),
            "param_name" => "el_icon_color",
            //"description" => __("Accepts a FontAwesome 4 or Lineicons value.", 'medicallinktheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'medicallinktheme'),
            "param_name" => "el_target",
            //"description" => __("", 'medicallinktheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

    )

));