<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 //$category = get_the_category();
	 $categories = wp_get_post_categories(get_the_id(), 'knowledgebasecats');
	 
	 $num_comments = get_comments_number();
	 $comments = '';
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $post_classes = array(
		'pm-column-spacing',
		'news-post',
	 );
	 
	 $postIconImage = get_theme_mod('postIconImage', '');
	 $postIcon = get_theme_mod('postIcon', 'fa fa-newspaper-o');
	 $displayPostIcon = get_theme_mod('displayPostIcon', 'on');
	 $displayPostDate = get_theme_mod('displayPostDate', 'on');
	              
?>

<!-- Blog post 1 -->
<article <?php post_class($post_classes); ?>>

    <p class="pm-standalone-news-post-category">
     <?php 
	 
	 	foreach ( $categories as $category ) {
			$cat = get_category( $category );
			echo '<a href="'.get_category_link( $cat->term_id ).'"><span>'.$cat->cat_name.'</span></a>';	
		}
	 
	?>
    </p>

	<?php if(has_post_thumbnail()) { ?>
    	<div class="pm-standalone-news-post">
        	<img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title(); ?>" />
        </div>
    <?php } else { ?>
    	<div class="pm-standalone-news-post no-img"></div>
    <?php } ?>
                
        <div class="pm-standalone-news-post-overlay">
        
        	<?php if($displayPostIcon === 'on') { ?>
            
            	<?php if(!empty($postIconImage)) { ?>
            
                    <div class="pm-standalone-news-post-icon">
                        <?php 
                            if(is_sticky()){
                                echo '<i class="fa fa-thumb-tack"></i>';	
                            } else {
                                echo '<img src="'. esc_html($postIconImage) .'" width="33" height="41" alt="icon">';	
                            }
                        ?>
                    </div> 	
                
                <?php } else { ?>
                
                    <div class="pm-standalone-news-post-icon">
                        <?php 
                            if(is_sticky()){
                                echo '<i class="fa fa-thumb-tack"></i>';	
                            } else {
                                echo '<i class="'. $postIcon .'"></i>';		
                            } 
                        ?>
                    </div>
                
                <?php } ?>
            
            <?php } else { ?>
            
            	    <div class="pm-standalone-news-post-icon inactive"></div>
            
            <?php } ?>
            
            
                        
            <h6 class="pm-standalone-news-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
            
            <?php if( $displayPostDate === 'on' ) : ?>
            	<p class="pm-standalone-news-post-date"><?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> <?php esc_attr_e('by', 'medicallinktheme'); ?> <?php the_author(); ?></p>
            <?php endif; ?>
            
            
            <?php 
			if ( comments_open() ) {
				if ( $num_comments == 0 ) {
					$comments = esc_attr__('No Comments', 'medicallinktheme');
				} elseif ( $num_comments > 1 ) {
					$comments = $num_comments . esc_attr__(' Comments', 'medicallinktheme');
				} else {
					$comments = esc_attr__('1 Comment', 'medicallinktheme');
				}
			} 
			echo '<p class="pm-standalone-news-post-comment-count">' . $comments . '</p>';
			?>
            
            
        </div><!-- overlay end -->
                            
    <div class="pm-standalone-news-post-excerpt">    	
    
        <p><?php $excerpt = get_the_excerpt(); echo pm_ln_string_limit_words($excerpt, 40); ?> <a href="<?php the_permalink(); ?>">[...]</a> </p>
        <a href="<?php the_permalink(); ?>" class="pm-rounded-btn no-border pm-center-align"><?php esc_attr_e('View post', 'medicallinktheme'); ?>  <i class="fa fa-plus"></i></a>
        
    </div>
    
</article>