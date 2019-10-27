<?php
/*-----------------------------------------------------------------------------------*/
/*	Theme Shortcodes
/*-----------------------------------------------------------------------------------*/

// This function will run to make sure that column shortcodes run after wp_texturize so that stray paragraph and line break tags aren't added.
function pm_ln_run_shortcode( $content ) {
	
    //global $shortcode_tags;
    //Backup current registered shortcodes and clear them all out
    //$orig_shortcode_tags = $shortcode_tags;
    //remove_all_shortcodes();
	
	add_shortcode("timeTableGroup", "timeTableGroup");//COMPLETE
	add_shortcode("timeTableItem", "timeTableItem");//COMPLETE
	add_shortcode("dataTableGroup", "dataTableGroup");//COMPLETE
	add_shortcode("dataTableItem", "dataTableItem");//COMPLETE
	add_shortcode("sliderCarousel", "sliderCarousel");//COMPLETE
	add_shortcode("sliderItem", "sliderItem");//COMPLETE
	add_shortcode("tabGroup", "tabGroup");//COMPLETE
	add_shortcode("tabItem", "tabItem");//COMPLETE
	add_shortcode("accordionGroup", "accordionGroup");//COMPLETE
	add_shortcode("accordionItem", "accordionItem");//COMPLETE
	add_shortcode("newsletterSignup", "newsletterSignup");//COMPLETE
	add_shortcode("panelsCarousel", "panelsCarousel");//COMPLETE
	add_shortcode("clientCarousel", "clientCarousel");//COMPLETE
	add_shortcode("testimonials", "testimonials");//COMPLETE
	add_shortcode("pricingTable", "pricingTable");//COMPLETE
	add_shortcode("postItems", "postItems");//COMPLETE	
	add_shortcode("videoBox", "videoBox");//COMPLETE	
	add_shortcode("vimeoVideo", "vimeoVideo");//COMPLETE
	add_shortcode("html5Video", "html5Video");//COMPLETE
	add_shortcode("youtubeVideo", "youtubeVideo");//COMPLETE
	add_shortcode("googleMap", "googleMap");//COMPLETE
	add_shortcode("divider", "divider");//COMPLETE
	add_shortcode("progressBar", "progressBar");//COMPLETE
	add_shortcode("iconElement", "iconElement");//COMPLETE
	add_shortcode("contactForm", "contactForm");//COMPLETE
	add_shortcode("alert", "alert");//COMPLETE	
	add_shortcode("quoteBox", "quoteBox"); //COMPLETE	
	add_shortcode("testimonialProfile", "testimonialProfile");//COMPLETE
	add_shortcode("piechart", "piechart");//COMPLETE
	add_shortcode("standardButton", "standardButton");//COMPLETE
	add_shortcode("milestone", "milestone");//COMPLETE
	
	add_shortcode("servicesPosts", "servicesPosts");//COMPLETE
	add_shortcode("staffPosts", "staffPosts");//COMPLETE
	add_shortcode("staffProfile", "staffProfile");//COMPLETE
	add_shortcode("ctaBox", "ctaBox");//COMPLETE
	
	add_shortcode("microSlider", "microSlider");//COMPLETE
	
	
	//Bootstrap 3
	add_shortcode("bootstrapContainer", "bootstrapContainer");//COMPLETE
	add_shortcode("bootstrapRow", "bootstrapRow");//COMPLETE
	add_shortcode("bootstrapColumn", "bootstrapColumn");//COMPLETE
	add_shortcode("nestedRow", "nestedRow");//COMPLETE
	add_shortcode("nestedColumn", "nestedColumn");//COMPLETE
	
    // Do the shortcode (only the one above is registered)
    //$content = do_shortcode( $content );
    // Put the original shortcodes back
    // $shortcode_tags = $orig_shortcode_tags;
    return $content;
}
add_filter( 'the_content', 'pm_ln_run_shortcode', 7 );
add_filter( 'widget_text', 'pm_ln_run_shortcode', 7 );




//PULSE SLIDER
function microSlider($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"id" => '',
		), 
	$atts));
	
	$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');
	
	global $medicallink_options;
			
	$slides = '';
	
	if( isset($medicallink_options['opt-pulse-slides']) && !empty($medicallink_options['opt-pulse-slides']) ){
		$slides = $medicallink_options['opt-pulse-slides'];
	}
	
	if(is_array($slides)) :
				
		$sliderCounter = 0;

		if(count($slides) > 0){
			
			echo '<div class="pm-pulse-container" id="pm-pulse-container">';
			
				echo '<div id="pm-pulse-loader"><img src="'.get_template_directory_uri().'/js/pulse/img/ajax-loader.gif" alt="'.esc_attr__('slider loading', 'medicallinktheme').'" /></div>';
				
				echo '<div id="pm-slider" class="pm-slider'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
				
					echo '<div id="pm-slider-progress-bar"></div>';
					
					echo '<ul class="pm-slides-container" id="pm_slides_container">';
					
						foreach($slides as $s) {
							
							$title = '';
							$subTitle = '';
							$btnText = '';
							$btnUrl = '';
																
							if(!empty($s['title'])){
								$titlePieces = explode(" - ", $s['title']);
								$title = $titlePieces[0];
								$subTitle = $titlePieces[1];
							}
							
							if(!empty($s['url'])){
								$pieces = explode(" - ", $s['url']);
								$btnText = $pieces[0];
								$btnUrl = $pieces[1];
							}
							
							echo '<li data-thumb="'.$s['image'].'" class="pmslide_'.$sliderCounter.'"><img src="'.$s['image'].'" alt="Slider image '.$sliderCounter.'" />';
			
								echo '<div class="pm-holder'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
									echo '<div class="pm-caption'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
									
										  if( !empty($s['title']) ) :
											  echo '<h1>'.esc_attr__($title, 'medicallinktheme').'</h1>';
										  endif;
										  
										  if( !empty($s['title']) ) :
										  
											  echo '<span class="pm-caption-decription'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
												echo esc_attr__($subTitle, 'medicallinktheme');
											  echo '</span>';
											  
										  endif;
										  
										  if( !empty($s['description']) ) :
										  
											  echo '<span class="pm-caption-excerpt'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
												echo esc_attr__($s['description'], 'medicallinktheme');
											  echo '</span>';
										  
										  endif;
										  
										  if( !empty($s['description']) ) :
										  
											  echo '<a href="'.$btnUrl.'" class="pm-slide-btn'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">'.esc_attr__($btnText, 'medicallinktheme').' <i class="fa fa-plus"></i></a>';
											
										  endif;
										  
										  
									echo '</div>';
								echo '</div>';
							
							echo '</li> ';
							
							$sliderCounter++;
									
						}
													
					echo '</ul>';
				
				echo '</div>';
			
			echo '</div>';
			
		}//end of if
			
		
	
	endif;//endif
	
}

//SINGLE TESTIMONIAL
function testimonialProfile($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"name" => '',
		"title" => '',
		"date" => '',
		"image" => '',
		"icon_image" => ''
		), 
	$atts));
	
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial-shortcode">';
		$html .= '<div style="background-image:url('.$image.');" class="pm-single-testimonial-img-bg">';
			
		if($icon_image !== '') :
			$html .= '<div class="pm-single-testimonial-avatar-icon">';
				$html .= '<img width="33" height="41" class="img-responsive" src="'.$icon_image.'">';
			$html .= '</div>';
		endif;
			
		$html .= '</div>';
		$html .= '<p class="name">'.$name.'</p>';
		$html .= '<p class="title">'.$title.'</p>';
		$html .= '<div class="pm-single-testimonial-divider"></div>';
		$html .= '<p class="quote">'.$content.'</p>';
		$html .= '<div class="pm-single-testimonial-divider"></div>';
		$html .= '<p class="date">'.$date.'</p>';
	
	$html .= '</div>';

	
	return $html;
	
}


