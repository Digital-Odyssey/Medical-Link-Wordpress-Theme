<!-- SUBHEADER AREA -->

<?php 
		
	$enableSubHeader = get_theme_mod('enableSubHeader', 'on');
		
	//Sub-header options
	$globalHeaderImage = get_theme_mod('globalHeaderImage');
	$globalHeaderImage2 = get_theme_mod('globalHeaderImage2');

?>
        
<?php if( $enableSubHeader === 'on' ) : ?>

	<!-- Subpage Header layouts -->
	<?php if( function_exists( 'is_shop' ) ) { //woocommerce installed ?>
    
            <?php if( is_shop() ) { //Load Woocommerce shop header ?>
            
                    <?php 
                        global $woocommerce;
                        $pageid = get_option('woocommerce_shop_page_id');
                        $pm_woocom_header_image_meta = get_post_meta($pageid, 'pm_header_image_meta', true); 
                    ?>
                    
                    <?php if($pm_woocom_header_image_meta !== '') { ?>
                
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>');">
                    
                    <?php } else { ?>
                    
                            <div class="pm-sub-header-container">
                    
                    <?php } ?>
                    
            <?php } elseif( is_product() ) {//Load Woocommerce product header ?>
            
                    <?php 
                        global $woocommerce;
                        $pm_woocom_header_image_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_image_meta', true); 
						$wooproductsHeaderImage = get_theme_mod('wooproductsHeaderImage');
                    ?>
                    
                    <?php if($pm_woocom_header_image_meta !== '') { ?>
                
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>');">
                            
                    <?php } elseif($wooproductsHeaderImage !== '') { ?>
                    
                    		<div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($wooproductsHeaderImage); ?>');">
                    
                    <?php } else { ?>
                    
                            <div class="pm-sub-header-container">
                    
                    <?php } ?>
            
            <?php } elseif( is_product_category() || is_product_tag() ) {//Load Woocommerce archive header ?>
            
                    <?php 
                        $wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage'); 
                    ?>
                    
                    <?php if($wooCategoryHeaderImage !== '') { ?>
                
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($wooCategoryHeaderImage); ?>');">
                    
                    <?php } else { ?>
                    
                            <div class="pm-sub-header-container">
                    
                    <?php } ?>
            
            <?php } elseif( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {  ?>
            
                    <?php if($globalHeaderImage2 !== '') { ?>
                
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>');">
                    
                    <?php } else { ?>
                    
                            <div class="pm-sub-header-container">
                    
                    <?php } ?>
                
            <?php } else {  ?>
            
                    <?php
                        $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                    ?>
                    
                    <?php if($pageHeaderImage !== '') { ?>
                
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>');">
                        
                    <?php } elseif($globalHeaderImage !== '') { ?>
                    
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>');">
                    
                    <?php } else { ?>
                    
                            <div class="pm-sub-header-container">
                    
                    <?php } ?>
    
            
            <?php } ?>
    
    <?php } else {//woocommerce not installed ?>
    
            <?php if( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {//Display Global header image on these pages ?>
            
                <?php if($globalHeaderImage2 !== '') { ?>
                
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>');">
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
            
            <?php } else {//Display Page header on pages ?>
            
                    <?php
                        $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                    ?>
                    
                    <?php if($pageHeaderImage !== '') { ?>
                
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>');">
                        
                    <?php } elseif($globalHeaderImage !== '') { ?>
                    
                            <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>');">
                    
                    <?php } else { ?>
                    
                            <div class="pm-sub-header-container">
                    
                    <?php } ?>
    
            
            <?php } ?>
    
    <?php } ?>
    
    
        <div class="pm-sub-header-info">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"> 
                    
                        <!-- Header Page Title / Message --> 
                        <?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
                        
                                <?php if( is_search() && is_shop() ) { ?>
                        
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('Search Results for:', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message"><?php echo get_search_query(); ?></p>
                                
                                <?php } else if( is_shop() ) { ?>
                                
                                        <?php 
                                            global $woocommerce;
                                            $pageid = get_option('woocommerce_shop_page_id');
                                            $pm_header_message_meta = get_post_meta($pageid, 'pm_header_message_meta', true); 
                                            //$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
                                        ?>
                                                
                                        <p class="pm-page-title">
                                            <?php woocommerce_page_title(); ?>
                                        </p>
                                        <p class="pm-page-message"><?php echo esc_attr($pm_header_message_meta); ?></p>
                                
                                <?php } else if( is_404() ) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('404 Error', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message"><?php esc_attr_e('Page not found', 'medicallinktheme'); ?></p>
                                
                                <?php } else if( is_search() ) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('Search Results for:', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message">"<?php echo get_search_query(); ?>"</p>
                                        
                                <?php } else if(is_tag()) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('News tagged with:', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message">"<?php echo get_query_var('tag'); ?>"</p>
                                        
                                <?php } else if(is_category()) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('News filed in:', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
                                        
                                <?php } else if(is_product()) { ?>
                                
                                        <p class="pm-post-title">
                                            <?php the_title(); ?>
                                        </p>
                                        
                                        <?php $pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); ?>
                                        
                                        <p class="pm-page-message"><?php echo esc_attr($pm_woocom_header_message_meta); ?></p>
                                
                                <?php } else if(is_single()) { ?>
                                
                                        <p class="pm-post-title">
                                            <?php the_title(); ?>
                                        </p>
                                        
                                <?php } else if(is_tax('knowledgebasecats') ) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('Archive for', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message">
                                            '<?php single_tag_title();  ?>'
                                        </p>
                                        
                                <?php } else if(is_tax('knowledgebasetags') ) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('Archive for', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message">
                                            '<?php single_tag_title();  ?>'
                                        </p>
                                        
                                <?php } else if(is_tax('locations_countries') ) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('Locations in', 'medicallinktheme'); ?> <?php single_tag_title();  ?>
                                        </p>
                                        
                                <?php } else if( is_archive() ) { ?>
                                
                                        <p class="pm-page-title">
                                            <?php esc_attr_e('Archive for', 'medicallinktheme'); ?>
                                        </p>
                                        <p class="pm-page-message">
                                            <?php 
                                                if (is_day()) {
                                                    the_time('F jS, Y');
                                                }
                                                elseif (is_month()) {
                                                    the_time('F, Y');
                                                }
                                                elseif (is_year()) {
                                                    the_time('Y');
                                                }
                                                elseif (is_author()) {
                                                    echo"<li>Author Archive"; echo'</li>';
                                                }
                                            
                                            ?>
                                        </p>
                                        
                                
                                
                                <?php } else { ?>
                                
                                        <?php
                                            $pm_header_message_meta = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 
                                        ?>
                                
                                        <p class="pm-page-title">
                                            <?php the_title(); ?>
                                        </p>
                                        <p class="pm-page-message"><?php echo esc_attr($pm_header_message_meta); ?></p>
                                
                                <?php } ?>
                        
                        <?php } else {//Woocommerce not enabled ?>
                            
                            <?php if( is_404() ) { ?>
                            
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('404 Error', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message"><?php esc_attr_e('Page not found', 'medicallinktheme'); ?></p>
                            
                            <?php } else if( is_search() ) { ?>
                            
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('Search Results for:', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message">"<?php echo get_search_query(); ?>"</p>
                                    
                            <?php } else if(is_tag()) { ?>
                            
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('News tagged with:', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message">"<?php echo get_query_var('tag'); ?>"</p>
                                    
                            <?php } else if(is_category()) { ?>
                            
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('News filed in:', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
                                    
                            <?php } else if(is_single()) { ?>
                                
                                        <p class="pm-post-title">
                                            <?php the_title(); ?>
                                        </p>
                                        
                            <?php } else if(is_tax('knowledgebasecats') ) { ?>
                                
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('Archive for', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message">
                                        '<?php single_tag_title();  ?>'
                                    </p>
                                    
                            <?php } else if(is_tax('knowledgebasetags') ) { ?>
                            
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('Archive for', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message">
                                        '<?php single_tag_title();  ?>'
                                    </p>
                                    
                            <?php } else if( is_archive() ) { ?>
                            
                                    <p class="pm-page-title">
                                        <?php esc_attr_e('Archive for', 'medicallinktheme'); ?>
                                    </p>
                                    <p class="pm-page-message">
                                        <?php 
                                            if (is_day()) {
                                                the_time('F jS, Y');
                                            }
                                            elseif (is_month()) {
                                                the_time('F, Y');
                                            }
                                            elseif (is_year()) {
                                                the_time('Y');
                                            }
                                            elseif (is_author()) {
                                                echo "<li>". esc_attr__('Author Archive', 'medicallinktheme') ." "; echo'</li>';
                                            }
                                        
                                        ?>
                                    </p>
                            
                            <?php } else { ?>
                            
                                    <?php
                                        $pm_header_message_meta = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 
                                    ?>
                            
                                    <p class="pm-page-title">
                                        <?php the_title(); ?>
                                    </p>
                                    <p class="pm-page-message"><?php echo esc_attr($pm_header_message_meta); ?></p>
                            
                            <?php } ?>
                        
                        <?php } ?>                 
                    
                    </div>
                </div>
            </div>
        </div>              
                                          
    </div><!-- container close -->

<?php endif; ?>

<?php get_template_part('content', 'subheaderbreadcrumbs'); ?>