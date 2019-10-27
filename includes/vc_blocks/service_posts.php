<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_service_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_order" => 'DESC',
			"category" => '',
			"display_controls" => 'true',
			"enable_carousel" => 'true',
			"post_count" => '-1'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		//Fetch data
		if($category !== '') {
			
			$arguments = array(
				'post_type' => 'post_services',
				'post_status' => 'publish',
				'order' => (string) $post_order,
				'posts_per_page' => $post_count,
				'tax_query' => array(
						array(
							'taxonomy' => 'services_cats',
							'field' => 'slug',
							'terms' => array( $category )
						)
				),
				
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post_services',
				'post_status' => 'publish',
				'posts_per_page' => $post_count,
				'order' => (string) $post_order
				//'post_count' => $num_of_posts,
			);
			
		}	
			
		$servicePostIconImage = get_theme_mod('servicePostIconImage');
		$servicePostIcon = get_theme_mod('servicePostIcon', 'fa fa-medkit');
		$displayServicePostIcon = get_theme_mod('displayServicePostIcon', 'on');
	
		$post_query = new WP_Query($arguments);	

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="row">
	
            <?php if($enable_carousel === 'true') : ?>
                <div id="pm-servicesPosts-carousel">
            <?php endif; ?>            
                
                <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                
                    <?php if($enable_carousel !== 'true') : ?>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                   <?php endif; ?>
        
             
                        <?php 
						if ( has_post_thumbnail()) {
                          $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                        }			
                        ?>
                        
                        <div class="pm-servicesPosts-carousel-item '. ( $enable_carousel !== 'true' ? 'no-padding' : '' ) .'">
                        
                           <?php  $pm_services_image_meta = get_post_meta(get_the_ID(), 'pm_services_image_meta', true); ?>
                
                            <?php if( $pm_services_image_meta !== '' ) { ?>
                                <div class="pm-services-post" style="background-image:url(<?php echo esc_url($pm_services_image_meta); ?>);">
                            <?php } else { ?>
                                <div class="pm-services-post no-img">
                            <?php } ?>
                                    
                                <div class="pm-services-post-overlay">
                                    
                                    <?php if( $displayServicePostIcon === 'on' ) { ?>
                                        
                                        <?php if( !empty($servicePostIconImage) ) {  ?>
                                                            
                                            <div class="pm-services-post-icon"><img src="<?php echo esc_url($servicePostIconImage); ?>" width="33" height="41" alt="icon" /></div>
                                        
                                        <?php } else { ?>
                                        
                                            <div class="pm-services-post-icon"><i class="<?php esc_attr_e($servicePostIcon); ?>"></i></div>
                                        
                                        <?php }  ?>
                                        
                                    <?php } else { ?>
                                        
                                        <div class="pm-services-post-icon inactive"></div>
                                        
                                    <?php } ?>					
                                    
                                    <h6 class="pm-services-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                    
                                </div>
                            
                            </div>
                            
                            <?php $excerpt = get_the_excerpt(); ?>
                            
                            <div class="pm-services-post-excerpt">
                            
                                <p><?php echo pm_ln_string_limit_words($excerpt, 40); ?><a href="<?php the_permalink(); ?>"> [...]</a></p>
                                <a href="<?php the_permalink(); ?>" class="pm-rounded-btn no-border pm-center-align"><?php esc_attr_e('Read More', 'medicallinktheme'); ?> <i class="fa fa-plus"></i></a>
                                
                            </div>
                        
                        </div>
                    
                    
                    <?php if($enable_carousel !== 'true') : ?>
                        </div>
                    <?php endif; ?>
                
                <?php endwhile; else: ?>
                    <div class="col-lg-12 pm-column-spacing">
                     <p><?php esc_attr_e('No posts were found.', 'medicallinktheme'); ?></p>
                    </div>
                <?php endif; ?>
                                    
        
        <?php if($enable_carousel === 'true') : ?>
        
            </div>
        
            <?php if ($post_query->have_posts() && $display_controls === "true" ) : ?>
            
                <div class="pm-brand-carousel-btns services">
                    <a class="btn pm-owl-prev fa fa-chevron-left" id="pm-owl-next-services"></a>
                    <a class="btn pm-owl-next fa fa-chevron-right" id="pm-owl-prev-services"></a>
                </div>
            
            <?php endif; ?>
            
        <?php endif; ?>
        
        </div>
        
        <!-- Element Code / END -->
        
        <?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_service_posts",
    "name"      => __("Service Posts", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Post Count", 'medicallinktheme'),
            "param_name" => "post_count",
            "description" => __("Set the amount of posts you would like fetch. Set value to -1 to retrieve all service posts.", 'medicallinktheme'),
			"value"      => array( '-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
			
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'medicallinktheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which service posts are displayed.", 'medicallinktheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Category", 'medicallinktheme'),
            "param_name" => "category",
            "description" => __("Enter a category slug to retrieve service posts based on their assigned category.", 'medicallinktheme'),
			"value" => ''
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Enable Carousel mode?", 'medicallinktheme'),
            "param_name" => "enable_carousel",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => array( 'true' => 'true', 'false' => 'false'), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Carousel Controls?", 'medicallinktheme'),
            "param_name" => "display_controls",
            //"description" => __("Choose the divider style you desire.", 'medicallinktheme'),
			"value"      => array( 'true' => 'true', 'false' => 'false'), //Add default value in $atts
        ),	
	
	
    )

));