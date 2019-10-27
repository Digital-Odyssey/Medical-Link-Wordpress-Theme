<?php get_header(); ?>

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_knowledge_base_post_layout_meta', true);
	$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
	
?>


<?php if($pageLayout === 'no-sidebar') : //Render col-lg-12 ?>

	<div class="container pm-containerPadding-top-90 pm-containerPadding-bottom-90">
          <div class="row">
          
             <div class="col-lg-12 col-md-12 col-sm-12">
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    <?php get_template_part( 'content', 'knowledgebasepostcontent' ); ?>
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No content was found.', 'medicallinktheme'); ?></p>
                <?php endif; ?> 
             </div>
          
          </div>
    </div>

<?php endif; ?>


<?php if($pageLayout === 'right-sidebar') : ?>

	<div class="container pm-containerPadding-top-90 pm-containerPadding-bottom-90">
          <div class="row">
          
             <div class="col-lg-8 col-md-8 col-sm-12 pm-knowledge-base-single-post-content">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    <?php get_template_part( 'content', 'knowledgebasepostcontent' ); ?>
                <?php endwhile; else: ?>
                    <p><?php echo esc_attr_e('No content was found.', 'medicallinktheme'); ?></p>
                <?php endif; ?>
                
            </div>
            <?php get_sidebar(); ?>
          
          </div>
    </div>

<?php endif; ?>


<?php if($pageLayout === 'left-sidebar') : ?>

	<div class="container pm-containerPadding-top-90 pm-containerPadding-bottom-90">
          <div class="row">
          
          	<?php get_sidebar(); ?>
          
             <div class="col-lg-8 col-md-8 col-sm-12 pm-knowledge-base-single-post-content">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    <?php get_template_part( 'content', 'knowledgebasepostcontent' ); ?>
                <?php endwhile; else: ?>
                    <p><?php echo esc_attr_e('No content was found.', 'medicallinktheme'); ?></p>
                <?php endif; ?>
                
            </div>
            
          
          </div>
    </div>

<?php endif; ?>




<?php get_footer(); ?>