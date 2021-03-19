<section class="comments">
	<h2><?php count_comments( $post_id ); ?> on this post</h2>

	<?php //get up to 20 the approved comments about this post, oldest first
	$result = $DB->prepare('SELECT users.profile_pic, users.username, comments.body, comments.date
							FROM comments, users
							WHERE users.user_id = comments.user_id
							AND comments.is_approved = 1
							AND comments.post_id = ?
							LIMIT 20'); 
	$result->execute( array( $post_id ) );
	if( $result->rowCount() >= 1 ){ 
		while( $row = $result->fetch() ){ 
	?>
	<div class="one-comment">
		<div class="user">
			<?php display_profile_pic( $row['profile_pic'] ); ?>
			<?php echo $row['username']; ?>
		</div>	

		<p><?php echo $row['body']; ?></p>

		<span class="date"><?php nice_date( $row['date'] ); ?></span>
	</div>
	<?php 
		} //end while
	}//end if comments found ?>

</section>