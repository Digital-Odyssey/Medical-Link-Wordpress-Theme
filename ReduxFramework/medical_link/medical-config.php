<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'medicallinktheme'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'medicallinktheme'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'medicallinktheme'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'medicallinktheme'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'medicallinktheme'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'medicallinktheme') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'medicallinktheme'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /***** ACTUAL DECLARATION OF SECTIONS ******/
			      

            // HEADER OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Header Options', 'medicallinktheme'),
			  'heading'   => __('Manage options for the header area.', 'medicallinktheme'),
			  'desc'      => __('<p class="description">Edit fonts for the header area and activate or deactivate the google map for the contact page template.</p>', 'medicallinktheme'),
			
			  'fields'    => array(
			  
			    //Fields go here
				array(
					'id'            => 'opt-nav-font',
					'type'          => 'typography',
					'title'         => __('Navigation Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.sf-menu a', '.pm-cart-info li p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.sf-menu a', '.pm-cart-info li p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for desktop and mobile navigation.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '400',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '32px'
					),
				),
				  
				array(
					'id'            => 'opt-page-title-font',
					'type'          => 'typography',
					'title'         => __('Page Title', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-post-title', '.pm-page-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-post-title', '.pm-page-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Page Title.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '900',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '36px',
						'line-height'   => '40px',
						'text-transform' => 'uppercase'
					),
				),
				
				
				array(
					'id'            => 'opt-message-font',
					'type'          => 'typography',
					'title'         => __('Page Message', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-page-message'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-page-message'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the header page message.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '16px',
						'line-height'   => '24px'
					),
				),
				
				array(
					'id'            => 'opt-breadcrumb-font',
					'type'          => 'typography',
					'title'         => __('Breadcrumb Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-breadcrumbs li', '.pm-breadcrumbs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-breadcrumbs li', '.pm-breadcrumbs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the breadcrumb trail font.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5b5b5b',
						'font-weight'    => '300',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '24px'
					),
				),
				
				array(
					'id'            => 'opt-micro-nav-links-font',
					'type'          => 'typography',
					'title'         => __('Micro Navigation Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sub-menu-info a', '.pm-dropmenu .pm-menu-title', '.pm-sub-navigation li a', '#pm-close-appointment-form', '#pm-appointment-form-response', '.pm-appointment-form-notice'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sub-menu-info a', '.pm-dropmenu .pm-menu-title', '.pm-sub-navigation li a', '#pm-close-appointment-form', '#pm-appointment-form-response', '.pm-appointment-form-notice'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the micro navigation area.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '400',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '24px'
					),
				),
			
			  )//end of fields
			
			);//end of section
			
			// FOOTER OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Footer Options', 'medicallinktheme'),
			  'heading'   => __('Manage options for the footer area.', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-footer-widget-title',
					'type'          => 'typography',
					'title'         => __('Footer Widget Title', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Footer Widget Title.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '22px',
						'line-height'   => '30px',
						'font-weight'   => '300',
					),
				),//end of field

				
				array(
					'id'            => 'opt-footer-info-font',
					'type'          => 'typography',
					'title'         => __('Fat Footer Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer p', '.pm-widget-footer .textwidget', '.tweet_list li', '.pm-widget-footer .widget_archive ul li', '.tweet_list li a', '.pm-widget-footer a', '.pm-widget-footer .widget_meta ul li a', 'pm-widget-footer .widget_categories ul li  a', '.pm-widget-footer .widget_rss ul li', '.widget_nav_menu ul li a', '.pm-widget-footer .pm-sidebar-search-field', '.pm-footer-copyright-info'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer p', '.pm-widget-footer .textwidget', '.tweet_list li', '.pm-widget-footer .widget_archive ul li', '.tweet_list li a', '.pm-widget-footer a', '.pm-widget-footer .widget_meta ul li a', 'pm-widget-footer .widget_categories ul li  a', '.pm-widget-footer .widget_rss ul li', '.widget_nav_menu ul li a', '.pm-widget-footer .pm-sidebar-search-field', '.pm-footer-copyright-info'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling in the fat footer area.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '24px'
					),
				),//end of field

				
				array(
					'id'            => 'opt-footer-nav-links',
					'type'          => 'typography',
					'title'         => __('Footer Navigation Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-footer-navigation li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-footer-navigation li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the navigation in the footer area.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field

				
				array(
					'id'            => 'opt-footer-tag-font',
					'type'          => 'typography',
					'title'         => __('Footer Tag Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer .tagcloud a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer .tagcloud a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for social footer area.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
                        'id'        => 'opt-footer-copyright',
                        'type'      => 'textarea',
                        'title'     => __('Copyright Info', 'medicallinktheme'),
                        'subtitle'  => __('Add a custom copyright message or leave blank to display default copyright info. NOTE: copyright date is automatically added either way.', 'medicallinktheme'),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', 'medicallinktheme'),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
			
			  )//end of fields
			
			);//end of section
				
			
			//SHORTCODE OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Shortcode Options', 'medicallinktheme'),
			  'heading'   => __('Manages options and font styles for particular shortcodes.', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				
				array(
					'id'            => 'opt-testimonials-quote-font',
					'type'          => 'typography',
					'title'         => __('Testimonials Carousel', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-testimonial-quote', '.pm-testimonial-name'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-testimonial-quote', '.pm-testimonial-name'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the testimonials carousel.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '500',
						'font-style'	=> 'italic',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '30px',
						'line-height'	=> '50px',
					),
				),//end of field

				
				array(
					'id'            => 'opt-countdown-font',
					'type'          => 'typography',
					'title'         => __('Tab and Accordion button font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.panel-heading .panel-title', '.pm-nav-tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.panel-heading .panel-title', '.pm-nav-tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the button font styling for the tab and accordion system.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '42px',
					),
				),//end of field
				
							
				array(
					'id'            => 'opt-alerts-font',
					'type'          => 'typography',
					'title'         => __('Alerts', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.alert'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.alert'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for Alert shortcode.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
								
				
				array(
					'id'            => 'opt-pie-chart-font',
					'type'          => 'typography',
					'title'         => __('Pie Chart / Countdown / Milestone', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-pie-chart .pm-pie-chart-percent', '.pm-pie-chart-description', '.milestone .milestone-description', '.milestone.alt .milestone-description', '.pm-countdown-container', '.milestone .milestone-value'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-pie-chart .pm-pie-chart-percent', '.pm-pie-chart-description', '.milestone .milestone-description', '.milestone.alt .milestone-description', '.pm-countdown-container', '.milestone .milestone-value'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Pie Chart and Countdown shortcode.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5e5e5e',
						'font-style'	=> 'normal',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				
				
			
			  )//end of fields
			
			);//end of section
			
			
			//WIDGET OPTIONS
			/*$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Widget Options', 'medicallinktheme'),
			  'heading'   => __('Manage options and font styles for particular widgets.', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here				
				array(
					'id'            => 'opt-classes-date-font',
					'type'          => 'typography',
					'title'         => __('Classes Widget Date', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-class-post-date .month', '.pm-widget-class-post-date .day'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-class-post-date .month', '.pm-widget-class-post-date .day'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Classes widget info text.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#000000',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
						'line-height' => '30px'
					),
				),//end of field
			
			  )//end of fields
			
			);//end of section*/
			
			
			//GLOBAL FONTS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Global Fonts', 'medicallinktheme'),
			  'heading'   => __('Manage Global Font Styles.', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-body-font',
					'type'          => 'typography',
					'title'         => __('Body Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('p', 'a', '.pm-standalone-news-post-excerpt p', '.pm-single-post-article p', '.pm-services-post-excerpt p', '.woocommerce-message', '.pm-woocomm-item-sale-tag', '.woocommerce-info', '.pm-timetable-panel-content-body ul li', '.pm-timetable-panel-title a', '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('p', 'a', '.pm-standalone-news-post-excerpt p', '.pm-single-post-article p', '.pm-services-post-excerpt p', '.woocommerce-message', '.pm-woocomm-item-sale-tag', '.woocommerce-info', '.pm-timetable-panel-content-body ul li', '.pm-timetable-panel-title a', '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the main body font throughout the site.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#666666',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '15px',
					),
				),//end of field
				
								
				array(
					'id'            => 'opt-header1',
					'type'          => 'typography',
					'title'         => __('H1', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 1 tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#2A5C81',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '48px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header2',
					'type'          => 'typography',
					'title'         => __('H2', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 2 tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#595959',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '30px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header3',
					'type'          => 'typography',
					'title'         => __('H3', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 3 tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '30px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header4',
					'type'          => 'typography',
					'title'         => __('H4', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 4 tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '900',
						'font-family'   => 'Oswald',
						'google'        => true,
						'text-transform' => 'uppercase',
						'font-size'     => '30px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header5',
					'type'          => 'typography',
					'title'         => __('H5', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 5 tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#f6d600;',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '18px',
						'line-height'   => '32px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header6',
					'type'          => 'typography',
					'title'         => __('H6', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 6 tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'line-height'   => '28px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-button-font',
					'type'          => 'typography',
					'title'         => __('Button Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-rounded-btn', '#pm-load-more', '.pm-form-submit-btn', '.pm-square-btn.woocomm', '#place_order', '.pm-newsletter-submit-btn', '.pm_quick_contact_submit', '.pm-comment-submit-btn', '.single_add_to_cart_button', '.button'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-rounded-btn', '#pm-load-more', '.pm-form-submit-btn', '.pm-square-btn.woocomm', '#place_order', '.pm-newsletter-submit-btn', '.pm_quick_contact_submit', '.pm-comment-submit-btn', '.single_add_to_cart_button', '.button'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for all buttons.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'    => 'bold',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-widget-header',
					'type'          => 'typography',
					'title'         => __('Sidebar Widget Title', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar h6', '.pm-sidebar .pm-widget h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar h6', '.pm-sidebar .pm-widget h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the widget title in the sidebar area.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '500',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '20px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-tag-button',
					'type'          => 'typography',
					'title'         => __('Sidebar Tag Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .tagcloud a', '.pm-sidebar .pm-square-btn.event', '.pm-sidebar .pm-square-btn.class-widget'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .tagcloud a', '.pm-sidebar .pm-square-btn.event', '.pm-sidebar .pm-square-btn.class-widget'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the button font styling for the tags widget.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'    => 'bold',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
						'line-height' => '40px',
						'text-align' => 'center',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .textwidget p', '.pm-sidebar .tweet_text', '.pm-sidebar .pm-recent-blog-post-details p', '.price_label'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .textwidget p', '.pm-sidebar .tweet_text', '.pm-sidebar .pm-recent-blog-post-details p', '.price_label'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the sidebar area.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#626161',
						'font-weight'   => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '15px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-link-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Link Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar a', '.pm-sidebar .tweet_list li a', '.pm-sidebar .widget_archive ul li a', '.pm-sidebar .widget_nav_menu ul li a', '.pm-sidebar .pm-recent-blog-post-details a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar a', '.pm-sidebar .tweet_list li a', '.pm-sidebar .widget_archive ul li a', '.pm-sidebar .widget_nav_menu ul li a', '.pm-sidebar .pm-recent-blog-post-details a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for all links in the sidebar.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#2a313a',
						'font-weight'   => '400',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-meta-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Meta Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.widget_recent_entries .pm-widget-spacer ul li span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.widget_recent_entries .pm-widget-spacer ul li span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for all links in the sidebar.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#9c8d00',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'     => '24px',
					),
				),//end of field

				
				array(
					'id'            => 'opt-tooltip-font',
					'type'          => 'typography',
					'title'         => __('Tooltip Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the tooltip.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '100',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-undordered-list-font',
					'type'          => 'typography',
					'title'         => __('Unordered List Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('ul'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('ul'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the undordered and orderded lists.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'   => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-ordered-list-font',
					'type'          => 'typography',
					'title'         => __('Ordered List Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('ol'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('ol'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the undordered and orderded lists.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'   => '100',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-glossary-list-font',
					'type'          => 'typography',
					'title'         => __('Glossary List Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-ln-glossary-index-list li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-ln-glossary-index-list li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Knowledge base center glossary list font.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'   => '100',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '15px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-block-quote-font',
					'type'          => 'typography',
					'title'         => __('Block Quote Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('blockquote', 'blockquote p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('blockquote', 'blockquote p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the blockquote tag.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-comment-notification-font',
					'type'          => 'typography',
					'title'         => __('Comments Form Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#cancel-comment-reply-link', '.comment-form p', '.comment-form a', '.pm-comment-html-tags span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#cancel-comment-reply-link', '.comment-form p', '.comment-form a', '.pm-comment-html-tags span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for comment forms.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '13px',
					),
				),//end of field


			
			  )//end of fields
			
			); //end of section
			
			
			//POST OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Post Options', 'medicallinktheme'),
			  'heading'   => __('Manage options and font styles for News Posts.', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-post-title-font',
					'type'          => 'typography',
					'title'         => __('Post Title', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-standalone-news-post-title a', '.pm-single-news-post-title', '.pm-services-post-title a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-standalone-news-post-title a', '.pm-single-news-post-title', '.pm-services-post-title a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the post title.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => 'bold',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '18px',
						'text-transform' => 'uppercase',
						'line-height'   => '24px'
					),
				),//end of field
				
			
				
				array(
					'id'            => 'opt-post-month-font',
					'type'          => 'typography',
					'title'         => __('Post Date / Comments', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-standalone-news-post-date'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-standalone-news-post-date'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the post date, author and comment font.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '30px'
					),
				),//end of field
				
							
				
				array(
					'id'            => 'opt-post-meta-font',
					'type'          => 'typography',
					'title'         => __('Meta Information Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page 
					'output'        => array('.pm-single-post-tags .tags', '.pm-single-post-social-icons li:first-child p', '.pm-single-post-like-feature span', '.pm-standalone-news-post-category a', '.pm-single-post-tags .tags a', '.pm-store-post-tags p', '.pm-store-post-tags p a', '.product_meta', '.posted_in a', '.tagged_as a', '.pm-product-share-container p', '.pm-single-knowledgebase-cats .cats', '.pm-single-knowledgebase-cats .cats a', '.pm-single-knowledgebase-tags .tags', '.pm-single-knowledgebase-tags .tags a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-post-tags .tags', '.pm-single-post-social-icons li:first-child p', '.pm-single-post-like-feature span', '.pm-standalone-news-post-category a', '.pm-single-post-tags .tags a', '.pm-store-post-tags p', '.pm-store-post-tags p a', '.product_meta', '.posted_in a', '.tagged_as a', '.pm-product-share-container p', '.pm-single-knowledgebase-cats .cats', '.pm-single-knowledgebase-cats .cats a', '.pm-single-knowledgebase-tags .tags', '.pm-single-knowledgebase-tags .tags a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the post category and tag links.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
						'line-height'   => '24px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-post-sections-font',
					'type'          => 'typography',
					'title'         => __('Post Sections Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-post-column-title', '.pm-comment-header h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-post-column-title', '.pm-comment-header h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for each section on a single post page.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '300',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '30px',
						'line-height'   => '26px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-staff-profile-font',
					'type'          => 'typography',
					'title'         => __('Staff / Gallery post type font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-staff-profile-name', '.pm-staff-profile-title', '.pm-gallery-item-title p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-staff-profile-name', '.pm-staff-profile-title', '.pm-gallery-item-title p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for name and title in the staff profile post and the title in the Gallery post.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'	=> 'bold',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '20px',
						'text-transform' => 'uppercase'
					),
				),//end of field
									
			
			  )//end of fields
			
			);//end of section
						
            
			//WOOCOMMERCE OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Woocommerce Options', 'medicallinktheme'),
			  'heading'   => __('Manage options and font styles for the Woocommerce Shopping Cart.', 'medicallinktheme'),
			  'desc'      => __('<p class="description">This section only applies if the Woocommerce plug-in is installed and activated.</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				
				array(
					'id'            => 'opt-woo-product-archive-title-font',
					'type'          => 'typography',
					'title'         => __('Product Title Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-loop-product__title', '.woocommerce ul.products li.product .woocommerce-loop-category__title', '.woocommerce ul.products li.product .woocommerce-loop-product__title', '.woocommerce ul.products li.product h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-loop-product__title', '.woocommerce ul.products li.product .woocommerce-loop-category__title', '.woocommerce ul.products li.product .woocommerce-loop-product__title', '.woocommerce ul.products li.product h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product title font.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#7e7e7e',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '15px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-product-price-font',
					'type'          => 'typography',
					'title'         => __('Product Price Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-Price-amount'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-Price-amount'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product price font.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#7e7e7e',
						'font-style'    => 'Normal',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '24px'
						),
				),//end of field
				
				array(
					'id'            => 'opt-woo-tab-font',
					'type'          => 'typography',
					'title'         => __('Tab System Button Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the tab font for Woocommerce tab system.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'    => 'Normal',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '14px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-tab-title-font',
					'type'          => 'typography',
					'title'         => __('Tab System Body Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'output'        => array('#tab-description p', '.woocommerce-noreviews', '.comment-form-rating label', '.comment-form-comment label', '.comment-text .meta', '.comment-text .description p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#tab-description p', '.woocommerce-noreviews', '.comment-form-rating label', '.comment-form-comment label', '.comment-text .meta', '.comment-text .description p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the tab title font for Woocommerce tab system.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '16px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-woo-form-title-font',
					'type'          => 'typography',
					'title'         => __('Form Title Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'output'        => array('.woocommerce-billing-fields h3', '.pm-cart-count-text', '.cart_totals  h2', '.related.products h2', '.shipping-calculator-button', '#order_review_heading', '.pm-coupon-code', '.addresses h3', '.woocommerce-shipping-fields h3', '.woocommerce-additional-fields h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-billing-fields h3', '.pm-cart-count-text', '.cart_totals  h2', '.related.products h2', '.shipping-calculator-button', '#order_review_heading', '.pm-coupon-code', '.addresses h3', '.woocommerce-shipping-fields h3', '.woocommerce-additional-fields h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the title font for Woocommerce forms.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#2a313a',
						'font-style'    => 'Normal',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '30px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-form-font',
					'type'          => 'typography',
					'title'         => __('Form Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce address', '.row.cart_item', '.cart_totals table', '.woocommerce-billing-fields label', '.shop_table', '.customer_details', '.comment-reply-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce address', '.row.cart_item', '.cart_totals table', '.woocommerce-billing-fields label', '.shop_table', '.customer_details', '.comment-reply-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the body font for Woocommerce forms.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field
				
				array(
					'id'            => 'opt-woo-form-links-font',
					'type'          => 'typography',
					'title'         => __('Form Links Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.row.cart_item a', '.woocommerce-message a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.row.cart_item a', '.woocommerce-message a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the links font for Woocommerce forms.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#2C5E83',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field
				
			
			  )//end of fields
			
			);//end of section
						
			
			//APPOINTMENT FORM
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Appointment Form', 'medicallinktheme'),
			  'heading'   => __('Appointment Form', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-appointment-form-recipient-email',
                        'type'      => 'text',
                        'title'     => __('Recipient Email', 'medicallinktheme'),
                        'subtitle'  => __('Provide the recipient email for the Appointment Form.', 'medicallinktheme'),
						'default' => 'Paste email address here',
                        //'desc'      => __('This field is even HTML validated!', 'medicallinktheme'),
                        //'validate'  => 'js',
						'default'   => ''
                ),

				
											
			  )//end of fields
			
			);//end of section
			
			
			//KNOWLEDGE BASE
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Knowledge Base Options', 'medicallinktheme'),
			  'heading'   => __('Knowledge Base Options', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-knowledge-base-url',
                        'type'      => 'text',
                        'title'     => __('Knowledge Base Return URL', 'medicallinktheme'),
                        'subtitle'  => __('Provide the return URL for the knowledge base link found on single knowledge base posts.', 'medicallinktheme'),
						'default' => 'Paste URL here',
                        //'desc'      => __('This field is even HTML validated!', 'medicallinktheme'),
                        //'validate'  => 'js',
						'default'   => ''
                ),

				
											
			  )//end of fields
			
			);//end of section
			
									
						
			//Custom Slider
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Custom Slider', 'medicallinktheme'),
			  'heading'   => __('Custom Slider', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-custom-slider',
                        'type'      => 'text',
                        'title'     => __('Custom Slider', 'medicallinktheme'),
                        'subtitle'  => __('You can display a custom slider on the default index page by providing a slider shortcode here. <strong>NOTE:</strong> Be sure to disable the Micro Slider under Appearance -> Customize Medical-Link -> Micro Slider Options', 'medicallinktheme'),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', 'medicallinktheme'),
                        //'validate'  => 'html',
						'default' => 'Paste Slider shortcode here'
                ),
				
											
			  )//end of fields
			
			);//end of section
			
			
			//TESTIMONIALS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Testimonials Carousel', 'medicallinktheme'),
			  'heading'   => __('Testimonials Carousel', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-testimonials-slides',
					'type'      => 'slides',
					'title'     => __('Testimonial Slides', 'medicallinktheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'medicallinktheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'medicallinktheme'),
					'placeholder'   => array(
						'title'         => __('Authors name', 'medicallinktheme'),
						'description'   => __('Quote', 'medicallinktheme'),
						'url'           => __('Authors title', 'medicallinktheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			//CLIENTS/BRANDS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Clients Carousel', 'medicallinktheme'),
			  'heading'   => __('Clients Carousel', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-client-slides',
					'type'      => 'slides',
					'title'     => __('Client Slides', 'medicallinktheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'medicallinktheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'medicallinktheme'),
					'placeholder'   => array(
						'title'         => __('Client name', 'medicallinktheme'),
						'description'   => __('Featured Text', 'medicallinktheme'),
						'url'           => __('Client URL', 'medicallinktheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			//PANELS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Panels Carousel', 'medicallinktheme'),
			  'heading'   => __('Panels Carousel', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-panel-slides',
					'type'      => 'slides',
					'title'     => __('Panel Slides', 'medicallinktheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'medicallinktheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'medicallinktheme'),
					'placeholder'   => array(
						'title'         => __('Title', 'medicallinktheme'),
						'description'   => __('Description', 'medicallinktheme'),
						'url'           => __('Icon - URL', 'medicallinktheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			
			//PRETTYPHOTO OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('PrettyPhoto Options', 'medicallinktheme'),
			  'heading'   => __('PrettyPhoto Options', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'ppAutoPlay',
					'type'      => 'select',
					'title'     => __('Enable Slideshow?', 'medicallinktheme'),
					'subtitle'  => __('Allow the slider to animate to next slide automatically.', 'medicallinktheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'medicallinktheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False'
					),
					'default'   => 'true'
				),//end of field
				
				array(
					'id'        => 'ppShowTitle',
					'type'      => 'select',
					'title'     => __('Show Caption?', 'medicallinktheme'),
					'subtitle'  => __('Display the caption of each slide in the PrettyPhoto carousel.', 'medicallinktheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'medicallinktheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False'
					),
					'default'   => 'true'
				),//end of field
				
				array(
					'id'            => 'ppSlideShowSpeed',
					'type'          => 'slider',
					'title'         => __('Slideshow Speed', 'medicallinktheme'),
					//'desc'      => __('This example displays the value in a text box', 'medicallinktheme'),
					'subtitle'          => __('Set the speed of the slideshow cycling. A value of around 5000 for this field is recommended.', 'medicallinktheme'),
					'default'       => 5000,
					'min'           => 2000,
					'step'          => 5,
					'max'           => 10000,
					'display_value' => 'text'
				),//end of field
					
				array(
					'id'        => 'ppAnimationSpeed',
					'type'      => 'select',
					'title'     => __('Animation Speed', 'medicallinktheme'),
					'subtitle'  => __('Select your desired speed of the slide animation.', 'medicallinktheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'medicallinktheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'fast' => 'Fast', 
						'slow' => 'Slow',
						'normal' => 'Normal',
					),
					'default'   => 'normal'
				),//end of field
				  
				array(
					'id'        => 'ppColorTheme',
					'type'      => 'select',
					'title'     => __('Color Theme', 'medicallinktheme'),
					'subtitle'  => __('Set the color theme for the PrettyPhoto carousel.', 'medicallinktheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'medicallinktheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'light_rounded' => 'Light Rounded', 
						'dark_rounded' => 'Dark Rounded',
						'light_square' => 'Light Square',
						'dark_square' => 'Dark Square',
					),
					'default'   => 'light_rounded'
				),//end of field
				
				array(
					'id'        => 'ppSocialTools',
					'type'      => 'select',
					'title'     => __('Display Social Buttons?', 'viennatheme'),
					'subtitle'  => __('Enable or disable the social icons in the prettyPhoto carousel.', 'viennatheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'viennatheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False',
					),
					'default'   => 'true'
				),//end of field
				
													
			  )//end of fields
			  			
			);//end of section
			
			//Micro Slider
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Micro Slider', 'medicallinktheme'),
			  'heading'   => __('Micro Slider', 'medicallinktheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'medicallinktheme'),
			
			  'fields'    => array(
			  			  
			  	//Caption Font
			  	array(
					'id'            => 'opt-pulse-slider-caption-font',
					'type'          => 'typography',
					'title'         => __('Slide Title Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
					'subsets'       => true, // Only appears if google is true and subsets not set to false
					'font-size'     => true,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro slider caption text.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => 'bold',
						'font-family'   => 'Raleway',
						'font-size'     => '36px',
					),
				),
				
				array(
					'id'            => 'opt-pulse-slider-sub-title-font',
					'type'          => 'typography',
					'title'         => __('Slide Sub-Title Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
					'subsets'       => true, // Only appears if google is true and subsets not set to false
					'font-size'     => true,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption-decription'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption-decription'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro slider caption text.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => 'normal',
						'font-family'   => 'Lato',
						'font-size'     => '32px',
					),
				),
				
				//Description Font
			  	array(
					'id'            => 'opt-pulse-slider-desc-font',
					'type'          => 'typography',
					'title'         => __('Slide Description Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption-excerpt'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption-excerpt'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro slider description text.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#000000',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'font-size'     => '18px',
					),
				),
				
				array(
					'id'            => 'opt-pulse-slider-btn-font',
					'type'          => 'typography',
					'title'         => __('Slide Button Font', 'medicallinktheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-slide-btn'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-slide-btn'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro slider description text.', 'medicallinktheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'font-size'     => '14px',
					),
				),

				
				//Pulse Slides
				array(
					'id'        => 'opt-pulse-slides',
					'type'      => 'slides',
					'title'     => __('Slides', 'medicallinktheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'medicallinktheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'medicallinktheme'),
					'placeholder'   => array(
						'title'         => __('Slide Title - Sub-Title', 'medicallinktheme'),
						'description'   => __('Slide Message', 'medicallinktheme'),
						'url'           => __('Button text - URL (ex. View More - http://www.yourdomain.com/more)', 'medicallinktheme'), //"Button name - URL" format
					),
				),
				
											
			  )//end of fields
			
			);//end of section
			

			// IMPORT / EXPORT SETTINGS
            $this->sections[] = array(
                'title'     => __('Import / Export', 'medicallinktheme'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'medicallinktheme'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
            
			// TAB DIVIDER
            $this->sections[] = array(
                'type' => 'divide',
            );

			// THEME INFORMATION
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'medicallinktheme'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'medicallinktheme'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'medicallinktheme'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
			
        }

        /*public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'medicallinktheme'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'medicallinktheme')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'medicallinktheme'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'medicallinktheme')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'medicallinktheme');
        }*/

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'medicallink_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Medical Options', 'medicallinktheme'),
                'page_title'        => __('Medical Options', 'medicallinktheme'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDBQJU8Cqmk_fxV1jvZeOdA3IpFL0Sq0js', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.


                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'medicallinktheme'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'medicallinktheme');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'medicallinktheme');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
