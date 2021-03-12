<?php
//pre-define vars
$errors = array();
$feedback = '';
$feedback_class = '';

//parse the form if it was submitted
if( isset($_POST['did_register']) ){
	//clean every field
	$username 	= filter_var( $_POST['username'], 	FILTER_SANITIZE_STRING );
	$email 		= filter_var( $_POST['email'], 		FILTER_SANITIZE_EMAIL );
	$password 	= filter_var( $_POST['password'], 	FILTER_SANITIZE_STRING );
	//sanitize a checkbox boolean
	if( $_POST['policy'] == 1 ){
		$policy = 1;
	}else{
		$policy = 0;
	}

	//validate
	$valid = true;
	//username must be between 3 - 30 chars
	if( strlen($username) < 3 OR strlen($username) > 30 ){
		$valid = false;
		$errors[] = 'Username must be between 3 - 30 chars';
	}else{
		//username must be unique(not in db)
		$result = $DB->prepare('SELECT username 
								FROM users
								WHERE username = ?
								LIMIT 1');
		$result->execute(array( $username ));
		//if one row found, this username is taken!
		if( $result->rowCount() >= 1 ){
			$valid = false;
			$errors[] = 'That username is already taken. Try another.';
		}
	}//end of all username checks
	
	//password must be at least 8 characters
	if( strlen($password) < 8 ){
		$valid = false;
		$errors[] = 'Your password is too short. Make one that is at least 8 characters long.';
	}
	//email must be valid
	if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ){
		$valid = false;
		$errors[] = 'Provide a valid email address.';
	}else{
		//email must be unique (not in db)
		$result = $DB->prepare('SELECT email 
								FROM users 
								WHERE email = ? 
								LIMIT 1');
		$result->execute( array($email) );
		if( $result->rowCount() >= 1 ){
			$valid = false;
			$errors[] = 'That email account is already registered. Try Logging in.';
		}
	}//end email checks
	
	//policy box must be checked
	if( ! $policy ){
		$valid = false;
		$errors[] = 'You must accept the terms of service before registering.';
	}
	
	//if valid, add the user to the database
	if( $valid ){
		//salt & hash the password
		$hashed_pass = password_hash( $password, PASSWORD_DEFAULT );

		$data = array(
					'username' 	=> $username,
					'pass' 		=> $hashed_pass,
					'email' 	=> $email
				);
		$result = $DB->prepare('INSERT INTO users
								( username, email, password, is_admin, join_date )
								VALUES 
								( :username, :email, :pass, 0, now() )');
		$result->execute( $data );
		if( $result->rowCount() >= 1 ){
			//success
			$feedback = 'Welcome! You can now <a href="login.php">log in</a>.';
			$feedback_class = 'success';
		}else{
			//error
			$feedback = 'Sorry, we could not complete your registration right now. Try again later.';
			$feedback_class = 'error';
		}

	}else{
		$feedback = 'There were problems with your registration. Fix the following:';
		$feedback_class = 'error';
	}

}//end form parser