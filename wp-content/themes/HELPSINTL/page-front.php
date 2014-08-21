<?php
/*
Template Name: Front Page
*/
?>
<?php get_header(); ?>

<div id="pagewrap" class="fpwrap">
<div id="main" class="wide fp">
 
<?php include(TEMPLATEPATH . '/slider.php'); ?>
    
</div> <!--end main-->
<div class="clear"></div>
</div> <!--End PageWrap-->

<?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('FP Middle Mission') ) : ?>
<?php endif; ?>

<div id="pagewrap" class="programs"> 
<?php
$hcimage = get_option('solid_hcimage');
$hctext = get_option('solid_hctext');

$htimage = get_option('solid_htimage');
$httext = get_option('solid_httext');

$onimage = get_option('solid_onimage');
$ontext = get_option('solid_ontext');

$edimage = get_option('solid_edimage');
$edtext = get_option('solid_edtext');

$ecimage = get_option('solid_ecimage');
$ectext = get_option('solid_ectext');
?>
    	<div id="prodiv" class="healthcare" onclick="location.href='<?php bloginfo('url'); ?>/programs/healthcare';" style="cursor: pointer;">
        <a href="<?php bloginfo('url'); ?>/programs/healthcare" /><img height="110" width="217" src="<?php echo stripslashes($hcimage); ?>" alt="Healthcare" /></a>
        <p><?php echo stripslashes($hctext); ?> <strong><a href="<?php bloginfo('url'); ?>/programs/healthcare" />>></a></strong></p>
        </div>
    	
        <div id="prodiv" class="onil" onclick="location.href='<?php bloginfo('url'); ?>/programs/onil-products';" style="cursor: pointer;">
        <a href="<?php bloginfo('url'); ?>/onil-products" /><img height="110" width="217" src="<?php echo stripslashes($onimage); ?>" alt="ONIL Products" /></a>
        <p><?php echo stripslashes($ontext); ?> <strong><a href="<?php bloginfo('url'); ?>/onil-products" />>></a></strong></p>
        </div>
    	
        <div id="prodiv" class="education" onclick="location.href='<?php bloginfo('url'); ?>/programs/education';" style="cursor: pointer;">
        <a href="<?php bloginfo('url'); ?>/programs/education" /><img height="110" width="217" src="<?php echo stripslashes($edimage); ?>" alt="Education" /></a>
        <p><?php echo stripslashes($edtext); ?> <strong><a href="<?php bloginfo('url'); ?>/programs/education" />>></a></strong></p>
        </div>
    	
        <div id="prodiv" class="economic" onclick="location.href='<?php bloginfo('url'); ?>/programs/economic-development';" style="cursor: pointer;">
        <a href="<?php bloginfo('url'); ?>/programs/economic-development" /><img height="110" width="217" src="<?php echo stripslashes($ecimage); ?>" alt="Economic Development" /></a>
        <p><?php echo stripslashes($ectext); ?> <strong><a href="<?php bloginfo('url'); ?>/programs/economic-development" />>></a></strong></p>
        </div>
                        
</div> <!--end pagewrap programs-->
                

<?php get_footer(); ?>