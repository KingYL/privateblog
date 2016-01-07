<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php //comments_popup_script(); // off by default ?>

	<?php wp_head(); ?>
	
</head>
<body>
	<div id="header">
		<div class="left">
			<a id="blog_title" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_directory');?>/images/blog-title.png" height="63" width="120" /></a>
			<span id="blog_description" class="uk-text-bottom"><?php bloginfo('description'); ?></span>
		</div>
		<div id="nav">
			<?php wp_nav_menu(array("theme-location"=>"header-menu")); ?>
		</div>
		<?php include(TEMPLATEPATH.'/searchform.php'); ?>
		
	</div>
	
</body>

</html>