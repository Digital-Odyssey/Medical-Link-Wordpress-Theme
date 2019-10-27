<?php 

/*
Plugin Name: Premium Gallery for Medical-Link Theme
Plugin URI: http://www.microthemes.ca
Description: Declares a plugin that will create a custom post type displaying gallery items.
Version: 1.2
Author: Micro Themes
Author URI:http://www.microthemes.ca
License: GPLv2
*/

add_action('init', 'pm_ln_create_gallery');
add_action('init', 'pm_ln_gallery_categories');
add_action('admin_init', 'pm_ln_gallery_admin');
add_action('save_post', 'pm_ln_add_gallery_fields', 10, 2);
add_action('admin_menu', 'pm_ln_add_gallery_settings' );// ADD SETTINGS PAGE

//Translation support
add_action('plugins_loaded', 'pm_ln_load_textdomain');

function pm_ln_load_textdomain() { 
	load_plugin_textdomain( 'medicallinkGallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
} 

function pm_ln_create_gallery() {
	
	$pm_gallery_slug = get_option('pm_gallery_slug');
	$slug = '';
	
	if( $pm_gallery_slug !== '' ) {
		$slug = $pm_gallery_slug;
	} else {
		$slug = 'gallery-post';
	}
	
	register_post_type('post_galleries',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Gallery', 'medicallinkGallery' ),
				'singular_name' => esc_attr__( 'Gallery', 'medicallinkGallery' ),
				'add_new' => esc_attr__( 'Add New Gallery item', 'medicallinkGallery' ),
				'add_new_item' => esc_attr__( 'Add New Gallery item', 'medicallinkGallery' ),
				'edit' => esc_attr__( 'Edit', 'medicallinkGallery' ),
				'edit_item' => esc_attr__( 'Edit Gallery item', 'medicallinkGallery' ),
				'new_item' => esc_attr__( 'New Gallery item', 'medicallinkGallery' ),
				'view' => esc_attr__( 'View', 'medicallinkGallery' ),
				'view_item' => esc_attr__( 'View Gallery item', 'medicallinkGallery' ),
				'search_items' => esc_attr__( 'Search Gallery items', 'medicallinkGallery' ),
				'not_found' => esc_attr__( 'No Gallery items found', 'medicallinkGallery' ),
				'not_found_in_trash' => esc_attr__( 'No Gallery items found in Trash', 'medicallinkGallery' ),
				'parent' => esc_attr__( 'Parent Staff', 'medicallinkGallery' )
			),
			'public' => true,
            'menu_position' => 5, //5 - below posts 10 - below Media 15 - below Links 
            'supports' => array('title', 'editor', 'author', 'excerpt'),
            //'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true,
			'description' => esc_attr__( 'Easily lets you add new gallery items.', 'medicallinkGallery' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			'rewrite' => array('slug' => $slug),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	
}

function pm_ln_gallery_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Categories', 'medicallinkGallery' ),
		'singular_name' => esc_attr__( 'Gallery Categories', 'medicallinkGallery' ),
		'search_items' =>  esc_attr__( 'Search Gallery Categories', 'medicallinkGallery' ),
		'popular_items' => esc_attr__( 'Popular Gallery Categories', 'medicallinkGallery' ),
		'all_items' => esc_attr__( 'All Gallery Categories', 'medicallinkGallery' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'medicallinkGallery' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'medicallinkGallery' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'medicallinkGallery' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'medicallinkGallery' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Categories with commas', 'medicallinkGallery' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Categories', 'medicallinkGallery' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Categories', 'medicallinkGallery' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerycats', 'post_galleries', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ), // changes name in permalink structure
    ));
	
}


