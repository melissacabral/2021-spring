<?php 
//get all dependencies
require('../config.php');
require_once(FILE_ROOT . '/includes/functions.php');

//get all the data
$follower = filter_var($_REQUEST['followerId'], FILTER_SANITIZE_NUMBER_INT);
$followee = filter_var($_REQUEST['followeeId'], FILTER_SANITIZE_NUMBER_INT);

//check to see if this relationship already exists
$result = $DB->prepare("SELECT * FROM follows
						WHERE follower_id = :follower 
						AND followee_id = :followee
						LIMIT 1");
$result->execute( array(
					'follower' => $follower,
					'followee' => $followee,
				) );
if($result->rowCount() >= 1){
	//remove the relationship
	$query = "DELETE FROM follows
			WHERE follower_id = :follower 
			AND followee_id = :followee
			LIMIT 1";
}else{
	//add the relationship
	$query = "INSERT INTO follows
			(follower_id, followee_id)
			VALUES 
			(:follower, :followee)";
}

//run the resulting query
$result = $DB->prepare($query);
$result->execute( array(
					'follower' => $follower,
					'followee' => $followee,
				) );
//update the interface
if( $result->rowCount() >= 1 ){
	follows_interface( $followee, $follower );
}else{
	//TODO: remove this after testing
	echo 'failed';
}