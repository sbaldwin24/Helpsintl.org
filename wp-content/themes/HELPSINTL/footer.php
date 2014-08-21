<div class="clear"></div>
<?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Above Footer') ) : ?>
<?php endif; ?>
<div id="footer"> 
        <div id="footerleft">
        <h3>Connect</h3>
        <?php include(TEMPLATEPATH . '/social.php'); ?>
		<?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left') ) : ?>
        <?php endif; ?>
        </div>   
        <div id="footerright">
        <h3>Media</h3>
		<?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right') ) : ?>
        <?php endif; ?>
        </div><!--end footerright-->
                
        <div id="footercenter">
        <h3>Latest from HELPS</h3>
        <ul class="latest">
        <?php query_posts( 'category_name=&showposts=4' ); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
        <?php endif; ?>
        </ul>
        <?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Center') ) : ?>
        <?php endif; ?>
        <div class="clear"></div>   
       
<div class="clear"></div>        


</div><!--end footer -->
</div> <!--End Page-->
 <div id="footermenu">&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?> <?php wp_nav_menu( array( 'container' => '', 'menu' => 'Footer Menu' ) ); ?> <?php if (get_option('solid_removeatt')) { } else { ?> Site by <a href="http://fourtencreative.com/" rel="nofollow" target="_blank">410</a><?php } ?></div>
<?php wp_footer(); ?>
</div><!-- end outer -->
</body>
</html>