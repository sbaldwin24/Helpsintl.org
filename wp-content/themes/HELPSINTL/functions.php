<?php
define( 'SOLID_FOLDER', get_bloginfo( 'template_url' ) . '', true ); // Shortcut to point to the template folder
define( 'SOLID_JS', get_bloginfo( 'template_url' ) . '/js/', true ); // Shortcut to point to the /js/ URI

// Get the Logik Slider Post Type //
require_once('functions/solid-slider-post-type.php'); 

/*Theme Options*/
// the name of the theme
$themename = "HELPS Theme";

// an abbreviation of the theme's name
$shortname = "solid";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
	
array( "type" => "close"),
array( "name" => "Social Media",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Facebook Page",
	"desc" => "Enter the full url with http:// to your facebook page.",
	"id" => $shortname."_facebook",
	"type" => "text",
	"std" => ""),

array( "name" => "Twitter Username",
	"desc" => "Enter your twitter username.",
	"id" => $shortname."_twitter",
	"type" => "text",
	"std" => ""),	
	
array( "name" => "Flickr Address",
	"desc" => "Enter your flickr address.",
	"id" => $shortname."_flickr",
	"type" => "text",
	"std" => ""),	
	
array( "name" => "Vimeo URL",
	"desc" => "Enter your full Vimeo Url.",
	"id" => $shortname."_vimeo",
	"type" => "text",
	"std" => ""),	

array( "name" => "Contact Link",
	"desc" => "Enter a valid contact page url or email address.",
	"id" => $shortname."_contact",
	"type" => "text",
	"std" => get_bloginfo('admin_email')),	

array( "type" => "close"),
array( "name" => "Front Page Rotator",
	"type" => "section"),
array( "type" => "open"),		
	
array( "name" => "Rotator Speed",
	"desc" => "Rotator speed in seconds.",
	"id" => "slider_rotatespeed",
	"type" => "text",
	"std" => "6"),

array( "name" => "Animation Speed",
	"desc" => "Rotator animation speed in seconds.",
	"id" => "slider_anirotatespeed",
	"type" => "text",
	"std" => "1"),
	
