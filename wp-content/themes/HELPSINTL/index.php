<?php get_header(); ?>
<div id="pagewrap">
<div id="main" class="narrow">
        <?php /* If this is a search result page */ if (is_search()) { ?>
		<h1>Search Results</h1> <?php } else { ?><h1>News and Media from HELPS</h1><?php } ?>
<?php $counter = 1; ?>
<?php if (have_posts()) : ?>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3>The Latest from <?php single_cat_title(); ?></h3>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h3>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3>Archive for <?php the_time('F jS, Y'); ?></h3>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3>Archive for <?php the_time('F, Y'); ?></h3>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3>Archive for <?php the_time('Y'); ?></h3>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3>Author Archive</h3>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3>Archives</h3>
 	  <?php } ?>


	<?php while (have_posts()) : the_post(); ?>
	
    <div id="blogpost">
    <div id="post-<?php the_ID(); ?>" <?php post_class() ?> >
  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <small>Posted <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?> <div class="commentcount"><?php comments_popup_link('Leave A Comment', '1 Comment &#187;', '% Comments &#187;'); ?> <?php edit_post_link('Edit Post', ' | ', ''); ?></div></small>

			<div class="entry">
					<?php if($counter == 1) { the_content(); ?><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>" data-count="horizontal" data-via="<?php echo stripslashes(get_option('solid_twitter')); ?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink() ?>&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px; top:2px; position:relative;" allowTransparency="true"></iframe><?php } else { ?><?php
if(has_post_thumbnail()) {
echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
echo get_the_post_thumbnail($thumbnail->ID, 'thumbnail');
echo '</a>';
} else {
$img = null;
$args = array(
 'post_type' => 'attachment',
 'post_mime_type' => 'image',
 'numberposts' => -1,
 'order' => 'ASC',
 'post_status' => null,
 'post_parent' => $post->ID
);
$attachments = get_posts($args);
if ($attachments) {
 foreach ($attachments as $attachment) {
 $img = wp_get_attachment_thumb_url( $attachment->ID );
 break;
 }
}
}
?> <?php if($img=='') echo(''); else echo ('<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '"><img class=" wp-post-image attachment-thumbnail" src="'.$img.'" /></a>'); ?><?php the_excerpt('Read more'); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="readmore">Read More >></a><?php } ?><div class="clear"></div>
				</div>

				<small><?php the_tags('Tags: ', ', ', ''); ?></small><?php if (function_exists('sociable_html')) { echo sociable_html(); } ?> 

                
	</div>
    </div>
	<?php $counter++; ?>
	<?php endwhile; ?>

    <div class="nav">
        <div class="navleft"><?php next_posts_link('&laquo; Older Posts') ?></div>
        <div class="navright"><?php previous_posts_link('Newer Posts &raquo;') ?></div>
    </div>

	<?php else : ?>

    <h2>Nothing Found</h2>
     <p>Please try again or <a href="<?php bloginfo('url'); ?>/contact">contact us</a> with questions.</p>
    <?php get_search_form(); ?>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<div class="clear"></div>
</div> <!--End PageWrap-->
    
<?php get_footer(); ?>