<?php 
require('config.php'); 
require_once( FILE_ROOT . '/includes/functions.php' );
require( FILE_ROOT . '/includes/header.php' );

//page configuration

$per_page = 4;

//what did they search for? clean the input
$phrase = filter_var( $_GET['phrase'], FILTER_SANITIZE_STRING );
?>
<main class="content">
	<?php //validate -phrase not blank
	if( $phrase != '' ){ 
		$wildcard_phrase = "%$phrase%";
		$result = $DB->prepare('
			SELECT post_id, title, body, is_published, image, date
			FROM posts
			WHERE ( title LIKE :phrase
			OR body LIKE :phrase )
			AND is_published = 1'
		);
		$result->execute( array( 'phrase' => $wildcard_phrase ) );
		
		//debug_statement($result);
		
		//total number of matching posts
		$total = $result->rowCount();
		//how many pages do we need? ceil() means always round up to a full page
		$max_pages = ceil( $total / $per_page );

		//what page are we on? url will look like search.php?phrase=x&page=10
		$current_page = $_GET['page'];
		//validate the current page (if invalid, default to page 1)
		if($current_page < 1 OR $current_page > $max_pages){
			$current_page = 1;
		}

		//create the offset for out LIMIT
		$offset = ( $current_page - 1 ) * $per_page;

		//run the query again, but with the LIMIT in place
		$result = $DB->prepare('
			SELECT post_id, title, body, is_published, image, date
			FROM posts
			WHERE ( title LIKE :phrase
			OR body LIKE :phrase )
			AND is_published = 1
			LIMIT :offset, :per_page'
		);
		//must use bindParam here because of strict INT datatype on LIMIT
		$result->bindParam( 'phrase', $wildcard_phrase, PDO::PARAM_STR );
		$result->bindParam( 'offset', $offset, 			PDO::PARAM_INT );
		$result->bindParam( 'per_page', $per_page, 		PDO::PARAM_INT );
		
		$result->execute();
	?>
	<section class="title">
		<h2>Search Results for <?php echo $phrase; ?></h2>
		<h3><?php echo $total; ?> posts found. 
			Showing page <?php echo $current_page; ?> of <?php echo $max_pages; ?></h3>
	</section>

	<?php if( $total >= 1 ){ ?>
	<section class="grid">
		
		<?php while( $row = $result->fetch() ){ ?>
		<div class="item">
			<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
				<?php display_post_image( $row['post_id'], 'small' ); ?>
				<h3><?php echo $row['title']; ?></h3>
				<span class="date"><?php nice_date( $row['date'] ); ?></span>
			</a>
		</div>
		<?php } //end while ?>

	</section>

	<section class="pagination">
		<?php 
		$prev = $current_page - 1;
		$next = $current_page + 1;
		 ?>
		
		<?php if( $current_page > 1 ){ ?>
		<a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $prev; ?>" 
			class="button button-outline">&larr; Previous</a>
		<?php } ?>

		<?php if( $current_page < $max_pages ){ ?>
		<a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $next; ?>" 
			class="button button-outline">Next &rarr;</a>
		<?php } ?>
	</section>
	<?php }  //end if one or more posts to show ?>

	<?php 
	}else{
		echo 'Search cannot be blank';
	} ?>
</main>
<?php 
include( FILE_ROOT . '/includes/sidebar.php'); 
include( FILE_ROOT . '/includes/footer.php');
?>