<?php 
session_start();
require('config.php');

//if there is a valid cookie, recreate the session
if( isset( $_COOKIE['is_logged_in'] ) ){
	$_SESSION['isloggedin'] = $_COOKIE['is_logged_in'];
}
//kill this page if not logged in
if(  ! isset($_SESSION['isloggedin']) OR ! $_SESSION['isloggedin'] ){
	die( 'You are not logged in.' );
} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Secret Page</title>
</head>
<body>
	<h1>This is password protected stuff</h1>

	<a href="login.php?action=logout">Log Out</a>


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