array( "name" => "Slider Animation Effect",
	"desc" => "The animation effect in each slider transition.",
	"id" => "slider_rotateeffect",		
	"type" => "select",
	"options" => array("random", "fold", "fade", "sliceDown", "sliceUp", "sliceDownRight", "sliceDownLeft", "sliceUpRight", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft"),
	"std" => ""),
	
array( "name" => "Slider Slices",
	"desc" => "Number of slices in the animation.",
	"id" => "sider_rotateslices",
	"type" => "text",
	"std" => "15"),

array(  "name" => "Show Nav Arrows",
        "desc" => "Displays the Next a Previous arrows.",
        "id" => "slider_nextprev",
        "type" => "checkbox",
        "std" => "false"),

array( "type" => "close"),
array( "name" => "Front Page Programs",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Healthcare Image",
	"desc" => "Healthcare program image url at 217px x 110px.",
	"id" => $shortname."_hcimage",
	"type" => "text",
	"std" => ""),

array( "name" => "Healthcare Text",
	"desc" => "Healthcare descriptive text.",
	"id" => $shortname."_hctext",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "ONIL Products Image",
	"desc" => "ONIL Products program image url at 217px x 110px.",
	"id" => $shortname."_onimage",
	"type" => "text",
	"std" => ""),

array( "name" => "ONIL Products Text",
	"desc" => "ONIL Products descriptive text.",
	"id" => $shortname."_ontext",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Education Image",
	"desc" => "Education program image url at 217px x 110px.",
	"id" => $shortname."_edimage",
	"type" => "text",
	"std" => ""),

array( "name" => "Education Text",
	"desc" => "Education descriptive text.",
	"id" => $shortname."_edtext",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Economic Development Image",
	"desc" => "Economic Development program image url at 217px x 110px.",
	"id" => $shortname."_ecimage",
	"type" => "text",
	"std" => ""),

array( "name" => "Economic Development Text",
	"desc" => "Economic Development descriptive text.",
	"id" => $shortname."_ectext",
	"type" => "textarea",
	"std" => ""),

array( "type" => "close"),
array( "name" => "Appearance and Extras",
	"type" => "section"),
array( "type" => "open"),
	
array(  "name" => "Disable Page Comments",
        "desc" => "Disable comments and pingbacks on all pages (posts not affected).",
        "id" => $shortname."_commentsoff",
        "type" => "checkbox",
        "std" => "false"),
		
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/favicon.ico"),	
	
array( "name" => "RSS Feed URL",
	"desc" => "Your default feed is yoursite.com/feed, but you may elect to use feedburner or customize it here.",
	"id" => $shortname."_feedurl",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),

array(  "name" => "Remove Attribution",
        "desc" => "Don't you want to brag about FourTen Creative? Oh well...",
        "id" => $shortname."_removeatt",
        "type" => "checkbox",
        "std" => "false"),

array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=functions.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>

<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit"><h3>Reset Options</h3><small>Caution! <em>Choosing to Reset will discard any of your Solid Theme customizations. Proceed at your own risk.</em></small><br />
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

/* Add Meta Boxes */
global $new_meta_boxes;
$new_meta_boxes =
array(
	
	"sidebartitle" => array(
	"name" => "sidebartitle",
	"title" => "Page Sidebar Settings",
	"type" => "title",
	"location" => "Page"),
	"addsidebar" => array(
	"name" => "addsidebar",
	"std" => "",
	"title" => "Additional Sidebar",
	"description" => "Additional sidebar name.",
	"type" => "text",
	"location" => "Page"),
	"removesidebar" => array(
	"name" => "removesidebar",
	"std" => "FALSE",
	"title" => "Remove Sidebar",
	"description" => "Change to TRUE to remove the standard page sidebar.",
	"type" => "text",
	"location" => "Page"),
	"removesubmenu" => array(
	"name" => "removesubmenu",
	"std" => "FALSE",
	"title" => "Remove Submenu",
	"description" => "Change to TRUE to remove the list of subages aka In This Section.",
	"type" => "text",
	"location" => "Page"),
	
	"slidertitle" => array(
	"name" => "slidertitle",
	"title" => "Slider Item Settings",
	"type" => "title",
	"location" => "Slider"),
	"sliderurl" => array(
	"name" => "sliderurl",
	"std" => "",
	"title" => "Slider Item link URL",
	"description" => "Set an optional link url to be applied to this slider item image. be sure to include <em>http://</em><br />(Note: if you set a video in the field below then this property will be ignored and the video will still display in a lightbox)",
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

function new_meta_boxes_page() {
	new_meta_boxes('Page');
}

function new_meta_boxes_post() {
	new_meta_boxes('Post');
}

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
	global $themename;
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new_meta_boxes_post', ' Post Settings', 'new_meta_boxes_post', 'post', 'normal', 'high' );
		add_meta_box( 'new_meta_boxes_page', ' Page Settings', 'new_meta_boxes_page', 'page', 'normal', 'high' );
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

/* End Meta Boxes */

/* Sidebar Widget Options */
if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'Page Sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
)); 
register_sidebar(array(
	'name' => 'Blog Sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
register_sidebar(array(
	'name' => 'Media Sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
register_sidebar(array(
	'name' => 'FP Middle Mission',
	'before_widget' => '<div id="mission" class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
)); 
register_sidebar(array(
	'name' => 'Above Footer',
	'before_widget' => '<div id="%1$s" class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));  
register_sidebar(array(
	'name' => 'Footer Left',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
)); 
register_sidebar(array(
	'name' => 'Footer Center',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));  
register_sidebar(array(
	'name' => 'Footer Right',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));  

// Menu Support, Yay!//
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary_menu' => 'Primary Menu',
		  'header_menu' => 'Header Menu',
		  'footer_menu' => 'Footer Menu'
		)
	);
}
// Refresh Feed more Often //
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 1800;') );

// Check for valid email //
function is_valid_email($email)
{
	if(preg_match("/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0)
		return true;
	else
		return false;
}
?>
<?php
/*
Plugin Name: Sidebar Generator
Plugin URI: http://www.getson.info
Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish. Version 1.1 now supports themes with multiple sidebars. 
Version: 1.1.0
Author: Kyle Getson
Author URI: http://www.kylegetson.com
Copyright (C) 2009 Kyle Robert Getson
*/

class sidebar_generator {
	
	function sidebar_generator(){
		add_action('init',array('sidebar_generator','init'));
		add_action('admin_menu',array('sidebar_generator','admin_menu'));
		add_action('admin_print_scripts', array('sidebar_generator','admin_print_scripts'));
		add_action('wp_ajax_add_sidebar', array('sidebar_generator','add_sidebar') );
			

	}
	
	function init(){
		//go through each sidebar and register it
	    $sidebars = sidebar_generator::get_sidebars();
	    

	    if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator::name_to_class($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,
			    	'before_widget' => '<li id="%1$s" class="widget sbg_widget '.$sidebar_class.' %2$s">',
		   			'after_widget' => '</li>',
		   			'before_title' => '<h2 class="widgettitle sbg_title">',
					'after_title' => '</h2>',
		    	));
			}
		}
	}
	
	function admin_print_scripts(){
		wp_print_scripts( array( 'sack' ));
		?>
			<script>
				function add_sidebar( sidebar_name )
				{
					
					var mysack = new sack("<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "add_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					return true;
				}
				
				function remove_sidebar( sidebar_name,num )
				{
					
					var mysack = new sack("<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "remove_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.setVar( "row_number", num );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					//alert('hi!:::'+sidebar_name);
					return true;
				}
			</script>
		<?php
	}
	
	function add_sidebar(){
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if(isset($sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}
		
		$sidebars[$id] = $name;
		sidebar_generator::update_sidebars($sidebars);
		
		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);
			
			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);
			
			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);
			
			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)
			
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			removeLink.setAttribute('href', 'javacript:void(0)');
        
      		removeLink.appendChild(linkText);
      		cellLeft.appendChild(removeLink);

			
		";
		
		
		die( "$js");
	}
	
	function admin_menu(){
		add_submenu_page('themes.php', 'Sidebars', 'Sidebars', 'manage_options', __FILE__, array('sidebar_generator','admin_page'));
	}
	
	function admin_page(){
		?>
		<script>
			function remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = prompt("Sidebar Name:","");
				//alert(sidebar_name);
				add_sidebar(sidebar_name);
			}
		</script>
		<div class="wrap">
			<h2>Sidebar Generator</h2>
			<p>
				The sidebar name is for your use only. It will not be visible to any of your visitors. 
				A CSS class is assigned to each of your sidebar, use this styling to customize the sidebars.
			</p>
			<br />
			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="Add a sidebar">+ Add Sidebar</a>
			</div>
			<br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Name</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$sidebars = sidebar_generator::get_sidebars();
				//$sidebars = array('bob','john','mike','asdf');
				if(is_array($sidebars) && !empty($sidebars)){
					$cnt=0;
					foreach($sidebars as $sidebar){
						$alt = ($cnt%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo $alt?>">
					<td><?php echo $sidebar; ?></td>
					<td><?php echo sidebar_generator::name_to_class($sidebar); ?></td>
					<td><a href="javascript:void(0);" onclick="return remove_sidebar_link('<?php echo $sidebar; ?>',<?php echo $cnt+1; ?>);" title="Remove this sidebar">remove</a></td>
				</tr>
				<?php
						$cnt++;
					}
				}else{
					?>
					<tr>
						<td colspan="3">No Sidebars defined</td>
					</tr>
					<?php
				}
				?>
			</table>
			
		</div>
		<?php
	}
	
	/**
	 * for saving the pages/post
	*/
	

	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	function get_sidebar($name="0"){
		if(!is_singular()){
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			return;//dont do anything
		}
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
		$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
		$did_sidebar = false;
		//this page uses a generated sidebar
		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "\n\n<!-- begin generated sidebar -->\n";
			if(is_array($selected_sidebar) && !empty($selected_sidebar)){
				for($i=0;$i<sizeof($selected_sidebar);$i++){					
					
					if($name == "0" && $selected_sidebar[$i] == "0" &&  $selected_sidebar_replacement[$i] == "0"){
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar();//default behavior
						$did_sidebar = true;
						break;
					}elseif($name == "0" && $selected_sidebar[$i] == "0"){
						//we are replacing the default sidebar with something
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						$did_sidebar = true;
						break;
					}elseif($selected_sidebar[$i] == $name){
						//we are replacing this $name
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						$did_sidebar = true;
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						break;
					}
					//echo "<!-- called=$name selected={$selected_sidebar[$i]} replacement={$selected_sidebar_replacement[$i]} -->\n";
				}
			}
			if($did_sidebar == true){
				echo "\n<!-- end generated sidebar -->\n\n";
				return;
			}
			//go through without finding any replacements, lets just send them what they asked for
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			echo "\n<!-- end generated sidebar -->\n\n";
			return;			
		}else{
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
		}
	}
	
	/**
	 * replaces array of sidebar names
	*/
	function update_sidebars($sidebar_array){
		$sidebars = update_option('sbg_sidebars',$sidebar_array);
	}	
	
	/**
	 * gets the generated sidebars
	*/
	function get_sidebars(){
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}
	function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
	
}
$sbg = new sidebar_generator;

function generated_dynamic_sidebar($name='0'){
	sidebar_generator::get_sidebar($name);	
	return true;
}

// Post Image Settings //
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails'); 
  set_post_thumbnail_size( 270, 150 );
}
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'banner-wide', 940, 150, true ); 
	add_image_size( 'slider-item', 520, 260, true ); 
	add_image_size( 'banner', 660, 80, true ); 
	
}


