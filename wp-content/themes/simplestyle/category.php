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
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery-2.1.4.min.js"></script>
	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php //comments_popup_script(); // off by default ?>

	<?php wp_head(); ?>

</head>

<body>
	<div id="wrapper">
		<?php get_header(); ?>
		<div id="container">

		<?php if (function_exists('dimox_breadcrumbs')) : dimox_breadcrumbs();?>
		<?php endif; ?>
		
		<br />

		<?php if (have_posts()):?>
			<?php while (have_posts()): the_post();?>
				<?php get_template_part('content', get_post_format()); ?>
			<?php endwhile; ?>

		<div class="navigation">
			<?php posts_nav_link(); ?>
		</div>

		<?php else: ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>

		</div>
		<?php get_sidebar(); ?>

		<?php get_footer(); ?>
	</div>
</body>

</html>