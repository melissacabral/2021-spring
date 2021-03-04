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
			</li>
			<?php } ?>
		</ul>
	</section>
	<?php } //end if users found ?>


	<?php //get up to 10 categories, alphabetical by name 
	$result = $DB->prepare('SELECT name FROM categories ORDER BY name ASC');
	$result->execute();
	if( $result->rowCount() >= 1 ){
	?>
	<section class="categories">
		<h2>Categories</h2>
		<ul>
		<?php while( $row = $result->fetch() ){ ?>		
			<li><?php echo $row['name']; ?></li>		
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


</aside>