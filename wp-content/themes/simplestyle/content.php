<?php setPostViews(get_the_ID()); ?>
<div class="post">
	<div class="post-date">
		<?php the_time('Y年m月d日');?>
	</div>
	<div class="post_main">
		<div class="post_head">
			<img class="post-author-icon" src="<?php bloginfo('template_directory'); ?>/images/author-icon.png" height="65" width="75" alt="无描述"/>
			
			<h2 class="post_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<div class="meta">
					<img class="meta_icon"src="<?php bloginfo('template_directory');?>/images/readNum.png" />
					<span><?php echo getPostViews(get_the_ID());?></span>&nbsp;
					<img class="meta_icon" src="<?php bloginfo('template_directory'); ?>/images/bubble.png" />
					<?php comments_popup_link('木有评论 ', '一条评论 ', '评论 % '); ?>&nbsp;				
					<img class="meta_icon" src="<?php bloginfo('template_directory'); ?>/images/author.png" />
					<span><?php the_author(); ?></span>&nbsp;
					<img class="meta_icon" src="<?php bloginfo('template_directory'); ?>/images/sort.png" />
					<span><?php the_category('&nbsp;');?></span>&nbsp;
					<span class="post_tag">
						<?php if (get_the_tags()):the_tags('<strong>标签:</strong>', '&nbsp;&nbsp;&nbsp;', ''); ?>;
						<?php endif; ?>
					</span>
					<span><?php edit_post_link('编辑', ' &#124; ', ''); ?></span>

			</div>
		</div>

		<div class="entry">
			<p><?php the_content('阅读全文'); ?></p>
		</div>
	</div>

	<div class="post_side">
		<!-- <div class="post_time">
			<span class="year"><?php the_time('Y');?> </span>
			<span class="clock"><?php the_time('H:i');?></span>
		</div>
		<div class="post_sort">
			<span class="date"><?php the_time('n月d日');?></span>
		</div> -->
	</div>

</div>
<hr />