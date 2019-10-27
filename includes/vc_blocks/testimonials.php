<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonials extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'el_icon_image' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		global $medicallink_options;
	
		$testimonials = '';
					
		if( isset($medicallink_options['opt-testimonials-slides']) && !empty($medicallink_options['opt-testimonials-slides']) ){
			$testimonials = $medicallink_options['opt-testimonials-slides']; //This should return an empty array if no slides are present...not an undefined index notice
		}

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_icon_image, "large"); 
			$el_icon_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if(is_array($testimonials)) : ?>
					
            <div class="pm-testimonials-carousel" id="pm-testimonials-carousel">
                <ul class="pm-testimonial-items">
                
                    <?php foreach($testimonials as $t) { ?>
                    
                        <li>
                            <div class="pm-testimonial-img" style="background-image:url(<?php echo esc_url($t['image']); ?>);">
                                <?php if($el_icon_image !== '') : ?>
                                    <div class="pm-testimonial-img-icon">
                                        <img src="<?php echo esc_url($el_icon_image); ?>" class="img-responsive pm-center-align" alt="icon">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <p class="pm-testimonial-name"><?php  esc_attr_e($t['title'],'medicallinktheme'); ?></p>
                            <p class="pm-testimonial-title"><?php  esc_attr_e($t['url'],'medicallinktheme'); ?></p>
                            <div class="pm-testimonial-divider"></div>
                            <p class="pm-testimonial-quote"><?php  esc_attr_e($t['description'],'medicallinktheme'); ?></p>
                        </li>
                        
                    <?php }//end of foreach ?>					
                    
                </ul>
            </div>
            
        <?php endif; ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonials",
    "name"      => __("Testimonials", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "attach_image",
            "heading" => __("Icon", 'medicallinktheme'),
            "param_name" => "el_icon_image",
            "description" => __("Upload a custom icon image.", 'medicallinktheme')
        ),

    )

));