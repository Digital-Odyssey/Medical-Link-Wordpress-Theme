<?php get_header(); ?>

<?php 
$getUniversalLayout = get_theme_mod('universalLayout');
$universalLayout = $getUniversalLayout !== '' ? $getUniversalLayout : 'no-sidebar';
?>

<div class="container pm-containerPadding80">
    <div class="row">

		<?php if($universalLayout === 'no-sidebar') { ?>
        
            	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    
                <?php endwhile; else: ?>
                    <p><?php esc_attr_e('No posts were found.', 'medicallinktheme'); ?></p>
                <?php endif; ?>
                
                <?php get_template_part( 'content', 'pagination' ); ?>            
        
        <?php } else if($universalLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
                
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    
                <?php endwhile; else: ?>
                    <p><?php esc_attr_e('No posts were found.', 'medicallinktheme'); ?></p>
                <?php endif; ?>
                
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
             <!-- Right Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Right Sidebar -->
        
        <?php } else if($universalLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    
                <?php endwhile; else: ?>
                    <p><?php esc_attr_e('No posts were found.', 'medicallinktheme'); ?></p>
                <?php endif; ?>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                    
        <?php } else {//default full width layout ?>
                        
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    
                <?php endwhile; else: ?>
                    <p><?php esc_attr_e('No posts were found.', 'medicallinktheme'); ?></p>
                <?php endif; ?>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>