<aside class="sidebar">
	
	<?php //get up to 5 most recently joined users
	$result = $DB->prepare('SELECT username, profile_pic 
							FROM users
							ORDER BY user_id DESC
							LIMIT 5');
	$result->execute();
	if( $result->rowCount() >= 1 ){
	?>
	<section class="users">
		<h2>Newest Users</h2>
		<ul>
			<?php while( $row = $result->fetch() ){ ?>
			<li class="user">
				<img src="<?php echo $row['profile_pic']; ?>" alt="<?php echo $row['username']; ?>" width="50" height="50">
				<?php echo $row['username']; ?>
			</li>
			<?php } ?>
		</ul>
	</section>
	<?php } //end if users found ?>


	<?php //get up to 10 categories with post counts 
	$result = $DB->prepare('SELECT categories.*, COUNT(*) AS total
							FROM categories, posts
							WHERE categories.category_id = posts.category_id
							GROUP BY posts.category_id
							LIMIT 10');
	$result->execute();
	if( $result->rowCount() >= 1 ){
	?>
	<section class="categories">
		<h2>Categories</h2>
		<ul>
		<?php while( $row = $result->fetch() ){ ?>		
			<li>
				<a href="category.php?cat_id=<?php echo $row['category_id']; ?>">
					<?php echo $row['name']; ?>	
				</a>
				 (<?php echo $row['total']; ?>)</li>		
		<?php } ?>
		</ul>
	</section>
	<?php  } //end if categories ?>



	<?php //get up to 10 tags, alphabetical by name 
	$result = $DB->prepare('SELECT name FROM tags ORDER BY name ASC');
	$result->execute();
	if( $result->rowCount() >= 1 ){
	?>
	<section class="tags">
		<h2>Tags</h2>
		<ul>
		<?php while( $row = $result->fetch() ){ ?>
			<li><?php echo $row['name']; ?></li>
		<?php } ?>	
		</ul>
	</section>
	<?php  } //end if tags ?>



	<?php //get up to 5 recent comments, with the title of the post they are on and the name of the commenter. newest comment first
	$result = $DB->prepare('SELECT posts.title, users.username
							FROM comments, posts, users
							WHERE posts.post_id = comments.post_id
							AND users.user_id = comments.user_id
							AND comments.is_approved = 1
							ORDER BY comments.date DESC
							LIMIT 5');
	$result->execute(); 
	if( $result->rowCount() >= 1 ){ ?>
	<section class="recent-comments">
		<h2>Recent Comments</h2>

		<ul>
			<?php while( $row = $result->fetch() ){ ?>
			<li>
				<?php echo $row['username']; ?> 
				commented on 
				<?php echo $row['title']; ?>
			</li>
			<?php } //end while ?>
		</ul>

	</section>
	<?php } //end if there are comments ?>

</aside>