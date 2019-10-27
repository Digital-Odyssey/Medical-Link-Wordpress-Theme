<?php 

if( !function_exists('pm_ln_is_plugin_active') ){
	
	function pm_ln_is_plugin_active($plugin) {

		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	
		return is_plugin_active($plugin);
	
	}
	
}

if( !function_exists('pm_ln_has_shortcode') ){
	
	function pm_ln_has_shortcode($shortcode = '') {
     
		$post_to_check = get_post(get_the_ID());
		 
		// false because we have to search through the post content first
		$found = false;
		 
		// if no short code was provided, return false
		if (!$shortcode) {
			return $found;
		}
		// check the post content for the short code
		if($post_to_check) {
			if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
				// we have found the short code
				$found = true;
			}
		}
		
		 
		// return our final results
		return $found;
	}
	
}


if( !function_exists('pm_ln_validate_email') ){
	
	function pm_ln_validate_email($email){
			
		return filter_var($email, FILTER_VALIDATE_EMAIL);
		
	}//end of validate_email()
	
}



//Extract avatar URL
if( !function_exists('pm_ln_get_avatar_url') ){
	
	function pm_ln_get_avatar_url($get_avatar){
		preg_match("/src='(.*?)'/i", $get_avatar, $matches);
		return $matches[1];
	}
	
}



//WPML custom language selector

if( !function_exists('pm_ln_icl_post_languages') ){
	
	function pm_ln_icl_post_languages(){
	
	  if( function_exists('icl_get_languages') ){
		  
		  $languages = icl_get_languages('skip_missing=1');
	  
		  if(1 < count($languages)){
					  
				echo '<div class="pm-dropdown pm-language-selector-menu">';
					echo '<div class="pm-dropmenu">';
						echo '<p class="pm-menu-title">'.esc_attr__('Language','medicallinktheme').'</p>';
						echo '<i class="fa fa-angle-down"></i>';
					echo '</div>';
					echo '<div class="pm-dropmenu-active">';
						echo '<ul>';
						   foreach($languages as $l){
							if(!$l['active']) echo '<li><img src="'.$l['country_flag_url'].'" alt="'.$l['translated_name'].'" /><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
						   }
						echo '</ul>';
					echo '</div>';
				echo '</div>';
			 ;
			
			//echo join(', ', $langs);
			
		  }
		  
	  }//end of check function
	  
	}
	
}



//Custom WordPress functions
if( !function_exists('pm_ln_set_query') ){
	
	function pm_ln_set_query($custom_query=null) { 
		global $wp_query, $wp_query_old, $post, $orig_post;
		$wp_query_old = $wp_query;
		$wp_query = $custom_query;
		$orig_post = $post;
	}
	
}



if( !function_exists('pm_ln_restore_query') ){
	
	function pm_ln_restore_query() {  
		global $wp_query, $wp_query_old, $post, $orig_post;
		$wp_query = $wp_query_old;
		$post = $orig_post;
		setup_postdata($post);
	}
	
}


//Limit words in paragraphs
if( !function_exists('pm_ln_string_limit_words') ){
	
	function pm_ln_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  return implode(' ', $words);
	}
	
}


//Apply primary color to the first two words in a news post title
if( !function_exists('pm_ln_set_primary_words') ){
	
	function pm_ln_set_primary_words($title = ''){
	
		$ARR_title = explode(" ", $title);
	
		if(sizeof($ARR_title) > 2 ){
			$ARR_title[0] = "<span>".$ARR_title[0];
			$ARR_title[1] = $ARR_title[1]."</span>";
			return implode(" ", $ARR_title);
		} else {
			return $title;
		}
	  
	}
	
}


//Count all posts related to current tag
if( !function_exists('pm_ln_get_posts_count_by_tag') ){
	
	function pm_ln_get_posts_count_by_tag($tag_name){
		$tags = get_tags(array ('search' => $tag_name) );
		foreach ($tags as $tag) {
		  //if ($tag->name == $tag_name) {}
		  return $tag->count;
		}
		return 0;
	}
	
}


