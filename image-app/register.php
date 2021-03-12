<?php 
require('config.php');
require_once(FILE_ROOT . '/includes/functions.php'); 
require(FILE_ROOT . '/includes/register-parse.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up for an account</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />

	<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>/css/style.css">
</head>
<body>
	<div class="container important-form">
		<h1>Create your account</h1>
		<p>Sign up to share images, comment and more.</p>

		<?php display_feedback( $feedback, $feedback_class, $errors ); ?>

		<form method="post" action="register.php">
			<label>Username</label>
            <input type="text" name="username">

            <label>Password</label>
            <input type="password" name="password">

            <label>Email Address</label>
            <input type="email" name="email">

            <label>
                <input type="checkbox" name="policy" value="1">
                I agree to the <a href="#" target="_blank">Terms of Service and Privacy Policy</a>
            </label>

            <input type="submit" value="Sign Up">

            <input type="hidden" name="did_register" value="1">         
       
		</form>
	</div>

<?php include( FILE_ROOT . '/includes/debug-output.php' ); ?>
</body>
</html>