<?php
/*
Plugin Name: FT Multiple Category Archives
Plugin URI: http://fullthrottledevelopment.com/multiple-category-archives/
Description: This plugin allows you to create archive pages composed of posts in multiple categories.
Version: 0.2
Author: FullThrottle Development
Author URI: http://fullthrottledevelopment.com/
*/

//Primary Developer : Glenn Ansley (http://glennansley.com)

/*Copyright 2009 Glenn Ansley

/* Release History
 0.1 - Initial Release
*/

define( 'FT_MCA_Version' , '0.1' );

// Define plugin path
if ( !defined('WP_CONTENT_DIR') ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content');
}
define('FT_MCA_PATH' , WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__)) );

// Define plugin URL
if ( !defined('WP_CONTENT_URL') ) {
	define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content' );
}
define( 'FT_MCA_URL' , WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)) );

// Set is_archive to true if ft_mca_categories is set
function ft_mca_set_is_archive(){
	if ( get_query_var('ft_mca_categories') ){
		global $wp_query;
		$wp_query->is_archive = true;
	}
}
add_action('wp','ft_mca_set_is_archive');

// Loads the correct theme file
function ft_mca_template_redirect(){
	global $wp_query;
	if ( get_query_var('ft_mca_categories') && !is_feed() ){
		if ( file_exists(TEMPLATEPATH.'/categories.php') ){
			include_once(TEMPLATEPATH.'/categoreis.php');
			exit;
		}elseif( file_exists(FT_MCA_PATH.'/categories.php') ){
			include_once(FT_MCA_PATH.'/categories.php');
			exit;
		}elseif ( file_exists(TEMPLATEPATH.'/archive.php') ){
			include_once(TEMPLATEPATH.'/archive.php');
			exit;
		}elseif ( file_exists(TEMPLATEPATH.'/index.php') ){
			include_once(TEMPLATEPATH.'/index.php');
			exit;
		}elseif ( file_exists(TEMPLATEPATH.'/404.php') ){
			include_once(TEMPLATEPATH.'/404.php');
			exit;
		}
	}
}
add_action('template_redirect','ft_mca_template_redirect');

// Appends SQL to the post_where clause to meet our needs.
function ft_mca_posts_where($where){
	global $wp_query;

	// Check to see if the var has been set via htaccess rewrites
	if ( $categories = get_query_var('ft_mca_categories') ){
		
		// Add a flag to wp_query
		$wp_query->is_categories = true;
		
		// Split the query var into the individual cats (explode by spaces)
		if ( $cats = explode(' ',$categories) ){
			
			// Foreach cat that we find, note its ID for our SQL statement and its name future use (like archive page titles)
			foreach( $cats as $key => $value){
				if ( $cat_obj = get_term_by('slug',$value,'category') ) { 
					$cat_id = $cat_obj->term_id;
					$wp_query->categories_names[] = $cat_obj->name;
				}else{
					$cat_id = 0;
				}
				
				// Append the WHERE clause
				$where .= " AND wp_posts.ID IN ( SELECT tr.object_id FROM wp_term_relationships AS tr INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy = 'category' AND tt.term_id IN ('".$cat_id."') )";
			}
		}
	}
	return $where;
}
add_filter('posts_where','ft_mca_posts_where');

// Flush rewrite rules so that WP will add ours
function ft_mca_flush_rewrite_rules() {
   global $wp_rewrite;
   $wp_rewrite->flush_rules();
}
add_action('init', 'ft_mca_flush_rewrite_rules');

// Add rewrite rules for categories
function ft_mca_category_rewrite_rules( $category_rules ){
	$new_rules['categories/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?ft_mca_categories=$matches[1]&feed=$matches[2]';
	$new_rules['categories/(.+?)/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?ft_mca_categories=$matches[1]&feed=$matches[2]';
	$new_rules['categories/(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?ft_mca_categories=$matches[1]&paged=$matches[2]';
	$new_rules['categories/(.+?)/?$'] = 'index.php?ft_mca_categories=$matches[1]';	
	$category_rules = $new_rules + $category_rules;
	
	return $category_rules;
}
add_filter( 'category_rewrite_rules' , 'ft_mca_category_rewrite_rules' );

// Register query vars to use in script
function ft_mca_register_query_vars($query_vars){
	$query_vars[] = 'ft_mca_categories';
	return $query_vars;
	die();
}
add_filter( 'query_vars' , 'ft_mca_register_query_vars' );

// Returns true if is_categories flag is set in wp_query. Created for template logic
function is_categories(){
	global $wp_query;
	if ( $wp_query->is_categories ){ return true; }
	return false;
}

// Returns an array of all category titles found in the URL
function ft_mca_titles(){
	global $wp_query;
	if ( isset($wp_query->categories_names) && is_array($wp_query->categories_names) ){
		return $wp_query->categories_names;
	}
	return false;
}
?>