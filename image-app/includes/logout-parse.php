<?php 
//logout action. URL will look like ?action=logout
if( isset($_GET['action']) AND $_GET['action'] == 'logout' ){
	//TODO: remove the access token from the database 
	
	//unset all cookies (make it expire in the past)
	setcookie('access_token', '', time() - 9999);
	setcookie('user_id', '', time() - 9999);
	
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