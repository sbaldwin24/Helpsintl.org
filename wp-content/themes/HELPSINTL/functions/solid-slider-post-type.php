<?php
/**
 * The Slider Images custom post type
 */
add_action('init', 'slider_images_register');

function slider_images_register() {	

	register_post_type( 'slider' , 
						array(
							'label' => 'Slider Items',
							'singular_label' => 'Slider Item',
							'public' => true,
							'show_ui' => true,
							'capability_type' => 'post',
							'hierarchical' => false,
							'rewrite' => true,
							'supports' => array('title', 'thumbnail', 'editor' )
						)
					);
	
	add_filter('manage_edit-slider_columns', 'slider_edit_columns');
	add_action('manage_posts_custom_column',  'slider_custom_columns');
	
	function slider_edit_columns($columns){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => 'Slider Image Title',
			'slider_image' => 'Image',
			'slider_url' => 'Destination URL',
		);
	
		return $columns;
	}
	
	function slider_custom_columns($column){
		switch ($column)
		{
			case 'slider_image':
				the_post_thumbnail( 'thumbnail' );
				break;
			case 'slider_url':  
				$custom = get_post_custom();  
				echo $custom['sliderurl'][0];  
				break;  
		}
	}
}
?>