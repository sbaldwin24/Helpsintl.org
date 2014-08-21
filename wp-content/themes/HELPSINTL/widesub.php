<?php
$removesubmenu = get_post_meta($post->ID, 'removesubmenu_value', true);
if ( $removesubmenu == 'TRUE' ) { } else {
if($post->post_parent) {
$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1");
$titlenamer = get_the_title($post->post_parent);
}

else {
$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1");
$titlenamer = get_the_title($post->ID);
}
if ($children) { ?>
<div id="widesubnav">
<ul>
<li><strong>In this Section:</strong></li><?php echo $children; ?>
</ul>
</div>
<?php } } ?>