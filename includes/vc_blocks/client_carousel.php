<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_client_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_target" => '_blank',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Redux options
		global $medicallink_options;
		
		$clients = '';
					
		if( isset($medicallink_options['opt-client-slides']) && !empty($medicallink_options['opt-client-slides']) ){
			$clients = $medicallink_options['opt-client-slides']; //This should return an empty array if no slides are present...not an undefined index notice
		}

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if(is_array($clients)) : ?>
	
            <div id="pm-brands-carousel" class="owl-carousel owl-theme">
            
                <?php foreach($clients as $c) { ?>
            
                    <div class="pm-brand-item">
                        <img src="<?php echo $c['image']; ?>" class="img-responsive" alt="<?php echo $c['title']; ?>">
                        <a href="http://<?php echo $c['url']; ?>" target="<?php esc_attr_e($el_target); ?>"><?php echo $c['url']; ?></a>
                    </div>
                
                <?php }//end of foreach ?>
                
            </div>
            
            <div class="pm-brand-carousel-btns">
                <a class="btn pm-owl-prev fa fa-chevron-left"></a>
                <a class="btn pm-owl-next fa fa-chevron-right"></a>
            </div>
        
        <?php endif;//end of if ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_client_carousel",
    "name"      => __("Client Carousel", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'medicallinktheme'),
            "param_name" => "el_target",
            "description" => __("Set the target window for the client link.", 'medicallinktheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

    )

));