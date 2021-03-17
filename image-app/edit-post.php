<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );

//which post are we editing?
//URL will look like edit-post.php?post_id=X
$post_id = filter_var( $_GET['post_id'], FILTER_SANITIZE_NUMBER_INT );
//who is logged in?
$user_id = $logged_in_user['user_id'];

require( FILE_ROOT . '/includes/edit-post-parse.php' );

?>
<main class="content">
	<?php if( $logged_in_user ){ ?>
		<div class="important-form">
			<h2>Edit Post Details</h2>

			<?php display_post_image( $post_id ); ?>

			<?php display_feedback( $feedback, $feedback_class, $errors ); ?>

			<form action="edit-post.php?post_id=<?php echo $post_id; ?>" method="post">
				<label>Title</label>
				<input type="text" name="title" value="<?php echo $title; ?>">

				<label>Caption</label>
				<textarea name="body"><?php echo $body; ?></textarea>

				<label>Category</label>
				<?php display_category_dropdown( $category_id ); ?>

				<label>
					<input type="checkbox" name="allow_comments" value="1" 
					<?php checked( 1, $allow_comments ) ?>>
					Allow Comments on this post
				</label>

				<input type="submit" value="Save Post">
				<input type="hidden" name="did_edit" value="1">
			</form>
		</div>
	<?php } else { ?>
		<h2>This page is password protected. Log in first.</h2>
	<?php } ?>

</main>

<?php 
include( FILE_ROOT . '/includes/sidebar.php'); 
include( FILE_ROOT . '/includes/footer.php');
?>