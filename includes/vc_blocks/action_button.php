<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_action_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_link" => '#', //text
			"el_title" => '', //text 
			"el_margin_top" => 0, //text
			"el_margin_bottom" => 0, //text
			"el_target_window" => '_self', //select list
			"el_icon" => 'icon-pointer', //text
			"el_position" => 'right', //select list
			"el_class" => 'wow flipInX', //text
			"el_animation_delay" => '0.3' //text
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-interactive-title-container <?php esc_attr_e($el_position); ?> <?php esc_attr_e($el_class); ?>" style="margin-top:<?php echo esc_attr($el_margin_top); ?>px; margin-bottom:<?php echo esc_attr($el_margin_bottom); ?>px;" data-wow-delay="<?php echo esc_attr($el_animation_delay); ?>s" data-wow-offset="50" data-wow-duration="1s">
		<p><?php echo esc_attr($el_title); ?></p>
            <div class="pm-interactive-title-icon-container <?php esc_attr_e($el_position); ?>">
                <i class="<?php echo esc_attr($el_icon); ?> pm-line-icon"></i>
                <a href="<?php echo esc_url($el_link); ?>" target="<?php echo esc_url($el_target_window); ?>" class="pm-interactive-title-icon-container-hover <?php echo ($el_position === 'right' ? 'left' : 'right'); ?>">
                    <i class="fa fa-link"></i>
                </a>
            </div>
            <div class="pm-interactive-title-divider">
                <div class="pm-interactive-title-divider-endpoint <?php echo ($el_position === 'right' ? 'left' : 'right') ?>"></div>
            </div>
        </div>
        <p class="<?php echo esc_attr($class) ?>" data-wow-delay="<?php echo esc_attr($el_animation_delay); ?>s" data-wow-offset="50" data-wow-duration="1s"><?php echo $content ?></p>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_action_button",
    "name"      => __("Action Button", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'medicallinktheme'),
            "param_name" => "el_link",
            "description" => __("", 'medicallinktheme'),
			"value" => "#"
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'medicallinktheme'),
            "param_name" => "el_title",
            "description" => __("", 'medicallinktheme'),
			"value" => ""
        ),
		
		array(
            "type" => "textarea",
            "heading" => __("Content", 'medicallinktheme'),
            "param_name" => "content",
            "description" => __("", 'medicallinktheme'),
			"value" => ""
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'medicallinktheme'),
            "param_name" => "el_margin_top",
            "description" => __("", 'medicallinktheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'medicallinktheme'),
            "param_name" => "el_margin_bottom",
            "description" => __("", 'medicallinktheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'medicallinktheme'),
            "param_name" => "el_target_window",
            "description" => __("", 'medicallinktheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "el_icon",
            "description" => __("Enter a Simple Lineicons value.", 'medicallinktheme'),
			"value" => "icon-pointer"
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Position", 'medicallinktheme'),
            "param_name" => "el_position",
            "description" => __("Set the position of the button.", 'medicallinktheme'),
			"value"      => array( 'right' => 'right', 'left' => 'left' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'medicallinktheme'),
            "param_name" => "el_class",
            "description" => __("Enter a custom CSS class if required.", 'medicallinktheme'),
			"value" => "wow flipInX"
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("CSS Animation Delay", 'medicallinktheme'),
            "param_name" => "el_animation_delay",
            "description" => __("Enter a positive integer value - this field accepts decimals. (Ex. 0.3, 0.6, 0.9, 1.0, 1.3, 1.6 etc.)", 'medicallinktheme'),
			"value" => "0.3"
        ),
		

    )

));