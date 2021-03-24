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

/**
 * Display any post image at any known size (small, medium, large)
 */
function display_post_image( $post_id, $size = 'medium'){
    global $DB;

    $result = $DB->prepare('SELECT image, title 
                            FROM posts
                            WHERE post_id = ?
                            LIMIT 1');
    $result->execute( array($post_id) );

    if( $result->rowCount() >= 1 ){
        //display the image
        $row = $result->fetch();
        // uploads/sec7n6ei57sekftes_small.jpg
        $url = 'uploads/' . $row['image'] . '_' . $size . '.jpg';
        $alt = $row['title'];
        echo "<img src='$url' alt='$alt' >";
    }else{
        return false;
    }
}

/**
 * Display a dropdown (select) of all categories
 */
function display_category_dropdown( $current_cat = 0 ){
    global $DB;
    $result = $DB->prepare('SELECT * FROM categories ORDER BY name ASC');
    $result->execute();
    if( $result->rowCount() >= 1 ){
    ?>
    <select name="category_id">
        <?php while( $row = $result->fetch() ){ ?>
            <option value="<?php echo $row['category_id']; ?>" 
                <?php selected( $row['category_id'], $current_cat ); ?>>
                <?php echo $row['name']; ?>
            </option>
        <?php } ?>
    </select>
    <?php
    } //end if rows
}

/**
 * custom functions for making dropdowns and checkboxes "stick"
 */
function selected( $thing1, $thing2 ){
    if( $thing1 == $thing2 ){
        echo 'selected';
    }
}
function checked( $thing1, $thing2 ){
    if( $thing1 == $thing2 ){
        echo 'checked';
    }
}

/**
 * Display any user profile pic at any size in pixels
 * show a default pic if the user doesn't have one
 */
function display_profile_pic( $profile_pic, $size = 50 ){
    if($profile_pic == ''){
        //default
        $src = 'images/default-user.png';
    }else{
        $src = $profile_pic;
    }
    echo "<img src='$src' width='$size' height='$size' alt='User profile pic'>";
}

/**
 * Count the number of likes on any post
 */

function count_likes( $post_id = 0 ){
    global $DB;
    $result = $DB->prepare("SELECT COUNT(*) AS total_likes
                            FROM likes
                            WHERE post_id = ?");
    $result->execute( array( $post_id ) );
    if( $result->rowCount() >= 1 ){
        $row = $result->fetch();
        return $total = $row['total_likes'];
    }
}

/**
 * Like button interface 
 */
function like_interface( $post_id = 0, $user_id = 0 ){
    global $DB;
    //is the user logged in?
    if( $user_id ){
        //does the viewer like this post
        $result = $DB->prepare("SELECT * FROM likes
                                WHERE user_id = ?
                                AND post_id = ?
                                LIMIT 1");
        $result->execute( array( $user_id, $post_id ) );
        if( $result->rowCount() >= 1 ){
            $class = 'you-like';
        }else{
            $class = 'not-liked';
        }
    }//end if user logged in
    ?>
    <span class="like-interface">
        <span class="<?php echo $class; ?>">      
          <span class="heart-button" data-postid="<?php echo $post_id; ?>">❤</span>
          <?php echo count_likes( $post_id ); ?>
        </span>
    </span>
    <?php
}

/**
 * Count the number of followers a user has
 */
function count_followers( $user_id ){
    global $DB;
    $result = $DB->prepare("SELECT COUNT(*) AS total
                            FROM follows
                            WHERE followee_id = ?");
    $result->execute(array($user_id));
    $row = $result->fetch();

    echo $row['total'] == 1 ? '1 Follower' : $row['total'] . ' Followers';
}
/**
 * Count the number of accounts a user follows
 */
function count_following( $user_id ){
    global $DB;
    $result = $DB->prepare("SELECT COUNT(*) AS total
                            FROM follows
                            WHERE follower_id = ?");
    $result->execute(array($user_id));
    $row = $result->fetch();

    echo $row['total'] . ' Following';
}
/**
 * Display all info about a user's followers
 * @param  int $user_id the profile we're viewing
 * @return mixed HTML
 */
function follows_interface( $followee, $follower ){
    global $DB;
    //if viewer is logged in
    if($follower){
        //are they already following this account?
        $result = $DB->prepare("SELECT * FROM follows 
                                WHERE followee_id = ?
                                AND follower_id = ?
                                LIMIT 1");
        $result->execute(array( $followee, $follower ));
        if($result->rowCount() >= 1){
            //the viewer follows them
            $class = 'button-outline';
            $label = 'Unfollow';
        }else{
            //the viewer doesn't follow them yet
            $class = 'button';
            $label = 'Follow';
        }
    }
   
    ?>
    <div class="item"><?php count_followers( $followee ); ?></div>
    <div class="item"><?php count_following( $followee ); ?></div>
    <?php if( $follower AND $followee != $follower ){ ?>
    <div class="item">
        <button class="follow-button <?php echo $class; ?>" data-followee="<?php echo $followee; ?>">
            <?php echo $label; ?>
        </button>
    </div>
    <?php } 
}





//no close php