//Count all posts related to current category
if( !function_exists('pm_ln_get_posts_count_by_category') ){
	
	function pm_ln_get_posts_count_by_category($category_name){
		$categories = get_categories(array ('search' => $category_name) );
		foreach ($categories as $category) {
			//if ($category->name == $category_name) {}
			return $category->count;
		}
		return 0;
	}
	
}


//Convert HEX to RGB
if( !function_exists('pm_ln_hex2rgb') ){
	
	function pm_ln_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	
}


//YOUTUBE Thumbnail Extract
if( !function_exists('pm_ln_parse_yturl') ){
	
	function pm_ln_parse_yturl($url) {
		$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
		preg_match($pattern, $url, $matches);
		return (isset($matches[1])) ? $matches[1] : false;
	}
	
}


//Breadcrumb
if( !function_exists('pm_ln_breadcrumbs') ){
	
	function pm_ln_breadcrumbs() {
	
		global $post;
		
		echo '<ul class="pm-breadcrumbs">';	
		
		if (!is_home()) {
			echo '<li><a href="'.home_url().'"> '. esc_attr__('Home', 'medicallinktheme') .'</a> </li>';
			
			if (is_single() && get_post_type() == 'staff_member' ) { //Wordpress doesnt support custom post types for breadcrumbs
			
				echo '<li>';
				the_title();
				echo '</li>';
			
			} else if (is_single()) {
				
				echo '<li>';
				the_title();
				echo '</li>';
				
			} else if (is_404()) {
				
				echo '<li> '.esc_attr__('404 Error', 'medicallinktheme').'</li>';
			
			} else if (is_category()) {	
			
				echo '<li>';
				
				//the_category('</li><li class="separator"> / </li><li>', 'single');
				
				$cat = get_category( get_query_var( 'cat' ) ); 
				echo $cat->name;
				echo '</li>';
					
			} elseif (is_page()) {
				
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
					}
					echo $output;
					echo '<li title="'.$title.'"> '.$title.'</li>';
				} else {
					echo '<li> ';
					echo the_title();
					echo '</li>';
				}
			} 
			elseif (is_tag()) {
				echo '<li>'; 
				single_tag_title();
				echo '</li>';
			}
			elseif (is_day()) {
				echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';
			}
			elseif (is_month()) {
				echo"<li>Archive for "; the_time('F, Y'); echo'</li>';
			}
			elseif (is_year()) {
				echo"<li>Archive for "; the_time('Y'); echo'</li>';
			}
			elseif (is_author()) {
				echo"<li>Author Archive"; echo'</li>';
			}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {exit;
				echo "<li>Blog Archives"; echo'</li>';
			}
			elseif (is_search()) {
				echo"<li>Search Results"; echo'</li>';
			}
		}
		
		echo '</ul>';
		
	}
	
}


