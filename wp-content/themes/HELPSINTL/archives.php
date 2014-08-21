<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>

<?php if( get_post_meta($post->ID, "banner", true) ): ?><div id="banner"><img src="<?php $key="banner"; echo get_post_meta($post->ID, $key, true); ?>" alt="<?php the_title(); ?>" /></div><?php endif; ?>

<div id="pagewrap">
<div id="main" class="narrow">
<h1>Archives</h1>
<h3 class="top"><?php _e('By Month:', 'thesis'); ?></h3>
		<ul>
			<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
		</ul>
	<h3><?php _e('By Category:', 'thesis'); ?></h3>
		<ul>
			<?php wp_list_categories('title_li=0&show_count=1'); ?>
		</ul>

</div><!-- end main narrow -->
<?php get_sidebar(); ?>
<div class="clear"></div>

</div> <!--End PageWrap-->

<?php get_footer(); ?>