<?php /* Template Name: Knowledge Base Glossary Template */ ?>
<?php get_header(); ?>

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';	
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





<?php if($pageLayout === 'no-sidebar') { //Render col-lg-12 ?>

	<div class="container pm-containerPadding80">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            
            	<div class="row">
                	<?php get_template_part('content', 'knowledgebasetemplate'); ?>
                </div>
            	
            </div>
        </div>
    </div>

	

<?php } ?>

<?php if($pageLayout === 'left-sidebar') { ?>

	<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-50">
        <div class="row">
        
            <?php get_sidebar(); ?>
    
            <div class="col-lg-8 col-md-8 col-sm-12">
                
                <div class="row">
                	<?php get_template_part('content', 'knowledgebasetemplate'); ?>
                </div>
                
                                    
            </div>
        </div>
    </div>

<?php } ?>

<?php if($pageLayout === 'right-sidebar') { ?>

	<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-50">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                
                <div class="row">
                	<?php get_template_part('content', 'knowledgebasetemplate'); ?>
                </div>
                
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php } ?>



<?php get_footer(); ?>