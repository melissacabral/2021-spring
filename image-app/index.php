<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );
?>
<main class="content">
	<?php //get up to 20 the published posts, newest first. (get author and category info as well)
	$result = $DB->prepare('SELECT posts.image, posts.title, posts.body, posts.date, users.profile_pic, 
								users.username, categories.name, posts.post_id
							FROM posts, users, categories
							WHERE posts.is_published = 1
							AND users.user_id = posts.user_id
							AND categories.category_id = posts.category_id
							ORDER BY posts.date DESC
							LIMIT 20');
	//run it
	$result->execute();
	//check it - did it find at least one row?
	if( $result->rowCount() >= 1 ){
		//loop it
		while( $row = $result->fetch() ){
	 ?>
		<div class="post">
			<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
				<?php display_post_image( $row['post_id'], 'large' ); ?>
			</a>

			<span class="author">
				<?php display_profile_pic( $row['profile_pic'] ); ?>
				<?php echo $row['username']; ?>
			</span>

			<h2><?php echo $row['title']; ?></h2>
			<p><?php echo $row['body']; ?></p>
			
			<span class="category"><?php echo $row['name']; ?></span>
			<span class="date"><?php nice_date( $row['date'] ); ?></span>
			<span class="comment-count"><?php count_comments( $row['post_id'] ); ?></span>
		</div>
	<?php 
		}  //end while
	} //end if posts found 
	else{
		echo '<h2>Sorry, no posts to show</h2>';
	}
	?>

</main>

<?php 
include( FILE_ROOT . '/includes/sidebar.php'); 
include( FILE_ROOT . '/includes/footer.php');
?>