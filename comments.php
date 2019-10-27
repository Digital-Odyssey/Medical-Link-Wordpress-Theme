<?php

/**

 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');

	if (post_password_required()) {
    ?>

    <p class="nocomments"><?php esc_attr_e('This post is password protected. Enter the password to view comments.', 'medicallinktheme'); ?></p>

    <?php
    return;
}

global $id;
$id = $post->ID;

?>



<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<div class="pm-comment-header">
        <h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
    </div>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
     
    <ol class="commentlist" style="margin:0; padding:0;">
        <?php wp_list_comments('callback=pm_ln_mytheme_comment'); ?>
    </ol>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
	<?php else : // comments are closed ?>
    <!-- If comments are closed. -->
    <p class="nocomments">Comments are closed.</p>
     
<?php endif; ?>

<?php endif; ?>
 
