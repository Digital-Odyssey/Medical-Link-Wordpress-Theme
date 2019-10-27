<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php $ieCompatibilityMode = get_theme_mod('ieCompatibilityMode', 'off'); ?>
    <?php if($ieCompatibilityMode === 'on') { ?>
    	<meta http-equiv="X-UA-Compatible" content="IE=9" />
    <?php } ?>
    <meta name="format-detection" content="telephone=no">
    
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
    
    <?php 
		
	//Redux options
	global $medicallink_options;
	
	$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');
	$displayAppointmentFormBeneathSlider = get_theme_mod('displayAppointmentFormBeneathSlider', 'no');
		
	?> 
                        
    <?php wp_head(); ?>
</head>

<?php 

//MedicalLink options
$customSlider = $medicallink_options['opt-custom-slider'];

//Global options
$colorSampler = get_theme_mod('colorSampler', 'on');
$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Layout Options
$enableBoxMode = get_theme_mod('enableBoxMode', 'off');

//Header options
$companyLogo = get_theme_mod('companyLogo', get_template_directory_uri() . '/img/medical-link.jpg');
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', '');
$companyLogoURL = get_theme_mod('companyLogoURL', '');
$enableMicroMenu = get_theme_mod('enableMicroMenu', 'on');
$enableSearch = get_theme_mod('enableSearch', 'on');
$enableCategoryList = get_theme_mod('enableCategoryList', 'on');
$searchFieldText = get_theme_mod('searchFieldText', esc_attr__('Type Keywords...', 'medicallinktheme'));
$enableCart = get_theme_mod('enableCart', 'off');
$enableLanguageSelector = get_theme_mod('enableLanguageSelector', 'off');

//Business Info
$businessPhone = get_theme_mod('businessPhone', '+ 488 (0) 333.444.212');
$businessEmail = get_theme_mod('businessEmail', 'support@medical-link.com');

$facebooklink = get_theme_mod('facebooklink', 'http://www.facebook.com');
$twitterlink = get_theme_mod('twitterlink', 'http://www.twitter.com');
$googlelink = get_theme_mod('googlelink', 'http://www.googleplus.com');
$linkedinLink = get_theme_mod('linkedinLink', 'http://www.linkedin.com');
$vimeolink = get_theme_mod('vimeolink', '');
$youtubelink = get_theme_mod('youtubelink', 'http://www.youtube.com');
$dribbblelink = get_theme_mod('dribbblelink', '');
$pinterestlink = get_theme_mod('pinterestlink', '');
$instagramlink = get_theme_mod('instagramlink', '');
$skypelink = get_theme_mod('skypelink', '');
$flickrlink = get_theme_mod('flickrlink', '');
$tumblrlink = get_theme_mod('tumblrlink', '');
$stumbleuponlink = get_theme_mod('stumbleuponlink', '');
$redditlink = get_theme_mod('redditlink', 'http://www.reddit.com');
$rssLink = get_theme_mod('rssLink', '');

//Pulse slider options
$enablePulseSlider = get_theme_mod('enablePulseSlider', 'on');

$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
$woocommLayout = 'woocomm-' . $woocommShopLayout;

?>
<body <?php body_class($woocommLayout); ?>>

<?php if($colorSampler === 'on') { ?>

	<?php get_template_part('content', 'themesampler'); ?>

<?php } ?>



