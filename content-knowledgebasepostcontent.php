<?php
/**
 * The default template for displaying a staff post item.
 */
?>

<?php 
	
	global $medicallink_options;
	$returnURL = $medicallink_options['opt-knowledge-base-url'];
	
	$cats = wp_get_post_terms($post->ID,'knowledgebasecats'); 
	$tags = wp_get_post_terms($post->ID,'knowledgebasetags'); 
	
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	
?>









<div class="row">

	<div class="col-lg-12" style="overflow:visible;">       
        <div class="pm-glossary-search-box">
           <a href="#" class="fa fa-search pm-search-submit" id="pm-glossary-search-submit"></a>
            <form name="glossary-searchform" id="pm-glossary-searchform" method="get" action="<?php echo get_permalink(); ?>">
                <input type="text" id="pm-ln-glossary-search" name="glossary_search" placeholder="<?php esc_attr_e('Search Knowledge Base', 'medicallinktheme') ?>">
            </form>
        </div>
        <div id="pm-ln-glossary-search-results-container" style="width:97%;">
            <a href="#" class="fa fa-close" id="pm-ln-glossary-search-results-close"></a>
            <div id="pm-ln-glossary-search-results"></div>
        </div>
    </div>

</div>





<div class="pm-divider knowledgebase-post"></div>

<?php the_content(); ?>

<br />

<div class="pm-divider knowledgebase-post"></div>

<p><a href="<?php echo $returnURL; ?>">&larr; <?php esc_attr_e('Return To Knowledge Base','medicallinktheme'); ?></a></p>



<div class="pm-divider knowledgebase-post"></div>

<div style="overflow:hidden;">

    <div class="pm-single-knowledgebase-cats">
        
        <?php $catsLen = count($cats); ?>
            
        <?php if($catsLen > 0) { ?>
        
            <p class="cats"><?php esc_attr_e('Filed In:','medicallinktheme'); ?>
            
                <?php 
            
                    $catCounter = 0;
            
                    foreach($cats as $cat){ 
                    
                        $catCounter++;
                    
                        $term_link = get_term_link( $cat );
                        
                        if($catsLen > 1){
                            
                            if($catCounter >= $catsLen){
                                echo '<a href="' . $term_link . '">' . $cat->name . '</a>'; 
                            } else {
                                echo '<a href="' . $term_link . '">' . $cat->name . '</a>, '; 
                            }
                            
                            
                        } else {
                            echo '<a href="' . $term_link . '">' . $cat->name . '</a>';	
                        }
                        
                        
                    }
                
                ?>
                
            </p>
            
            
        <?php } ?>
        
    </div>
    
    
    <div class="pm-single-knowledgebase-tags">
        
        <?php $tagsLen = count($tags); ?>
            
        <?php if($tagsLen > 0) { ?>
        
            <p class="tags"><?php esc_attr_e('Tagged In:','medicallinktheme'); ?>
            
                <?php 
            
                    $tagCounter = 0;
            
                    foreach($tags as $tag){ 
                    
                        $tagCounter++;
                    
                        $term_link = get_term_link( $tag );
                        
                        if($tagsLen > 1){
                            
                            if($tagCounter >= $tagsLen){
                                echo '<a href="' . $term_link . '">' . $tag->name . '</a>'; 
                            } else {
                                echo '<a href="' . $term_link . '">' . $tag->name . '</a>, '; 
                            }
                            
                            
                        } else {
                            echo '<a href="' . $term_link . '">' . $tag->name . '</a>';	
                        }
                        
                        
                    }
                
                ?>
                
            </p>
            
            
        <?php } ?>
        
    </div>

</div>


<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','pageoptions'); ?>
<?php endif; ?>