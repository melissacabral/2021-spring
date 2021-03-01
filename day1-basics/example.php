<?php 
//define a bunch of variables
$breakfast = 'Pancakes';
$your_name = 'Melissa';

//change the value
$breakfast = 'waffles';

$favorite_color = null;

//define a constant
define('DEBUG_MODE', false);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple example</title>
	<style type="text/css">
		h2{
			color:orange;
		}
	</style>
</head>
<body>
<h1>Heading here</h1>

<?php echo $favorite_color; ?>

<?php
//display something just to developers
if( DEBUG_MODE ){
	echo 'this is just for developer eyes';
} 
?>

<h2>
<?php echo "Good morning, $your_name. $breakfast sounds delicious!"; ?>
</h2>



<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


<?php echo 'more php'; ?>
</body>
</html>