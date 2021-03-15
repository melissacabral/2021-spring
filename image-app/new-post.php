<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );
?>
<main class="content">
	<?php if( $logged_in_user ){ ?>
		<h2>New Post (secret page)</h2>
	<?php } else { ?>
		<h2>This page is password protected. Log in first.</h2>
	<?php } ?>

</main>

<?php 
include( FILE_ROOT . '/includes/sidebar.php'); 
include( FILE_ROOT . '/includes/footer.php');
?>