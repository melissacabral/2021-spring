<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );
//require( FILE_ROOT . '/includes/edit-post-parse.php' );

//which post are we editing?
//URL will look like edit-post.php?post_id=X
$post_id = filter_var( $_GET['post_id'], FILTER_SANITIZE_NUMBER_INT );
?>
<main class="content">
	<?php if( $logged_in_user ){ ?>
		<div class="important-form">
			<h2>Edit Post Details</h2>

			<?php display_post_image( $post_id ); ?>
		</div>
	<?php } else { ?>
		<h2>This page is password protected. Log in first.</h2>
	<?php } ?>

</main>

<?php 
include( FILE_ROOT . '/includes/sidebar.php'); 
include( FILE_ROOT . '/includes/footer.php');
?>