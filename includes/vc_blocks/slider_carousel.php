<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_slider_carousel extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"el_animation" => 'slide',
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			if(!isset($GLOBALS['pm_ln_carousel_count'])){
				$GLOBALS['pm_ln_carousel_count'] = 0;
				$GLOBALS['pm_ln_carousel_item_count_'.$GLOBALS['pm_ln_carousel_count']] = 0; 
			}
	
			?>
			
			<!-- Element Code start -->
			
            <?php  
			
			echo '<div id="vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" class="carousel '. ( $el_animation === 'fade' ? 'slide carousel-fade' : 'slide' ) .'" data-ride="carousel">';	
			  echo '<ol class="carousel-indicators">';
				echo '<li data-target="#vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide-to="0" class="active"></li>';
				echo '<li data-target="#vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide-to="1"></li>';
				echo '<li data-target="#vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide-to="2"></li>';	  
			  echo '</ol>';	
			  echo '<div class="carousel-inner">'.do_shortcode($content).'</div><a class="left carousel-control" href="#vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a>';
			  echo '<a class="right carousel-control" href="#vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide="next">';
				echo '<span class="glyphicon glyphicon-chevron-right"></span>';
				echo '<span class="sr-only">Next</span>';
			  echo '</a>';
			echo '</div>';
			echo '<script>(function($) {$(document).ready(function(e) {$("#vienna-carousel-'.$GLOBALS['pm_ln_carousel_count'].'").carousel(); })(jQuery);</script>';
			
			//increment for next possible carousel slider
			$GLOBALS['pm_ln_carousel_count']++;
			
			?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_slider_carousel_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"el_image" => '',
				"el_title" => ''
				), 
			$atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				$img = wp_get_attachment_image_src($el_image, "large"); 
				$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			
            <?php
			
				echo '<div class="item'. ($GLOBALS['pm_ln_carousel_item_count_'.$GLOBALS['pm_ln_carousel_count']] == 0 ? ' active' : '') .'"><img src="' . esc_url($imgSrc) . '" alt="' . esc_attr($el_title) . '" /></div>';
				
				$GLOBALS['pm_ln_carousel_item_count_'.$GLOBALS['pm_ln_carousel_count']]++;
			
			?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Slider Carousel", 'medicallinktheme'),
    "base" => "pm_ln_slider_carousel",
	"category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "as_parent" => array('only' => 'pm_ln_slider_carousel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element
       array(
            "type" => "dropdown",
            "heading" => __("Animation Type", 'medicallinktheme'),
            "param_name" => "el_animation",
            "description" => __("Choose between a slide or fade effect.", 'medicallinktheme'),
			"value"      => array( 'slide' => 'slide', 'fade' => 'fade' ), //Add default value in $atts
        ),
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Slide", 'medicallinktheme'),
    "base" => "pm_ln_slider_carousel_item",
	"category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_slider_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Alt attribute", 'medicallinktheme'),
            "param_name" => "el_title",
            "description" => __("Enter a descriptive alt attribute - this is used for SEO purposes.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Image", 'medicallinktheme'),
            "param_name" => "el_image",
            "description" => __("Upload an image for your slide.", 'medicallinktheme')
        ),
		
    )
) );