<?php
/* solid Theme SEO Excerpt & Keywords */
function solid_meta_desc() {
	/* >> user-configurable variables */
	$default_blog_desc = get_option('solid_metadesc'); // default description (setting overrides blog tagline)
	$post_desc_length  = 20; // description length in # words for post/Page
	$post_use_excerpt  = 1; // 0 (zero) to force content as description for post/Page
	$custom_desc_key   = 'seometadesc_value'; // custom field key; if used, overrides excerpt/content
	/* << user-configurable variables */

	global $cat, $cache_categories, $wp_query, $wp_version;
	if (is_front_page()) { 
		$post = $wp_query->post;
		$post_custom = get_post_custom($post->ID);
		$custom_desc_value = $post_custom["$custom_desc_key"][0];
		if ($custom_desc_value) {
			$description = $custom_desc_value; }
		else {
			$description = (empty($default_blog_desc)) ? trim(strip_tags(get_bloginfo('description'))) : $default_blog_desc;
			}
		}
	elseif(is_single() || is_page()) {
		$post = $wp_query->post;
		$post_custom = get_post_custom($post->ID);
		$custom_desc_value = $post_custom["$custom_desc_key"][0];

		if($custom_desc_value) {
			$text = $custom_desc_value;
		} elseif($post_use_excerpt && !empty($post->post_excerpt)) {
			$text = $post->post_excerpt;
		} else {
			$text = $post->post_content;
		}
		$text = str_replace(array("\r\n", "\r", "\n", "  "), " ", $text);
		$text = str_replace(array("\""), "", $text);
		$text = trim(strip_tags($text));
		$text = explode(' ', $text);
		if(count($text) > $post_desc_length) {
			$l = $post_desc_length;
			$ellipsis = '...';
		} else {
			$l = count($text);
			$ellipsis = '';
		}
		$description = '';
		for ($i=0; $i<$l; $i++)
			$description .= $text[$i] . ' ';

		$description .= $ellipsis;
	} elseif(is_category()) {
		$category = $wp_query->get_queried_object();
		$description = trim(strip_tags($category->category_description));
	} else {
		$description = (empty($default_blog_desc)) ? trim(strip_tags(get_bloginfo('description'))) : $default_blog_desc;
	}

	if($description) {
		echo $description;
	}
}


function solid_meta_key() {
	/* >> user-configurable variables */
	$default_blog_key = get_option('solid_metakey'); // default description (setting overrides blog tagline)
	$custom_key_key   = 'seometakey_value'; // custom field key; if used, overrides excerpt/content

	global $post, $wp_query;
	if(is_page()) {
		$post = $wp_query->post;
		$post_custom = get_post_custom($post->ID);
		$custom_key_value = $post_custom["$custom_key_key"][0];

		if($custom_key_value) { $keywords = $custom_key_value; } 
		else { $keywords = $default_blog_key; }
		}
	elseif(is_single()) {
		$post = $wp_query->post;
		$post_custom = get_post_custom($post->ID);
		$custom_key_value = $post_custom["$custom_key_key"][0];

		if($custom_key_value) { $keywords = $custom_key_value; } 
		else { foreach((get_the_category()) as $category) { 
    		echo $category->cat_name . ', '; }
			}
		}
	else { $keywords = (empty($default_blog_key)) ? trim(strip_tags(get_bloginfo('description'))) : $default_blog_key; }

	if($keywords) { echo $keywords; }
}
?>