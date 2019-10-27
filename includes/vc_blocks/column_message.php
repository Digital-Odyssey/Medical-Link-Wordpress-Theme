<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_column_message extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'el_text_color' => '#ffffff'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-column-container-message">
        	<p style="color:<?php esc_attr_e($el_text_color); ?>;"><?php echo $content; ?></p>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_column_message",
    "name"      => __("Column Message", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'medicallinktheme'),
            "param_name" => "content",
            "description" => __("Enter a CSS class if required.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "el_text_color",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => "#ffffff", //Add default value in $atts
        ),



    )

));