<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );

//which profile are we showing?  profile.php?user_id=X
//if not set, show the logged in user
if( isset($_GET['user_id']) ){
	$user_id = filter_var( $_GET['user_id'], FILTER_SANITIZE_NUMBER_INT );
}else{
	$user_id = $logged_in_user['user_id'];
}

?>
<main class="content">
	<div class="grid">
		<?php //get this user and all their published posts (if they exist)
		$result = $DB->prepare('SELECT posts.*, users.username, users.bio, users.profile_pic
								FROM users
								LEFT JOIN posts
								ON ( posts.user_id = users.user_id AND posts.is_published = 1 )
								WHERE users.user_id = ?
								ORDER BY posts.date DESC
								LIMIT 21'); 
		$result->execute( array( $user_id ) );
		if( $result->rowCount() >= 1 ){
			$counter = 1;
			while( $row = $result->fetch() ){
				// echo '<pre>';
				// print_r($row);
				// echo '</pre>';
				//treat the first row as a large, important div
				if( $counter == 1 ){
		?>
		<div class="important">
			<div class="author author-profile">
				<?php display_profile_pic( $row['profile_pic'], 70 ); ?>
				<h2><?php echo $row['username']; ?></h2>
				<p class="bio"><?php echo $row['bio']; ?></p>
			</div>

			<div class="follows grid">
				<?php 
				if($logged_in_user){
					$viewer_id = $logged_in_user['user_id'];
				}else{
					$viewer_id = 0;
				}
				follows_interface( $user_id, $viewer_id ); ?>
			</div>

			<!-- first post, if it exists -->
			<?php if( $row['post_id'] ){ ?>
			<div class="post">
				<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
					<?php display_post_image( $row['post_id'], 'large' ); ?>
				</a>

				<h3><?php echo $row['title']; ?></h3>
				<span class="date"><?php nice_date( $row['date'] ); ?></span>
				<span class="comment-count"><?php count_comments( $row['post_id'] ); ?></span>
			</div>
			<?php }else{ ?>
			<div class="noposts">
				<p>This user hasn't made any public posts yet!</p>
			</div>

			<?php }//end if first post exists ?>

		</div><!-- end .important -->
		<?php 	
				}else{ 
				//not row 1
		?>
		<!-- all the remaining posts should be little posts -->
		<div class="post little-post item">
			<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
				<?php display_post_image( $row['post_id'], 'small' ) ?>
			</a>
		</div>
	<?php 
				}//end if row 1
				//increase the counter
				$counter += 1 ;
			}//end while
		}//end if rows found ?>

	</div><!-- end .grid -->
</main>

<?php 
include( FILE_ROOT . '/includes/sidebar.php'); 
include( FILE_ROOT . '/includes/footer.php');
?>