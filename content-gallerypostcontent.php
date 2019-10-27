<?php
/**
 * The default template for displaying a staff post item.
 */
?>

<?php 

	global $medicallink_options;
	$showCaption = $medicallink_options['ppShowTitle'];
            
	$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
	$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);
	$pm_gallery_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_video_meta', true);
	$pm_gallery_display_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_display_video_meta', true);
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	
?>
                	

<div class="pm-gallery-post-item-container single-post">

	<img src="<?php echo esc_url(esc_html($pm_gallery_image_meta)); ?>" alt="<?php get_the_title(); ?>" />

    
    <a class="pm-gallery-item-expander fa fa-plus" href="#"></a>
    
    <?php if($pm_gallery_display_video_meta ==='yes' ) { ?>
        <!-- Display video -->
        <a href="<?php echo esc_html($pm_gallery_video_meta); ?>" data-rel="prettyPhoto[video]" class="pm-gallery-item-expander single-post fa fa-video-camera lightbox" <?php echo $showCaption === 'true' ? 'title="'. esc_attr_e(esc_attr($pm_gallery_item_caption_meta), 'medicallinktheme') .'"' : '' ?>></a>
    <?php } else { ?>
        <!-- Display image -->
        <a href="<?php echo esc_html($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[gallery]" class="pm-gallery-item-expander single-post fa fa-camera lightbox" <?php echo $showCaption === 'true' ? 'title="'. esc_attr_e(esc_attr($pm_gallery_item_caption_meta), 'medicallinktheme') .'"' : '' ?>></a>
    <?php } ?>
     
</div>

<div class="pm-gallery-item-title">
    <p><?php the_title(); ?></p>
</div>

<br />

<?php the_content(); ?>


<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','pageoptions'); ?>
<?php endif; ?>