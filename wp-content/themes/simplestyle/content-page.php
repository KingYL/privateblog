<div id="post_page">
	<h2 id="page_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
	<div id="page_content">
		<p><?php the_content(); ?></p>
		<?php wp_link_pages('<p><strong>翻页</strong>', '</p>', 'number'); ?>
		<?php edit_post_link('编辑', '<p>', '</p>'); ?>
	</div>
</div>