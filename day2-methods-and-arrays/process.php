<?php require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Submission Results</title>
	
	<!-- just a simple css framework for display -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body>
	
	<?php 
	if( $_REQUEST['fave_color'] == '' OR $_REQUEST['fave_animal'] == '' ){
		//error
	?>
		<div class="container error">
			<h1>Error</h1>
			<p>Please go back and fill in all the questions</p>
		</div>

	<?php
	}else{
		//success
	?>

		<div class="container success">
			<h1>Thank you</h1>

			<p>Your Answers: <br>
				Favorite Color: <?php echo $_REQUEST['fave_color']; ?> <br>
				Favorite Animal: <?php echo $_REQUEST['fave_animal']; ?> <br>
			</p>

		</div>
	<?php 
	} //end if
	?>

	

<?php if( DEBUG_MODE ){ ?>

	<div class="debug_output">
		<h2>Debug output</h2>

		<h3>POST array</h3>
		<pre><?php print_r( $_POST ) ; ?></pre>

		<h3>GET array</h3>
		<pre><?php print_r( $_GET ); ?></pre>

		<h3>REQUEST array</h3>
		<pre><?php print_r( $_REQUEST ); ?></pre>
	</div>

<?php } //end if debug mode ?>



</body>
</html>