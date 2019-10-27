<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $enableTooltip = get_theme_mod('enableTooltip', 'on');

	 $categories = get_the_category();
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	$comments = '';

	$postIconImage = get_theme_mod('postIconImage');
	$postIcon = get_theme_mod('postIcon', 'fa fa-newspaper-o');
	$displayAuthorProfile = get_theme_mod('displayAuthorProfile', 'on');
	$displaySocialFeatures = get_theme_mod('displaySocialFeatures', 'on');
	$displayPostIcon = get_theme_mod('displayPostIcon', 'on');
	
	$categories = wp_get_post_categories(get_the_id(), 'knowledgebasecats');
	              
?>

<!-- PANEL 1 -->
<?php if(!has_post_thumbnail()) { ?>
<div class="container pm-containerPadding-top-110 pm-singlepost-container">
<?php } else { ?>
<div class="container pm-containerPadding-top-110 pm-singlepost-container">
<?php } ?>


    <div class="row">
        <div class="col-lg-12 pm-single-news-post-column">
            
            <div style="overflow:hidden; width:100%;">
    
                <p class="pm-standalone-news-post-category">
                 <?php 
                    foreach ( $categories as $category ) {
						$cat = get_category( $category );
						echo '<a href="'.get_category_link( $cat->term_id ).'"><span>'.$cat->cat_name.'</span></a>';	
					}
                ?>
                </p>
            
            </div>
            
            <!-- Post image -->
            <?php if(has_post_thumbnail()) { ?>
                <div class="pm-single-news-post">
                	<img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title(); ?>" />
                </div>
            <?php } else { ?>
                <div class="pm-single-news-post no-img"></div>
            <?php } ?>
            <!-- Post image end -->
            
            <div class="pm-single-news-post-overlay">
                    
                    
                <?php if($displayPostIcon === 'on') { ?>
                
                		<?php if(!empty($postIconImage)) { ?>
                
                            <div class="pm-single-news-post-icon">
                                <?php 
                                    echo '<img src="'. esc_html($postIconImage) .'" width="33" height="41" alt="icon">';
                                ?>
                            </div>                    
                        
                        <?php } else { ?>
                        
                            <div class="pm-single-news-post-icon">
                                <?php 
                                    echo '<i class="'.$postIcon.'"></i>';		
                                ?>
                            </div>
                        
                        <?php } ?>
                
					<?php } else { ?>
                
                        <div class="pm-single-news-post-icon inactive"></div>
                
                <?php } ?>
                    
				
                
                <h6 class="pm-single-news-post-title"><?php the_title(); ?></h6>
                
                <p class="pm-single-news-post-date"><?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> <?php esc_attr_e('by', 'medicallinktheme'); ?> <?php the_author(); ?></p>
                
                <?php 
                if ( comments_open() ) {
                    if ( $num_comments == 0 ) {
                        $comments = esc_attr__('No Comments', 'medicallinktheme');
                    } elseif ( $num_comments > 1 ) {
                        $comments = $num_comments . esc_attr__(' Comments', 'medicallinktheme');
                    } else {
                        $comments = esc_attr__('1 Comment', 'medicallinktheme');
                    }
                    //$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
                } else {
                    //$write_comments =  esc_attr__('Comments are off for this post.');
                }
                echo '<p class="pm-standalone-news-post-comment-count">' . $comments . '</p>';
                ?>
                
                
            </div><!-- Overlay end -->
            
            <!-- Post info -->
            <div class="pm-single-post-article">
            
                    <?php the_content(); ?>
                    <?php 
    
						$pag_defaults = array(
								'before'           => '<p>' . esc_attr__( 'READ MORE:', 'medicallinktheme' ),
								'after'            => '</p>',
								'link_before'      => '',
								'link_after'       => '',
								'next_or_number'   => 'number',
								'separator'        => ' ',
								'nextpagelink'     => '',
								'previouspagelink' => '',
								'pagelink'         => '%',
								'echo'             => 1
							);
						
						wp_link_pages($pag_defaults); 
					
					?>
            
            </div>
            
            <!-- Post info end -->
            
            <?php if($displaySocialFeatures === 'on') : ?>
            
            	<!-- Post info and tags -->
                <div class="pm-single-post-social-features">
                
                    <div class="pm-single-post-tags">
                        <?php if(has_tag()) : ?>
                            <p class="tags"><?php esc_attr_e('Tagged in', 'medicallinktheme'); ?>: <?php the_tags('', ', ', ''); ?></p>
                            <div class="pm-news-post-divider"></div>
                        <?php endif; ?>
                        
                    </div>
                    
                    <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);?>
                    
                    <div class="pm-single-post-like-feature">
                        <a href="#" class="pm-single-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
                        <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></span>
                    </div>
                    
                    <div class="pm-single-post-share-icons">
                        <ul class="pm-single-post-social-icons">
                        
                            <li><p><?php esc_attr_e('Share This', 'medicallinktheme'); ?></p></li>
                        
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" class="fa fa-twitter" target="_blank"></a>
                            </li>
                            
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-facebook" target="_blank"></a>
                            </li>
                        
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" class="fa fa-google-plus" target="_blank"></a>
                            </li>
                            
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" class="fa fa-linkedin" target="_blank"></a>
                            </li>
                            
                            <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Reddit', 'medicallinktheme') .'"' : '' ?>> 
                                <a href="http://reddit.com/submit?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" class="fa fa-reddit" target="_blank"></a>
                            </li>
    
                        </ul>
                    
                    </div>
              
                    
                </div>
                <!-- Post info and tags end -->
            
            <?php endif; ?>
            
            
        </div>
    </div>

