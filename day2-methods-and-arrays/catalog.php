<?php require('config.php');

//create an array of products (multi-dimensional array)
$catalog = array(
	3241 => array(
				'title' => 'Shirt',
				'price' => 49.95,
				'image'	=> 'https://picsum.photos/id/1005/250/250',
			),
	2615 => array(
				'title' => 'Pants',
				'price' => 89.95,
				'image'	=> 'https://picsum.photos/id/1012/250/250',
			),
	8762 => array(
				'title' => 'blanket',
				'price' => 19.95,
				'image'	=> 'https://picsum.photos/id/1025/250/250',
			),
);
//count the items in the catalog
$total = count($catalog);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Catalog</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
	<style type="text/css">
		.grid{
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
		}
		.products{
			width:23%;
			min-width: 320px;
		}
	</style>
</head>
<body>
	<h1>Product Catalog</h1>
	<h2><?php echo $total; ?> Products found</h2>

	<div class="grid">
		
		<?php foreach( $catalog as $id => $attributes ){ ?>
			<div class="product">

			<!-- <pre><?php print_r($attributes); ?></pre> -->

				<img src="<?php echo $attributes['image']; ?>">
				<h2><?php echo $attributes['title']; ?></h2>
				<h3>$<?php echo $attributes['price']; ?></h3>

				<a href="catalog.php?id=<?php echo $id; ?>" class="button">Add to cart</a>
			</div> <!-- end .product -->
		<?php } ?>


	</div> <!-- end .grid -->


<?php if( DEBUG_MODE ){ ?>
	<pre><?php print_r( $catalog ); ?></pre>
<?php } ?>

</body>
</html>