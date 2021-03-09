<?php
/**
 * Convert ugly timestamps to human-friendly dates
 * @param string $timestamp the ugly date in a format like SQL DATETIME
 * @return string outputs the date formatted like Monday, March 8th 2021
 */
function nice_date( $timestamp ){
	$date = new DateTime( $timestamp );
	echo $date->format('l, F jS, Y');
}

/**
 * Count the number of approved comments on any given post
 */
function count_comments( $id ){
	global $DB;
	//write it
	$result = $DB->prepare( 'SELECT COUNT(*) AS total 
							FROM comments 
							WHERE post_id = ?
							AND is_approved = 1' );
	//run it
	$result->execute( array( $id ) );
	//get the one value out of the result
	$total = $result->fetchColumn(0);
	//display the total with "grammar" (1 Comment vs 10 Comments)
	if( $total == 1 ){
		echo '1 Comment';
	}else{
		echo "$total Comments";
	}
}




//no close php