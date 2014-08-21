<?php get_header(); ?>
<div id="pagewrap">
<div id="main" class="narrow">
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
    <div id="blogpost">
    <div id="post-<?php the_ID(); ?>" <?php post_class() ?> >
<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
    <small>Posted <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?> <div class="commentcount"><?php comments_popup_link('Leave A Comment', '1 Comment &#187;', '% Comments &#187;'); ?> <?php edit_post_link('Edit Post', ' | ', ''); ?></div></small>
    
				<div class="entry single">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
                	<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                <div class="clear"></div>
                </div><!--End entry-->
                
				<small><?php the_tags('Tags: ', ', ', ''); ?></small>
                
                
                
                
	</div><!--End Post-->
    </div><!--End Blogpost-->
    <a name="respond"></a><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="<?php the_permalink(); ?>" data-via="<?php echo stripslashes(get_option('solid_twitter')); ?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink() ?>&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px; top:2px; position:relative;" allowTransparency="true"></iframe><g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone><script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
	<?php if ( comments_open() ) { comments_template(); } ?>
	
	<?php endwhile; ?>

	<?php else : ?>

    <h2>Nothing Found</h2>
    <p>Please try again or contact us with questions.</p>

	<?php endif; ?>
    
</div><!--End Main Narrow-->

<?php get_sidebar(); ?>

<div class="clear"></div>
</div> <!--End PageWrap-->
    
<?php get_footer(); ?>