<?php get_header(); ?>


<div class="container pm-containerPadding-top-90 pm-containerPadding-bottom-90">
      <div class="row">
      
      	 <div class="col-lg-12 col-md-12 col-sm-12">
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                <?php get_template_part( 'content', 'staffpostcontent' ); ?>
            <?php endwhile; else: ?>
                 <p><?php esc_attr_e('No content was found.', 'medicallinktheme'); ?></p>
            <?php endif; ?> 
         </div>
      
      </div>
</div>


<?php get_footer(); ?>