//COMMENTS CONTROL
if( !function_exists('pm_ln_mytheme_comment') ){
	
	function pm_ln_mytheme_comment($comment, $args, $depth) {
	
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class('pm-comment-box-container'); ?> id="li-comment-<?php comment_ID() ?>">
		
		<div class="pm-comment-box-container" id="comment-<?php comment_ID(); ?>">
		
			<div class="comment-author vcard pm-comment-box-avatar-container">
		
				<div class="pm-comment-avatar">
					<?php echo get_avatar($comment,$size='70'); ?>
				</div>
				
				<ul class="pm-comment-author-list">
					<li><p class="pm-comment-name"><?php comment_author(); ?></p></li>
					<li><p class="pm-comment-date">
					<?php printf(('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>"> <?php printf(esc_attr__('%1$s at %2$s', 'medicallinktheme'), get_comment_date(),get_comment_time()) ?></a><?php edit_comment_link(esc_attr__('(Edit)', 'medicallinktheme'),' ','') ?>
					</p></li>
				</ul>
					   
			<!-- Leave this space empty (no closing div tag here) -->
		
		</div>
		
		<?php if ($comment->comment_approved == '0') : ?>
			<em style="margin-top:20px; display:block;"><?php esc_attr_e('Your comment is awaiting moderation.', 'medicallinktheme') ?></em>
		<?php endif; ?>
		 
		 
		<div class="pm-comment"><?php comment_text() ?></div>
		
			<?php if($args['max_depth']!=$depth) { ?>
				<div class="pm-comment-reply-btn">
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			<?php } ?>
		
		</div>
		<?php
		
		//echo '<div class="pm-comment-reply-form">';
		
			//Required for Themeforest regulations.
			$comments_args = array(
			  'title_reply'       => esc_attr__( 'Leave a Reply', 'medicallinktheme' ),
			  'title_reply_to'    => esc_attr__( 'Leave a Reply to %s', 'medicallinktheme' ),
			  'cancel_reply_link' => esc_attr__( 'Cancel Reply', 'medicallinktheme' ),
			  'label_submit'      => esc_attr__( 'Post Comment', 'medicallinktheme' ),
			);
		
			//comment_form($comments_args);
		
		//echo '</div>';
			
	}//end of comments control

	
}

//Menu functions
if( !function_exists('pm_ln_main_menu') ){
	
	function pm_ln_main_menu() {
		echo '<ul class="sf-menu" id="pm-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}


if( !function_exists('pm_ln_micro_menu') ){
	
	function pm_ln_micro_menu() {
		echo '<ul class="pm-micro-navigation">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}

	
}


if( !function_exists('pm_ln_footer_menu_logo') ){
	
	function pm_ln_footer_menu_logo() {
		echo '<ul class="pm-footer-navigation logo-on" id="pm-footer-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}


if( !function_exists('pm_ln_footer_menu') ){
	
	function pm_ln_footer_menu() {
		echo '<ul class="pm-footer-navigation" id="pm-footer-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}


if( !function_exists('pm_ln_footer_menu_centered') ){
	
	function pm_ln_footer_menu_centered() {
		echo '<ul class="pm-footer-navigation centered" id="pm-footer-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
		
}


/* Quick login validation */
if( !function_exists('pm_ln_validate_quick_login') ){
	
	function pm_ln_validate_quick_login() {
	
		// Verify nonce
		if( isset( $_POST['pm_ln_quick_login_nonce'] ) ) {
		
		  if ( !wp_verify_nonce( $_POST['pm_ln_quick_login_nonce'], 'pm_ln_nonce_action' ) ) {
			  die( 'A system error has occurred, please try again later.' );
		  }	   
		  
		}
		
		//global $wp, $wp_rewrite, $wp_the_query, $wp_query;
		//require_once('/home/pulsarme/dev/wp-blog-header.php');
		
		 //Post values
		$username = $_POST['quickuser'];
		$password = $_POST['quickpass'];
		
		if( empty($username) || $password === 'Username' ){
			
			echo 'username_error';
			die();
			
		} elseif( empty($password) || $password === 'Password' ){
			
			echo 'password_error';
			die();
			
		} else {
			//all good, continue
		}
		
		//Verify credentials
		$user = get_user_by( 'login', $username );
		if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) ) {
		   
		   $creds = array();
		   $creds['user_login'] = $username;
		   $creds['user_password'] = $password;
		   $creds['remember'] = false;
		   
		   //Authenticate user
		   $auth = wp_signon($creds, false );
		   if( is_wp_error($auth) ) {      
				echo "login_failed";
				die();
		   } else {
				echo "login_success";
				die();
		   }
		   
		} else {
			
		   echo "credentials_failed";
		   exit;
		   
		}
		die();
		
	}
	
}



//Quick login form
if( !function_exists('pm_ln_quick_login_form') ){
	
	function pm_ln_quick_login_form() { ?>

        <div class="pm-ln-quick-login-form">
        
            <form class="form-horizontal registraion-form" role="form">
            
                <ul class="pm-ln-quick-login-list">
            
                    <li>
                        <input type="text" name="pm_quick_username" id="pm_quick_username" value="" placeholder="<?php esc_attr_e('Username','medicallinktheme'); ?>" maxlength="70" class="pm-ln-quick-login-textfield" />
                    </li>
                    <li>
                        <input type="password" name="pm_quick_password" id="pm_quick_password" value="" placeholder="<?php esc_attr_e('Password','medicallinktheme'); ?>" maxlength="70" class="pm-ln-quick-login-textfield" />
                    </li>
                    <li>
                        <input type="submit" value="<?php esc_attr_e('Sign in','medicallinktheme'); ?>" id="btn-quick-login" class="pm-base-btn pm-header-btn pm-register-btn">
                    </li>
                
                </ul>
                
                <?php 
                wp_nonce_field('pm_ln_nonce_action','pm_ln_quick_login_nonce'); 
                //wp_nonce_field( plugin_basename( __FILE__ ), 'pm_ln_new_user_nonce' );
                ?>
            
            </form>
            
        </div>
    
    <?php
    }
	
}


if( !function_exists('pm_ln_registration_form') ){
	
	function pm_ln_registration_form() { ?>

        <h6><?php esc_attr_e('Register Account','medicallinktheme'); ?></h6>
    
        <div class="vb-registration-form">
          <form class="form-horizontal registration-form" role="form">
        
            <div class="form-group">
              <label for="pm_name" class="sr-only"><?php esc_attr_e('Full Name','medicallinktheme'); ?></label>
              <input type="text" name="pm_name" id="pm_name" value="" placeholder="Full Name" maxlength="70" />
            </div>
        
            <div class="form-group">
              <label for="pm_email" class="sr-only"><?php esc_attr_e('Email Address','medicallinktheme'); ?></label>
              <input type="email" name="pm_email" id="pm_email" value="" placeholder="Email Address" maxlength="70" />
            </div>
        
            <div class="form-group">
              <label for="pm_username" class="sr-only"><?php esc_attr_e('Username','medicallinktheme'); ?></label>
              <input type="text" name="pm_username" id="pm_username" value="" placeholder="<?php esc_attr_e('Username','medicallinktheme'); ?>" maxlength="70" />
            </div>
            
            <div class="form-group">
              <label for="pm_pass" class="sr-only"><?php esc_attr_e('Password','medicallinktheme'); ?></label>
              <input type="password" name="pm_pass" id="pm_pass" value="" placeholder="Password" maxlength="70" />
              <p><?php esc_attr_e('Minimum 8 characters','medicallinktheme'); ?></p>
            </div>
        
            <?php 
            wp_nonce_field('pm_ln_nonce_action','pm_ln_new_user_nonce'); 
            //wp_nonce_field( plugin_basename( __FILE__ ), 'pm_ln_new_user_nonce' );
            ?>
                
            <input type="submit" value="<?php esc_attr_e('Register Account','medicallinktheme'); ?>" class="button-primary btn-register-user clearfix" id="wp-submit" name="wp-submit">
          </form>
        
            <div class="indicator"></div>
            <div class="alert result-message"></div>
        </div>
    
    <?php
    }
	
}


/* New User registration - retrieves data from Ajax request */
if( !function_exists('pm_ln_register_new_user') ){
	
	function pm_ln_register_new_user() {
 
		// Verify nonce
		if( isset( $_POST['pm_ln_new_user_nonce'] ) ) {
		
		  if ( !wp_verify_nonce( $_POST['pm_ln_new_user_nonce'], 'pm_ln_nonce_action' ) ) {
			  die( 'A system error has occurred, please try again later.' );
		  }	   
		  
		}
	
		//Post values
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$email    = $_POST['mail'];
		$name     = $_POST['name'];
		$code     = $_POST['code'];
		
		// IMPORTANT: You should make server side validation here!
		
		if( empty($name) || $name === 'Full Name' ){
			
			echo 'name_error';
			exit;
			
		} elseif( validate_email($email) == false ){
			
			echo 'email_error';
			exit;
			
		} elseif( empty($username) || $username === 'Username' ){
			
			echo 'username_error';
			exit;
			
		} elseif( empty($password) || $password === 'Password' ){
			
			echo 'pass_error';
			exit;
			
		} else {

			
		}
		
		//Get the default role from Members area plug-in
		$default_role = get_option('pm_default_registration_role');
		
		if(!$default_role){
			$default_role = 'standard_member';	
		}
		
		$userdata = array(
			'user_login' => $username,
			'user_pass'  => $password,
			'user_email' => $email,
			'first_name' => $name,
			'role' => $default_role
		);
	
		$user_id = wp_insert_user( $userdata ) ;
		
		//$u = new WP_User( $user_id );
		//add_role( $role, $display_name, $capabilities ); // I assume $role, $display_name, $caps are already set before
		//$u->set_role( $role );
	
		//On success
		if( !is_wp_error($user_id) ) {
			echo 'success';
			exit;
		} else {
			//echo $user_id->get_error_message();
			echo 'form_error';
			exit;
		} 
	  die();
		
	}
	
}


/* Load More AJAX Call */
if( !function_exists('pm_ln_load_more') ){
	
	function pm_ln_load_more(){
	
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
		
		$section = '';
			
			
		$args = '';
		if(isset($_POST['section']) && $_POST['section']){
			$section = $_POST['section'];
			$args = 'post_type=post_'.$_POST['section'].'&'; //match the post type name
		}
		
		if($section == 'galleries'){
			
			$gallery_posts_per_load = get_theme_mod('gallery_posts_per_load', '3');
			$galleryPostOrder = get_theme_mod('galleryPostOrder', 'DESC');
			
			$args .= 'post_status=publish&order='.$galleryPostOrder.'&posts_per_page='.$gallery_posts_per_load.'&paged='. $_POST['page'];
			
		} elseif($section == 'staff'){
			
			$staff_posts_per_load = get_theme_mod('staff_posts_per_load', '3');
			$staffPostOrder = get_theme_mod('staffPostOrder', 'DESC');
					
			$args .= 'post_status=publish&order='.$staffPostOrder.'&posts_per_page='.$staff_posts_per_load.'&paged='. $_POST['page'];
	
			
		} else {
			$args .= 'post_status=publish&posts_per_page=4&paged='. $_POST['page'];
		}
			
		ob_start();
		$query = new WP_Query($args);
		while( $query->have_posts() ){ $query->the_post();
			
			if($section == 'galleries'){//match the post type name
				get_template_part( 'content', 'gallerypost' );
			} else {
				get_template_part( 'content', $section.'post' );	
			}	
			
		}
		
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();
		
		echo json_encode(
			array(
				'pages' => $query->max_num_pages,
				'content' => $content
			)
		);
		
		exit;
	
	}
	
}



if( !function_exists('pm_ln_load_more_posts') ){
	
	function pm_ln_load_more_posts(){
	
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
	
		$posts_per_load = get_theme_mod('posts_per_load', '3');
		
		$args = '';
	
		$args .= 'post_status=publish&posts_per_page='.$posts_per_load.'&paged='. $_POST['page'];
			
		ob_start();
		$query = new WP_Query($args);
		while( $query->have_posts() ){ $query->the_post();
					
			get_template_part( 'content', 'post' );	
			
		}
		
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();
		
		echo json_encode(
			array(
				'pages' => $query->max_num_pages,
				'content' => $content
			)
		);
		
		exit;
	
	}
	
}


if( !function_exists('pm_ln_retrieve_likes') ){
	
	function pm_ln_retrieve_likes() {
		//verify nonce (set in functions.php - line 636)
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
		
		$postID = $_POST['postID'];
		
		$currentLikes = get_post_meta($postID, 'pm_total_likes', true);
		
		echo json_encode(
			array(
				'currentLikes' => $currentLikes,
			)
		);
		
		exit;
		
	}
	
}


if( !function_exists('pm_ln_like_feature') ){
	
	function pm_ln_like_feature() {
	
		//verify nonce (set in functions.php - line 636)
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
		
		$postID = $_POST['postID'];
		$likes = (int) $_POST['likes'];
		
		//$newLikes = $likes + 1;
		
		update_post_meta($postID, 'pm_total_likes', $likes);
		
		exit;
		
	}
	
}



//FUNCTIONS
if( !function_exists('validate_email') ){
	
	function validate_email($value){
			
		if( !empty($value) ) {
			if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $value)) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
		
	}//end of validate_email()
	
}


if( !function_exists('pm_ln_search_knowledge_base') ){
	
	function pm_ln_search_knowledge_base() {

		global $wpdb;
		$search_val = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : "";
		
		//$sql = "SELECT post_title, guid FROM ".$wpdb->prefix."posts WHERE post_content LIKE '%$search_val%' AND post_status = 'publish' AND post_type = 'post_knowledgebase'";
		
		//Test this for next update
		$sql = "SELECT post_title, guid FROM ".$wpdb->prefix."posts WHERE post_title LIKE '%$search_val%' OR post_content LIKE '%$search_val%' AND post_status = 'publish' AND post_type = 'post_knowledgebase'";
		
		$userresults = $wpdb->get_results($sql);
		$result = array();
		foreach ($userresults as $val) {
			array_push($result, array("title" => $val->post_title, "guid" => $val->guid));
		}
		echo json_encode($result);
		exit;
		
	}
	
}


if( !function_exists('pm_ln_send_contact_form') ){
	
	function pm_ln_send_contact_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_contact_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_contact_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $first_name = sanitize_text_field($_POST['first_name']);
		 $last_name = sanitize_text_field($_POST['last_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $phone = sanitize_text_field($_POST['phone']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 $consent = sanitize_text_field($_POST['consent']);
		 
		
		 if ( empty($first_name) ){
			
			echo 'first_name_error';
			die();
			
		} elseif( empty($last_name) ){
			
			echo 'last_name_error';
			die();
	
			
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} 		
		
		if($consent === 'unchecked') {
			echo 'consent_error';
			die();
		}
		
		//All good, send email
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'medicallinktheme').'@'. $_SERVER['SERVER_NAME'] .' <donotreply@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$multiple_recipients = array(
			$recipient
		);
		
		$subj = esc_html__('Contact Form Inquiry', 'medicallinktheme');
		
		$body = ' 
		
		  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'medicallinktheme') .' **** 
		  
		  '. esc_html__('First Name', 'medicallinktheme') .': '.$first_name.'
		  '. esc_html__('Last Name', 'medicallinktheme') .': '.$last_name.'
		  '. esc_html__('Email Address', 'medicallinktheme') .': '.$email_address.'
		  '. esc_html__('Phone Number', 'medicallinktheme') .': '.$phone.'
		  '. esc_html__('Message', 'medicallinktheme') .': '.$message.'
		  
		';
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}


if( !function_exists('pm_ln_send_quick_contact_form') ){
	
	function pm_ln_send_quick_contact_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_quick_contact_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_quick_contact_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $full_name = sanitize_text_field($_POST['full_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 $consent = sanitize_text_field($_POST['consent']);
		 
		
		 if ( empty($full_name) ){
			
			echo 'full_name_error';
			die();
	
			
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} 
		
		if($consent === 'unchecked') {
			echo 'consent_error';
			die();
		 }
		
		//All good, send email
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'medicallinktheme').'@'. $_SERVER['SERVER_NAME'] .' <donotreply@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$multiple_recipients = array(
			$recipient
		);
		
		$subj = esc_html__('Quick Contact Form Inquiry', 'medicallinktheme');
		
		$body = ' 
		
		  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'medicallinktheme') .' **** 
		  
		  '. esc_html__('Full Name', 'medicallinktheme') .': '.$full_name.'
		  '. esc_html__('Email Address', 'medicallinktheme') .': '.$email_address.'
		  '. esc_html__('Message', 'medicallinktheme') .': '.$message.'
		  
		';
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}



if( !function_exists('pm_ln_send_appointment_form') ){
	
	function pm_ln_send_appointment_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_appointment_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_appointment_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $full_name = sanitize_text_field($_POST['full_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $phone = sanitize_text_field($_POST['phone']);
		 $date = sanitize_text_field($_POST['date']);
		 $time = sanitize_text_field($_POST['time']);
		 $country = sanitize_text_field($_POST['country']);
		 $location = sanitize_text_field($_POST['location']);
		 $locationActive = sanitize_text_field($_POST['locationActive']);		 
		 $recipient = sanitize_text_field($_POST['recipient']);
		 $consent = sanitize_text_field($_POST['consent']);
		 
		
		 if ( empty($full_name) ){
			
			echo 'name_error';
			die();
	
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($phone) ){
			
			echo 'phone_error';
			die();
			
		} elseif( empty($date) ){
			
			echo 'date_error';
			die();
			
		} elseif( empty($time) ){
			
			echo 'time_error';
			die();
			
		} elseif( $country === 'default' && $locationActive === 'yes' ){
			
			echo 'country_error';
			die(); 
			
		} elseif( $location === 'default' && $locationActive === 'yes' ){
			
			echo 'location_error';
			die(); 
			
		}
		
		if($consent === 'unchecked') {
			echo 'consent_error';
			die();
		}
		
					
		//All good, send email
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.esc_attr__('donotreply', 'medicallinktheme').'@'. $_SERVER['SERVER_NAME'] .' <donotreply@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		
		$multiple_recipients = array(
			$recipient
		);
		
		$subj = esc_html__('Appointment Form Inquiry', 'medicallinktheme');		
		
		if( $locationActive === 'yes' ) {
			
			//Locations added
			$body = ' 
		
			  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'medicallinktheme') .' **** 
			  
			  '. esc_html__('Name', 'medicallinktheme') .': '.$full_name.'
			  '. esc_html__('Email Address', 'medicallinktheme') .': '.$email_address.'
			  '. esc_html__('Phone Number', 'medicallinktheme') .': '.$phone.'
			  '. esc_html__('Date of Appointment', 'medicallinktheme') .': '.$date.'
			  '. esc_html__('Time of Appointment', 'medicallinktheme') .': '.$time.'
			  '. esc_html__('Country', 'medicallinktheme') .': '.$country.'
			  '. esc_html__('Location', 'medicallinktheme') .': '.$location.'
			  
			';
						
		} else {
			
			//No locations
			$body = ' 
		
			  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'medicallinktheme') .' **** 
			  
			  '. esc_html__('Name', 'medicallinktheme') .': '.$full_name.'
			  '. esc_html__('Email Address', 'medicallinktheme') .': '.$email_address.'
			  '. esc_html__('Phone Number', 'medicallinktheme') .': '.$phone.'
			  '. esc_html__('Date of Appointment', 'medicallinktheme') .': '.$date.'
			  '. esc_html__('Time of Appointment', 'medicallinktheme') .': '.$time.'
			  
			';
				
		}
		
		
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}


if( !function_exists('pm_ln_load_locations') ){
	
	function pm_ln_load_locations() {
			
		 // Verify nonce
		 if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	
		 $country = sanitize_text_field($_POST['country']);
		 //$country = utf8_decode($get_country);//required for translations
		 
		 //Fetch locations by country
		 $args = array(
			'post_type' => 'post_locations',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					//'taxonomy' => $tax,
					//'field'    => 'term_id',
					//'terms'    => array($term['term_id']),
					'taxonomy' => 'locations_countries',
					'field' => 'name',
					'terms' => $country,
				 ),
			 ),
		 );
		 
		 
		 ob_start();
		 $locations_query = new WP_Query($args);
		 
		 while( $locations_query->have_posts() ){ $locations_query->the_post();
		 	get_template_part( 'content', 'location_list_item' );	
		 }
		 
		 wp_reset_postdata();
		 $content = ob_get_contents();
		 ob_end_clean();
		
		 echo $content;
		 
		 exit;
		
		 /*echo json_encode(
			array(
				'content' => $content
			)
		 );
		
		 exit;*/
			
	}
	
}



/*if( !function_exists('pm_ln_add_product_to_cart') ){
	
	function pm_ln_add_product_to_cart() {
		
		ob_start();

        $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
        $quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
        $product_status    = get_post_status( $product_id );

        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) && 'publish' === $product_status ) {

            do_action( 'woocommerce_ajax_added_to_cart', $product_id );

            if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
                wc_add_to_cart_message( $product_id );
            }

            // Return fragments
           // self::get_refreshed_fragments();
			
			echo 'success';
			die();

        } else {

           echo 'error';
		   die();

        }

        die();
		
	}
	
}*/



?>