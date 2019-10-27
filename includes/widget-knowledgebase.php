<?php 

add_action('widgets_init','knowledgebase_widget');

function knowledgebase_widget() {
	register_widget('knowledgebase_widget');
	
	}

class knowledgebase_widget extends WP_Widget {
	function __construct() {
			
		$widget_ops = array('classname' => 'Knowledge-base','description' => esc_attr__('Knowledge Base Center Widget','medicallinktheme'));

		parent::__construct('Knowledge-base',esc_attr__('[Micro Themes] - Knowledge Base Center','medicallinktheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		//$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-facebook' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$show_category_list = $instance['show_category_list'];
		$show_tag_list = $instance['show_tag_list'];
		$description = $instance['description'];
		$page = $instance['page'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
			
?>

		<div class="pm-sidebar-padding">
        
			<?php if($show_category_list) : ?>
            
                <?php 
                
                    $taxonomy = 'knowledgebasecats';
                    $tax_terms = get_terms($taxonomy);
                                    
                ?>
                
                <!-- Code start -->
                <form action="#" method="get">
                    <select name="pm-knowledge-centre-list" class="pm-knowledge-centre-list" id="pm-knowledge-centre-category-list">
                        <option selected><?php esc_attr_e('-- Select a Category --', 'medicallinktheme'); ?></option>
                        <?php 
                            foreach ($tax_terms as $tax_term) {
                                echo '<option value="'.esc_attr(get_term_link($tax_term, $taxonomy)).'">'. $tax_term->name .'</option>';
                            }
                        ?>
                    </select>
                </form>
            
            <?php endif; ?>
            
            <?php if($show_tag_list) : ?>
            
                <?php 
                
                    $taxonomy = 'knowledgebasetags';
                    $tax_terms = get_terms($taxonomy);
                                    
                ?>
                
                <!-- Code start -->
                <form action="#" method="get">
                    <select name="pm-knowledge-centre-list" class="pm-knowledge-centre-list" id="pm-knowledge-centre-tag-list">
                        <option selected><?php esc_attr_e('-- Select a Tag --', 'medicallinktheme'); ?></option>
                        <?php 
                            foreach ($tax_terms as $tax_term) {
                                echo '<option value="'.esc_attr(get_term_link($tax_term, $taxonomy)).'">'. $tax_term->name .'</option>';
                            }
                        ?>
                    </select>
                </form>
            
            <?php endif; ?>
            
            <p><?php echo esc_attr($description); ?></p>
            
            <p><?php esc_attr_e('Visit our', 'medicallinktheme'); ?> <a href="<?php echo esc_html($page); ?>" class="pm-secondary pm-secondary"><?php esc_attr_e('Knowledge centre', 'medicallinktheme'); ?></a></p>
        
        </div>
        <!-- Code end -->
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['show_category_list'] = strip_tags($new_instance['show_category_list']);
		$instance['show_tag_list'] = strip_tags($new_instance['show_tag_list']);
		$instance['description'] = strip_tags($new_instance['description']);
		$instance['page'] = $new_instance['page'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_attr__('Knowledge Center','medicallinktheme'),
			//'fa_icon' => '',
			'page' => '/medical-link/knowledge-base-center',
			'show_category_list' => 1,
			'show_tag_list' => 0,
			'description' => '',
			
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'medicallinktheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>  
            <input id="<?php echo esc_attr($this->get_field_id('show_category_list')); ?>" name="<?php echo esc_attr($this->get_field_name('show_category_list')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_category_list'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'show_category_list' )); ?>"><?php esc_attr_e('Display Category List?', 'medicallinktheme'); ?></label>  
        </p>  
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('show_tag_list')); ?>" name="<?php echo esc_attr($this->get_field_name('show_tag_list')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_tag_list'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'show_tag_list' )); ?>"><?php esc_attr_e('Display Tag List?', 'medicallinktheme'); ?></label>  
        </p> 

    	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_attr_e('Description:', 'medicallinktheme') ?></label>
		<textarea name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" cols="5" rows="5" class="widefat"><?php echo esc_attr($instance['description']); ?></textarea>
		</p>

    	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'page' )); ?>"><?php esc_attr_e('Knowledge Base URL:', 'medicallinktheme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'page' )); ?>" value="<?php echo esc_attr($instance['page']); ?>"  class="widefat" />
		</p>
        
   <?php 
}
	} //end class