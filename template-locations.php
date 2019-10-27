<?php /* Template Name: Locations Template */ ?>
<?php get_header(); ?>

<?php if(post_type_exists("post_locations")) : ?>

<?php 

$location = '';
$location_details = '';

if( isset( $_GET['location'] ) ) {
	$location = strtolower(esc_attr($_GET['location']));
	$location_details = get_term_by( 'slug', $location, 'locations_countries' );
}

?>

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
	$terms = get_terms( 'locations_countries');
?>

<!-- PANEL 1 -->

<?php if( is_array($terms) && count($terms) > 0 ) : ?>

	<?php if($content = $post->post_content) { ?>
        <div class="container pm-containerPadding-top-20 pm-containerPadding-bottom-30">
    <?php } else { ?>
        <div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-30">
    <?php } ?>
    
        <div class="row">
        	
            <div class="col-lg-4 col-md-4 col-sm-4">
            
            	<?php if( $location !== '' && $location !== 'all' ) { ?>
                	<p class="pm-locations-filter-title"><?php esc_attr_e('Browsing', 'medicallinktheme'); ?>: <b><?php echo esc_attr($location_details->name); ?></b></p>
                <?php } else { ?>
                	<p class="pm-locations-filter-title"><?php esc_attr_e('Browsing', 'medicallinktheme'); ?>: <b><?php esc_attr_e('All locations', 'medicallinktheme'); ?></b></p>
                <?php } ?>
            	
            </div>
        
            <div class="col-lg-8 col-md-8 col-sm-8">
            
                <!-- Filter menu -->
                <select class="pm-countries-filter-system" id="pm_countries_filter_system">
                    <option value="default"><?php esc_attr_e('-- Browse by Country --', 'medicallinktheme'); ?></option>
                    <option value="all"><?php esc_attr_e('All Locations', 'medicallinktheme'); ?></option>
                    <?php
                        foreach ($terms as $term) {
                            echo '<option value="'.$term->slug.'">'.ucfirst($term->name).'</option>';	
                        }
                    ?>
                </select>
                <!-- Filter menu end -->
                
            </div><!-- /.col-lg-12 -->  
            
            <div class="col-lg-12">
            	<div class="pm-column-title-divider locations-template"></div>
            </div>
            
                             
        </div>
    </div>
    <!-- PANEL 1  end-->

<?php endif; ?>



<?php

	$location_posts_per_page = get_theme_mod('location_posts_per_page', '5');

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if( $location !== '' && $location !== 'all' ) {
		
		//Fetch locations by country
		$arguments = array(
			'post_type' => 'post_locations',
			'post_status' => 'publish',
			'paged' => $paged,
			'posts_per_page' => $location_posts_per_page,
			'tax_query' => array(
				array(
					//'taxonomy' => $tax,
					//'field'    => 'term_id',
					//'terms'    => array($term['term_id']),
					'taxonomy' => 'locations_countries',
					'field' => 'slug',
					'terms' => $location,
				),
			),
		);
		
	} else {
		
		//Fetch all locations
		$arguments = array(
			'post_type' => 'post_locations',
			'post_status' => 'publish',
			'paged' => $paged,
			'posts_per_page' => $location_posts_per_page,
			//'order' => $galleryPostOrder,
		);
			
	}

	$query = new WP_Query($arguments);
	
	pm_ln_set_query($query);
	
?>

<div class="container pm-containerPadding-bottom-80">

	<div class="row">
    
    	<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        
        	<?php get_template_part( 'content', 'location_archive_post' ); ?>
        
        <?php endwhile; else: ?>
        	<div class="col-lg-12">
            	<p><?php esc_attr_e('No locations were found.', 'medicallinktheme'); ?></p>
            </div>
        <?php endif; ?>
    
    	<?php get_template_part( 'content', 'pagination' ); ?>
                    
        <?php pm_ln_restore_query(); ?> 
    
    </div><!-- /.row -->  

</div><!-- /.container -->  

<?php endif; ?>




<?php get_footer(); ?>