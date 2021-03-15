<?php 
$logged_in_user = check_login(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Image Sharing App</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />

	<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>/css/style.css">
</head>
<body>
<div class="site">
	<header class="header">
		<h1><a href="index.php">Image Sharing App</a></h1>

		<nav class="main-navigation">
			<form class="searchform" method="get" action="search.php">
				<label class="screen-reader-text">Search:</label>
				<input type="search" name="phrase">
				<input type="hidden" name="page" value="1">
				<input type="submit" value="Search">
			</form>

			<ul class="menu">
			<?php if( $logged_in_user ){ ?>
				<li><a href="new-post.php">New Post</a></li>
				<li>
					<a href="profile.php">
					<img src="<?php echo $logged_in_user['profile_pic']; ?>" width="25" height="25">
					<?php echo $logged_in_user['username']; ?>	
					</a>
				</li>
				<li><a href="login.php?action=logout">Log Out</a></li>
			<?php }else{ ?>
				<li><a href="register.php">Sign Up</a></li>
				<li><a href="login.php">Log In</a></li>
			<?php } ?>
			</ul>
		</nav>
	</header>