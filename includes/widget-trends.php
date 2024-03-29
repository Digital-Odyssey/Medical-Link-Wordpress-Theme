<?php

/*
Plugin Name: Recent Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your most recent posts
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_trend_posts_widget');

//register our widget
function pm_trend_posts_widget() {
	register_widget('pm_trendposts_widget');
}

//pm_trendposts_widget class
class pm_trendposts_widget extends WP_Widget {
	
	//process the new widget
	function __construct() {
	
		$widget_ops = array(
			'classname' => 'pm_trendposts_widget',
			'description' => esc_attr__('Display a list of news posts with the most views.','medicallinktheme')
		);
		
		parent::__construct('pm_trendposts_widget', esc_attr__('[Micro Themes] - Trend Posts','medicallinktheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_attr__('Trending Now', 'medicallinktheme'), 
			'postFilter' => 'mostviews',
			'numOfPosts' => '5',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$postFilter = $instance['postFilter'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_attr_e('Title:', 'medicallinktheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'postFilter' )); ?>"><?php esc_attr_e('Filter by:', 'medicallinktheme') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'postFilter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'postFilter' )); ?>" class="widefat">
                <option <?php if ( 'mostviews' == $postFilter ) echo 'selected="selected"'; ?> value="mostviews"><?php esc_attr_e('Most Views', 'medicallinktheme') ?></option>
                <option <?php if ( 'mostlikes' == $postFilter ) echo 'selected="selected"'; ?> value="mostlikes"><?php esc_attr_e('Most Likes', 'medicallinktheme') ?></option>
            </select>
            </p>

            <p><?php esc_attr_e('Number of Posts to display:', 'medicallinktheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postFilter'] = $new_instance['postFilter'];
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$postFilter = $instance['postFilter'];
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//retrieve recent posts
		
		if($postFilter === 'mostviews'){
			
			//filter by most views
			$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => 'post_views',
					'orderby' => 'meta_value_num',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true 
			);
			
		} else {
		
			//filter by most likes
			$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => 'pm_total_likes',
					'orderby' => 'meta_value_num',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true 
			);
			
		}
						
		$t_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<div class="pm-sidebar-padding">';
		
			echo '<ul class="pm-trends-list">';
			
			//front-end widget code here
			foreach( $t_posts as $tpost ){
				
				$title = $tpost["post_title"];
				
				echo '<li><a href="'.get_permalink($tpost["ID"]).'">'.$title.'</a></li>';
	
				
			}//end of foreach
			
			echo '</ul>';
		
		echo '</div>';
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>