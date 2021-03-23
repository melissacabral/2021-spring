	<footer class="footer"></footer>
</div> <!-- close .site -->

<?php include( FILE_ROOT . '/includes/debug-output.php'); ?>


<?php if($logged_in_user){ ?>
<script type="text/javascript">
/**
 * Vanilla JS version of the like button demo. No frameworks required!
 */

//"Like" Interaction
document.addEventListener('click', function (event) {
	if (!event.target.matches('.heart-button')) return;
	const button = event.target;

	//which post? which user?
	const postId = button.dataset.postid;
	const userId = <?php echo $logged_in_user['user_id']; ?> ;

	//console.log(postId, userId);

	//grab the likes container so we can update the interface later
	const likes_container = getClosest(button, '.likes');		


	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			likes_container.innerHTML = this.responseText;
		}
	};
	const file = "ajax-handlers/like-unlike.php?postId="+postId+"&userId="+userId;
	xhttp.open("get", file , true);
	xhttp.send();
	
} );
/**
 * function to get the closest matching parent
 * @see https://gomakethings.com/how-to-get-the-closest-parent-element-with-a-matching-selector-using-vanilla-javascript/
 */
var getClosest = function (elem, selector) {

	// Element.matches() polyfill
	if (!Element.prototype.matches) {
	    Element.prototype.matches =
	        Element.prototype.matchesSelector ||
	        Element.prototype.mozMatchesSelector ||
	        Element.prototype.msMatchesSelector ||
	        Element.prototype.oMatchesSelector ||
	        Element.prototype.webkitMatchesSelector ||
	        function(s) {
	            var matches = (this.document || this.ownerDocument).querySelectorAll(s),
	                i = matches.length;
	            while (--i >= 0 && matches.item(i) !== this) {}
	            return i > -1;
	        };
	}

	// Get the closest matching element
	for ( ; elem && elem !== document; elem = elem.parentNode ) {
		if ( elem.matches( selector ) ) return elem;
	}
	return null;

};

</script>
<?php } ?>
<!-- AJAX Additions -->

</body>
</html>