//STAFF POSTS
function staffPosts($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"post_order" => 'DESC',
		"staff_title" => ''
		), 
	$atts));
	
	//Fetch data
	if($staff_title !== '') {
		
		$arguments = array(
			'post_type' => 'post_staff',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'posts_per_page' => -1,
			'tax_query' => array(
					array(
						'taxonomy' => 'staff_cats',
						'field' => 'slug',
						'terms' => array( $staff_title )
					)
			),
			
		);
		
	} else {
		
		$arguments = array(
			'post_type' => 'post_staff',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'order' => (string) $post_order,
		);
		
	}	
	
	$pm_staff_post_view_btn_text = get_option('pm_staff_post_view_btn_text');

	$post_query = new WP_Query($arguments);

	pm_ln_set_query($post_query);
	
	$html = '';
	
	$html .= '<div class="row">';
	
	//Display Items		
	if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
		
		$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
		$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
		$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
		$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
		$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
		$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
		$pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
		$pm_staff_quote_meta = get_post_meta(get_the_ID(), 'pm_staff_quote_meta', true);	
		
		$html .= '<div class="col-lg-4 col-md-4 col-sm-12">';
		
			$html .= '<div class="pm-staff-profile-parent-container">';
    
				$html .= '<div class="pm-staff-profile-container" style="background-image:url('. esc_url(esc_html($pm_staff_image_meta)) .');">';
			
					$html .= '<div class="pm-staff-profile-overlay-container">';
					
						$html .= '<ul class="pm-staff-profile-icons">';
							
							if($pm_staff_twitter_meta !== '') :
							
								$html .= '<li><a href="'. esc_html($pm_staff_twitter_meta) .'" target="_blank" class="fa fa-twitter"></a></li>';
							
							endif;
						
							if($pm_staff_facebook_meta !== '') :
							
								$html .= '<li><a href="'. esc_html($pm_staff_facebook_meta) .'" target="_blank" class="fa fa-facebook"></a></li>';
							
							endif;
							
							if($pm_staff_gplus_meta !== '') :
							
								$html .= '<li><a href="'. esc_html($pm_staff_gplus_meta) .'" target="_blank" class="fa fa-google-plus"></a></li>';
							
							endif; 
							
							if($pm_staff_linkedin_meta !== '') :
							
								$html .= '<li><a href="'. esc_html($pm_staff_linkedin_meta) .'" target="_blank" class="fa fa-linkedin"></a></li>';
							
							endif; 
							
							if($pm_staff_email_address_meta !== '') :
							
								$html .= '<li><a href="mailto:'. esc_attr($pm_staff_email_address_meta) .'" target="_blank" class="fa fa-envelope"></a></li>';
							
							endif;
							
						$html .= '</ul>';
						
						$html .= '<div class="pm-staff-profile-quote">';
							$html .= '<p>'. esc_attr($pm_staff_quote_meta) .'</p>';
							
							if( !empty($pm_staff_post_view_btn_text) ) {
								$html .= '<a href="'. get_the_permalink() .'" class="pm-square-btn pm-center-align">'. esc_attr($pm_staff_post_view_btn_text) .'</a>';
							} else {
								$html .= '<a href="'. get_the_permalink() .'" class="pm-square-btn pm-center-align">'. esc_attr__('View profile', 'medicallinktheme') .'</a>';
							}
							
							
						$html .= '</div>';
					
					$html .= '</div>';
											
					$html .= '<a href="#" class="pm-staff-profile-expander fa fa-plus"></a>';
										
				$html .= '</div>';
				
				$html .= '<div class="pm-staff-profile-info">';
					$html .= '<p class="pm-staff-profile-name">'. get_the_title() .'</p>';
					$html .= '<p class="pm-staff-profile-title">'. esc_attr($pm_staff_title_meta) .'</p>';
				$html .= '</div>';
				
			$html .= '</div> ';
		
		$html .= '</div>';
	
	endwhile; else:
		$html .= '<div class="col-lg-12 pm-column-spacing">';
		 $html .= '<p>'.esc_attr__('No staff profiles were found.', 'medicallinktheme').'</p>';
		$html .= '</div>';
	endif;
	
	$html .= '</div>';
				
	pm_ln_restore_query();
	
	return $html;
	
		
}



//SERVICES POSTS
function servicesPosts($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"post_order" => 'DESC',
		"category" => '',
		"display_controls" => 'true',
		"enable_carousel" => 'true',
		"post_count" => '3'
		), 
	$atts));
	
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

	pm_ln_set_query($post_query);
	
	$html = '';
	
	$html .= '<div class="row">';
	
		//Display Items
		if($enable_carousel === 'true') :
			$html .= '<div id="pm-servicesPosts-carousel">';
		endif;
		
			
			if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
			
				if($enable_carousel !== 'true') :
					$html .= '<div class="col-lg-4 col-md-4 col-sm-12">';
				endif;
	
		 
					if ( has_post_thumbnail()) {
					  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					}			
					
					
					$html .= '<div class="pm-servicesPosts-carousel-item '. ( $enable_carousel !== 'true' ? 'no-padding' : '' ) .'">';
					
						$pm_services_image_meta = get_post_meta(get_the_ID(), 'pm_services_image_meta', true);
			
						if( $pm_services_image_meta !== '' ) {
							$html .= '<div class="pm-services-post" style="background-image:url('. esc_url(esc_html($pm_services_image_meta)) .');">';
						} else {
							$html .= '<div class="pm-services-post no-img">';
						}
								
							$html .= '<div class="pm-services-post-overlay">';
								
								if( $displayServicePostIcon === 'on' ) {
									
									if( !empty($servicePostIconImage) ) { 
														
										$html .= '<div class="pm-services-post-icon"><img src="'. esc_url(esc_html($servicePostIconImage)) .'" width="33" height="41" alt="icon" /></div>';
									
									} else {
									
										$html .= '<div class="pm-services-post-icon"><i class="'. esc_attr($servicePostIcon) .'"></i></div>';
									
									} 
									
								} else {
									
									$html .= '<div class="pm-services-post-icon inactive"></div>';
									
								}							
								
								$html .= '<h6 class="pm-services-post-title"><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h6>';
								
							$html .= '</div>';
						
						$html .= '</div>';
						
						$excerpt = get_the_excerpt();
						
						$html .= '<div class="pm-services-post-excerpt">';
						
							$html .= '<p>'. pm_ln_string_limit_words($excerpt, 40).'<a href="'. get_the_permalink() .'"> [...]</a></p>';
							$html .= '<a href="'. get_the_permalink() .'" class="pm-rounded-btn no-border pm-center-align">'. esc_attr__('Read More', 'medicallinktheme') .'  <i class="fa fa-plus"></i></a>';
							
						$html .= '</div>';
					
					$html .= '</div>';
				
				
				if($enable_carousel !== 'true') :
					$html .= '</div>';
				endif;
			
			endwhile; else:
				$html .= '<div class="col-lg-12 pm-column-spacing">';
				 $html .= '<p>'.esc_attr__('No posts were found.', 'medicallinktheme').'</p>';
				$html .= '</div>';
			endif;
								
	
	if($enable_carousel === 'true') :
	
		$html .= '</div>';
	
		if ($post_query->have_posts() && $display_controls === "true" ) :
		
			$html .= '<div class="pm-brand-carousel-btns services">';
				$html .= '<a class="btn pm-owl-prev fa fa-chevron-left" id="pm-owl-next-services"></a>';
				$html .= '<a class="btn pm-owl-next fa fa-chevron-right" id="pm-owl-prev-services"></a>';
			$html .= '</div>';
		
		endif;
		
	endif;
	
	$html .= '</div>';
				
	pm_ln_restore_query();
	
	return $html;
	
		
}




