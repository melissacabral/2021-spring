<?php 
session_start();
require('config.php');

//logout action. URL will look like ?action=logout
if( isset($_GET['action']) AND $_GET['action'] == 'logout' ){
	//unset all cookies (make it expire in the past)
	setcookie('is_logged_in', 0, time() - 9999);
	
	//destroy the session
	//https://www.php.net/manual/en/function.session-destroy.php
	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	session_destroy();
}//end logout action

//parse the form if they submitted it
if( isset($_POST['username']) ){
	//get all the info they typed  (usually sanitize them here)
	$username = $_POST['username'];
	$password =	$_POST['password'];

	//if the credentials match, log them in
	//otherwise, show an error
	if( $username == CORRECT_USER AND $password == CORRECT_PASSWORD ){
		//success
		$feedback = 'Success!';
		$feedback_class = 'success';

		//remember the user for 2 weeks
		//DANGER! this cookie is insecure and easy to hack, more on that later
		setcookie( 'is_logged_in', true, time() + ( 60 * 60 * 24 * 14 ) );
		$_SESSION['isloggedin'] = true;

		//redirect to the secret page
		header('Location:secret.php');
	}else{
		//error
		$feedback = 'Sorry, incorrect username/password combo. Try again.';
		$feedback_class = 'error';
	}
	
} //end form parser
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log In to your Account</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
	<style type="text/css">
		.login{
			max-width:30em;
		}
		.error{
			background-color: #FFC2BB;
			padding:.5em;
		}
		.success{
			background-color: #B5F9B5;
			padding:.5em;
		}
	</style>
</head>
<body>
	
	<div class="container login">
		<a href="secret.php">view secret page</a>
		<h1>Log in</h1>

		<?php 
		//if there is feedback, show it
		if( isset($feedback) ){
			echo "<div class='$feedback_class'>";
			echo $feedback; 
			echo '</div>';
		}
		?>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>Username</label>
			<input type="text" name="username">

			<label>Password</label>
			<input type="password" name="password">

			<input type="submit" value="Log In">
		</form>
	</div>



<?php 
if( DEBUG_MODE ){
	echo '<h3>DEBUG MODE IS ON</h3>';
	echo '<pre>';
	print_r( get_defined_vars() );
	echo '</pre>';
} 
?>
</body>
</html>