<?php if($enableBoxMode === 'on') { ?>
     <div class="pm-boxed-mode" id="pm_layout_wrapper">
<?php } else { ?>
     <div class="pm-full-mode" id="pm_layout_wrapper">
<?php }?>
    
    <?php if($enableMicroMenu === 'on') : ?>
        <!-- Sub-Menu -->
        <div class="pm-sub-menu-container">
        
            <div class="container">
            
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        
                        <div class="pm-sub-menu-info">
                        
                        	<?php
								wp_nav_menu(array(
									'container' => '',
									'container_class' => '',
									'menu_class' => 'pm-micro-navigation',
									'menu_id' => '',
									'theme_location' => 'micro_menu',
									'fallback_cb' => 'pm_ln_micro_menu',
								   )
								);
							?>
                            
                        </div>
                                                
                    </div>
                    
                    
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    
                        <ul class="pm-social-navigation">
                        
                        	<?php if($facebooklink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                            	<a href="<?php echo esc_html($facebooklink); ?>" target="_blank" class="fa fa-facebook"></a>
                            </li>
                        	<?php endif; ?>
                        
                            <?php if($twitterlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                <a href="<?php echo esc_html($twitterlink); ?>" target="_blank" class="fa fa-twitter"></a>
                            </li>
							<?php endif; ?>
                            
                            <?php if($googlelink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($googlelink); ?>" target="_blank" class="fa fa-google-plus"></a>
                                </li>
                            <?php endif; ?>
                        
                            <?php if($linkedinLink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($linkedinLink); ?>" target="_blank" class="fa fa-linkedin"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($vimeolink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Vimeo', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($vimeolink); ?>" target="_blank" class="fa fa-vimeo-square"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($youtubelink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('YouTube', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($youtubelink); ?>" target="_blank" class="fa fa-youtube"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($dribbblelink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Dribbble', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($dribbblelink); ?>" target="_blank" class="fa fa-dribbble"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($pinterestlink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Pinterest', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($pinterestlink); ?>" target="_blank" class="fa fa-pinterest"></a>
                                </li>
                            <?php endif; ?>
                            
                            
                            <?php if($instagramlink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Instagram', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($instagramlink); ?>" target="_blank" class="fa fa-instagram"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($skypelink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Skype', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="skype:<?php echo esc_attr($skypelink); ?>?call" target="_blank" class="fa fa-skype"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($flickrlink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Flickr', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($flickrlink); ?>" target="_blank" class="fa fa-flickr"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($tumblrlink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Tumblr', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($tumblrlink); ?>" target="_blank" class="fa fa-tumblr"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($stumbleuponlink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('StumbleUpon', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank" class="fa fa-stumbleupon"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($redditlink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Reddit', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($redditlink); ?>" target="_blank" class="fa fa-reddit"></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if($rssLink !== '') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('RSS Feed', 'medicallinktheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="<?php echo esc_html($rssLink); ?>" target="_blank" class="fa fa-rss"></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    
                        <ul class="pm-sub-navigation">
                            <li>
                            
                            	<?php if($enableLanguageSelector === 'on') : ?>
                                
                                	<?php pm_ln_icl_post_languages(); ?> 
                                	
                                <?php endif; ?> 
                                
                            </li>
                        </ul>
                        
                    </div>
                    
                </div>
            
            </div>
            
        </div>
        <!-- /Sub-header -->
    <?php endif; ?>
    
    
    <?php if(!is_home() && !is_front_page()) { ?>
    
        <?php get_template_part('content', 'appointmentform'); ?>
    
    <?php } else { ?>
    
    	<?php if($displayAppointmentFormBeneathSlider === 'no') : ?>
    
			<?php get_template_part('content', 'appointmentform'); ?>
        
        <?php endif; ?>
    
    <?php } ?>
    
    
    
    
    
        
    <!-- Header area -->
    <header>
            
        <div class="container">
        
            <div class="row">
            
                <div class="col-lg-4 col-md-4 col-sm-12">
                
                     <div class="pm-header-logo-container">
                     	<?php if($companyLogo !== '') : ?>
                        	<a href="<?php echo $companyLogoURL !== '' ? esc_html($companyLogoURL) : site_url(); ?>"><img src="<?php echo esc_html($companyLogo); ?>" class="img-responsive pm-header-logo" alt="<?php echo $companyLogoAltTag !== '' ? esc_attr($companyLogoAltTag) : 'Logo'; ?>"></a> 
                        <?php endif; ?>
                        
                    </div>
                    
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-12">
                    
                    <ul class="pm-header-info">
                    	<?php if($businessPhone !== '') : ?>
                        	<li><p><i class="fa fa-mobile-phone"></i> <a href="tel:<?php echo esc_attr($businessPhone); ?>"><?php echo esc_attr($businessPhone); ?></a></p></li>
                        <?php endif; ?>
                        <?php if($businessEmail !== '') : ?>
                        	<li><p> <i class="fa fa-inbox"></i> &nbsp;<a href="mailto:<?php echo esc_attr($businessEmail); ?>"><?php echo esc_attr($businessEmail); ?></a></p></li>
                        <?php endif; ?>
                        
                    </ul>
                    
                    
                    <ul class="pm-search-container">
                    	<?php if($enableSearch === 'on') : ?>
                            <li>
                                <div class="pm-search-field-container">
                                    <a href="#" class="fa fa-search" id="pm-search-submit"></a>
                                    <form name="searchform" id="pm-searchform" method="get" action="<?php echo home_url( '/' ); ?>">
                                        <input name="s" class="pm-search-field" type="text" placeholder="<?php echo esc_attr($searchFieldText); ?>">
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($enableCategoryList === 'on') : ?>
                        
                        <?php
						
							$args = array(
								'type'                     => 'post',
								'child_of'                 => 0,
								'parent'                   => '',
								'orderby'                  => 'name',
								'order'                    => 'ASC',
								'hide_empty'               => 1,
								'hierarchical'             => 1,
								'exclude'                  => '',
								'include'                  => '',
								'number'                   => '',
								'taxonomy'                 => 'category',
								'pad_counts'               => false 
							
							); 
						
                        	//Retrieve categories
							$categories = get_categories($args);
						?>
                        
                            <li>
                                <div class="pm-dropdown pm-categories-menu">
                                    <div class="pm-dropmenu">
                                        <p class="pm-menu-title"><?php esc_attr_e('Categories', 'medicallinktheme') ?></p>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="pm-dropmenu-active">
                                        <ul>
                                        	<?php 
												foreach ($categories as $category) {
													//if ($category->name == $category_name) {}
													//echo $category->slug;
													echo '<li><a href="' . get_category_link( $category->term_id ) . '">'.$category->name.'</a></li>';
												}
											?>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                    
                </div>
                
            </div>
        
        </div>
                
    </header>
    <!-- /Header area end -->
    
    <!-- Navigation area -->
    <div class="pm-nav-container<?php echo $enableFixedHeight === 'false' ? ' scalable' : '' ?>">
    
        <div class="container">
        
            <div class="row">
            
            	<?php if($enableCart === 'on') { ?>
                <div class="col-lg-10 col-md-10 col-sm-12">
                <?php } else { ?>
                <div class="col-lg-12">
                <?php } ?>                
                    
                    <nav class="navbar-collapse collapse" id="pm-main-navigation">
                    
                    	<?php
							wp_nav_menu(array(
								'container' => '',
								'container_class' => '',
								'menu_class' => 'sf-menu pm-nav',
								'menu_id' => 'pm-main-nav',
								'theme_location' => 'main_menu',
								'fallback_cb' => 'pm_ln_main_menu',
							   )
							);
						?>
                    
                    
                    </nav> 
                
                </div>
                
                <?php if($enableCart === 'on' && function_exists('is_shop')) : ?>
                
                	<?php global $woocommerce; ?>
                
                	<div class="col-lg-2 col-md-2 col-sm-12 pm-main-menu">
                                    
                        <ul class="pm-cart-info">
                            <li><p>(<span class="pm-nav-cart-item-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>) <span class="pm-nav-cart-total"><?php echo $woocommerce->cart->get_cart_total(); ?></span></p></li>
                            <li><a href="<?php echo site_url('cart'); ?>" class="typcn typcn-shopping-cart"></a></li>
                        </ul>
                                              
                    </div>
                
                <?php endif; ?>
                
                
            </div>
        
        </div>
    
    </div>
    <!-- Navigation area end -->
    
    <?php if(is_home() || is_front_page()) {//Display Pulse Slider ?>
    
    
    	<?php if($enablePulseSlider === 'on') : ?>
        
        	<?php 
				global $medicallink_options;
				
				$slides = '';
				
				if( isset($medicallink_options['opt-pulse-slides']) && !empty($medicallink_options['opt-pulse-slides']) ){
					$slides = $medicallink_options['opt-pulse-slides'];
				}
				
			?>
        
            <?php 
							
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
													  
													  if(!empty($s['url'])){
														 echo '<a href="'.esc_url($btnUrl).'" class="pm-slide-btn'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">'.esc_attr__($btnText, 'medicallinktheme').' <i class="fa fa-plus"></i></a>'; 
													  }
													  
														
													  
													  
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
							
			?> 
        
        <?php endif; ?>
        
        <?php if($displayAppointmentFormBeneathSlider === 'yes') : ?>
        
            <!-- Request appointment form -->
            <div class="pm-request-appointment-form" id="pm-appointment-form-container">
            
                <?php 
                
                    $recipient_email = $medicallink_options['opt-appointment-form-recipient-email'];
                
                ?>
                
                <div class="container">
                    <div class="row">
                        
                        <form action="#" method="post" id="pm-appointment-form">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <input name="pm_app_form_name" id="pm_app_form_name" type="text" class="pm-request-appointment-form-textfield" placeholder="<?php esc_attr_e('Full Name', 'medicallinktheme') ?>">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <input name="pm_app_form_email" id="pm_app_form_email" type="email" class="pm-request-appointment-form-textfield" placeholder="<?php esc_attr_e('Email Address', 'medicallinktheme') ?>">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <input name="pm_app_form_phone" id="pm_app_form_phone" type="text" class="pm-request-appointment-form-textfield" placeholder="<?php esc_attr_e('Phone Number', 'medicallinktheme') ?>">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="pm_app_form_date" id="pm_app_form_date" class="pm-request-appointment-form-textfield appointment-form-datepicker" type="text" placeholder="<?php esc_attr_e('Date of Appointment', 'medicallinktheme') ?>">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input name="pm_app_form_time" id="pm_app_form_time" class="pm-request-appointment-form-textfield" type="text" placeholder="<?php esc_attr_e('Time of Appointment (ex. 10:30am)', 'medicallinktheme') ?>">
                            </div>
            
                            
                            <div class="col-lg-12 pm-clear-element">
                            
                                <div id="pm-appointment-form-response"></div>
                            
                                <input type="submit" value="<?php esc_attr_e('Submit Request', 'medicallinktheme') ?>" class="pm-square-btn appointment-form" id="pm-appointment-form-btn" />
                                <p class="pm-appointment-form-notice"><?php esc_attr_e('All fields are required.', 'medicallinktheme') ?></p>
                                <a href="#" class="pm-appointment-form-close" id="pm-close-appointment-form"><i class="fa fa-close"></i> <?php esc_attr_e('Close Appointment form', 'medicallinktheme') ?></a>
                                
                            </div>
                            
                            <input type="hidden" value="<?php echo esc_attr($recipient_email); ?>" name="pm_app_form_recipient" id="pm_app_form_recipient" />
                            
                            <?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_appointment_nonce');  ?>
                            
                        </form>
                        
                    </div>
                </div>
                
            </div>
            <!-- Request appointment form end -->
        
        <?php endif; ?>
        
        <?php 
		
			if($customSlider !== '' && $enablePulseSlider === 'off') { 
        	   echo do_shortcode($customSlider);
        	} 
			
		?>
    
            
    <?php } else {//display sub-header ?>
        
    	<?php get_template_part('content', 'subheader'); ?>
    
<?php } ?>