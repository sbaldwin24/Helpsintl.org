<div id="sidebar">
    <ul>
        <?php 
        $removesidebar = get_post_meta($post->ID, 'removesidebar', true);
        if ( $removesidebar == 'TRUE' ) { } else {
        dynamic_sidebar('Page Sidebar');
        } 
        
        $addsidebar = get_post_meta($post->ID, 'addsidebar', true); 
        $sb = 'Sidebar';
        dynamic_sidebar($addsidebar);	
        
        ?>
            
    </ul>
    <div class="clear"></div>
</div>