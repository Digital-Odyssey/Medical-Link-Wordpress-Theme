<?php 

//Redux options
global $medicallink_options;
	
//Header options
$companyLogoAltTag = get_theme_mod('companyLogoAltTag');
$companyLogoURL = get_theme_mod('companyLogoURL');

//Footer Options
$footerLogo = get_theme_mod('footerLogo', get_template_directory_uri() . '/img/medical-link.jpg');
$toggle_fatfooter = get_theme_mod('toggle_fatfooter', 'on');
$toggle_footerNav = get_theme_mod('toggle_footerNav', 'on');
$toggleParallaxFooter = get_theme_mod('toggleParallaxFooter', 'on');
$displayFooterLogo = get_theme_mod('displayFooterLogo', 'on');
$displayCopyright = get_theme_mod('displayCopyright', 'off');
$copyrightInfo = $medicallink_options['opt-footer-copyright'];

//Layout Options
$footerLayout = get_theme_mod('footerLayout', 'footer-four-columns');


?>

		<?php if($toggle_fatfooter == 'on') { ?>
            
            <div class="pm-fat-footer <?php echo $toggleParallaxFooter === 'on' ? ' pm-parallax-panel' : ''; ?>" <?php echo $toggleParallaxFooter === 'on' ? 'data-stellar-background-ratio="0.5"' : ''; ?>>
                
                <div class="container">
                    <div class="row">
                    
                    	<!-- Widget layouts -->   
                        
                        <?php if($footerLayout == 'footer-three-wide-left') { ?>
                    
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer"> 
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-three-wide-right') { ?>
                        
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-one-column') { ?>
                        
                            <div class="col-lg-12 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-two-columns') { ?>
                        
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                    
                        <?php if($footerLayout == 'footer-three-columns') { ?>
                        
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-four-columns') { ?>
                                                        
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column4_widget")) ; ?>
                                </div>
                        
                        <?php } ?>
                        
                        <!-- Widget layouts end -->                    
                        
                    </div>	
                </div>
                
            </div>
        
        <?php } ?>
    
		<?php if($toggle_footerNav == 'on') { ?>

        
            <footer>
            
                <div class="container pm-containerPadding20">
                    <div class="row"> 
                    	                   
                    	<?php if($displayFooterLogo === 'on') : ?>
                    
                            <div class="col-lg-4 col-md-4 col-sm-12 pm-center-mobile">
                                                            
								<?php if($footerLogo !== '') : ?>
                                    <a href="<?php $companyLogoURL !== '' ? esc_html($companyLogoURL) : site_url(); ?>"><img src="<?php echo esc_html($footerLogo); ?>" class="img-responsive pm-header-logo" alt="<?php echo esc_attr($companyLogoAltTag); ?>"></a> 
                                <?php endif ?>
                                                                
                            </div>
                        
                        <?php endif; ?>
                        
                        
                        <?php if($displayFooterLogo === 'on') { ?>
                        
                        	<div class="col-lg-8 col-md-8 col-sm-12">
                            
                        <?php } else { ?>
                        
                        	<div class="col-lg-12">
                            
                        <?php } ?>
                        
								<?php
								
									if($displayFooterLogo === 'on') {
										
										wp_nav_menu(array(
											'container' => '',
											'container_class' => '',
											'menu_class' => 'pm-footer-navigation logo-on',
											'menu_id' => '',
											'theme_location' => 'footer_menu',
											'fallback_cb' => 'pm_ln_footer_menu_logo',
										   )
										);
											
									} else {
									
										wp_nav_menu(array(
											'container' => '',
											'container_class' => '',
											'menu_class' => 'pm-footer-navigation centered',
											'menu_id' => '',
											'theme_location' => 'footer_menu',
											'fallback_cb' => 'pm_ln_footer_menu_centered',
										   )
										);
										
									}
									
                                ?>
                            
                            </div>
                    </div>
                </div>
                                    
            </footer>
            
        <?php } ?>
        
        <?php if($displayCopyright === 'on') : ?>
                    
            <div class="pm-copyright-container">
            
                <div class="container">
                    <div class="row">
                    
                        <div class="col-lg-12 pm-center-mobile">
                
                            <?php 
    
                                $allowed_html = array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'em' => array(),
                                    'strong' => array(),
                                    'h6' => array(),
                                    'p' => array(),
                                    'span' => array(),
                                );
                            
                            ?>
                        
                            <?php 
                            
                                if($copyrightInfo !== ''){ ?>
                                    <p class="pm-footer-copyright-info">&copy; <?php echo date('Y'); ?> <?php echo wp_kses($copyrightInfo, $allowed_html); ?></p>
                                <?php } else { ?>
                                    <p class="pm-footer-copyright-info">&copy; <?php echo date('Y'); ?> <?php bloginfo('name');  ?></p>
                                <?php }
                            
                            ?>                                
                            
                        </div>                        
                    
                    </div>
                </div>
            
            </div>    
                                
        <?php endif; ?>
    
	</div><!-- /pm_layout_wrapper -->

	<p id="pm-back-top" class="visible-lg visible-md visible-sm"><i class="fa fa-chevron-up"></i></p>
                
		<?php wp_footer(); ?> 
    </body>
</html>