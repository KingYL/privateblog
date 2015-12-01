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
				<h3 class="sb_title">订阅</h3>
				<ul>
					<li>
						<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><img src="http://www.mozilla.org/images/feed-icon-14x14.png" alt="RSS Feed" title="RSS Feed" />RSS2订阅</a>
					</li>
				</ul>
			</li>
			<?php endif; ?>

		</ul>		

	</div>

	<?php wp_meta(); ?>