//POST ITEMS
function postItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"post_order" => 'DESC',
		"tag" => '',
		"category" => '',
		"class" => '',
		'display_controls' => 'true'
		), 
	$atts));
	
	//Fetch data
	if($tag !== ''){
		
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field' => 'slug',
						'terms' => array( $tag )
					)
			),
			//'posts_per_page' => -1,
			'post_count' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
	} else if($category !== '') {
		
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => array( $category )
					)
			),
			//'posts_per_page' => -1,
			'post_count' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
	} else {
		
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => (string) $post_order,
			'post_count' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
	}	
	
	$displayPostIcon = get_theme_mod('displayPostIcon', 'on');

	$post_query = new WP_Query($arguments);

	pm_ln_set_query($post_query);

	$animationCounter = 3;
	
	$html = '';
	
	//Display Items
	$html .= '<div'. ($num_of_posts > 3 ? ' id="pm-postItems-carousel"' : '') .'>';
		
		if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
		
			$categories = get_the_category();
			$postIconImage = get_theme_mod('postIconImage');
			$postIcon = get_theme_mod('postIcon', 'fa fa-newspaper-o');
			$displayPostDate = get_theme_mod('displayPostDate', 'on');	
			
			if($num_of_posts == "1"){
				$html .= '<div class="col-lg-12">';
			} elseif($num_of_posts == "2") {
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
			} elseif($num_of_posts == "3") {
				$html .= '<div class="col-lg-4 col-md-4 col-sm-12">';
			} else {
				$html .= '<div class="pm-postItem-carousel-item">';	
			}
			
				$html .= '<article class="pm-column-spacing '.$class.'">';
					if($categories){
						foreach($categories as $category) {
							$html .= '<p class="pm-standalone-news-post-category"><a href="'.get_category_link( $category->term_id ).'"><span>'.$category->cat_name.'</span></a></p>';
						}
					}

					if(has_post_thumbnail()) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
						$html .= '<div class="pm-standalone-news-post">';
							$html .= '<img src="'.esc_html($image_url[0]).'" alt="'.get_the_title().'" />';
						$html .= '</div>';
					}					
					
					$html .= '<div class="pm-standalone-news-post-overlay">';
					
						if($displayPostIcon === 'on') {
							
							if(!empty($postIconImage)) {
							
								$html .= '<div class="pm-standalone-news-post-icon">';
									$html .= '<img src="'.esc_html($postIconImage).'" width="33" height="41" alt="'.esc_attr__('icon', 'medicallinktheme').'">';
								$html .= '</div>';
								
							} else {
								
								$html .= '<div class="pm-standalone-news-post-icon">';
									$html .= '<i class="'.$postIcon.'"></i>';
								$html .= '</div>';
								
							}	
							
						} else {
							
							$html .= '<div class="pm-standalone-news-post-icon inactive"></div>';
							
						}
						
											
						$html .= '<h6 class="pm-standalone-news-post-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>';
						
						if( $displayPostDate === 'on' ) :
                            $html .= '<p class="pm-standalone-news-post-date">'.get_the_time( 'M' ).' '.get_the_time( 'd' ).', '.get_the_time( 'Y' ).' '.esc_attr__('by', 'medicallinktheme').' '.get_the_author().'</p>';
                        endif;						
						
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
						$html .= '<p class="pm-standalone-news-post-comment-count">' . $comments . '</p>';
						
						
					$html .= '</div>';
					
					$html .= '<div class="pm-standalone-news-post-excerpt">';
						$the_excerpt = get_the_excerpt();
						$html .= '<p>'.pm_ln_string_limit_words($the_excerpt, 15).' <a href="'.get_the_permalink().'">[...]</a> </p>';
						$html .= '<a href="'.get_the_permalink().'" class="pm-rounded-btn pm-center-align">'.esc_attr__('View Post', 'medicallinktheme').'  <i class="fa fa-plus"></i></a>';
					$html .= '</div>';
				$html .= '</article>';
				
				$animationCounter += 3;
			
			$html .= '</div>';
		
		endwhile; else:
			$html .= '<div class="col-lg-12 pm-column-spacing">';
			 $html .= '<p>'.esc_attr__('No posts were found.', 'medicallinktheme').'</p>';
			$html .= '</div>';
		endif;
	
	$html .= '</div>';
	
	if ($post_query->have_posts() && $display_controls === "true" ) :
            
        $html .= '<div class="pm-brand-carousel-btns services news">';
            $html .= '<a class="btn pm-owl-prev fa fa-chevron-left" id="pm-owl-news-next-services"></a>';
            $html .= '<a class="btn pm-owl-next fa fa-chevron-right" id="pm-owl-news-prev-services"></a>';
        $html .= '</div>';
    
    endif;
				
	pm_ln_restore_query();
	
	return $html;
	
		
}

//STAFF PROFILE
function staffProfile( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"id" => 0,
		"name_color" => '#0db7c4',
		"title_color" => '#f15b5a',
		), 
	$atts));

	
	//Method to retrieve a single post
	$queried_post = get_post($id);

	if(!$queried_post) {
		return;
	}

	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 20);
	
	$pm_staff_image_meta = get_post_meta($postID, 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta($postID, 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta($postID, 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta($postID, 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta($postID, 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta($postID, 'pm_staff_linkedin_meta', true);
	$pm_staff_email_address_meta = get_post_meta($postID, 'pm_staff_email_address_meta', true);
	$pm_staff_quote_meta = get_post_meta($postID, 'pm_staff_quote_meta', true);
	
	$pm_staff_post_view_btn_text = get_option('pm_staff_post_view_btn_text');
	
	$html = '';
	
	$html .= '<div class="pm-staff-profile-parent-container">';
                    
		$html .= '<div class="pm-staff-profile-container" style="background-image:url('.esc_html($pm_staff_image_meta).');">';
	
			$html .= '<div class="pm-staff-profile-overlay-container">';
			
				$html .= '<ul class="pm-staff-profile-icons">';
				
					if($pm_staff_twitter_meta !== '') :
				
						$html .= '<li>';
							$html .= '<a href="'.esc_html($pm_staff_twitter_meta).'" class="fa fa-twitter"></a>';
						$html .= '</li>';
					
					endif;
					
					if($pm_staff_facebook_meta !== '') :
					
						$html .= '<li>';
							$html .= '<a href="'.esc_html($pm_staff_facebook_meta).'" class="fa fa-facebook"></a>';
						$html .= '</li>';
					
					endif;
					
					if($pm_staff_gplus_meta !== '') :
					
						$html .= '<li>';
							$html .= '<a href="'.esc_html($pm_staff_gplus_meta).'" class="fa fa-google-plus"></a>';
						$html .= '</li>';
					
					endif;
					
					if($pm_staff_linkedin_meta !== '') :
					
						$html .= '<li>';
							$html .= '<a href="'.esc_html($pm_staff_linkedin_meta).'" class="fa fa-linkedin"></a>';
						$html .= '</li>';
					
					endif;
					
					if($pm_staff_email_address_meta !== '') :
					
						$html .= '<li>';
							$html .= '<a href="mailto:'.esc_html($pm_staff_email_address_meta).'" class="fa fa-envelope"></a>';
						$html .= '</li>';
					
					endif;
				
				$html .= '</ul>';
				
				$html .= '<div class="pm-staff-profile-quote">';
				
					$html .= '<p>'. esc_attr($pm_staff_quote_meta) .'</p>';
					
					if($pm_staff_post_view_btn_text !== '') {
						$html .= '<a href="'.get_permalink($postID).'" class="pm-square-btn pm-staff-profile-btn pm-center-align">'.esc_attr($pm_staff_post_view_btn_text).'</a>';
					} else {
						$html .= '<a href="'.get_permalink($postID).'" class="pm-square-btn pm-staff-profile-btn pm-center-align">'.esc_attr__('View profile', 'medicallinktheme').'</a>';
					}
					
				$html .= '</div>';
			
			$html .= '</div>';
							
			if( !empty($pm_staff_quote_meta) ) {
				$html .= '<a href="#" class="pm-staff-profile-expander fa fa-plus"></a>';
			} else {
				$html .= '<a href="'.get_permalink($postID).'" class="pm-staff-profile-expander fa fa-plus"></a>';
			}					
			
								
		$html .= '</div>';
		
		$html .= '<div class="pm-staff-profile-info">';
			$html .= '<p class="pm-staff-profile-name" style="color:'.$name_color.' !important;">'.$postTitle.'</p>';
			$html .= '<p class="pm-staff-profile-title" style="color:'.$title_color.' !important;">'. esc_attr__($pm_staff_title_meta, 'medicallinktheme') .'</p>';
		$html .= '</div>';
		
	$html .= '</div>';
		
		
	return $html;
	
}

//NEWSLETTER SIGNUP
function newsletterSignup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"mailchimp_url" => '',
		"name_placeholder" => 'Your Name',
		"email_placeholder" => 'Email Address',
		"class" => ''
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-newsletter-form-container">';
		$html .= '<form novalidate target="_blank" class="validate" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post" action="'.esc_html($mailchimp_url).'">';
			$html .= '<input type="text" placeholder="'.$name_placeholder.'" id="MERGE1" name="MERGE1">';
			$html .= '<input type="text" placeholder="'.$email_placeholder.'" id="MERGE0" name="MERGE0">';
			$html .= '<input type="submit" class="pm-newsletter-submit-btn" value="'.esc_attr__('Subscribe', 'medicallinktheme').' &plus;" id="mc-embedded-subscribe" name="subscribe">';
		$html .= '</form>';
	$html .= '</div>';
					 
	return $html;
	
}



//DATA TABLE GROUP
function dataTableGroup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_date_table_item_id'] = (int) $id;
	$GLOBALS['pm_date_table_item_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['dataTableItems'. $GLOBALS['pm_date_table_item_id']] ) ){
	
		foreach( $GLOBALS['dataTableItems'. $GLOBALS['pm_date_table_item_id']] as $tableItem ){
			
			$items[] = '<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 pm-workshop-table-title"><p>'.$tableItem['title'].'</p></div><div class="col-lg-8 col-md-8 col-sm-12 pm-workshop-table-content"><p>'.$tableItem['content'].'</p></div></div>';
			
		}
		
		//return wrapper plus dataTableItems
		$return = '<div class="pm-workshop-table">'.implode( "\n", $items ).'</div>';
		
	}

	return $return;

}

function dataTableItem( $atts, $content = null ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title'

	), $atts));

	$x = $GLOBALS['pm_date_table_item_count'];

	$GLOBALS['dataTableItems' . $GLOBALS['pm_date_table_item_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_date_table_item_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_date_table_item_count']++;

}


