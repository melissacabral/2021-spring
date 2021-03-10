<section class="comment-form" id="respond">
	<h2>Leave a Comment</h2>

	<?php display_feedback($feedback, $feedback_class, $errors); ?>
	
	<form action="single.php?post_id=<?php echo $post_id; ?>#respond" method="post">
		<label>Your Comment:</label>
		<textarea name="body"></textarea>

		<input type="submit" value="Comment">
		<input type="hidden" name="did_comment" value="1">		
	</form>
</section>