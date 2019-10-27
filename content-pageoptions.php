<?php
//Use this file to display page options (print and share icons)

$enableTooltip = get_theme_mod('enableTooltip', 'on');

?>

<div class="pm-page-share-options">
						
    <a href="#" id="pm-print-btn" class="pm-rounded-btn print" target="_self" ><?php esc_attr_e('print page', 'medicallinktheme') ?> <i class="fa fa-print"></i></a>
    
    <ul class="pm-page-social-icons">
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'medicallinktheme') .'"' : '' ?>><a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" title="<?php esc_attr_e('Share on Google Plus', 'medicallinktheme'); ?>" class="fa fa-google-plus" target="_blank"></a></li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'medicallinktheme') .'"' : '' ?>><a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" title="<?php esc_attr_e('Share on Twitter', 'medicallinktheme'); ?>" class="fa fa-twitter" target="_blank"></a></li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'medicallinktheme') .'"' : '' ?>><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode(the_title()); ?>&summary=<?php urlencode(the_title()); ?>&source=<?php echo urlencode(site_url()); ?>" title="<?php esc_attr_e('Share on LinkedIn', 'medicallinktheme'); ?>" class="fa fa-linkedin" target="_blank"></a></li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'medicallinktheme') .'"' : '' ?>><a href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" title="<?php esc_attr_e('Share on Facebook', 'medicallinktheme'); ?>" class="fa fa-facebook" target="_blank"></a></li>
        
        
    </ul>
    
</div>