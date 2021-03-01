<?php 
//load assets
require('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple site example with includes</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include('includes/header.php');
	echo 'bananas'; ?>

	<main class="content">
		content goes here
	</main>

	<aside class="sidebar">
		this is the sidebar
	</aside>

	<footer class="footer">
		&copy; 2021 Platt College and other legal stuff here
	</footer>

</body>
</html>