<?php

	//global $paged;	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$knowledge_posts_per_page = get_theme_mod('knowledge_posts_per_page', '5');
	
	$glossary_index = '';
	$glossary_search = '';
	$orderby = '';
	
	if( isset($_GET['glossary_index']) ){
		$glossary_index = (string) $_GET['glossary_index'];
	}
	
	if( isset($_GET['glossary_search']) ){
		$glossary_search = (string) $_GET['glossary_search'];
	}	
	
	if(isset($_GET['order'])){
		$orderby = $_GET['order'];
	} else {
		$orderby = 'ASC';
	}

	if( $glossary_index !== '' ){
		
		if($glossary_index === 'all') {
			
			//parse all knowledge posts by title
			$arguments = array(
				'post_type' => 'post_knowledgebase',
				'post_status' => 'publish',
				'paged' => $paged,
				'orderby' => 'title',
				'order' => $orderby,
				'posts_per_page' => $knowledge_posts_per_page,
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			//parse by letter
			$arguments = array(
				'post_type' => 'post_knowledgebase',
				'post_status' => 'publish',
				'paged' => $paged,
				'orderby' => 'title',
				'order' => $orderby,
				'posts_per_page' => $knowledge_posts_per_page,
				//'tag' => get_query_var('tag')
				'meta_query' => array(
					array(
						'key'     => 'glossary_index',
						'value'   => $glossary_index,
						'compare' => '='
					),
				)
			);
			
		}
		
		
	} elseif( $glossary_search !== '' ) {
		
						
		//perform search request
		$arguments = array(
			'post_type' => 'post_knowledgebase',
			'post_status' => 'publish',
			'paged' => $paged,
			'orderby' => 'title',
			'order' => $orderby,
			'posts_per_page' => $knowledge_posts_per_page,
			's' => $glossary_search,
			//'tag' => get_query_var('tag')
			/*'meta_query' => array(
				 array(
					'key' => 'knowledgebase',
					'value' => $glossary_search,
					'compare' => 'LIKE'
				),
				
			)*/
		);
		
	} else {
	
		//parse all knowledge posts by title
		$arguments = array(
			'post_type' => 'post_knowledgebase',
			'post_status' => 'publish',
			'paged' => $paged,
			'orderby' => 'title',
			'order' => $orderby,
			'posts_per_page' => $knowledge_posts_per_page,
			//'tag' => get_query_var('tag')
		);
		
	}//end if
	

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);
	
	//print_r($blog_query);

	
?>

<!-- PANEL 1 -->
<div class="col-lg-8 col-md-8 col-sm-6 pm-column-spacing" style="overflow:visible;">                       
    <div class="pm-glossary-search-box">
       <a href="#" class="fa fa-search pm-search-submit" id="pm-glossary-search-submit"></a>
        <form name="glossary-searchform" id="pm-glossary-searchform" method="get" action="<?php echo get_permalink(); ?>">
            <input type="text" id="pm-ln-glossary-search" name="glossary_search" placeholder="<?php esc_attr_e('Search Knowledge Base', 'medicallinktheme') ?>">
        </form>
    </div>
    <div id="pm-ln-glossary-search-results-container">
        <a href="#" class="fa fa-close" id="pm-ln-glossary-search-results-close"></a>
        <div id="pm-ln-glossary-search-results"></div>
    </div>
</div>

<div class="col-lg-4 col-md-4 col-sm-6 pm-column-spacing">
    
      <select name="pm-glossary-filter" class="pm-glossary-filter" id="pm-glossary-filter">
        <?php if(isset($_GET['order'])) { ?>
        
            <?php 
                $orderby = (string) $_GET['order']; 
            ?>
        
            <option value="asc" <?php selected( $orderby, 'asc' ); ?>><?php esc_attr_e('Ascending A-Z', 'medicallinktheme') ?></option>
            <option value="desc" <?php selected( $orderby, 'desc' ); ?>><?php esc_attr_e('Descending Z-A', 'medicallinktheme') ?></option>
        
        <?php } else { ?>
            
            <option value="asc"><?php esc_attr_e('Ascending A-Z', 'medicallinktheme') ?></option>
            <option value="desc"><?php esc_attr_e('Descending Z-A', 'medicallinktheme') ?></option>
        
        <?php } ?>
        
      </select>
      <p class="pm-glossary-sort-text"><?php esc_attr_e('Sort by', 'medicallinktheme') ?>:</p>
</div>

<div class="container" style="width:auto">
	<div class="row">
    
    	<div class="col-lg-12">
        
        	<?php  
			 	$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
			?>
        
        	<ul class="pm-ln-glossary-index" id="pm-ln-glossary-index">
            	
            	<?php if($glossary_index !== '') { ?>
                
                	<li><a href="<?php get_permalink(); ?>?glossary_index=all" class="pm-ln-glossary-index-letter <?php echo $glossary_index === 'all' ? 'current' : '' ?>"><?php esc_attr_e('All', 'medicallinktheme'); ?></a></li>
                
                <?php } else { ?>
                
                	<li><a href="<?php get_permalink(); ?>?glossary_index=all" class="pm-ln-glossary-index-letter current"><?php esc_attr_e('All', 'medicallinktheme'); ?></a></li>
                
                <?php } ?>
            
            	
            	<?php 
					
					foreach($letters as $letter){
						echo '<li><a href="'.get_permalink().'?glossary_index='.$letter.'" class="pm-ln-glossary-index-letter '. ($glossary_index === $letter ? 'current' : '') .'">'.strtoupper($letter).'</a></li>';
					}
				
				?>
            </ul>
        
        </div>
    
    </div>
</div>

<!-- PANEL 1 end -->

<!-- PANEL 2 -->

<div class="container pm-containerPadding-top-50 pm-containerPadding-bottom-90" style="width:auto">

    <div class="row">
    
    	<div class="col-lg-12">
        
			<?php
            
                if($glossary_search !== '') :
                
                    echo '<p>'.esc_attr__('Displaying search results for', 'medicallinktheme').' "'.$glossary_search.'"</p>';
                
                endif;
            
             ?>
        
            <ol class="pm-ln-glossary-index-list">
            
                <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                    <li><?php get_template_part( 'content', 'knowledgebasepost' ); ?></li>
                
                <?php endwhile; else: ?>
                     <li style="list-style-type:none !important;"><p><?php esc_attr_e('No articles were found.', 'medicallinktheme'); ?></p></li>
                <?php endif; ?>
            
            </ol>
            
            <?php get_template_part( 'content', 'kbpagination' ); ?>
                        
            <?php pm_ln_restore_query(); ?> 
        
        </div>
        

	</div>

</div>