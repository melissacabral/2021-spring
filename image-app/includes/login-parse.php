<?php 
//pre-define vars
$feedback = '';
$feedback_class = '';
$errors = array();

//parse the login if they pressed the button
if(isset($_POST['did_login'])){
	//sanitize everything
	$input_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$input_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	//validate
	$valid = true;
	//username must be between 3 - 30 chars
	if( strlen($input_username) < 3 OR strlen($input_username) > 30 ){
		$valid = false;	
	}
	//password must be at least 8 characters
	if( strlen($input_password) < 8 ){
		$valid = false;
	}
	//if valid, look up the username in the DB
	if($valid){
		$result = $DB->prepare('SELECT user_id, password
								FROM users
								WHERE username = ?
								LIMIT 1');
		$result->execute( array($input_username) );
		//was the username found?
		if( $result->rowCount() >= 1 ){
			$row = $result->fetch();
			//verify their password
			if( password_verify( $input_password, $row['password'] ) ){
				//success
				//if verified, set a cookie and session to keep them logged in 1 week
				//make a random access token
				$access_token = bin2hex( random_bytes( 30 ) );
				//store the token in the DB
				$result = $DB->prepare('UPDATE users
										SET access_token = :token
										WHERE user_id = :id
										LIMIT 1');
				$result->execute(array(
									'token' => $access_token,
									'id'	=> $row['user_id'],
								));
				if($result->rowCount() >= 1){
					$feedback = 'Success';
					$feedback_class = 'success';

					//store the access token as a cookie & session
					setcookie( 'access_token', $access_token, time() + 60 * 60 * 24 * 7 );
					$_SESSION['access_token'] = $access_token;

					setcookie( 'user_id', $row['user_id'],  time() + 60 * 60 * 24 * 7 );
					$_SESSION['user_id'] = $row['user_id'];
					
				}else{
					$feedback = 'Database Error.';
					$feedback_class = 'error';
				}
				
			}else{
				//bad password
				$feedback = 'Incorrect username/password combo.';
				$feedback_class = 'error';
			}
			
		}else{
			//username not found
			$feedback = 'Incorrect username/password combo.';
			$feedback_class = 'error';
		}
	}else{
		//not valid
		$feedback = 'Incorrect username/password combo.';
		$feedback_class = 'error';
	}
	
	//show feedback
}//end login parser 