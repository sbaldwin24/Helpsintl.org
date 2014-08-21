<?php
/*
Template Name: Media Page
*/
?>
<?php get_header(); ?>

<div id="pagewrap">
<?php include(TEMPLATEPATH . '/widesub.php'); ?>

<div id="main" class="narrow">
<?php if (has_post_thumbnail()) {
  the_post_thumbnail('banner'); } ?>
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

		<?php  if( get_post_meta($post->ID, "postcat", true) ) {
				$postcat = get_post_meta($post->ID, 'postcat', true);
				if ($postcat == 'all') {
				$postcat = ''; } ?>        
        <?php query_posts("category_name=".$postcat."&showposts=4"); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    <div id="blogpost">
    <div id="post-<?php the_ID(); ?>" <?php post_class() ?> >
  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <small>Posted <?php the_time('F jS, Y'); ?> in <?php the_category(', ') ?> <div class="commentcount"><?php comments_popup_link('Leave A Comment', '1 Comment &#187;', '% Comments &#187;'); ?> <?php edit_post_link('Edit Post', ' | ', ''); ?></div></small>

				

			<div class="entry">
			<?php
//Get images attached to the post
$img=null;
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
?> <?php if($img=='') echo(''); else echo ('<img src="'.$img.'" align="left" height="150" width="270" style="margin:10px 10px 0px 0px;" />'); ?><?php the_excerpt('Read more'); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="readmore">Read More >></a><div class="clear"></div>
				</div>

				<small><?php the_tags('Tags: ', ', ', ''); ?></small> 

                
	</div>
    </div>
	<?php endwhile; ?>

	<?php else : ?>

    <h2>Nothing Found</h2>
     <p>Please try again or <a href="<?php bloginfo('url'); ?>/contact">contact us</a> with questions.</p>
    <?php get_search_form(); ?>

	<?php endif; ?>
	
    <?php if( $postcat ): ?><p align="right"><a class="button blue" href="<?php bloginfo('url'); ?>/category/<?php echo "$postcat";?>">View More</a></p><?php endif; } ?>
    
</div><!-- end main narrow -->
<?php get_sidebar(); ?>
<div class="clear"></div>

</div> <!--End PageWrap-->
<script>
$("#main img[title]").tooltip();
</script> 
<?php get_footer(); ?>