//TABS
function tabGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_ln_tab_id'] = (int) $id;
	$GLOBALS['pm_ln_tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] ) ){
	
		foreach( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] as $tab ){
	
			$tabs[] = '<li><a data-toggle="tab" href="#'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['title'].'</a></li>';
		
			$panes[] = '<div class="tab-pane" id="'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['content'].'</div>';
	
		}

		$return = "\n".'<ul class="nav nav-tabs pm-nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content pm-tab-content shortcode">'.implode( "\n", $panes ).'</div>'."\n";

	}

	return $return;

}

function tabItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Tab %d'

	), $atts));

	$x = $GLOBALS['pm_ln_tab_count'];

	$GLOBALS['tabs' . $GLOBALS['pm_ln_tab_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_ln_tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_ln_tab_count']++;

}


//PRICING TABLE
function pricingTable($atts, $content = null) {

	extract(shortcode_atts(array(
		"title" => 'Silver',
		"featured" => 'no',
		"price" => '19',
		"currency_symbol" => '$',
		"subscript" => '/mo',
		"message" => '',
		"button_text" => 'Purchase Plan',
		"button_link" => '#',
		"bg_image" => '',
		"header_color" => '#0db7c4',
		"button_color" => '#0db7c4',
		"text_color" => 'grey'
		), 
	$atts));
	
	$html = '';
		
	$html .= '<div class="pm-pricing-table-container">';
		$html .= '<div class="pm-pricing-table-title" style="background-color:'.$header_color.';">';
			$html .= '<p>'.$title.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-pricing-table-price" '. ($bg_image !== '' ? 'style="background-image:url('.$bg_image.');"' : '') .'>';
			if($featured === 'yes') :
				$html .= '<div class="pm-pricing-table-featured"></div>';
				$html .= '<i class="fa fa-thumbs-up"></i>';
			endif;
			$html .= '<p class="price" style="color:'.$text_color.';"><sup>'.$currency_symbol.'</sup>'.$price.'<sub>'.$subscript.'</sub></p>';
			$html .= '<p class="details" style="color:'.$text_color.';">'.$message.'</p>';
		$html .= '</div>';
		$html .= $content;
		if($button_text !== ''){
			$html .= '<a href="'.$button_link.'" class="pm-pricing-table-btn" style="background-color:'.$button_color.';">'.$button_text.' &nbsp;<i class="fa fa-angle-right"></i></a>';
		}	
	$html .= '</div>';
	
	return $html;
	
}

//QUOTE BOX
function quoteBox($atts, $content = null){
	
	extract(shortcode_atts(array(
		"author_name" => '',
		"author_title" => '',
		"avatar" => '',
		"text_color" => 'white',
		"name_color" => '#4D4D4D'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial-container">';
		$html .= '<div class="pm-single-testimonial-box">';
			$html .= '<p style="color:'.$text_color.';">'.$content.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-single-testimonial-author-container">';
			$html .= '<div class="pm-single-testimonial-author-avatar">';
				$html .= '<img src="'.$avatar.'" width="74" height="74" alt="avatar">';
			$html .= '</div>';
			$html .= '<div class="pm-single-testimonial-author-info">';
				$html .= '<p class="name" style="color:'.$name_color.';">'.$author_name.'</p>';
				$html .= '<p class="title" style="color:'.$name_color.';">'.$author_title.'</p>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		
}

//PIE CHART
function piechart($atts, $content = null){
	
	extract(shortcode_atts(array(
			"bar_size" => 220,
			"line_width" => 12,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			"text_color" => "#ffffff",
			"percentage" => 75,
			"icon" => "typcn typcn-thumbs-up",
			"caption" => "Cost Reduction",
			"font_size" => 40
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div data-barsize="'.$bar_size.'" data-linewidth="'.$line_width.'" data-trackcolor="'.$track_color.'" data-barcolor="'.$bar_color.'" data-percent="'.$percentage.'" class="pm-pie-chart">';
		$html .= '<div class="pm-pie-chart-percent" style="font-size:'.$font_size.'px; color:'.$text_color.'">';
			$html .= '<span style="color:'.$text_color.'"></span>%';
		$html .= '</div>';			
	$html .= '</div>';
	$html .= '<div class="pm-pie-chart-description" style="color:'.$text_color.'">';
		$html .= '<i class="'.$icon.'" style="color:'.$text_color.'"></i>';
		$html .= $caption;
	$html .= '</div>';
	
	return $html;
	
}

//MILESTONE
function milestone($atts, $content = null){
	
	extract(shortcode_atts(array(
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#fff',
			"bg_color" => '#333',
			"text_color" => '#333333',
			"text_size" => '24',
			"border_radius" => '99',
			"padding" => '10',
			"width" => "100",
			"height" => "100",
			"font_size" => 60,	
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="milestone">';
		if($icon !== '') :
		$html .= '<i class="'.$icon.'" style="background-color:'.$bg_color.'; color:'.$icon_color.'; border-radius:'.$border_radius.'px; padding:'.$padding.'px; font-size:'.$font_size.'px; width:'.$width.'px; height:'.$height.'px;"></i>';
		endif;
		$html .= '<div class="milestone-content" style="font-size:'.$font_size.'px;"> ';                        
			$html .= '<span data-speed="'.(int)$speed.'" data-stop="'.(int)$stop.'" class="milestone-value" style="color:'.$text_color.'; font-size:'.$text_size.'px;"></span>';
			$html .= '<div class="milestone-description" style="font-size:'.$text_size.'px;">'.$caption.'</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}


//SLIDER CONTAINER
function customSlider($atts, $content = null){
	
	extract(shortcode_atts(array(
			"id" => ''
			), 
	$atts));
	
	return '<div class="pm-slider-container">'.$content.'</div>';
}

//GOOGLE MAP
function googleMap($atts, $content = null) {
	
    extract(shortcode_atts(array(
		"id" => 'myMap', 
		"type" => 'road', 
		"latitude" => '43.656885', 
		"longitude" => '-79.383904', 
		"zoom" => '13', 
		"message" => 'This is the message...',
		"responsive" => 1, 
		"width" => '300', 
		"height" => '450'
		), 
	$atts));
     
    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN"; 
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP"; 
         
    echo '<!-- Google Map -->
        <script type="text/javascript"> 
		(function($) {
			$(document).ready(function() {
			  function initializeGoogleMap() {
				  var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
				  var myOptions = {
					center: myLatlng, 
					zoom: '.$zoom.',
					mapTypeId: google.maps.MapTypeId.'.$mapType.'
				  };
				  var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);
				  var contentString = "'.$message.'";
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				  marker.setMap(map);
			  }
			  initializeGoogleMap();
			});
		})(jQuery);
        </script>';
     
	if($responsive == 1){
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:100%; height:'.$height.'px;" class="googleMap"></div>';
	} else {
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}
        
} 


//BOOTSTRAP ALERT
function alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "close" => 'true',
		"type" => 'success',
		"icon" => 'typcn typcn-tick',
    ), $atts)); 
	
	$html = '';
	
	$html .= '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
	  if($close == 'true'){
		 $html .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.esc_attr__('Close', 'medicallinktheme').'</span></button>';
	  }
	  $html .= '<i class="'.$icon.'"></i>';
	  $html .= $content;
	$html .= '</div>';
	
	return $html;

}

//DIVIDER
function divider( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "height" => '1',
		"width" => '80px',
		"bg_color" => '#34ceda',
		"margin_top" => 20,
		"margin_bottom" => 20,
		"alignment" => 'center',
		"display_icon" => "off"
    ), $atts)); 
	
	if($display_icon === 'on'){
		
		$dividerIconImage = get_theme_mod('dividerIconImage', '');
		
		return '<div class="pm-column-title-divider" style="border-top:1px solid '.$bg_color.'; height:'.$height.'px; width:'.$width.'; margin:'.$margin_top.'px '. ($alignment === 'center' ? 'auto' : '0px') .' '.$margin_bottom.'px;"><img width="29" height="29" alt="icon" src="'.$dividerIconImage.'"></div>';
	} else {
		return '<div class="pm-divider" style="height:'.$height.'px; width:'.$width.'; background-color:'.$bg_color.'; margin:'.$margin_top.'px '. ($alignment === 'center' ? 'auto' : '0px') .' '.$margin_bottom.'px;"></div>';
	}
	
	
	
}


//STANDARD BUTTON
function standardButton($atts, $content = null) {  
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"target" => '_self',
		"icon" => '',
		"text_color" => '#ffffff',
		"flip_colors" => "no",
		"animated" => 'off',
		"class" => ''
    ), $atts));  
	
	$html = '';
	
	$html .= '<a class="pm-rounded-btn '.($class !== '' ? $class : '').' '.($flip_colors === 'yes' ? 'flip_color' : '').' '. ( $animated == 'on' ? 'animated' : '' ) .'" href="'.$link.'" target="'.$target.'" style="margin-top:'.$margin_top.'px; color:'.$text_color.'; margin-bottom:'.$margin_bottom.'px;">'.$content.''. ($icon !== '' ? ' &nbsp;<i class="'.$icon.'"></i>' : '') .'</a>';
	
	return $html;
		 
}  


