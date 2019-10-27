<?php

/* Add filters, actions, and theme-supported features after theme is loaded */
add_action( 'after_setup_theme', 'pm_ln_theme_setup' );

function pm_ln_theme_setup() {
		
	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;
	
	/***** LOAD REDUX FRAMEWORK ******/
	//require_once(dirname( __FILE__ ) . "/ReduxFramework/loader.php"); //Add the extension loader before Redux framework initializes
	
	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/ReduxFramework/medical_link/medical-config.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/medical_link/medical-config.php' );
	}
	
		
	/***** REQUIRED INCLUDES ***************************************************************************************************/
	
	include_once(get_template_directory() . '/includes/shortcodes/shortcodes.php'); //Shortcodes		
		
	//Widgets
	include_once(get_template_directory() . "/includes/widget-twitter.php"); //twitter
	include_once(get_template_directory() . "/includes/widget-facebook.php"); //facebook
	include_once(get_template_directory() . "/includes/widget-video.php"); //video
	include_once(get_template_directory() . "/includes/widget-flickr.php"); //flickr
	include_once(get_template_directory() . "/includes/widget-mailchimp.php"); //mailchimp
	include_once(get_template_directory() . "/includes/widget-quickcontact.php"); //quick contact form
	include_once(get_template_directory() . "/includes/widget-recentposts.php"); //recent posts
	include_once(get_template_directory() . "/includes/widget-trends.php"); //recent posts
	include_once(get_template_directory() . "/includes/widget-knowledgebase.php"); //knowledge base lists
	
	//Theme updater Class	
	include_once(get_template_directory() . '/includes/theme-update-checker.php');
	
	//TGM plugin
	require_once(get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php");
	
	//Bootstrap 3 nav support
	include_once(get_template_directory() . '/includes/pm_ln_bootstrap_navwalker.php');
	
	//Customizer class
	include_once(get_template_directory() . "/includes/classes/PM_LN_Customizer.class.php");
	
	//Custom functions
	include_once(get_template_directory() . "/includes/wp-functions.php");
	
	//Theme metaboxes
	include_once(get_template_directory() . "/includes/theme-metaboxes.php");
	
	/***** CUSTOM VISUAL COMPOSER SHORTCODES ********************************************************************************/
	if ( pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {

		if(!class_exists('WPBakeryShortCode')) return;
	
		$de_block_dir = get_template_directory().'/includes/vc_blocks/';
		
		require_once( $de_block_dir . 'vimeo_video.php' );
		require_once( $de_block_dir . 'youtube_video.php' );
		require_once( $de_block_dir . 'html_video.php' );
		require_once( $de_block_dir . 'divider.php' );
		require_once( $de_block_dir . 'video_box.php' );
		require_once( $de_block_dir . 'newsletter_registration.php' );
		require_once( $de_block_dir . 'google_map.php' );
		//require_once( $de_block_dir . 'action_button.php' );
		require_once( $de_block_dir . 'testimonial_profile.php' );
		require_once( $de_block_dir . 'post_items.php' );
		require_once( $de_block_dir . 'pricing_table.php' );
		require_once( $de_block_dir . 'panels_carousel.php' );
		require_once( $de_block_dir . 'client_carousel.php' );
		require_once( $de_block_dir . 'testimonials.php' );
		require_once( $de_block_dir . 'progress_bar.php' );
		require_once( $de_block_dir . 'icon_element.php' );
		require_once( $de_block_dir . 'standard_button.php' );
		//require_once( $de_block_dir . 'countdown.php' );
		require_once( $de_block_dir . 'milestone.php' );
		require_once( $de_block_dir . 'piechart.php' );
		require_once( $de_block_dir . 'contact_form.php' );
		require_once( $de_block_dir . 'alert.php' );
		require_once( $de_block_dir . 'quote_box.php' );
		require_once( $de_block_dir . 'cta_box.php' );
		require_once( $de_block_dir . 'staff_profile.php' );
		require_once( $de_block_dir . 'staff_posts.php' );
		require_once( $de_block_dir . 'service_posts.php' );
		require_once( $de_block_dir . 'column_message.php' );
		
		//Nested elements go last
		//require_once( $de_block_dir . 'process_list.php' );
		//require_once( $de_block_dir . 'info_list.php' );
		require_once( $de_block_dir . 'timetable_group.php' );
		require_once( $de_block_dir . 'accordion_group.php' );
		require_once( $de_block_dir . 'datatable_group.php' );
		require_once( $de_block_dir . 'tab_group.php' );
		require_once( $de_block_dir . 'slider_carousel.php' );				
	
	}

		
	/***** MENUS ***************************************************************************************************/
	
	register_nav_menu('main_menu', 'Main Menu');
	register_nav_menu('micro_menu', 'Micro Menu');
	register_nav_menu('footer_menu', 'Footer Menu');
	
	/***** THEME SUPPORT ***************************************************************************************************/
	
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-header');
	add_theme_support('custom-background');	
	add_theme_support('title-tag');
	add_theme_support('align-wide');
		
	/***** CUSTOM FILTERS AND HOOKS ***************************************************************************************************/
			
	//Add your sidebars function to the 'widgets_init' action hook.
	add_action( 'widgets_init', 'pm_ln_register_custom_sidebars' );
	
	//Load front-end scripts
	add_action( 'wp_enqueue_scripts', 'pm_ln_scripts_styles' );
	
	//Load admin scripts
	add_action( 'admin_enqueue_scripts', 'pm_ln_load_admin_scripts' );
	
	add_filter('excerpt_more', 'pm_ln_new_excerpt_more');
		
	//Add content and widget text shortcode support
	add_filter('the_content', 'do_shortcode');
	add_filter('widget_text', 'do_shortcode');
		
	//Retrieve only Posts from Search function
	add_filter('pre_get_posts','pm_ln_search_filter');
	
	//Show Post ID's
	add_filter('manage_posts_columns', 'pm_ln_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
	
	//Show Page ID's
	add_filter('manage_pages_columns', 'pm_ln_posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
			
	//Custom paginated posts
	add_filter('wp_link_pages_args','pm_ln_custom_nextpage_links');
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error) 
	add_filter( 'wp_list_categories', 'pm_ln_remove_category_list_rel' );
	add_filter( 'the_category', 'pm_ln_remove_category_list_rel' );
	
	//Remove title attributes from WordPress navigation
	add_filter( 'wp_list_pages', 'pm_ln_remove_title_attributes' );
	
	//Ajax Scripts
	add_action('wp_enqueue_scripts', 'pm_ln_register_user_scripts');
	
	//Ajax loader function
	add_action('wp_ajax_pm_ln_load_more', 'pm_ln_load_more');
	add_action('wp_ajax_nopriv_pm_ln_load_more', 'pm_ln_load_more');
	
	add_action('wp_ajax_pm_ln_load_more_posts', 'pm_ln_load_more_posts');
	add_action('wp_ajax_nopriv_pm_ln_load_more_posts', 'pm_ln_load_more_posts');
	
	//Ajax Contact form
	add_action('wp_ajax_send_contact_form', 'pm_ln_send_contact_form');
	add_action('wp_ajax_nopriv_send_contact_form', 'pm_ln_send_contact_form');
	
	//Ajax Quick Contact form
	add_action('wp_ajax_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	add_action('wp_ajax_nopriv_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	
	//Ajax Appointment form
	add_action('wp_ajax_send_appointment_form', 'pm_ln_send_appointment_form');
	add_action('wp_ajax_nopriv_send_appointment_form', 'pm_ln_send_appointment_form');
	
	//Locations list generator for Appointment form
	add_action('wp_ajax_pm_ln_load_locations', 'pm_ln_load_locations');
	add_action('wp_ajax_nopriv_pm_ln_load_locations', 'pm_ln_load_locations');
	
	//Ajax Knowledge base filtering
	add_action('wp_ajax_pm_ln_search_knowledge_base', 'pm_ln_search_knowledge_base');
	add_action('wp_ajax_nopriv_pm_ln_search_knowledge_base', 'pm_ln_search_knowledge_base');
	
	//Like feature
	add_action('wp_ajax_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
	add_action('wp_ajax_nopriv_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
	
	add_action('wp_ajax_pm_ln_like_feature', 'pm_ln_like_feature');
	add_action('wp_ajax_nopriv_pm_ln_like_feature', 'pm_ln_like_feature');
	
	//Custom Admin fields
	add_action( 'show_user_profile', 'pm_show_extra_profile_fields' );
	add_action( 'edit_user_profile', 'pm_show_extra_profile_fields' );
	
	add_action( 'personal_options_update', 'pm_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'pm_save_extra_profile_fields' );
	
	//Log post views for trends widget
	add_action('wp_head', 'pm_ln_log_post_views');
	
	//Output buffer
	add_action('init', 'app_output_buffer');
		
	//Custom login styles
	//add_action('login_head', 'pm_ln_custom_login');
	
	/**** THEME CUSTOMIZER - NEW in WP 3.4+ ****/
		
	//Output customizer CSS with caching	
	add_action ('wp_head', 'pm_ln_customizer_css');
	add_action( 'customize_preview_init', 'pm_ln_customize_preview_js' );
	//add_action( 'customize_controls_enqueue_scripts', 'pm_ln_panels_js' );
	//add_action( 'wp_enqueue_scripts', 'pm_ln_customizer_styles_cache', 130 );
	//add_action( 'customize_save_after', 'pm_ln_reset_style_cache_on_customizer_save' );
	
	//Ajax Registration
	add_action('wp_ajax_register_user', 'pm_ln_register_new_user');
	add_action('wp_ajax_nopriv_register_user', 'pm_ln_register_new_user');
	
	//Ajax Login
	add_action('wp_ajax_validate_quick_login', 'pm_ln_validate_quick_login');
	add_action('wp_ajax_nopriv_validate_quick_login', 'pm_ln_validate_quick_login');
	
	/**** WOOCOMMERCE ***/
	
	//Declare Woocommerce support
	add_theme_support('woocommerce');
	
	//Woocommerce gallery support for version 3.0
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	//Remove Woocommerce breadcrumbs
	add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
	
	//Remove default Woocommerce wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//Add wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
	add_action('woocommerce_before_main_content', 'pm_ln_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pm_ln_woo_wrapper_end', 10);
	
	//Display empty star rating
	add_filter('woocommerce_product_get_rating_html', 'pm_ln_woo_get_rating_html', 10, 2);

	//Dashboard customization	
	add_filter( 'admin_footer_text', 'pm_ln_remove_footer_admin' );//footer info
	add_action( 'login_enqueue_scripts', 'pm_ln_login_logo' );//login logo
	add_filter( 'login_headerurl', 'pm_ln_login_logo_url' );//login logo url
	add_filter( 'login_headertext', 'pm_ln_login_logo_url_title' );//login logo title	
	
	//TGM plugin activation
	add_action( 'tgmpa_register', 'pm_ln_register_required_plugins' );
	
	//Theme updates
	//add_action('admin_init', 'pm_ln_check_for_theme_updates');
	
	//Custom settings page for purchase verification
	add_action( 'admin_menu', 'pm_ln_theme_settings_admin_menu' );
	
	//Create theme update options
	add_option('pm_ln_theme_marketplace','');
	add_option('pm_ln_micro_themes_user_email','');
	add_option('pm_ln_micro_themes_purchase_code_themeforest','');
	add_option('pm_ln_micro_themes_purchase_code_mojo','');
	
	
				
}//end of after_theme_setup

add_action('after_setup_theme', 'pm_ln_localization_setup');


if( !function_exists('pm_ln_customize_preview_js') ) {
	
	function pm_ln_customize_preview_js() {
		wp_enqueue_script( 'medical-theme-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
	}
	
}

if( !function_exists('pm_ln_panels_js') ) {
	
	function pm_ln_panels_js() {
		wp_enqueue_script( 'medical-theme-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '1.0', true );
	}
	
}

if ( ! function_exists( 'pm_ln_woo_wrapper_start' ) ) {
	
	function pm_ln_woo_wrapper_start() {
		
		  $woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
		  echo '<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">';
			 echo '<div class="row">';
			 
				if( $woocommShopLayout === 'left-sidebar' ) {
					get_sidebar('woocommerce');
				}
			 
				echo '<div class="col-lg-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '9' ) .' col-md-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '9' ) .' col-sm-12">';	  
		  
		  echo ''; 
	  
	}
	
}

if ( ! function_exists( 'pm_ln_woo_wrapper_end' ) ) {
	
	function pm_ln_woo_wrapper_end() {
		
		$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
	  		echo '</div>';
			
			if( $woocommShopLayout === 'right-sidebar' ) {
				get_sidebar('woocommerce');
			}
			
	  	 echo '</div>';
	  echo '</div>';
	  echo ''; 
	  
	}
	
}


if( !function_exists('pm_ln_woo_get_rating_html') ){
	
	function pm_ln_woo_get_rating_html($rating_html, $rating) {
	
		if ( $rating > 0 ) {
			$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		} else {
			$title = 'Not yet rated';
			$rating = 0;
		}
	
		$rating_html  = '<div class="star-rating" title="' . $title . '">';
		$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
		$rating_html .= '</div>';
		
		return $rating_html;
		
	}
	
}




if( !function_exists('pm_ln_check_for_theme_updates') ){
	
	function pm_ln_check_for_theme_updates() {
	
		$theme_update_checker = new ThemeUpdateChecker(
			'medicallink-theme',
			'http://updates.microthemes.ca/theme-updates/medicallink-theme-updater.php'
		);
		
		$theme_update_checker->checkForUpdates();
			
	}
	
}

if( !function_exists('pm_ln_theme_settings_admin_menu') ){	
	function pm_ln_theme_settings_admin_menu() {	
		add_options_page( esc_attr__('Theme Updates', 'medicallinktheme'), esc_attr__('Theme Updates', 'medicallinktheme'), 'manage_options', 'myplugin/myplugin-admin-page.php', 'pm_ln_theme_settings_admin_page', 'dashicons-tickets', 6 );
	}
}


if( !function_exists('pm_ln_theme_settings_admin_page') ){

	function pm_ln_theme_settings_admin_page(){		

		if(isset($_POST['pm_ln_verify_account_update'])){			
			update_option('pm_ln_theme_marketplace', sanitize_text_field($_POST['pm_ln_theme_marketplace']));
			update_option('pm_ln_micro_themes_user_email', sanitize_text_field($_POST['pm_ln_micro_themes_user_email']));
			update_option('pm_ln_micro_themes_purchase_code_themeforest', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_themeforest']));
			update_option('pm_ln_micro_themes_purchase_code_mojo', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_mojo']));
			update_option('pm_ln_micro_themes_purchased_product', 4);//Corresponds to products array in verify account script			
		}

		$pm_ln_micro_themes_user_email = get_option('pm_ln_micro_themes_user_email');
		$pm_ln_theme_marketplace = get_option('pm_ln_theme_marketplace');
		$pm_ln_micro_themes_purchase_code_themeforest = get_option('pm_ln_micro_themes_purchase_code_themeforest');	
		$pm_ln_micro_themes_purchase_code_mojo = get_option('pm_ln_micro_themes_purchase_code_mojo');	
		$pm_ln_micro_themes_purchased_product = get_option('pm_ln_micro_themes_purchased_product');	
		
		//Validate account
		$queryArgs = array();
		$queryArgs['customer_email'] = $pm_ln_micro_themes_user_email;	
		$queryArgs['customer_marketplace'] = $pm_ln_theme_marketplace;
		$queryArgs['customer_themeforest_purchase_code'] = $pm_ln_micro_themes_purchase_code_themeforest;
		$queryArgs['customer_mojo_purchase_code'] = $pm_ln_micro_themes_purchase_code_mojo;
		$queryArgs['customer_product'] = $pm_ln_micro_themes_purchased_product;
		
		$account_valid = false;
		
		//args for wp_remote_get
		$options = array(
			'timeout' => 10, //seconds
		);
		
		$url = 'http://updates.microthemes.ca/theme-updates/verify-account.php'; 
		//$url = 'http://staging.microthemes.ca/theme-updates/verify-account.php'; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url); //rebuild url with arguments
		}
		
		//Send the request to Micro Themes
		$response = wp_remote_get($url, $options);
				
		if( is_array($response) ) {
			
		  $header = $response['headers']; // array of http header lines
		  $body = $response['body']; // use the content
		  
		  if( strstr($body, "success") ){
			  $account_valid = true;
		  }
		  
		}

		?>

		<div class="wrap">
        
        	<div class="wpmm-wrapper">
            
            	<div id="content" class="wrapper-cell">
            
					<?php if(isset($_POST['pm_ln_verify_account_update'])){?>
    
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_attr_e('Your settings were updated', 'medicallinktheme'); ?></p>
                        </div>
                        
                    <?php } ?>	
        
                    <h2><?php esc_attr_e('Theme verification', 'medicallinktheme'); ?></h2>
                    <p><?php esc_attr_e('Use the form below to verify your Micro Themes account - this will verify your account for automatic updates.', 'medicallinktheme'); ?></p>            
        
                    <form method="post" action="">            
        
                        <p><label><?php esc_attr_e('Select your marketplace for purchase verification', 'medicallinktheme'); ?>:</label></p>                
        
                        <select name="pm_ln_theme_marketplace" id="pm_ln_verify_marketplace_selection">
                            <option value="default" <?php if ( 'default' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>>-- <?php esc_attr_e('Choose Marketplace', 'medicallinktheme'); ?> --</option>
                            <option value="microthemes" <?php if ( 'microthemes' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Micro Themes', 'medicallinktheme'); ?></option>
                            <option value="themeforest" <?php if ( 'themeforest' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Themeforest', 'medicallinktheme'); ?></option>
                            <option value="mojo" <?php if ( 'mojo' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Mojo Marketplace', 'medicallinktheme'); ?></option>
                        </select>                
        
                        <div id="pm_ln_micro_themes_purchase_code_themeforest" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'themeforest' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Themeforest item purchase code', 'medicallinktheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_themeforest" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_themeforest); ?>" maxlength="200" />
                        </div> 
                        
                        <div id="pm_ln_micro_themes_purchase_code_mojo" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'mojo' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Mojo item purchase code', 'medicallinktheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_mojo" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_mojo); ?>" maxlength="200" />
                        </div>                
        
                        <p><label><?php esc_attr_e('Micro Themes account email address', 'medicallinktheme'); ?>:</label></p>
                        <input class="pm-admin-theme-verify-text-field" type="text" value="<?php esc_attr_e($pm_ln_micro_themes_user_email); ?>" name="pm_ln_micro_themes_user_email" maxlength="200" />             
        
                        <input type="hidden" name="pm_ln_micro_themes_installed_theme" value="Medical-Link" />    
                        <p id="pm_ln_micro_themes_verfication_status"><?php esc_attr_e('Account status', 'medicallinktheme'); ?>: <span><b><?php echo $account_valid == true ? esc_attr('Verified', 'medicallinktheme') : esc_attr('Unverified', 'medicallinktheme'); ?></b></span></p>
        
                        <br />                
        
                        <input name="pm_ln_verify_account_update" class="button button-primary button-large" value="<?php esc_attr_e('Verify Account', 'medicallinktheme'); ?>" type="submit">            
        
                    </form>
                
                </div><!-- /.wrapper-cell -->
    
                <div id="sidebar" class="wrapper-cell">
                
                    <div class="sidebar_box themes_box">
                        <h3><?php esc_attr_e('More Themes by Micro Themes', 'medicallinktheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=hope" target="_blank" title="Hope WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/hope.jpg" alt="Hope WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=quantum" target="_blank" title="Quantum WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/quantum.jpg" alt="Quantum WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=vienna" target="_blank" title="Vienna WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/vienna.jpg" alt="Vienna WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=medical-link" target="_blank" title="Medical-Link WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/medical-link.jpg" alt="Medical-Link WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=energy" target="_blank" title="Energy WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/energy.jpg" alt="Energy WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=luxor" target="_blank" title="Luxor WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/luxor.jpg" alt="Luxor WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=moxie" target="_blank" title="Moxie WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/moxie.jpg" alt="Moxie WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=pro-cast" target="_blank" title="Pro-Cast WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/pro-cast.jpg" alt="Pro-Cast WordPress Themes"></a>
                                </li>	
                                			
                            </ul>
                        </div>
                        
                        <h3><?php esc_attr_e('Plug-ins by Micro Themes', 'medicallinktheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-stream" target="_blank" title="Easy Social Stream"><img src="http://microthemes.ca/images/theme-ads/easy-social-stream.jpg" alt="Easy Social Stream"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-login" target="_blank" title="Easy Social Login"><img src="http://microthemes.ca/images/theme-ads/easy-social-login.jpg" alt="Easy Social Login"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-presentations" target="_blank" title="Premium Presentations"><img src="http://microthemes.ca/images/theme-ads/premium-presentations.jpg" alt="Premium Presentations"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-paypal-manager" target="_blank" title="Premium Paypal Manager"><img src="http://microthemes.ca/images/theme-ads/premium-paypal-manager.jpg" alt="Premium Paypal Manager"></a>
                                </li>                                			
                            </ul>
                        </div>
                        
                    </div>
                
                </div><!-- /.wrapper-cell #sidebar -->
            
            </div><!-- /.wpmm-wrapper -->

		</div><!-- /.wrap -->

		<?php
	}
}


if( !function_exists('pm_ln_register_required_plugins') ){

	function pm_ln_register_required_plugins() {
		
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Woocommerce', // The plugin name.
				'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/woocommerce.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => 'Customizer Export/Import', // The plugin name.
				'slug'               => 'customizer-export-import', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/customizer-export-import.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Medical-Link Gallery Post Type', // The plugin name.
				'slug'               => 'premium-gallery', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/premium-gallery.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Medical-Link Knowledge Base Post Type', // The plugin name.
				'slug'               => 'premium-knowledgebase', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/premium-knowledgebase.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Medical-Link Services Post Type', // The plugin name.
				'slug'               => 'services', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/services.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Medical-Link Staff Members Post Type', // The plugin name.
				'slug'               => 'staff-members', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/staff-members.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Medical-Link Locations Post Type', // The plugin name.
				'slug'               => 'medical-locations', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/medical-locations.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
	
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => "medicallinktheme",                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	
			
		);
	
		tgmpa( $plugins, $config );
	}

}


function pm_ln_login_logo_url() {
	return esc_url( 'https://www.pulsarmedia.ca' );
}

function pm_ln_login_logo_url_title() {
	return esc_html__('Pulsar Media :: Interactive Design Studio', "medicallinktheme");
}

function pm_ln_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/pulsar-media-login.png );
			padding-bottom: 0px;
			width:321px !important;
			background-size:100%;
		}
	</style>
<?php }

function pm_ln_remove_footer_admin () {
	echo '<span id="footer-thankyou">'. esc_html__('Developed by', "medicallinktheme") .' <a href="http://www.pulsarmedia.ca/" target="_blank">'. esc_html__('Pulsar Media', "medicallinktheme") .'</a> :: '. esc_html__('Interactive Design Studio', "medicallinktheme") .' - '. esc_html__('Visit our', "medicallinktheme") .' <a href="https://github.com/PulsarMedia" target="_blank">'. esc_html__('GitHub account', "medicallinktheme") . '</a> ' . esc_html__('for more FREE WordPress themes and plugins', 'medicallinktheme');
}

function pm_ln_remove_dashboard_widget () {
    remove_meta_box ( 'dashboard_quick_press', 'dashboard', 'side' );
	
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}


function pm_ln_dashboard_widget_function() {
	
	$news_file = wp_remote_get( 'https://www.microthemes.ca/files/theme-news/news.html' );
	
	if( is_array($news_file) ) {
						
	  $header = $news_file['headers']; // array of http header lines
	  $body = $news_file['body']; // use the content
	  
	  $args = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'p' => array(),
			'h2' => array(),
		);
	  
	  echo wp_kses($body, $args) ;
	  
	}
	
}


function pm_ln_register_user_scripts() {
	
	if( pm_ln_has_shortcode('contactForm') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {	
		//Contact Form
		wp_enqueue_script( 'pulsar-contactform', get_template_directory_uri() . '/js/ajax-contact/ajax-email.js', array(), '1.0', true );
	}
	
	if(is_active_widget( '', '', 'pm_ln_quickcontact_widget')) {
		//Quick contact widget
		wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-quick-email.js', array(), '1.0', true );
	}

	
	//Define AJAX URL and pass to JS
	$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
	$wc_ajax = "$_SERVER[REQUEST_URI]" . '?wc-ajax=add_to_cart';
	
	wp_enqueue_script( 'pm_ln_register_script', $js_file );
		$array = array( 
			'pm_ln_ajax_url' => admin_url('admin-ajax.php'),
			'pm_ln_wc_ajax' => $wc_ajax
	);
		
	wp_localize_script( 'pm_ln_register_script', 'pm_ln_register_vars', $array );	

}

/******* Log post views *****/
function pm_ln_log_post_views() {
   if(is_single()) {
      global $post;
      $count = get_post_meta($post->ID, 'post_views', true);
      $newcount = $count + 1;

      update_post_meta($post->ID, 'post_views', $newcount);
   }
}

/******* Custom Admin fields *****/
function pm_show_extra_profile_fields( $user ) { ?>

	<?php $author_title = get_the_author_meta( 'author_title', $user->ID ); ?>
    <h3><?php esc_attr_e('Author Title', "medicallinktheme") ?></h3>
	<table class="form-table">
        <tr>
			<th><label for="user_organization"><?php esc_attr_e('Author Title', "medicallinktheme") ?></label></th>
			<td>
				<input name="author_title" value="<?php echo esc_attr($author_title); ?>" type="text" />
			</td>
		</tr>
	</table>
	
<?php }

function pm_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'manage_options' )  )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	$author_title =  sanitize_text_field($_POST['author_title']);
	update_user_meta( $user_id, 'author_title', $author_title );
	
}


/******* Remove title atts from WordPress nav *****/
function pm_ln_remove_title_attributes($input) {
    return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
}


/*** WOOCOMMERCE FUNCTIONS *****/
function pm_ln_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}



function pm_ln_woocommerce_product_excerpt()  { 
	$content_length = 20;
	global $post;
	$content = $post->post_excerpt;
	$wordarray = explode(' ', $content, $content_length + 1);
	if(count($wordarray) > $content_length) :
	array_pop($wordarray);
	array_push($wordarray, '...');
	$content = implode(' ', $wordarray);
	$content = force_balance_tags($content);
	endif;
	echo "<span class='excerpt'><p>$content</p></span>";
} 
 
function pm_ln_remove_reviews_tab($tabs) {

	unset($tabs['reviews']);
	return $tabs;
 
}


function pm_ln_comment_textarea_field($comment_field) {
	$comment_field =
	'<p class="comment-form-comment">
		<textarea required placeholder="Comment…" class="pm-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	</p>';
 
    return $comment_field;
}


function app_output_buffer() {
  ob_start();
}

//Remove REL tag from posts (this will eliminate HTML5 validation error)
function pm_ln_remove_category_list_rel( $output ) {
	// Remove rel attribute from the category list
	return str_replace( ' rel="category tag"', '', $output );
}


//Retrieve only Posts from Search function 
function pm_ln_search_filter($query) {
	
	if( isset($_GET['post_type']) ){
		
		if($_GET['post_type'] == 'product'){
			
			if ($query->is_search) {
				$query->set('post_type',array('product'));
			}
			
		}
		
		
	} else {
		
		if ($query->is_search) {
			
			if(is_page_template('template-knowledgebase.php')){
				$query->set('post_type',array('post_knowledgebase'));
			} else {
				$query->set('post_type',array('post','page'));	
			}
			
			
		}
		
	}
		
	return $query;
}

//Show Post ID's
function pm_ln_posts_columns_id($defaults){
	$defaults['wps_post_id'] = esc_attr__('ID', "medicallinktheme");
	return $defaults;
}
function pm_ln_posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
				echo $id;
	}
}

//Excerpt filters
function pm_ln_new_excerpt_more($more) {
	global $post;
	return '... <a href="'. get_permalink($post->ID) . '" class="readmore">'.esc_attr__('Read More', "medicallinktheme").' &raquo;</a>';
}

//Custom paginated posts
function pm_ln_custom_nextpage_links($defaults) {
	$args = array(
		'before' => '<div class="pm_paginated-posts"><p>'. esc_attr__('Continue Reading: ', "medicallinktheme") .'</p><ul class="pagination_multi clearfix">',
		'after' => '</ul></div>',
		'link_before'      => '<li>',
		'link_after'       => '</li>',
	);
	$r = wp_parse_args($args, $defaults);
	return $r;
}

//Enqueue scripts and styles for admin area
function pm_ln_load_admin_scripts() {
	
	 wp_enqueue_media();
	
	//Load Media uploader script for custom meta options
	wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array(), '1.0', true );
	
	//Custom CSS for meta boxes
	wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
	
	//JS for admin
	wp_enqueue_script( 'pulsar-wpadminjs', get_template_directory_uri() . '/js/wp-admin/wp-admin.js', array(), '1.0', true );
	
	//Date picker for Classes and Event post types
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
	
	$admin_js = get_template_directory_uri() . '/js/wp-admin/wp-admin.js'; 
	
	//Pass admin path to JS
	wp_register_script( 'adminRoot', $admin_js  );
	wp_enqueue_script( 'adminRoot' );
	$array = array( 
		'adminRoot' => home_url(),
	);
	wp_localize_script( 'adminRoot', 'adminRootObject', $array ); 
	
}

//Enqueue scripts and styles
function pm_ln_scripts_styles() {
		
	global $wp_styles;
	global $post;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	
		wp_enqueue_script( 'comment-reply' );

		//Required JS	
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap3/js/bootstrap.min.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array("jquery"), '1.0', false );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/stellar/jquery.stellar.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array("jquery"), '1.0', true );
		
		//Appointment form
		wp_enqueue_script( 'pulsar-requestform', get_template_directory_uri() . '/js/ajax-appointment-form/ajax-appointment-form.js', array("jquery"), '1.0', true );		
		
		//Mobile menu
		wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/js/meanmenu/jquery.meanmenu.min.js', array("jquery"), '1.0', true );
		wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/js/meanmenu/meanmenu.css', array( 'pulsar-style' ), '20121010' );	
		
		
		//Conditional JS
		$retinaSupport = get_theme_mod('retinaSupport', 'on');
		if($retinaSupport === 'on'){
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.js', array("jquery"), '1.0', true );
		}
		
		$enableTooltip = get_theme_mod('enableTooltip', 'on');
		if($enableTooltip === 'on') :
			wp_enqueue_script( 'pulsar-tooltip', get_template_directory_uri() . '/js/jquery.tooltip.js', array("jquery"), '1.0', true );	
		endif;

		
		wp_enqueue_style( 'prettyPhoto-css', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array("jquery"), '1.0', true );
		wp_enqueue_script( 'migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.js', array("jquery"), '1.0', true );
		
		if( pm_ln_has_shortcode('testimonials') || pm_ln_is_plugin_active('js_composer/js_composer.php') ){
			//Testimonials carousel script
			wp_enqueue_script( 'pulsar-testimonials', get_template_directory_uri() . '/js/jquery.testimonials.js', array("jquery"), '1.0', true );
		}		
		
		if( pm_ln_has_shortcode('piechart') || pm_ln_has_shortcode('milestone') || pm_ln_is_plugin_active('js_composer/js_composer.php') ){
			//Load Easypiechart
			wp_enqueue_script( 'easypiechart', get_template_directory_uri() . '/js/easypiechart/jquery.easypiechart.min.js', array("jquery"), '1.0', true );
		}
		
		if( pm_ln_has_shortcode('googleMap') || pm_ln_is_plugin_active('js_composer/js_composer.php') ){
			
			$googleAPIKey = get_theme_mod('googleAPIKey');
			
			//Google maps shortcode support
			wp_register_script('googlemaps', ('//maps.google.com/maps/api/js?key='.$googleAPIKey.''), false, null, true);
			wp_enqueue_script('googlemaps');
		}
		
		
		if( pm_ln_has_shortcode('clientCarousel') || pm_ln_has_shortcode('panelsCarousel') || pm_ln_has_shortcode('postItems') || pm_ln_has_shortcode('servicesPosts') || pm_ln_is_plugin_active('js_composer/js_composer.php') ){
			//load owl carousel
			wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array("jquery"), '1.0', true );
		}
				
		if( is_single() || is_page() || is_home() ){			
			
			//Load WOW
			wp_enqueue_style( 'wow-css', get_template_directory_uri() . '/js/wow/css/libs/animate.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow/wow.min.js', array("jquery"), '1.0', true );
								
			//Load Viewport Selectors for jQuery
			wp_enqueue_script( 'viewmini', get_template_directory_uri() . '/js/jquery.viewport.mini.js', array("jquery"), '1.0', true );	
						
		}

		if( is_single() || is_page() || is_home() || is_front_page() || is_archive() || is_page_template('template-gallery.php') ){
			
			//Like feature
			wp_enqueue_script( 'pulsar-like', get_template_directory_uri() . '/js/ajax-like-feature/ajax-like-feature.js', array("jquery"), '1.0', true );
			
		}
		
		if( is_home() || is_front_page() || pm_ln_has_shortcode('pulseSlider') ){
			//Load pulse slider
			wp_enqueue_script( 'pulsar-pulseslider', get_template_directory_uri() . '/js/pulse/jquery.PMSlider.js', array("jquery"), '1.0', true );
			wp_enqueue_style( 'pulsar-pulseslider', get_template_directory_uri() . '/js/pulse/pm-slider.css', array( 'pulsar-style' ), '20121010' );
		}
		
		
		if( is_page_template('template-gallery.php') || is_page_template('template-staff.php') ){
			
			//load isotope
			wp_enqueue_style( 'isotope-css', get_template_directory_uri() . '/js/isotope/isotope.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/js/isotope/jquery.isotope.min.js', array("jquery"), '1.0', true );			
			
		}	
			
		
		//Load theme color selector (for sampling purposes)
		$colorSampler = get_theme_mod('colorSampler', 'on');
		if( $colorSampler == 'on' ){
			wp_enqueue_script( 'pulsar-theme-color-selector', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector.js', array("jquery"), '1.0', true );
			wp_enqueue_style( 'pulsar-theme-color-selector-css', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector.css', array( 'pulsar-style' ), '20121010' );
		}

				
				
		//Load twitter feed
		if(is_active_widget( '', '', 'latest-tweets')) {
			wp_enqueue_script( 'pulsar-twitter', get_template_directory_uri() . '/js/twitter-post-fetcher/twitterFetcher_min.js', array("jquery"), '1.0', true );
		}
		
		//Load main theme script
		wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main.js', array("jquery"), '1.0', true );
		
		
				
		//Loads our main stylesheet.
		wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
		
		//Load main styles
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap3/css/bootstrap.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'master-css', get_template_directory_uri() . '/css/master.css', array( 'pulsar-style' ), '20121010' );
		
		//CSS Scripts
		wp_enqueue_style( 'jqueryui', get_template_directory_uri() . '/css/jquery-ui/jquery-ui.css', array( 'pulsar-style' ), '20121010' );
	
		//Loads other stylesheets.
		wp_enqueue_style( 'pulsar-superfish', get_template_directory_uri() . '/css/superfish/superfish.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-fontawesome', get_template_directory_uri() . '/css/fontawesome/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-typicons', get_template_directory_uri() . '/css/typicons/typicons.min.css', array( 'pulsar-style' ), '20121010' );
		
		//Responsive css - load this last
		wp_enqueue_style( 'pulsar-responsive', get_template_directory_uri() . '/css/responsive.css', array( 'pulsar-style' ), '20121010' );

		
		/****** JAVASCRIPT LOCALIZATION ********/
		
		//Redux options
		global $medicallink_options;
		
		//Define a JS file to store variables
		$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
		
		//Get Pulse slider settings for JS
		$enableSlideShow = get_theme_mod('enableSlideShow', 'true');
		$slideLoop = get_theme_mod('slideLoop', 'true');
		$enableControlNav = get_theme_mod('enableControlNav', 'true');
		$pauseOnHover = get_theme_mod('pauseOnHover', 'true');
		$showArrows = get_theme_mod('showArrows', 'true');
		$animationType = get_theme_mod('animationType', 'slide');
		$slideShowSpeed = get_theme_mod('slideShowSpeed', 8000);
		$slideSpeed = get_theme_mod('slideSpeed', 800);
		$sliderHeight = get_theme_mod('sliderHeight', 755);
		$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');
		
		//Pass post carousel options
		$postCarouselSpeed = get_theme_mod('postCarouselSpeed', 0);
		
		//Pass testimonial carousel speed
		$testimonialCarouselSpeed = get_theme_mod('testimonialCarouselSpeed', 7000);
		
		//Sticky nav settings
		$enableStickyNav = get_theme_mod('enableStickyNav', 'on');
		$enableMicroMenu = get_theme_mod('enableMicroMenu', 'on');		
		
		//Localize PrettyPhoto settings
		$ppAnimationSpeed = $medicallink_options['ppAnimationSpeed'];
		$ppAutoPlay = $medicallink_options['ppAutoPlay'];
		$ppShowTitle = $medicallink_options['ppShowTitle'];
		$ppColorTheme = $medicallink_options['ppColorTheme'];
		$ppSlideShowSpeed = $medicallink_options['ppSlideShowSpeed'];
		$ppSocialTools = $medicallink_options['ppSocialTools'];
		
		//Drop menu indicator
		$dropMenuIndicator = get_theme_mod('dropMenuIndicator', 'fa fa-angle-down');
		
		//Position appointment form on homepage
		$displayAppointmentFormBeneathSlider = get_theme_mod('displayAppointmentFormBeneathSlider','no');
		
		//Form translations
		
		/** Global messages **/
		$securityError = esc_attr__('Please verify that you are human.', "medicallinktheme");
		$successMessage = esc_attr__('Your inquiry has been received, thank you.', "medicallinktheme");
		$failedMessage = esc_attr__('A system error occurred. Please try again later.', "medicallinktheme");
		$ajaxSearchResult = esc_attr__('No results', "medicallinktheme");
		$fieldValidation = esc_attr__('Validating Form...', "medicallinktheme");
		$consentError = esc_attr__('Please agree to give consent before submitting your personal information.', 'medicallinktheme');
		
		/** Contact form **/
		$contactForm1 = esc_attr__('Please provide your first name.', "medicallinktheme");
		$contactForm2 = esc_attr__('Please provide your last name.', "medicallinktheme");
		$contactForm3 = esc_attr__('Please provide a valid email address.', "medicallinktheme");
		$contactForm4 = esc_attr__('Please provide a message for your inquiry.', "medicallinktheme");
		
		/** Appointment form **/
		$appForm1 = esc_attr__('Please fill in your name.', "medicallinktheme");
		$appForm2 = esc_attr__('Please provide a valid email address.', "medicallinktheme");
		$appForm3 = esc_attr__('Please provide your phone number.', "medicallinktheme");
		$appForm4 = esc_attr__('Please select a date for your appointment.', "medicallinktheme");
		$appForm5 = esc_attr__('Please provide a time for your appointment.', "medicallinktheme");
		$appForm6 = esc_attr__('Please select a country.', "medicallinktheme");
		$appForm7 = esc_attr__('Please select a location.', "medicallinktheme");
		
		/** Quick contact **/
		$quickContact1 = esc_attr__('Please provide your full name.', "medicallinktheme");
		$quickContact2 = esc_attr__('Please provide a valid email address.', "medicallinktheme");
		$quickContact3 = esc_attr__('Please provide a message for your inquiry.', "medicallinktheme");		
		
		/** Accordion multi-expand toggle **/
		$multiExpandAccordion = get_theme_mod('multiExpandAccordion', 'off');
		
		/** Ajax add to cart **/
		$enableAjaxAddToCart = get_theme_mod('enableAjaxAddToCart', 'on');
		
		//Load Ajax loader
		wp_enqueue_script( 'jcustom', $js_file );
		$array = array( 
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('pulsar_ajax'),
			'loading' => esc_attr__('Loading...', "medicallinktheme")
		);
		wp_localize_script( 'jcustom', 'pulsarajax', $array );
		
		//Javascript Object	
		$wordpressOptionsArray = array( 
			'urlRoot' => home_url(),
			'templateDir' => get_template_directory_uri(),
			'securityError' => $securityError,
			'successMessage' => $successMessage,
			'failedMessage' => $failedMessage,
			'fieldValidation' => $fieldValidation,
			'ajaxSearchResult' => $ajaxSearchResult,
			'contactForm1' => $contactForm1,
			'contactForm2' => $contactForm2,
			'contactForm3' => $contactForm3,
			'contactForm4' => $contactForm4,
			'appForm1' => $appForm1,
			'appForm2' => $appForm2,
			'appForm3' => $appForm3,
			'appForm4' => $appForm4,
			'appForm5' => $appForm5,
			'appForm6' => $appForm6,
			'appForm7' => $appForm7,
			'quickContact1' => $quickContact1,
			'quickContact2' => $quickContact2,
			'quickContact3' => $quickContact3,
			'displayAppointmentFormBeneathSlider' => $displayAppointmentFormBeneathSlider,
			'dropMenuIndicator' => $dropMenuIndicator,
			'ppAnimationSpeed' => $ppAnimationSpeed,
			'ppAutoPlay' => $ppAutoPlay,
			'ppShowTitle' => $ppShowTitle,
			'ppColorTheme' => $ppColorTheme,
			'ppSlideShowSpeed' => $ppSlideShowSpeed,
			'ppSocialTools' => $ppSocialTools,
			'stickyNav' => $enableStickyNav,
			'enableMicroMenu' => $enableMicroMenu,
			'autoPlay' => $postCarouselSpeed,
			'testimonialCarouselSpeed' => $testimonialCarouselSpeed,
			'enableSlideShow' => $enableSlideShow,
			'slideLoop' => $slideLoop,
			'enableControlNav' => $enableControlNav,
			'animationType' => $animationType,
			'pauseOnHover' => $pauseOnHover,
			'showArrows' => $showArrows,
			'slideShowSpeed' => $slideShowSpeed,
			'slideSpeed' => $slideSpeed,
			'sliderHeight' => $sliderHeight,
			'fixedHeight' => $enableFixedHeight,
			'multiExpandAccordion' => $multiExpandAccordion,
			'consentError' => $consentError
		);
		
		wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wordpress.js');
		wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );
		
}

