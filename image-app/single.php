<?php 
require('config.php');
require_once( FILE_ROOT . '/includes/functions.php' ); 

$post_id = filter_var( $_GET['post_id'], FILTER_SANITIZE_NUMBER_INT );
//validate - make sure it's not empty
if($post_id == ''){
	$post_id = 0;
}
require( FILE_ROOT . '/includes/header.php' );
require( FILE_ROOT . '/includes/comment-parse.php');

//sanitize - get the ID of the post out of the URL - single.php?post_id=X


?>
<main class="content">
	<?php //get the published post that we're trying to show,  (get author and category info as well)
	$result = $DB->prepare('SELECT posts.image, posts.title, posts.body, posts.date, users.profile_pic, 
								users.username, categories.name, posts.allow_comments, users.user_id
							FROM posts, users, categories
							WHERE posts.is_published = 1
							AND users.user_id = posts.user_id
							AND categories.category_id = posts.category_id
							AND posts.post_id = ?
							LIMIT 1');
	//run it
	$result->execute( array( $post_id ) );
	//check it - did it find at least one row?
	if( $result->rowCount() >= 1 ){
		//loop it
		while( $row = $result->fetch() ){
	 ?>
		<div class="post">
			<?php display_post_image( $post_id, 'large' ); ?>

			<span class="author">
				<?php display_profile_pic( $row['profile_pic'] ); ?>
				<?php echo $row['username']; ?>
			</span>

			<?php if( $row['user_id'] == $logged_in_user['user_id']){ ?>
			<span class="edit">
				<a class="button button-outline" href="edit-post.php?post_id=<?php echo $post_id; ?>">Edit</a>
			</span>
			<?php } ?>

			<h2><?php echo $row['title']; ?></h2>
			<p><?php echo $row['body']; ?></p>
			
			<span class="category"><?php echo $row['name']; ?></span>

			<span class="date"><?php nice_date( $row['date'] ); ?></span>
		</div>
	<?php 
		//hold on to the value for allow_comments
		$allow_comments = $row['allow_comments'];
		}  //end while

		//get the comments about this post
		include( FILE_ROOT . '/includes/comments.php' );

		//load the comment form if comments are turned on for this post
		if($allow_comments){
			include( FILE_ROOT . '/includes/comment-form.php' );
		}
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