//PROGRESS BAR
function progressBar($atts) { 

	extract(shortcode_atts(array(  
        "percentage" => '50',
		"text" => '',
		"id" => 1
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-progress-bar-description" id="pm-progress-bar-desc-'.$id.'">';
		$html .= $text;
		$html .= '<div class="pm-progress-bar-diamond"></div>';
		$html .= '<span>'.$percentage.'%</span>';
	$html .= '</div>';
	$html .= '<div class="pm-progress-bar">'; 
		$html .= '<span data-width="'.$percentage.'" class="pm-progress-bar-outer" id="pm-progress-bar-'.$id.'">';
			$html .= '<span class="pm-progress-bar-inner"></span> ';
		$html .= '</span>';
	$html .= '</div>';
	
	return $html;

}



//IMAGE PANEL
function imagePanel($atts, $content = null) {
			
	extract( shortcode_atts( array(
		'icon' => 'fa fa-link',
		'link' => '',
		'image' => '',
	), $atts ) );
	
	$html = '';
    
    $html .= '<div class="pm_image_panel">';
        
		$html .= '<div class="pm-hover-item-image-panel">';
		
			$html .= '<div class="pm-hover-item-icon"><a class="'.$icon.'" href="'.$link.'"></a></div>';
		
			$html .= '<div class="pm-image-panel-hover"></div>';
		
			$html .= '<div class="pm-hover-item-image-panel-img"><img src="'.$image.'" /></div>';
			
		$html .= '</div>';   
    
    $html .= '</div>';
    
	return $html;
	
}



//CALL TO ACTION
function ctaBox($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => '',
		"text_color" => '#ffffff',
		"link" => '',
		"button_text" => "Purchase Now",
		"button_text_color" => "#000000",
		"target" => "_blank"
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-cta-message">';
		$html .= '<p class="pm-quantum-alert-title" style="color:'.$text_color.'">'.$title.'</p>';
		$html .= '<p class="pm-quantum-alert-details" style="color:'.$text_color.'">'.$content.'</p>';
		$html .= '<p class="pm-quantum-alert-btn"><a href="'.$link.'" class="pm-rounded-btn cta-btn" style="color:'.$button_text_color.' !important;" target="'.$target.'">'.$button_text.'</a></p>';
	$html .= '</div>';
	
	return $html;
	
}

//ICON  
function iconElement($atts, $content = null) {
	extract(shortcode_atts(array( 
		"link" => '',
        "icon" => 'fa fa-twitter',
		"icon_color" => '#ffffff',
		"target" => '_self'
    ), $atts));
		
	return '<a '. ($link !== '' ? 'href="'.$link.'" target="'.$target.'" ' : '') .' class="'.$icon.' pm-icon-btn" style="color:'.$icon_color.';"></a>';
	
} 

// YOUTUBE SHORTCODE
function youtubeVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="http://www.youtube.com/embed/'.$id.'" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}  


// VIMEO SHORTCODE
function vimeoVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;color=ffffff" width="'.$finalWidth.'" height="'.$height.'" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';  
}





// VIDEO BOX
function videoBox($atts) {  

    extract(shortcode_atts(array(  
		"icon" => 'fa fa-play',
		"video_link" => '',
		"video_image" => '',
		"gallery_link" => 'on',
		"gallery_link_text" => 'View our gallery',
		"gallery_link_url" => ''
    ), $atts));  
	
	$html = '';
	
	$html .= '<div class="pm-video-container" style="background-image:url('.$video_image.');">';
		$html .= '<div class="pm-video-overlay">';
			$html .= '<a href="'.$video_link.'" data-rel="prettyPhoto" class="pm-video-activator-btn '.$icon.' expand lightbox"></a>';
		$html .= '</div>';
	$html .= '</div>';
	
	if($gallery_link === 'on'):
		$html .= '<a class="pm-rounded-btn pm-center-align" href="'.$gallery_link_url.'">'.$gallery_link_text.' <i class="fa fa-plus"></i></a>';	
	endif;		
	
    return $html; 
}


//HTML5 VIDEO
function html5Video($atts, $content = null) {
	extract(shortcode_atts(array(  
        "webm" => '',
		"mp4" => '',
		"ogg" => '',
		'width' => '400',
		'height' => '400',
		"responsive" => 0,
    ), $atts)); 
	
	return '<div class="pm-video-container"><video id="pm-video-background" autoplay loop controls="true" muted="muted" preload="auto" volume="0"><source src="'.$mp4.'" type="video/mp4"><source src="'.$webm.'" type="video/webm"><source src="'.$ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video>'.do_shortcode($content).'</div>';
	
}


//TIME TABLE
function timeTableGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1',
		'expand_icon' => 'fa fa-caret-down'
	), $atts));
	
	$GLOBALS['pm_timetable_container_id'] = (int) $id;
	$GLOBALS['pm_timetable_accordion_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']] ) ){
	
		foreach( $GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']] as $item ){
	
			//Expanded code
			/*$panels[] = '
			<div class="pm-timetable-accordion-panel" id="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" style="background-color:'.$item['bg_color'].';">
			   <div class="pm-timetable-panel-heading">
				  <h3 class="pm-timetable-panel-title">
					<a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal" href="#"><i class="'.$item['icon'].'"></i>'.$item['title'].'</a>
				  </h3>
					<a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal pm-accordion-horizontal-open read-more" href="#">Open<i class="fa fa-caret-down"></i></a>
			   </div>
			   <div class="pm-timetable-panel-content">
				   <div class="pm-timetable-panel-content-body">'.$item['content'].'</div>
			   </div>
		    </div>
			';*/
			
			//Minified code
			$panels[] = '<div class="pm-timetable-accordion-panel" id="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" style="background-color:'.$item['bg_color'].';"><div class="pm-timetable-panel-heading"><h3 class="pm-timetable-panel-title"><a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal" href="#"><i class="'.$item['icon'].'"></i>'.$item['title'].'</a></h3><a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal pm-accordion-horizontal-open read-more" href="#">'. __('Open', 'medicallinktheme') .'<i class="'. $expand_icon .'"></i></a></div><div class="pm-timetable-panel-content"><div class="pm-timetable-panel-content-body">'.$item['content'].'</div></div></div>';
	
		}

		//return wrapper plus timeTableItems
		$return = '<div class="pm-timetable-container" id="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'">'.implode( "\n", $panels ).'</div>';

	}

	return $return;

}

function timeTableItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title',
		'icon' => 'fa fa-clock-o',
		'bg_color' => '#3dc5d0'

	), $atts));

	//fetch accordion count
	$x = $GLOBALS['pm_timetable_accordion_count'];

	//create accordions array
	$GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']][$x] = array( 
															'accordion_count' => $GLOBALS['pm_timetable_accordion_count'],
															'title' => sprintf( $title, $GLOBALS['pm_timetable_accordion_count'] ), 
															'icon' => $icon,
															'bg_color' => $bg_color,
															'content' =>  do_shortcode($content)
															);

	//increment accordion count
	$GLOBALS['pm_timetable_accordion_count']++;

}

//ACCORDION
function accordionGroup($atts, $content = null) { 

	extract(shortcode_atts(array(
		'id' => '1',
		'expand_options' => 'off',
		'link_color' => '#ffffff'
	), $atts));
	
	//$enableExpandAllAccordion = get_theme_mod('enableExpandAllAccordion', 'off');

	$GLOBALS['pm_ln_accordion_id'] = (int) $id;
	$GLOBALS['pm_ln_accordion_count'] = 0;
	                
				
	if( $expand_options === 'on' ) {
		
		return '<div class="pm-accordion-expand-buttons"><a class="pm-expand-all" id="pm-expand-'.$GLOBALS['pm_ln_accordion_id'].'" href="#" class="btn btn-default" role="button" style="color:'.$link_color.'">'. esc_attr__('Expand All', 'medicallinktheme') .'</a> <span style="color:'.$link_color.'">-</span> <a class="pm-collapse-all" id="pm-collapse-'.$GLOBALS['pm_ln_accordion_id'].'" href="#" class="btn btn-default" role="button" style="color:'.$link_color.'">'. esc_attr__('Collapse All', 'medicallinktheme') .'</a></div><div class="panel-group" id="accordion'.$GLOBALS['pm_ln_accordion_id'].'" role="tablist" aria-multiselectable="true">'.do_shortcode($content).'</div>';
		
	} else {
		return '<div class="panel-group" id="accordion'.$GLOBALS['pm_ln_accordion_id'].'" role="tablist" aria-multiselectable="true">'.do_shortcode($content).'</div>';
	}
	
    
	
}  

