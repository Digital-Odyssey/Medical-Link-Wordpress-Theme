<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_vimeo_video extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_video_id" => '',
			"el_width" => 300,
			"el_height" => 250,
			"el_responsive" => 'yes',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php 
		
		if($el_responsive == 'yes'){
			$finalWidth = 100 .'%';
		} else {
			$finalWidth = $el_width . 'px';	
		}
		
		echo '<iframe src="//player.vimeo.com/video/'.esc_attr($el_video_id).'?title=0&amp;byline=0&amp;color=ffffff" height="'.esc_attr($el_height).'" webkitallowfullscreen mozallowfullscreen allowfullscreen style="width:'. esc_attr($finalWidth) .';"></iframe>';
			
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_vimeo_video",
    "name"      => __("Vimeo Video", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Video ID", 'medicallinktheme'),
            "param_name" => "el_video_id",
            "description" => __("Enter your Vimeo video ID.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video width", 'medicallinktheme'),
            "param_name" => "el_width",
            "description" => __("Enter a custom width for your video.", 'medicallinktheme'),
			"value"      => 300, //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video height", 'medicallinktheme'),
            "param_name" => "el_height",
            "description" => __("Enter a custom height for your video.", 'medicallinktheme'),
			"value"      => 250, //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Make video responsive?", 'medicallinktheme'),
            "param_name" => "el_responsive",
            "description" => __("Enable responsiveness for your video - this value overrides the Video width value.", 'medicallinktheme'),
			"value"      => array( 'yes' => 'yes', 'no' => 'no'), //Add default value in $atts
        ),

    )

));