//Add sub menus
function pm_ln_add_gallery_settings() {

	//create custom top-level menu
	//add_menu_page( 'Pulsar Framework Documentation', 'Theme Documentation', 'manage_options', __FILE__, 'pm_documentation_main_page',	plugins_url( '/images/wp-icon.png', __FILE__ ) );
	
	//create sub-menu items
	add_submenu_page( 'edit.php?post_type=post_galleries', esc_attr__('Gallery Settings', 'medicallinkGallery'),  esc_attr__('Gallery Settings', 'medicallinkGallery'), 'manage_options', 'gallery_settings',  'pm_ln_gallery_settings_page' );
	
	//create an options page under Settings tab
	//add_options_page('My API Plugin', 'My API Plugin', 'manage_options', 'pm_myplugin', 'pm_myplugin_option_page');	
}

//Settings page
function pm_ln_gallery_settings_page() {
		
	//Save data first
	if (isset($_POST['pm_gallery_settings_update'])) {
		
		update_option('pm_gallery_slug', (string)$_POST["pm_gallery_slug"]);
		
		echo '<div id="message" class="updated fade"><h4>'.esc_attr__('Your settings have been saved.', 'medicallinkGallery').'</h4></div>';
		
	}//end of save data
	
	$pm_gallery_slug = get_option('pm_gallery_slug');

	
	?>
	
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php esc_attr_e('Gallery Settings', 'medicallinkGallery') ?></h2>
		
		<h4><?php esc_attr_e('Configure the settings for the Gallery plug-in below:', 'medicallinkGallery') ?></h4>
		
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		
			<input type="hidden" name="pm_gallery_settings_update" id="pm_gallery_settings_update" value="true" />
								
			<label for="pm_gallery_slug"><?php esc_attr_e('Slug name', 'medicallinkGallery') ?></label>
			<input type="text" id="pm_gallery_slug" name="pm_gallery_slug" value="<?php echo $pm_gallery_slug; ?>">
			
            <p><?php esc_attr_e('<strong>NOTE:</strong> You will have to reset your permalinks after making changes to the slug name in order to avoid 404 error pages.', 'medicallinkGallery') ?></p>
            
			<br /><br />
            
			<div class="pm-payel-submit">
				<input type="submit" name="pm_settings_update" class="button button-primary button-large" value="<?php esc_attr_e('Update Settings', 'medicallinkGallery'); ?> &raquo;" />
			</div>
		
		</form>
		
	</div>
	
	<?php
	
}

