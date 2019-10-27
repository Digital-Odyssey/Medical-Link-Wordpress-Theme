<?php get_header(); ?>
<div class="container pm-containerPadding100 pm-search-results">
    <div class="row">
    
    	<div class="col-lg-12 col-md-12 col-sm-12 pm-search-results">
        
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                         
                <?php get_template_part( 'content', 'post' ); ?>
            
            <?php endwhile; else: ?>
            
            	<p class="pm-404-error"><?php esc_attr_e('Your search entry for', 'medicallinktheme'); ?> "<?php echo get_search_query(); ?>" <?php esc_attr_e('yielded no results.', 'medicallinktheme'); ?> </p>

                <p><?php esc_attr_e('Try a new search query:', 'medicallinktheme'); ?></p>
                                
                <form action="<?php echo home_url( '/' ); ?>" method="get" id="search-form-page">
                    <input class="pm-form-textfield-with-icon" type="text" name="s" placeholder="<?php esc_attr_e('Type keywords...', 'medicallinktheme') ?>">

                    <!--<input name="pm-email-field" type="text" class="pm-form-textfield-with-icon" placeholder="email address">-->
                    <input name="" type="button" class="pm_search_page_submit" id="pm-search-submit-page" value="<?php esc_attr_e('Search', 'medicallinktheme') ?>">
                </form>
                 
            <?php endif; ?> 
            
            <?php get_template_part( 'content', 'pagination' ); ?>
        
        </div>
    </div>
</div>
<?php get_footer(); ?>