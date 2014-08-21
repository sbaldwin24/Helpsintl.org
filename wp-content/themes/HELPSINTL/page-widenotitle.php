<?php
/*
Template Name: Wide Page No Title
*/
?>
<?php get_header(); ?>

<div id="pagewrap">
<?php include(TEMPLATEPATH . '/widesub.php'); ?>

<div id="main" class="wide">
<?php if (has_post_thumbnail()) {
  the_post_thumbnail('banner-wide'); } ?>
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
				<div class="entry">
					<?php the_content(); ?>
                <small><?php edit_post_link('Edit Page', '', ''); ?></small>
				</div>

	
	<?php if (get_option('solid_commentsoff')) { } else { if ( comments_open() ) { comments_template(); } } ?>

	<?php endwhile; ?>

  

	<?php else : ?>

    <h2>Nothing Found</h2>
     <p>Please try again or <a href="<?php bloginfo('url'); ?>/contact">contact us</a> with questions.</p>
    <?php get_search_form(); ?>

	<?php endif; ?>

</div>

<div class="clear"></div>

</div> <!--End PageWrap-->

<?php get_footer(); ?>