function accordionItem($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"title" => 'Accordion Item 1',
		"button_color" => '#34ceda',
		"button_text_color" => '#ffffff',
    ), $atts)); 
	
	$html = '';
	  
	 $html .= '<div class="panel panel-default">';
		$html .= '<div class="panel-heading" role="tab" id="heading'.$GLOBALS['pm_ln_accordion_count'].'">';
		
			$html .= '<h4 class="panel-title"><a class="pm-accordion-link" href="#'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" data-parent="#accordion'.$GLOBALS['pm_ln_accordion_id'].'" data-toggle="collapse" data-toggleById="collapse'.$GLOBALS['pm_ln_accordion_id'].'" style="background-color:'.$button_color.'; color:'.$button_text_color.';" aria-expanded="true">'.$title.'<i class="fa fa-plus"></i></a></h4>';
			
		$html .= '</div>';
		$html .= '<div id="'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$GLOBALS['pm_ln_accordion_count'].'">';
			$html .= '<div class="panel-body">';
				$html .= ''.do_shortcode($content).'';
			$html .= '</div>';
		$html .= '</div>';
	 $html .= '</div>';
	
	$GLOBALS['pm_ln_accordion_count']++;
	
    return $html;
	
} 

//BOOTSTRAP CAROUSEL
function sliderCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"animation" => 'slide',
    ), $atts)); 

	if(!isset($GLOBALS['pm_ln_carousel_count'])){
		$GLOBALS['pm_ln_carousel_count'] = 0;
		$GLOBALS['pm_ln_carousel_item_count_'.$GLOBALS['pm_ln_carousel_count']] = 0; 
	}
	
	$html = '';
	
	//$html .= '<div class="flexslider pm-post-slider" id="pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'" style="width:100%;"><ul class="slides">'.do_shortcode($content).'</ul></div>';	
		
	$html .= '<div id="pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" class="carousel '. ( $animation === 'fade' ? 'slide carousel-fade' : 'slide' ) .'" data-ride="carousel">';	
	  $html .= '<ol class="carousel-indicators">';
		$html .= '<li data-target="#pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide-to="0" class="active"></li>';
		$html .= '<li data-target="#pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide-to="1"></li>';
		$html .= '<li data-target="#pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide-to="2"></li>';	  
	  $html .= '</ol>';	
	  $html .= '<div class="carousel-inner">'.do_shortcode($content).'</div><a class="left carousel-control" href="#pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a>';
	  $html .= '<a class="right carousel-control" href="#pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'" data-slide="next">';
		$html .= '<span class="glyphicon glyphicon-chevron-right"></span>';
		$html .= '<span class="sr-only">Next</span>';
	  $html .= '</a>';
	$html .= '</div>';
	$html .= '<script>(function($) {$(document).ready(function(e) {$("#pm-bootstrap-carousel-'.$GLOBALS['pm_ln_carousel_count'].'").carousel(); })(jQuery);</script>';
	
	
	//increment for next possible carousel slider
	$GLOBALS['pm_ln_carousel_count']++;
	
    return $html;
	
}  

function sliderItem($atts, $content = null) {

	extract(shortcode_atts(array(  
		"img" => '',
		"title" => ''
    ), $atts)); 
		
	$html = '<div class="item'. ($GLOBALS['pm_ln_carousel_item_count_'.$GLOBALS['pm_ln_carousel_count']] == 0 ? ' active' : '') .'"><img src="' . $img . '" alt="' . $title . '"></div>';
	
	$GLOBALS['pm_ln_carousel_item_count_'.$GLOBALS['pm_ln_carousel_count']]++;
		
    return $html;
	
}  


//CLIENTS CAROUSEL
function clientCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_blank',
    ), $atts)); 
	
	
	//Redux options
	global $medicallink_options;
	
	$clients = '';
				
	if( isset($medicallink_options['opt-client-slides']) && !empty($medicallink_options['opt-client-slides']) ){
		$clients = $medicallink_options['opt-client-slides']; //This should return an empty array if no slides are present...not an undefined index notice
	}
	
	$html = '';
	
	if(is_array($clients)) :
	
		$html .= '<div id="pm-brands-carousel" class="owl-carousel owl-theme">';
		
			foreach($clients as $c) {
		
				$html .= '<div class="pm-brand-item">';
					$html .= '<img src="'.$c['image'].'" class="img-responsive" alt="'.$c['title'].'">';
					$html .= '<a href="http://'.$c['url'].'" target="'.$target.'">'.$c['url'].'</a>';
				$html .= '</div>';
			
			}//end of foreach
			
		$html .= '</div>';
		
		$html .= '<div class="pm-brand-carousel-btns">';
			$html .= '<a class="btn pm-owl-prev fa fa-chevron-left"></a>';
			$html .= '<a class="btn pm-owl-next fa fa-chevron-right"></a>';
		$html .= '</div>';
	
	endif;//end of if
	
    return $html;
	
}  


//PANELS CAROUSEL
function panelsCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_self',
    ), $atts)); 
	
	$html = '<ul class="pm-interactive-panels-carousel" id="pm-interactive-panels-owl">';
	
	//Redux options
	global $medicallink_options;
	
	$panels = '';
				
	if( isset($medicallink_options['opt-panel-slides']) && !empty($medicallink_options['opt-panel-slides']) ){
		$panels = $medicallink_options['opt-panel-slides'];
	}
	
	if(is_array($panels)){
			
		foreach($panels as $p) {
			
			$pieces = explode(" - ", $p['url']);
			
			$icon = $pieces[0];
			$url = $pieces[1];
			
			$html .= '<li>';
				$html .= '<div class="pm-icon-bundle">';
					$html .= '<i class="'.$icon.'"></i>';
					$html .= '<div class="pm-icon-bundle-content">';
						$html .= '<p><a href="'.$url.'" target="'.$target.'">'.$p['title'].' <i class="fa fa-angle-right"></i></a></p>';
					$html .= '</div>';
					$html .= '<div class="pm-icon-bundle-info">';
						$html .= '<p>'.$p['description'].'</p>';
					$html .= '</div>';
				 $html .= '</div>';
			$html .= '</li>';
			
		}//end of foreach
		
	}//end of if
			
	$html .= '</ul>';
	
    return $html;
	
}  


//PANEL HEADER
function panelHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"panel_style" => 1,
		"link" => '',
		"target" => '_self',
		"color" => '#00BC9D',
		"show_button" => 'true',
		"button_text" => '',
		"margin_bottom" => 10,
		"icon" => 'fa-link',
		"tip" => '',
		"bg_color" => '#F3F3F3',
    ), $atts));
		
	if($panel_style == 1){
		
		//panel header style 1
		if($show_button == 'true'){
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4><div class="pm_span_header_btn"><a class="pm-custom-button pm-btn-animated pm-btn-small pm-post-btn p_header" href="'.$link.'" target="'.$target.'"><span>'.$button_text.' <i class="fa '.$icon.'"></i></span></a></div></div>';
		} else {
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4></div>';
		}
		
	} elseif($panel_style == 2){
		
		//panel header style2
		if($show_button == 'true'){
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} elseif($panel_style == 3){
		
		//panel header style3
		if($show_button == 'true'){
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} else {
		return "";	
	}
	
     
}

//COLUMN HEADER
function columnHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"color" => 'grey',
		"margin_bottom" => 0
    ), $atts));
	
	return '<div class="pm-column-header" style="margin-bottom:'.$margin_bottom.'px;"><h2 style="border-bottom:1px solid '.$color.';">'.$content.'</h2><div class="pm-column-header-block" style="background-color:'.$color.';"></div></div>';
     
}

