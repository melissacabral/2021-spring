<?php 
//pre-define all needed vars
$feedback = '';
$feedback_class = '';
$errors = array();

//if the user submitted the comment form, parse it
if(isset( $_POST['did_comment'] )){
	//sanitize everything
	$body = filter_var( $_POST['body'], FILTER_SANITIZE_STRING );
	//TODO: replace this with the actual logged in user
	$user_id = 1;

	//validate
	$valid = true;
	//body can't be blank
	if($body == ''){
		$valid = false;
		$errors[] = 'Please fill in the comment';
	}
	//if valid, add the comment to the db
	if( $valid ){
		$data = array(
					'user_id' 	=> $user_id,
					'body'		=> $body,
					'post_id'	=> $post_id
				);

		$result = $DB->prepare('INSERT INTO comments 
								(user_id, body, date, post_id, is_approved) 
								VALUES 
								(:user_id, :body, now(), :post_id, 1)');
		$result->execute( $data );
		//check to see that it worked
		if( $result->rowCount() >= 1 ){
			//success
			$feedback = 'Thank you for your comment!';
			$feedback_class = 'success';
		}else{
			//error
			$feedback = 'Your comment could not be saved!';
			$feedback_class = 'error';
		}
	}else{
		//invalid - handle feedback
		$feedback = 'Your comment could not be saved - fix the following:';
		$feedback_class = 'error';
	}	
	
}//end comment parser

//no close php