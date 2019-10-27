<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_process_list extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_class' => '',
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			<ul class="pm-our-process-list"><?php echo do_shortcode($content); ?></ul>
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_process_list_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"el_title" => '',
				"el_text_color" => '#ffffff',
				"el_icon" => '',
				"el_class" => 'wow flipInY',
				"el_animation_delay" => '0.3',
				), 
			$atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			
            <li class="<?php esc_attr_e($el_class); ?>" data-wow-delay="<?php esc_attr_e($animation_delay); ?>s" data-wow-offset="50" data-wow-duration="1s">
                <i class="<?php esc_attr_e($el_icon); ?>"></i>
                <div class="pm-our-process-divider"><div class="pm-our-process-divider-diamond"></div></div>
                <p style="color:<?php echo $el_text_color; ?>;"><?php esc_attr_e($el_title); ?></p>
            </li>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Process List", 'medicallinktheme'),
    "base" => "pm_ln_process_list",
	"category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "as_parent" => array('only' => 'pm_ln_process_list_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element
       /* array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'medicallinktheme'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medicallinktheme')
			
        )*/
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Process List Item", 'medicallinktheme'),
    "base" => "pm_ln_process_list_item",
	"category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_process_list'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", 'medicallinktheme'),
            "param_name" => "el_title",
            //"description" => __("Enter a title", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "el_text_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "el_icon",
            "description" => __("Enter a Simple Lineicons value.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("CSS Class", 'medicallinktheme'),
            "param_name" => "el_class",
            "description" => __("Apply a custom CSS class if required.", 'medicallinktheme'),
			"value" => 'wow flipInY'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Animation Delay", 'medicallinktheme'),
            "param_name" => "el_animation_delay",
            //"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medicallinktheme'),
			"value" => '0.3'
        ),
		
    )
) );