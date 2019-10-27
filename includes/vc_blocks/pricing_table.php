<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_pricing_table extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_title" => 'Silver',
			"el_featured" => 'no',
			"el_price" => '19',
			"el_currency_symbol" => '$',
			"el_subscript" => '/mo',
			"el_message" => '',
			"el_button_text" => 'Purchase Plan',
			"el_button_link" => '#',
			"el_bg_image" => '',
			"el_header_color" => '#0DB7C4',
			"el_button_color" => '#0DB7C4',
			"el_text_color" => '#ffffff'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_bg_image, "large"); 
			$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-pricing-table-container">
            <div class="pm-pricing-table-title" style="background-color:<?php esc_attr_e($el_header_color); ?>;">
                <p><?php esc_attr_e($el_title); ?></p>
            </div>
            <div class="pm-pricing-table-price" <?php echo ($imgSrc !== '' ? 'style=background-image:url('. esc_url($imgSrc) .')' : ''); ?>>
            
                <?php if($el_featured === 'yes') : ?>
                    <div class="pm-pricing-table-featured"></div>
                    <i class="fa fa-thumbs-up"></i>
                <?php endif; ?>
                
                <p class="price" style="color:<?php esc_attr_e($el_text_color); ?>;"><sup><?php esc_attr_e($el_currency_symbol); ?></sup><?php esc_attr_e($el_price); ?><sub><?php esc_attr_e($el_subscript); ?></sub></p>
                <p class="details" style="color:<?php esc_attr_e($el_text_color); ?>;"><?php esc_attr_e($el_message); ?></p></div><?php echo $content ?>

            <?php if($el_button_text !== ''){ ?>
                <a href="<?php esc_url($el_button_link); ?>" class="pm-pricing-table-btn" style="background-color:<?php esc_attr_e($el_button_color); ?>;"><?php esc_attr_e($el_button_text); ?> &nbsp;<i class="fa fa-angle-right"></i></a>
            <?php }	?>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_pricing_table",
    "name"      => __("Pricing Table", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Featured?", 'medicallinktheme'),
            "param_name" => "el_featured",
            "description" => __("Display a featured icon symbol.", 'medicallinktheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'medicallinktheme'),
            "param_name" => "el_title",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Price", 'medicallinktheme'),
            "param_name" => "el_price",
			"value" => '19'
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Currency Symbol", 'medicallinktheme'),
            "param_name" => "el_currency_symbol",
			"value" => '$'
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Subscript", 'medicallinktheme'),
            "param_name" => "el_subscript",
			"value" => '/mo'
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Message", 'medicallinktheme'),
            "param_name" => "el_message",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'medicallinktheme'),
            "param_name" => "el_button_text",
			"value" => 'Purchase Plan'
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button URL", 'medicallinktheme'),
            "param_name" => "el_button_link",
			"value" => '#'
            //"description" => __("Enter a CSS class if required.", 'medicallinktheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'medicallinktheme'),
            "param_name" => "el_bg_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'medicallinktheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Header Color", 'medicallinktheme'),
            "param_name" => "el_header_color",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => '#0DB7C4', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Color", 'medicallinktheme'),
            "param_name" => "el_button_color",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => '#0DB7C4', //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'medicallinktheme'),
            "param_name" => "el_text_color",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => '#ffffff', //Add default value in $atts
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'medicallinktheme'),
            "param_name" => "content",
			"value" => '',
            "description" => __("Format your content in an unordered list for proper formatting.", 'medicallinktheme')
        ),
		

    )

));