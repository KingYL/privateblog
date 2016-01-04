<div class="single">
	<hr />
	<h2 class="single-title">
		<a href="<?php the_permalink();?>"><?php the_title();?></a>
	</h2>
	<hr />

	<div class='single-meta meta'>
		<img class="meta_icon"src="<?php bloginfo('template_directory');?>/images/readNum.png" />
		<span><?php echo getPostViews(get_the_ID());?></span>&nbsp;
		<img class="meta_icon" src="<?php bloginfo('template_directory'); ?>/images/bubble.png" />
		<?php comments_popup_link('木有评论 ', '一条评论 ', '评论 % '); ?>&nbsp;				
		<img class="meta_icon" src="<?php bloginfo('template_directory'); ?>/images/author.png" />
		<span><?php the_author(); ?></span>&nbsp;
		<img class="meta_icon" src="<?php bloginfo('template_directory'); ?>/images/folder.png" />
		<span><?php the_category('&nbsp;');?></span>&nbsp;
		<span class="post_tag">
			<?php if (get_the_tags()):the_tags('<strong>标签:</strong>', '&nbsp;&nbsp;&nbsp;', ''); ?>;
		<?php endif; ?>
	</span>
	<span><?php edit_post_link('编辑', ' &#124; ', ''); ?></span>
</div>
<div class='single-content'>
	<div class="entry">
		<p><?php the_content('阅读全文'); ?></p>
	</div>
</div>
</div>