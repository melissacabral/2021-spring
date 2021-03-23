<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );
require( FILE_ROOT . '/includes/multi-size-parse.php' );
?>
<main class="content">
	<?php if( $logged_in_user ){ ?>
		<div class="important-form">
			<h2>New Post</h2>

			<?php display_feedback($feedback, $feedback_class, $errors); ?>

			<form action="multi-size.php" method="post" enctype="multipart/form-data">
				<label>Image File (jpg, gif, png allowed)</label>
				<input type="file" name="uploadedfile" accept=".jpg, .gif, .png">

				<input type="submit" value="Next: Post details &rarr;">
				<input type="hidden" name="did_upload" value="1">
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