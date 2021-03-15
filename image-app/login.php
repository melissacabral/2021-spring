<?php 
require('config.php'); 
require_once(FILE_ROOT . '/includes/functions.php');
require(FILE_ROOT . '/includes/logout-parse.php');
require(FILE_ROOT . '/includes/login-parse.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in to your account</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container important-form">
		<h1>Log In</h1>

		<?php display_feedback( $feedback, $feedback_class, $errors ); ?>

		<form method="post" action="login.php">
			<label>Username</label>
			<input type="text" name="username">

			<label>Password</label>
			<input type="password" name="password">

			<input type="submit" value="Log In" >

			<input type="hidden" name="did_login" value="true">
		</form>
	</div>
	<?php include('includes/debug-output.php'); ?>
</body>
</html>