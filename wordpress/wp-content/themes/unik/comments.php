<?php
if ( post_password_required() ) { ?>
<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'unik' ); ?></p>
<?php return;
}
?>

<div id="comments" class="row w_comment">
	<?php if ( have_comments() ) : ?>
	<h2 class="comment_count"><?php echo comments_number(__('No Comments','unik'), __('1 Comments','unik'), __('% Comments','unik')); ?></h2>
		<?php
			wp_list_comments( array( 'callback' => 'unik_theme_comment' )  );
		?>
	<!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="comment-navigation clearfix" role="navigation">
		<div class="nav-content">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'unik' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'unik' ) ); ?></div>
		</div>
	</nav>
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'unik' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if ( comments_open() ) : ?>
	<?php $fields=array(
		'author' => '<div class="form-group col-md-6"><label for="comment-name"></label><input class="form-control" id="name" name="author" type="text" placeholder="'.__('Your name','unik').'"></div>',
		'email' => '<div class="form-group col-md-6"><label for="comment-email"></label><input class="form-control" id="email" name="email" type="text" placeholder="'.__('Your Email','unik').'"></div>',
	);
	function my_fields($fields) { 
		return $fields;
	}
	add_filter('theme_custom_comment','my_fields');
		$defaults = array(
		'fields'=> apply_filters( 'theme_custom_comment', $fields ),
		'comment_field'=> '<div class="form-group col-md-12"><label for="message"></label><textarea class="form-control" rows="5" id="comment" name="comment" placeholder="'.__('Your Messeage','unik').'"></textarea></div>',		
		'logged_in_as' => '<p class="logged-in-as col-md-12">' . __( "Logged in as ",'unik' ).'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="Log out of this account">'.__(" Log out?",'unik').'</a>' . '</p>',
		'title_reply_to' => __( 'Leave a Reply to %s','unik'),
		'class_submit' => 'btn btn-large pull-right',
		'label_submit'=>__( 'Post Comment','unik'),
		'comment_notes_before'=> '',
		'comment_notes_after'=>'',
		'class_form'=>'row comment-form',
		'title_reply'=> '<h2>'.__('Leave a Reply','unik').'</h2>',		
		'role_form'=> 'form',		
		);
		comment_form($defaults); ?>		
<?php endif; // If registration required and not logged in ?>
</div><!-- #comments -->
