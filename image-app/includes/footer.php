	<footer class="footer"></footer>
</div> <!-- close .site -->

<?php include( FILE_ROOT . '/includes/debug-output.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<?php if($logged_in_user){ ?>
<script type="text/javascript">
	//"Like" Interaction
	//use .on because the heart button is dynamic (.click won't work)
	$('.likes').on( 'click', '.heart-button', function(){
		//which post? which user?
		var postId = $(this).data('postid');
		var userId = <?php echo $logged_in_user['user_id']; ?> ;

		//console.log(postId, userId);

		//grab the parent container so we can update the interface later
		var likes_container = $(this).parents('.likes');

		$.ajax({
			method 	: 'GET',
			url		: 'ajax-handlers/like-unlike.php',
			data 	: {
							'userId' : userId,
							'postId' : postId
					  },	
			success : function( response ){
							//update the interface
							likes_container.html(response);
					  },
			error 	: function(){
						console.log('ajax error');
					  }
		});
	} );
</script>
<?php } ?>
<!-- AJAX Additions -->

</body>
</html>