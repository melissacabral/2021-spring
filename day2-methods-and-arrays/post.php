<?php require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Example of the POST Method</title>
	
	<!-- just a simple css framework for display -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body>
	<h1>User Survey</h1>

	<form method="post" action="process.php">
		<label>What's your favorite color?</label>
		<input type="text" name="fave_color">

		<label>What's your favorite animal?</label>
		<input type="text" name="fave_animal">

		<input type="hidden" name="hidden1" value="some value">
		<input type="hidden" name="hidden2" value="some value">
		<input type="hidden" name="hidden3" value="some value">
		<input type="hidden" name="hidden4" value="some value">
		<input type="hidden" name="hidden5" value="some value">

		<input type="submit" value="Go!">
	</form>


</body>
</html>