function pm_ln_register_custom_sidebars() {
		
	if (function_exists('register_sidebar')) {
		
		//DEFAULT TEMPLATE
		register_sidebar(array(
								
								'name' => esc_attr__('Default Template',"medicallinktheme"),
								'id' => 'default_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		//HOMEPAGE
		register_sidebar(array(
								
								'name' => esc_attr__('Home Page',"medicallinktheme"),
								'id' => 'home_page_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));

		//NEWS POSTS PAGE
		register_sidebar(array(
								
								'name' => esc_attr__('Blog Page',"medicallinktheme"),
								'id' => 'blog_page_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));


		//NEWS SINGLE POST PAGE
		/*register_sidebar(array(
								'name' => esc_attr__('Single Blog Post',"medicallinktheme"),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));*/
		
		//Woocommerce
		/*register_sidebar(array(
								'name' => esc_attr__('Woocommerce',"medicallinktheme"),
								'id' => 'woocommerce_widget',
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));*/
		
				
		//FOOTER
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 1',"medicallinktheme"),
								'id' => 'footer_column1_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 2',"medicallinktheme"),
								'id' => 'footer_column2_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 3',"medicallinktheme"),
								'id' => 'footer_column3_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 4',"medicallinktheme"),
								'id' => 'footer_column4_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								
								'name' => esc_attr__('Knowledge Base Center',"medicallinktheme"),
								'id' => 'knowledge_base_center',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								
								'name' => esc_attr__('Woocommerce',"medicallinktheme"),
								'id' => 'woocommerce_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		
		
	}//end of if function_exists
	
}//end of pm_ln_register_custom_sidebars

//localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
function pm_ln_localization_setup() {
	// Retrieve the directory for the localization files
	$lang_dir = get_template_directory() . '/languages';
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain("medicallinktheme", $lang_dir);
} // end custom_theme_setup
	

//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
function pm_ln_kriesi_pagination($style = '', $pages = '', $range = 2){
	
	 $showitems = ($range * 2)+1;

	 global $paged;
	 if(empty($paged)) $paged = 1;

	 if($pages == '')
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages)
		 {
			 $pages = 1;
		 }
	 }

	 if(1 != $pages){
		 
		 //echo '<div class="pm-pagination-page-counter"><p>Page '. $paged .' of '. $pages .'</p></div>';
		 
		 echo "<ul class='pm-pagination ".$style." clearfix reset-pulse-sizing'>";
		 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
		 if($paged > 1 && $showitems < $pages) echo "<li><a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

		 for ($i=1; $i <= $pages; $i++)
		 {
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			 {
				 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
			 }
		 }

		 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
		 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		 		
		 
	 }
	 
	  $args = array(
			'before'           => '<li>' . esc_attr__('Pages:', "medicallinktheme"),
			'after'            => '</li>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => esc_attr__('Next page', "medicallinktheme"),
			'previouspagelink' => esc_attr__('Previous page', "medicallinktheme"),
			'pagelink'         => '%',
			'echo'             => 1
		);
		
	 
	 echo "</ul>\n";
}


/*** Theme Customizer CSS ****/
function pm_ln_customizer_css(){
?>
        <style type="text/css">
		<?php
					
			//Header Options & Colors
			$mainNavBackgroundColor = get_option('mainNavBackgroundColor', '#0DB7C4');
			$mainNavBackgroundColors = pm_ln_hex2rgb($mainNavBackgroundColor);			
			
			$navDropDownBorderColor = get_option('navDropDownBorderColor', '#1ad7e6');
			$microMenuBackgroundColor = get_option('microMenuBackgroundColor', '#0db7c4');
			
			$mobileNavToggleColor = get_option('mobileNavToggleColor', '#FFFFFF');
			
			$subpageHeaderBackgroundColor = get_option('subpageHeaderBackgroundColor', '#c1c1c1');
			
			$searchFieldCategoryColor = get_option('searchFieldCategoryColor', '#7de2ea');
			$searchFieldCategoryTextColor = get_option('searchFieldCategoryTextColor', '#0db7c4');
			$expandableDivColor = get_option('expandableDivColor', '#097d86');
			
			$dropMenuIcon = get_theme_mod('dropMenuIcon', '');
			
			$getMainNavBgOpacity = get_theme_mod('mainNavBgOpacity', 80);
			$mainNavBgOpacity = $getMainNavBgOpacity / 100;
			
			$headerPadding = get_theme_mod('headerPadding', 25);
			$socialIconColor = get_option('socialIconColor', '#11c7d5'); 
			
			$copyrightBackgroundColor = get_option('copyrightBackgroundColor', '#0db7c4'); 
			
			$subHeaderHeight = get_theme_mod('subHeaderHeight', 225);
			
			echo '
				.pm-sub-header-container {
					background-color:'.$subpageHeaderBackgroundColor.';
				}
			
				header {
					padding:'.$headerPadding.'px 0;	
				}
				.pm-social-navigation li a {
					border: 3px solid '.$socialIconColor.';
					color:'.$socialIconColor.';
				}
				
				.pm-sub-header-info {
					height:'.$subHeaderHeight.'px;	
				}
				
				.pm-single-post-social-icons li a, .pm-page-social-icons li a {
					border: 2px solid '.$socialIconColor.';
					color:'.$socialIconColor.';	
				}
				.pm-single-post-social-icons li a:hover, .pm-page-social-icons li a:hover {
					background-color:'.$socialIconColor.';		
				}
				.pm-social-navigation li a:hover {
					background-color:'.$socialIconColor.';
				}
				.pm-nav-container {
					background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', '.$mainNavBackgroundColors[2].', '.$mainNavBgOpacity.');
				}
				.sf-menu ul, .sf-menu ul li, .pm-dropmenu-active ul {
					background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', '.$mainNavBackgroundColors[2].', '.$mainNavBgOpacity.');	
				}
				.sf-menu ul li {
					border-bottom: 1px solid '.$navDropDownBorderColor.';
				}
				.sf-menu ul ul {
					border-left:1px solid '.$navDropDownBorderColor.';
				}
				.pm-dropmenu-active ul li {
					border-top: 1px solid '.$navDropDownBorderColor.';	
				}
				.pm-sub-menu-container {
					background-color: '.$microMenuBackgroundColor.';
				}
				.pm-copyright-container {
					background-color:'.$copyrightBackgroundColor.' !important;			
				}
				.pm-request-appointment-form {
					background-color: '.$expandableDivColor.';	
				}
				
				.pm-search-field, .pm-dropdown.pm-categories-menu .pm-menu-title {
					color: '.$searchFieldCategoryTextColor.'	
				}
				
				.pm-dropdown.pm-categories-menu .pm-dropmenu-active ul li a {
					color: '.$searchFieldCategoryTextColor.'		
				}
				
				.pm-search-field-container {
					border: 3px solid '.$searchFieldCategoryColor.';	
				}
				.pm-search-field-container a, .pm-dropdown.pm-categories-menu .pm-dropmenu i {
					color:'.$searchFieldCategoryColor.';	
				}
				.pm-dropdown.pm-categories-menu {
					border: 3px solid '.$searchFieldCategoryColor.';	
				}
				
				.pm-dropdown.pm-categories-menu .pm-dropmenu-active ul li {
					border: 3px solid '.$searchFieldCategoryColor.';		
				}
				
				
				
				.sf-menu ul li a:before { 
					content: "\\'.$dropMenuIcon.'";
				}
				
				.pm-micro-navigation li:after {
					content: "\\'.$dropMenuIcon.'";	
				}
				.pm-dropmenu-active ul {
					
				}
				
				.mean-container .mean-bar, .mean-container .mean-nav {
					background-color:'.$mainNavBackgroundColor.';
				}
				
				.sf-menu ul {
					border-bottom: 1px solid '.$navDropDownBorderColor.';
					border-top: 1px solid '.$navDropDownBorderColor.';
				}
				
				
				.mean-container a.meanmenu-reveal span {
					background-color:'.$mobileNavToggleColor.';	
				}
				
				.mean-container .mean-nav ul li a.mean-expand, .mean-container a.meanmenu-reveal {
					color:'.$mobileNavToggleColor.';		
				}
				
				
			';
			
			
			//Footer Options & Colors
			$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor', '#191B27');
			$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
			$footerBackgroundColor = get_option('footerBackgroundColor', '#FFFFFF');
			$fatFooterPadding = get_theme_mod('fatFooterPadding', 100);
			
			echo '
				.pm-fat-footer {
					background-color:'.$fatFooterBackgroundColor.';
					'.( $fatFooterBackgroundImage !== '' ? 'background-image:url('.$fatFooterBackgroundImage.')' : '' ).'
				}
				footer {
					background-color:'.$footerBackgroundColor.';
				}
				.pm-fat-footer {
					padding:'.$fatFooterPadding.'px 0;	
				}
			';
			
			
			//Global Options & Colors
			$pageBackgroundImage = get_theme_mod('pageBackgroundImage');
			$repeatBackground = get_theme_mod('repeatBackground', 'repeat');
			$pageBackgroundColor = get_option('pageBackgroundColor', '#FFFFFF');
			$primaryColor = get_option('primaryColor', '#0db7c4');
			$primaryColors = pm_ln_hex2rgb($primaryColor); //Array of colors R,G,B
			$secondaryColor = get_option('secondaryColor', '#f15b5a');
			$secondaryColors = pm_ln_hex2rgb($secondaryColor); //Array of colors R,G,B
			
			$offsetColor = get_option('offsetColor', '#1e73be'); //used for woocommerce
			
			$dividerColor = get_option('dividerColor', '#e3e3e3');
			$tooltipColor = get_option('tooltipColor', '#0db7c4');
			$blockQuoteColor = get_option('blockQuoteColor', '#0DB7C4');
			$commentBoxColor = get_option('commentBoxColor', '#f6f6f6');
			$commentShareBoxColor = get_option('commentShareBoxColor', '#adadad');
			$globalButtonBorderColor = get_option('globalButtonBorderColor', '#d9d9d9');
			$globalButtonBackgroundColor = get_option('globalButtonBackgroundColor', '#FFFFFF');
			$ulListIcon = get_theme_mod('ulListIcon', 'f105');
			$ulListIconColor = get_option('ulListIconColor', '#28BFCB');
			$boxedModeContainerColor = get_option('boxedModeContainerColor', '#ffffff');
			
			echo '
				body {
					background-repeat:'.$repeatBackground.';
					background-color:'.$pageBackgroundColor.' !important;
					'. ( $pageBackgroundImage !== '' ? 'background-image:url('.$pageBackgroundImage.')' : '' ) .'	
				}
				
				.pm-column-title-divider.locations-template {
					border-top:1px solid '.$dividerColor.';		
				}
				
				.carousel-indicators li {
					border:1px solid '.$primaryColor.';		
				}
				
				.carousel-indicators .active {
					background-color:'.$primaryColor.';
				}
				
				.carousel-control {
					background-color:'.$primaryColor.';	
				}
								
				.page-numbers {
					border: 1px solid '.$globalButtonBorderColor.';
				}
				
				.checkout-button, .button {
					background-color:'.$primaryColor.';	
				}
				
				.checkout-button:hover, .button:hover {
					background-color:'.$secondaryColor.';	
				}
				
				.remove {
					background-color: '.$primaryColor.';
				}
				
				.remove:hover {
					background-color: '.$secondaryColor.' !important;
				}	
				
				.shop_table thead {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th {
					border-top: 1px solid '.$dividerColor.' !important;	
				}
				
				.select2-container--default .select2-selection--single {
					border: 1px solid '.$dividerColor.';	
				}
				
				.product-categories li {
					border-bottom:1px solid '.$dividerColor.';
				}
				
				.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
					border-top: 1px solid '.$dividerColor.';
				}
				
				.pm-trends-list li {
					border-bottom: 1px solid  '.$dividerColor.';
				}
				
				.woocommerce .woocommerce-ordering select {
					border: 1px solid '.$dividerColor.';
				}
				
				.pro-cast-woocomm-header-divider {
					background-color: '.$dividerColor.';
				}
				
				.pm-store-post-container {
					border:1px solid '.$dividerColor.';
				}
				
				.pm-isotope-filter-system {
					border-bottom:1px solid '.$dividerColor.';
					
				}
				
				.woocommerce #reviews #comment {
					border:1px solid '.$dividerColor.';
				}
				
				.input-text.qty.text {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce #reviews #comments ol.commentlist li .comment-text {
					border: 1px solid '.$dividerColor.';	
				}
				
				.woocommerce div.product form.cart .variations select {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table td {
					border-top:1px solid '.$dividerColor.';	
				}
				
				.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
					border:1px solid '.$dividerColor.';	
				}
								
				.woocommerce form .form-row select {
					border:1px solid '.$dividerColor.';
				}				
				
				.pm-services-post-icon i {
					color:'.$primaryColor.';
				}
				
				.pm-services-post-icon {
					border: 3px solid '.$primaryColor.';	
				}
				
				.pm-services-post-excerpt p a {
					color: '.$primaryColor.';
				}
								
				.pm-tweet-list ul li:before {
					color: '.$primaryColor.';	
				}
				
				.product-categories li:before {
					color: '.$primaryColor.';		
				}
				
				.pm-form-textfield, .pm-form-textarea, .pm-required {
					color: '.$primaryColor.';		
				}
				
				.mini_cart_item .remove {
					background-color: '.$secondaryColor.';	
				}
				
				.mini_cart_item .remove:hover {
					background-color: '.$primaryColor.';	
				}
				
				.pm-icon-bundle {
					background-color: '.$primaryColor.';
    				border: 1px solid '.$dividerColor.'	
				}
				
				.widget_shopping_cart_content .buttons .wc-forward {
					background-color:'.$primaryColor.';
				}
				
				.widget_shopping_cart_content .buttons .wc-forward:hover {
					background-color:'.$secondaryColor.';
				}
				
				.price_slider_amount .button {
					background-color:'.$primaryColor.';
				}
				
				.price_slider_amount .button:hover {
					background-color:'.$secondaryColor.';
				}
				
				.pm-icon-bundle:hover {
					background-color: '.$secondaryColor.';
				}
				
				.pm-tweet-list ul li a {
					color:'.$primaryColor.';
				}
				
				.pm-tweet-list ul li a:hover {
					color:'.$secondaryColor.';	
				}
				
				.pm-boxed-mode {
					background-color:'.$boxedModeContainerColor.';
				}
				ul li:before {
					content: "\\'.$ulListIcon.'";
					color:'.$ulListIconColor.';
				}
				blockquote {
					border-left: 2px solid '.$blockQuoteColor.';
					border-right: 0px solid transparent; 
					border-top: 0px solid transparent; 
					border-bottom: 0px solid transparent; 
				}
				#pm-ln-glossary-search-results-container {
					border: 1px solid '.$primaryColor.'; 	
				}
				#pm-ln-glossary-search-results-close {
					color:'.$primaryColor.';	
				}
				.single_variation { 
					border-top: 1px solid '.$dividerColor.';
				}
				
				.reset_variations:hover {
					color:'.$primaryColor.' !important;	
				}
				.pm-single-news-post-icon i {
					color:'.$primaryColor.' !important;	
				}
				.single_add_to_cart_button {
					background-color:'.$primaryColor.' !important;		
				}
				.single_variation .price .amount { 
					color:'.$primaryColor.' !important;		
				}
				.single_add_to_cart_button:hover {
					background-color:'.$secondaryColor.' !important;		
				}
				.widget_pages ul li:before, .widget_meta ul li:before, .widget_rss ul li:before {
					color:'.$primaryColor.' !important;		
				}
				.widget_rss ul li a {
					color:'.$primaryColor.' !important;	
				}
				.widget_rss ul li a:hover {
					color:'.$secondaryColor.' !important;	
				}
				.pm_search_page_submit {
					background-color:'.$secondaryColor.';	
				}
				.widget_nav_menu ul li .sub-menu { 
					border-top: 1px solid '.$dividerColor.';	
				}
				.pagination_multi li {
					background-color: '.$primaryColor.' !important;
					border: 3px solid '.$primaryColor.';
					color: white !important;
				}
				.pagination_multi a li:hover {
					background-color: '.$primaryColor.' !important;
					border: 3px solid '.$primaryColor.' !important;
					color: white !important;
				}
				.sf-menu li.current-menu-item > a {
					background-color:'.$secondaryColor.';	
				}
				.pm-nav-tabs {
					border-bottom: 1px solid '.$dividerColor.';	
				}
				.pm_quick_contact_field.invalid_field, .pm_quick_contact_textarea.invalid_field {
					border:1px solid '.$secondaryColor.' !important;	
				}
				.pm-sidebar-link {
					font-weight:bold !important;	
					color:'.$secondaryColor.' !important;		
				}
				.pm-sidebar-link:hover {
					color:'.$primaryColor.' !important;		
				}
				.pm-post-navigation li:hover {
					background-color:'.$primaryColor.';	
				}
				.pm-post-navigation li a {
					color:'.$primaryColor.';	
				}
				.pm-staff-profile-title {
					color:'.$secondaryColor.' !important;	
				}
				.pm-square-btn.appointment-form {
					background-color: '.$primaryColor.' !important;
					border: 3px solid '.$primaryColor.' !important;
				}
				.pm-single-post-like-btn {
					border: 3px solid '.$primaryColor.';
					color: '.$primaryColor.';	
				}
				.pm-single-post-like-btn:hover {
					background-color: '.$primaryColor.';
				}
				.pm-header-info li p i {
					color: '.$primaryColor.';	
				}
				
				.pm-footer-navigation li.current_page_item a {
					border-top: 3px solid '.$primaryColor.';	
				}
				
				.pm-footer-navigation li a:hover {
					border-top: 3px solid '.$primaryColor.';
					color:'.$secondaryColor.';	
				}
				
				.pm-footer-copyright-col a {
					color: '.$primaryColor.';		
				}
				
				.pm-woocom-item-price {
					color: '.$primaryColor.' !important;			
				}
				
				.pm-store-post-tags {
					background-color: '.$primaryColor.';		
				}
				
				.pm-store-post-details-btn {
					background-color: '.$primaryColor.';		
				}
				
				.pm-store-post-details-btn:hover {
					background-color: '.$secondaryColor.';		
				}
				
				.pm-store-post-quantity {
					color: '.$primaryColor.' !important;			
				}
				
				#pm-back-top {
					border: 3px solid '.$primaryColor.';	
				}
				
				#pm-back-top:hover {
					background-color: '.$primaryColor.';	
				}
				
				#pm-back-top i {
					color: '.$primaryColor.';			
				}
				
				#pm-back-top:hover i {
					color: white;			
				}
				
				#pm_marker_tooltip { 
					background-color:'.$tooltipColor.' !important;
				}
				.sf-menu a:hover, .sf-menu ul li a:hover {
					background-color: '.$secondaryColor.';	
				}
				#pm-home-btn:hover, .pm-cart-info li a:hover {
					color: '.$secondaryColor.';		
				}
				.pm-dropdown.pm-categories-menu .pm-dropmenu-active ul li:hover { 
					background-color:'.$secondaryColor.';
					border:3px solid '.$secondaryColor.';
				}
				.pm-widget-footer .widget_categories ul a:before, .pm-widget-footer .widget_pages ul li:before, .pm-widget-footer .widget_archive ul li:before, .pm-widget-footer .widget_recent_entries ul li span {
					color: '.$primaryColor.';
				}
				.pm-widget-footer a:hover {
					color:'.$primaryColor.';	
				}
				.pm-widget-footer .tagcloud a {
					background-color:'.$primaryColor.';	
				}
				.pm-widget-footer .tagcloud a:hover {
					background-color:'.$secondaryColor.' !important;	
				}
				.pm-pagination li.current {
					background-color:'.$secondaryColor.';	
					border:3px solid '.$secondaryColor.';
					color:white;	
				}
				.pm-pagination.pm-knowledge-base-pagination li.current {
					background-color:'.$secondaryColor.';	
					border:1px solid '.$secondaryColor.';
				}
				.pm-sidebar .widget_archive ul li:before, .pm-sidebar .widget_archive ul li {
					color: '.$primaryColor.';	
				}
				.pm-sidebar .widget_categories ul a:before {
					color: '.$primaryColor.';
				}
				.pm-sidebar-search-container {
					border:1px solid '.$primaryColor.';	
				}
				.pm-sidebar-search-container i {
					color: '.$secondaryColor.';	
				}
				.widget_recent_entries .pm-widget-spacer ul li a:hover {
					color: '.$secondaryColor.';	
				}
				.pm-sidebar .tagcloud a:hover {
					background-color:'.$secondaryColor.';
				}
				.pm-rounded-btn {
					background-color:'.$secondaryColor.';	
				}
				.pm-rounded-btn.transparent {
					color:'.$secondaryColor.' !important;
				}
				.pm-rounded-btn.transparent:hover {
					color:'.$primaryColor.' !important;
				}
				.pm-sidebar .widget_categories ul li {
					color: '.$primaryColor.';	
				}
				.widget_nav_menu ul li:before {
					color: '.$primaryColor.';		
				}
				.pm-sidebar .widget_archive ul li a:hover, .pm-sidebar .widget_categories ul a:hover, .pm-sidebar .widget_nav_menu ul li a:hover {
					color:'.$secondaryColor.';		
				}
				.pm-sidebar .tweet_list li a, .pm-widget-footer .tweet_list li a {
					color:'.$primaryColor.' !important;		
				}
				.pm-sidebar .tweet_list li a:hover, .pm-widget-footer .tweet_list li a:hover {
					color:'.$secondaryColor.' !important;		
				}
				.pm-recent-blog-posts .pm-date-published {
					color:'.$secondaryColor.' !important;		
				}
				.pm-widget-footer .pm-recent-blog-posts .pm-date-published {
					color:'.$primaryColor.' !important;		
				}
				.pm-recent-blog-post-details a:hover {
					color:'.$primaryColor.' !important;		
				}
				.pm_quick_contact_field:focus, .pm_quick_contact_textarea:focus {
					background-color:'.$primaryColor.' !important;		
					border:1px solid '.$primaryColor.' !important;				
				}
				.pm_quick_contact_field.Light, .pm_quick_contact_textarea.Light {
					border:1px solid '.$primaryColor.';		
				}
				
				.pm-sidebar h6 {
					background-color:'.$primaryColor.' !important;		
				}
				.pm-standalone-news-post-category span:before, .pm-standalone-news-post-category span:after {
					border-top: 1px solid '.$primaryColor.';
				}
				
				.pm-standalone-news-post-icon {
					color:'.$primaryColor.';	
					border: 3px solid '.$primaryColor.';	
				}
				.pm-standalone-news-post-excerpt p a {
					color:'.$primaryColor.';		
				}
				.pm-pagination li {
					border: 3px solid '.$primaryColor.';
					background-color:'.$primaryColor.';
				}
				.pm-pagination li.inactive:hover, .pm-pagination li:hover {
					background-color:'.$secondaryColor.';
					border:3px solid '.$secondaryColor.';
					color:white;
				}
				
				.pm-pagination.pm-knowledge-base-pagination li.inactive:hover {
					border: 1px solid '.$secondaryColor.';		
					background-color:'.$secondaryColor.';			
				}
				.pm-widget-footer h6 span {
					color:'.$primaryColor.';			
				}
				.pm-fat-footer-title-divider {
					background-color: '.$primaryColor.';	
				}
				.pm_quick_contact_submit {
					background-color: '.$primaryColor.';
				}
				.pm_quick_contact_submit:hover {
					background-color: '.$secondaryColor.' !important;
				}
				.pm-breadcrumbs li a:hover {
					color:'.$secondaryColor.';
				}
				.pm-single-news-post-avatar-icon {
					border: 3px solid '.$primaryColor.';	
				}
				.pm-comment-form-textfield, .pm-comment-form-textarea {
					border-bottom:3px solid '.$primaryColor.';
				}
				.pm-comment-submit-btn.respond:hover {
					border: 3px solid '.$secondaryColor.';	
					background-color: '.$secondaryColor.';
				}
				.comment-reply-link:hover {
					border: 3px solid '.$secondaryColor.';	
					background-color: '.$secondaryColor.';
				}
				.pm-comment-submit-btn:hover {
					background-color:'.$primaryColor.';
					border:3px solid '.$primaryColor.';
				}
				.pm-form-textfield-with-icon {
					border:1px solid '.$primaryColor.';	
				}
				.pm-form-textfield-with-icon:focus {
					border:1px solid '.$secondaryColor.';	
					background-color: '.$secondaryColor.';
					color:white;
				}
				.pm-ln-glossary-index li a:hover {
					background-color:'.$primaryColor.';	
					color:white;	
				}
				
				.pm-ln-glossary-index li a.current {
					background-color:'.$primaryColor.';	
					color:white;	
				}
				
				.pm-ln-glossary-index-list li a:hover {
					color:'.$secondaryColor.';	
				}
				.pm-ln-glossary-index li:first-child a {
					border-left: 1px solid '.$primaryColor.';	
				}
				.pm-ln-glossary-index li a {
					border-bottom: 1px solid '.$primaryColor.';	
					border-right: 1px solid '.$primaryColor.';	
					border-top: 1px solid '.$primaryColor.';
				}
				.pm-glossary-filter {
					border: 1px solid '.$primaryColor.';
				}
				.pm-staff-profile-overlay-container.single-post {
					border: 1px solid '.$dividerColor.';	
				}
				.pm-added-to-cart-icon {
					background-color:'.$primaryColor.';		
				}
				.pm-woocomm-item-sale-tag {
					background-color:'.$secondaryColor.';			
				}
				.pm-trends-list li:before {
					color:'.$secondaryColor.';		
				}
				
				.woocommerce span.onsale {
					background-color:'. $offsetColor .';
				}
				
				.woocommerce ul.products li.product .price {
					color:'. $offsetColor .';
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a {
					background-color: '. $offsetColor .' !important;	
				}
				
				.woocommerce .star-rating span {
					color:'. $offsetColor .';	
				}
				
				.woocommerce p.stars a {
					color:'. $offsetColor .';	
				}
				
				.woocommerce-review-link {
					color:'. $offsetColor .' !important;	
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
					background-color:'. $offsetColor .';
					color:white;	
				}
				
				.woocommerce-info::before {
					color: '. $offsetColor .';
				}
				
				.woocommerce-error::before {
					color: '. $offsetColor .';
				}

				.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select {
					border-color: '. $offsetColor .';
				}
				
				.woocommerce form .form-row.woocommerce-invalid label {
					color: '. $offsetColor .';	
				}
				
				.woocommerce form .form-row .required {
					color:'. $offsetColor .';
				}
				
				.woocommerce a.remove {
					background-color: '. $offsetColor .';
					color: white !important;
				}
				
				.woocommerce-error, .woocommerce-info, .woocommerce-message {
					border-top:3px solid '. $offsetColor .';
				}
				
				.woocommerce-message::before {
					color:'. $offsetColor .';
				}
				
				.woocommerce ul.products li.product .price {
					color:'. $secondaryColor .';
				}
				
				.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
					background-color: '. $secondaryColor .';
					color: #fff;
				}
				
				.product_meta > span > a:hover {
					color: '. $secondaryColor .';
				}
				
				.woocommerce div.product form.cart .reset_variations:hover {
					background-color: '. $secondaryColor .';
				}
				
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
					background-color: '. $secondaryColor .' !important;	
					color:white !important;
				}
				
				.woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select {
					border-color:'. $secondaryColor .';
				}				
				
				.page-numbers.current, a.page-numbers:hover {
					background-color: '.$primaryColor.' !important;
					color:white !important;		
					border:1px solid  '.$primaryColor.';
				}
				
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					background-color: '.$primaryColor.';	
				}
				
				.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
					background-color: '.$primaryColor.';
				}
				
				.product_meta > span > a {
					color: '.$primaryColor.';
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li {
					background-color: '.$primaryColor.' !important;
					
				}
				
				.woocommerce #reviews #comment:focus {
					background-color:'.$primaryColor.';
				}
				
				.woocommerce div.product form.cart .reset_variations {
					background-color: '.$primaryColor.';
				}
				
				.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled, .woocommerce input.button.alt[disabled]:disabled:hover {
					background-color:'.$primaryColor.';
				}
				
				.woocommerce a.remove:hover {
					background-color: '.$primaryColor.';
				}
				
				.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus {
					border:1px solid '.$primaryColor.';	
					background-color:'.$primaryColor.';
				}
				
				.pm-store-post-details-btn:hover {
					color:white;	
					background-color:'.$secondaryColor.';	
				}
				.pm-store-post-tags a.fa:hover {
					color:'.$secondaryColor.';		
				}
				.pm-added-to-cart-icon a:hover {
					background-color:'.$secondaryColor.';		
				}
				.pm-already-in-cart a {
					color:'.$primaryColor.' !important;			
				}
				.pm-already-in-cart a:hover {
					color:'.$secondaryColor.' !important;			
				}
				.pm-square-btn.woocomm {
					background-color:'.$primaryColor.';
					border:3px solid '.$primaryColor.';	
					color:white !important;
				}
				.pm-square-btn.woocomm:hover {
					background-color:'.$secondaryColor.';
					border:3px solid '.$secondaryColor.';
				}
				.pm-sub-header-breadcrumbs {
					border-bottom: 1px solid '.$dividerColor.';
					border-top: 1px solid '.$dividerColor.';
				}
				.pm-post-navigation li:first-child {
					border-left: 1px solid '.$dividerColor.';
				}
				.pm-post-navigation li {
					border-right: 1px solid '.$dividerColor.';	
				}
				.pm-woocomm-tabs-column {
					background-color:'.$primaryColor.' !important;	
				}
				.woocommerce-tabs .tabs li a:hover {
					color:'.$primaryColor.';
				}
				.comment-form-rating .stars span a i:hover {
					color:'.$secondaryColor.' !important;	
				}
				.comment-form-rating .stars span a i.activated {
					color:'.$secondaryColor.' !important;		
				}
				.comment-form-comment textarea:focus {
					background-color:'.$secondaryColor.';
					border:3px solid '.$secondaryColor.';	
					color:white;
					text-transform:none !important;
				}
				.pm-divider.knowledgebase-post {
					width:100%;	
					background-color:'.$dividerColor.';
				}
				.pm-page-share-options {
					border-top: 1px solid '.$dividerColor.';
				}
				.pm-rounded-submit-btn, #place_order, .lost_reset_password input[type="submit"], .woocommerce .form-row input[type="submit"] {
					background-color:'.$secondaryColor.';	
				}
				.pm-textfield:focus, .pm-textarea:focus {
					background-color:'.$primaryColor.';
					border-bottom:3px solid '.$primaryColor.';	
				}
				.woocommerce-error {
					background-color:'.$primaryColor.';
					color:white;	
				}
				.woocommerce-info {
					color:'.$primaryColor.' !important;	
				}
				#coupon_code:focus {
					border:1px solid '.$primaryColor.';	
				}
				.pm-checkout-tabs > li a:hover {
					background-color:'.$primaryColor.';		
					color:white !important;
				}
				.pm-icon-btn {
					background-color:'.$secondaryColor.';		
				}
				.pm-icon-btn:hover {
					background-color:'.$primaryColor.';		
				}
				.pm-column-container-message {
					background-color:'.$secondaryColor.';			
				}
				.pm-primary {
					color:'.$primaryColor.' !important;	
				}
				.pm-primary:hover {
					color:'.$secondaryColor.' !important;	
				}
				.pm-secondary {
					color:'.$secondaryColor.' !important;	
				}
				.pm-secondary:hover {
					color:'.$primaryColor.' !important;	
				}
				.pm-glossary-search-box {
					border: 1px solid '.$primaryColor.';	
				}
				.tweet_list li:before {
					color:'.$primaryColor.' !important;	
				}
				.pm-standalone-news-post-excerpt p a {
					color:'.$primaryColor.';	
				}
				.pm-standalone-news-post-excerpt p a:hover {
					color:'.$secondaryColor.';	
				}
				.owl-item .pm-brand-item a {
					background-color:'.$secondaryColor.';				
				}
				.owl-item .pm-brand-item a:hover {
					background-color:'.$primaryColor.';				
				}
				.btn.pm-owl-prev, .btn.pm-owl-next {
					background-color:'.$primaryColor.';			
				}
				.btn.pm-owl-prev:hover, .btn.pm-owl-next:hover {
					background-color:'.$secondaryColor.';			
				}
				.pm-testimonial-img-icon {
					border: 3px solid '.$primaryColor.';	
				}
				.pm-staff-profile-icons li a {
					background-color:'.$primaryColor.';		
				}
				.pm-staff-profile-icons li a:hover {
					background-color:'.$secondaryColor.';			
				}
				.pm-staff-profile-expander {
					background-color:'.$secondaryColor.';				
				}
				.pm-staff-profile-expander:hover {
					background-color:'.$primaryColor.';				
				}
				.pm-newsletter-submit-btn {
					background-color:'.$secondaryColor.';			
				}
				.pm-newsletter-form-container input[type="text"] {
					border: 1px solid '.$primaryColor.';	
				}
				.panel-title i {
					background-color:'.$secondaryColor.';			
				}
				.pm-accordion-link:hover {
					background-color:'.$secondaryColor.' !important;
					color:white !important;
				}
				.pm-video-activator-btn {
					border: 3px solid '.$primaryColor.';
					color: '.$primaryColor.';
				}
				.pm-video-activator-btn:hover {
					background-color:'.$primaryColor.';	
					border: 3px solid white;	
					color:white;
				}
				.pm-square-btn.pm-staff-profile-btn:hover {
					background-color:'.$primaryColor.';	
					border:3px solid '.$primaryColor.';		
				}
				.pm-form-textarea.invalid_field, .pm-form-textfield.invalid_field {
					border:1px solid '.$secondaryColor.';
				}
				.pm-form-textfield, .pm-form-textarea {
					border:1px solid '.$primaryColor.';	
				}
				.pm-form-textfield:focus, .pm-form-textarea:focus {
					background-color:'.$primaryColor.';		
				}
				.pm-checkout-tabs > li.active > a, .pm-checkout-tabs > li.active > a:hover, .pm-checkout-tabs > li.active > a:focus {
					background-color:'.$secondaryColor.';	
				}
				.pm-checkout-tabs > li a {
					background-color:'.$primaryColor.';	
					color:white;	
				}
				.pm-checkout-tabs > li a:hover {
					background-color:'.$secondaryColor.';		
				}
				.tinynav {
					border:1px solid '.$primaryColor.';	
				}
				.pm-sub-navigation a i:hover {
					color:'.$primaryColor.';		
				}
				
				.pm-isotope-filter-system-expand {
					background-color:'.$primaryColor.';	
				}
				.pm-comment-form-textfield:focus, .pm-comment-form-textarea:focus {
					background-color:'.$primaryColor.';	
					border-bottom:3px solid '.$primaryColor.';	
				}
				.pm-comment-form-textarea.respond:focus {
					background-color:'.$secondaryColor.';	
					border-bottom:3px solid '.$secondaryColor.';		
				}
				
				.pm-header-info li p a {
					color:'.$primaryColor.';	
				}
				
				.pm-header-info li p a:hover {
					color:'.$secondaryColor.';	
				}
				
				p a {
					color:'.$primaryColor.';		
				}
				
				blockquote a {
					color:'.$primaryColor.';	
					font-size:inherit !important;	
				}
				
				.pm-gallery-item-expander {
					background-color: '.$secondaryColor.';	
				}
				.pm-gallery-item-expander:hover {
					background-color: '.$primaryColor.';	
				}
				.pm-isotope-filter-system li a.current {
					border-bottom: 3px solid '.$primaryColor.';
				}
				.pm-isotope-filter-system li a:hover {
					border-bottom: 3px solid '.$primaryColor.';
				}
				.pm-square-btn:hover {
					border: 3px solid '.$primaryColor.';
					background-color:'.$primaryColor.';	
				}
				.pm-post-loaded-info li a {
					background-color:'.$secondaryColor.';	
				}
				.pm-gallery-item-btns li a {
					background-color:'.$primaryColor.';		
				}
				.pm-gallery-item-btns li a:hover {
					background-color:'.$secondaryColor.';		
				}
				.pm-single-post-social-features {
					border-top: 1px solid '.$primaryColor.';	
				}
				.pm-related-blog-posts .pm-date {
					color:'.$secondaryColor.';
				}
				.pm-store-post-container {
					border:1px solid '.$dividerColor.';
				}
				.pm-nav-tabs > li.active > a, .pm-nav-tabs > li.active > a:hover, .pm-nav-tabs > li.active > a:focus {
					background-color:'.$primaryColor.';	
					color:white !important;
				}
				
				.pm-nav-tabs > li > a {
					background-color:'.$secondaryColor.';		
				}
				
				.pm-nav-tabs > li > a:hover {
					background-color:'.$primaryColor.';	
					color:white !important;	
				}
				
				.flex-direction-nav a { 
					background-color:rgba('.$primaryColors[0].','.$primaryColors[1].','.$primaryColors[2].',.8);
				}
				
				.flex-direction-nav a:hover { 
					background-color:rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',1);
				}				
				
				.pm-services-post-overlay {
    				background-color: rgba('.$primaryColors[0].','.$primaryColors[1].','.$primaryColors[2].',.9);
				}
								
				@media only screen and (min-width: 767px) and (max-width: 991px) {
					
					.pm-isotope-filter-system li a.current {
						border-bottom: 3px solid '.$primaryColor.';
					}
					
					.pm-isotope-filter-system li a {
						border-bottom: 3px solid '.$primaryColor.';
						border-left:3px solid '.$primaryColor.';
						border-right:3px solid '.$primaryColor.';
					}
					
					.pm-isotope-filter-system li a:hover {
						background-color:'.$primaryColor.';	
						border-left:3px solid '.$primaryColor.';	
						border-right:3px solid '.$primaryColor.';	
						border-bottom:3px solid '.$primaryColor.' !important;
					}
				}
				
				@media only screen and (max-width: 767px) {
					.pm-isotope-filter-system li a.current {
						border-bottom: 3px solid '.$primaryColor.';
					}
					
					.pm-isotope-filter-system li a {
						border-bottom: 3px solid '.$primaryColor.';
						border-left:3px solid '.$primaryColor.';
						border-right:3px solid '.$primaryColor.';
					}
					
					.pm-isotope-filter-system li a:hover {
						background-color:'.$primaryColor.';	
						border-left:3px solid '.$primaryColor.';	
						border-right:3px solid '.$primaryColor.';	
						border-bottom:3px solid '.$primaryColor.' !important;
					}	
				}
			';
			
			
			//Post Options & Colors
			$authorBackgroundImage = get_theme_mod('authorBackgroundImage');
			$postTitleColor = get_option('postTitleColor', '#48D3DE');
			$postTitleColors = pm_ln_hex2rgb($postTitleColor); //Array of colors R,G,B
			$authorCommentsBoxColor = get_option('authorCommentsBoxColor', '#0DB7C4');
			$authorDividerColor = get_option('authorDividerColor', '#34ceda');
			$authorBorderColor = get_option('authorBorderColor', '#ffffff');
			
			if(!empty($authorBackgroundImage)) {
				echo '
					.pm-column-container.pm-author-column {
						background-image:url('. esc_url($authorBackgroundImage) .');
					}
				';
			}
			
			echo '
				
				.pm-author-column, .pm-comments-column {
					background-color:'.$authorCommentsBoxColor.';	
				}
				.pm-author-divider {
					background-color:'.$authorDividerColor.';		
				}
				.pm-author-bio-img-bg {
					border: 5px solid '.$authorBorderColor.';	
				}
				.pm-standalone-news-post-overlay, .pm-single-news-post-overlay {
					background-color:rgba('.$postTitleColors[0].','.$postTitleColors[1].','.$postTitleColors[2].', 1);	
				}
			';
			
			//Shortcode options
			$testimonials_carousel_color = get_option('testimonials_carousel_color', '#ffffff');
			$accordionContentBgColor = get_option('accordionContentBgColor', '#00A6B4');
			$tabContentBgColor = get_option('tabContentBgColor', '#ffffff');
			$quote_box_color = get_option('quote_box_color', '#0DB7C4');
			$data_table_title_color = get_option('data_table_title_color', '#0DB7C4');
			$data_table_info_color = get_option('data_table_info_color', '#E8E8E8');
			$timetable_font_color = get_option('timetable_font_color', '#ffffff');
			$timetable_border_color = get_option('timetable_border_color', '#309da5');
			
			echo '
			
				.pm-tab-content {
					background-color:'.$tabContentBgColor.';		
				}
				.pm-workshop-table-title {
					background-color:'.$data_table_title_color.';	
				}
				.pm-workshop-table-content {
					background-color:'.$data_table_info_color.';		
				}
			
				.pm-testimonials-arrows a {
					color:'.$testimonials_carousel_color.';	
				}
				.pm-testimonial-img {
					border: 5px solid '.$testimonials_carousel_color.';	
				}
				.panel-collapse {
					background-color:'.$accordionContentBgColor.';	
				}
				.pm-single-testimonial-box:before {
					border-top: 0px solid '.$quote_box_color.';
				}
				.pm-single-testimonial-box {
					background-color:'.$quote_box_color.';		
				}
				.pm-timetable-panel-content-body ul li, .pm-timetable-panel-title a, .pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open {
					color:'.$timetable_font_color.' !important;	
				}
				.pm-timetable-panel-content-body ul li {
					border-bottom: 1px solid '.$timetable_border_color.';
				}
			';
			
			
			//Alert options
			$alert_success_color = get_option('alert_success_color', '#2c5e83');
			$alert_info_color = get_option('alert_info_color', '#cbb35e');
			$alert_warning_color = get_option('alert_warning_color', '#ea6872');
			$alert_danger_color = get_option('alert_danger_color', '#5f3048');
			$alert_notice_color = get_option('alert_notice_color', '#49c592');
			
			echo '
				.alert-warning {
					background-color:'.$alert_warning_color.';	
				}
				
				.alert-success {
					background-color:'.$alert_success_color.';	
				}
				
				.alert-danger {
					background-color:'.$alert_danger_color.';	
				}
				
				.alert-info {
					background-color:'.$alert_info_color.';	
				}
				
				.alert-notice {
					background-color:'.$alert_notice_color.';	
				}
	
			';
			
			
			//Pulse slider options
			$sliderBackgroundImage = get_theme_mod('sliderBackgroundImage');
			$getSliderTitleOpacity = get_theme_mod('sliderTitleOpacity', 100);
			$sliderTitleOpacity = $getSliderTitleOpacity / 100;
			
			$sliderTitleBackgroundColor = get_option('sliderTitleBackgroundColor', '#25beca');
			$sliderTitleBackgroundColors = pm_ln_hex2rgb($sliderTitleBackgroundColor);
			
			$sliderSubTitleBackgroundColor = get_option('sliderSubTitleBackgroundColor', '#34ceda');
			$sliderSubTitleBackgroundColors = pm_ln_hex2rgb($sliderSubTitleBackgroundColor);
			
			$sliderButtonColor = get_option('sliderButtonColor', '#f15b5a');
			$sliderButtonHoverColor = get_option('sliderButtonHoverColor', '#333333');
			$bulletColor = get_option('bulletColor', '#f15b5a');
			$bulletBgColor = get_option('bulletBgColor', '#ffffff');
			
			if($sliderBackgroundImage !== '') :
			
				echo '
					.pm-caption {
						background-image:url('.$sliderBackgroundImage.');	
					}
				';
			
			endif;
			
			echo '
				.pm-caption h1 {
					background-color:rgba('.$sliderTitleBackgroundColors[0].', '.$sliderTitleBackgroundColors[1].', '.$sliderTitleBackgroundColors[2].', '.$sliderTitleOpacity.');	
				}
				.pm-caption-decription {
					background-color:rgba('.$sliderSubTitleBackgroundColors[0].', '.$sliderSubTitleBackgroundColors[1].', '.$sliderSubTitleBackgroundColors[2].', '.$sliderTitleOpacity.');		
				}
				.pm-slide-btn {
					background-color:'.($sliderButtonColor).';	
				}
				.pm-slide-btn:hover {
					background-color:'.($sliderButtonHoverColor).';		
				}
				.pm-dots span.pm-currentDot {
					background-color:'.($bulletColor).';			
				}
				.pm-dots span:hover {
					background-color:'.($bulletColor).';			
				}
				.pm-dots span {
					background-color:'.($bulletBgColor).';		
				}
			';
						
			
			$enableSubHeader = get_theme_mod('enableSubHeader', 'on');
			
			if($enableSubHeader === 'off') {
				
				echo '
					.pm-nav-container {
						position:relative;
					}
				';
				
			}
			
			$enableBulletThumbs = get_theme_mod('enableBulletThumbs', 'on');
			
			if($enableBulletThumbs === 'off') {
				
				echo '
					#pm_slider_tooltip {
						display:none;
					}
				';
				
			}
						
		 ?>
	</style>
    
    <?php
}

/* Cache customizer */
function pm_ln_customizer_styles_cache() {
	
	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database
		$data = get_theme_mod( 'my_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data == false ) {
			// We'll be adding our actual CSS using a filter
			$data = apply_filters( 'my_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'my_customizer_styles', $data );
		}

	// If we're not on the customizer, get all the styles using our filter
	} else {

		$data = apply_filters( 'my_styles_filter', null );

	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'my-styles' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'pm-ln-customizer-css', $data );

}


/* Reset the cache when saving the customizer */
function pm_ln_reset_style_cache_on_customizer_save() {
	remove_theme_mod( 'my_customizer_styles' );
}