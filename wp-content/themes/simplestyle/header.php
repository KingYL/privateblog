<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php //comments_popup_script(); // off by default ?>

	<?php wp_head(); ?>
	
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery-2.1.4.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/header.css" />
</head>
<body>
	<div id="header">
		<a id="blog_title" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
			<img src="<?php bloginfo('template_directory');?>/images/logo.png" height="100" width="200"></img>
		</a>
		<br />&nbsp;&nbsp;
		<span id="blog_description"><?php bloginfo('description'); ?></span>
		<div id="nav">
			<?php wp_nav_menu(array("theme-location"=>"header-menu")); ?>
			
			<div id="header_search">
				<?php include(TEMPLATEPATH.'/searchform.php'); ?>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function () {
			$(".menu li ul li a").mouseenter(function(event) {
				$(this).parents(".menu>li").children('a').css('background-color','#190a75');
			});
			$(".menu li ul li a").mouseover(function(event) {
				/* Act on the event */
				$(this).parents(".menu > li").children('a').css('background-color', '#190a75');
			});
			$(".menu li ul li a").mouseleave(function(event) {
				/* Act on the event */
				$(this).parents(".menu > li").children('a').css('background-color', '');
			});;

		});
	</script>
</body>

</html>