<?php require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Image Sharing App</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />

	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="site">
	<header class="header">
		<h1>Image Sharing App</h1>
	</header>
	<main class="content">
		<?php //get up to 20 the published posts, newest first. (get author and category info as well)
		$result = $DB->prepare('SELECT posts.image, posts.title, posts.body, posts.date, users.profile_pic, 
									users.username, categories.name
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
				<img src="<?php echo $row['image']; ?>">

				<span class="author">
					<img src="<?php echo $row['profile_pic']; ?>" width="50" height="50">
					<?php echo $row['username']; ?>
				</span>

				<h2><?php echo $row['title']; ?></h2>
				<p><?php echo $row['body']; ?></p>
				
				<span class="category"><?php echo $row['name']; ?></span>

				<span class="date"><?php echo $row['date']; ?></span>
			</div>
		<?php 
			}  //end while
		} //end if posts found 
		else{
			echo '<h2>Sorry, no posts to show</h2>';
		}
		?>

	</main>
	
	<?php include('includes/sidebar.php'); ?>

	<footer class="footer"></footer>
</div>
</body>
</html>