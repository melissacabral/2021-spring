<?php 
require('config.php');
 
//create a list of pizza toppings
$pizza_toppings = array( 'Mushrooms', 'Artichoke Hearts', 'Caramelized Onions' );

//add one item to an existing array
$pizza_toppings[] = 'Ricotta';

//change a specific key
$pizza_toppings[0] = 'Sausage';

//randomize
// shuffle($pizza_toppings);


//adding after the shuffle keeps it at the bottom
$pizza_toppings[] = 'fresh basil';

// sort values alphabetically
natcasesort($pizza_toppings);

//count all the toppings
$total =  count($pizza_toppings);

?>
<!DOCTYPE html>
<html>
<head>
	<title>simple array examples</title>
</head>
<body>
	<h1>Your Pizza</h1>
	<h2><?php echo "$total toppings on your pizza"; ?></h2>

	<ul>
		
		<?php 
		foreach($pizza_toppings as $topping){
			echo "<li class='item'>$topping</li>";
		} 
		?>

	</ul>

<!-- ugly, just for developers! -->
	<pre><?php print_r($pizza_toppings); ?></pre>

</body>
</html>