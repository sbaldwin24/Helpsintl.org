<?php
/**
 * Post/Page Custom Fields Meta Boxes
 */
global $new_meta_boxes;
$new_meta_boxes =
array(
	"slidertitle" => array(
	"name" => "slidertitle",
	"title" => "Slider Item Settings",
	"type" => "title",
	"location" => "Slider"),

	"sliderurl" => array(
	"name" => "sliderurl",
	"std" => "",
	"title" => "Slider Item link URL",
	"description" => "Set an optional ink url to be applied to this slider item image. be sure to include <em>http://</em><br />(Note: if you set a video in the field below then this property will be ignored and the video will still display in a lightbox)",
	"type" => "text",
	"location" => "Slider"),	
	
	"slidervideo" => array(
	"name" => "slidervideo",
	"std" => "",
	"title" => "Play Video in Lightbox when clicking an image",
	"description" => "Examples:<br /><strong>Flash:</strong> http://www.adobe.com/products/flashplayer/include/marquee/design.swf?width=792&height=294<br /><strong>YouTube:</strong> http://www.youtube.com/watch?v=B0ky-VMi9fI<br /><strong>Vimeo:</strong> http://vimeo.com/8245346",
	"type" => "text",
	"location" => "Slider"),
);

function new_meta_boxes_slider() {
	new_meta_boxes('Slider');
}

function new_meta_boxes( $type ) {
	global $post, $new_meta_boxes;
	
	// Use nonce for verification
    echo '<input type="hidden" name="metanonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<div class="form-wrap">';

	foreach($new_meta_boxes as $meta_box) {
		if( $meta_box['location'] == $type) {
			
			if ( $meta_box['type'] == 'title' ) {
				echo '<p style="font-size: 18px; font-weight: bold; font-style: normal; color: #e5e5e5; text-shadow: 0 1px 0 #111; line-height: 40px; background-color: #464646; border: 1px solid #111; padding: 0 10px; -moz-border-radius: 6px;">' . $meta_box[ 'title' ] . '</p>';
			} else {			
				$meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
		
				if($meta_box_value == "")
					$meta_box_value = $meta_box['std'];
		
				echo '<div class="form-field form-required">';
				
				switch ( $meta_box['type'] ) {
					case 'text':
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						echo 	'<input type="text" name="' . $meta_box[ 'name' ] . '" value="' . htmlspecialchars( $meta_box_value ) . '" style="border-color: #ccc;" />';
						break;
						
					case 'checkbox':
						if($meta_box_value == '1'){ $checked = "checked=\"checked\""; }else{ $checked = "";} 
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong>&nbsp;<input style="width: 20px;" type="checkbox" name="' . $meta_box[ 'name' ] . '" value="1" ' . $checked . ' /></label>';
						break;
						
					case 'select':
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						
                        echo	'<select name="' . $meta_box[ 'name' ] . '">';

						// Loop through each option in the array
						foreach ($meta_box[ 'options' ] as $option) {
							if(is_array($option)) {
								echo '<option ' . ( $meta_box_value == $option['value'] ? 'selected="selected"' : '' ) . ' value="' . $option['value'] . '">' . $option['text'] . '</option>';
							} else {
   								echo '<option ' . ( $meta_box_value == $option ? 'selected="selected"' : '' ) . ' value="' . $option['value'] . '">' . $option['text'] . '</option>';
							}
						}
                        
						echo	'</select>';
                        break;
						
				}

				echo 	'<p>' . $meta_box[ 'description' ] . '</p>';
				echo '</div>';
			}
		}
	}
	
	echo '</div>';
}

function create_meta_box() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new_meta_boxes_slider', ' Slider Settings', 'new_meta_boxes_slider', 'slider', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['metanonce'], basename(__FILE__)) ) {
		return $post_id;
	}
	
	if ( wp_is_post_revision( $post_id ) or wp_is_post_autosave( $post_id ) )
		return $post_id;
		
	global $post, $new_meta_boxes;

	foreach($new_meta_boxes as $meta_box) {
		
		if ( $meta_box['type'] != 'title)' ) {
		
			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}
			
			if ( is_array($_POST[$meta_box['name']]) ) {
				
				foreach($_POST[$meta_box['name']] as $cat){
					$cats .= $cat . ",";
				}
				$data = substr($cats, 0, -1);
			}
			else { $data = $_POST[$meta_box['name']]; }			
	
			if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
				
		}
	}
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

?>
