<?php require('config.php'); 

//make a pizza!
$pizza = array(
	//'key' => value,
	'crust' => 'Crispy thin crust',
	'sauce' => 'Red sauce',
	'size'	=> '14-inch, large',
	'vegan'	=> 'Yes',
	'cheese'=> 'Mozarella',
);

//add another item
$pizza['dip'] = 'Ranch';

//change an existing item
$pizza['sauce'] = 'Pesto';

//alphabetize by key
//ksort($pizza);

//alphabetize by value
asort($pizza);

//count
$total = count($pizza);

?>
<!DOCTYPE html>
<html>
<head>
	<title>associative array examples</title>
</head>
<body>

<h1>Your Pizza</h1>
<?php echo $total; ?> Items on your pizza

<ul>
	<?php foreach( $pizza as $key => $value ){ 
		echo "<li>$key - <b>$value</b></li>";
	 } ?>
</ul>

<pre><?php print_r($pizza); ?></pre>

</body>
</html>