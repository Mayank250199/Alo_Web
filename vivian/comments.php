<?php

if ( ! defined( 'ABSPATH' ) ) { die(); }

if ( post_password_required() ) { ?>
<p class="password-protected"><?php esc_html_e("This post is password protected. Enter the password to view comments.",'vivian'); ?></p>
<?php
return;
}
?>

<?php if ( have_comments() ) :

	/* Display Comments */
	if ( ! empty($comments_by_type['comment']) ) : ?>

		<div class="commentslist-container">

			<h3 id="comments"><?php esc_html_e('Recent Comments', 'vivian'); ?></h3>

			<ul class="commentlist">
				<?php wp_list_comments('type=comment&callback=fw_vivian_comments'); ?>
			</ul>

			<!-- Pagination check -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<div class="page-nav">
				<span class="nav-prev"><?php previous_comments_link( esc_html__("Older comments", 'vivian' ) ) ?></span>
				<span class="nav-next"><?php next_comments_link( esc_html__("Newer comments", 'vivian' ) ) ?></span>
			</div>

			<?php endif; ?> <!-- end pagination check -->

		</div>

	<?php endif; // end display comments

	/* Display pings */
	if ( ! empty($comments_by_type['pings']) ) : ?>
	<h3 id="pings"><?php esc_html_e('Trackbacks and Pingbacks', 'vivian'); ?></h3>

	<ul class="pinglist">
		<?php wp_list_comments('type=pings&callback=fw_vivian_list_pings'); ?>
	</ul>
	<?php endif; // end display pings

	/* Check if comments are closed */
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'vivian' ) ) : ?>

	<!-- If comments are closed. -->
	<p class="alert alert-info"><?php esc_html_e("Comments are closed", 'vivian'); ?>.</p>

<?php endif; // end have comments

if ( comments_open() ) :

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

$fields = array(
	'fields' => apply_filters( 'comment_form_default_fields', array(

		'author' =>
		'<div class="row"><div class="comment-form-author col-sm-12 col-md-4"><div class="field-text"><input id="author" name="author" placeholder="Name" type="text" value="" size="30"' . $aria_req . ' /><label for="author">' .
		' ' . esc_html__( 'Name', 'vivian' ) . ( $req ? '<sup>*</sup>' : '' ) . '</label></div></div>',

		'email' =>
		'<div class="comment-form-email col-sm-12 col-md-4"><div class="field-text"><input id="email" name="email" placeholder="Email" type="text" value="" size="30"' . $aria_req . ' /><label for="email">' . esc_html__( 'Email', 'vivian' ) . ' ' . ( $req ? '<sup>*</sup>' : '' ) . '</label></div></div>',

		'url' =>
		'<div class="comment-form-url col-sm-12 col-md-4">' .
		'<div class="field-text"><input id="url" name="url" placeholder="Website" type="text" value="" size="30" /><label for="url">' . esc_html__( 'Website', 'vivian' ) . '</label></div></div></div>'
		)
	),

	'comment_field' => '<div class="row"><div class="comment-form-comment col-sm-12 col-md-12"><div class="field-textarea"><textarea id="comment" placeholder="Comment..." name="comment" cols="45" rows="4" aria-required="true"></textarea><label for="comment">' . esc_html__( 'Comment', 'vivian' ) . ( $req ? '<sup>*</sup>' : '' ) . '</label></div></div></div>',
	'must_log_in' => '<p class="must-log-in">' .  sprintf( wp_kses_post(__('You must be <a href="%s">logged in</a> to post a comment.', 'vivian' ) ), wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) ) ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( wp_kses_post(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'vivian' ) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) ) ) . '</p>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'title_reply' => esc_html__('Leave a Comment', 'vivian'),
	'title_reply_to' => esc_html__('Leave a Reply to %s. ', 'vivian'),
	'cancel_reply_link' => esc_html__('Cancel Reply', 'vivian'),
	'label_submit' => esc_html__('Post Comment', 'vivian')
	);

comment_form($fields);

endif; // if you delete this the sky will fall on your head ?>
