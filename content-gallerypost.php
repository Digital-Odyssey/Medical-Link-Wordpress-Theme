<?php
/**
 * The default template for displaying a gallery post item.
 */
?>

<?php 

	global $medicallink_options;
	$showCaption = $medicallink_options['ppShowTitle'];
            
	$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
	$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);
	$pm_gallery_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_video_meta', true);
	$pm_gallery_display_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_display_video_meta', true);
	
	$galleryRandomHeight = get_theme_mod('galleryRandomHeight', 'true');
	
?>

<?php 
$terms = get_the_terms($post->ID, 'gallerycats' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>


<!-- Gallery post -->
<div class="isotope-item size<?php echo $galleryRandomHeight === 'true' ? rand(1,3) : 3; ?> col-lg-4 col-md-4 col-sm-12 col-xs-12 <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">

    <div class="pm-gallery-post-item-container" style="background-image:url(<?php echo esc_html($pm_gallery_image_meta); ?>);">
    
        <div class="pm-gallery-post-item-info-container">
        
            <div class="pm-gallery-item-excerpt">
            
            	<?php $excerpt = get_the_excerpt(); ?>
                <p><?php echo pm_ln_string_limit_words($excerpt, 25); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
                            
                <ul class="pm-gallery-item-btns">
                                    
                    <?php if($pm_gallery_display_video_meta ==='yes' ) { ?>
                        <!-- Display video -->
                        <li><a href="<?php echo esc_html($pm_gallery_video_meta); ?>" data-rel="prettyPhoto[video]" class="fa fa-video-camera lightbox" <?php echo $showCaption === 'true' ? 'title="'. esc_attr_e(esc_attr($pm_gallery_item_caption_meta), 'medicallinktheme') .'"' : '' ?>></a></li>
                    <?php } else { ?>
                        <!-- Display image -->
                        <li><a href="<?php echo esc_html($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[gallery]" class="fa fa-camera lightbox" <?php echo $showCaption === 'true' ? 'title="'. esc_attr_e(esc_attr($pm_gallery_item_caption_meta), 'medicallinktheme') .'"' : '' ?>></a></li>
                    <?php } ?>
                                                        
                    <li><a class="fa-bars" href="<?php the_permalink(); ?>"></a></li>
                </ul>
                
            </div>
        
        </div>
        
        <a class="pm-gallery-item-expander fa fa-plus" href="#"></a>
         
    </div>
    
    <div class="pm-gallery-item-title">
        <p><?php the_title(); ?></p>
    </div>
    
</div>
<!-- Gallery post -->