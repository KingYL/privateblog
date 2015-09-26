
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

<div>
	<input type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" size="15" placeholder="搜索文章..." />
	<input type="submit" id="searchsubmit" value="搜索" />
</div>

</form>