</div>
<!-- PANEL 1 end -->

<?php
    
	//author info
	$display_name = get_the_author_meta('display_name');
	$first_name = get_the_author_meta('first_name');
	$last_name = get_the_author_meta('last_name');
	$author_title = get_the_author_meta( 'author_title' ); 
	$description = get_the_author_meta('description');
	
	
	$toggleParallaxAuthor = get_theme_mod('toggleParallaxAuthor', 'on');
	
?> 

<?php if($displayAuthorProfile === 'on') : ?>

	<!-- PANEL 2 -->
    <div class="pm-column-container pm-author-column pm-containerPadding-bottom-30 pm-containerMargin-top-<?php echo $displaySocialFeatures === 'on' ? '40' : '90' ?> pm-containerMargin-bottom-100 <?php echo $toggleParallaxAuthor === 'on' ? 'pm-parallax-panel' : '' ?>" <?php echo $toggleParallaxAuthor === 'on' ? 'data-stellar-vertical-offset="-100" data-stellar-background-ratio="0.5"' : '' ?>>
            
        <div class="container pm-containerPadding80">
            <div class="row">
                <div class="col-lg-12">
                    
                    <h4 class="pm-author-column-title pm-post-column-title"><?php esc_attr_e('About the author', 'medicallinktheme') ?></h4>
                    
                    <div class="row pm-containerPadding-top-30">
                        
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            
                            <?php $avatar = pm_ln_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 190 )); ?>
                            
                            <div class="pm-author-bio-img-bg" style="background-image:url(<?php echo esc_html($avatar); ?>);">
                                
                                
                                <?php if($postIcon !== '') { ?>
                
                                    <div class="pm-single-news-post-avatar-icon">
                                        <?php 
                                            echo '<i class="fa fa-user"></i>';		
                                        ?>
                                    </div>
                                
                                <?php } else if($postIconImage !== '') { ?>
                                
                                    <div class="pm-single-news-post-avatar-icon">
                                        <?php 
                                            echo '<img src="'. esc_html($postIconImage) .'" width="33" height="41" class="img-responsive" alt="icon">';
                                        ?>
                                    </div>
                                
                                <?php } else { ?>
                                
                                <?php } ?>
                                
                                
                            </div>
                            
                        </div>
                        
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <p class="pm-author-name"><?php echo esc_attr($first_name); ?> <?php echo esc_attr($last_name); ?></p>
                            <p class="pm-author-title"><?php echo esc_attr($author_title); ?></p>
                            <div class="pm-author-divider"></div>
                            <p class="pm-author-bio"><?php echo esc_attr($description); ?></p>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    
    </div>
    <!-- PANEL 2 end -->

<?php endif; ?>



<!-- PANEL 3 -->
<?php if($displaySocialFeatures !== 'on' && $displayAuthorProfile !== 'on') { ?>
	<div class="container pm-containerPadding-bottom-70 pm-containerPadding-top-70 pm-related-posts-container">
<?php } else { ?>
	<div class="container pm-containerPadding-bottom-70 pm-related-posts-container">
<?php } ?>

    <div class="row">
        <div class="col-lg-12">
        
            <h4 class="pm-post-column-title"><?php esc_attr_e('Related Posts', 'medicallinktheme') ?></h4>
            
            <?php get_template_part('content', 'relatedposts'); ?>
                        
        </div>
    </div>