// We don't have fight sweet admin bar...//
/**
 * Checks if we should add links to the bar.
 */
function lgk_admin_bar_init() {
	add_action('admin_bar_menu', 'lgk_admin_bar_links', 500);
	add_action('admin_bar_menu', 'lgk_remove_default_links', 500);
}
// Get things running!
add_action('admin_bar_init', 'lgk_admin_bar_init');
/**
 * Adds links to the bar.
 */
function lgk_admin_bar_links() {
	global $wp_admin_bar;
 
	// Build link.
	$url = get_bloginfo('url');
 
	// Links to add, in the form: 'Label' => 'URL'
	$links = array(
		'HELPS Theme Settings' => $url.'/wp-admin/admin.php?page=functions.php',
		'Widgets' => $url.'/wp-admin/widgets.php',
		'Menus' => $url.'/wp-admin/nav-menus.php'
	);
	// Add the Parent link.
	$wp_admin_bar->add_menu( array(
		'title' => 'HELPS Theme',
		'href' => false,
		'id' => 'lgk_links',
		'href' => false
	));
 
	/**
	 * Add the submenu links.
	 */
	foreach ($links as $label => $url) {
		$wp_admin_bar->add_menu( array(
			'title' => $label,
			'href' => $url,
			'parent' => 'lgk_links'
		));
	}
}
/**
 * Remove default admin links.
 */
function lgk_remove_default_links() {
	global $wp_admin_bar;
 
	/* Array of links to remove. Choose from:
	'my-account-with-avatar', 'my-account', 'my-blogs', 'edit', 'new-content', 'comments', 'appearance', 'updates', 'get-shortlink'
	 */
	$remove = array('appearance');
 
	if(empty($remove) )
		return;
 
	foreach($remove as $item) {
		$wp_admin_bar->remove_menu($item);
	}
}
/* Shortcodes*/
function get_rounder( $atts, $content = null ) {
	return '<div class="rounder">' . $content . '</div>';
}
add_shortcode('rounder', 'get_rounder');

?>