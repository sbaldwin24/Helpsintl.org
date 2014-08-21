<div id="slider-wrapper">
	<div id="slider" class="nivoSlider">
            <?php
				$my_query = new WP_Query( array( 'post_type' => 'slider' ) ); 
				while ($my_query->have_posts()) : $my_query->the_post();
				
				$custom = get_post_custom($post->ID);
			?>
				<?php // Lightbox Video takes precedence before the slider link
                    if ( !empty ( $custom['slidervideo'][0] ) ) : ?>
                    <a href="<?php echo $custom['slidervideo'][0]; ?>" title="<?php the_title(); ?>" rel="lightbox"><?php $title = get_the_content(); echo get_the_post_thumbnail($id, 'slider-item', array('title' => $title)); ?></a>
                <?php else : // No video... ?>
                    <?php if ( !empty ( $custom['sliderurl'][0] ) ) : // ...check if there's a link for the slider item ?>
                        <a href="<?php echo $custom['sliderurl'][0]; ?>" title="<?php the_title(); ?>"><?php $title = get_the_content(); echo get_the_post_thumbnail($id, 'slider-item', array('title' => $title)); ?></a>
                    <?php else : ?>
                        <?php $title = get_the_content(); echo get_the_post_thumbnail($id, 'slider-item', array('title' => $title)); // No video or link ?>
                    <?php endif; ?>
                <?php endif; ?>
			<?php endwhile; ?>
		</div>
	<!--END #slider-container-->
	</div>
 <!--BEGIN Nivo Slider jQuery initializer-->
 <?php 
 $speed = get_option('slider_rotatespeed');
 $anispeed = get_option('slider_anispeed');
 $rotateslices = get_option('slider_rotateslices');
 $rotateeffect = get_option('slider_rotateeffect');
 $nextprev = get_option('slider_nextprev');
 ?>
    <script>
		jQuery(window).load(function() {
			/* Home page slider */
			jQuery('#slider').nivoSlider({
				effect:'<?php if ( $rotateeffect != '' ) { echo $rotateeffect; } else { echo "random"; } ?>',
				slices:<?php if ( $rotateslices != '' ) { echo $rotateslices; } else { echo "15"; } ?>,
				animSpeed:<?php if ( $anispeed != '' ) { echo $anispeed; } else { echo "1"; } ?>000,
				pauseTime:<?php if ( $speed != '' ) { echo $speed; } else { echo "4"; } ?>000,
				startSlide:0, //Set starting Slide (0 index)
				directionNav:<?php if ( $nextprev != '' ) { echo $nextprev; } else { echo "false"; } ?>, //Next & Prev
				directionNavHide:true, //Only show on hover
				controlNav:true, //1,2,3...
				controlNavThumbs:false, //Use thumbnails for Control Nav
				controlNavThumbsFromRel:false, //Use image rel for thumbs
				controlNavThumbsSearch: '.jpg', //Replace this with...
				controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
				keyboardNav:true, //Use left & right arrows
				pauseOnHover:true, //Stop animation while hovering
				manualAdvance:false, //Force manual transitions
				captionOpacity:.8, //Universal caption opacity
				beforeChange: function(){},
				afterChange: function(){},
				slideshowEnd: function(){} //Triggers after all slides have been shown
			});					
		});
	</script>
    <!--END Nivo Slider jQuery initializer-->