</div>
<!-- PANEL 3 end-->

<?php if ($num_comments > 0 ) : ?>

<!-- PANEL 4 -->
<a id="comments"></a>
<div class="pm-column-container pm-comments-column pm-containerPadding80" style="background-color:#21BBC7;">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
                <!--<h4 class="pm-comments-response-title">1 response to "asking the right questions when meeting your family doctor"</h4>-->
                
                <!-- Comments --> 
                <div class="pm-comments-container">
                    
                    <?php comments_template( '', true ); ?>
                
                </div>
                <!-- Comments end --> 
                
            </div>
        </div>
    </div>

</div>
<!-- PANEL 4 end -->

<?php endif; ?>


<!-- PANEL 5 -->

<?php if ( comments_open() ) : ?>

	<?php if ($num_comments > 0 ) { ?>
        <div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-80">
    <?php } else { ?>
        <div class="container pm-containerPadding-bottom-80">
    <?php } ?>
    
        <div class="row">
            <div class="col-lg-12">
                
                <h4 class="pm-post-column-title"><?php esc_attr_e('Submit a comment','medicallinktheme') ?></h4>
                
                <?php if ( !$user_ID ) : ?>
                    <p class="pm-required-comments"><?php esc_attr_e('Your email address will not be published. Required fields are marked *','medicallinktheme') ?></p>
                <?php endif; ?>
                
                <!-- MOVE TO content-singlepost -->
    
    <?php if ('open' == $post->comment_status) : ?>
     
        <div id="respond">
        
        	<div class="pm-comment-header">
                <h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
                <!--<div class="pm-comment-header-block"></div>-->
            </div>
             
            <div class="cancel-comment-reply" style="margin-bottom:15px;">
                <small><?php cancel_comment_reply_link(); ?></small>
            </div>
         
            <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php esc_attr_e('logged in', 'medicallinktheme'); ?></a> <?php esc_attr_e('to post a comment.', 'medicallinktheme'); ?></p>
            <?php else : ?>
         
            <div class="row pm-containerPadding-top-20">
            
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">
             
                    <?php if ( $user_ID ) : ?>
                    
                    <?php $user = wp_get_current_user(); ?>
                     
                        <p style="padding-left:16px;"><?php esc_attr_e('Logged in as', 'medicallinktheme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo esc_attr($user->display_name); ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account','medicallinktheme'); ?>">Log out &raquo;</a></p>
                         
                        <?php else : ?>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="author" placeholder="<?php esc_attr_e('Name *', 'medicallinktheme'); ?>" id="author" class="respond_author pm-comment-form-textfield" value="" size="22" tabindex="1" />
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="email"  placeholder="<?php esc_attr_e('Email *', 'medicallinktheme'); ?>" id="email" class="respond_email pm-comment-form-textfield" value="" size="22" tabindex="2" />
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="url" placeholder="<?php esc_attr_e('Website', 'medicallinktheme'); ?>" id="url" class="respond_url pm-comment-form-textfield" value="" size="22" tabindex="3" />
                        </div>
        
                     
                    <?php endif; ?>
                    
                    
                    <div class="col-lg-12 pm-clear-element">
                        <textarea name="comment" placeholder="<?php esc_attr_e('Comment...', 'medicallinktheme'); ?>" id="comment" cols="100" rows="10"  class="respond_comment pm-comment-form-textarea" tabindex="4"></textarea>
                    </div>
                    
                    <div class="col-lg-12 pm-clear-element">
                        <div class="pm-comment-html-tags">
                            <span><?php esc_attr_e('You may use these HTML tags and attributes:', 'medicallinktheme'); ?></span>
                            <p><code><?php echo allowed_tags(); ?></code></p>
                        </div>
                        
                        <input name="submit" type="submit" id="submit" class="pm-comment-submit-btn"  value="<?php esc_attr_e('Submit Comment', 'medicallinktheme'); ?>">
                        
                    </div>
                    
                     
                    <?php comment_id_fields(); ?>
                    </p>
                    
                    <?php //do_action('comment_form', $post->ID); ?>
                 
                </form>
            
            </div><!-- /.row -->
         
            
         
            <?php endif; // If registration required and not logged in ?>
            
        </div>
     
    <?php endif; // if you delete this the sky will fall on your head ?>

<?php endif; ?>



            
        </div>
    </div>
</div>
<!-- PANEL 5 end-->