<?php get_header(); ?>


<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'content', 'singlepost' ); ?>
	
<?php endwhile; else : ?>

	 <p><?php esc_attr_e('No post was found.', 'medicallinktheme'); ?></p>
	 
<?php endif; ?> 


<?php get_footer(); ?>