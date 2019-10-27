<?php

/*

Plugin Name: Quick Contact Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a quick contact form
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_contact_widget');

//register our widget
function pm_contact_widget() {
	register_widget('pm_ln_quickcontact_widget');
}

//pm_ln_quickcontact_widget class
class pm_ln_quickcontact_widget extends WP_Widget {
	
	//process the new widget
	function __construct() {
	
		$widget_ops = array(
			'classname' => 'pm_ln_quickcontact_widget',
			'description' => esc_html__('Insert a quick contact form','medicallinktheme')
		);
		
		parent::__construct('pm_ln_quickcontact_widget', esc_html__('[Micro Themes] - Quick Contact Form','medicallinktheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_attr__('Quick Contact', 'medicallinktheme'), 
			//'fa_icon' => 'fa fa-envelope',
			'desc' => '',
			'color' => 'Light',
			'response_color' => 'Light',
			'email' => '',
			'consent_checkbox' => 'off',
			'consent_message' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$desc = $instance['desc'];
		$color = $instance['color'];
		$response_color = $instance['response_color'];
		$email = $instance['email'];
		$consent_checkbox = $instance['consent_checkbox'];
		$consent_message = $instance['consent_message'];
		
		?>
        
        	<p><?php esc_attr_e('Title', 'medicallinktheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_attr_e('Description', 'medicallinktheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" type="text" value="<?php echo esc_attr($desc); ?>" /></p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'color' )); ?>"><?php esc_attr_e('Form Color:', 'medicallinktheme'); ?></label>
                <select id="<?php echo esc_attr($this->get_field_id( 'color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'color' )); ?>" class="widefat">
                    <option <?php if ( 'Light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Light', 'medicallinktheme') ?></option>
                    <option <?php if ( 'Dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Dark', 'medicallinktheme') ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'response_color' )); ?>"><?php esc_attr_e('Response Color:', 'medicallinktheme') ?></label>
                <select id="<?php echo esc_attr($this->get_field_id( 'response_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'response_color' )); ?>" class="widefat">
                    <option <?php if ( 'Light' == $instance['response_color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Light', 'medicallinktheme') ?></option>
                    <option <?php if ( 'Dark' == $instance['response_color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Dark', 'medicallinktheme') ?></option>
                </select>
            </p>
            
            <p><?php esc_attr_e('Email address', 'medicallinktheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'consent_checkbox' )); ?>"><?php esc_attr_e('Consent Checkbox:', 'medicallinktheme') ?></label>
                <select id="<?php echo esc_attr($this->get_field_id( 'consent_checkbox' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'consent_checkbox' )); ?>" class="widefat">
                    <option <?php if ( 'off' == $instance['consent_checkbox'] ) echo 'selected="selected"'; ?> value="off"><?php esc_attr_e('OFF', 'medicallinktheme') ?></option>
                    <option <?php if ( 'on' == $instance['consent_checkbox'] ) echo 'selected="selected"'; ?> value="on"><?php esc_attr_e('ON', 'medicallinktheme') ?></option>
                </select>
            </p>
            
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id( 'consent_message' )); ?>"><?php esc_attr_e('Consent Message:', 'medicallinktheme') ?></label>
                <br />
                <textarea name="<?php echo esc_attr($this->get_field_name('consent_message')); ?>" rows="6" cols="6" style="width:100%;"><?php echo esc_attr($consent_message); ?></textarea>
            </p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['response_color'] = strip_tags( $new_instance['response_color'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['consent_checkbox'] = strip_tags( $new_instance['consent_checkbox'] );
		$instance['consent_message'] = strip_tags( $new_instance['consent_message'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = empty( $instance['desc'] ) ? '&nbsp;' : $instance['desc'];
		$color = $instance['color'];
		$response_color = $instance['response_color'];
		$email = empty( $instance['email'] ) ? '&nbsp;' : $instance['email'];
		$consent_checkbox = empty( $instance['consent_checkbox'] ) ? false : $instance['consent_checkbox'];
		$consent_message = empty( $instance['consent_message'] ) ? '' : $instance['consent_message'];
		 
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		//form code here
		
		if($desc != '&nbsp;'){
			echo '<p>'.esc_attr($desc).'</p><br />';
			
		}
		
		echo '
		<div class="pm-widget-content-spacer">
			<form action="#" method="post" id="quick-contact-form" class="validate" target="_blank" novalidate>  
			
				<input name="pm_full_name" id="pm_full_name" type="text" class="pm_quick_contact_field '.esc_attr($color).'" placeholder="'.esc_attr__('full name','medicallinktheme').'">
				<input name="pm_email_address" id="pm_email_address" type="email" class="pm_quick_contact_field '.esc_attr($color).'" placeholder="'.esc_attr__('email address', 'medicallinktheme').'">
				<textarea name="pm_message" id="pm_message" cols="10" rows="5" class="pm_quick_contact_textarea '.esc_attr($color).'" placeholder="'.esc_attr__('message','medicallinktheme').'"></textarea>';
				
				?>
                
                <?php if($consent_checkbox === 'on') : ?>
                
                	<div class="form-group pm-center">
                    	<input type="checkbox" id="pm_quick_contact_consent_box" />
                        <span class="<?php echo esc_attr($color); ?>"><?php echo $consent_message; ?></span>
                    </div>
                
                <?php endif; ?>
				
				<input name="subscribe" type="submit" value="<?php esc_attr_e('Send','medicallinktheme'); ?>" class="pm_quick_contact_submit"> 
				<div id="pm_form_response" class="pm_form_response <?php echo esc_attr($response_color); ?>"></div>
				
			<?php echo '<input name="pm_email_address_contact" id="pm_email_address_contact" type="hidden" value="'.esc_attr($email).'">
				<input name="quick_contact_submitted" type="hidden" value="true">
			</form>
		</div>
		';
				
		echo $after_widget;
		
		// output template path to locate php file on server ?>
        <script> var templateDir = "<?php echo get_template_directory_uri(); ?>"; </script>
        
        <?php
		
	}//end of widget function
	
}//end of class

?>