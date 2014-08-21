<div id="social">
<ul>
<?php
$facebook = get_option('solid_facebook');
$twitter = get_option('solid_twitter');			
$vimeo = get_option('solid_vimeo');
$flickr = get_option('solid_flickr');
$rss = get_option('solid_feedurl');
$imgfolder = get_bloginfo('template_directory');
					
if ( $facebook ) { ?><li><a class="facebook" href="<?php echo $facebook; ?>" title="Connect on Facebook" target="_blank" >Facebook</a></li><?php }
if ( $twitter ) { ?><li><a class="twitter" href="http://twitter.com/<?php echo $twitter; ?>" title="Follow Us On Twitter" target="_blank">Twitter</a></li><?php } ?>

</ul> 
</div>