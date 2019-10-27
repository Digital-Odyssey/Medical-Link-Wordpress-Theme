<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_content_divider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $margin_top = $margin_bottom = $divider_style = $fancy_title = $color_selection = '' ;

        extract(shortcode_atts(array(  			
			"height" => 1,
			"width" => 80,
			"bg_color" => '#34ceda',
			"margin_top" => 20,
			"margin_bottom" => 20,
			"alignment" => '',
			"display_icon" => "off"
		), $atts)); 


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>

        <!-- Element Code start -->
        
       <?php if($display_icon === 'on'){ ?>
		
            <?php $dividerIconImage = get_theme_mod('dividerIconImage', ''); ?>
            
            <div class="pm-column-title-divider" style="border-top:1px solid <?php esc_attr_e($bg_color); ?>; height:<?php esc_attr_e($height); ?>px; width:<?php esc_attr_e($width); ?>px; margin:<?php esc_attr_e($margin_top); ?>px <?php echo $alignment === 'center' ? 'auto' : '0'; ?> <?php esc_attr_e($margin_bottom); ?>px <?php echo $alignment === 'center' ? 'auto' : '0'; ?>;"><img width="29" height="29" alt="icon" src="<?php echo esc_url($dividerIconImage);?>"></div>
            
        <?php } else { ?>
        
            <div class="pm-divider" style="height:<?php esc_attr_e($height); ?>px; width:<?php esc_attr_e($width); ?>px; background-color:<?php esc_attr_e($bg_color); ?>; margin:<?php esc_attr_e($margin_top); ?>px <?php echo $alignment === 'center' ? 'auto' : '0'; ?> <?php esc_attr_e($margin_bottom); ?>px <?php echo $alignment === 'center' ? 'auto' : '0'; ?>;"></div>
            
        <?php } ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_content_divider",
    "name"      => __("Content Divider", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Height", 'medicallinktheme'),
            "param_name" => "height",
            //"description" => __("Enter a positive integer for the top margin spacing.", 'medicallinktheme'),
			"value" => 1
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'medicallinktheme'),
            "param_name" => "width",
            //"description" => __("Enter a positive integer for the bottom margin spacing.", 'medicallinktheme'),
			"value" => 80
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'medicallinktheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter a positive integer for the bottom margin spacing.", 'medicallinktheme'),
			"value" => '#34ceda'
        ),		
	
		array(
            "type" => "textfield",
            "heading" => __("Top Margin", 'medicallinktheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer for the top margin spacing.", 'medicallinktheme'),
			"value" => 20
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Bottom Margin", 'medicallinktheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer for the bottom margin spacing.", 'medicallinktheme'),
			"value" => 20
        ),
		
		
		array(
            "type" => "dropdown",
            "heading" => __("Alignment", 'medicallinktheme'),
            "param_name" => "alignment",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => array( 'left' => 'left', 'center' => 'center' ),
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Icon?", 'medicallinktheme'),
            "param_name" => "display_icon",
            "description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ),
        ),		

    )

));