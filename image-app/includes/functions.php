<?php
/**
 * Convert ugly timestamps to human-friendly dates
 * @param string $timestamp the ugly date in a format like SQL DATETIME
 * @return string outputs the date formatted like Monday, March 8th 2021
 */
function nice_date( $timestamp ){
	$date = new DateTime( $timestamp );
	echo $date->format('l, F jS, Y');
}

/**
 * Count the number of approved comments on any given post
 */
function count_comments( $id ){
	global $DB;
	//write it
	$result = $DB->prepare( 'SELECT COUNT(*) AS total 
							FROM comments 
							WHERE post_id = ?
							AND is_approved = 1' );
	//run it
	$result->execute( array( $id ) );
	//get the one value out of the result
	$total = $result->fetchColumn(0);
	//display the total with "grammar" (1 Comment vs 10 Comments)
	if( $total == 1 ){
		echo '1 Comment';
	}else{
		echo "$total Comments";
	}
}

/**
 * Display feedback for any form
 * @param string $feedback the heading of the error message
 * @param string $feedback_class 'success' or 'error' class for styling
 * @param array $errors the list of bullets to show
 */
function display_feedback( $feedback = '', $feedback_class = 'error', $errors = array() ){
	if( isset( $feedback ) AND $feedback != '' ){
	?>
		<div class="feedback <?php echo $feedback_class; ?>">
			<h2><?php echo $feedback; ?></h2>

			<?php if( ! empty( $errors ) ){ ?>
				<ul>
					<?php foreach( $errors as $error ){ ?>
						<li><?php echo $error; ?></li>
					<?php } ?>
				</ul>
			<?php } ?>

		</div>			
	<?php 
	}//endif feedback exists
}

/**
 * displays sql query information including the computed parameters.
 * Silent unless DEBUG MODE is set to 1 in config.php
 * @param [type] $[name] [<description>]
 */

function debug_statement($sth){
    if( DEBUG_MODE ){
        echo '<pre>';
    
        $info =  debug_backtrace();
        echo '<b>Debugger ran from ' . $info[0]['file'] . ' on line ' . $info[0]['line'] . '</b><br><br>';

        $sth->debugDumpParams();
        echo '</pre>';
    }
}


/**
 * check to see if the viewer is logged in
 * @return array|bool false if not logged in, array of all user data if they are logged in
 */

function check_login(){
    global $DB;
    //if the cookie is valid, turn it into session data
    if(isset($_COOKIE['access_token']) AND isset($_COOKIE['user_id'])){
        $_SESSION['access_token'] = $_COOKIE['access_token'];
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }

   //if the session is valid, check their credentials
   if( isset($_SESSION['access_token']) AND isset($_SESSION['user_id']) ){
        //check to see if these keys match the DB     

       $data = array(
       	'id' => $_SESSION['user_id'],
       	'access_token' =>$_SESSION['access_token'],
       );

        $result = $DB->prepare(
        	"SELECT * FROM users
                WHERE user_id = :id
                AND access_token = :access_token
                LIMIT 1");
        $result->execute( $data );
       
        if($result->rowCount() >= 1){
            //success! return all the info about the logged in user
            return $result->fetch();
        }else{
            return false;
        }
    }else{
        //not logged in
        return false;
    }
}





//no close php