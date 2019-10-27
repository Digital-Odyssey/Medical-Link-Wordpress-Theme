<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_post_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_num_of_posts" => '',
			"el_post_order" => 'DESC',
			"el_tag" => '',
			"el_category" => '',
			"el_class" => '',
			"display_controls" => 'true',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
		//Fetch data
		if($el_tag !== ''){
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => (string) $el_post_order,
				'tax_query' => array(
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => array( $el_tag )
						)
				),
				//'posts_per_page' => -1,
				'post_count' => $el_num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		} else if($el_category !== '') {
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => (string) $el_post_order,
				'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => array( $el_category )
						)
				),
				//'posts_per_page' => -1,
				'post_count' => $el_num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				//'posts_per_page' => -1,
				'order' => (string) $el_post_order,
				'post_count' => $el_num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		}	
		
		$displayPostIcon = get_theme_mod('displayPostIcon', 'on');
	
		$post_query = new WP_Query($arguments);

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div<?php echo ($el_num_of_posts > 3 ? ' id="pm-postItems-carousel"' : ''); ?>>
		
            <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
            
            
            	<?php
				
                $categories = get_the_category();
                $postIconImage = get_theme_mod('postIconImage');
                $postIcon = get_theme_mod('postIcon', 'fa fa-newspaper-o');
				$displayPostDate = get_theme_mod('displayPostDate', 'on');
         
                if ( has_post_thumbnail()) {
                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                }	
				
				?>		
                
                <?php if($num_of_posts == "1"){ ?>
                    <div class="col-lg-12">
                <?php } elseif($num_of_posts == "2") { ?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                <?php } elseif($num_of_posts == "3") { ?>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                <?php } else { ?>
                    <div class="pm-postItem-carousel-item">	
                <?php } ?>
                
                    <article class="pm-column-spacing <?php esc_attr_e($el_class); ?>">
                        <?php  if($categories){ ?>
                            <?php  foreach($categories as $category) { ?>
                                <p class="pm-standalone-news-post-category"><a href="<?php echo get_category_link( $category->term_id ); ?>"><span><?php echo $category->cat_name; ?></span></a></p>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if( has_post_thumbnail() ) { ?>
                        
                        	<div class="pm-standalone-news-post">
                                <img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title(); ?>" />
                            </div>
                        
                        <?php } else { ?>
                        
                        	<div class="pm-standalone-news-post no-img"></div>
                        
                        <?php } ?>
                        
                        <div class="pm-standalone-news-post-overlay">
                        
                            <?php if($displayPostIcon === 'on') { ?>
                                
                                <?php  if(!empty($postIconImage)) { ?>
                                
                                    <div class="pm-standalone-news-post-icon">
                                        <img src="<?php echo esc_url($postIconImage); ?>" width="33" height="41" alt="<?php  esc_attr_e('icon', 'medicallinktheme'); ?>">
                                    </div>
                                    
                                <?php } else { ?>
                                    
                                    <div class="pm-standalone-news-post-icon">
                                        <i class="<?php esc_attr_e($postIcon) ?>"></i>
                                    </div>
                                    
                                <?php }	?>
                                
                            <?php } else { ?>
                                
                                <div class="pm-standalone-news-post-icon inactive"></div>
                                
                            <?php } ?>
                            
                                                
                            <h6 class="pm-standalone-news-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                            
                            <?php if( $displayPostDate === 'on' ) : ?>
                            	<p class="pm-standalone-news-post-date"><?php echo get_the_time( 'M' ).' '.get_the_time( 'd' ).', '.get_the_time( 'Y' ).' '.esc_attr__('by', 'medicallinktheme').' '.get_the_author(); ?></p>
                            <?php endif; ?>
                            
                            
                            <?php  
								$num_comments = get_comments_number(); 
								if ( comments_open() ) {
									if ( $num_comments == 0 ) {
										$comments = esc_attr__('No Comments', 'medicallinktheme');
									} elseif ( $num_comments > 1 ) {
										$comments = $num_comments . esc_attr__(' Comments', 'medicallinktheme');
									} else {
										$comments = esc_attr__('1 Comment', 'medicallinktheme');
									}
								} 
							?>
                            <p class="pm-standalone-news-post-comment-count"><?php esc_attr_e($comments); ?></p>
                            
                        </div>
                        
                        <div class="pm-standalone-news-post-excerpt">
                            <?php  $the_excerpt = get_the_excerpt(); ?>
                            <p><?php echo pm_ln_string_limit_words($the_excerpt, 15); ?> <a href="<?php the_permalink(); ?>">[...]</a> </p>
                            <a href="<?php the_permalink(); ?>" class="pm-rounded-btn pm-center-align"><?php  esc_attr_e('View Post', 'medicallinktheme'); ?>  <i class="fa fa-plus"></i></a>
                        </div>
                    </article>
                
                </div>
            
            <?php  endwhile; else: ?>
                <div class="col-lg-12 pm-column-spacing">
                 <p><?php esc_attr_e('No posts were found.', 'medicallinktheme'); ?></p>
                </div>
            <?php endif; ?>
            
        
        </div>
        
        <?php if ($post_query->have_posts() && $display_controls === "true" ) : ?>
            
            <div class="pm-brand-carousel-btns services news">
                <a class="btn pm-owl-prev fa fa-chevron-left" id="pm-owl-news-next-services"></a>
                <a class="btn pm-owl-next fa fa-chevron-right" id="pm-owl-news-prev-services"></a>
            </div>
        
        <?php endif; ?>
                    
        <?php wp_reset_postdata(); ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_post_items",
    "name"      => __("News Posts", 'medicallinktheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Medical-Link Shortcodes", 'medicallinktheme'),
    "params"    => array(

		
		array(
            "type" => "dropdown",
            "heading" => __("Amount of News Posts to display:", 'medicallinktheme'),
            "param_name" => "el_num_of_posts",
            "description" => __("Choose how many news posts you would like to display.", 'medicallinktheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'medicallinktheme'),
            "param_name" => "el_post_order",
            "description" => __("Set the order in which news posts will be displayed.", 'medicallinktheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Tag slug", 'medicallinktheme'),
            "param_name" => "el_tag",
            "description" => __("Enter a tag slug to display news posts by a specific tag.", 'medicallinktheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Category slug", 'medicallinktheme'),
            "param_name" => "el_category",
            "description" => __("Enter a category slug to display news posts by a specific category.", 'medicallinktheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'medicallinktheme'),
            "param_name" => "el_class",
            "description" => __("Apply a custom CSS class if required.", 'medicallinktheme'),
			"value"      => '', //Add default value in $atts
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