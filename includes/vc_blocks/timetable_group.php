<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_timetable_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_id' => '',
				'el_expand_icon' => 'fa fa-caret-down'
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$GLOBALS['pm_timetable_container_id'] = (int) $el_id;
			$GLOBALS['pm_timetable_accordion_count'] = 0;
			
			do_shortcode( $content );
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			
            <?php  
			
			if( is_array( $GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']] ) ){
	
                foreach( $GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']] as $item ){
                    
                    //Minified code
                    $panels[] = '<div class="pm-timetable-accordion-panel" id="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" style="background-color:'.$item['bg_color'].';"><div class="pm-timetable-panel-heading"><h3 class="pm-timetable-panel-title"><a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal" href="#"><i class="'.$item['icon'].'"></i>'.$item['title'].'</a></h3><a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal pm-accordion-horizontal-open read-more" href="#">'. __('Open', 'medicallinktheme') .'<i class="'. $el_expand_icon .'"></i></a></div><div class="pm-timetable-panel-content"><div class="pm-timetable-panel-content-body">'.$item['content'].'</div></div></div>';
            
                }
        
                //return wrapper plus timeTableItems
                echo '<div class="pm-timetable-container" id="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'">'.implode( "\n", $panels ).'</div>';
        
            }
			
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
    class WPBakeryShortCode_pm_ln_timetable_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_title' => '',
				'el_icon' => 'fa fa-clock-o',
				'el_bg_color' => '#ffffff'
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
			
            <?php
			
				//fetch accordion count
				$x = $GLOBALS['pm_timetable_accordion_count'];
			
				//create accordions array
				$GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']][$x] = array( 
																		'accordion_count' => $GLOBALS['pm_timetable_accordion_count'],
																		'title' => sprintf( $el_title, $GLOBALS['pm_timetable_accordion_count'] ), 
																		'icon' => $el_icon,
																		'bg_color' => $el_bg_color,
																		'content' =>  do_shortcode($content)
																		);
			
				//increment accordion count
				$GLOBALS['pm_timetable_accordion_count']++;
			
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
    "name" => __("Time Table", 'medicallinktheme'),
    "base" => "pm_ln_timetable_group",
	"category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "as_parent" => array('only' => 'pm_ln_timetable_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element
       array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'medicallinktheme'),
            "param_name" => "el_id",
            "description" => __("Assign a unique number value for this Time Table. If you are creating multiple Time Tables on a single page please make sure each Time Table menu has a unique number assigned to it in order to avoid conflicts between menus.", 'medicallinktheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Expand icon", 'medicallinktheme'),
            "param_name" => "el_expand_icon",
            "description" => __("Accepts a FontAwesome 4 icon value. Ex. fa fa-caret-down", 'medicallinktheme'),
			"value"      => 'fa fa-caret-down', //Add default value in $atts
        ),
		
		
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Time Table Item", 'medicallinktheme'),
    "base" => "pm_ln_timetable_group_item",
	"category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_timetable_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
            "type" => "textfield",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "el_icon",
            "description" => __("Enter a FontAwesome 4 value.", 'medicallinktheme'),
			"value" => 'fa fa-clock-o'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'medicallinktheme'),
            "param_name" => "el_bg_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'medicallinktheme'),
            "param_name" => "content",
            "description" => __("Structure your content in an unordered list for proper formatting.", 'medicallinktheme')
        ),
				
		
    )
) );