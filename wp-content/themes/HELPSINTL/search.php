<?php get_header(); ?>
<div id="pagewrap">
<div id="main" class="narrow">
<h2>Search Results for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span style="color:#299877;">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
    <div id="blogpost">
    <div id="post-<?php the_ID(); ?>" <?php post_class() ?> >
    <?php $type=get_post_type(); echo $type; ?>
    <h2 class="indextitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <small>Posted <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?> <?php comments_popup_link('Leave A Comment', '| 1 Comment &#187;', '| % Comments &#187;'); ?> <?php edit_post_link('Edit Post', ' | ', ''); ?></small>
			

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
?> <?php if($img=='') echo(''); else echo ('<img src="'.$img.'" align="left" height="90" width="90" style="margin:10px 6px 0px 0px;" />'); ?><?php the_excerpt('Read more'); ?>
				</div>

				<small><?php the_tags('Tags: ', ', ', ''); ?></small>

                
	</div>
    </div>

	<?php endwhile; ?>

    <div class="nav">
        <div class="navleft"><?php next_posts_link('&laquo; Older Posts') ?></div>
        <div class="navright"><?php previous_posts_link('Newer Posts &raquo;') ?></div>
    </div>

	<?php else : ?>

    <h2>Nothing Found</h2>
    <p>Please try again or contact the <a href="mailto:<?php bloginfo('admin_email'); ?>" title="Email the Site Admin">site administrator</a> with questions.</p>
    <?php get_search_form(); ?>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<div class="clear"></div>
</div> <!--End PageWrap-->
<?php get_footer(); ?>