<?php
$feedback = '';
$feedback_class = '';
$errors = array();

//if the form was submitted, parse it
if( isset( $_POST['did_edit'] ) ){
	//sanitize everything
	$title 			= filter_var($_POST['title'], 		FILTER_SANITIZE_STRING);
	$body 			= filter_var($_POST['body'], 		FILTER_SANITIZE_STRING);
	$category_id 	= filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
	//sanitize checkbox
	if( isset($_POST['allow_comments']) ){
		$allow_comments = 1;
	}else{
		$allow_comments = 0;
	}
	//validate
	$valid = true;
	//title can't be blank or longer than 50 chars
	if( $title == '' OR strlen( $title ) > 50 ){
		$valid = false;
		$errors['title'] = 'Provide a title up to 50 characters long';
	}
	//body not longer than 2000 chars
	if( strlen( $body ) > 2000 ){
		$valid = false;
		$errors['body'] = 'The caption can\'t be longer than 2000 characters';
	}
	//category must be positive, nonzero int
	if( $category_id < 1 ){
		$valid = false;
		$errors['category_id'] = 'Please choose a category for your post';
	}
	
	//if valid, update the post in the db and show feedback
	if($valid){
		$data = array(
					'title' 		=> $title,
					'body' 			=> $body,
					'category_id' 	=> $category_id,
					'allow_comments'=> $allow_comments,
					'post_id'		=> $post_id,
					'user_id'		=> $user_id
				);
		$result = $DB->prepare('UPDATE posts
								SET 
								title = :title,
								body = :body,
								category_id = :category_id,
								allow_comments = :allow_comments,
								is_published = 1
								WHERE post_id = :post_id 
								AND user_id = :user_id');
		$result->execute($data);
		if( $result->rowCount() >= 1 ){
			//success
			$feedback = 'Successfully saved your post.';
			$feedback_class = 'success';
		}else{
			//nothing changed
			$feedback = 'No changes were made to this post.';
			$feedback_class = 'info';
		}
	}else{
		$feedback = 'Your post could not be saved. Fix the following:';
		$feedback_class = 'error';
	}
} //end if did_edit

//prefill the values of this post AND make sure the logged in user is the author
$data = array(
			'user_id' => $user_id,
			'post_id' => $post_id
		);
$result = $DB->prepare('SELECT * FROM posts
						WHERE user_id = :user_id
						AND post_id = :post_id
						LIMIT 1');
$result->execute($data);
//if one row found, set the values need in the form. otherwise, lock the page down. 
if( $result->rowCount() >= 1 ){
	$row = $result->fetch();
	//create $title, $body, etc
	extract($row);
}else{
	die('Invalid post');
}
