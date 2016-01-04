<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
	?>

	<h2><?php _e('Password Protected'); ?></h2>
	<p><?php _e('Enter the password to view comments.'); ?></p>

	<?php return;
}
}

/* This variable is for alternating comment background */

$oddcomment = 'alt';

?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('评论 0', '评论 1', '评论( % )');?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ul class="uk-comment-list">
		<?php foreach ($comments as $comment) : ?>

		<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
			<article class="uk-comment">
				<div class="uk-comment-header">
					<img class="left uk-comment-avatar" src="<?php bloginfo('template_directory'); ?>/images/critic.png" height="32" width="32" />
					<span class="uk-comment-title"><?php comment_author_link() ?></span>
					<br/>
					<div class="uk-comment-meta">
						<span><?php comment_date('Y-m-d') ?><?php comment_time() ?></span> 
						<?php _e('说道:'); ?> <?php edit_comment_link('编辑评论 ','',''); ?>	
					</div>
					
					<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('您的评论还在审核中...'); ?></em>
					<?php endif; ?>
				</div>
				<div class="uk-comment-body">
					<?php comment_text(); ?>
					<?php comment_reply_link(); ?>
				</div>
			</article>
			<ul class="uk-comment">
				<div id="commentform">
					<?php comment_id_fields(); ?>
				</div>				
			</ul>	
		
	</li>

	<?php /* Changes every other comment to a different class */
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'alt';
	?>

<?php endforeach; /* end for each comment */ ?>
</ul>
<hr />
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
	<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>

	<!-- If comments are closed. -->
	<p class="nocomments">评论功能已经关闭</p>

<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

	<h3 id="respond">留下您的评论</h3>

	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( $user_ID ) : ?>

		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>

	<?php else : ?>

	<p>	
		<input class="long-text" type="text" name="author" id="author" placeholder="您的昵称" value="<?php echo $comment_author; ?>" size="40" tabindex="1" />
		<label class="forhint"><small><?php if ($req) _e("(必填)"); ?></small></label>
	</p>

	<p>
		<input class="long-text" type="text" name="email" id="email" placeholder="您的邮箱" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" />
		<label class="forhint"><small><?php if ($req) echo _e("(必填)"); ?>用于交流，保证绝对不会公开</small></label>
	</p>

	<p>
		<input class="long-text" type="text" name="url" id="url" placeholder="您的博客网址" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" />
		<label class="forhint"><small>(可选)我猜您不会留下推广链接的</small></label>
	</p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?> <?php echo allowed_tags(); ?></small></p>-->

<p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4" placeholder="随便说点什么吧"></textarea></p>

<p><input class="btn" name="submit" type="submit" id="submit" tabindex="5" value="提交评论" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>