//TESTIMONIAL CAROUSEL
function testimonials($atts) {
	
	extract(shortcode_atts(array(  
        "icon_image" => '',
    ), $atts));
	
	$html = '';
	
	//Redux options
	global $medicallink_options;
	
	$testimonials = '';
				
	if( isset($medicallink_options['opt-testimonials-slides']) && !empty($medicallink_options['opt-testimonials-slides']) ){
		$testimonials = $medicallink_options['opt-testimonials-slides']; //This should return an empty array if no slides are present...not an undefined index notice
	}
	
	if(is_array($testimonials)) :
					
		$html .= '<div class="pm-testimonials-carousel" id="pm-testimonials-carousel">';
			$html .= '<ul class="pm-testimonial-items">';
			
				foreach($testimonials as $t) {
					
					$html .= '<li>';
					   $html .= ' <div class="pm-testimonial-img" style="background-image:url('.$t['image'].');">';
							if($icon_image !== '') :
								$html .= '<div class="pm-testimonial-img-icon">';
									$html .= '<img src="'.$icon_image.'" class="img-responsive pm-center-align" alt="icon">';
								$html .= '</div>';
							endif;
						$html .= '</div>';
						$html .= '<p class="pm-testimonial-name">'. esc_attr__($t['title'],'medicallinktheme') .'</p>';
						$html .= '<p class="pm-testimonial-title">'. esc_attr__($t['url'],'medicallinktheme') .'</p>';
						$html .= '<div class="pm-testimonial-divider"></div>';
						$html .= '<p class="pm-testimonial-quote">'. esc_attr__($t['description'],'medicallinktheme') .'</p>';
					$html .= '</li>';
					
				}//end of foreach					
				
			$html .= '</ul>';
		$html .= '</div>';
		
	endif;
	
	return $html;
	
}

//CONTACT FORM
function contactForm($atts) {

	extract(shortcode_atts(array(  
		"recipient_email" => '',
		"text_color" => '#FFF',
    ), $atts)); 

	
	$html = '';
	
		$html .= '<div class="pm-contact-form-container">';
	
			$html .= '<form action="#" method="post" id="pm-contact-form">';
			
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_first_name" id="pm_s_first_name" class="pm-form-textfield" type="text" placeholder="'.esc_attr__('First Name *', 'medicallinktheme').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_last_name" id="pm_s_last_name" class="pm-form-textfield" type="text" placeholder="'.esc_attr__('Last Name *', 'medicallinktheme').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_email_address" id="pm_s_email_address" class="pm-form-textfield" type="text" placeholder="'.esc_attr__('Email Address *', 'medicallinktheme').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_phone_number" id="pm_s_phone_number" class="pm-form-textfield" type="tel" placeholder="'.esc_attr__('Phone Number', 'medicallinktheme').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-12 pm-clear-element">';
					$html .= '<textarea name="pm_s_message" id="pm_s_message" class="pm-form-textarea" cols="50" rows="10" placeholder="'.esc_attr__('Message *', 'medicallinktheme').'"></textarea>';
				$html .= '</div>';
								
				$html .= '<div class="col-lg-12 pm-center" style="margin-top:20px">';
					$html .= '<input type="button" value="'.esc_attr__('Submit Form', 'medicallinktheme').'" name="pm-form-submit-btn" class="pm-form-submit-btn" id="pm-contact-form-btn">';
					$html .= '<div id="pm-contact-form-response"></div>';	
					$html .= '<p class="pm-required">'.esc_attr__('Fields marked with * are required', 'medicallinktheme').'</p>';
				$html .= '</div>';
				$html .= '<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="'.esc_attr($recipient_email).'" />';
				
				wp_nonce_field('pm_ln_nonce_action','pm_ln_send_contact_nonce'); 
				
			$html .= '</form>';
		$html .= '</div>';
				
	return $html;
	
}


/******** BOOTSTRAP 3 COLUMNS ***********/

//COLUMN CONTAINER
function bootstrapContainer($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"fullscreen" => 'off',
		"fullscreen_container" => 'on',
		"bg_color" => 'transparent',
		"bg_image" => '',
		"bg_position" => 'static',
		"bg_repeat" => 'repeat-x',
		"alignment" => 'left',
		"padding_top" => 20,
		"padding_bottom" => 20,
		"parallax" => 'on',
		"message" => '',
		"message_color" => '#ffffff',
		"class" => '',
		"id" => ''
    ), $atts)); 
	
	if($fullscreen == 'on'){
		
		return '<div'. ($id !== '' ? ' id="'.$id.'"' : '') .' class="pm-column-container'. ($parallax === 'on' ? ' pm-parallax-panel' : '') .''.$class.'" style="'. ($bg_image !== '' ? 'background-image:url('.$bg_image.');' : '') .' background-repeat:'.$bg_repeat.'; background-attachment:'.$bg_position.' !important; background-color:'.$bg_color.'; text-align:'.$alignment.'; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'> '. ( $message !== '' ? '<div class="pm-column-container-message"><p style="color:'.$message_color.';">'.$message.'</p></div>' : '' ) .' '. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .' '.do_shortcode($content).''. ($fullscreen_container !== 'off' ? '</div>' : '') .'</div>';
		
	} else {
		
		return '<div'. ($id !== '' ? ' id="'.$id.'"' : '') .' class="pm-column-container'. ($parallax === 'on' ? ' pm-parallax-panel' : '') .''.$class.'" style="'. ($bg_image !== '' ? 'background-image:url('.$bg_image.');' : '') .' background-repeat:'.$bg_repeat.'; background-attachment:'.$bg_position.' !important; background-color:'.$bg_color.'; text-align:'.$alignment.'; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'> '. ( $message !== '' ? '<div class="pm-column-container-message"><p style="color:'.$message_color.';">'.$message.'</p></div>' : '' ) .' <div class="container">'.do_shortcode($content).'</div></div>';
		
	}
    
}  

//COLUMN CONTAINER
function bootstrapRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//NESTED ROW
function nestedRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//COLUMN
function bootstrapColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => 'wow fadeInUp',
		'animation_delay' => 0.3
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'" data-wow-delay="'.$animation_delay.'s" data-wow-offset="50" data-wow-duration="1s">'.do_shortcode($content).'</div>';	
}

//NESTED COLUMN
function nestedColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

