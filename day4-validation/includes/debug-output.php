<?php 
if( DEBUG_MODE ){ ?>
	<div class="debug-output container">
		<h3>DEBUG MODE IS ON</h3>
		<pre><?php print_r( get_defined_vars() ); ?></pre>
	</div>
<?php } ?>