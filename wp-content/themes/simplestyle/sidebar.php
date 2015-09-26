	<div id="sidebar-1">
		<ul>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar()): else: ?>

			<li>
				<h3 class="sb_title"><?php _e('文章归档'); ?></h2>
				<ul>
					<?php wp_get_archives('type=monthly');?>
				</ul>
			</li>
			<?php wp_list_bookmarks(); ?>
			
			<li>
				<h3 class="sb_title"><?php _e('Meta'); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>
			<li class="rssfeed">
				<h3 class="sb_title">RSS订阅</h3>
				<ul>
					<li>
						<a href="<?php bloginfo('url'); ?>/?feed=rss2" target="_blank" class="icon1" title="欢迎订阅<?php bloginfo('name'); ?>">RSS订阅</a>
					</li>
				</ul>
			</li>
			<?php endif; ?>

		</ul>		

	</div>

	<?php wp_meta(); ?>