/******** BOOTSTRAP 3 COLUMNS END ***********/

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/
add_action('init', 'pm_ln_add_tiny_shortcodes');  
function pm_ln_add_tiny_shortcodes() { 

	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		 
		 //Bootstrap 3
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapContainer');  
     	 add_filter('mce_buttons_3', 'register_bootstrapContainer'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapRow');  
     	 add_filter('mce_buttons_3', 'register_bootstrapRow'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapColumn');  
     	 add_filter('mce_buttons_3', 'register_bootstrapColumn'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_alert');  
     	 add_filter('mce_buttons_3', 'register_alert'); 
		 
		 //Add "standardButton" button
		 add_filter('mce_external_plugins', 'add_plugin_standardButton');  
		 add_filter('mce_buttons_3', 'register_standardButton');  
		 		 
		 //Add "Progress bar"
		 add_filter('mce_external_plugins', 'add_plugin_progressBar');  
		 add_filter('mce_buttons_3', 'register_progressBar');
		 
		 //Add "Single Post" button
		 /*add_filter('mce_external_plugins', 'add_plugin_singlepost');  
		 add_filter('mce_buttons_3', 'register_singlepost');*/
		 
		 //Add "divider" button
		 add_filter('mce_external_plugins', 'add_plugin_divider');  
		 add_filter('mce_buttons_3', 'register_divider'); 
		 
		 //Videos
		 add_filter('mce_external_plugins', 'add_plugin_youtubeVideo');  
     	 add_filter('mce_buttons_3', 'register_youtubeVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_vimeoVideo');  
     	 add_filter('mce_buttons_3', 'register_vimeoVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_html5Video');  
     	 add_filter('mce_buttons_3', 'register_html5Video'); 
		 
		 //postItems
		 add_filter('mce_external_plugins', 'add_plugin_postItems');  
     	 add_filter('mce_buttons_3', 'register_postItems'); 
		 
		 //Video Box
		 add_filter('mce_external_plugins', 'add_plugin_videoBox');  
     	 add_filter('mce_buttons_3', 'register_videoBox');
		 
		 //Tab Group
		 add_filter('mce_external_plugins', 'add_plugin_tabGroup');  
     	 add_filter('mce_buttons_3', 'register_tabGroup');
		 
		 //timeTableGroup Group
		 add_filter('mce_external_plugins', 'add_plugin_timeTableGroup');  
     	 add_filter('mce_buttons_3', 'register_timeTableGroup');
		 
		 //Accordion Group
		 add_filter('mce_external_plugins', 'add_plugin_accordionGroup');  
     	 add_filter('mce_buttons_3', 'register_accordionGroup');
		 
		 //Panel Header
		 /*add_filter('mce_external_plugins', 'add_plugin_panelHeader');  
     	 add_filter('mce_buttons_3', 'register_panelHeader');*/
		 
		 //Column Header
		 /*add_filter('mce_external_plugins', 'add_plugin_columnHeader');  
     	 add_filter('mce_buttons_3', 'register_columnHeader');*/
		 
		 //Testimonials
		 add_filter('mce_external_plugins', 'add_plugin_testimonials');  
     	 add_filter('mce_buttons_3', 'register_testimonials');	
		 
		 //Contact Form
		 add_filter('mce_external_plugins', 'add_plugin_contactForm');  
     	 add_filter('mce_buttons_3', 'register_contactForm');	
		 
		 //Image panel
		 /*add_filter('mce_external_plugins', 'add_plugin_imagePanel');  
     	 add_filter('mce_buttons_3', 'register_imagePanel');*/
		 
		 //Google Map
		 add_filter('mce_external_plugins', 'add_plugin_googleMap');  
     	 add_filter('mce_buttons_3', 'register_googleMap');	
		 
		 //CTA Box
		 add_filter('mce_external_plugins', 'add_plugin_ctaBox');  
     	 add_filter('mce_buttons_3', 'register_ctaBox');
		 
		  //Icon Element
		 add_filter('mce_external_plugins', 'add_plugin_iconElement');  
     	 add_filter('mce_buttons_3', 'register_iconElement');	
		 
		 //Flexslider Carousel
		 add_filter('mce_external_plugins', 'add_plugin_sliderCarousel');  
     	 add_filter('mce_buttons_3', 'register_sliderCarousel');
		 
		 //Client Carousel
		 add_filter('mce_external_plugins', 'add_plugin_clientCarousel');  
     	 add_filter('mce_buttons_3', 'register_clientCarousel');
		 
		 //Panels Carousel
		 add_filter('mce_external_plugins', 'add_plugin_panelsCarousel');  
     	 add_filter('mce_buttons_3', 'register_panelsCarousel');
		 
		 //Pie Chart
		 add_filter('mce_external_plugins', 'add_plugin_piechart');  
     	 add_filter('mce_buttons_3', 'register_piechart');
		 
		 //Milestone
		 add_filter('mce_external_plugins', 'add_plugin_milestone');  
     	 add_filter('mce_buttons_3', 'register_milestone');
		 
		 //Quote Box
		 add_filter('mce_external_plugins', 'add_plugin_quoteBox');  
     	 add_filter('mce_buttons_3', 'register_quoteBox');	
		 
		 //Pricing Table
		 add_filter('mce_external_plugins', 'add_plugin_pricingTable');  
     	 add_filter('mce_buttons_3', 'register_pricingTable');	 
		 
		 //Newsletter signup
		 add_filter('mce_external_plugins', 'add_plugin_newsletterSignup');  
     	 add_filter('mce_buttons_3', 'register_newsletterSignup');
		 
		 //Data Table
		 add_filter('mce_external_plugins', 'add_plugin_dataTableGroup');  
     	 add_filter('mce_buttons_3', 'register_dataTableGroup');
		 
		 //Staff Profile
		 add_filter('mce_external_plugins', 'add_plugin_staffProfile');  
     	 add_filter('mce_buttons_3', 'register_staffProfile');
		 
		 //Staff Posts
		 add_filter('mce_external_plugins', 'add_plugin_staffPosts');  
     	 add_filter('mce_buttons_3', 'register_staffPosts');
		 
		 //testimonialProfile
		 add_filter('mce_external_plugins', 'add_plugin_testimonialProfile');  
     	 add_filter('mce_buttons_3', 'register_testimonialProfile'); 
		 
		 //Services Posts
		 add_filter('mce_external_plugins', 'add_plugin_servicesPosts');  
     	 add_filter('mce_buttons_3', 'register_servicesPosts'); 
		
	}

}


//ACTIVE
function register_servicesPosts($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "servicesPosts");  
   return $buttons;
} 
function add_plugin_servicesPosts($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['servicesPosts'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_staffPosts($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffPosts");  
   return $buttons;
} 
function add_plugin_staffPosts($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffPosts'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_staffProfile($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffProfile");  
   return $buttons;  
} 
function add_plugin_staffProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_dataTableGroup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "dataTableGroup");  
   return $buttons;  
} 
function add_plugin_dataTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['dataTableGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_newsletterSignup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "newsletterSignup");  
   return $buttons;  
} 
function add_plugin_newsletterSignup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['newsletterSignup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_standardButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "standardButton");  
   return $buttons;  
} 
function add_plugin_standardButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['standardButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_progressBar($buttons) { //Registers the TinyMCE button
   array_push($buttons, "progressBar");  
   return $buttons;  
}
function add_plugin_progressBar($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['progressBar'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapContainer($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapContainer");  
   return $buttons;  
}
function add_plugin_bootstrapContainer($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapContainer'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapRow($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapRow");  
   return $buttons;  
}
function add_plugin_bootstrapRow($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapRow'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapColumn($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapColumn");  
   return $buttons;  
}
function add_plugin_bootstrapColumn($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapColumn'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_youtubeVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "youtubeVideo");  
   return $buttons;  
}
function add_plugin_youtubeVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['youtubeVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_vimeoVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "vimeoVideo");  
   return $buttons;  
}
function add_plugin_vimeoVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['vimeoVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_html5Video($buttons) { //Registers the TinyMCE button
   array_push($buttons, "html5Video");  
   return $buttons;  
}
function add_plugin_html5Video($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['html5Video'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_tabGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "tabGroup");  
   return $buttons;  
}
function add_plugin_tabGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['tabGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_timeTableGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "timeTableGroup");  
   return $buttons;  
}
function add_plugin_timeTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['timeTableGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_accordionGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "accordionGroup");  
   return $buttons;  
}
function add_plugin_accordionGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['accordionGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_testimonials($buttons) { //Registers the TinyMCE button
   array_push($buttons, "testimonials");  
   return $buttons;  
}
function add_plugin_testimonials($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['testimonials'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_contactForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "contactForm");  
   return $buttons;  
}
function add_plugin_contactForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['contactForm'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_googleMap($buttons) { //Registers the TinyMCE button
   array_push($buttons, "googleMap");  
   return $buttons;  
}
function add_plugin_googleMap($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['googleMap'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_alert($buttons) { //Registers the TinyMCE button
   array_push($buttons, "alert");  
   return $buttons;  
}
function add_plugin_alert($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['alert'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_ctaBox($buttons) {  
   array_push($buttons, "ctaBox");  
   return $buttons;  
}
function add_plugin_ctaBox($plugin_array) {  
   $plugin_array['ctaBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_iconElement($buttons) {  
   array_push($buttons, "iconElement");  
   return $buttons;  
}
function add_plugin_iconElement($plugin_array) {  
   $plugin_array['iconElement'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_sliderCarousel($buttons) {  
   array_push($buttons, "sliderCarousel");  
   return $buttons;  
}
function add_plugin_sliderCarousel($plugin_array) {  
   $plugin_array['sliderCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_clientCarousel($buttons) {  
   array_push($buttons, "clientCarousel");  
   return $buttons;  
}
function add_plugin_clientCarousel($plugin_array) {  
   $plugin_array['clientCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_panelsCarousel($buttons) {  
   array_push($buttons, "panelsCarousel");  
   return $buttons;  
}

function add_plugin_panelsCarousel($plugin_array) {  
   $plugin_array['panelsCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_piechart($buttons) {  
   array_push($buttons, "piechart");  
   return $buttons;  
}
function add_plugin_piechart($plugin_array) {  
   $plugin_array['piechart'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_milestone($buttons) {  
   array_push($buttons, "milestone");  
   return $buttons;  
}
function add_plugin_milestone($plugin_array) {  
   $plugin_array['milestone'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_quoteBox($buttons) {  
   array_push($buttons, "quoteBox");  
   return $buttons;  
}
function add_plugin_quoteBox($plugin_array) {  
   $plugin_array['quoteBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_pricingTable($buttons) {  
   array_push($buttons, "pricingTable");  
   return $buttons;  
}
function add_plugin_pricingTable($plugin_array) {  
   $plugin_array['pricingTable'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_videoBox($buttons) { //Registers the TinyMCE button
   array_push($buttons, "videoBox");  
   return $buttons;  
}
function add_plugin_videoBox($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['videoBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_postItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "postItems");  
   return $buttons;  
}
function add_plugin_postItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['postItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}


function register_testimonialProfile($buttons) { //Registers the TinyMCE button
   array_push($buttons, "testimonialProfile");  
   return $buttons;  
}
function add_plugin_testimonialProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['testimonialProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}


function parse_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim(  do_shortcode( $content ) );
    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );
    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );
    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    return $content;
}

?>