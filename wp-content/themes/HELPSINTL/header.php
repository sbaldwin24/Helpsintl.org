<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php global $post; if (is_front_page()) { bloginfo('name'); echo " | "; bloginfo('description'); } else { bloginfo('name'); echo " | "; wp_title('&laquo;', true, 'right'); } ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo stripslashes(get_option('solid_feedurl')); ?>" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php echo stripslashes(get_option('solid_favicon')); ?>">

<?php if (is_front_page()) { 
	wp_enqueue_script('nivo_slider', SOLID_JS . 'jquery.nivo.slider.pack.js', array('jquery')); ?>
  	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/slider.css" type="text/css" media="screen" />
<?php } ?>

<?php wp_head(); ?>

<!-- PNG FIX for IE6 -->
<!--[if lte IE 6]>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix/supersleight-min.js"></script>
<![endif]-->

<script type="text/javascript">

jQuery(document).ready(function() {

	jQuery.fn.cleardefault = function() {
	return this.focus(function() {
		if( this.value == this.defaultValue ) {
			this.value = "";
		}
	}).blur(function() {
		if( !this.value.length ) {
			this.value = this.defaultValue;
		}
	});
};
jQuery(".clearit input, .clearit textarea").cleardefault();

});

</script>
<?php if (is_page('Videos')) { ?><script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script><?php } ?>
</head>
<body>
<div id="outer">

<div id="header">
    <a class="sitename" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>    
    
    <div id="headerwidget">
    <?php wp_nav_menu( array( 'container' => '', 'menu' => 'Header Menu' ) ); ?>
    <a href="<?php bloginfo('url'); ?>/about-us/contact" class="headerbutton">Contact Us</a> <a href="<?php bloginfo('url'); ?>/get-involved/donate/" class="headerbutton orange">Donate Online</a> <a href="<?php bloginfo('url'); ?>/get-involved" class="headerbutton blue">Get Involved</a> 
    </div>

</div>

<div id="pagemenu">
 <?php wp_nav_menu( array( 'container' => '', 'menu' => 'Primary Menu' ) ); ?><form id="searchform" method="get" action="<?php bloginfo('home'); ?>/" ><input type="text" value="Type, enter to search" onfocus="if (this.value == 'Type, enter to search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Type, enter to search';}" size="18" maxlength="50" name="s" id="s" /></form> 
</div>
    
<div id="page">