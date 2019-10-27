<?php /* Template Name: Services Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_services")) : ?>

    <?php if($content = $post->post_content) { ?>

    <div class="container pm-containerPadding-top-80">
        <div class="row">
            <div class="col-lg-12">
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    
                    <?php the_content(); ?>
                
                <?php endwhile; else: ?>
                    
                <?php endif; ?> 
            
            </div>
        </div>
    </div>

    <?php } ?>

    <?php

    $service_posts_per_page = get_theme_mod('service_posts_per_page', '3');

    //global $paged;	
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $arguments = array(
        'post_type' => 'post_services',
        'post_status' => 'publish',
        'paged' => $paged,
        'order' => 'DESC',
        'posts_per_page' => $service_posts_per_page,
        //'posts_per_page' => -1,
        //'tag' => get_query_var('tag')
    );

    $blog_query = new WP_Query($arguments);

    pm_ln_set_query($blog_query);


    ?>

    <!-- PANEL 2 -->
    <?php if($content = $post->post_content) { ?>
    <div class="container pm-containerPadding-top-20 pm-containerPadding-bottom-90">
    <?php } else { ?>
    <div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-90">
    <?php } ?>


    <div class="row">
        
        <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
            
            <?php get_template_part( 'content', 'servicepost' ); ?>
        
        <?php endwhile; else: ?>
            <p><?php esc_attr_e('No services were found.', 'medicallinktheme'); ?></p>
        <?php endif; ?>
        
        <?php get_template_part( 'content', 'pagination' ); ?>
                    
        <?php pm_ln_restore_query(); ?> 
        

    </div>

</div>

<?php endif; ?>


<?php get_footer(); ?>