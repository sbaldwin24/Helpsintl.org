<div id="sidebar">

    <h2>View By Program</h2>
        <ul class="mediaprograms">
            <li class="healthcare"><a href="<?php bloginfo('url'); ?>/category/healthcare">Healthcare</a></li>
            <li class="onilproducts"><a href="<?php bloginfo('url'); ?>/category/onil-products">ONIL Products</a></li>
            <li class="education"><a href="<?php bloginfo('url'); ?>/category/education">Education</a></li>
            <li class="economicdevelopment"><a href="<?php bloginfo('url'); ?>/category/economic-development">Economic Development</a></li>
        </ul>
    <ul>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Sidebar') ) : ?>
    <?php endif; ?>
	</ul>
<div class="clear"></div>
</div>