function pm_ln_gallery_admin() {
	
    //Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_gallery_header_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Gallery image
	add_meta_box( 
		'pm_gallery_image_meta', //ID
		'Gallery Image',  //label
		'pm_gallery_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Video
	add_meta_box( 
		'pm_gallery_video_meta', //ID
		'Youtube Video',  //label
		'pm_gallery_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Display Video in carousel
	add_meta_box( 
		'pm_gallery_display_video_meta', //ID
		'Display Youtube Video?',  //label
		'pm_gallery_display_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);

	
	//Message
	add_meta_box( 
		'pm_gallery_item_caption_meta', //ID
		'Caption',  //label
		'pm_gallery_item_caption_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_gallery_share_feature_function' , //function
		'post_galleries', //Post type
		'side'
	);
	
}


function pm_gallery_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_image_meta = get_post_meta( $post->ID, 'pm_header_image_meta', true );
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px', 'medicallinkGallery') ?></p>
		<input type="text" value="<?php echo esc_html($pm_header_image_meta); ?>" name="pm_header_image_meta" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'medicallinkGallery'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-field-preview"></div>
        
        <?php if($pm_header_image_meta) : ?>
        	<input id="remove_page_header_button" type="button" value="<?php esc_attr_e('Remove Image', 'medicallinkGallery'); ?>" class="button-secondary" />
        <?php endif; ?>        
        
        
    
    <?php
	
}

function pm_gallery_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_image_meta = get_post_meta( $post->ID, 'pm_gallery_image_meta', true );
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1170x350px','medicallinkGallery'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_image_meta); ?>" name="pm_gallery_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field featured-img-uploader-field" />
		<input id="featured_upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'medicallinkGallery'); ?>" class="button-secondary" />
        <div class="pm-admin-gallery-image-preview"></div>
        
        <?php if($pm_gallery_image_meta) : ?>
        	<input id="remove_gallery_image_button" type="button" value="<?php esc_attr_e('Remove Image', 'medicallinkGallery'); ?>" class="button-secondary" />
        <?php endif; ?>
        
    
    <?php
	
}

function pm_gallery_item_caption_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_item_caption_meta = get_post_meta( $post->ID, 'pm_gallery_item_caption_meta', true );
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a caption for your gallery item (this will also display in the PrettyPhoto carousel unless disabled under Medical-Link OPTIONS -> PrettyPhoto options).','medicallinkGallery'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_gallery_item_caption_meta); ?>" name="pm_gallery_item_caption_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_video_meta = get_post_meta( $post->ID, 'pm_gallery_video_meta', true );
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a Youtube video URL (ex. http://www.youtube.com/watch?v=ai9qbTKxwkc)','medicallinkGallery'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_video_meta); ?>" name="pm_gallery_video_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_display_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_gallery_display_video_meta = get_post_meta( $post->ID, 'pm_gallery_display_video_meta', true );
	
	?>
        <p><?php esc_attr_e('Setting this to "YES" will override the gallery image in the PrettyPhoto carousel.', 'medicallinkGallery'); ?></p>
        <select id="pm_gallery_display_video_meta" name="pm_gallery_display_video_meta" class="pm-admin-select-list">  
        	<option value="no" <?php selected( $pm_gallery_display_video_meta, 'no' ); ?>><?php esc_attr_e('NO', 'medicallinkGallery') ?></option>
            <option value="yes" <?php selected( $pm_gallery_display_video_meta, 'yes' ); ?>><?php esc_attr_e('YES', 'medicallinkGallery') ?></option>
        </select>
    
    <?php
	
}

function pm_disable_gallery_share_feature_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_disable_share_feature = get_post_meta( $post->ID, 'pm_disable_share_feature', true );
	
	?>
        <select id="pm_disable_share_feature" name="pm_disable_share_feature" class="pm-admin-select-list">  
            <option value="no" <?php selected( $pm_disable_share_feature, 'no' ); ?>><?php esc_attr_e('No', 'medicallinkGallery') ?></option>
            <option value="yes" <?php selected( $pm_disable_share_feature, 'yes' ); ?>><?php esc_attr_e('Yes', 'medicallinkGallery') ?></option>
        </select>
            
    <?php
	
}


function pm_ln_add_gallery_fields( $post_id, $post_galleries ) { //@param: id @param: verify post type
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
	  
	//Security measure
	if( isset($_POST['post_meta_nonce'])) :
	
		// Check post type for movie reviews
		if ( $post_galleries->post_type == 'post_galleries' ) {
			
			// Store data in post meta table if present in post data			
			if(isset($_POST['pm_header_image_meta']) ){
				update_post_meta($post_id, "pm_header_image_meta", $_POST['pm_header_image_meta']);
			}			
			
			if(isset($_POST['pm_gallery_image_meta']) ){
				update_post_meta($post_id, "pm_gallery_image_meta", $_POST['pm_gallery_image_meta']);
			}
			
			if(isset($_POST['pm_gallery_item_caption_meta']) ){
				update_post_meta($post_id, "pm_gallery_item_caption_meta", $_POST['pm_gallery_item_caption_meta']);
			}
			
			if(isset($_POST['pm_gallery_video_meta']) ){
				update_post_meta($post_id, "pm_gallery_video_meta", $_POST['pm_gallery_video_meta']);
			}
			
			if(isset($_POST['pm_gallery_display_video_meta']) ){
				update_post_meta($post_id, "pm_gallery_display_video_meta", $_POST['pm_gallery_display_video_meta']);
			}
			
			if(isset($_POST['pm_disable_share_feature']) ){
				update_post_meta($post_id, "pm_disable_share_feature", $_POST['pm_disable_share_feature']);
			}	
			
				
		}
	
	endif;	
}

?>